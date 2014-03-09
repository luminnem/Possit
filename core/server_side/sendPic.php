<?php
if (getimagesize($_POST["url"])) {
	require_once("data.php");
	session_start();
	$url = $_POST["url"];
	$url = strip_tags($url);
	$url = mysql_real_escape_string($url);
	$url = str_replace("\\n", ".\endl", $url);
	$url = str_replace("\\'", ".\sinQuote", $url);
	$url = base64_encode($url);
	
	$caption = $_POST["caption"];
	$caption = strip_tags($caption);
	$caption = mysql_real_escape_string($caption);
	$caption = base64_encode($caption);
	
	if (isset($_POST['to'])) {
		$to = $_POST['to'];
		$to = mysql_real_escape_string($to);
	}
	
	$by = mysql_real_escape_string($_SESSION['id']);
	
	$query_string = "INSERT INTO posts(user, body, type) VALUES ('$by', '$url', '2')";
	$query_2 = "INSERT INTO posts_captions(post, caption) VALUES (LAST_INSERT_ID(), '$caption')";
	
	$q_2 = mysql_query($query_2, $connection) or die("Ups... problem when sendint your pic");
	$q = mysql_query($query_string, $connection) or die ("Ups... problem when sending your pic");
	
	if (isset($to)) {
		$query = "INSERT INTO users_replies(user, post) VALUES ('$to', LAST_INSERT_ID())";
		mysql_query($query, $connection) or die ("Your picture couldn't be sent to this user");
	}
	
	
	if ($q && $q_2) {
		echo "1";
	} else {
		echo "2";
	}
} else {
	echo "3";
}