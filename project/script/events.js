/**
 * This file contains the JavaScript code for handling events in the user interface of the social media application. It listens for user interactions such as button clicks and form submissions, and makes AJAX requests to the backend API to perform actions like fetching user data, sending friend requests, and accepting friend requests. The responses from the API are then used to update the UI accordingly.
 * @author Julian Warlischek
 */
let activeEventId = null;


async function loadAllEvents() {
    fetch('../../api/event-api.php')
        .then(response => response.json())
        .then(async data => {
            let events = data.data;
            let temp_string = "";
            let userId = sessionStorage.getItem("user");

            for (const event of events) {
                const image = await fetchEventImage(event.event_id);

                console.log("Event: " + event.name + ", Master UserID: " + event.master_userid + ", Current UserID: " + userId);
                temp_string += `
                <div class="event liquidGlass-wrapper" onclick="openEvent(${event.event_id})" style="background: url('${image}'); background-size: cover; background-position: center;">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="event-left">
                        <h1>${event.name}</h1>
                        <p>${event.startDate.split(' ')[0]}</p>`
                    + (userId == event.master_userid ? `<div class='admin-event-icon'>
                                <i class="fa-solid fa-crown"></i>
                            </div>` : "") +
                    `</div>
                    <div class="event-right">
                    </div>
                </div>
                `
            }

            document.getElementById("event-flex").innerHTML = temp_string;
        })
        .catch(error => console.error('Error fetching events:', error));
}
loadAllEvents();

async function fetchEventImage(eventId) {
    return fetch(`../../api/event-api.php?eventId=${eventId}`)
        .then(response => response.json())
        .then(data => {
            return fetch(`../../api/image-api.php?id=${data.data.cover_image}`)
                .then(response => response.json())
                .then(imageData => {
                    return "../" + imageData.data;
                })
                .catch(error => {
                    console.error('Error fetching event cover image:', error);
                    return '../assets/images/default-event-cover.jpg';
                });
        });
}

async function openEvent(eventId) {
    const event = await fetchSingleEvent(eventId);

    if (!event) {
        return;
    }

    activeEventId = eventId;

    slideInEventDetailSlider();
    loadDetailedEventInfo(event);
}

async function loadDetailedEventInfo(event) {
    document.body.style.overflow = "hidden";

    let dateOfEvent = parseDate(event.startDate);

    let location = await fetchLocation(event.location_id);

    loadUsersPerEventCount(event.event_id);

    showDrinks(event.event_id);
    setActiveClass(document.getElementsByClassName('drinks-snacks-games-images-shared-with-grid-nav-item')[0], 'drinks-snacks-games-images-shared-with-grid-nav-item', 'active');

    let eventImage = await fetchEventImage(event.event_id);

    document.getElementById('event-title-header').innerText = event.name;
    document.getElementById('event-info-headline').innerText = event.name;
    document.getElementById('event-info-desc').innerText = event.describtion;
    document.getElementById('date-card-month').innerText = getMonth(dateOfEvent);
    document.getElementById('date-card-day').innerText = getDayOfMonth(dateOfEvent);
    document.getElementById('date-card-year').innerText = getYear(dateOfEvent);
    document.getElementById('event-info-full-description').innerText = event.describtion;
    loadDateDetails(event.startDate, event.endDate);
    document.getElementById('event-info-dress-code').innerText = event.dresscode_desc;
    document.getElementById('event-info-ranking').innerText = event.ranking + " / 5";
    document.getElementById('event-info-location-name').innerText = location.name;
    document.getElementById('event-info-location-description').innerText = location.description;
    document.getElementById('event-info-details-date-created-on').innerText = parseDate(event.startDate).getDate() + "." + parseDate(event.startDate).getMonth() + "." + getYear(parseDate(event.startDate));
    document.getElementById('event-details-main-image').style.background = `url('${eventImage}')`;
    document.getElementById('event-details-main-image').style.backgroundSize = "cover";
    document.getElementById('event-details-main-image').style.backgroundPosition = "center";
}

async function fetchLocation(locationId) {
    try {
        const response = await fetch(`../../api/location-api.php?locationId=${locationId}`);
        const data = await response.json();

        return data.data;
    } catch (error) {
        console.error('Error fetching location details:', error);
        return null;
    }
}

