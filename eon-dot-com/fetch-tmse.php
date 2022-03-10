<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `track_machine_schedule_entry` LEFT JOIN `track_machine_master_one` ON track_machine_schedule_entry.tmse_tm_id = track_machine_master_one.tm_id
  WHERE `tm_model_no` LIKE '%".$search."%'
  OR `tmse_unique_machine_no` LIKE '%".$search."%' 
  OR `tmse_purchase_date` LIKE '%".$search."%' 
  ORDER BY `tmse_id` DESC";

  $result = mysqli_query($conn, $query);
  $count = 0;

  if(mysqli_num_rows($result) > 0)
  {
   
   while($row = mysqli_fetch_array($result))
   {
    $count = $count + 1;
    $tmse_purchase_date = strtotime($row["tmse_purchase_date"]);
    $output .= '
     <tr>
      <td>'.$count.'</td>
      <td>'.$row["tm_model_no"].'</td>
      <td>'.$row["tmse_unique_machine_no"].'</td>
      <td>'.date('d-m-Y',$tmse_purchase_date).'</td>
      <td>
        <a class="btn btn-info" href="edit-tmse.php?edit_id='.$row['tmse_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-tmse.php?delete_id='.$row['tmse_id'].'">Delete</a>
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