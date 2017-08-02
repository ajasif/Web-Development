<?php
	#Asif Jamal
	#CSE 154, CE
	#TA: Griffith, Brian J.
	#SN: 1231056	
	#Description: Recieves data from signup.php and signs up the new user with a message.

	#Links to file containing functions for code which is common in multiple programs.
	include("common.php");

	$info = "";
	foreach ($_POST as $param => $value) {
		$info .= $value . ",";
	}
	$info = rtrim($info, ","); 
	file_put_contents("singles.txt", $info . "\n", FILE_APPEND);
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

		<p><strong>Thank you!</strong></p>
		<p>Welcome to NerdLuv, <?= $_POST["name"] ?>!</p> <?php #Name of user?>
		<p>Now <a href="matches.php">log in to see your matches!</a></p>

		<?php
		#Creates links and copyright information which is displayed at the bottom of the page.
		bottom();
		?>
	</body>

</html>