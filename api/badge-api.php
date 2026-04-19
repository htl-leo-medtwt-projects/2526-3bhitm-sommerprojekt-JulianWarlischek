<?php
require './database.php';

$answer = [
    "code" => 404,
    "message" => "Not found",
    "data" => null
];

if (isset($_GET['userId'])) {
    $id = $_GET['userId'];
    $stmt = $conn->prepare("SELECT * FROM Badge b WHERE b.Badge_ID IN (SELECT ub.Badge_ID FROM User_Badge ub WHERE ub.UserID = ?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);

$conn->close();