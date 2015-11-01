<table align="center" id="tag_buttons">
	<tr>
		<td><input type="button" value="Fluffy images" id="fluffyImages" onClick="loadClassifiedPosts('fluffy', 2, this)"></td>
		<td><input type="button" value="Fluffy texts" id="fluffyTexts" onClick="loadClassifiedPosts('fluffy', 1, this)"></td>
		<td><input type="button" value="Funny images" id="funnyImages" onClick="loadClassifiedPosts('funny', 2, this)"></td>
		<td><input type="button" value="Funny texts" id="funnyTexts" onClick="loadClassifiedPosts('funny', 1, this)"></td>
	</tr>
</table>

<div id="posts_container">


	<?php
	/*
	 * if(isset($_GET["tag"]))
	 * $tag = mysql_real_escape_string($_GET["tag"]);
	 * else
	 * $tag = "";
	 * if (isset($_GET["type"]))
	 * $type = mysql_real_escape_string($_GET["type"]);
	 * else
	 * $type = "";
	 *
	 *
	 *
	 * if (!isset($_SESSION['id'])) {
	 * $query = "SELECT id FROM posts WHERE MONTH(post_date) = MONTH(CURDATE())
	 * AND type = \"$type\" AND tag = \"$tag\" ORDER BY score DESC LIMIT 10";
	 * $q = mysql_query($query, $connection) or die(mysql_error()."Best comments couldn't be got");
	 * while ($d = mysql_fetch_assoc($q)) {
	 * $postID = $d['id'];
	 * echo $postsManager->getPost($postID, $usersManager, "#B2FC3A", "#283C80", "#283C80", "One of the best pics this month");
	 * }
	 */
	
	/*
	 * $query = "SELECT id FROM posts WHERE MONTH(post_date) = MONTH(CURDATE()) AND type='1'
	 * AND tag = \"$tag\" ORDER BY score DESC LIMIT 10";
	 * $q = mysql_query($query, $connection) or die("Best comments couldn't be got");
	 * while ($d = mysql_fetch_assoc($q)) {
	 * $postID = $d['id'];
	 * echo $postsManager->getPost($postID, $usersManager, "#B2FC3A", "#283C80", "#283C80", "One of the best posts this month");
	 * }
	 * }
	 */
	?>
</div>

<div id="friends" style="width: 100%; height: 50%;">
	<script>
		$(function() {
			$( ".drag-post-it" ).draggable();
			$( ".polaroid" ).draggable();
		});

	</script>
	<?php
	if (isset ( $_SESSION ['id'] )) {
		$userID = mysql_real_escape_string ( $_SESSION ['id'] );
		if (isset ( $_GET ["tag"] ))
			$tag = mysql_real_escape_string ( $_GET ["tag"] );
		else
			$tag = "";
		if (isset ( $_GET ["type"] ))
			$type = mysql_real_escape_string ( $_GET ["type"] );
		else
			$type = "";
		
		$query = "SELECT posts.id as postID
					FROM users_connections
					LEFT JOIN posts ON (posts.user=users_connections.user_2)
					WHERE users_connections.user_1='$userID'
					AND tag = \"$tag\"
					AND type = \"$type\"
					ORDER BY post_date DESC
					LIMIT 20";
		
		$q = mysql_query ( $query, $connection ) or die ( mysql_error () );
		$posts = array ();
		while ( $d = mysql_fetch_assoc ( $q ) ) {
			$postID = $d ['postID'];
			array_push ( $posts, $postID );
		}
		$posts = array_unique ( $posts );
		foreach ( $posts as &$post ) {
			echo $postsManager->getPost ( $post, $usersManager, "#7F5F8A", "#FFF", "#283C80", "Latest from who you follow" );
		}
		unset ( $post );
	}
	?>
</div>
