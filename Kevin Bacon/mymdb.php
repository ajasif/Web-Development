<?php 
# Asif Jamal
# Description: Homepage for website which allows the user to search for an actor
# and links them to a page which outputs its data.

# Inserts code which is common amoung multiple webpages
include("common.php");
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
				<h1>The One Degree of Kevin Bacon</h1>
				<p>Type in an actor's name to see if he/she was ever in a movie with Kevin Bacon!</p>
				<p><img src="https://webster.cs.washington.edu/images/kevinbacon/kevin_bacon.jpg"
					alt="Kevin Bacon" /></p>

				<?php
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
