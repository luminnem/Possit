<?php

class PostsManager {
    
    private $connection;
    
    public function __construct($connection) {
        $this->connection = $connection;
    }
    
    
    public function getPost($postID, $usersManager, $rc) {
        $query = "SELECT user, body FROM posts WHERE id='$postID' LIMIT 1";
        $q = mysql_query($query, $this->connection) or die(mysql_error());
        
        while ($d = mysql_fetch_assoc($q)) {
			    $color = $rc->getRandomColor();
			    $dcolor = Brightness($color, 30);
			    
				$string = "<div class='drag-post-it' style='background: $color;
				            background: -moz-linear-gradient(to top, $dcolor 0&#37, $color 100&#37);
				            background: linear-gradient(to top, $dcolor 0&#37, $color 100&#37)'>
				            <img id='pin' src='/resources/pin.png'>
				            <a href='#'><span class='month_comments'>%s</span></a><div class='line'></div>
			            	<a href='profile.php?id=%d'><span class='username_comments'>%s</span></a>";
				
				$buttons = "<button class='button_comments' id='$d[ID]' onClick='upVote(this)'><img src='resources/upvote.png'></img></button>
				<button class='button_comments' id='$d[ID]' onClick='downVote(this)'><img src='resources/downvote.png'></img></button>";
				
				$close_div = "</div>";
				
				if (isset($_SESSION['id'])) {
					$string .= $buttons . $close_div;
				} else {
					$string .= $close_div;
				}
				
		return sprintf($string, str_replace(".\endl", "<br />", base64_decode($d['body'])), $d['user'], $usersManager->getUsername($d['user']));
        }
    }

}