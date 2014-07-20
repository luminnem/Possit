function checkKeysToSubmit(e) {
  var code = (e.keyCode ? e.keyCode : e.which);
  if (code == 13) {
    checkLogInForm();
  }
}



function checkLogInForm() {

	var username = document.getElementById("login_username").value;
	var password = document.getElementById("login_password").value;
	var error = document.getElementById("error");
	
	if (username != "" && password != "") {
		sendLogInData(username, password, error);
	} else {
		error.innerHTML = "...";
	}
}

function sendLogInData(username, password, error) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//RESPONSE
			
			if (xmlhttp.responseText == "1") {
				location.reload(true);
				
			} else {
				showMsg(xmlhttp.responseText);
			}
		}
	}
	
	xmlhttp.open("POST", "core/server_side/log_in.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("username="+username+"&password="+password);
}