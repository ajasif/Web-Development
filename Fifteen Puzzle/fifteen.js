// Asif Jamal
// Description: This page controls the dynamics for the fifteen puzzle. It controls
// the logic behind making the puzzle pieces move, shuffle, and highlight.

(function() {
	"use strict";

	// Keeps track of square coordinates, row and collumn
	var xPos = 300;
	var yPos = 300;
	var xRow = "4";
	var yCol = "4";

	// Adds event handlers to shuffle button and squares. Builds the squares.
	function start() {
		document.getElementById("shufflebutton").onclick = shuffle;
		var puzzleArea = document.getElementById("puzzlearea");
		for (var i = 1; i <= 15; i++) {
			var square = document.createElement("div");
			square.className = "square";
			square.innerHTML = i;
			square.onclick = move;
			square.onmouseover = hover;
			square.onmouseout = hoverOff;
			if (i <= 4) { // First Row
				square.setAttribute("id",  "1" + i);
				square.style.left = (i - 1) * 100 + "px";
				square.style.top = 0 + "px";
				square.style.backgroundPosition = (i - 1) * -100 + "px" + " " + 0 + "px";
			} else if (i <= 8) { // Second Row
				square.setAttribute("id", "2" + (i - 4));
				square.style.left = (i - 5) * 100 + "px";
				square.style.top = 100 + "px";
				square.style.backgroundPosition = (i - 5) * -100 + "px" + " " + -100 + "px"; 
		  	} else if (i <= 12) { // Third Row
				square.setAttribute("id", "3" + (i - 8));
				square.style.left = (i - 9) * 100 + "px";
				square.style.top = 200 + "px";
				square.style.backgroundPosition = (i - 9) * -100 + "px" + " " + -200 + "px";		  		
			} else { // Last 3 Blocks
				square.setAttribute("id", "4" + (i - 12));
				square.style.left = (i - 13) * 100 + "px";
				square.style.top = 300 + "px";	
				square.style.backgroundPosition = (i - 13) * -100 + "px" + " " + -300 + "px";
			}
			puzzleArea.appendChild(square);
		} 
	}

	// Shifts moveable blocks which directly neighbor the empty square into the empty square.
	function move() {
		var prevX = parseInt(this.style.left);
		var prevY = parseInt(this.style.top);
		// Condition for a moveable block (directly next to empty square)
		if (prevY === yPos + 100 && xPos === prevX || prevY === yPos - 100 && xPos === prevX ||
		 prevX === xPos + 100 && yPos === prevY || prevX === xPos - 100 && yPos === prevY) {
			this.style.left = xPos + "px";
			this.style.top = yPos + "px";
			xPos = prevX;
			yPos = prevY;
			var position = this.getAttribute("id");
			var row = position.substring(0, 1);
			var col = position.substring(1);
			this.setAttribute("id", xRow + yCol);	
			// Sets coordinates of new empty square
			xRow = row; 
			yCol = col;
		}
	}

	// Event Handler for when mouse moves over a square. If the square is directly next
	// to an empty square its border and text become red and the cursor turns into a hand.
	// Other squares' text and border remain black and the cursor stays in its default form.
	function hover() {
		var leftPos = parseInt(this.style.left);
		var topPos = parseInt(this.style.top);
		if (topPos === yPos + 100 && xPos === leftPos || topPos === yPos - 100 && xPos === leftPos ||
		 leftPos === xPos + 100 && yPos === topPos || leftPos === xPos - 100 && yPos === topPos) {	
			this.style.cursor = "pointer";
			this.classList.add("highlight");
		} else {
			this.style.cursor = "default";
		}
	}

	// Allows the cursors to revert back to its original state of black text/border.
	function hoverOff() {
		this.style.cursor = "default";
		this.classList.remove("highlight");
	}

	// Shuffles the pieces into a random, solvable state. 
	function shuffle() {
		for (var i = 0; i < 1000; i++) {
			var neighbors = [];
			var below = parseInt(xRow + yCol) + 10;
			var above = parseInt(xRow + yCol) - 10;
			var left = parseInt(xRow + yCol) - 1;
			var right = parseInt(xRow + yCol) + 1;
			// Adds adjacent squares to list
			if (document.getElementById(below + "")) {
				neighbors.push(document.getElementById(below + ""));
			}
			if (document.getElementById(above + "")) {
				neighbors.push(document.getElementById(above + ""));
			}
			if (document.getElementById(left + "")) {
				neighbors.push(document.getElementById(left + ""));
			}
			if (document.getElementById(right + "")) {
				neighbors.push(document.getElementById(right + ""));
			}
			// Picks and moves a random square
			var value = parseInt(Math.random() * neighbors.length);
			var prevX = parseInt(neighbors[value].style.left);
			var prevY = parseInt(neighbors[value].style.top);
			if (prevY === yPos + 100 && xPos === prevX || prevY === yPos - 100 && xPos === prevX ||
			 prevX === xPos + 100 && yPos === prevY || prevX === xPos - 100 && yPos === prevY) {
				neighbors[value].style.left = xPos + "px";
				neighbors[value].style.top = yPos + "px";
				xPos = prevX;
				yPos = prevY;
				var position = neighbors[value].getAttribute("id");
				var row = position.substring(0, 1);
				var col = position.substring(1);
				neighbors[value].setAttribute("id", xRow + yCol);	
				xRow = row;
				yCol = col;
			}
		}
	}

	window.onload = start;
})();