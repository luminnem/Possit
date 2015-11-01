function loadClassifiedPosts(tg, tpe, button) {
	var tag = tg;
	var type = tpe;
	resetStyles();
	
	button.style.border = "1px darkgray solid";
	
	
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("posts_container").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "core/server_side/getClassifiedPosts.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("tag="+tag+"&type="+type);
}

function resetStyles() {
	document.getElementById("fluffyImages").style.border = "1px silver solid";
	document.getElementById("fluffyImages").style.borderBottom = 0;
	
	document.getElementById("fluffyTexts").style.border = "1px silver solid";
	document.getElementById("fluffyTexts").style.borderBottom = 0;
	
	document.getElementById("funnyImages").style.border = "1px silver solid";
	document.getElementById("funnyImages").style.borderBottom = 0;
	
	document.getElementById("funnyTexts").style.border = "1px silver solid";
	document.getElementById("funnyTexts").style.borderBottom = 0;
	
}