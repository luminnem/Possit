<?php

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

$by = mysql_real_escape_string($_SESSION['id']);

$query_string = "INSERT INTO posts(user, body, type) VALUES ('$by', '$url', '2')";
$query_2 = "INSERT INTO posts_captions(post, caption) VALUES (LAST_INSERT_ID(), '$caption')";

$q = mysql_query($query_string, $connection) or die ("Ups... problem when sending your pic");
$q_2 = mysql_query($query_2, $connection) or die("Ups... problem when sendint your pic");

if ($q && $q_2) {
	echo "1";
} else {
	echo "Error occurred".mysql_error();
}