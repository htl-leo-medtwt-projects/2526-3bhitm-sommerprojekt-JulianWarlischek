<?php
require './database.php';

$answer = [
    "code" => 404,
    "message" => "Not found",
    "data" => null
];

if (isset($_GET['locationId'])) {
    $stmt = $conn->prepare("SELECT * FROM Location WHERE Location_ID = ?");
    $stmt->bind_param("i", $_GET['locationId']);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);

$conn->close();