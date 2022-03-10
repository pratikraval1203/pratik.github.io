<?php
	$hotel_info = array(
		// array("image-name","Hotel Name","Area Name","Org Price","discount","Disc price")
		array("1.jpg", "Hotel Dadisha", "sec16", 2000, 780, 1220),
		array("2.jpg", "Hotel Purnima", "sec24", 2500, 1200, 1300),
		array("3.jpg", "Hotel Green Apple", "sec17", 3000, 1400, 1600),
		array("4.jpg", "Hotel MariGold", "sec26", 2800, 1300, 1500),
		array("5.jpg", "Hotel Aavkar", "sec4", 1800, 700, 1100)
	);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Goibibo</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
	<?php
		echo '<div class="container">';
		for ($i=0; $i <count($hotel_info); $i++) { 
			echo '<div class="hotel-container">';
 				echo '<div class="hotel-image">';
 					echo "<img src='images/".$hotel_info[$i][0]."' alt=\"image\" width=\"300px\" height=\"270px\">";
 				echo '</div> <!-- hotel-image ends -->';
 				echo '<div class="hotel-details">';
 					echo '<div class="hotel-name">';
 						echo $hotel_info[$i][1];
 					echo '</div> <!-- hotel-name ends -->';

 					echo '<div class="area">';
 						echo $hotel_info[$i][2];
 					echo '</div> <!-- area ends -->';

 					echo '<div class="org-prc">';
 						echo "$".$hotel_info[$i][3];
 					echo '</div> <!-- org-prc -->';

 					echo '<div class="disc">';
 						echo "save"."$".$hotel_info[$i][4];
 					echo '</div> <!-- disc -->';

 					echo '<div class="disc-prc">';
 						echo "$".$hotel_info[$i][5];
 					echo '</div> <!-- disc-prc ends -->';
 				/*for ($j=1; $j <6 ; $j++) { 
 				// echo '';
 						echo $hotel_info[$i][$j];
 						echo "<br>";
 				} */
 				echo '</div> <!-- hotel-details ends -->';
 				echo '<input type="button" class="book-btn" value="Book Now">';
		 	echo '</div> <!-- hotel-container -->';
		 } 
		 	echo '<div class="clear"></div>';
		 echo '</div> <!-- container ends -->';
	?>
</body>
</html>