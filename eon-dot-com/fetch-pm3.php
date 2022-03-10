<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `part_master_three` LEFT JOIN `part_master_one` ON part_master_three.part_id = part_master_one.part_id 
  WHERE `part_desc` LIKE '%".$search."%'
  OR `part_op_stock` LIKE '%".$search."%'
  OR `part_storage_location` LIKE '%".$search."%' 
  ORDER BY `pm3_id` DESC";

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
      <td>'.$row["part_desc"].'</td>
      <td>'.$row["part_op_stock"].'</td>
      <td>'.$row["part_storage_location"].'</td>
      <td>
        <a class="btn btn-info" href="edit-pm3.php?edit_id='.$row['pm3_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-pm3.php?delete_id='.$row['pm3_id'].'&table=main">Delete</a>
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