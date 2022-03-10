<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `part_master_seven` LEFT JOIN `part_master_one` ON part_master_seven.part_id = part_master_one.part_id 
  WHERE `part_desc` LIKE '%".$search."%'
  OR `part_number` LIKE '%".$search."%'
  OR `part_hsn` LIKE '%".$search."%'
  OR `part_gst` LIKE '%".$search."%'";

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
      <td>'.$row["part_hsn"].'</td>
      <td>'.$row["part_gst"].'</td>
      <td>
        <a class="btn btn-info" href="edit-pm7.php?edit_id='.$row['part_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-pm7.php?delete_id='.$row['part_id'].'&table=main">Delete</a>
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