<?php
require_once("postitColor.php");

class PostsManager {
    
    private $connection;
    
    public function __construct($connection) {
        $this->connection = $connection;
    }
    
	public function getPost($postID, $usersManager, $color, $usernameColor, $title, $closeButton=false) {
		$query = "SELECT type FROM posts WHERE id='$postID' LIMIT 1";
		$q = mysql_query($query, $this->connection);
		
		$d = mysql_fetch_assoc($q);
		$type = mysql_real_escape_string($d['type']);
		
		switch ($type) {
			case 1:
				return $this->getTextPost($postID, $usersManager, $color, $usernameColor, $title, $closeButton);
				break;
			case 2:
				return $this->getPicture($postID, $usersManager, $color, $usernameColor, $title, $closeButton);
				break;
		}
		
	}
    private function getTextPost($postID, $usersManager, $clr, $usernameColor, $title, $closeButton) {
        $query = "SELECT user, body FROM posts WHERE id='$postID' LIMIT 1";
        $q = mysql_query($query, $this->connection) or die(mysql_error());
        
        $color = $clr;
		$bcolor = Brightness($color, 60);
        
        while ($d = mysql_fetch_assoc($q)) {
			
				$string = "<div onmousedown='bringFront(this)' id='post' class='drag-post-it' title='$title' style='display: block; float:left; background: $color; background: linear-gradient(to top $color $bcolor);'>";
				$string_2 = "<img id='pin' src='/resources/pin.png'>
						<a href='post.php?id=%d'><span class='month_comments'>%s</span></a><div class='line'></div>
						<a href='profile.php?id=%d' style='color: $usernameColor !important;'><span class='username_comments'>%s</span></a>";
			
			$buttons = "<button class='button_comments' id='$postID' onClick='upVote(this)'><img src='resources/upvote.png' title='Fluffy'></img></button>
			<button class='button_comments' id='$postID' onClick='downVote(this)'><img src='resources/downvote.png' title='Worse than a poop'></img></button>";
			
			$close_div = "</div>";
			
			$close_button = "<button onClick='deleteComment($postID)'>X</button>";
			
			if (isset($_SESSION['id'])) {
				if ($_SESSION['id'] == $d['user'] && $closeButton) {
						$string .= $close_button . $string_2 . $close_div;
				}
				$string .= $string_2 . $buttons . $close_div;
			} else {
				$string .= $string_2 . $close_div;
			}
			
			$blankline = str_replace(".\endl", "<br />", base64_decode($d['body']));
			$blankline = stripslashes($blankline);
			return sprintf($string, $postID, $blankline, $d['user'], $usersManager->getUsername($d['user']));
        }
    }
	
	private function getPicture($picID, $userManager, $color, $usernameColor, $title, $closeButton) {
		$query = "SELECT posts.user as userID, posts.body as url, posts_captions.caption as caption FROM posts LEFT JOIN posts_captions
			ON (posts_captions.post=posts.id) WHERE posts.id='$picID' LIMIT 1";
		
		$q = mysql_query($query, $this->connection) or die ("Lib error, couldn't load that pic ");
		
		$bcolor = Brightness($color, 60);
		$d = mysql_fetch_assoc($q);
		$caption = base64_decode($d['caption']);
		$string = "<div onmousedown='bringFront(this)' id='post' class='polaroid' title='$title' style='display:block; float:left; background: $color; background: linear-gradient(to top $color $bcolor);'>
						<a href='post.php?id=%d'><img src='%s' alt='%s' width='200' height='200' title='$caption'></img>
						<span>%s</span></a>
						<div class='line'></div>
						<a href='profile.php?id=%d' style='color: $usernameColor !important;'><span class='username_comments'>%s</span></a>";
				
		$buttons = "<button class='button_comments' id='$picID' onClick='upVote(this)'><img src='resources/upvote.png' title='Fluffy'></img></button>
			<button class='button_comments' id='$picID' onClick='downVote(this)'><img src='resources/downvote.png' title='Worse than a poop'></img></button>";
			
		$close_div = "</div>";
			
		if (isset($_SESSION['id'])) {
			$string .= $buttons . $close_div;
		} else {
			$string .= $close_div;
		}
		
		
		$url = base64_decode($d['url']);
		$username = $userManager->getUsername($d['userID']);
		$caption = stripslashes(base64_decode($d['caption']));
		
		return sprintf($string, $picID, $url, $caption, $caption, $d['userID'], $userManager->getUsername($d['userID']));
	}
	
	
	public function getRawUrls($postsID) {
		while ($d = mysql_fetch_assoc($postsID)) {
				$url = base64_decode($d['URL']);
				$id = $d['ID'];
				$string = "<div class='rawImage' id='$id'>
						<p><img src='%s' width='200' height='200'></img></p>
						<p><input type='text' placeHolder='Picture caption' name='%d' class='rawImageInput' onKeyDown='submitCaption(event, this)'></p>
				</div>";
				echo sprintf($string, $url, $id);
		}
	}
}