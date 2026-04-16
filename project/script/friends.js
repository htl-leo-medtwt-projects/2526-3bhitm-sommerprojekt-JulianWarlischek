/**
 * @author Julian Warlischek
 * @description This file contains the JavaScript code for the friends page.
 * It handles the functionality of adding and removing friends, as well as displaying the list of friends.
 * The code is written in vanilla JavaScript and uses the Fetch API to communicate with the backend.
 * The backend is implemented in PHP and uses a MySQL database to store the friends data.
 */

function loadAllFriends(){
    fetch('../api/user-api.php?friends=true')
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error fetching friends:', error);
    }); 
}
loadAllFriends();