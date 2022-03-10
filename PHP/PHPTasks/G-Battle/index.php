<?php 
	$user_1 = array(
		// array("img name", "user name","battle won","likes","shares","level")
		array("user11.jpg", "Pratik Raval", 15, 0, 0, 1) ,
		array("user12.jpg", "Patrick Williams", 5, 0, 0, 3)
	); 
	$user_2 = array(
		// array("img name", "user name","battle won","likes","shares","level")
		array("user21.jpg","Jignesh Panchal",10,0,0,2),
		array("user22.jpg","Johnatha Adward",6,0,0,3)
	);
?>

<!DOCTYPE html>
<html>
<head>
	<title>G-Battle</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-free-5.4.1-web/css/all.css">
	<script type="text/javascript" src="fontawesome-free-5.4.1-web/js/all/js"></script>
</head>
<body>
	<?php 
		echo '<div class="container">';
			for ($i=0; $i <count($user_1) ; $i++) {
		
				echo '<div class="col-left">';
					echo '<div class="user-1-img">';
						echo '<img src= "images/'.$user_1[$i][0].'" alt="img" width="250px" height="250px">';
					echo '</div> <!-- user-1-img ends -->';

					echo '<div class="user-1-post-data">';
						
					echo '</div> <!-- user-1-post-data ends -->';

					echo '<div class="user-1-details">';
						echo '<div class="">';

						echo '</div> <!-- ends -->';
						echo '<div class="user-name">';
							echo $user_1[$i][1];
						echo '</div> <!-- user-name ends -->';
					echo '</div> <!-- user-1-details ends -->';

				echo '</div> <!--col-left ends -->';

				echo '<div class="col-center">';
					echo '<div class="vs-img">';
					echo '<img src= "images/vs.jpg" alt="img" width="136px" height="100px">';
					echo '</div> <!-- vs-img ends -->';
				echo '</div> <!-- col-center ends -->'; 

				echo '<div class="col-right">';
					echo '<div class="user-2-img">';
						echo '<img src= "images/'.$user_2[$i][0].'" alt="img" width="250px" height="250px">';
					echo '</div> <!-- user-2-img ends -->';

					echo '<div class="user-2-post-data">';
						
					echo '</div> <!-- user-2-post-data ends -->';

					echo '<div class="user-2-details">';
						echo '<div class="user-name">';
							echo $user_2[$i][1];
						echo '</div> <!-- user-name ends -->';
					echo '</div> <!-- user-2-details ends -->';

				echo '</div> <!--col-right ends -->';
			}
			echo '<div class="clear"></div> <!-- clear ends -->';
		echo '</div> <!-- container ends -->';
	?>
</body>
</html>