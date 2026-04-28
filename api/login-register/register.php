<?php
session_start();

require '../database.php';
require './validations.php';

if (!empty($_POST['submit'])) {


    $_username = $conn->real_escape_string($_POST['register-username']);
    $_firstname = $conn->real_escape_string($_POST['register-firstname']);
    $_lastname = $conn->real_escape_string($_POST['register-lastname']);

    $_email = $conn->real_escape_string($_POST['register-email']);
    $_dob = $conn->real_escape_string($_POST['register-dob']);

    $_password = $conn->real_escape_string($_POST['register-password']);
    $_passwordRepeat = $conn->real_escape_string($_POST['register-password-repeat']);

    if (strcmp($_password, $_passwordRepeat) != 0 || !validateUsername($_username) || !validateEmail($_email) || !validatePassword($_password)) {
        header("Location: ../../project/pages/register.php");
        exit();
    }

    $passwordHash = password_hash($_password, PASSWORD_BCRYPT);

    $insertStatement = "INSERT INTO User (username, firstname, lastname, email, dob, password, created_at) VALUES ('$_username', '$_firstname', '$_lastname', '$_email', '$_dob', '$passwordHash', NOW())";

    if ($res = $conn->query($insertStatement)) {
        header("Location: ../../project/pages/login.php");
    } else {
        header("Location: ../../project/pages/register.php");
    }
} else {
    header("Location: ../../project/pages/register.php");
}