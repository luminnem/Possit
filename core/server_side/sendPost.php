<?php

require_once("data.php");
session_start();

$data = $_POST["data"];
$data = strip_tags($data);
$data = mysql_real_escape_string($data);
$data = str_replace("\\n", ".\endl", $data);
$data = base64_encode($data);

$by = mysql_real_escape_string($_SESSION['id']);

if (isset($_POST['to'])) {
	$to = mysql_real_escape_string($_POST['to']);
}

if (isset($_POST["reply"])) {
	$reply = mysql_real_escape_string($_POST["reply"]);
}

$query_string = "INSERT INTO posts(user, body) VALUES ('$by', '$data')";
$q = mysql_query($query_string, $connection) or die ("Ups... problem when sending your post");

if (!isset($reply)){
	if (isset($to)) {
		$query = "INSERT INTO users_replies(user, post) VALUES ('$to', LAST_INSERT_ID())";
		$q = mysql_query($query, $connection) or die("Your post couldn't be sent to this user");
	}
} else {
	if (isset($to)) {
		$query = "INSERT INTO posts_replies(post, reply) VALUES ('$to', LAST_INSERT_ID())";
		$q = mysql_query($query, $connection) or die ("Your reply couldn't be posted");
	}
}

if ($q) {
	echo "1";
} else {
	echo "Error occurred";
}
