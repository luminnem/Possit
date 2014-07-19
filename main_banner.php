<?php
function curPageName() {
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
?>
<script>
	scrolled();
	$(window).scroll(function () { scrolled(); });
</script>
<table id="banner_t">
	<tr>
		<td id="title">
			<a href="index.php"><span id="title">Posit</span></a>
		</td>
		<td id="user_buttons" class="banner_text">
			<p>
				<a style="font-size: 16px" class="banner_link" href="#">Friends</a>
				&nbsp; &nbsp; &nbsp;
				<a style="font-size: 16px" class="banner_link" href="lab.php">Captions Lab</a>
			</p>
		</td>
		<td>
			<form style="margin:0;" action="search.php" method="get" id='searchForm'>
				<input id="searchbox" name="username" placeholder="Search" onKeyDown='checkToSearch(event)'>
			</form>
		</td>
		<td style="width:32px" id="newPostIcon">
			<button id="newPostButton" class="banner_button" onClick="showTextarea(); theBox(true, 'newPostArea', ''); theBox(false, 'month', 'showBtn');" title="
			<?php
				if (curPageName() == "profile.php") echo "Leave note to this user";
				else if (curPageName() == "post.php") echo "Leave reply";
				else echo "New note"; 
			?>
			">
			<img src="resources/new_note.png"></img></button>
		</td>
		<td style="width:32px" id="newPicIcon">
			<button id="newPicIcon" class="banner_button" onClick="showPicArea(); theBox(true, 'newPicArea', ''); theBox(false, 'month', 'showBtn');"
			title="
			<?php
				if (curPageName() == "profile.php") echo "Leave picture to this user";
				else if (curPageName() == "post.php") echo "Leave picture as reply";
				else echo "New picture"; 
			?>
			"><img src="resources/new_pic.png"></img></button>
		</td>
		<td>
			<span id="notifications"></span>
		</td>
		<td id="current_user" class="banner_text">
			<a class="banner_link" href="#">
				<?php echo $usersManager->getProfilePicture("$_SESSION[id]"); ?>
				&nbsp;
				<?php
				$name = "<a href='profile.php?id=%d'>%s</a>";
				$username = ucfirst(base64_decode($_SESSION["username"]));
				$id = $_SESSION['id'];
				echo sprintf($name, $id, $username)
				?>
			</a>
				&nbsp; &nbsp; &nbsp;
			<a class="banner_link" href="core/server_side/log_out.php">
				LogOut
			</a>
		</td>
	</tr>
</table>