function loadDateDetails(startDate, endDate) {
    let dayOfWeek = getDayOfWeek(parseDate(startDate));
    let day = getDayOfMonth(parseDate(startDate));
    let month = getMonth(parseDate(startDate));
    let year = getYear(parseDate(startDate));

    document.getElementById('event-info-date').innerText = `${dayOfWeek}, ${day} ${month} ${year}`;

    let startTime = startDate.split(' ')[1].substring(0, 5);
    let endTime = endDate.split(' ')[1].substring(0, 5);

    document.getElementById('event-info-time').innerText = `${startTime} - ${endTime}`;

    let duration = getCorrectEventDurationFormat(calculateEventDuration(startDate, endDate));
    document.getElementById('event-info-duration').innerText = duration;
}

function slideInEventDetailSlider() {
    const slider = document.getElementById("event-detail-slider");

    slider.style.transform = "translateX(0)";
}

function closeEvent() {
    slideOutEventDetailSlider();

    document.body.style.overflow = "auto";
}

function slideOutEventDetailSlider() {
    const slider = document.getElementById("event-detail-slider");

    slider.style.transform = "translateX(100%)";
}

async function fetchSingleEvent(eventId) {
    try {
        const response = await fetch(`../../api/event-api.php?eventId=${eventId}`);
        const data = await response.json();

        return data.data;
    } catch (error) {
        console.error('Error fetching event details:', error);
        return null;
    }
}


/* Details functions */


/**
 * function: showDrinks
 * This function fetches the drinks associated with a specific event and displays them in the user interface. It makes an API call to retrieve the drinks for the given event ID, then iterates through the returned data to fetch additional details for each drink. Finally, it constructs HTML elements to display the drink information and updates the relevant section of the UI with this content.
 * 
 * @param {*} event_id 
 */
async function showDrinks(event_id) {
    const response = await fetch(`../../api/event-api.php?drinksPerEvent=${event_id}`);
    const data = await response.json();

    let temp_string = "";
    let count = 0;

    for (const drink of data.data) {
        const singleDrink = await fetchSingleDrink(drink.drink_id);
        count++;

        temp_string += `
                <div class="drink">
                    <div class='drink-name-description'>
                        <h3>${singleDrink.name}</h3>
                        <p>${singleDrink.describtion}</p>
                    </div>
                    <p>${drink.count}</p>
                </div>
                ` + (count !== data.data.length ? `<hr class="drink-divider">` : "");
    }

    document.getElementById('drinks-snacks-games-images-shared-with-content').innerHTML = temp_string;
    setDisplayOfDrinksSnacksGamesImagesSharedWithGrid("drinks");
}

/**
 * function: fetchSingleDrink
 * This function retrieves detailed information about a specific drink based on its ID. It sends a request to the backend API with the drink ID as a parameter, and upon receiving the response, it parses the JSON data and returns the relevant drink details. This function is typically used in conjunction with other functions that display drink information in the user interface, allowing for a more comprehensive presentation of each drink's attributes.
 * 
 * @param {*} drinkId 
 * @returns 
 */
async function fetchSingleDrink(drinkId) {
    const response = await fetch(`../../api/drink-api.php?drinkId=${drinkId}`);
    const data = await response.json();
    return data.data;
}


/**
 * function: showSnacks
 * This function is responsible for fetching and displaying the snacks associated with a specific event. It makes an API call to retrieve the snacks for the given event ID, then iterates through the returned data to fetch additional details for each snack. Finally, it constructs HTML elements to display the snack information and updates the relevant section of the UI with this content.
 * 
 * @param {*} event_id 
 */
async function showSnacks(event_id) {
    const response = await fetch(`../../api/event-api.php?snacksPerEvent=${event_id}`);
    const data = await response.json();

    console.log(data);

    let temp_string = "";
    let count = 0;

    for (const snack of data.data) {
        const singleSnack = await fetchSingleSnack(snack.snack_id);
        count++;

        temp_string += `
                <div class="snack">
                    <div class='snack-name-description'>
                        <h3>${singleSnack.name}</h3>
                        <p>${singleSnack.description}</p>
                    </div>
                    <p>${snack.count}</p>
                </div>
                ` + (count !== data.data.length ? `<hr class="snack-divider">` : "");
    }

    document.getElementById('drinks-snacks-games-images-shared-with-content').innerHTML = temp_string;
    setDisplayOfDrinksSnacksGamesImagesSharedWithGrid("snacks");
}

