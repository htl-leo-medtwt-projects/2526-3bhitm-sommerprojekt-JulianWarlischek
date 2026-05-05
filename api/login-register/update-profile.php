<?php
session_start();
require '../database.php';
require './validations.php';

$activeUserId = $_SESSION['user']['userid'] ?? null;

if(!empty($_POST['submit'])){
    $_username = $conn->real_escape_string($_POST['username']);
    $_firstname = $conn->real_escape_string($_POST['firstname']);
    $_lastname = $conn->real_escape_string($_POST['lastname']);
    $_email = $conn->real_escape_string($_POST['email']);
    $_dob = $conn->real_escape_string($_POST['dob']);

    $stmt = $conn->prepare("SELECT * FROM User WHERE UserID = ?");
    $stmt->bind_param("i", $activeUserId);
    $stmt->execute();
    $currentUser = $stmt->get_result()->fetch_assoc();

    if($_username !== $currentUser['username'] && !validateUsername($_username)){
        header("Location: ../../project/pages/profile.php");
        exit();
    }

    if($_email !== $currentUser['email'] && !validateEmail($_email)){
        header("Location: ../../project/pages/profile.php");
        exit();
    }

    $updateStatement = "UPDATE User SET username = '$_username', firstname = '$_firstname', lastname = '$_lastname', email = '$_email', dob = '$_dob' WHERE UserID = $activeUserId";

    if($res = $conn->query($updateStatement)){
        $stmt = $conn->prepare("SELECT * FROM User WHERE UserID = ?");
        $stmt->bind_param("i", $activeUserId);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();
        $_SESSION['user'] = $user;
    
        header("Location: ../../project/pages/profile.php");
        exit();
    } else {
        header("Location: ../../project/pages/profile.php");
        exit();
    }
}