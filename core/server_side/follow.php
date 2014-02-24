<?php
session_start();
require_once("data.php");

$ownID = mysql_real_escape_string($_SESSION['id']);
$userID = mysql_real_escape_string($_POST['user']);

$query = "INSERT INTO users_connections (user_1, user_2) VALUES ('$ownID', '$userID')";
$q = mysql_query($query, $connection);

if ($q) {
    echo "1";
} else {
    echo mysql_error();
}