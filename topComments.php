
<div id="fluffy_things">
	<?php
		if (!isset($_SESSION['id'])) {
			$query = "SELECT id FROM posts WHERE MONTH(post_date) = MONTH(CURDATE()) AND type='2' ORDER BY score DESC LIMIT 5";
			$q = mysql_query($query, $connection) or die("Best comments couldn't be got");
			while ($d = mysql_fetch_assoc($q)) {
				$postID = $d['id'];
				echo $postsManager->getPost($postID, $usersManager, "#FE2E64", "#FFF", "One of the best pics this month");
			}
			
			$query = "SELECT id FROM posts WHERE MONTH(post_date) = MONTH(CURDATE()) AND type='1' ORDER BY score DESC LIMIT 5";
			$q = mysql_query($query, $connection) or die("Best comments couldn't be got");
			while ($d = mysql_fetch_assoc($q)) {
				$postID = $d['id'];
				echo $postsManager->getPost($postID, $usersManager, "#64FE2E", "#FFF", "One of the best posts this month");
			}
		}
	?>
</div>

<div id="friends" style="width: 100%; height: 50%;">
	<script>	
		$(function() {
			$( ".drag-post-it" ).draggable();
			
			$( ".drag-post-it" ).each(function() {
				moveRandom($(this), "friends");
			});
			
			
			$( ".polaroid" ).draggable();
			
			$( ".polaroid" ).each(function() {
				moveRandom($(this), "friends");
			});
		});
		
	</script>
	<?php
		if (isset($_SESSION['id'])) {
				$userID = mysql_real_escape_string($_SESSION['id']);
				
				$query = "SELECT posts.id as postID
					FROM users_connections
					LEFT JOIN posts ON (posts.user=users_connections.user_2)
					WHERE users_connections.user_1='$userID'
					ORDER BY post_date DESC
					LIMIT 20";
					
				$q = mysql_query($query, $connection) or die (mysql_error());
				while ($d = mysql_fetch_assoc($q)) {
					$postID = $d['postID'];
					
					echo $postsManager->getPost($postID, $usersManager, "#F4FA58", "#0CD", "Latest from who you follow");
				}
		}
	?>
</div>