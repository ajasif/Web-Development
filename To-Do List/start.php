<?php 
	# Asif Jamal
	# Description: This file displays the front page of a todolist website where a user
	# can enter their username and password.
	
	# Checks if the user if the user is in the middle of a logged in session and 
	# redirect them to their todolist if they are logged in.
	session_start();
	if (isset($_SESSION["loggedIn"])) {
		header("Location: todolist.php");
	}
	# Gets code which is common between files; banner, head
	include("common.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
		# Displays pages meta tags, links to stylesheets, and displays title.
		head();
		?>
	</head>

	<body>
		<?php
		# Creates a banner with the pages title and image at the top of the page.
		topBanner();
		?>

		<div id="main">
			<p>
				The best way to manage your tasks. <br />
				Never forget the cow (or anything else) again!
			</p>

			<p>
				Log in now to manage your to-do list. <br />
				If you do not have an account, one will be created for you.
			</p>

			<form id="loginform" action="login.php" method="post">
				<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>

			<p>
				<?php
				# Checks if the user has a cookie containing information about their
				# last log in time and displays the time if they do.
				if (isset($_COOKIE["lastLog"])) { ?>
					<em>(last login from this computer was <?= $_COOKIE["lastLog"]?>)</em>
				<?php } ?>
			</p>
		</div>

		<?php
		# Creates a banner at the bottom of the page with links to validators and displays
		# copyright information
		bottomBanner();
		?>
	</body>
</html>
