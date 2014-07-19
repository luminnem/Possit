<div id="newPostArea" class="scroll-box">
        <a style="float:right;" href="javascript:void(0)" title="Close" onClick="theBox(false, 'newPostArea', '')"><img src="/resources/close.png"></a>
		<textarea class="note-text" cols="29" rows="9" maxLength="270" id="postAreaText" placeHolder="What the cat are you doing?"></textarea>
		<p>
		<?php
			if (curPageName() == "profile.php") {
				$postUserId = mysql_real_escape_string($_GET["id"]);
			} else if (curPageName() == "post.php") {
				$postPostId = mysql_real_escape_string($_GET["id"]);
			}
		?>
		    <button id="send_post" class="login_button_big" title="Post it" onClick="checkPostData(
			<?php
				if(isset($postUserId))
				{
					echo "'$postUserId"."u'";
				}
				else if(isset($postPostId))
				{
					echo "'$postPostId"."p'";
				}
				else echo ""; 
			?>
			);">Send</button>
		</p>
</div>