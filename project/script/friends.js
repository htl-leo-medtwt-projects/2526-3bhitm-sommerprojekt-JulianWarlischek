/**
 * @author Julian Warlischek
 * @description This file contains the JavaScript code for the friends page.
 * It handles the functionality of adding and removing friends, as well as displaying the list of friends.
 * The code is written in vanilla JavaScript and uses the Fetch API to communicate with the backend.
 * The backend is implemented in PHP and uses a MySQL database to store the friends data.
 */

function loadAllFriends() {
    fetch('../../api/user-api.php?friends=true')
        .then(response => response.json())
        .then(data => {

            let friends = data.data;
            let temp_string = "";

            friends.forEach(friend => {
                console.log(friend);

                temp_string += `<div class="friend liquidGlass-wrapper">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="friend-img">
                        <img src="../assets/images/demo-user.png" alt="demo user">
                    </div>

                    <div class="friend-name">
                        <h3>${friend.Name}</h3>
                    </div>

                    <div class="friend-badge-flex" id="friend-${friend.UserID}-badges">
                    </div>
                </div>`;
                loadBadgesFromUser(friend.UserID);
            });
            document.getElementById('friends-main-section-content').innerHTML = temp_string;
            loadFriendCount();

        })
        .catch(error => {
            console.error('Error fetching friends:', error);
        });
}
setFriendsMainSection('grid');



/**
 * function: setFriendsMainSection
 * description: This function sets the display of the friends main section based on the given display parameter.
 * It takes a display parameter which can be 'grid', 'flex1' or 'flex2'. Based on the value of the display parameter, it sets the CSS properties of the friends main section accordingly.
 * If the display parameter is 'grid', it sets the display to grid and defines the grid template columns and alignment. It then calls the loadAllFriends function to load and display all friends in a grid layout.
 * @param {*} display 
 */
function setFriendsMainSection(display) {
    const friendsMainSection = document.getElementById('friends-main-section-content');

    if (display === 'grid') {
        friendsMainSection.style.display = 'grid';
        friendsMainSection.style.gridTemplateColumns = 'repeat(2, minmax(0, 1fr))';
        friendsMainSection.style.alignItems = 'start';
        loadAllFriends();
    } else if (display === 'flex1') {
        friendsMainSection.style.display = 'flex';
        friendsMainSection.style.flexDirection = 'column';
        friendsMainSection.style.alignItems = 'center';
        loadAllRequests();
    } else if (display === 'flex2') {
        friendsMainSection.style.display = 'flex';
        friendsMainSection.style.flexDirection = 'column';
        friendsMainSection.style.alignItems = 'center';
        loadAllSentRequests();
    }

}

/**
 * function: loadAllRequests
 * description: This function loads all friend requests from the backend and displays them in the friends main section. It uses the Fetch API to send a GET request to the user-api.php endpoint with the parameter 'requests=true'. The response is expected to be in JSON format, containing an array of friend requests. The function then iterates over the array of friend requests and creates HTML elements for each request, displaying the name of the requester and buttons to accept or decline the request. Finally, it sets the innerHTML of the friends main section to the generated HTML string.
 */
async function loadAllRequests() {
    fetch('../../api/user-api.php?requests=true')
        .then(response => response.json())
        .then(async data => {
            let requests = data.data;
            let temp_string = "";

            for (const request of requests) {
                console.log(request);

                const request_id = await getRequestId(2, request.UserID);


                temp_string += `<div class="friend-request liquidGlass-wrapper">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="friend-request-info">
                        <div class="friend-img">
                            <img src="../assets/images/demo-user.png" alt="demo user">
                        </div>

                        <div class="friend-name">
                            <h3>${request.Name}</h3>
                        </div>
                    </div>
                    <div class="friend-request-buttons">
                        <div class="accept-button" onclick="acceptFriendRequest('${request_id}')">+ Add</div>
                        <div class="decline-button" onclick="declineFriendRequest('${request_id}')"><i class="fa-solid fa-xmark"></i></div>
                    </div>
                </div>`;
            }
            document.getElementById('friends-main-section-content').innerHTML = temp_string;
            loadFriendCount();
        })
        .catch(error => {
            console.error('Error fetching friend requests:', error);
        });
}

