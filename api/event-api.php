<?php
session_start();
require './database.php';
require './imageupload.php';

$stmt = $conn->prepare("SELECT * FROM Event where Event_ID IN (SELECT Event_ID FROM User_Event WHERE UserID = ?) or master_userid = ? order by startDate");
$stmt->bind_param("ii", $_SESSION['user']['userid'], $_SESSION['user']['userid']);
$stmt->execute();
$result = $stmt->get_result();


$answer = [
    "code" => 200,
    "message" => "OK",
    "data" => $result->fetch_all(MYSQLI_ASSOC)
];


if (isset($_GET['eventId'])) {

    $stmt = $conn->prepare("SELECT * FROM Event WHERE Event_ID = ? ");
    $stmt->bind_param("i", $_GET['eventId']);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['userPerEvent'])) {
    $stmt = $conn->prepare("SELECT count(*) as count FROM User_Event WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['userPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_assoc();
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['drinksPerEvent'])) {
    $stmt = $conn->prepare("SELECT * FROM Event_Drink WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['drinksPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['snacksPerEvent'])) {
    $stmt = $conn->prepare("SELECT * FROM Event_Snack WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['snacksPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['gamesPerEvent'])) {
    $stmt = $conn->prepare("SELECT * FROM Event_Game WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['gamesPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_GET['usersPerEvent'])) {
    $stmt = $conn->prepare("SELECT * FROM User u WHERE u.UserID IN (SELECT ue.UserID FROM User_Event ue WHERE ue.Event_ID = ?) OR u.UserID IN (SELECT e.master_userid FROM Event e WHERE e.Event_ID = ?)");
    $stmt->bind_param("ii", $_GET['usersPerEvent'], $_GET['usersPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if(isset($_GET['imagesPerEvent'])) {
    $stmt = $conn->prepare("SELECT * FROM Event_Image WHERE event_id = ?");
    $stmt->bind_param("i", $_GET['imagesPerEvent']);
    $stmt->execute();

    $result = $stmt->get_result();
    $answer["data"] = $result->fetch_all(MYSQLI_ASSOC);
    $answer["code"] = 200;
    $answer["message"] = "OK";
}

if (isset($_POST['add-event'])) {
    $_name = $conn->real_escape_string($_POST['name']);
    $_description = $conn->real_escape_string($_POST['description']);
    $_startDate = $conn->real_escape_string($_POST['startDate']);
    $_endDate = $conn->real_escape_string($_POST['endDate']);
    $_dressCode = $conn->real_escape_string($_POST['dresscode']);
    $_ranking = $conn->real_escape_string($_POST['ranking']);
    $_location = $conn->real_escape_string($_POST['locationId']);
    $_sharedWith = JSON_DECODE($_POST['sharedWith'], true);
    $_snacks = JSON_DECODE($_POST['snacks'], true);
    $_drinks = JSON_DECODE($_POST['drinks'], true);
    $_games = JSON_DECODE($_POST['games'], true);


    if (empty($_location)) {
        $_SESSION['errors'][] = "Location is required.";
    }

    if (empty($_SESSION['errors'])) {
        $stmt = $conn->prepare("INSERT INTO Event (name, startDate, endDate, describtion, dresscode_desc, ranking, like_count, location_id, master_userid) VALUES (?, ?, ?, ?, ?, ?, 0, ?, ?)");
        $stmt->bind_param("ssssssii", $_name, $_startDate, $_endDate, $_description, $_dressCode, $_ranking, $_location, $_SESSION['user']['userid']);
        $stmt->execute();
        $event_id = $conn->insert_id;

        for ($i = 0; $i < count($_snacks); $i++) {
            $stmt = $conn->prepare("INSERT INTO Event_Snack (event_id, snack_id, count) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $event_id, $_snacks[$i]['snack_id'], $_snacks[$i]['count']); 
            $stmt->execute();
        }

        for ($i = 0; $i < count($_drinks); $i++) {
            $stmt = $conn->prepare("INSERT INTO Event_Drink (event_id, drink_id, count) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $event_id, $_drinks[$i]['drink_id'], $_drinks[$i]['count']);
            $stmt->execute();
        }

        for ($i = 0; $i < count($_games); $i++) {
            $stmt = $conn->prepare("INSERT INTO Event_Game (event_id, game_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $event_id, $_games[$i]); 
            $stmt->execute();
        }

        for ($i = 0; $i < count($_sharedWith); $i++) {
            $stmt = $conn->prepare("INSERT INTO User_Event (userid, event_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $_sharedWith[$i], $event_id);
            $stmt->execute();
        }

        $target_dir = "../api/uploads/";
        $target_file = $target_dir . basename($_FILES["event-cover-image"]["name"]);

        if(empty($_FILES["event-cover-image"]["name"])) {
            $_SESSION['errors'][] = "Sorry, your file was not uploaded.";
        } else {
            $checkSum = checkFile($target_file, "event-cover-image");
            if ($checkSum == 1 && move_uploaded_file($_FILES["event-cover-image"]["tmp_name"], $target_file)) {
                try {
                    $stmt = $conn->prepare("INSERT INTO `Image` (path) VALUES (?)");
                    $stmt->bind_param("s", $target_file);
                    $stmt->execute();

                    $imageId = $conn->insert_id;

                    $stmt = $conn->prepare("UPDATE Event SET cover_image = ? WHERE Event_ID = ?");
                    $stmt->bind_param("ii", $imageId, $event_id);
                    $stmt->execute();
                } catch (Exception $e) {
                    $_SESSION['errors'][] = "Error uploading file: " . $e->getMessage();
                }
            } else {
                $_SESSION['errors'][] = "Sorry, there was an error uploading your file.";
            }
        }

        if(empty($_FILES['event-images']['name'][0])) {
            $_SESSION['errors'][] = "No additional images uploaded.";
        } else {
            for ($i = 0; $i < count($_FILES['event-images']['name']); $i++) {
                $target_file = $target_dir . basename($_FILES["event-images"]["name"][$i]);
                $checkSum = checkFile($target_file, "event-images", $i);

                if ($checkSum == 1 && move_uploaded_file($_FILES["event-images"]["tmp_name"][$i], $target_file)) {
                    try {
                        $stmt = $conn->prepare("INSERT INTO `Image` (path) VALUES (?)");
                        $stmt->bind_param("s", $target_file);
                        $stmt->execute();

                        $imageId = $conn->insert_id;

                        $stmt = $conn->prepare("INSERT INTO Event_Image (event_id, image_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $event_id, $imageId);
                        $stmt->execute();
                    } catch (Exception $e) {
                        $_SESSION['errors'][] = "Error uploading file: " . $e->getMessage();
                    }
                } else {
                    $_SESSION['errors'][] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        header("Location: ../project/pages/events.php");
    } else {
        header("Location: ../project/pages/events.php?addEvent=true");
        exit();
    }
}

echo json_encode($answer);
$conn->close();