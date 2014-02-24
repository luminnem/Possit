<?php
	include("core/server_side/lib/usersManager.php");
	include("core/server_side/lib/postsManager.php");
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

<div id="month" class="scroll-box">
        
        <a style="float:right;" href="javascript:void(0)" title="Close" onClick="theBox(false, 'month', 'showBtn')"><img src="/resources/close.png"></a>
		<p>Top Comments</p>
		<?php 
		    require("core/server_side/lib/postitColor.php");
		    
		    // PostIt Colors, add more!
		    $colors = array("#FEFDCA", "#E9E74A", "#D0E17D", "#56C4E8", "#CDDD73", "#99C7BC", "#F9D6AC", "#BAB7A9", "#AAAAAA");
		    $rc = new RandomColor($colors);
		    
			$query_string = "SELECT id FROM posts WHERE DAY(post_date) = DAY(CURDATE()) ORDER BY score DESC LIMIT 5";
			$q = mysql_query($query_string, $connection);
			$usersManager = new UsersManager($connection);
			$postsManager = new PostsManager($connection);
			while ($d = mysql_fetch_assoc($q)) {
			    echo $postsManager->getPost($d['id'], $usersManager, $rc);
			}
		?>
</div>

<div id="day">
<?php?>
</div>