<?php
# Asif Jamal
# 5/13/214
# CSE 154, CE
# TA: Griffith, Brian J.
# Description: Contains the head info, banner with title at the top of the page and
# banner at the bottom of the page which is common content amoung multiple pages.

# Contains the head information including a title, links, and meta tags
function head() { ?>
	<title>My Movie Database (MyMDb)</title>
	<meta charset="utf-8" />
	<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png"
	rel="shortcut icon" />

	<!-- Link to your CSS file that you should edit -->
	<link href="bacon.css" type="text/css" rel="stylesheet" />
<?php } 

# Creates a banner with a title at the top of the webpage
function bannerTop() { ?>
	<div id="banner">
		<a href="mymdb.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png"
		alt="banner logo" /></a>
		My Movie Database
	</div>
<?php } 

# Creates forms to search for all films an actor is in and films with the actor and 
# Kevin Bacon
function forms() { ?>
	<form action="search-all.php" method="get">
		<fieldset>
			<legend>All movies</legend>
			<div>
				<input name="firstname" type="text" size="12" placeholder="first name"
				autofocus="autofocus" /> 
				<input name="lastname" type="text" size="12" placeholder="last name" /> 
				<input type="submit" value="go" />
			</div>
		</fieldset>
	</form>

	<form action="search-kevin.php" method="get">
		<fieldset>
			<legend>Movies with Kevin Bacon</legend>
			<div>
				<input name="firstname" type="text" size="12" placeholder="first name" /> 
				<input name="lastname" type="text" size="12" placeholder="last name" /> 
				<input type="submit" value="go" />
			</div>
		</fieldset>
	</form>
<?php } 

# Links to validators and is the content behind which the bottom banner is made.
function links() { ?>
	<div id="w3c">
		<a href="https://webster.cs.washington.edu/validate-html.php">
		<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>

		<a href="https://webster.cs.washington.edu/validate-css.php">
		<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
	</div>
<?php } ?>