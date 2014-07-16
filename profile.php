<?php
	session_start();
	require_once("core/server_side/data.php");
	include("core/server_side/lib/usersManager.php");
	include("core/server_side/lib/postsManager.php");
	$usersManager = new UsersManager($connection);
	$logged = isset($_SESSION['id']);
	if ($logged) $myID = $_SESSION['id'];
	$postsManager = new PostsManager($connection);
	$userID = mysql_real_escape_string($_GET['id']);
	$username = $usersManager->getUsername($userID);
	
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
		<link rel="stylesheet" type="text/css" href="styles/login_banner.css">
		<link rel="Stylesheet" type="text/css" href="styles/main_banner.css" >
		<link rel="Stylesheet" type="text/css" href="styles/profile.css">
		<link rel="stylesheet" type="text/css" href="styles/main_page.css">
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<link rel="stylesheet" type="text/css" href="styles/pictures.css">
		<link href='http://fonts.googleapis.com/css?family=Crafty+Girls' rel='stylesheet' type='text/css'>
		<link href="styles/main_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/comments.css" rel="Stylesheet" type="text/css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		
		<!--Scripts-->
		<script type="text/javascript" src="core/client_side/log_in.js"></script>
		<script type="text/javascript" src="core/client_side/profile.js"></script>
		<script type="text/javascript" src="core/client_side/newPostArea.js"></script>
		<script type="text/javascript" src="core/client_side/usersConnections.js"></script>
		<script type="text/javascript" src="core/client_side/topComments.js"></script>
		<script type="text/javascript" src="core/client_side/newPicArea.js"></script>
		<script type="text/javascript" src="core/client_side/usefulTools.js"></script>
		<script type="text/javascript" src="core/client_side/posts_utils.js"></script>
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
					echo "<div id='msger'></div>";
				}
			?>
		</div>
		<div id="body">
		    <?php
					include "postsAreas.php";
					
						
						
						/*$profile = "<div id='profile'>
										<p id='profile_picture'>".$usersManager->getProfilePicture($userID)."</p>
										<p id='profile_username'>".$username."</p>";
						
						if ($usersManager->getProfile($userID)) {
							if ($userID == $_SESSION['id']) {
								$profile .= "<button onClick='showProfileForm();' class='editProfileButton'>Edit profile</button>";
								include "modifyProfileForm.php"; // FORM TO MODIFY THE PROFILE
								
							} else {
								if (isset($_SESSION['id'])) {
									if (!$usersManager->checkIfFollowing($_SESSION['id'], $userID)) {
										$profile .= "<button id='$userID' onClick='follow(this);' class='editProfileButton'>Follow</button>";
									}
								}
							}
							$description = $usersManager->getDescription($userID);
							$spr = "<p id='profile_description'>%s</p>";
							$profile .= sprintf($spr, $description);
							
						} else{
							if ($userID == $_SESSION['id']) {
								$profile .= "<p id='profile_description'>You've not set up your profile yet.</p>";
								$profile .= "<button onClick='showProfileForm();' class='editProfileButton'>Set up profile</button>";
								
								include "modifyProfileForm.php"; // FORM TO MODIFY THE PROFILE
							} else {
								$profile .= "<p id='profile_description'>This user hasn't set up its profile yet.</p>";
								if (isset($_SESSION['id'])) {
									if (!$usersManager->checkIfFollowing($_SESSION['id'], $userID)) {
										$profile .= "<button id='$userID' onClick='follow(this);' class='editProfileButton'>Follow</button>";
									}
								}
							}
						}
						
						$profile .= "</div>";
						echo $profile;*/
					?>
			<div id="topComments">
			<script>
				
				$(function() {
					$( ".drag-post-it" ).draggable();
					
					/*$( ".drag-post-it" ).each(function() {
						//moveRandom($(this), "topComments");
					});*/
					
					
					$( ".polaroid" ).draggable();
					
					/*$( ".polaroid" ).each(function() {
						moveRandom($(this), "topComments");
					});*/
				});
				
			</script>
			<?php
			$posts = array();
			
				//LATEST FROM ME
				$query = "SELECT id FROM posts WHERE user='$userID' ORDER BY post_date DESC LIMIT 10";
				$q = mysql_query($query, $connection) or die("Your posts couldn't be loaded");
				
				while ($d = mysql_fetch_assoc($q)) {
					$id = $d['id'];
					array_push($posts, $id);
				}
				
				//LATEST FROM WHAT I LIKE
				$query = "SELECT posts.id as id FROM votes LEFT JOIN posts ON (posts.id=votes.post) WHERE votes.user='$userID' AND vote='1' ORDER BY posts.score DESC LIMIT 10";
				$q = mysql_query($query, $connection) or die("Your posts couldn't be loaded");
				while ($d = mysql_fetch_assoc($q)) {
					$id = $d['id'];
					array_push($posts, $id);
					
				}
				//BEST THINGS FOR ME
				$query = "SELECT id FROM posts WHERE user='$userID' ORDER BY score DESC LIMIT 10";
				$q = mysql_query($query, $connection) or die("Your posts couldn't be loaded");
				while ($d = mysql_fetch_assoc($q)) {
					$id = $d['id'];
					array_push($posts, $id);
				}
				
				$posts = array_unique($posts);
				
				foreach($posts as &$post) {
					echo $postsManager->getPost($post, $usersManager, "#82f0fa", "#FFF", "Some posts from this user");
				}
				unset($post);
				
				
				//COMMENTS
				$query = "SELECT post FROM users_replies WHERE user='$userID' LIMIT 10";
				$q = mysql_query($query, $connection) or die("Comments from this user couldn't be loaded");
				while($d = mysql_fetch_assoc($q)) {
					$id = $d['post'];
					echo $postsManager->getPost($id, $usersManager, "#FFF", "#000", "Notes left to this user", true);
				}
				?>
    		</div>
		</div>
	</body>
</html>