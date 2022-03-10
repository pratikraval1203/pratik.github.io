<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `track_machine_engine_master`
  WHERE `tmem_brand` LIKE '%".$search."%'
  OR `tmem_model_no` LIKE '%".$search."%'
  ORDER BY `tmem_id` DESC";

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
      <td>'.$row["tmem_brand"].'</td>
      <td>'.$row["tmem_model_no"].'</td>
      <td>'.$row["tmem_remarks"].'</td>
      <td>
        <a class="btn btn-info" href="edit-tmem.php?edit_id='.$row['tmem_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-tmem.php?delete_id='.$row['tmem_id'].'">Delete</a>
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