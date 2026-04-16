<?php
require './database.php';

$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => null
];


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE userId = $id";
    $result = $conn->query($sql);
    $answer["data"] = $result->fetch_assoc();
} else {
    $answer["code"] = 400;
    $answer["message"] = "Bad Request";
    $answer["data"] = ["error" => "No user ID provided"];
}

if(isset($_GET['friends'])){
    $id = 1;
    $sql = "SELECT username FROM users WHERE userId IN (SELECT userId1 FROM Friends_With WHERE userId=$id)";
    $result = $conn->query($sql);
    $answer["data"] = $result->fetch_assoc();
}


echo json_encode($answer);

$conn->close();