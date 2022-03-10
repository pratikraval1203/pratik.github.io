<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
  $item_type = $_POST['query'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT `item_id`,`item_code`,`item_name` FROM `item_master` WHERE `item_type` = '$item_type' ORDER BY `item_name`";

  $result = mysqli_query($conn, $query);
  $count = 0;

  if(mysqli_num_rows($result) > 0)
  {
   
   while($row = mysqli_fetch_array($result))
   {
    $count = $count + 1;
    $output .= '
      <option value="'.$row['item_id'].'">'.$row['item_code'].'-'.$row['item_name'].'</option>
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