// Asif Jamal
// Description: This program creates a webpage which allows the user to search for
// babynames and outputs the names meaning, popularity across multiple years, and 
// celebrities with the same name.

(function() {
	"use strict";

	// Adds even handler to search button and calls function to load names into search box.
	function start() {
		makeRequest(getName, "?type=list");
		$('search').onclick = picked;
	}

	// Takes a functionName and portion of a url as parameters.
	// Clears information from sections, turns on loading gifs, and creates ajax object to fetch
	// data from the url.
	function makeRequest(functionName, urlAdd) {
		$('graph').innerHTML = "";
		$('norankdata').style.display = "none";
		$('meaning').innerHTML = "";
		$('celebs').innerHTML = "";
		$('loadingcelebs').style.display = "block";
		$('loadingmeaning').style.display = "block";
		$('loadinggraph').style.display = "block";

		var ajax = new XMLHttpRequest();
		ajax.onload = functionName;
		ajax.open("GET", "https://webster.cs.washington.edu/cse154/babynames.php" + urlAdd, true);
		ajax.send();	
	}

	// Gets name and gender if chosen and calls make request with appropriate parameters.
	function picked() {
		var name = $('allnames').value;
		if (name !== "") {
			$('resultsarea').style.display = "block";
			var name = $('allnames').value;
			var gender;
			if ($('genderm').checked) {
				gender = "m";
			} else {
				gender = "f";
			}
			makeRequest(getMeaning, "?type=meaning&name=" + name);
			makeRequest(getRank, "?type=rank&name=" + name + "&gender=" + gender);
			makeRequest(getCelebs, "?type=celebs&name=" + name + "&gender=" + gender);
		}
	}

	// Adds all names to select box and removes the loading gif. If the url is incorrect displays
	// an error.
	function getName() {
		if (this.status == 200) {
			var names = this.responseText.split("\n");
			for (var i = 0; i < names.length; i++) {
				var option = document.createElement("option");
				option.innerHTML = names[i];
				$('allnames').appendChild(option);
			}
			$('allnames').disabled = false;			
		} else {
			$('errors').innerHTML = "Error making Ajax request:" + 
	        " Server status: " + this.status + " " + this.statusText + 
	        " Server response text: " + this.responseText;
		}
		$('loadingnames').style.display = "none";
	}

	// Gets and displays the given names meaning. If an incorrect url an error is displayed.
	// Turns off the loading meaning gif.
	function getMeaning() {
		if (this.status == 200) {
			$('meaning').innerHTML = this.responseText;
		} else {
			$('errors').innerHTML = "Error making Ajax request:" + 
	        " Server status: " + this.status + " " + this.statusText + 
	        " Server response text: " + this.responseText;			
		}
		$('loadingmeaning').style.display = "none";
	}

	// Outputs a bar graph of years and ranks for the given name. Outputs a message if
	// there is no information on the name. Outputs an error for an incorrect url.
	// Removes loading gif.
	function getRank() {
		if (this.status == 200) {
			var ranks = this.responseXML.getElementsByTagName("rank");
			var years = $('graph').appendChild(document.createElement("tr"));
			var tr = $('graph').appendChild(document.createElement("tr"));
			for (var i = 0; i < ranks.length; i++) {
				var year = ranks[i].getAttribute("year");
				var th = document.createElement("th");
				th.innerHTML = year;
				years.appendChild(th);
				var rank = ranks[i].textContent;
				var td = document.createElement("td");
				var div = document.createElement("div");
				tr.appendChild(td).appendChild(div).innerHTML = rank;
				if (rank == 0) { // Makes color of ranks under 10 red
					div.style.height = "0px";
				} else {
					div.style.height = parseInt((1000 - rank) / 4) + "px";
					if (rank <= 10) {
						div.style.color = "red";
					}
				}
				tr.appendChild(td).appendChild(div).innerHTML = rank;
			}
		} else if (this.status == 410) {
			$('norankdata').style.display = "block";
		} else {
			$('errors').innerHTML = "Error making Ajax request:" + 
	        " Server status: " + this.status + " " + this.statusText + 
	        " Server response text: " + this.responseText;
		}
		$('loadinggraph').style.display = "none";
	}

	// Gets data on celebrities with the same first name and shows their first
	// name, last name, and the number of films they have been in.
	// Removes loading gif and outputs an error for an incorrect url.
	function getCelebs() {
		if (this.status == 200) {
			var data = JSON.parse(this.responseText);
			for (var i = 0; i < data.actors.length; i++) {
				var li = document.createElement("li");
				var info = data.actors[i];
				li.innerHTML = (info.firstName + " " + info.lastName + " (" + info.filmCount +
				 " films)");
				$('celebs').appendChild(li);
			}
		} else {
			$('errors').innerHTML = "Error making Ajax request:" + 
	        " Server status: " + this.status + " " + this.statusText + 
	        " Server response text: " + this.responseText;
		}
		$('loadingcelebs').style.display = "none";
	}

	var $ = function(id) {
		return document.getElementById( id ); 
	};

	window.onload = start;

})();