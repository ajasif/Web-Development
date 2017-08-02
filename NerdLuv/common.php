<?php
	#Asif Jamal
	#CSE 154, CE
	#TA: Griffith, Brian J.
	#SN: 1231056	
	#Description: Contains code such as a top/bottom heading and banner which is common amoung 
	#multiple web pages: nerdluv, signup, and matches.
 
 	#Creates a banner image and title for the page
	function heading() { ?>
		<div id="bannerarea">
			<img src="https://webster.cs.washington.edu/images/nerdluv/nerdluv.png" alt="banner logo" /> <br />
			where meek geeks meet
		</div>
	<?php } 

	#Content for the bottom of the page describing the page, instructions and copyright info
	#aswell as links.
	function bottom() { ?>
		<div>
			<p>
				This page is for single nerds to meet and date each other!  Type in your personal information and wait for the nerdly luv to begin!  Thank you for using our site.
			</p>
			
			<p>
				Results and page (C) Copyright NerdLuv Inc.
			</p>
			
			<ul>
				<li>
					<a href="nerdluv.php">
						<img src="https://webster.cs.washington.edu/images/nerdluv/back.gif" alt="icon" />
						Back to front page
					</a>
				</li>
			</ul>
		</div>

		<div id="w3c">
			<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
			<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
		</div>		
	<?php }

	#Code for the head of the page which includes the tab title/image and css link.
	function head() { ?>
		<title>NerdLuv</title>
		
		<meta charset="utf-8" />
		
		<link href="https://webster.cs.washington.edu/images/nerdluv/heart.gif" type="image/gif" rel="shortcut icon" />
		<link href="https://webster.cs.washington.edu/css/nerdluv.css" type="text/css" rel="stylesheet" />
	<?php } ?>