<?php

require_once("data.php");
session_start();
//USERNAME ENCODING
$username = $_POST["username"];
$username = strip_tags($username);
$username = mysql_real_escape_string($username);
$username = strtolower($username);
$username = base64_encode($username);
//PASSWORD ENCODING
$password = $_POST["password"];
$password = mysql_real_escape_string($password);
$password = base64_encode($password);
$password = md5($password);

$query_string = "SELECT id, username FROM users WHERE username='$username' AND password='$password' LIMIT 1";
$q = mysql_query($query_string, $connection) or die("Ups... login problems");

if (mysql_num_rows($q) == 1) {
	$d = mysql_fetch_assoc($q);
	$_SESSION["id"] = $d["id"];
	$_SESSION["username"] = $d["username"];
	echo "1";
	
} else {
	echo "Incorrect data";
}