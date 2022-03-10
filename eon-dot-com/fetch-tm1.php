<?php

include ('connection.php');

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM `track_machine_master_one`
  WHERE `tm_type` LIKE '%".$search."%'
  OR `tm_model_no` LIKE '%".$search."%' 
  ORDER BY `tm_id` DESC";

  //   OR `tm_brand` LIKE '%".$search."%' 

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
      <td>'.$row["tm_model_no"].'</td>
      <td>'.$row["tm_type"].'</td>
      <td>'.$row["tm_make"].'</td>';

    //  <td>'.$row["tm_brand"].'</td>

    $tmem_id = $row['tmem_id'];
    $query_engine = "SELECT `tmem_id`,`tmem_brand`,`tmem_model_no` FROM `track_machine_engine_master` WHERE `tmem_id` = '$tmem_id'";

    $result_engine = mysqli_query($conn,$query_engine);

    // echo mysqli_error($conn);

    // print_r($data);

    while($data = mysqli_fetch_array($result_engine) ){
      $id = $data['tmem_id'];
      $model_no = $data['tmem_model_no'];
      $brand = $data['tmem_brand'];
 
      $output .= '<td>'.$brand."-".$model_no.'</td>';
    }

      $output .= '<td>'.$row["tm_is_active"].'</td>
      <td>
        <a class="btn btn-info" href="edit-tm1.php?edit_id='.$row['tm_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-tm1.php?delete_id='.$row['tm_id'].'">Delete</a>
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