<?php
require_once("data.php");
session_start();


$urls = $_POST['url'];

$urls = explode("\n", $urls);
$errors = 0;
$total = count($urls);

foreach ($urls as &$url) {
	sendPic($url, $errors, $connection);
}
unset($url);

if ($errors != 0) {
	$string = "Ups not all your images were sent. [%d / %d] were sent so check out the urls and try again";
	echo sprintf($string, ($total - $errors), $total);
} else {
	echo "There were no errors so, all your pictures have been sent correctly";
}



function sendPic($url, $errors, $connection) {
	if (getimagesize($url)) { // Get the size of the image, if the size is equal to null or it's equal to zero then the image doesn't exist.
		
		//Filter possible codes
		$pic = strip_tags($url);
		$pic = mysql_real_escape_string($pic);
		
		//Convert strange chars
		$pic = str_replace("\\n", ".\endl", $pic);
		$pic = str_replace("\\'", ".\sinQuote", $pic);
		//$pic = str_replace("%", "&#37;", $pic);
		
		//Encode url
		$pic = base64_encode($pic);
		
		//If this picture was sent to an user get the id of that user
		if (isset($_POST['to'])) {
			$to = $_POST['to'];
			$to = mysql_real_escape_string($to);
		}
		
		//Get the id of the user who's sending the picture
		$by = mysql_real_escape_string($_SESSION['id']);
		//Send the encoded url of the picture to the database
		$query_1 = "INSERT INTO posts(user, body, type) VALUES ('$by', '$pic', '2')";
		$q = mysql_query($query_1, $connection) or die ("Ups... problem when sending your pic");
		//If this picture was sent to an user, post it on its profile.
		if (isset($to)) {
			$query = "INSERT INTO users_replies(user, post) VALUES ('$to', LAST_INSERT_ID())";
			mysql_query($query, $connection) or die ("Your picture couldn't be sent to this user");
		}
		
		
	} else {
		//If the image doesn't exist ...
		$errors += 1;
	}
}