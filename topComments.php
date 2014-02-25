<?php
	include("core/server_side/lib/usersManager.php");
	include("core/server_side/lib/postsManager.php");
	include("core/server_side/lib/picsManager.php");
	require_once("core/server_side/data.php");
?>

<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="/core/client_side/usefulTools.js"></script>

<html>
<body onLoad="theBox(false, 'month', 'showBtn')">
</body>
</html>

<div id="showBtn">
    <a href="javascript:void(0)" title="Show top Comments" onClick="theBox(true, 'month', 'showBtn'); theBox(false, 'newPostArea', '');"><center><img src="/resources/top_com_btn.png"></center></a>
</div>

<!--<div id="month" class="scroll-box">
        
        <a style="float:right;" href="javascript:void(0)" title="Close" onClick="theBox(false, 'month', 'showBtn')"><img src="/resources/close.png"></a>
		<p>Fluffy Things</p>
		<?php 
		    require("core/server_side/lib/postitColor.php");
		    
		    // PostIt Colors, add more!
		    $colors = array("#FEFDCA", "#E9E74A", "#D0E17D", "#56C4E8", "#CDDD73", "#99C7BC", "#F9D6AC", "#BAB7A9", "#AAAAAA");
		    $rc = new RandomColor($colors);
		    
			$query_string = "SELECT id, type FROM posts WHERE DAY(post_date) = DAY(CURDATE()) ORDER BY score DESC LIMIT 5";
			$q = mysql_query($query_string, $connection);
			$usersManager = new UsersManager($connection);
			$postsManager = new PostsManager($connection);
			$picsManager = new PicturesManager($connection);
			
			while ($d = mysql_fetch_assoc($q)) {
				switch($d['type']) {
				case 1:
					echo $postsManager->getPost($d['id'], $usersManager, $rc);
					break;
				case 2:
					echo $picsManager->getPicture($d['id'], $usersManager);
					break;
				}
			}
		?>
</div>-->

<div id="friends">
	<script>	
		$(function() {
			$( ".drag-post-it" ).draggable();
			
			$( ".drag-post-it" ).each(function() {
				moveRandom($(this), "topComments");
			});
			
			
			$( ".polaroid" ).draggable();
			
			$( ".polaroid" ).each(function() {
				moveRandom($(this), "topComments");
			});
		});
		
	</script>
	<?php
		if (isset($_SESSION['id'])) {
				$userID = mysql_real_escape_string($_SESSION['id']);
				
				$query = "SELECT posts.id as postID,
					posts.user as user,
					posts.type as type
					FROM users_connections
					LEFT JOIN posts ON (posts.user=users_connections.user_2)
					WHERE users_connections.user_1='$userID'
					ORDER BY SCORE DESC
					LIMIT 10";
				$q = mysql_query($query, $connection) or die (mysql_error());
				while ($d = mysql_fetch_assoc($q)) {
					$postID = $d['postID'];
					$userID = $d['user'];
					$type = $d['type'];
					switch($type) {
						case 1:
							echo $postsManager->getPost($postID, $usersManager, $rc);
							break;
						case 2:
							echo $picsManager->getPicture($postID, $usersManager);
							break;
					}
				}
		}
	?>
</div>