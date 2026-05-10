<?php
session_start();
require '../database.php';
require './validations.php';
require '../imageupload.php';

$_SESSION['errors'] = array();

$activeUserId = $_SESSION['user']['userid'] ?? null;

if (!empty($_POST['submit'])) {
    $_username = $conn->real_escape_string($_POST['username']);
    $_firstname = $conn->real_escape_string($_POST['firstname']);
    $_lastname = $conn->real_escape_string($_POST['lastname']);
    $_email = $conn->real_escape_string($_POST['email']);
    $_dob = $conn->real_escape_string($_POST['dob']);

    $target_dir = "../../api/uploads/";
    $target_file = $target_dir . basename($_FILES["profile-image"]["name"]);

    $stmt = $conn->prepare("SELECT * FROM User WHERE UserID = ?");
    $stmt->bind_param("i", $activeUserId);
    $stmt->execute();
    $currentUser = $stmt->get_result()->fetch_assoc();

    if ($_username !== $currentUser['username'] && !validateUsername($_username)) {
        $_SESSION['errors'][] = "Invalid username.";
        header("Location: ../../project/pages/profile.php");
        exit();
    }

    if ($_email !== $currentUser['email'] && !validateEmail($_email)) {
        $_SESSION['errors'][] = "Invalid email.";
        header("Location: ../../project/pages/profile.php");
        exit();
    }

    $updateStatement = "UPDATE User SET username = '$_username', firstname = '$_firstname', lastname = '$_lastname', email = '$_email', dob = '$_dob' WHERE UserID = $activeUserId";

    if ($res = $conn->query($updateStatement)) {
        $stmt = $conn->prepare("SELECT * FROM User WHERE UserID = ?");
        $stmt->bind_param("i", $activeUserId);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();
        $_SESSION['user'] = $user;

        $checkSum = checkFile($target_file);



        if (empty($_FILES["profile-image"]["name"]) || $checkSum == 0) {
            $_SESSION['errors'][] = "Sorry, your file was not uploaded.";
            $_SESSION['errors'][] = $checkSum;
        } else {
            if (move_uploaded_file($_FILES["profile-image"]["tmp_name"], $target_file)) {
                try{
                    $stmt = $conn->prepare("INSERT INTO `Image` (path) VALUES (?)");
                    $stmt->bind_param("s", $target_file);
                    $stmt->execute();

                    // Get the ID of the newly inserted image
                    $imageId = $conn->insert_id;

                    $stmt = $conn->prepare("UPDATE User SET profile_image_id = ? WHERE UserID = ?");
                    $stmt->bind_param("ii", $imageId, $activeUserId);
                    $stmt->execute();

                    // Refresh session with updated user data
                    $stmt = $conn->prepare("SELECT * FROM User WHERE UserID = ?");
                    $stmt->bind_param("i", $activeUserId);
                    $stmt->execute();
                    $updatedUser = $stmt->get_result()->fetch_assoc();
                    $_SESSION['user'] = $updatedUser;

                }catch(Exception $e){
                    $_SESSION['errors'][] = "Error saving image to database.";
                }
            }
        }
        header("Location: ../../project/pages/profile.php");
        exit();
    } else {
        $_SESSION['errors'][] = "Error updating profile.";
        header("Location: ../../project/pages/profile.php");
        exit();
    }
}