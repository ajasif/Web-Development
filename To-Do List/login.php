<?php 
	# Asif Jamal
	# CSE 154, CE
	# TA: Griffith, Brian J.
	# SN: 1231056
	# Description: Verfies the users identity and takes them to the todolist if they
	# are a user. If they are not a user but have valid input an account is created
	# for them otherwise they are brought back to the homepage.

	# Redirects to todolist if the user is already in a session
	session_start();
	if (isset($_SESSION["loggedIn"])) {
		header("Location: todolist.php");
	}

	# If a username or password isn't passed in displays an error
	if (!isset($_POST["name"]) || !isset($_POST["password"])) {
		die("ERROR: ACCOUNT NOT FOUND");
	}

	# Displays the users last log in time.
	$expireTime = time() + 60*60*24*7;
	setcookie("lastLog", date("D y M d, g:i:s a"), $expireTime);
	$username = $_POST["name"];
	$password = $_POST["password"];
	$information = file("users.txt");
	$exists = false;
	foreach ($information as $account) {
		$parts = explode(":", $account);
		list($accountName, $accountPass) = $parts;
		$accountPass = rtrim($accountPass, "\n");
		if ($username == $accountName && $password == $accountPass) {
			$exists = true;
			$_SESSION["loggedIn"] = $username;
			header("Location: todolist.php"); 
		} else if ($username == $accountName && $password != $accountPass) {
			$exists = true;
			header("Location: start.php");
		} 
	}
	if (!$exists) {
		# If the user doesn't have an account, one is made for them as long as the 
		# username is between 3-8 chars, begins with a lowercase letter, is all lowercase.
		# The password is between 6-12 chaws, begins with a number, ends with a char
		# that is not a letter or number. Otherwise goes to homepage.
		#if (preg_match(/^[a-z][a-z0-9]{3,8}/, $username) && preg_match(/(^[0-9][^a-zA-Z0-9]$){6,12}/, $password) {
			file_put_contents("users.txt", $username . ":" . $password . "\n", FILE_APPEND); 
			$_SESSION["loggedIn"] = $username;
			header("Location: todolist.php"); 
		#} else {
		#	header("Location: start.php");
		#}
	} 
?>
