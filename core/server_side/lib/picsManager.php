<?php

class PicturesManager {
	
	private $connection;
	
	public function __construct($connection) {
		$this->connection = $connection;
	}
	
	public function getPicture($picID, $userManager) {
		$query = "SELECT posts.id as ID, posts.user as userID, posts.body as url, posts_captions.caption as caption FROM posts LEFT JOIN posts_captions
			ON (posts_captions.post=posts.id) WHERE posts.id='$picID' LIMIT 1";
		
		$q = mysql_query($query, $this->connection) or die ("Lib error, couldn't load that pic ".mysql_error());
		
		$d = mysql_fetch_assoc($q);
		$string = "
					<div class='polaroid' style='font: Nothing You Could Do, arial;'>
						<img src='%s' alt='%s' width='200' height='200'></img>
						<span>%s</span>
						<hr>
						<a href='profile.php?id=%d'><span class='username_comments'>%s</span></a>";
				
		$buttons = "<button class='button_comments' id='$d[ID]' onClick='upVote(this)'><img src='resources/upvote.png' title='Fluffy :3'></img></button>
			<button class='button_comments' id='$d[ID]' onClick='downVote(this)'><img src='resources/downvote.png' title='WTF?'></img></button>";
			
		$close_div = "</div>";
			
		if (isset($_SESSION['id'])) {
			$string .= $buttons . $close_div;
		} else {
			$string .= $close_div;
		}
		
		
		$url = base64_decode($d['url']);
		$username = $userManager->getUsername($d['userID']);
		$caption = stripslashes(base64_decode($d['caption']));
		
		return sprintf($string, $url, $caption, $caption, $d['userID'], $userManager->getUsername($d['userID']));
	}
}