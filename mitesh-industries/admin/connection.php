<?php
	// $servername = "localhost";
	// $dbuser = "u526692573_root";
	// $dbpass = "W0u+]eqq";
	// $database = "u526692573_db_mi";
	$servername = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$database = "db_mi";

	$conn = mysqli_connect($servername, $dbuser, $dbpass);

	if (!$conn) {
		echo "Database Connection Failed.";
	}
	mysqli_select_db($conn, $database);
?>