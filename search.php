<?php
session_start();
require_once("core/server_side/data.php");
include "core/server_side/lib/usersManager.php";
$usersManager = new UsersManager($connection);
?>
<!DOCTYPE HTML>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">
	<head>
		<title>Posit</title>
		<link rel="stylesheet" type="text/css" href="styles/main_page.css">
		<link rel="stylesheet" type="text/css" href="styles/login_banner.css">
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<link href='http://fonts.googleapis.com/css?family=Crafty+Girls' rel='stylesheet' type='text/css'>
		<link href="styles/main_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/login_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/comments.css" rel="Stylesheet" type="text/css">
		<link href="styles/pictures.css" rel="Stylesheet" type="text/css">
		<link href="styles/search.css" rel="Stylesheet" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
		<script type="text/javascript" src="core/client_side/log_in.js"></script>
		<script type="text/javascript" src="core/client_side/profile.js"></script>
		<script type="text/javascript" src="core/client_side/newPostArea.js"></script>
		<script type="text/javascript" src="core/client_side/usersConnections.js"></script>
		<script type="text/javascript" src="core/client_side/topComments.js"></script>
		<script type="text/javascript" src="core/client_side/newPicArea.js"></script>
		<script type="text/javascript" src="core/client_side/usefulTools.js"></script>
		<script type="text/javascript" src="core/client_side/search.js"></script>
		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script type="text/javascript" src="core/client_side/drag.js"></script>
		
	</head>
	<body style="background: #E1F0FA">
		<div id="ban">
			<?php 
				if (!isset($_SESSION["id"])) {
					include "login_banner.php";
				} else {
					include "main_banner.php";
				}
			?>
		</div>
		<div id="search_results">
			<?php
			$toFind = mysql_real_escape_string($_GET['username']);
			$toFind = strtolower($toFind);

			$query = "SELECT ID FROM users WHERE username LIKE '%$toFind%' LIMIT 5";

			$q = mysql_query($query, $connection) or die(mysql_error());

			
			$numbers = "<p>%d matches</p>";
			echo sprintf($numbers, mysql_num_rows($q));
			while ($d = mysql_fetch_assoc($q)) {
				$id = $d['ID'];
				$username = $usersManager->getUsername($id);
				
				$string = "<p><a href='profile.php?id=%d'>".$usersManager->getProfilePicture("$id")."%s</a>&nbsp;";
				if(!$usersManager->CheckIfFollowing($_SESSION["id"], $id))
					$string .= "<button onClick='follow($id, this)'>Follow user</button>";
				$string .= "</p>";
				echo sprintf($string, $id, $username);
			}
			?>
		</div>
		<div id="msger"></div>
	</body>
</html>