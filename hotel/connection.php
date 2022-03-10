<?php
	$servername = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$database = "db_hotel";

	$conn = mysqli_connect($servername, $dbuser, $dbpass);

	if (!$conn) {
		echo "Database Connection Failed.";
	}
	mysqli_select_db($conn, $database);
?>