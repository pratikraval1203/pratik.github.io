<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM part_master_one o, part_master_eight e, vendor_master v where (o.part_id = e.part_id and e.ven_id = v.ven_id && `part_desc` LIKE '%".$search."%') 
  OR (o.part_id = e.part_id and e.ven_id = v.ven_id && `ven_name` LIKE '%".$search."%')
  ";

  // echo $query;

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
      <td>'.$row["ven_name"].'</td>
      <td>
        <a class="btn btn-info" href="edit-pm4.php?edit_id='.$row['pm8_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-pm4.php?delete_id='.$row['pm8_id'].'&table=main">Delete</a>
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