/**
 * @author Julian Warlischek
 * @description This is the main script for the project. It initializes the application and handles user interactions.
 */

let previousNode = 0;


function slideTo(anchorPosition) {
    const targetElement = document.getElementById(anchorPosition);


    let currentNode = getPathNode(anchorPosition);

    window.location = anchorPosition;
}

function getPathNode(anchorPosition) {
    if (anchorPosition === "home-landing-section") {
        return 0;
    } else {
        return parseInt(anchorPosition.split("-")[2]);
    }
}