<?php 
	#Asif Jamal
	#Description: Provides the front page for NerdLuv and links to signup.php and matches.php

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

		<div>
			<h1>Welcome!</h1>

			<ul>
				<li>
					<a href="signup.php">
						<img src="https://webster.cs.washington.edu/images/nerdluv/signup.gif" alt="icon" />
						Sign up for a new account
					</a>
				</li>

				<li>
					<a href="matches.php">
						<img src="https://webster.cs.washington.edu/images/nerdluv/heartbig.gif" alt="icon" />
						Check your matches
					</a>
				</li>
			</ul>
		</div>
		<?php
		#Creates links and copyright information which is displayed at the bottom of the page.
		bottom();
		?>
	</body>
</html>
