<?php
	$servername = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$database = "db_property_listing";

	$conn = mysqli_connect($servername, $dbuser, $dbpass);

	if (!$conn) {
		echo "Database Connection Failed.";
	}
	mysqli_select_db($conn, $database);

	$base_url = "http://localhost/api/property-listing/";

	// $base_url = $_SERVER['HTTP_REFERER'];
?>