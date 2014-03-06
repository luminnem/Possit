<?php
session_start();
require_once("data.php");
include_once("lib/usersManager.php");

$userID = mysql_real_escape_string($_SESSION['id']);
$userManager = new UsersManager($connection);

//CLEAR AND ENCODE USER'S DESCRIPTION
if (isset($_POST['description'])) {
    $description = $_POST['description'];
    $description = strip_tags($description);
    $description = mysql_real_escape_string($description);
    $description = base64_encode($description);
}

//CLEAR AND ENCODE USER'S PROFILE PICTURE URL
if (isset($_POST['profilePicture'])) {
    $pictureURL = $_POST['profilePicture'];
    $pictureURL = strip_tags($pictureURL);
    $pictureURL = mysql_real_escape_string($pictureURL);
    $pictureURL = base64_encode($pictureURL);
}


if ($userManager->getProfile($userID)) { // If the user has already a profile, update it with the provided values.
    if (isset($description) && isset($pictureURL)) {
        $query = "UPDATE profiles SET description='$description' picture='$pictureURL' WHERE userID='$userID'";
    } else {
        if (isset($description)) {
            $query = "UPDATE profiles SET description='$description' WHERE userID='$userID'";
        } else {
            $query = "UPDATE profiles SET picture='$pictureURL' WHERE userID='$userID'";
        }
    }
} else { // If the user hasn't set up its profile yet, create a new one with the provided values.
    if (isset($description) && isset($pictureURL)) {
        $query = "INSERT INTO profiles (userID, description, picture) VALUES ('$userID', '$description', '$pictureURL')";
    } else {
        if (isset($description)) {
            $query = "INSERT INTO profiles (userID, description) VALUES ('$userID', '$description')";
        } else {
            $query = "INSERT INTO profiles (userID, picture) VALUES ('$userID', '$pictureURL')";
        }
    }
}
$q = mysql_query($query, $connection) or die("Your profile couldn't be updated");

if ($q) {
    echo "1";
} else {
    echo mysql_error();
}