<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `part_master_one`
  WHERE `part_desc` LIKE '%".$search."%'
  OR `part_number` LIKE '%".$search."%' 
  OR `part_catagory` LIKE '%".$search."%' 
  ORDER BY `part_id` DESC";

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
      <td>'.$row["part_number"].'</td>
      <td>'.$row["part_catagory"].'</td>
      <td>'.$row["part_subpart"].'</td>
      <td>'.$row["part_unit"].'</td>
      <td>'.$row["part_is_active"].'</td>
      <td>
        <a class="btn btn-info" href="edit-pm1.php?edit_id='.$row['part_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-pm1.php?delete_id='.$row['part_id'].'">Delete</a>
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