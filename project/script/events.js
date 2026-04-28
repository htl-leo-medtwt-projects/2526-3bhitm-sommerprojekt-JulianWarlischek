/**
 * This file contains the JavaScript code for handling events in the user interface of the social media application. It listens for user interactions such as button clicks and form submissions, and makes AJAX requests to the backend API to perform actions like fetching user data, sending friend requests, and accepting friend requests. The responses from the API are then used to update the UI accordingly.
 * @author Julian Warlischek
 */
let activeEventId = null;
let userId = 2; // This should be dynamically set based on the logged-in user


function loadAllEvents() {
    fetch('../../api/event-api.php')
        .then(response => response.json())
        .then(data => {
            let events = data.data;
            let temp_string = "";

            console.log(events);


            events.forEach(event => {
                temp_string += `
                <div class="event liquidGlass-wrapper" onclick="openEvent(${event.event_id})">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="event-left">
                        <h1>${event.name}</h1>
                        <p>${event.startDate.split(' ')[0]}</p>`
                    + (userId === event.master_userid ? `<div class='admin-event-icon'>
                            <i class="fa-solid fa-crown"></i>
                        </div>` : "") +
                    `</div>
                    <div class="event-right">
                    </div>
                </div>
                `
            });

            document.getElementById("event-flex").innerHTML = temp_string;
        })
        .catch(error => console.error('Error fetching events:', error));
}
loadAllEvents();

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
    console.log(event);

    document.body.style.overflow = "hidden";

    let dateOfEvent = parseDate(event.startDate);

    let location = await fetchLocation(event.location_id);

    loadUsersPerEventCount(event.event_id);

    showDrinks(event.event_id);
    setActiveClass(document.getElementsByClassName('drinks-snacks-games-images-shared-with-grid-nav-item')[0], 'drinks-snacks-games-images-shared-with-grid-nav-item', 'active');

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

async function showShared(event_id) {
    const response = await fetch(`../../api/event-api.php?usersPerEvent=${event_id}`);
    const data = await response.json();
    console.log(data);

    let temp_string = "";
    let count = 0;

    for (const user of data.data) {
        count++;

        temp_string += `
                <div class="shared-user">
                    <div class='shared-user-info'>
                        <div class='shared-user-img'>
                            <img src="../assets/images/demo-user.png" alt="demo user">
                        </div>
                        <p>${user.username}</p>
                    </div>
                </div>
                ` + (count !== data.data.length ? `<hr class="shared-divider">` : "");
    }

    document.getElementById('drinks-snacks-games-images-shared-with-content').innerHTML = temp_string;
}