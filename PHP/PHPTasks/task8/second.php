<!DOCTYPE html>
<html>
<head>
	<title>Second Page</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<style type="text/css">
		.one , .two {
			border: solid 2px black;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="one">
			<?php
				echo "<pre>" ;
					print_r($_GET);
				echo "</pre>";
			?>
		</div> <!-- one ends -->
		<div class="two">
			<?php 
				echo "Welcome"." ".$_GET["name"];
			    echo "<br>";
			    echo "<br>";
			    echo "Your Address :".$_GET["address"];	
			    echo "<br>";
			    echo "<br>";
			    echo "Your Email Address :".$_GET["email"];
			    echo "<br>";
			    echo "<br>";
			    echo "You usually eat ".$_GET["fruits"]." in a day.";
			    echo "<br>";
			    echo "<br>";
			    echo "Your favourite fruit is ".$_GET["fav-fruit"];
			    echo "<br>";
			    echo "<br>";
			    echo "You will receive a brochure as soon as possible.";
			?>
		</div> <!-- two ends -->
	</div> <!-- container ends -->
</body>
</html>


