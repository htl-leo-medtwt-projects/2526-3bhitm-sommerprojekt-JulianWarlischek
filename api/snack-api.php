<?php
require './database.php';

$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => null
];

$stmt = $conn->prepare("SELECT * FROM Snack");
$stmt->execute();
$result = $stmt->get_result();
$answer["data"] = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_GET['snackId'])) {
    $stmt = $conn->prepare("SELECT * FROM Snack WHERE Snack_ID = ?");
    $stmt->bind_param("i", $_GET['snackId']);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);

$conn->close();