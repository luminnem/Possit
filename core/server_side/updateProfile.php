<?php
session_start();
require_once("data.php");
include_once("lib/usersManager.php");

$userID = mysql_real_escape_string($_SESSION['id']);
$userManager = new UsersManager($connection);

//CLEAR AND ENCODE USER'S DESCRIPTION
$description = $_POST['description'];
$description = strip_tags($description);
$description = mysql_real_escape_string($description);
$description = base64_encode($description);


if ($userManager->getProfile($userID)) {
    $query = "UPDATE profiles SET description='$description' WHERE userID='$userID'";
} else {
    $query = "INSERT INTO profiles (userID, description) VALUES ('$userID', '$description')";
}

$q = mysql_query($query, $connection) or die("Your profile couldn't be updated");

if ($q) {
    echo "1";
} else {
    echo mysql_error();
}