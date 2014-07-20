<script>	
		$(function() {
			$( ".drag-post-it" ).draggable();
			$( ".polaroid" ).draggable();
		});
		
</script>

<?php
	$postID = mysql_real_escape_string($_GET["id"]);
	echo "<div style='width:100%; float:left;'>".$postsManager->getPost($postID, $usersManager, "#51ADEE", "#FFF", "#283C80", "Main post")."</div>";
	
	$query = "SELECT reply FROM posts_replies WHERE post='$postID' ORDER BY ID DESC LIMIT 10";
	$q = mysql_query($query, $connection) or die ("Replies couldn't be loaded".mysql_error());
	echo "<div>";
	while($d = mysql_fetch_assoc($q))
	{
		echo $postsManager->getPost($d["reply"], $usersManager, "#FBF937", "#283C80", "#283C80", "Replies to this post");
	}
	echo "</div>";
	