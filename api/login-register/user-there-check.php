<?php
$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => null
];

if(isset($_SESSION['user_id'])){

    $id = $_SESSION['user_id'];

    if($id == -1){
        $answer["data"] = -1;
        $answer["message"] = "User is not logged in";
        $answer["code"] = 401;
        
    }else{
        $answer["data"] = $id;
        $answer["message"] = "User is logged in";
        $answer["code"] = 200;
    }
} else {
    $answer["data"] = -1;
    $answer["message"] = "User is not logged in";
    $answer["code"] = 401;

    $_SESSION['user_id'] = -1;
}

echo json_encode($answer);