/**
 * function: fetchSingleSnack
 * This function retrieves detailed information about a specific snack based on its ID. It sends a request to the backend API with the snack ID as a parameter, and upon receiving the response, it parses the JSON data and returns the relevant snack details. This function is typically used in conjunction with other functions that display snack information in the user interface, allowing for a more comprehensive presentation of each snack's attributes.
 * @param {*} snackId 
 * @returns 
 */
async function fetchSingleSnack(snackId) {
    const response = await fetch(`../../api/snack-api.php?snackId=${snackId}`);
    const data = await response.json();
    return data.data;
}

async function showGames(event_id) {
    const response = await fetch(`../../api/event-api.php?gamesPerEvent=${event_id}`);
    const data = await response.json();
    console.log(data);

    let temp_string = "";
    let count = 0;

    for (const game of data.data) {
        const singleGame = await fetchSingleGame(game.game_id);
        count++;

        temp_string += `
                <div class="game">
                    <div class='game-name-description'>
                        <h3>${singleGame.name}</h3>
                        <p>${singleGame.description}</p>
                    </div>
                </div>
                ` + (count !== data.data.length ? `<hr class="game-divider">` : "");
    }

    document.getElementById('drinks-snacks-games-images-shared-with-content').innerHTML = temp_string;
    setDisplayOfDrinksSnacksGamesImagesSharedWithGrid("games");
}


/**
 * function: fetchSingleGame
 * This function retrieves detailed information about a specific game based on its ID. It sends a request to the backend API with the game ID as a parameter, and upon receiving the response, it parses the JSON data and returns the relevant game details. This function is typically used in conjunction with other functions that display game information in the user interface, allowing for a more comprehensive presentation of each game's attributes.
 * @param {*} gameId 
 * @returns 
 */
async function fetchSingleGame(gameId) {
    const response = await fetch(`../../api/game-api.php?gameId=${gameId}`);
    const data = await response.json();
    return data.data;
}


async function showImages(event_id) {
    const response = await fetch(`../../api/event-api.php?imagesPerEvent=${event_id}`);
    const data = await response.json();

    let temp_string = "";

    for (const image of data.data) {

        const eventImage = await fetch(`../../api/image-api.php?id=${image.image_id}`);
        const eventImageData = await eventImage.json();

        console.log(eventImageData);
        temp_string += `
                <div class="event-image">
                    <img src="../${eventImageData.data}" alt="Event Image">
                </div>
                `;
    }

    document.getElementById('drinks-snacks-games-images-shared-with-content').innerHTML = temp_string;
    setDisplayOfDrinksSnacksGamesImagesSharedWithGrid("images");
}



async function showShared(event_id) {
    const response = await fetch(`../../api/event-api.php?usersPerEvent=${event_id}`);
    const data = await response.json();

    let temp_string = "";
    let count = 0;

    for (const user of data.data) {
        count++;

        const userImage = await fetch(`../../api/image-api.php?id=${user.profile_image_id}`);
        const userImageData = await userImage.json();

        temp_string += `
                <div class="shared-user">
                    <div class='shared-user-info'>
                        <div class='shared-user-img'>
                            <img src="${resolveImageUrl(userImageData.data)}" alt="demo user">
                        </div>
                        <p>${user.username}</p>
                    </div>
                </div>
                ` + (count !== data.data.length ? `<hr class="shared-divider">` : "");
    }

    document.getElementById('drinks-snacks-games-images-shared-with-content').innerHTML = temp_string;
    setDisplayOfDrinksSnacksGamesImagesSharedWithGrid("shared");
}

function setDisplayOfDrinksSnacksGamesImagesSharedWithGrid(display) {
    const container = document.getElementById('drinks-snacks-games-images-shared-with-content');

    container.style.display = "";
    container.style.gridTemplateColumns = "";
    container.style.flexDirection = "";
    container.style.alignItems = "";
    container.style.gap = "";

    switch (display) {
        case "drinks":
        case "snacks":
        case "games":
        case "shared":
            container.style.display = "flex";
            container.style.flexDirection = "column";
            container.style.alignItems = "stretch";
            container.style.gap = "0em";
            container.style.justifyContent = "flex-start";
            break;

        case "images":
            container.style.display = "grid";
            container.style.gridTemplateColumns = "repeat(2, 170px)";
            container.style.justifyContent = "center";
            container.style.alignItems = "start";
            container.style.gap = "1em";
            break;

        default:
            container.style.display = "flex";
            container.style.flexDirection = "column";
            container.style.alignItems = "stretch";
            container.style.gap = "0em";
            container.style.justifyContent = "flex-start";
            break;
    }
}

