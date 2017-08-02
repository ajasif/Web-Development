<?php 
	# Asif Jamal
	# CSE 154, CE
	# TA: Griffith, Brian J.
	# SN: 1231056
	# Description: Allows the user to add and delete information from a list.
	
	# If the user is not logged in they are sent back to the homepage.
	session_start();
	if (!isset($_SESSION["loggedIn"])) {
		header("Location: start.php");
	}
	# Gets the users previous information entered in the todolist from their file
	# and outputs it.
	$name = $_SESSION["loggedIn"];
	$exists = false;
	$contents = NULL;
	if (file_exists("todo_" . $name . ".txt")) {
		$exists = true;
		$contents = file("todo_" . $name . ".txt");
	}
	# Gets code common between files; banner, head
	include("common.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<?php head(); ?>
	</head>

	<body>
		<?php topBanner(); ?>

		<div id="main">
			<h2><?= $name ?>'s To-Do List</h2>

			<ul id="todolist">
				<?php 
					# Creates a bullet point for every item in the users todolist with a 
					# delete button.
					if ($exists) {
						for ($num = 0; $num < count($contents); $num++) { ?>
							<li>
								<form action="submit.php" method="post">
									<input type="hidden" name="action" value="delete" />
									<input type="hidden" name="index" value="<?=$num?>" />
									<input type="submit" value="Delete" />
								</form>
								<?=$contents[$num]?>
							</li>	
						<?php }
					}
				?>

				<li>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="add" />
						<input name="item" type="text" size="25" autofocus="autofocus" />
						<input type="submit" value="Add" />
					</form>
				</li>
			</ul>

			<div>
				<a href="logout.php"><strong>Log Out</strong></a>
				<em>(logged in since <?= $_COOKIE["lastLog"] ?>)</em>
			</div>

		</div>

		<?php bottomBanner(); ?>
	</body>
</html>
