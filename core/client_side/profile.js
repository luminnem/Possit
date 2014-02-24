function showProfileForm() {
    var form = document.getElementById("profileForm");
    form.style.display = "inline-block";
    var buttons = document.getElementsByClassName("editProfileButton");
    buttons[0].style.display = "none";
}

function closeProfileForm() {
    var form = document.getElementById("profileForm");
    form.style.display = "none";
    var buttons = document.getElementsByClassName("editProfileButton");
    buttons[0].style.display = "inline-block";
}


function checkProfileFormValues() {
    var description = document.getElementById("profileForm_description").value;
    var notifications = document.getElementById("notifications");
    updateProfileForm(description, notifications);
}

function updateProfileForm(description, notifications) {
    
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    }
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //RESPONSE;
            notifications = document.getElementById("notifications");
            notifications.style.display = "inline-block";
            var response = xmlhttp.responseText;
            
            if (response == "1") {
                notifications.innerHTML = "Profile updated correctly";
            } else {
                notifications.innerHTML = response;
            }
        }
    };
    
    xmlhttp.open("POST", "core/server_side/updateProfile.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("description="+description);
}