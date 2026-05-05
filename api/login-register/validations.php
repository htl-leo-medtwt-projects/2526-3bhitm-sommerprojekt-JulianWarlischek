<?php
function validateUsername($username){
    if(strlen($username) < 3 || userNameExists($username)){
        return false;
    }

    return true;
}

function userNameExists($username){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM User WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){
        return true;
    }

    return false;
}

function validateEmail($email){
    if(!str_contains($email, "@") || !str_contains($email, ".") || emailExists($email)){
        return false;
    }

    return true;
}

function emailExists($email){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM User WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){
        return true;
    }

    return false;
}

function validatePassword($password){
    if(strlen($password) < 1){
        return false;
    }

    return true;
}