<?php 
# Asif Jamal
# 5/13/214
# CSE 154, CE
# TA: Griffith, Brian J.
# Description: Finds the complete list of movies in which the actor has played a role

# Inserts code which is common amoung multiple webpages
include("common.php");

# Gets first and last name of actor
$first = $_GET["firstname"];
$last = $_GET["lastname"];

# Links to database and inserts query to find the actors id using 
# their film count to break ties
$db = new PDO("mysql:dbname=imdb;host=localhost", "ajasif", "365yD7vpee");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rows = $db->query("SELECT id FROM actors WHERE first_name LIKE '$first%'
AND last_name = '$last' ORDER BY film_count DESC LIMIT 1;");

# Gets the actors id
$id = "";
foreach ($rows as $row) {
	$id = $row["id"];
}
$id = $db->quote($id);
$name = "";
$year = "";

# Finds the films the actor has participated, ordering based on year and name
$lines = $db->query("SELECT name, year FROM actors a JOIN roles ON actor_id = a.id
JOIN movies m ON movie_id = m.id WHERE a.id = $id ORDER BY year DESC, name;");
?>


<!DOCTYPE html>
<html>
	<head>
		<?php
		# Creates the head information which includes a title, meta tags and links to stylesheet
		head();
		?>
	</head>

	<body>
		<div id="frame">
			<?php 
			# Creates the top banner for the webpage which displays a banner and title
			bannerTop();
			?>

			<div id="main">
				<?php 
				# Checks to see if the actor is in the data base.
				if ($rows->rowCount() <= 0) { ?>
					<p><?= $first ?> <?= $last ?> was not found.<p>
				<?php } else { ?>
					<h1>Results for <?= $first ?> <?= $last ?></h1>

					<table>
						<caption>All Films</caption>
						<tr><th>#</th><th>Title</th><th>Year</th></tr>
					<?php 
					# Outputs all the films and their years as a table labeled 1-N
					$count = 0;
					foreach ($lines as $line) { 
						$count++;
						$name = $line["name"];
						$year = $line["year"]; ?>
						<tr><td><?= $count ?></td><td id="movie"><?= $name ?></td><td><?= $year ?></td></tr>
					<?php } ?>
					</table> 

				<?php }
				# Form to search for every movie by a given actor
				forms();
				?>

			</div>
		
			<?php 
			# Creates a bottom banner and links to html and css validators.
			links();
			?>
		</div>
	</body>
</html>
