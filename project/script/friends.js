/**
 * @author Julian Warlischek
 * @description This file contains the JavaScript code for the friends page.
 * It handles the functionality of adding and removing friends, as well as displaying the list of friends.
 * The code is written in vanilla JavaScript and uses the Fetch API to communicate with the backend.
 * The backend is implemented in PHP and uses a MySQL database to store the friends data.
 */

function loadAllFriends(){
    fetch('../../api/user-api.php?friends=true')
    .then(response => response.json())
    .then(data => {

        let friends = data.data;
        let temp_string = "";

        friends.forEach(friend => {
            temp_string += `
                <div class="friend liquidGlass-wrapper">
                    <div class="liquidGlass-effect"></div>
                    <div class="liquidGlass-tint"></div>
                    <div class="liquidGlass-shine"></div>

                    <div class="friend-img">
                        <img src="../assets/images/demo-user.png" alt="demo user">
                    </div>

                    <div class="friend-name">
                        <h3>${friend.name}</h3>
                    </div>

                    <div class="friend-badge-flex">
                        <div class="friend-badge">
                            <div class="badge-img">
                                <img src="../assets/images/music-badge.png" alt="music badge">
                            </div>
                            <p class="badge-name">Music</p>
                        </div>
                        <div class="friend-badge">
                            <div class="badge-img">
                                <img src="../assets/images/shot-badge.png" alt="shot badge">
                            </div>
                            <p class="badge-name">Shotter</p>
                        </div>
                    </div>
                </div>
            `;
        });
        document.getElementById('friends-main-section-content').innerHTML = temp_string;
    })
    .catch(error => {
        console.error('Error fetching friends:', error);
    }); 
}
loadAllFriends();