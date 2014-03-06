function showProfileForm() {
    var form = document.getElementById("modifyProfileForm");
    form.style.display = "inline-block";
    
    /*
    var form = document.getElementById("profileForm");
    form.style.display = "inline-block";
    var buttons = document.getElementsByClassName("editProfileButton");
    buttons[0].style.display = "none";*/
}

function closeProfileForm() {
    var form = document.getElementById("profileForm");
    form.style.display = "none";
    var buttons = document.getElementsByClassName("editProfileButton");
    buttons[0].style.display = "inline-block";
}


function check_modify_profile_form() {
    
    var description = document.getElementById("modify_profile_description").value;
    var profile_picture = document.getElementById("modify_profile_img_url").value;
    
    if (description != "" || profile_picture != "") {
        updateProfile(description, profile_picture);
    }
    
}

function updateProfile(description, profile_picture) {
    
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    }
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            /*RESPONSE*/
            var response = xmlhttp.responseText;
            if (response == "1") {
                showMsg("Profile updated correctly");
            } else {
                showMsg(response);
            }
        }
    };
    
    xmlhttp.open("POST", "core/server_side/updateProfile.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    
    if (description == "") {
        xmlhttp.send("profilePicture="+profile_picture);
    } if (profile_picture == "") {
        xmlhttp.send("description="+description);
    } if (description != "" && profile_picture != "") {
        xmlhttp.send("description="+description+"&profilePicture="+profile_picture);
    }
}