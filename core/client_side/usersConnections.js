function follow(user, button) {
    
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    }
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = xmlhttp.responseText;
            
			if (response == "1") {
                showMsg("Following!")
				button.disabled = true;
            } else {
                showMsg(response);
            }
        }
    }
    xmlhttp.open("POST", "core/server_side/follow.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("user="+user);
}