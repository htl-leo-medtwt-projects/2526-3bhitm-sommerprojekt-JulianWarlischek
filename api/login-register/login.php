<?php
session_start();

require '../database.php';


if (!empty($_POST['submit'])) {

    $_username = $_POST['login-username'];
    $_password = $_POST['login-password'];

    if (empty($_username) || empty($_password)) {
        $_SESSION['errors'][] = "Please fill in all fields.";
    }



    if (empty($_SESSION['errors'])) {
        $stmt = $conn->prepare(
            "SELECT * FROM User WHERE username = ? LIMIT 1"
        );
        $stmt->bind_param("s", $_username);
        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $user = $res->fetch_assoc();

            if (password_verify($_password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: ../../project/pages/profile.php");
                exit();
            } else {
                $_SESSION['errors'][] = "Invalid username or password.";
            }
        } else {
            $_SESSION['errors'][] = "Invalid username or password.";
        }
    }
}

if (!empty($_SESSION['errors'])) {
    header("Location: ../../project/pages/login.php");
    exit();
}