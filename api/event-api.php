<?php
require './database.php';

$stmt = $conn->prepare("SELECT * FROM Event");
$stmt->execute();
$result = $stmt->get_result();


$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => $result->fetch_all(MYSQLI_ASSOC)
];

$id = 2; // Simulates the logged in user with ID 2

if(isset($_GET['eventId'])) {

    $stmt = $conn->prepare("SELECT * FROM Event WHERE EventID = ?");
    $stmt->bind_param("i", $_GET['eventId']);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);

$conn->close();