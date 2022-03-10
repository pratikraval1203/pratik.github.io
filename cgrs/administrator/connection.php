<?php
  $host = "localhost";
  $user = "id18566191_root";
  $pass = "TFZm-Rd{A)0Omulz";
  $dbnm = "id18566191_db_cgrs";

  $conn = mysqli_connect($host, $user, $pass, $dbnm);

  if (!$conn) {
  	die("connection error:".mysqli_connect_error() );
  }
  /*Note:
  The mysqli_connect_error() function returns the eroor description from last connection error, if any.
  */
?>