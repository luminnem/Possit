<?php

class UsersManager {
	
	private $connection;
	
	public function __construct($connection) {
		$this->connection = $connection;
	}
	
	public function getUsername($userID) {
		$query_string = "SELECT username FROM users WHERE id='$userID' LIMIT 1";
		$q = mysql_query($query_string, $this->connection) or die ("Lib error, couldn't load the username");
		$d = mysql_fetch_assoc($q);
		return ucfirst(base64_decode($d['username']));
	}
	
	public function getProfile($userID) {
	    $query = "SELECT ID FROM profiles WHERE userID='$userID' LIMIT 1";
	    $q = mysql_query($query, $this->connection) or die ("Lib error, couldn't load the profile");
	    if (mysql_num_rows($q) == 1) {
	        return true;
	    } else {
	        return false;
	    }
	}
	
	public function getDescription($userID) {
	    $query = "SELECT description FROM profiles WHERE userID='$userID' LIMIT 1";
	    $q = mysql_query($query, $this->connection) or die ("Lib error, couldn't load user description");
	    if (mysql_num_rows($q) == 1) {
            $d = mysql_fetch_assoc($q);
            return base64_decode($d['description']);
	    } else {
	        return false;
	    }
	}
	
	public function checkIfFollowing($user_1, $user_2) {
	    $query = "SELECT ID FROM users_connections WHERE user_1='$user_1' AND user_2='$user_2' LIMIT 1";
	    $q = mysql_query($query, $this->connection) or die("Friendship couldn't be checked");
	    if (mysql_num_rows($q) == 1) {
	        return true;
	    } else {
	        return false;
	    }
	}
	
	public function getNumberOfFollowers($user) {
	    $query = "SELECT user_1 FROM users_connections WHERE user_2 = '$user'";
	    $q = mysql_query($query, $this->connection) or die("Numbers of followers couldn't be got");
	    return mysql_num_rows($q);
	}
	
	public function getProfilePicture($userID) {
		$query = "SELECT picture FROM profiles WHERE userID='$userID' LIMIT 1";
		$q = mysql_query($query, $this->connection) or die("Lib error, User's profile picture couldn't be loaded");
		
		if (mysql_num_rows($q) == 1) { // If has profile picture return it.
			$d = mysql_fetch_assoc($q);
			$picUrl = base64_decode($d['picture']);
			if ($picUrl != "") {
				// If the url of the picture provided by the user is valid a html img tag is created to display that image.
				$tag = "<img src='$picUrl' id='user_profile_picture' width='50' height='50'>";
			} else {
				// If the url of the picture provided by the user is null, the default picture is shown.
				$tag = "<img src='resources/default_profile_picture.jpg' id='user_profile_picture' width='50' height='50'>";
			}
		} else { // If the user doesn't have a profile picture, return the default one.
			$tag = "<img src='resources/default_profile_picture.jpg'>";
		}
		
		return $tag;
	}
}