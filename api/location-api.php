<?php
require './database.php';

$answer = [
    "code" => 404,
    "message" => "Not found",
    "data" => null
];

if(isset($_POST['add-location'])) {
    $stmt = $conn->prepare("INSERT INTO Location (Name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['name'], $_POST['description']);
    $stmt->execute();

    header("Location: ../project/pages/events.php?addEvent=true");
    exit();
}

if (isset($_GET['locationId'])) {
    $stmt = $conn->prepare("SELECT * FROM Location WHERE Location_ID = ?");
    $stmt->bind_param("i", $_GET['locationId']);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['search'])) {
    $searchTerm = '%' . $_GET['search'] . '%';
    $stmt = $conn->prepare("SELECT * FROM Location WHERE Name LIKE ?");
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();

    $result = $stmt->get_result();

    $locations = [];
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }

    $answer["data"] = $locations;
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

echo json_encode($answer);

$conn->close();