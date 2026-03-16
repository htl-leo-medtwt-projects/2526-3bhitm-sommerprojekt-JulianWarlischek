/**
 * Global JavaScript file for the project.
 * 
 * This file contains JavaScript code that is used across the entire project. It includes functions and event listeners that are necessary for the overall functionality of the website.
 */



/**
 * function: toggleNavigation
 * Description: This function toggles the visibility of the navigation menu when the toggle button is clicked. It adds or removes the "active" class from the navigation menu, which controls its display.
 * 
 * 
 */
function toggleNavigation() {
    const navigation = document.getElementById("navigation");

    if (navigation.style.transform === "translateX(0%)") {
        navigation.style.transform = "translateX(-100%)";
        spinToggleButton(0);
    } else {
        navigation.style.transform = "translateX(0%)";
        spinToggleButton(1);
    }
}

function spinToggleButton(rotation) {
    const toggleButton = document.getElementById("navigation-inner-toggle-button");

    toggleButton.style.transform = `rotate(${180 * rotation}deg)`;
}
