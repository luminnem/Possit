function sendGif() {
    var url;
    
    if(window.XMLHttpRequest) {
       var xmlhttp = new XMLHttpRequest();
    }
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && status == 200) {
            var notifications = document.getElementById("notifications");
            var response = xmlhttp.responseText;
            notifications.style.display = "inline-block";
            
            if (response == "1") {
                notifications.innerHTML = "Gif sent correctly";
            } else {
                notifications.innerHTML = response;
            }
        }
    }
    
    xmlhttp.open("POST", "core/server_side/gifs.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("url="+url)
    
}