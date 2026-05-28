<?php
require './database.php';

$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => null
];

$stmt = $conn->prepare("SELECT * FROM Drink");
$stmt->execute();
$result = $stmt->get_result();
$answer["data"] = $result->fetch_all(MYSQLI_ASSOC);


if (isset($_GET['drinkId'])) {
    $stmt = $conn->prepare("SELECT * FROM Drink WHERE Drink_ID = ?");
    $stmt->bind_param("i", $_GET['drinkId']);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['search'])) {
    $searchTerm = '%' . $_GET['search'] . '%';
    $stmt = $conn->prepare("SELECT * FROM Drink WHERE Name LIKE ?");
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);
$conn->close();