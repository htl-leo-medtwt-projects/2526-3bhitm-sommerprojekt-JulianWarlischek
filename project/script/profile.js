function logout() {
    window.location.href = "../../api/login-register/logout.php";
}

function openBadges() {
    const badgeSlider = document.getElementById("profile-badge-slider");

    badgeSlider.style.pointerEvents = "all";

    document.body.style.overflow = "hidden";

    badgeSlider.style.opacity = "1";
}

function closeBadges() {
    const badgeSlider = document.getElementById("profile-badge-slider");

    badgeSlider.style.pointerEvents = "none";

    document.body.style.overflow = "auto";
    badgeSlider.style.opacity = "0";
}

function openMyDataSection() {
    const myDataSlider = document.getElementById("profile-my-data-slider");

    myDataSlider.style.transform = "translateX(0)";
    document.body.style.overflow = "hidden";
}

function closeMyDataSection() {
    const myDataSlider = document.getElementById("profile-my-data-slider");

    myDataSlider.style.transform = "translateX(100%)";
    document.body.style.overflow = "auto";
}

function loadProfileImage() {
    fetch("../../api/user-api.php?id=" + sessionStorage.getItem("user"))
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (!data.data.profile_image_id) {
                console.log("No profile image set");
                return;
            }

            fetch("../../api/image-api.php?id=" + data.data.profile_image_id)
                .then(response => response.json())
                .then(imageData => {
                    document.getElementById("profile-image").src = imageData.data;
                });
        });
}
loadProfileImage();

function loadBadgesOfUser() {
    fetch("../../api/badge-api.php?userId=" + sessionStorage.getItem("user"))
        .then(response => response.json())
        .then(data => {
            let temp_string = "";

            console.log(data);


            for (let i = 0; i < data.data.length; i++) {
                temp_string += `
                <div class='user-badge' onclick="openBadgeInfo(${data.data[i].badge_id})">`;

                if (i % 2 === 0) {
                    temp_string += `<div class='user-badge-info liquidGlass-wrapper'>
                        <div class='liquidGlass-effect'></div>
                        <div class='liquidGlass-tint'></div>
                        <div class='liquidGlass-shine'></div>

                        <p>${data.data[i].badgename}</p>
                    </div>
                    <div class='user-badge-img'>
                        <img src='../${data.data[i].badgepath}' alt='${data.data[i].badgename}'>
                    </div>`;
                }
                else {
                    temp_string += `<div class='user-badge-img'>
                        <img src='../${data.data[i].badgepath}' alt='${data.data[i].badgename}'>
                    </div>
                    <div class='user-badge-info liquidGlass-wrapper'>
                        <div class='liquidGlass-effect'></div>
                        <div class='liquidGlass-tint'></div>
                        <div class='liquidGlass-shine'></div>

                        <p>${data.data[i].badgename}</p>
                    </div>`;
                }

                temp_string += `</div>`;

                if (i !== data.data.length - 1) {
                    temp_string += `<hr class="user-badge-seperator">`;
                }

            }

            document.getElementById("profile-badges").innerHTML = temp_string;
        });
}
loadBadgesOfUser();

// Auto-open sliders based on URL parameters (Copilot generated code)
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('myData') === 'true') {
        openMyDataSection();
    }
    if (urlParams.get('badge') === 'true') {
        openBadges();
    }
});


function openBadgeInfo(badgeId) {
    const badgeInfo = document.getElementById("badge-info");

    badgeInfo.style.transform = "translateY(0)";
    document.body.style.overflow = "hidden";

    document.getElementById("remove-badge").addEventListener("click", function () {
        fetch(`../../api/badge-api.php?removeBadge=${badgeId}&userId=${sessionStorage.getItem("user")}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                closeBadgeInfo();
                loadBadgesOfUser();
            })
            .catch(error => {
                console.error('Error removing badge:', error);
            });
    });

    fetch("../../api/badge-api.php?badgeId=" + badgeId)
        .then(response => response.json())
        .then(data => {
            const badge = data.data;

            console.log(data);


            document.getElementById("badge-info-name").textContent = badge.badgename;
            document.getElementById("badge-info-description").textContent = badge.description;
            document.getElementById("badge-info-img").innerHTML = `<img src='../${badge.badgepath}' alt='${badge.badgename}'>`;
        }).catch(error => {
            console.error('Error fetching badge info:', error);
        });
}

function closeBadgeInfo() {
    const badgeInfo = document.getElementById("badge-info");

    badgeInfo.style.transform = "translateX(100%)";
    document.body.style.overflow = "auto";
}

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


    if (document.getElementsByClassName("badge-select-item")[badgeId - 1].classList.contains("badge-selected")) {
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

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('badge-select-form');
    const badgesInput = document.getElementById('selected-badges');

    if (form && badgesInput) {
        form.addEventListener('submit', function (event) {
            badgesInput.value = JSON.stringify(selectedBadges);
        });
    }
});

function slideInGallery() {
    const gallerySlider = document.getElementById("gallery-slider");

    gallerySlider.style.transform = "translateX(0)";
    document.body.style.overflow = "hidden";
}

function closeGallerySlider() {
    const gallerySlider = document.getElementById("gallery-slider");
    gallerySlider.style.transform = "translateX(100%)";
    document.body.style.overflow = "auto";
}

function loadGallery() {
    fetch("../../api/user-api.php?gallery=true")
        .then(response => response.json())
        .then(data => {
            let temp_string = "";

            console.log(data);


            data.data.forEach(image => {

                console.log(image);
                temp_string += `
                <div class="gallery-image">
                    <img src="../${image.path}" alt="Gallery Image">
                </div>
                `
            });

            document.getElementById("gallery-content").innerHTML = temp_string;
        })
        .catch(error => {
            console.error('Error fetching gallery images:', error);
        });
}
loadGallery();

document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('gallery') === 'true') {
        slideInGallery();
    }
});