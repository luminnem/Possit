<!DOCTYPE HTML>
<?php
	session_start();
	require_once("core/server_side/data.php");
	include("core/server_side/lib/usersManager.php");
	include("core/server_side/lib/postsManager.php");
    require("core/server_side/lib/postitColor.php");
	
?>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">
	<head>
		<title>Posit</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<link rel="stylesheet" type="text/css" href="styles/main_page.css">
		<link rel="stylesheet" type="text/css" href="styles/login_banner.css">
		<link rel="Stylesheet" type="text/css" href="styles/main_banner.css" >
		<link rel="Stylesheet" type="text/css" href="styles/profile.css">
        <link rel="stylesheet" type="text/css" href="styles/main_page.css">
		<link rel="stylesheet" type="text/css" href="styles/login_banner.css">
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
		<link href="styles/main_banner.css" rel="Stylesheet" type="text/css">
		<link href="styles/comments.css" rel="Stylesheet" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script type="text/javascript" src="core/client_side/log_in.js"></script>
		<script type="text/javascript" src="core/client_side/profile.js"></script>
		<script type="text/javascript" src="core/client_side/newPostArea.js"></script>
		<script type="text/javascript" src="core/client_side/usersConnections.js"></script>
		<script type="text/javascript" src="core/client_side/topComments.js"></script>
		<script type="text/javascript" src="core/client_side/usefulTools.js"></script>
		
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
		<div id="body">
		    <div id="postArea" style="display:none" align="center">
			    <?php
					include "newPostArea.php";
				?>
			</div>
    		    <?php
    		        $userManager = new UsersManager($connection);
    		        $userID = mysql_real_escape_string($_GET['id']);
    		        $username = $userManager->getUsername($userID);
    		        
    		        $profile = "<div id='profile'>
    		                        <p id='profile_picture'></p>
    		                        <p id='profile_username'>".$username."</p>";
    		        
    		        if ($userManager->getProfile($userID)) {
    		            if ($userID == $_SESSION['id']) {
    		                $profile .= "<button onClick='showProfileForm();' class='editProfileButton'>Edit profile</button>";
    		                echo "<div id='profileForm'>
                		            <p><button onClick='checkProfileFormValues()' class='editProfileButton' id='updateProfileButton'>Update</button><button onClick='closeProfileForm()' id='closeProfileFormButton'>Cancel</button></p>
                		            <textarea id='profileForm_description' placeHolder='Description:' cols='29' rows='9'></textarea>
                		          </div>";
    		            } else {
    		                if (isset($_SESSION['id'])) {
    		                    if (!$userManager->checkIfFollowing($_SESSION['id'], $userID)) {
    		                        $profile .= "<button id='$userID' onClick='follow(this);' class='editProfileButton'>Follow</button>";
    		                    }
    		                }
    		            }
    		            $description = $userManager->getDescription($userID);
    		            $spr = "<p id='profile_description'><br />%s</p>";
    		            $profile .= sprintf($spr, $description);
    		            
    		        } else{
    		            if ($userID == $_SESSION['id']) {
    		                $profile .= "<p id='profile_description'>You've not set up your profile yet.</p>";
    		                $profile .= "<button onClick='showProfileForm();' class='editProfileButton'>Set up profile</button>";
    		            } else {
    		                $profile .= "<p id='profile_description'>This user hasn't set up its profile yet.</p>";
    		                if (isset($_SESSION['id'])) {
        		                if (!$userManager->checkIfFollowing($_SESSION['id'], $userID)) {
        		                    $profile .= "<button id='$userID' onClick='follow(this);' class='editProfileButton'>Follow</button>";
        		                }
    		                }
    		            }
    		        }
    		        
    		        $profile .= "</div>";
    		        echo $profile;
    		        
    		    ?>
    		    <div id="topComments">
    		    <script>
    		        
    		        $(function() {
                        $( ".drag-post-it" ).draggable();
                        
                        $( ".drag-post-it" ).each(function() {
                            moveRandom($(this), "topComments");
                        });
                        
                    });
                    
                    
                    function makeDiv(cont) {
                        var numRand = Math.floor(Math.random() * 501);
                        var divsize = 100;
                        var posx = (Math.random() * ($(document).width() - divsize)).toFixed();
                        var posy = (Math.random() * ($(document).height() - divsize)).toFixed();
                        $newdiv = $(cont).css({
                            'left': posx + 'px',
                                'top': posy + 'px'
                        });
                        $newdiv.appendTo('#topComments').delay(2000).fadeIn(100, function () {
                            //$(this).remove();
                            makeDiv(cont);
                        });
                    }
                </script>
    		    <?php
    		        $colors = array("#FEFDCA", "#E9E74A", "#D0E17D", "#56C4E8", "#CDDD73", "#99C7BC", "#F9D6AC", "#BAB7A9");
		            $rc = new RandomColor($colors);
		            $postsManager = new PostsManager($connection);
		            
		            $query = "SELECT id FROM posts WHERE user='$userID' ORDER BY SCORE DESC LIMIT 5";
		            $q = mysql_query($query, $connection) or die("Best posts couldn't be loaded");
		            
		            while($d = mysql_fetch_assoc($q)) {
		                echo $postsManager->getPost($d['id'], $userManager, $rc);
		            }
    		    ?>
    		    </div>
		</div>
	</body>
</html>