<?php

function checkFile($target_file) {
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["profile-image"]["tmp_name"]);
    
    $uploadOk = 1;

    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['errors'][] = "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["profile-image"]["size"] > 50000000) {
        $_SESSION['errors'][] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if (
        $imageFileType != "jpg" &&
        $imageFileType != "png" &&
        $imageFileType != "jpeg" &&
        $imageFileType != "gif"
    ) {
        $_SESSION['errors'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    return $uploadOk;
}
