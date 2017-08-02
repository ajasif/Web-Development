<?php 
	#Asif Jamal
	#CSE 154, CE
	#TA: Griffith, Brian J.
	#SN: 1231056	
	#Description: Receives data from matches.php and show's the user's matches.

	#Links to file containing functions for code which is common in multiple programs.
	include("common.php");

	#Get the name of the user
	$name = $_GET["name"];
	#Gets lines on text from singles file
	$profiles = file("singles.txt");
	$yourInfo = NULL;
	#Breaks each line of singles file into array of parts.
	foreach ($profiles as $info) {
		$parts = explode(",", $info);
		#Finds users profile
		if ($parts[0] == $name) {
			$yourInfo = $parts;
		}
	}

	#Sets data from users info into variables
	list($yourName, $yourGender, $yourAge, $yourPersonality, $yourOS, $yourMin, 
	$yourMax) = $yourInfo;

	#Loops over lines of singles file and breaks lines into variables of info
	$matches = array();
	foreach ($profiles as $info) {
		$parts = explode(",", $info);
		list($name, $gender, $age, $personality, $OS, $min, $max) = $parts;

		#Compares user's info to that in singles file and adds those that fit to an array
		if ($gender != $yourGender && $age <= $yourMax && $age >= $yourMin && $yourAge <= $max && $yourAge >= $min && $yourOS == $OS &&
		    (substr($yourPersonality, 0, 1) == substr($personality, 0, 1) ||
		 	substr($yourPersonality, 1, 1) == substr($personality, 1, 1) ||
		 	substr($yourPersonality, 2, 1) == substr($personality, 2, 1) ||
		 	substr($yourPersonality, 3, 1) == substr($personality, 3, 1))) {
			array_push($matches, $parts);
		}
	}

	#Loops over the information for those who qualify as matches for the user and outputs
	#their information.
	function printMatches($users) {
		foreach ($users as $lineInfo) { 
		list($name, $gender, $age, $personality, $OS, $min, $max) = $lineInfo; ?>
			<div class="match">
				<p>
				<img src="http://webster.cs.washington.edu/images/nerdluv/user.jpg" alt="user" />
				<?= $name ?> <br />
				</p>
				<ul>
					<li><strong>gender:</strong> <?= $gender ?></li>
					<li><strong>age:</strong> <?= $age ?></li>
					<li><strong>type:</strong> <?= $personality ?></li>
					<li><strong>OS:</strong> <?= $OS ?></li>
				</ul>
			</div>
		<?php } 
	} ?>

<!DOCTYPE html>
<html>
	<head>
		<?php 
		#Calls method which creates the title, meta tags, and links to css.
		head()
		?>
	</head>

	<body>
		<?php 
		#Calls method which creates the picture/heading for the top of the page.
		heading();
		?>

		<h1>Matches for <?= $yourName ?></h1>
		<?php
		# Calls method which outputs the information of all the users' matches
		printMatches($matches); 

		#Creates links and copyright information which is displayed at the bottom of the page.
		bottom();
		?>
	</body>
</html>