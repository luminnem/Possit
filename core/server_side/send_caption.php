<?php

require_once("data.php");
session_start();

$id = $_POST['postID'];

$caption = $_POST['caption'];
$caption = strip_tags($caption);
$caption = mysql_real_escape_string($caption);
$caption = base64_encode($caption);

$query = "INSERT INTO posts_captions(post, caption) VALUES('$id', '$caption')";
$q = mysql_query($query, $connection);

if ($q) {
  echo "1";
} else {
  echo mysql_error();
}