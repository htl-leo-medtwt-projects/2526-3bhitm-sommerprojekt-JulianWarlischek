<?php
session_start();

$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => null
];

if (isset($_SESSION['user'])) {

    $user = $_SESSION['user'];


    $answer["data"] = $user;
    $answer["message"] = "User is logged in";
    $answer["code"] = 200;

} else {
    $answer["data"] = null;
    $answer["message"] = "User is not logged in";
    $answer["code"] = 401;

    $_SESSION['user'] = null;
}

echo json_encode($answer);