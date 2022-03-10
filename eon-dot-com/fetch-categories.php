<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
  $tm_id = $_POST['query'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT DISTINCT `tm_catagory` FROM `track_machine_master_two` WHERE `tm_id` = '$tm_id'";

  $result = mysqli_query($conn, $query);
  $count = 0;

  if(mysqli_num_rows($result) > 0)
  {
   
   while($row = mysqli_fetch_array($result))
   {
    $count = $count + 1;
    $output .= '
      <option value="'.$row['tm_catagory'].'">'.$row['tm_catagory'].'</option>
    ';
   }
   echo $output;
  }
  else
  {
   echo '<assert_options(what)>No Data Found</option>';
  }
}
?>