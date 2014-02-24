function showTextarea() {
	
	var textarea = document.getElementById("postArea");
	textarea.style.display = "block";
}

function hideTextarea() {
	var textarea = document.getElementById("postArea");
	textarea.style.display = "none";
	
	document.getElementById("postAreaText").value = "";
}



function checkData() {
	var area = document.getElementById("postAreaText").value;
	
	if (area.length > 0) {
		sendDataPost(area);
	} else {
		var notifications = document.getElementById("notifications");
		notifications.style.display = "inline-block";
		notifications.innerHTML = "No enough characters";
	}
}
function sendDataPost(area) {

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			/*RESPUESTA*/
			var response = xmlhttp.responseText;
			var notifications = document.getElementById("notifications");
			
			notifications.style.display = "inline-block";
			
			if (response == "1") {
				hideTextarea();
				
				notifications.innerHTML = "Post sent";
			} else {
				notifications.innerHTML = xmlhttp.responseText;
			}
			
		}
	}
	
	xmlhttp.open("POST", "core/server_side/sendPost.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("data="+area);
}