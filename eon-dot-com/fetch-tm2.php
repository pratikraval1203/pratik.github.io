<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM track_machine_master_two tmmt, part_master_one pmo, track_machine_master_one tmmo where (pmo.part_id = tmmt.part_id and tmmt.tm_id = tmmo.tm_id && `tm_model_no` LIKE '%".$search."%') 
  OR (pmo.part_id = tmmt.part_id and tmmt.tm_id = tmmo.tm_id && `tm_type` LIKE '%".$search."%')
  OR (pmo.part_id = tmmt.part_id and tmmt.tm_id = tmmo.tm_id && `tm_brand` LIKE '%".$search."%')
  OR (pmo.part_id = tmmt.part_id and tmmt.tm_id = tmmo.tm_id && `tm_catagory` LIKE '%".$search."%')
  OR (pmo.part_id = tmmt.part_id and tmmt.tm_id = tmmo.tm_id && `part_desc` LIKE '%".$search."%')
  OR (pmo.part_id = tmmt.part_id and tmmt.tm_id = tmmo.tm_id && `tm_part_desc` LIKE '%".$search."%')
  ORDER BY `tm2_id` DESC";

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
      <td>'.$row['tm_type']."-".$row["tm_brand"]."-".$row["tm_model_no"].'</td>
      <td>'.$row["part_desc"].'</td>
      <td>'.$row["tm_catagory"].'</td>
      <td>'.$row["tm_part_desc"].'</td>
      <td>
        <a class="btn btn-info" href="edit-tm2.php?edit_id='.$row['tm2_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-tm2.php?delete_id='.$row['tm2_id'].'&table=main">Delete</a>
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