function showPicArea() {
	
	var textarea = document.getElementById("picArea");
	textarea.style.display = "block";
}

function hidePicArea() {
	var textarea = document.getElementById("picArea");
	textarea.style.display = "none";
	textarea.value = "";
}



function checkPicData(userID) {
	var url = document.getElementById("picAreaUrl").value;
	var caption = document.getElementById("newPicCaption").value;

	if (url.length > 0 && caption.length > 0) {
		if (userID != "") sendPic(url, caption, userID);
		else sendPic(url, caption);
		
	} else {
/*		var notifications = document.getElementById("notifications");
		notifications.style.display = "inline-block";*/
		showMsg("No enough characters");
	}
		
	var ta = document.getElementById("picAreaUrl");
	ta.value = "";
	
}
function sendPic(url, caption, userID) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			/*RESPUESTA*/
			var response = xmlhttp.responseText;
			
			if (response == "1") {
				showMsg("Picture sent!");
			} else if (response == "2"){
				showMsg("Ups an error ocurred");
			} else {
				showMsg("You must enter a valid image url");
			}
			theBox(false, "newPicArea", "");
			
		}
	}
	
	xmlhttp.open("POST", "core/server_side/sendPic.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	if (userID != "") xmlhttp.send("url="+url+"&caption="+caption+"&to="+userID);
	else xmlhttp.send("url="+url+"&caption="+caption);
}