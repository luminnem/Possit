<!DOCTYPE HTML>
<?php
	session_start();
	require_once("core/server_side/data.php");
	
?>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">
	<head>
		<title>Posit</title>
		<link rel="stylesheet" type="text/css" href="styles/main_page.css">
		<link rel="stylesheet" type="text/css" href="styles/login_banner.css">
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
		<link href="styles/main_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/login_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/comments.css" rel="Stylesheet" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <script type="text/javascript" src="/core/client_side/usefulTools.js"></script>
		<script type="text/javascript" src="core/client_size/backgroundChanger.js"></script>
		<script type="text/javascript" src="core/client_side/log_in.js"></script>
		<script type="text/javascript" src="core/client_side/newPostArea.js"></script>
		<script type="text/javascript" src="core/client_side/topComments.js"></script>
	</head>
	<body style="background: #E1F0FA">
		<div id="ban">
			<?php 
				if (!isset($_SESSION["id"])) {
					include "login_banner.php";
					require_once "core/server_side/lib/RandBG.php";
					
					PutRandomBG();
					
				} else {
					include "main_banner.php";
				}
			?>
		</div>
		<div id="body">
			<div id="postArea" style="display:none" align="center">
				<?php
					include "newPostArea.php";
				?>
			</div>
			
			<div id="topComments">
				<?php
				include "topComments.php";
				?>
			</div>
		</div>
	</body>
</html>