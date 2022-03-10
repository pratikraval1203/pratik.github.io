<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
  $search = mysqli_real_escape_string($conn, $_POST["query"]);
  $query = "
  SELECT * FROM  `user_master` 
  WHERE `usr_name` LIKE '%".$search."%'
  OR `usr_mobile` LIKE '%".$search."%' 
  OR `usr_email` LIKE '%".$search."%' 
  OR `usr_department` LIKE '%".$search."%' 
  OR `usr_designation` LIKE '%".$search."%'
  ORDER BY `usr_id`";

   // echo $query;

  $result = mysqli_query($conn, $query);
  $count = 0;
  if(mysqli_num_rows($result) > 0) {
   

   while($row = mysqli_fetch_array($result))
   {
    $count = $count + 1;
    $output .= '
     <tr>
      <td>'.$count.'</td>
      <td>'.$row["usr_name"].'</td>
      <td>'.$row["usr_email"].'</td>
      <td>'.$row["usr_mobile"].'</td>
      <td>'.$row["usr_department"].'</td>
      <td>'.$row["usr_designation"].'</td>
      <td>'.$row["usr_admin_level"].'</td>
      <td>'.$row["usr_remarks"].'</td>
      <td>'.$row["usr_is_active"].'</td>
      <td>
        <a class="btn btn-info" href="edit-user.php?edit_id='.$row['usr_id'].'&pg_id=user-master" class="">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-user.php?delete_id='.$row['usr_id'].'&pg_id=user-master" class="">Delete</a>
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