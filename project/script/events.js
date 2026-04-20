/**
 * This file contains the JavaScript code for handling events in the user interface of the social media application. It listens for user interactions such as button clicks and form submissions, and makes AJAX requests to the backend API to perform actions like fetching user data, sending friend requests, and accepting friend requests. The responses from the API are then used to update the UI accordingly.
 * @author Julian Warlischek
 */


function loadAllEvents() {
    fetch('../../api/event-api.php')
        .then(response => response.json())
        .then(data => {
            let events = data.data;
            let temp_string = "";

            events.forEach(event => {
                temp_string += `
                <div class="event liquidGlass-wrapper">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="event-left">
                        <h1>${event.Name}</h1>
                        <p>${event.Event_Date}</p>
                    </div>
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