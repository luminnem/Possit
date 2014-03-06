function follow(user) {
    
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    }
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var notifications = document.getElementById("notifications");
            notifications.style.display = "inline-block";
            var response = xmlhttp.responseText;
            if (response == "1") {
                user.innerHTML = "Following!";
                user.disabled = true;
            } else {
                notifications.innerHTML = response;
            }
        }
    }
    
    xmlhttp.open("POST", "core/server_side/follow.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("user="+user.id);
}