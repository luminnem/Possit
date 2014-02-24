<?php
session_start();
require_once("data.php");

$id = mysql_real_escape_string($_POST['id']);
$option = mysql_real_escape_string($_POST['option']);
$user = mysql_real_escape_string($_SESSION['id']);

$check = "SELECT ID FROM votes WHERE user='$user' AND post='$id' LIMIT 1";
$c = mysql_query($check, $connection);
if (mysql_num_rows($c) == 0)  {
	switch($option) {
		case 1:
			upVote($id, $user, $connection);
			break;
		case 2:
			downVote($id, $user, $connection);
			break;
	}
} else {
	echo "3";
}

function downVote($id, $user, $connection) {
	$query_1 = "UPDATE posts SET score = score - 1 WHERE id='$id'";
	$query_2 = "INSERT INTO votes (user, post, vote) VALUES ('$user', '$id', 2)";
	$q_1 = mysql_query($query_1, $connection) or die ("Error when voting");
	$q_2 = mysql_query($query_2, $connection) or die ("Error when voting");
	if ($q_1 && $q_2) {
		echo '2';
	}
}

function upVote($id, $user, $connection) {
	$query_1 = "UPDATE posts SET score = score + 1 WHERE id='$id'";
	$query_2 = "INSERT INTO votes (user, post, vote) VALUES ('$user', '$id', 1)";
	$q_1 = mysql_query($query_1, $connection) or die ("Error when voting");
	$q_2 = mysql_query($query_2, $connection) or die ("Error when voting");
	if ($q_1 && $q_2) {
		echo '1';
	}
}