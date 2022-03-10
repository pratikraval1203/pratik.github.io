<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `part_master_twenty_two` LEFT JOIN `part_master_one` ON part_master_twenty_two.part_id = part_master_one.part_id
  WHERE `part_desc` LIKE '%".$search."%'
  WHERE `part_number` LIKE '%".$search."%'
  ORDER BY part_master_twenty_two.part_id DESC";

  $result = mysqli_query($conn, $query);
  $count = 0;

  if(mysqli_num_rows($result) > 0)
  {
   
   while($row = mysqli_fetch_array($result))
   {
    $count = $count + 1;
    $ven_id = $row['ven_id'];

    $select_vendor = "SELECT `ven_id`,`ven_name` FROM `vendor_master` WHERE `ven_id` = '$ven_id'";

    $result_vendor = mysqli_query($conn, $select_vendor);

    $row_vendor = mysqli_fetch_array($result_vendor);

    $output .= '
     <tr>
      <td>'.$count.'</td>
      <td>'.$row['part_number'].'-'.$row["part_desc"].'</td>
      <td>'.$row["part_value"].'</td>
      <td>'.$row["po_number"].'</td>
      <td>'.$row_vendor["ven_name"].'</td>
      <td>'.date('d-m-Y', strtotime($row["po_date"])).'</td>
      <td>
        <a class="btn btn-info" href="edit-pm22.php?edit_id='.$row['pm22_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-pm22.php?delete_id='.$row['pm22_id'].'">Delete</a>
      </td>
     </tr>
    ';
   }
   echo $output;
  }
  else
  {
   echo '<td colspan="8">Data Not Found</td>';
  }
}
?>