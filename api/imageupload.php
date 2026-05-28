<?php

function checkFile($target_file, $checkImage, $i = null) {
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $tmp_name = ($i !== null) ? $_FILES[$checkImage]["tmp_name"][$i] : $_FILES[$checkImage]["tmp_name"];

    $check = getimagesize($tmp_name);
    $uploadOk = 1;

    if ($check === false) {
        $_SESSION['errors'][] = "File is not an image.";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        $_SESSION['errors'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    return $uploadOk;
}