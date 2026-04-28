<?php
session_start();

if(isset($_SESSION['user_id'])){

    $id = $_SESSION['user_id'];

    if($id == null){
        echo json_encode([
            "code" => 200,
            "message" => "User is not logged in",
            "data" => false
        ]);
        return;
    }

    echo json_encode([
        "code" => 200,
        "message" => "User is logged in",
        "data" => true
    ]);
} else {
    echo json_encode([
        "code" => 200,
        "message" => "User is not logged in",
        "data" => false
    ]);
}