/**
 * function: openAddEventSlider
 * Opens the add event slider by translating it into view and disabling body scroll
 */
function openAddEventSlider() {
    const addEventSlider = document.getElementById("add-event-slider");

    addEventSlider.style.transform = "translateX(0)";
    document.body.style.overflow = "hidden";
}

/**
 * function: closeAddEventSlider
 * Closes the add event slider by translating it out of view and re-enabling body scroll
 */
function closeAddEventSlider() {
    const addEventSlider = document.getElementById("add-event-slider");
    addEventSlider.style.transform = "translateX(100%)";
    document.body.style.overflow = "auto";

    const form = document.getElementById("add-event-form");
    form.reset();

    friendsToShareWith = [];
    snacksSelected = [];
    drinksSelected = [];
    gamesSelected = [];
    syncFriendsToShareWithInput();
    updateFriendsToShareWithCounter();
    searchFriendsToShareWith();
    searchSnacks();
    searchDrinks();
    searchGames();
    syncSnacksToInput();
    syncDrinksToInput();
    syncGamesToInput();
    imagesSelected = [];
    const imageInput = document.getElementById('event-images');
    if (imageInput) imageInput.value = '';
    // clear image preview when closing add-event slider
    const _imgPreview = document.getElementById('event-images-preview');
    if (_imgPreview) _imgPreview.innerHTML = '';
}


function openAddLocation() {
    const addLocationSlider = document.getElementById("add-location-slider");

    addLocationSlider.style.transform = "translateX(0)";
    document.body.style.overflow = "hidden";

}

function closeAddLocation() {
    const addLocationSlider = document.getElementById("add-location-slider");
    addLocationSlider.style.transform = "translateX(100%)";
    document.body.style.overflow = "auto";

    const form = document.getElementById("add-location-form");
    form.reset();

}

function openLocationSelect() {
    const locationSelectSlider = document.getElementById("select-location-slider");

    locationSelectSlider.style.transform = "translateX(0)";
    document.body.style.overflow = "hidden";
}

function closeLocationSelect() {
    const locationSelectSlider = document.getElementById("select-location-slider");
    locationSelectSlider.style.transform = "translateX(100%)";
    document.body.style.overflow = "auto";
}

function searchLocation() {
    const searchInput = document.getElementById("search-location").value.toLowerCase();

    fetch(`../../api/location-api.php?search=${searchInput}`)
        .then(response => response.json())
        .then(data => {
            let locations = data.data;
            let temp_string = "";

            locations.forEach(location => {
                temp_string += `
                <div class="location-search-result" onclick="selectLocation(${location.location_id})">
                    <h3>${location.name}</h3>
                    <p>${location.description}</p>
                </div>
                `
            });
            document.getElementById("search-location-results").innerHTML = temp_string;
        })
        .catch(error => console.error('Error searching locations:', error));

}


function selectLocation(locationId) {
    fetch(`../../api/location-api.php?locationId=${locationId}`)
        .then(response => response.json())
        .then(data => {
            let location = data.data;

            document.getElementById("event-location").innerHTML = location.name;
            document.getElementById("event-location-id").value = location.location_id;

            document.getElementById("search-location").value = "";
            document.getElementById("search-location-results").innerHTML = "";
        })
        .catch(error => console.error('Error selecting location:', error));

    closeLocationSelect();
}

let friendsToShareWith = [];
let snacksSelected = [];
let drinksSelected = [];
let gamesSelected = [];
let imagesSelected = [];

function syncFriendsToShareWithInput() {
    const hiddenInput = document.getElementById("event-shared-with-hidden");

    hiddenInput.value = JSON.stringify(friendsToShareWith);
}

function updateFriendsToShareWithCounter() {
    const counter = document.getElementById("add-event-shared-with-counter");

    counter.innerText = friendsToShareWith.length;
}

