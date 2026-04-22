/**
 * @author Julian Warlischek
 * @description This is the main script for the project. It initializes the application and handles user interactions.
 */

let previousNode = 0;


function slideTo(anchorPosition) {
    const targetElement = document.getElementById(anchorPosition);

    let currentNode = getPathNode(anchorPosition);

    fadeOut()
    previousNode = currentNode;
}

function getPathNode(anchorPosition) {
    if (anchorPosition === "home-landing-section") {
        return 0;
    } else {
        return parseInt(anchorPosition.split("-")[2]);
    }
}

function fadeOut(element, duration) {
    element.style.transition = `opacity ${duration}ms ease-in-out`;
    element.style.opacity = 0;

    setTimeout(() => {
        element.style.transition = "none";
    }, duration);
}

function fadeIn(element, duration) {
    element.style.transition = `opacity ${duration}ms ease-in-out`;
    element.style.opacity = 1;

    setTimeout(() => {
        element.style.transition = "none";
    }, duration);
}