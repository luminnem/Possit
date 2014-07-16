<?php
	session_start();
	require_once("core/server_side/data.php");
	include("core/server_side/lib/usersManager.php");
	include("core/server_side/lib/postsManager.php");
  include("core/server_side/lib/lab.php");
	
	$usersManager = new UsersManager($connection);
	$postsManager = new PostsManager($connection);
  $lab = new Lab($connection);
	$logged = isset($_SESSION["id"]);
?>
<!DOCTYPE HTML>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">
	<head>
		<title>Posit</title>
		
		<!--Meta tags-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" href="resources/favicon.ico">
		
		<!--Styles-->
		<link rel="stylesheet" type="text/css" href="styles/main_page.css">
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<link href='http://fonts.googleapis.com/css?family=Crafty+Girls' rel='stylesheet' type='text/css'>
		<link href="styles/main_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/login_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/comments.css" rel="Stylesheet" type="text/css">
		<link href="styles/pictures.css" rel="Stylesheet" type="text/css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		
		<!--Scripts-->
		<script type="text/javascript" src="core/client_side/log_in.js"></script>
		<script type="text/javascript" src="core/client_side/profile.js"></script>
		<script type="text/javascript" src="core/client_side/newPostArea.js"></script>
		<script type="text/javascript" src="core/client_side/usersConnections.js"></script>
		<script type="text/javascript" src="core/client_side/topComments.js"></script>
		<script type="text/javascript" src="core/client_side/newPicArea.js"></script>
		<script type="text/javascript" src="core/client_side/usefulTools.js"></script>
		<script type="text/javascript" src="core/client_side/search.js"></script>
		<script type="text/javascript" src="core/client_side/lab.js"></script>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		
		
	</head>
	<body>
	
		<div id="ban">
			<?php 
				if (!$logged) {
					include "login_banner.php";

				} else {
					include "main_banner.php";
					include "postsAreas.php";
					echo "<div id='msger'></div>";
				}
			?>
		</div>
		<div id='body'>
			<?php
				if($logged) {
					$postsManager->getRawUrls($lab->getPicturesWithoutCaption($_SESSION['id']));
				}
			?>
		</div>
    
</body>
</html>