function searchFriendsToShareWith() {

    const query = document.getElementById("add-event-share-with-search").value.toLowerCase();

    console.log("Searching friends with query: " + query);

    console.log(`../../api/user-api.php?` + (query === "" ? "friends=true" : `searchFriends=${query}`))

    fetch(`../../api/user-api.php?` + (query === "" ? "friends=true" : `searchFriends=${query}`))
        .then(response => response.json())
        .then(data => {
            let users = data.data;
            let temp_string = "";

            console.log(users);

            users.forEach(user => {
                temp_string += `
                <div class="friend-found" id="friend-${user.userid}">
                    <div class="friend-found-img-name">
                        <div class="friend-found-img">
                            <img id="friend-${user.userid}-img-search" src="" alt="demo user">
                        </div>
                        <p>${user.username}</p>
                    </div>
                    <div id="friend-${user.userid}-add-btn" class="friend-found-add-btn ${friendsToShareWith.includes(user.userid) ? 'added' : ''}" onclick="addFriendToShareWith(${user.userid})">
                        ${friendsToShareWith.includes(user.userid) ? `<i class="fa-solid fa-check"></i>` : `<i class="fa-solid fa-plus"></i>`}
                    </div>
                </div>
                `

                fetch(`../../api/image-api.php?id=${user.profile_image_id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById(`friend-${user.userid}-img-search`).src = data.data;
                    });
            });

            document.getElementById("add-event-share-with-search-results").innerHTML = temp_string;
        })
        .catch(error => console.error('Error searching friends:', error));
}
searchFriendsToShareWith();

function addFriendToShareWith(friendId) {
    if (friendsToShareWith.includes(friendId)) {
        friendsToShareWith = friendsToShareWith.filter(id => id !== friendId);
        document.getElementById(`friend-${friendId}-add-btn`).classList.remove("added");
        document.getElementById(`friend-${friendId}-add-btn`).innerHTML = `<i class="fa-solid fa-plus"></i>`;
    } else {
        friendsToShareWith.push(friendId);
        document.getElementById(`friend-${friendId}-add-btn`).classList.add("added");
        document.getElementById(`friend-${friendId}-add-btn`).innerHTML = `<i class="fa-solid fa-check"></i>`;
    }

    syncFriendsToShareWithInput();
    updateFriendsToShareWithCounter();
}

updateFriendsToShareWithCounter();

function searchSnacks() {
    const query = document.getElementById("add-event-snacks-search").value.toLowerCase();

    fetch(`../../api/snack-api.php?search=${query}`)
        .then(response => response.json())
        .then(data => {
            let snacks = data.data;

            let temp_string = "";

            snacks.forEach(snack => {

                let isSelected = false;

                for (let i = 0; i < snacksSelected.length; i++) {
                    if (snacksSelected[i].snack_id === snack.snack_id) {
                        isSelected = true;
                        break;
                    }
                }

                temp_string +=
                    `
                <div class="snack-found" id="snack-${snack.snack_id}">
                    <div class="snack-found-name-description">
                        <h3>${snack.name}</h3>
                        <p>${snack.description}</p>
                    </div>
                    <div class="snack-found-add">
                        <div class="snacks-quantity-selection" id="snack-${snack.snack_id}-quantity-selection" style="display: ${isSelected ? "flex" : "none"}">
                            <input type="number" id="snack-${snack.snack_id}-quantity" class="snack-quantity-input" value="${isSelected ? snacksSelected.find(s => s.snack_id === snack.snack_id)?.count : 1}" min="1" onchange="updateSnackCount(${snack.snack_id})">
                        </div>
                        <div id="snack-${snack.snack_id}-add-btn" class="snack-found-add-btn ${isSelected ? 'added' : ''}" onclick="addSnackToEvent(${snack.snack_id})">
                        ${isSelected ? `<i class="fa-solid fa-check"></i>` : `<i class="fa-solid fa-plus"></i>`}
                        </div>
                    </div>
                </div>
                `
            });

            document.getElementById("add-event-snacks-search-results").innerHTML = temp_string;
        })
        .catch(error => console.error('Error searching snacks:', error));

}
searchSnacks();

function syncSnacksToInput() {
    const hiddenInput = document.getElementById("event-snacks-hidden");

    hiddenInput.value = JSON.stringify(snacksSelected);
    console.log("Synced snacks to input: " + hiddenInput.value);
}

function addSnackToEvent(snackId) {

    let exists = false;

    for (let i = 0; i < snacksSelected.length; i++) {
        if (snacksSelected[i].snack_id === snackId) {
            snacksSelected.splice(i, 1);
            document.getElementById(`snack-${snackId}-add-btn`).classList.remove("added");
            document.getElementById(`snack-${snackId}-add-btn`).innerHTML = `<i class="fa-solid fa-plus"></i>`;
            document.getElementById(`snack-${snackId}-quantity-selection`).style.display = "none";
            exists = true;
            break;
        }
    }

    if (!exists) {
        snacksSelected.push({ snack_id: snackId, count: 1 });
        document.getElementById(`snack-${snackId}-add-btn`).classList.add("added");
        document.getElementById(`snack-${snackId}-add-btn`).innerHTML = `<i class="fa-solid fa-check"></i>`;
        document.getElementById(`snack-${snackId}-quantity-selection`).style.display = "flex";
    }
    syncSnacksToInput();
}

function updateSnackCount(snackId) {
    const quantity = parseInt(document.getElementById(`snack-${snackId}-quantity`).value);

    for (let i = 0; i < snacksSelected.length; i++) {
        if (snacksSelected[i].snack_id === snackId) {
            snacksSelected[i].count = quantity;
            break;
        }
    }

    syncSnacksToInput();
}


function searchDrinks() {
    const query = document.getElementById("add-event-drinks-search").value.toLowerCase();

    fetch(`../../api/drink-api.php?search=${query}`)
        .then(response => response.json())
        .then(data => {
            let drinks = data.data;

            let temp_string = "";

            drinks.forEach(drink => {

                let isSelected = false;

                for (let i = 0; i < drinksSelected.length; i++) {
                    if (drinksSelected[i].drink_id === drink.drink_id) {
                        isSelected = true;
                        break;
                    }
                }

                temp_string +=
                    `
                <div class="drink-found" id="drink-${drink.drink_id}">
                    <div class="drinks-found-name-description">
                        <h3>${drink.name}</h3>
                        <p>${drink.describtion}</p>
                    </div>
                    <div class="drinks-found-add">
                        <div class="drink-quantity-selection" id="drink-${drink.drink_id}-quantity-selection" style="display: ${isSelected ? "flex" : "none"}">
                            <input type="number" id="drink-${drink.drink_id}-quantity" class="drink-quantity-input" value="${isSelected ? drinksSelected.find(d => d.drink_id === drink.drink_id)?.count : 1}" min="1" onchange="updateDrinkCount(${drink.drink_id})">
                        </div>
                        <div id="drink-${drink.drink_id}-add-btn" class="drink-found-add-btn ${isSelected ? 'added' : ''}" onclick="addDrinkToEvent(${drink.drink_id})">
                        ${isSelected ? `<i class="fa-solid fa-check"></i>` : `<i class="fa-solid fa-plus"></i>`}
                        </div>
                    </div>
                </div>
                `
            });

            document.getElementById("add-event-drinks-search-results").innerHTML = temp_string;
        })
        .catch(error => console.error('Error searching drinks:', error));

}
searchDrinks();

function syncDrinksToInput() {
    const hiddenInput = document.getElementById("event-drinks-hidden");

    hiddenInput.value = JSON.stringify(drinksSelected);
    console.log("Synced drinks to input: " + hiddenInput.value);
}

function addDrinkToEvent(drinkId) {

    let exists = false;

    for (let i = 0; i < drinksSelected.length; i++) {
        if (drinksSelected[i].drink_id === drinkId) {
            drinksSelected.splice(i, 1);
            document.getElementById(`drink-${drinkId}-add-btn`).classList.remove("added");
            document.getElementById(`drink-${drinkId}-add-btn`).innerHTML = `<i class="fa-solid fa-plus"></i>`;
            document.getElementById(`drink-${drinkId}-quantity-selection`).style.display = "none";
            exists = true;
            break;
        }
    }

    if (!exists) {
        drinksSelected.push({ drink_id: drinkId, count: 1 });
        document.getElementById(`drink-${drinkId}-add-btn`).classList.add("added");
        document.getElementById(`drink-${drinkId}-add-btn`).innerHTML = `<i class="fa-solid fa-check"></i>`;
        document.getElementById(`drink-${drinkId}-quantity-selection`).style.display = "flex";
    }
    syncDrinksToInput();
}

function updateDrinkCount(drinkId) {
    const quantity = parseInt(document.getElementById(`drink-${drinkId}-quantity`).value);

    for (let i = 0; i < drinksSelected.length; i++) {
        if (drinksSelected[i].drink_id === drinkId) {
            drinksSelected[i].count = quantity;
            break;
        }
    }

    syncDrinksToInput();
}


function searchGames() {
    const query = document.getElementById("add-event-games-search").value.toLowerCase();

    fetch(`../../api/game-api.php?search=${query}`)
        .then(response => response.json())
        .then(data => {
            const foundGames = data.data;

            let temp_string = "";

            foundGames.forEach(game => {
                let isSelected = false;

                for (let i = 0; i < gamesSelected.length; i++) {
                    if (gamesSelected[i] === game.game_id) {
                        isSelected = true;
                        break;
                    }
                }

                const selectedGame = gamesSelected.find(selected => selected === game.game_id);

                temp_string += `
                <div class="game-found" id="game-${game.game_id}">
                    <div class="game-found-name-description">
                        <h3>${game.name ?? game.Game_Name ?? "Game"}</h3>
                        <p>${game.description ?? game.describtion ?? ""}</p>
                    </div>
                    <div id="game-${game.game_id}-add-btn" class="game-found-add-btn ${isSelected ? 'added' : ''}" onclick="addGameToEvent(${game.game_id})">
                        ${isSelected ? `<i class="fa-solid fa-check"></i>` : `<i class="fa-solid fa-plus"></i>`}
                    </div>
                </div>
                `;
            });

            document.getElementById("add-event-games-search-results").innerHTML = temp_string;
        })
        .catch(error => console.error('Error searching games:', error));

}
searchGames();

function syncGamesToInput() {
    const hiddenInput = document.getElementById("event-games-hidden");

    hiddenInput.value = JSON.stringify(gamesSelected);
    console.log("Synced games to input: " + hiddenInput.value);
}

function addGameToEvent(gameId) {

    let exists = false;

    for (let i = 0; i < gamesSelected.length; i++) {
        if (gamesSelected[i] === gameId) {
            gamesSelected.splice(i, 1);
            document.getElementById(`game-${gameId}-add-btn`).classList.remove("added");
            document.getElementById(`game-${gameId}-add-btn`).innerHTML = `<i class="fa-solid fa-plus"></i>`;
            exists = true;
            break;
        }
    }

    if (!exists) {
        gamesSelected.push(gameId);
        document.getElementById(`game-${gameId}-add-btn`).classList.add("added");
        document.getElementById(`game-${gameId}-add-btn`).innerHTML = `<i class="fa-solid fa-check"></i>`;
    }
    syncGamesToInput();
}


function syncInputFiles() {
    const dt = new DataTransfer();
    imagesSelected.forEach(f => dt.items.add(f));
    document.getElementById("event-images").files = dt.files;
}

function addImageToEvent() {
    const preview = document.getElementById("event-images-preview");
    preview.innerHTML = "";

    if (imagesSelected.length == 0) {
        preview.innerHTML = '<div class="placeholder">No images selected yet</div>';
        return;
    }

    imagesSelected.forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = e => {
            const item = document.createElement("div");
            item.className = "image-preview-item";
            item.innerHTML = `
                <img src="${e.target.result}" alt="${file.name}">
                <div class="image-preview-remove" onclick="removeImageFromSelection(${i})">
                    <i class="fa-solid fa-xmark"></i>
                </div>`;
            preview.appendChild(item);
        };
        reader.readAsDataURL(file);
    });
}

function removeImageFromSelection(index) {
    imagesSelected.splice(index, 1);
    syncInputFiles();
    addImageToEvent();
}

document.getElementById("event-images").addEventListener("change", function (event) {
    for (const file of event.target.files) {
        if (!imagesSelected.some(f => f.name === file.name && f.size === file.size && f.lastModified === file.lastModified)) {
            imagesSelected.push(file);
        }
    }
    syncInputFiles();
    addImageToEvent();
});

addImageToEvent();

document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('addEvent') === 'true') {
        openAddEventSlider();
    }
});