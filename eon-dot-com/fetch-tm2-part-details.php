<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
  $part_id = $_POST['query']; 
  $field = $_POST['field'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT `".$field."` FROM `part_master_one` WHERE `part_id` = '$part_id'";
}

// echo $query;

$result = mysqli_query($conn, $query);


if(mysqli_num_rows($result) > 0)
{
 
 while($row = mysqli_fetch_array($result))
 {
  $output .= $row[$field];
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>