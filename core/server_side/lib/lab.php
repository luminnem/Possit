<?php

class Lab {
  
  private $connection;
  
  public function __construct($connection) {
    $this->connection = $connection;
  }
  public function getPicturesWithoutCaption($userID) {
    $userID = mysql_real_escape_string($_SESSION['id']);
    $query = "SELECT posts.ID as ID, body as URL FROM posts WHERE NOT EXISTS (SELECT ID FROM posts_captions WHERE post=posts.ID LIMIT 1) AND type=2 AND user='$userID'";
    
    $q = mysql_query($query, $this->connection) or die("Lib errror, pictures captions couldn't be loaded ");
    
    return $q;

  }
}