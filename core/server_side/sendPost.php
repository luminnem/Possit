<?php

require_once("data.php");
session_start();

$data = $_POST["data"];
$data = strip_tags($data);
$data = mysql_real_escape_string($data);
$data = str_replace("\\n", ".\endl", $data);
$data = base64_encode($data);

if (isset($_POST['to'])) {
	$to = $_POST['to'];
	$to = mysql_real_escape_string($to);
}

$by = mysql_real_escape_string($_SESSION['id']);

$query_string = "INSERT INTO posts(user, body) VALUES ('$by', '$data')";
$q = mysql_query($query_string, $connection) or die ("Ups... problem when sending your post");

if (isset($to)) {
	$query = "INSERT INTO users_replies(user, post) VALUES ('$to', LAST_INSERT_ID())";
	$q = mysql_query($query, $connection) or die("Your post couldn't be sent to this user");
}

if ($q) {
	echo "1";
} else {
	echo "Error occurred".mysql_error();
}