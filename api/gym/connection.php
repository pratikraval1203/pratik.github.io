<?php
	$servername = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$database = "db_gym";

	$conn = mysqli_connect($servername, $dbuser, $dbpass);

	if (!$conn) {
		echo "Database Connection Failed.";
	}
	mysqli_select_db($conn, $database);

	$base_url = "https://localhost/api/gym/";
?>