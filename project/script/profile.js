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

function loadBadgesOfUser() {
    fetch("../../api/badge-api.php?userId=" + sessionStorage.getItem("user"))
        .then(response => response.json())
        .then(data => {
            let temp_string = "";

            for (let i = 0; i < data.data.length; i++) {
                temp_string += `
                <div class='user-badge'>`
                   
                if(i % 2 === 0) {
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

                if(i !== data.data.length - 1) {
                    temp_string += `<hr class="user-badge-seperator">`;
                }
               
            }

            document.getElementById("profile-badges").innerHTML = temp_string;
        });
}
loadBadgesOfUser();
