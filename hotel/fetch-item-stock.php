<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
  $stock_item_name = $_POST['query'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);

 $query = "SELECT `stock_qty` FROM `stock_master` WHERE `stock_item_name` = '$stock_item_name'";

  $result = mysqli_query($conn, $query);
  $total_stock = 0;

  if(mysqli_num_rows($result) > 0)
  {   
   while($row = mysqli_fetch_array($result))
   {
      $total_stock += $row['stock_qty'];
      // echo "jii";
   }
   echo $total_stock;
  }
  else
  {
   echo '0';
  }
}
?>