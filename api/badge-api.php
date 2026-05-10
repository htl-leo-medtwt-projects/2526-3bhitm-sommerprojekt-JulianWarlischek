<?php
SESSION_START();
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

if (!empty($_POST['submit-badges'])) {
    $user = $_SESSION['user'];
    $userId = $user['userid'];

    $badges = json_decode($_POST['selectedBadges'], true);

    for ($i = 0; $i < count($badges); $i++) {
        $badgeId = $badges[$i];
        $stmt = $conn->prepare("SELECT * FROM User_Badge WHERE UserID = ? AND Badge_ID = ?");
        $stmt->bind_param("ii", $userId, $badgeId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            continue;
        }

        $stmt = $conn->prepare("INSERT INTO User_Badge (UserID, Badge_ID) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $badgeId);
        $stmt->execute();
    }

    header("Location: ../project/pages/profile.php?badge=true");
}

echo json_encode($answer);

$conn->close();