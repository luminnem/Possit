function showMsg(text) {	
	var el = document.getElementById("msger");
	el.style.bottom = "-50px";
	
	el.innerHTML = "&nbsp;&nbsp;<img src='/resources/warning.png'><span style='color:#1C1C1C;font:14px Helvetica;'>&nbsp;" + text + "</span>";
	
	setTimeout(function() {
		el.style.bottom = "0";
	}, 2);
	setTimeout(function() {
		el.style.bottom = "-50px";
	}, 4000);
}
function theBox(state, box_id, btn_id) {
    var box = document.getElementById(box_id);
    var btn = document.getElementById(btn_id);
    if (state === false) {
        if (btn !== null) {
            btn.style.opacity = "100";
            btn.style.marginTop = "0";
        }

        box.style.top = "-280px";
        box.style.opacity = "0";
        setTimeout(function() {
            box.style.display = "none";
        }, 500);

    } else if (state === true) {
        if (btn !== null) {
            btn.style.opacity = "0";
            btn.style.marginTop = "-100px";
        }
        box.style.display = "initial";
        setTimeout(function() {
            box.style.top = "0";
            box.style.opacity = "100";
        }, 100);
    }
}

var zindex = 10;

function randomFromTo(from, to){
			return Math.floor(Math.random() * (to - from + 1) + from);
		}

function bringFront(obj) {
	obj.style.zIndex = ++zindex;
}

function moveRandom(obj, container) {
	/* get container position and size
	 * -- access method : cPos.top and cPos.left */
	var cPos = $('#'+container).offset();
	var cHeight = $(window).height() / 2;
	var cWidth = $(window).width();
	// get box padding (assume all padding have same value)
	
	var pad = parseInt($('.drag-post-it').css('padding-top').replace('px', ''));
	
	// get movable box size
	var bHeight = obj.height();
	var bWidth = obj.width();
	
	// set maximum position
	maxY = cHeight - bHeight - pad;
	maxX = cWidth - bWidth - pad;
	
	// set minimum position
	minY = 100 + pad;
	minX = 20 + pad;
	
	// set new position			
	newY = randomFromTo(minY, maxY);
	newX = randomFromTo(minX, maxX);
	
	obj.animate({
		top: newY,
		left: newX
		}, 300);
	
	if (obj.offset().top > cHeight) {
		obj.offset({top: cHeight - bHeight, left: newX});
	}
}

function Rand (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function scrolled() {
	if ($(document).scrollTop() > 0) {
		$('#banner_t').css("position", "fixed");
	} else {
		$('#banner_t').css("position", "static");
	}
}