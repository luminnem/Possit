function showPicArea() {
	
	var textarea = document.getElementById("picArea");
	textarea.style.display = "block";
}

function hidePicArea() {
	var textarea = document.getElementById("picArea");
	textarea.style.display = "none";
	textarea.value = "";
}



function checkPicData() {
	var url = document.getElementById("picAreaUrl").value;
	var caption = document.getElementById("newPicCaption").value;
	
	if (url.length > 0 && caption.length > 0) {
		sendPic(url, caption);
		
	} else {
		var notifications = document.getElementById("notifications");
		notifications.style.display = "inline-block";
		notifications.innerHTML = "No enough characters";
	}
}
function sendPic(url, caption) {

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

				notifications.innerHTML = "Pic sent";
			} else {
				notifications.innerHTML = xmlhttp.responseText;
			}
			hidePicArea();
			
		}
	}
	
	xmlhttp.open("POST", "core/server_side/sendPic.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("url="+url+"&caption="+caption);
}