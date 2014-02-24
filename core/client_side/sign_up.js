function checkForm() {
	var username = document.getElementById("register_username").value;
	var password = document.getElementById("register_password").value;
	var email = document.getElementById("register_email").value;
	var error = document.getElementById("error_message");
	
	if (username != "" || password != "" || email != "") {
		sendData(username, password, email, error);
	} else {
		error.innerHTML = "Must fill all fields";
	}
}

function sendData(username, password, email, error) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			error.innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "core/server_side/sign_up.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("username="+username+"&password="+password+"&email="+email);
}