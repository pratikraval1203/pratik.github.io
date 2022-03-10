<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `part_master_five` LEFT JOIN `part_master_one` ON part_master_five.part_id = part_master_one.part_id
  WHERE `part_desc` LIKE '%".$search."%'
  OR `part_number` LIKE '%".$search."%'
  OR `part_ann_entry_no` LIKE '%".$search."%' 
  OR `part_spn` LIKE '%".$search."%' 
  OR `part_drawing_no` LIKE '%".$search."%' 
  ORDER BY part_master_five.part_id DESC";

  $result = mysqli_query($conn, $query);
  $count = 0;

  if(mysqli_num_rows($result) > 0)
  {
   
   while($row = mysqli_fetch_array($result))
   {
    $count = $count + 1;
    $usr_id = $row['part_proposed_by'];

    $select_user = "SELECT `usr_name` FROM `user_master` WHERE `usr_id` = '$usr_id'";

    $result_user = mysqli_query($conn, $select_user);

    $row_user = mysqli_fetch_array($result_user);

    $output .= '
     <tr>
      <td>'.$count.'</td>
      <td>'.$row['part_number'].'-'.$row["part_desc"].'</td>
      <td>'.$row["part_ann_entry_no"].'</td>
      <td>'.$row["part_spn"].'</td>
      <td>'.$row["part_drawing_no"].'</td>
      <td>'.$row_user["usr_name"].'</td>
      <td>
        <a class="btn btn-info" href="edit-pm5.php?edit_id='.$row['part_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-pm5.php?delete_id='.$row['part_id'].'">Delete</a>
      </td>
     </tr>
    ';
   }
   echo $output;
  }
  else
  {
   echo '<td colspan="5">Data Not Found</td>';
  }
}
?>