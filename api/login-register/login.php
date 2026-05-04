<?php
session_start();

require '../database.php';


if (!empty($_POST['submit'])) {

    $_username = $_POST['login-username'];
    $_password = $_POST['login-password'];

    $stmt = $conn->prepare(
        "SELECT * FROM User WHERE username = ? LIMIT 1"
    );
    $stmt->bind_param("s", $_username);
    $stmt->execute();

    $res = $stmt->get_result();

    if($res->num_rows === 1){
        $user = $res->fetch_assoc();

        if(password_verify($_password, $user['password'])){
            $_SESSION['user'] = $user;
            header("Location: ../../project/index.html");
            exit();
        } else {
            header("Location: ../../project/pages/login.php");
            exit();
        }
    } else {
        header("Location: ../../project/pages/login.php");
        exit();
    }
}