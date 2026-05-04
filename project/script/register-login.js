let selectedBadges = []; // Array to store selected badge IDs

function openBadgeSlider() {
    const badgeSlider = document.getElementById("badge-select-slider");

    badgeSlider.style.transform = "translateX(0)";
}

function closeBadgeSlider() {
    const badgeSlider = document.getElementById("badge-select-slider");

    badgeSlider.style.transform = "translateX(100%)";
}

function loadBadges() {
    fetch("../../api/badge-api.php")
        .then(response => response.json())
        .then(data => {
            let temp_string = "";

            data.data.forEach(badge => {
                temp_string += `
                <div class="badge-select-item" onclick="selectBadge(${badge.badge_id})">
                    <div class="badge-select-item-info liquidGlass-wrapper">
                        <div class="liquidGlass-effect"></div>
                        <div class="liquidGlass-tint"></div>
                        <div class="liquidGlass-shine"></div>

                        <p>${badge.badgename}</p>
                    </div>
                    <div class="badge-select-item-img">
                        <img src="../${badge.badgepath}" alt="${badge.badgename}">
                    </div>
                </div>
                `
            });

            document.getElementById("badge-slider").innerHTML = temp_string;
        });
}
loadBadges();

function selectBadge(badgeId) {

    
    if(document.getElementsByClassName("badge-select-item")[badgeId - 1].classList.contains("badge-selected")) {
        document.getElementsByClassName("badge-select-item")[badgeId - 1].classList.remove("badge-selected");
        document.getElementsByClassName("badge-select-item-info")[badgeId - 1].style.backgroundColor = "transparent";
        const idx = selectedBadges.indexOf(badgeId);
        if (idx !== -1) selectedBadges.splice(idx, 1);
    } else {
        document.getElementsByClassName("badge-select-item")[badgeId - 1].classList.add("badge-selected");
        document.getElementsByClassName("badge-select-item-info")[badgeId - 1].style.backgroundColor = "dodgerblue";
        selectedBadges.push(badgeId);
    }

    console.log(selectedBadges);

}

//Copilot generated code
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('register-form');
    const badgesInput = document.getElementById('register-badges');
    if (form && badgesInput) {
        form.addEventListener('submit', function () {
            badgesInput.value = JSON.stringify(selectedBadges);
        });
    }
});