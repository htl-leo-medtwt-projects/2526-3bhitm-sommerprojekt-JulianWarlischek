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
    $stmt = $conn->prepare("SELECT * FROM User u WHERE u.UserID IN (SELECT f.UserID FROM Friend_Ship f WHERE f.UserID1 = ?) OR u.UserID IN (SELECT f.UserID1 FROM Friend_Ship f WHERE f.UserID = ?)");
    $stmt->bind_param("ii", $id, $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['requests'])) {
    $id = 1;

    $stmt = $conn->prepare("SELECT * FROM User u WHERE u.UserID IN (SELECT f.UserID1 FROM Friend_Request f WHERE f.UserID = ? and f.status = 'Pending')");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['acceptRequest'])) {
    $request_id = $_GET['acceptRequest'];
    $id = 1;

    $stmt = $conn->prepare("UPDATE Friend_Request SET Status = 'Accepted' WHERE Friend_Request_ID = ?");
    $stmt->bind_param("i", $request_id);
    $stmt->execute();


    $stmt = $conn->prepare("INSERT INTO Friend_Ship (Created_At, UserID, UserID1) VALUES (NOW() , ?, (SELECT UserID1 FROM Friend_Request WHERE Friend_Request_ID = ?))");
    $stmt->bind_param("ii", $id, $request_id);
    $stmt->execute();


    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['declineRequest'])) {
    $request_id = $_GET['declineRequest'];

    $stmt = $conn->prepare("UPDATE Friend_Request SET Status = 'Declined' WHERE Friend_Request_ID = ?");
    $stmt->bind_param("i", $request_id);
    $stmt->execute();

    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['getRequestId'])) {
    $userId = $_GET['userId'];
    $requesterId = $_GET['requesterId'];

    $stmt = $conn->prepare("SELECT Friend_Request_ID FROM Friend_Request WHERE UserID = ? AND UserID1 = ? AND Status = 'Pending'");
    $stmt->bind_param("ii", $userId, $requesterId);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc()['Friend_Request_ID'];
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['searchUsers'])){
    $query = $_GET['searchUsers'];
    $id = 1;

    $stmt = $conn->prepare("SELECT * FROM User WHERE Name LIKE ? and UserId != ?");
    $likeQuery = "%".$query."%";
    $stmt->bind_param("si", $likeQuery, $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['sendFriendRequest'])){
    $userId = $_GET['sendFriendRequest'];
    $userId1 = 1;

    $stmt = $conn->prepare("INSERT INTO Friend_Request (Date_Of_Req, UserID, UserID1, Status) VALUES (NOW(), ?, ?, 'Pending')");
    $stmt->bind_param("ii", $userId, $userId1);
    $stmt->execute();

    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);

$conn->close();