<?php 
# Asif Jamal
# Description: Finds the list of movies which both the actor and Kevin Bacon have
# participated in and outputs them as a table.

# Gets code which is common amoung multiple webpages
include("common.php");

# Gets the actors first and last names
$first = $_GET["firstname"];
$last = $_GET["lastname"];

# Finds the actors id, breaking ties on film count
$db = new PDO("mysql:dbname=imdb;host=localhost", "ajasif", "365yD7vpee");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$rows = $db->query("SELECT id FROM actors WHERE first_name LIKE '$first%' 
	AND last_name = '$last' ORDER BY film_count DESC LIMIT 1;");
$exists = true;
if ($rows->rowCount() <= 0) {
	$exists = false;
}
$id = "";
foreach ($rows as $row) {
	$id = $row["id"];
}

$id = $db->quote($id);

# Finds Kevin Bacon's id, breaking ties on film_count
$rows = $db->query("SELECT id FROM actors WHERE first_name LIKE 'Kevin%' AND last_name = 'Bacon'
	ORDER BY film_count DESC LIMIT 1;");
$idKevin = "";
foreach ($rows as $row) {
	$idKevin = $row["id"];
}
$idKevin = $db->quote($idKevin);

$name = "";
$year = "";

# Finds the movies the actor and Kevin Bacon have participated in ordering on year
# and name
$lines = $db->query("SELECT name, year FROM movies m JOIN roles ra ON ra.movie_id = m.id JOIN
roles rb ON rb.movie_id = m.id JOIN actors a ON ra.actor_id = a.id JOIN actors b ON
rb.actor_id = b.id WHERE a.id = $id AND b.id = $idKevin ORDER BY year DESC, name;");

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
				# Checks to see if the actor is in the database
				if ($exists == false) { ?>
					<p><?= $first ?> <?= $last ?> was not found.</p>
				<?php
				# Checs to see if the actor was in any films with Kevin Bacon
				} else if ($lines->rowCount() > 0) { ?>

					<h1>Results for <?= $first ?> <?= $last ?></h1>

					<table>
						<caption>Films with <?= $first ?> <?= $last ?> and Kevin Bacon</caption>
						<tr><th>#</th><th>Title</th><th>Year</th></tr>
					<?php 
					$count = 0;
					foreach ($lines as $line) { 
						$count++;
						$name = $line["name"];
						$year = $line["year"]; ?>
						<tr><td><?= $count ?></td><td id="movie"><?= $name ?></td><td><?= $year ?></td></tr>
					<?php } ?>
					</table> 

				<?php } else { ?> 

					<p><?= $first ?> <?= $last ?> wasn't in any films with Kevin Bacon.</p>

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