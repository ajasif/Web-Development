<?php 
	#Asif Jamal
	#CSE 154, CE
	#TA: Griffith, Brian J.
	#SN: 1231056	
	#Description: Creates a page which allows existing users to log in and check their dating matches.

	#Links to file containing functions for code which is common in multiple programs.
	include("common.php");
?>

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
		<form action="matches-submit.php">
			<fieldset>
			<legend>Returning User:</legend>
			<strong>Name:</strong> <input type="text" name="name" size="16" /> <br />
			<input type="submit" value="View My Matches" />
			</fieldset>
		</form>
		<?php
		#Creates links and copyright information which is displayed at the bottom of the page.
		bottom();
		?>
	</body>
</html>