async function getRequestId(userId, requesterId) {
    try {
        const response = await fetch(`../../api/user-api.php?getRequestId=true&userId=${userId}&requesterId=${requesterId}`);
        const data = await response.json();
        console.log(data);

        return data?.data ?? null;
    } catch (error) {
        console.error('Error fetching request ID:', error);
        return null;
    }
}

/**
 * function: acceptFriendRequest
 * description: This function is used to accept a friend request. It takes the requestId as a parameter and sends a POST request to the user-api.php endpoint with the parameter 'acceptRequest' set to the requestId. If the request is successful, it reloads the list of friend requests by calling the loadAllRequests function. If there is an error, it logs the error to the console.
 * @param {*} requestId 
 */
function acceptFriendRequest(requestId) {
    fetch(`../../api/user-api.php?acceptRequest=${requestId}`, {
        method: 'POST'
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            loadAllRequests();
        })
        .catch(error => {
            console.error('Error accepting friend request:', error);
        });
}


/**
 * function: declineFriendRequest
 * description: This function is used to decline a friend request. It takes the requestId as a parameter and sends a POST request to the user-api.php endpoint with the parameter 'declineRequest' set to the requestId. If the request is successful, it reloads the list of friend requests by calling the loadAllRequests function. If there is an error, it logs the error to the console.
 * @param {*} requestId 
 */
function declineFriendRequest(requestId) {
    fetch(`../../api/user-api.php?declineRequest=${requestId}`, {
        method: 'POST'
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            loadAllRequests();
        })
        .catch(error => {
            console.error('Error declining friend request:', error);
        });
}

function openAddFriends() {
    const addFriendsSection = document.getElementById('add-friends-section');

    addFriendsSection.style.display = 'flex';
    setTimeout(() => {
        addFriendsSection.style.opacity = '1';
    }, 100);

}

function searchUsers() {
    const searchInput = document.getElementById('add-friends-search-input');
    const query = searchInput.value.trim();

    if (query.length === 0) {
        return;
    }

    fetch(`../../api/user-api.php?searchUsers=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            const users = data.data;

            let temp_string = "";

            users.forEach(user => {
                temp_string += `
                    <hr class="seperator-long">
                    <div class="friend-found">
                        <div class="friend-found-img-name">
                            <div class="friend-found-img">
                                <img src="../assets/images/demo-user.png" alt="demo user">
                            </div>
                            <p>${user.Name}</p>
                        </div>
                        <p class="request-button" onclick="sendFriendRequest(${user.UserID})">send request</p>
                    </div>
                `
            });

            document.getElementById('add-friends-friends-found').innerHTML = temp_string;

        })
        .catch(error => {
            console.error('Error searching users:', error);
        });
}

function closeAddFriends() {
    const addFriendsSection = document.getElementById('add-friends-section');

    addFriendsSection.style.opacity = '0';
    setTimeout(() => {
        addFriendsSection.style.display = 'none';
    }, 300);

    searchInput.value = "";

}

function sendFriendRequest(userId) {
    fetch(`../../api/user-api.php?sendFriendRequest=${userId}`, {
        method: 'POST'
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            closeAddFriends();
        })
        .catch(error => {
            console.error('Error sending friend request:', error);
        }
        );
}

function loadBadgesFromUser(userId) {
    fetch(`../../api/badge-api.php?userId=${userId}`)
        .then(response => response.json())
        .then(data => {
            const badges = data.data;


            let temp_string = "";

            badges.forEach(badge => {
                temp_string += `
                        <div class="friend-badge">
                            <div class="badge-img">
                                <img src="../assets/images/music-badge.png" alt="music badge">
                            </div>
                            <p class="badge-name">${badge.BadgeName}</p>
                        </div>
                        `;
            });

            document.getElementById(`friend-${userId}-badges`).innerHTML = temp_string;
        })
        .catch(error => {
            console.error('Error fetching badges:', error);
        });
}