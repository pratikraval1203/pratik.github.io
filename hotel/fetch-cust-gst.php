<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
  $cust_id = $_POST['query'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT `cust_gst_no` FROM `customer_master` WHERE `cust_id` = '$cust_id'";
}

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 
 while($row = mysqli_fetch_array($result))
 {
  $output .= $row['cust_gst_no'];
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>