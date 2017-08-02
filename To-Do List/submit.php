<?php
	# Asif Jamal
	# CSE 154, CE
	# TA: Griffith, Brian J.
	# SN: 1231056
	# Description: Handles the information that is submitted from the todolist. 
	
	# Checks whether parameters are valid.
	session_start();
	if (!isset($_SESSION["loggedIn"])) {
		header("Location: start.php");
	}
	if (!isset($_SESSION["loggedIn"]) || !isset($_COOKIE["user"])) {
		die("ERROR: Unauthorized Access Attempt");
	}
	$name = $_SESSION["loggedIn"];
	$user = $_COOKIE["user"];
	# If the user wants to add something
	if (isset($_POST["item"])) {
		$text = $_POST["item"];	
		file_put_contents("todo_" . $name . ".txt", $text . "\n", FILE_APPEND);
	} else if (isset($_POST["index"])) { # The user wants to delete something
		$index = $_POST["index"];
		$contents = file("todo_" . $name . ".txt");
		if ($index < 0 || $index > count($contents)) {
			die("ERROR: Incorrect Input");
		}
		unset($contents[$index]);
		file_put_contents("todo_" . $name . ".txt", $contents);
	}
	header("Location: todolist.php");
?>