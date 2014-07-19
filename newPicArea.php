<div id="newPicArea" class="scroll-box">
        <a style="float:right;" href="javascript:void(0)" title="Close" onClick="theBox(false, 'newPicArea', '')"><img src="/resources/close.png"></a>
		<textarea class="note-text" cols="10" rows="8" maxLength="270" id="picAreaUrl" placeHolder="Picture(s) url(s)"></textarea>
		<p>
		<?php
			if (curPageName() == "profile.php") {
				$postUserId = mysql_real_escape_string($_GET['id']);
			} else if (curPageName() == "post.php") {
				$postPostId = mysql_real_escape_string($_GET["id"]);
			}
		?>
		    <button class="login_button_big" id="send_picture" title="Post it" onClick="checkPicData(
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
			)">Send</button>
		</p>
</div>