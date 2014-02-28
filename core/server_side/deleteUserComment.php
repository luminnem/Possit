<?php
session_start();
require_once("data.php");

$commentID = mysql_real_escape_string($_POST['commentID']);
$userID = mysql_real_escape_string($_SESSION['id']);

$query = "DELETE FROM users_replies WHERE user='$userID' AND post='$commentID'";
$q = mysql_query($query, $connection) or die ("The comment couldn't be deleted");

if ($q) {
  echo "1";
}