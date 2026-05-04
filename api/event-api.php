<?php
session_start();
require './database.php';

$stmt = $conn->prepare("SELECT * FROM Event where Event_ID IN (SELECT Event_ID FROM User_Event WHERE UserID = ?) order by startDate");
$stmt->bind_param("i", $_SESSION['user']['userid']);
$stmt->execute();
$result = $stmt->get_result();


$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => $result->fetch_all(MYSQLI_ASSOC)
];

$id = 2; // Simulates the logged in user with ID 2

if (isset($_GET['eventId'])) {

    $stmt = $conn->prepare("SELECT * FROM Event WHERE Event_ID = ? ");
    $stmt->bind_param("i", $_GET['eventId']);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['userPerEvent'])) {
    $stmt = $conn->prepare("SELECT count(*) as count FROM User_Event WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['userPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['drinksPerEvent'])){
    $stmt = $conn->prepare("SELECT * FROM Event_Drink WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['drinksPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['snacksPerEvent'])){
    $stmt = $conn->prepare("SELECT * FROM Event_Snack WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['snacksPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['gamesPerEvent'])){
    $stmt = $conn->prepare("SELECT * FROM Event_Game WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['gamesPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['usersPerEvent'])){
    $stmt = $conn->prepare("SELECT * FROM User u WHERE u.UserID IN (SELECT ue.UserID FROM User_Event ue WHERE ue.Event_ID = ?)");
    $stmt->bind_param("i", $_GET['usersPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);
$conn->close();