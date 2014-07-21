<?php
	include "data.php";
	
	$query = "SELECT username FROM users";
	$q = mysql_query($query, $connection) or die ("problems with connection".mysql_error());
	while($d = mysql_fetch_assoc($q))
	{
		$user = $d["username"];
		$username = base64_decode($user);
		echo $username."<br>";
		$qur = "UPDATE users SET username='$username' WHERE username='$user'";
		$u = mysql_query($qur, $connection) or die (mysql_error());
	}