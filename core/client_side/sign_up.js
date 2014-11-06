function checkForm() {
	var username = document.getElementById("register_username").value;

	var password = document.getElementById("register_password").value;
	var repeat_password = document.getElementById("repeat_password").value;

	var email = document.getElementById("register_email").value;

	var captcha = document.getElementById("captcha").value;
	var captcha_img = document.getElementById("captcha_img");

	if (password == repeat_password) {
		CheckCaptcha(captcha, captcha_img, CheckAndSend(username, email, password));
	} else showMsg("Passwords must match");
}

function CheckAndSend(username, email, password){
	if (CheckValues(username, email, password))
		if (CheckEmail(email))
			sendData(username, password, email);
		else
			showMsg("You must enter a valid email");
	else
		showMsg("You must fill all fields");
}

function CheckValues(username, email, password) {
	$invalid = true;
	if (username == "") $invalid = false;
	else if (email == "") $invalid = false;
	else if (password == "") $invalid = false;
	return $invalid;
}
function CheckEmail(email) {
	if (email.indexOf('@') > -1) return true;
	else return false;
}

function CheckCaptcha(captcha, captcha_img, callback) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var response = xmlhttp.responseText;
			if (response == "1") callback;
			else {
				captcha_img.src = "captcha.php?" + new Date().getTime();
			}
		}
	}

	xmlhttp.open("POST", "core/server_side/check_captcha.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("answer="+captcha);
}

function sendData(username, password, email) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var response = xmlhttp.responseText;
			if (response == "1") {
				showMsg("Enjoy");
			} else {
				showMsg(response);
			}
		}
	}

	xmlhttp.open("POST", "core/server_side/sign_up.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("username="+username+"&password="+password+"&email="+email);
}
