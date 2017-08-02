// Asif Jamal
// Description: Controls the dynamic events that occur after the user interacts with 
// the webpage such as adjusting the speed of the animaton, its size, and making
// the frames animate.

"use strict";

(function() {

	var timer = null;
	var count = 0; // keeps track of frame
	var exist = false; // Checks whether animation is chosen and not started
	var frames = []; // holds animations
	var speed = 250;

	// Attaches event handlers to elements after the page has loaded.
	function start() {
		var animatSel = document.getElementById("animation");
		animatSel.onchange = setAnimation;
		var sizeSel = document.getElementById("size");
		sizeSel.onchange = setSize;
		var start = document.getElementById("start");
		start.onclick = motion;
		var speed = document.getElementById("speed");
		speed.onchange = setSpeed;
		var stop = document.getElementById("stop");
		stop.disabled = true;
		stop.onclick = stopAnimation;
	}

	// Fills the text box with the all the unbroken chosen animation frames.
	function setAnimation() {
		var whichOne = this.value;
		document.getElementById("mytextarea").value = ANIMATIONS[whichOne];
		exist = true;		
	}

	// Changes the size of the animation to the selected size.
	function setSize() {
		var sizeSel = document.getElementById("size");
		var size = sizeSel.options[sizeSel.selectedIndex].value;
		document.getElementById("mytextarea").style.fontSize = size;
	}

	// Controls the timing and speed for the animation.
	function motion() {
		if (timer !== null) {
			clearInterval(timer);
		}

		if (document.getElementById('turbo').checked) {
			speed = 50;
		} else if (document.getElementById('slo').checked) {
			speed = 1500;
		} else {
			speed = 250;
		}
		timer = setInterval(startAnimation, speed);	
	}

	// Sets the speed of the animation when a radio button is checked. 
	function setSpeed() {
		if (document.getElementById('turbo').checked) {
			speed = 50;
		} else if (document.getElementById('slo').checked) {
			speed = 1500;
		} else {
			speed = 250;
		}
		// Calls motion to continue animation motion if speed is changed while in 
		// the middle of animation
		if (document.getElementById("start").disabled === true) {
			motion();
		}		
	}

	// Breaks the frames apart places them in the textbook. 
	function startAnimation() {
		var text = document.getElementById("mytextarea").value;
		if (exist === true) { // Only splits frames when animation is not in progress
			frames = text.split("=====\n");			
		}
		if (count >= frames.length) { // Goes back to first frame.
			count = 0;
		}
		document.getElementById("mytextarea").value = frames[count];
		count++;
		exist = false;	
		document.getElementById("stop").disabled = false;
		document.getElementById("start").disabled = true;
		document.getElementById("animation").disabled = true;			
	}

	// Clear the timer to stop animation and resets count so it will begin from the 
	// aswell as reforming the frames and reseting controls.
	function stopAnimation() {
		clearInterval(timer);
		count = 0;
		document.getElementById("mytextarea").value = frames.join("=====\n");	
		document.getElementById("stop").disabled = true;	
		document.getElementById("start").disabled = false;
		document.getElementById("animation").disabled = false;
	}

	window.onload = start;
})();