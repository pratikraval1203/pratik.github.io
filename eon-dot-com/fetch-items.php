<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
  $catagory = $_POST['query'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT `part_id`,`part_desc`,`part_number`,`part_catagory` FROM `part_master_one` WHERE `part_catagory` = '$catagory'";

  $result = mysqli_query($conn, $query);
  $count = 0;

  if(mysqli_num_rows($result) > 0)
  {
   
   while($row = mysqli_fetch_array($result))
   {
    $count = $count + 1;
    $output .= '
      <option value="'.$row['part_id'].'">'.$row['part_number'].'-'.$row['part_desc'].'</option>
    ';
   }
   echo $output;
  }
  else
  {
   echo '<td colspan="6">Data Not Found</td>';
  }
}
?>