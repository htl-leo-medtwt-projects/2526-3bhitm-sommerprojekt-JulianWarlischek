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
                <div class="event liquidGlass-wrapper" onclick="openEvent(${event.event_id})">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="event-left">
                        <h1>${event.name}</h1>
                        <p>${event.date}</p>
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

async function openEvent(eventId) {
    const event = await fetchSingleEvent(eventId);

    if (!event) {
        return;
    }

    slideInEventDetailSlider();
    loadDetailedEventInfo(event);
}

function loadDetailedEventInfo(event) {
    console.log(event);

    document.body.style.overflow = "hidden";

    document.getElementById('event-title-header').innerText = event.name;
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