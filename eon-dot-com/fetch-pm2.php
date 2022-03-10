<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `part_master_two` LEFT JOIN `part_master_one` ON part_master_two.part_id = part_master_one.part_id
  WHERE `part_desc` LIKE '%".$search."%'
  ORDER BY part_master_two.part_id DESC";

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
      <td>'.$row['part_number'].'-'.$row["part_desc"].'</td>
      <td>'.$row["part_min_stock"].'</td>
      <td>'.$row["part_max_stock"].'</td>
      <td>'.$row["part_warranty"].'</td>
      <td>
        <a class="btn btn-info" href="edit-pm2.php?edit_id='.$row['part_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-pm2.php?delete_id='.$row['part_id'].'">Delete</a>
      </td>
     </tr>
    ';
   }
   echo $output;
  }
  else
  {
   echo 'Data Not Found';
  }
}
?>