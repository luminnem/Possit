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
	var userID = userID;

	if (url.length > 0) {
		if(typeof userID !== 'undefined') sendPic(url, userID);
		else sendPic(url, "");
		
	} else {
		showMsg("No enough characters");
	}
		
	var ta = document.getElementById("picAreaUrl");
	ta.value = "";
	
}
function sendPic(url, userID) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			/*RESPUESTA*/
			var response = xmlhttp.responseText;
			showMsg(response);
			theBox(false, "newPicArea", "");
		}
	}
	
	xmlhttp.open("POST", "core/server_side/sendPic.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
	if (userID != "")
	{
		if (!isReply(userID))
		{
			xmlhttp.send("url="+url+"&to="+userID.replace('u', '')+"&reply=false");
		}
		else
		{
			xmlhttp.send("url="+url+"&to="+userID.replace('p', '')+"&reply=true");
		}
	}
	else xmlhttp.send("url="+url);
	
	function isReply(userID) {
		if (userID.indexOf('p') === -1)
			return false;
		else
			return true;
	}
}