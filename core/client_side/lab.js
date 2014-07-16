function submitCaption(e, input) {
  var code = (e.keyCode ? e.keyCode : e.which);
  if (code == 13) {
    processInput(input);
  }
}

function processInput(input) {
  var caption = input.value;
  var id = input.getAttribute("name");
  if (caption == "") {
    return;
  } else {
    sendCaption(id, caption);
  }
}

function sendCaption(id, caption) {
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      //RESPONSE
      if (xmlhttp.responseText == "1") {
        showMsg("Caption added");
        var elem = document.getElementById(id);
        elem.parentNode.removeChild(elem);
      } else {
        showMsg("Ups... :$");
      }
    }
  }
  
  xmlhttp.open("POST", "core/server_side/send_caption.php", true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send("postID="+id+"&caption="+caption)
}