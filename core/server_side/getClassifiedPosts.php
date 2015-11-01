<?php
session_start();
require_once 'data.php';
include("lib/usersManager.php");
include("lib/postsManager.php");

$tag = mysql_real_escape_string ( $_POST ["tag"] );
$type = mysql_real_escape_string ( $_POST ["type"] );
$postsManager = new PostsManager($connection);
$usersManager = new UsersManager($connection);

if (! isset ( $_SESSION ['id'] )) {
	$query = "SELECT id FROM posts WHERE MONTH(post_date) = MONTH(CURDATE())
		 AND type = \"$type\" AND tag = \"$tag\" ORDER BY score DESC LIMIT 10";
	$q = mysql_query ( $query, $connection ) or die ( mysql_error () . "Best comments couldn't be got" );
	while ( $d = mysql_fetch_assoc ( $q ) ) {
		$postID = $d ['id'];
		echo $postsManager->getPost ( $postID, $usersManager, "#B2FC3A", "#283C80", "#283C80", "One of the best pics this month" );
	}
}

