<?php
require './database.php';

$answer = [
    "code" => 404,
    "message" => "Not found",
    "data" => null
];


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE userId = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['friends'])) {
    $id = 1;
    $stmt = $conn->prepare("SELECT *
FROM `User`
WHERE userId IN (
    SELECT userId1 FROM Friends_With WHERE userId = ?
    UNION
    SELECT userId FROM Friends_With WHERE userId1 = ?
)");
    $stmt->bind_param("ii", $id, $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}


echo json_encode($answer);

$conn->close();