<?php
require './database.php';

$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => null
];

$stmt = $conn->prepare("SELECT * FROM Badge");
$stmt->execute();
$result = $stmt->get_result();

$answer["data"] = $result->fetch_all(MYSQLI_ASSOC);


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

if (isset($_GET['badgeId'])) {
    $id = $_GET['badgeId'];
    $stmt = $conn->prepare("SELECT * FROM Badge WHERE Badge_ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['userId']) && isset($_GET['removeBadge'])) {
    $userId = $_GET['userId'];
    $badgeId = $_GET['removeBadge'];

    $stmt = $conn->prepare("DELETE FROM User_Badge WHERE UserID = ? AND Badge_ID = ?");
    $stmt->bind_param("ii", $userId, $badgeId);
    $stmt->execute();

    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);

$conn->close();