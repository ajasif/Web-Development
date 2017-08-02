<?php	
	# Asif Jamal
	# CSE 154, CE
	# TA: Griffith, Brian J.
	# SN: 1231056
	# Description: Logs out the user and deletes their session information.

	session_start();
	if (!isset($_SESSION["loggedIn"])) {
		header("Location: start.php");
	}
	# Ends the session and sends the user back to the homepage
	session_destroy();
	session_regenerate_id(TRUE);
	header("Location: start.php");
?>