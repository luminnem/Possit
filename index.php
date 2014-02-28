<!DOCTYPE HTML>
<?php
	session_start();
	
?>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">
	<head>
		<title>Posit</title>
		<link rel="stylesheet" type="text/css" href="styles/main_page.css">
<!--		<link rel="stylesheet" type="text/css" href="styles/login_banner.css">-->
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
		<link href="styles/main_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/login_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/comments.css" rel="Stylesheet" type="text/css">
		<link href="styles/pictures.css" rel="Stylesheet" type="text/css">
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
	<body>
	
		<div id="ban">
			<?php 
				if (!isset($_SESSION["id"])) {
					include "login_banner.php";

				} else {
					include "main_banner.php";
				}
			?>
		</div>
		<div id="body">
			<?php
				include "postsAreas.php";
			?>
			
			<div id="msger"></div>
			<div id="topComments">
				<?php
				include "topComments.php";
				?>
			</div>
		</div>
	</body>
</html>