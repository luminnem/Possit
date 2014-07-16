function showTextarea() {
	
	var textarea = document.getElementById("postArea");
	textarea.style.display = "block";
}

function hideTextarea() {
	var textarea = document.getElementById("postArea");
	textarea.style.display = "none";
}

function checkPostData(userID) {
	var area = document.getElementById("postAreaText").value;
	var userID = userID;
	
	if (area.length > 0) {
		if (userID != "" && userID != "p" && userID != "u")  sendPost(area, userID);
		else sendPost(area, "");
	} else {
		showMsg("No enough characters!");
	}
	
	var ta = document.getElementById("postAreaText");
	ta.value = "";
	
}
function sendPost(area, userID) {

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
				showMsg("Post sent!");
			} else {
				showMsg(xmlhttp.responseText);
			}
			theBox(false, "newPostArea", "");
			
		}
	}
	
	xmlhttp.open("POST", "core/server_side/sendPost.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
	if (userID != "")
	{
		if (!isReply(userID))
		{
			xmlhttp.send("data="+area+"&to="+userID.replace('u', '')+"&reply=false");
		}
		else
		{
			xmlhttp.send("data="+area+"&to="+userID.replace('p', '')+"&reply=true");
		}
	}
	else xmlhttp.send("data="+area);
}

function isReply(userID) {
	if (userID.indexOf('p') === -1)
	{
		return false;
	}
	
	else
	{
		return true;
	}
}