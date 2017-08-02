<?php 
	#Asif Jamal
	#CSE 154, CE
	#TA: Griffith, Brian J.
	#SN: 1231056	
	#Description: Allows the user to signup and create a profile on NerdLuv.

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

		<form action="signup-submit.php" enctype="multipart/form-data" method="post">
			<fieldset>
				<legend>New User Signup:</legend> 
				<strong>Name:</strong> <input type="text" size="16" name="name" /> <br />  
				<strong>Gender:</strong> <label><input type="radio" name="gender" value="male" /> Male</label>
				<label><input type="radio" name="gender" value="female" checked="checked" /> Female</label> <br />
				<strong>Age:</strong> <input type="text" name="age" size="6" maxlength="2" /> <br />
				<strong>Personality type:</strong> <input type="text" name="personality" size="6" maxlength="4" /> 
				(<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>) <br />
				<strong>Favorite OS:</strong> 
				<select name="OS">
					<option selected="selected">Windows</option>
					<option>Mac OS X</option>
					<option>Linux</option>
				</select> <br />
				<strong>Seeking age:</strong> <input type="text" size="6" name="min" placeholder="min" /> to
							 <input type="text" size="6" name="min" placeholder="max" /> <br />
				<input type="submit" value="Sign Up" /> 
			</fieldset>
		</form>

		<?php
		#Creates links and copyright information which is displayed at the bottom of the page.
		bottom();
		?>
	</body>

</html>