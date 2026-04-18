<?php
require './database.php';

$answer = [
    "code" => 404,
    "message" => "Not found",
    "data" => null
];


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM User WHERE UserID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['friends'])) {
    $id = 1;
    $stmt = $conn->prepare("SELECT * FROM User u WHERE u.UserID IN (SELECT f.UserID1 FROM Friend_Ship f WHERE f.UserID = ? OR f.UserID1 = ?)");
    $stmt->bind_param("ii", $id, $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['requests'])){
    $id = 1;

    $stmt = $conn->prepare("SELECT * FROM User u WHERE u.UserID IN (SELECT f.UserID1 FROM Friend_Request f WHERE f.UserID = ? and f.status = 'Pending')");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}


echo json_encode($answer);

$conn->close();