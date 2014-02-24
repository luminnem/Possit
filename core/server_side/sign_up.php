<?php
require_once("data.php");

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
//$password = crypt($password, $username);

//EMAIL ENCODING
$email = $_POST["email"];
$email = strip_tags($email);
$email = mysql_real_escape_string($email);
$email = base64_encode($email);

$date = date('Y-m-d');

$query_string = "INSERT INTO users(username, email, password, signup_date) VALUES ('$username', '$email', '$password', '$date')";
$q = mysql_query($query_string, $connection) or die ("Ups... an error happened");

if ($q) {
	echo "Enjoy!";
}