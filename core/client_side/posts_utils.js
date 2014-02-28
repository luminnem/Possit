function deleteComment(postID) {
  if (window.XMLHttpRequest) {
    var xmlhttp = new XMLHttpRequest();
  }

  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      /*Response*/
      var response = xmlhttp.responseText;
    }
  }
  
  xmlhttp.open("POST", "core/server_side/deleteUserComment.php", true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send("commentID="+postID);
}