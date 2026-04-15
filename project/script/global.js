/**
 * Global JavaScript file for the project.
 * 
 * This file contains JavaScript code that is used across the entire project. It includes functions and event listeners that are necessary for the overall functionality of the website.
 */

// Resolve the project root from the loaded global.js script URL.
const projectRootUrl = (() => {
    const globalScript = document.querySelector('script[src*="script/global.js"]');

    if (!globalScript) {
        return new URL("./", window.location.href);
    }

    return new URL("../", globalScript.src);
})();



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


/**
 * function: spinToggleButton
 * Description: This function rotates the toggle button when the navigation menu is toggled. It takes a rotation parameter (0 or 1) and applies a CSS transform to rotate the button accordingly.
 * @param {*} rotation 
 */
function spinToggleButton(rotation) {
    const toggleButton = document.getElementById("navigation-inner-toggle-button");

    toggleButton.style.transform = `rotate(${180 * rotation}deg)`;
}


/**
 * function: navigationTo
 * Description: This function is used to navigate to a different page when a link in the navigation menu is clicked. It takes the target page as a parameter and changes the window location to that page.
 * @param {*} page 
 */
function navigationTo(page) {
    // Supports values like "index.html", "pages/friends.html", or absolute URLs.
    window.location.href = new URL(page, projectRootUrl).href;
}

function setActiveClass(element,className, activeClassName) {
    const navItems = document.querySelectorAll(`.${className}`);
    navItems.forEach(item => {
        item.classList.remove(activeClassName);
    });

    element.classList.add(activeClassName);
}