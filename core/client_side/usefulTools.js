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
        }, 500);
    }
}

function randomFromTo(from, to){
			return Math.floor(Math.random() * (to - from + 1) + from);
		}
  
		function moveRandom(obj, container) {
			/* get container position and size
			 * -- access method : cPos.top and cPos.left */
			var cPos = $('#'+container).offset();
			var cHeight = $('#'+container).height() / 2;
			var cWidth = $('#'+container).width();
			
			// get box padding (assume all padding have same value)
			var pad = parseInt($('#'+container).css('padding-top').replace('px', ''));
			
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
				}, 300, function() {
          moveRandom(obj);
			});
		}

function Rand (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}