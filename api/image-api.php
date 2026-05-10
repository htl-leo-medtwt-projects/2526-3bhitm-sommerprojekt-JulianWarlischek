<?php
require './database.php';

$answer = [
    "error" => "No image ID provided.",
    "data" => null,
    "code" => 400
];

if(isset($_GET['id'])){
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("SELECT path FROM Image WHERE images_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    if($result){
        $answer['error'] = null;
        $answer['data'] = $result['path'];
        $answer['code'] = 200;
    } else {
        $answer['error'] = "Image not found.";
        $answer['code'] = 404;
    }
}

echo json_encode($answer);

$conn->close();