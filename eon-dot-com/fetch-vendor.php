<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"])) 
{
  $search = mysqli_real_escape_string($conn, $_POST["query"]);
  $query = "
  SELECT * FROM `vendor_master`
  WHERE `ven_name` LIKE '%".$search."%'
  OR `ven_code` LIKE '%".$search."%' 
  OR `ven_mobile` LIKE '%".$search."%' 
  ORDER BY `ven_id` DESC";

  $result = mysqli_query($conn, $query);
  $count = 0;
  if(mysqli_num_rows($result) > 0)
  {
   
   while($row = mysqli_fetch_array($result))
   {
    $count = $count + 1;
    $output .= '
     <tr>
      <td>'.$count.'</td>
      <td>'.$row["ven_name"].'</td>
      <td>'.$row["ven_code"].'</td>
      <td>'.$row["ven_mobile"].'</td>
      <td>'.$row["ven_type"].'</td>
      <td>'.$row["ven_email"].'</td>
      <td>'.$row["ven_website"].'</td>
      <td>'.$row["ven_address"].'</td>
      <td>'.$row["ven_grade"].'</td>
      <td>'.$row["ven_is_active"].'</td>
      <td>
        <a class="btn btn-info" href="edit-vendor.php?edit_id='.$row['ven_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-vendor.php?delete_id='.$row['ven_id'].'">Delete</a>
      </td>
     </tr>
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