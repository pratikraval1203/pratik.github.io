<?php
    session_start();

    include('connection.php');

    $alert = "";
    $last_id = "";
    $last_name = "";
    $append = "";
    $action = "";

    if (isset($_GET['msg'])) {
        $alert = $_GET['msg'];
    }

    if (isset($_GET['change_id'])) {
        $last_id = $_GET['change_id'];
        // echo $last_id;
        $append = "WHERE part_master_four.part_id = '$last_id' ";
    } else {
        $append = "";
    }
    $action = $_SERVER['PHP_SELF']."?change_id=".$last_id;


    if (isset($_POST['final_submit'])) {

        $final_id = $_POST['final_id'];
        $final_ven_id = $_POST['final_ven_id'];
        $updated_time = date('Y-m-d H:i:s');

        $part_is_repairable = $_POST['part_is_repairable'];
        $part_inhouse_repair = $_POST['part_inhouse_repair'];
        $part_final_id = "";

        // echo "<pre>";
        // var_dump($final_id);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($final_ven_id);
        // echo "</pre>";

        $count1 = count($_POST['final_id']);

        // echo $count1;

        for ($i= 0 ; $i < $count1 ; $i++) {
            $final_sql = "INSERT INTO `part_master_eight` (`part_id`, `ven_id`, `updated_time`,`updated_by`) VALUES ('{$final_id[$i]}','{$final_ven_id[$i]}','$updated_time','')";

            // echo $final_sql;

            $part_final_id = $final_id[$i];

            if (mysqli_error($conn)) {
                $msg = mysqli_error($conn);
                echo "<script type='text/Javascript'>alert('$msg')</script>";
             } 

            if(mysqli_query($conn , $final_sql)) {
                    $alert = "Final Records successfully Inserted";
                } 
        }
        $sql2 = "INSERT INTO `part_master_four`(`part_id`, `part_is_repairable`, `part_inhouse_repair`, `part_updated_time`, `part_updated_by`) VALUES ('$part_final_id','$part_is_repairable','$part_inhouse_repair','$updated_time','')"; 

            if(mysqli_query($conn , $sql2)) {
                // echo "Final Records successfully Deleted";
            }

        $final_sql2 = "TRUNCATE TABLE  `part_master_eight_ex`"; 

            if(mysqli_query($conn , $final_sql2)) {
                // echo "Final Records successfully Deleted";
            }
    }
    elseif (isset($_POST['submit'])) {

        $last_id = $_POST['part_sel_id'];
        
        if ($last_id == "none") {
            $alert = "Please Select Part";
        }else {
            $last_inhouse = $_POST['part_inhouse_repair'];
            $last_repairable = $_POST['part_is_repairable'];

            $part_eight_id = $_POST['part_sel_id'];
            $ven_eight_id = $_POST['ven_sel_id'];
            $updated_time = date('Y-m-d H:i:s');

            $sql = "INSERT INTO `part_master_eight_ex` (`part_id`, `ven_id` , `updated_time`, `updated_by`) VALUES ('$part_eight_id','$ven_eight_id','$updated_time','')";

            if(mysqli_query($conn , $sql)) {
                $alert = "Records successfully Inserted";
                $last_ins_id = mysqli_insert_id($conn);
            }

            echo mysqli_error($conn);
        }  
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Reapairable Part Entry</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/mycss.css">

    <link rel="stylesheet" href="select2.min.css" />
</head>

<?php
    if (isset($last_inhouse)) {
        echo '<body id="page-top">';
    }
    else {
        echo '<body id="page-top" onload="myFunction()">';
    }
?>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            include ('sidebar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include ('topbar.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card mb-4 shadow">
                        <?php 
                        if ($alert != "") {

                            if ($alert == "Records successfully Inserted") {
                               echo '<div class="alert alert-success" role="alert">
                                        Record Added
                                    </div>';
                            } elseif ($alert == "Final Records successfully Inserted") {
                                echo'<div class="alert alert-success" role="alert">
                                        Record successfully Insterted
                                    </div>';
                            } elseif ($alert == "Records successfully updated") {
                                echo '<div class="alert alert-success" role="alert">
                                        Record Successfully Updated
                                    </div>';
                            } elseif ($alert == "Records successfully deleted") {
                                echo '<div class="alert alert-success" role="alert">
                                        Record Successfully Deleted
                                    </div>';
                            } elseif ($alert == "Please Select Part") {
                                echo '<div class="alert alert-danger" role="alert">
                                        Please Select Part
                                    </div>';
                            }
                        ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Repairable Part</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master4.php">
                                <i class="fa fa-eye"></i>
                                View Repairable Part List
                            </a>                 
                        </div>
                        <?php
                        }
                        else {
                        ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Repairable Part</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master4.php">
                                <i class="fa fa-eye"></i>
                                View Repairable Part List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <form name="myform" class="bootstrap-form-with-validation" action="<?php $action ?>" method="post" onsubmit="return validate()">
                            <!-- <form id='form-id'>
                                <input id='watch-me' name='test' type='radio' /> Show Div<br />
                                <input name='test' type='radio' /><br />
                                <input name='test' type='radio' />
                            </form> -->
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-4">
                                    <!-- <label for="part_sel_id" class="form-label">Part:</label> -->
                                    <select id="part_sel_id" class="mydrpdwn form-control" name="part_sel_id" required="required">
                                        <?php
                                            $number = "";

                                            if ($last_id == "") {
                                                $id = "none";
                                                $last_name = "Part";
                                            } else {
                                                $query = "SELECT `part_id`,`part_number`,`part_desc` FROM `part_master_one` WHERE part_id = '$last_id'";

                                                $result1 = mysqli_query($conn,$query);

                                                while($row = mysqli_fetch_array($result1)) {
                                                    $id = $row['part_id'];
                                                    $number = $row['part_number'];
                                                    $desc = $row['part_desc'];
                                                    if ($last_id == $id) {
                                                        $last_name = $desc;
                                                    }
                                                }
                                            }
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $number."-".$last_name; ?></option>
                                        <?php 
                                            $query = "SELECT `part_id`,`part_number`,`part_desc` FROM `part_master_one`";
                                            $result = mysqli_query($conn,$query);
                                        
                                            // echo mysqli_error($conn);

                                            // print_r($row);
                         
                                            while($row = mysqli_fetch_array($result) ){
                                            $id = $row['part_id'];
                                            $number = $row['part_number'];
                                            $desc = $row['part_desc'];
                                                // foreach ($row as $i) {  
                                        ?>
                                                <option value="<?php echo $id; ?>"><?php echo $number."-".$desc; ?></option>
                                        <?php
                                                // }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 mx-3">
                                <?php
                                    if (isset($last_inhouse)) {
                                ?>
                                <div class="form-group mb-3 col-md-4 clearfix">
                                    <label class="form-label float-left">Is Repairable?</label>
                                    <div class="form-check float-left ml-2">
                                        <input class="form-check-input" type="radio" name="part_is_repairable" id="formCheck-2" value="1" checked="">
                                        <label class="form-check-label" for="formCheck-2">Yes</label>
                                    </div>
                                    <div class="form-check float-left ml-2">
                                        <input class="form-check-input" type="radio" name="part_is_repairable" id="a" value="0">
                                        <label class="form-check-label" for="a">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-md-4 clearfix"  id="show-me-2">
                                    <label class="form-label float-left">In house Repairable?</label>
                                    <?php
                                        if ($last_inhouse == 1) {
                                        echo '

                                        <div class="form-check float-left ml-2">
                                            <input class="form-check-input" type="radio" name="part_inhouse_repair" id="b" value="1" checked="">
                                            <label class="form-check-label" for="b">Yes</label>
                                        </div>
                                        <div class="form-check float-left ml-2">
                                            <input class="form-check-input" type="radio" name="part_inhouse_repair" id="c" value="0">
                                            <label class="form-check-label" for="c">No</label>
                                        </div>
                                           
                                          ';
                                        }
                                        else {
                                        echo '

                                        <div class="form-check float-left ml-2">
                                            <input class="form-check-input" type="radio" name="part_inhouse_repair" id="b" value="1">
                                            <label class="form-check-label" for="b">Yes</label>
                                        </div>
                                        <div class="form-check float-left ml-2">
                                            <input class="form-check-input" type="radio" name="part_inhouse_repair" id="c" value="0"  checked="">
                                            <label class="form-check-label" for="c">No</label>
                                        </div>                                            
                                          ';
                                        }
                                    }
                                    else { 
                                ?>  
                                <div class="form-group mb-3 col-md-4 clearfix">
                                    <label class="form-label float-left">Is Repairable?</label>
                                    <div class="form-check float-left ml-2">
                                        <input class="form-check-input" type="radio" name="part_is_repairable" id="formCheck-2" value="1">
                                        <label class="form-check-label" for="formCheck-2">Yes</label>
                                    </div>
                                    <div class="form-check float-left ml-2">
                                        <input class="form-check-input" type="radio" name="part_is_repairable" id="a" value="0"  checked="">
                                        <label class="form-check-label" for="a">No</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-md-4 clearfix"  id="show-me-2">
                                    <label class="form-label float-left">In house Repairable?</label>
                                    <div class="form-check float-left ml-2">
                                        <input class="form-check-input" type="radio" name="part_inhouse_repair" id="b" value="1">
                                        <label class="form-check-label" for="b">Yes</label>
                                    </div>
                                    <div class="form-check float-left ml-2">
                                        <input class="form-check-input" type="radio" name="part_inhouse_repair" id="c" value="0"  checked="">
                                        <label class="form-check-label" for="c">No</label>
                                    </div>
                                <?php
                                    }
                                ?>
                                </div> 
                            </div>
                            <div class="row mt-3 mx-3" id="show-me-3">
                                <div class="form-group col-md-4">
                                    <label for="ven_sel_id">Add Prefered Vendor</label>
                                    <select id="ven_sel_id" name="ven_sel_id" class="form-control mydrpdwn">
                                        <?php 
                                            $query = "SELECT `ven_id`,`ven_name` FROM `vendor_master`";
                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            print_r($row);
                         
                                            while($row = mysqli_fetch_array($result) ){
                                            $id = $row['ven_id'];
                                            $name = $row['ven_name'];
                                                // foreach ($row as $i) {  
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                            <?php
                                                // }
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 mt-4">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add More"></input>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="form-group ml-5">
                                    <input class="btn btn-primary" type="submit" name="submit"></input>
                                </div>
                                <div class="form-group ml-3">
                                    <input class="btn btn-danger" type="reset" name="clear" value="Clear"></input>
                                </div>
                            </div> -->
                        </form>
                    </div>
                    <!-- /.card mb-4 shadow -->

                    <div class="card mb-4 shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Added Prefered Vendors</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="part-master3.php">
                                <i class="fa fa-eye"></i>
                                View Part Master 3 List
                            </a>   -->               
                        </div>
                        <!-- <caption>Temp Database Data</caption> -->
                        <form id="part_master32" class="bootstrap-form-with-validation" action="<?php $action ?>" method="post">
                            <input type="hidden" name="part_is_repairable" value="<?= $last_repairable ?>">
                            <input type="hidden" name="part_inhouse_repair" value="<?= $last_inhouse ?>">
                            <table class="table table-bordered">
                                <thead>
                                    <tr style='background: whitesmoke;'>
                                        <!-- <th>Part ID</th> -->
                                        <th>Part Name</th>
                                        <th>Vendor Name</th>
                                        <!-- <th>Edit</th> -->
                                        <th>Delete</th>      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    $sql = "SELECT part_master_eight_ex.part_id, `pm8_id`, `ven_id`, part_master_one.part_id, part_master_one.part_desc, part_master_one.part_number FROM `part_master_eight_ex` LEFT JOIN `part_master_one` ON part_master_eight_ex.part_id = part_master_one.part_id";

                                    $result = mysqli_query($conn,$sql);

                                    while($row = mysqli_fetch_array($result) ){
                                        $pm8_id = $row['pm8_id'];
                                        $part_id = $row['part_id'];
                                        $part_desc = $row['part_desc'];
                                        $part_number = $row['part_number'];
                                        $ven_id = $row['ven_id'];
                                    ?>
                                        <tr>
                                            <td>
                                                <!-- <input type='checkbox' name='update[]' value='<?= $part_id ?>'> -->
                                                <input type="hidden" name="final_id[]" value="<?= $part_id ?>">
                                                <input type="hidden" name="pm8_id[]" value="<?= $pm8_id ?>">
                                                <input type='text' name='final_desc[]>' value='<?= $part_number."-".$part_desc ?>' readonly>
                                            </td>
                                            <?php
                                                $ven_sql = "SELECT `ven_id`,`ven_name` FROM `vendor_master` WHERE `ven_id` = '$ven_id'";
                                                $ven_result = mysqli_query($conn,$ven_sql);

                                                while($ven_row = mysqli_fetch_array($ven_result) ){
                                            ?>
                                            <td>
                                                <input type='text' name='final_ven_name[]' value='<?= $ven_row['ven_name'] ?>'>
                                                <input type="hidden" name="final_ven_id[]" value="<?= $ven_row['ven_id'] ?>">
                                            </td>   
                                            <?php
                                                }
                                            ?>                 
                                            <td>
                                                <?php
                                                    echo "<a class='btn btn-danger' href='del-pm4.php?delete_id=".$pm8_id."&change_id=".$part_id."&table=temp'>Delete</a>";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <input class="btn btn-primary" type="submit" name="final_submit" value="Final Submit">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                include ('footer.php');
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
        include ('logout.php');
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="select2.min.js"></script>
    <script>
        $("select").select2( {
            // placeholder: "Select Country"
            // allowClear: true
            } );
    </script>

    <script type="text/javascript">
        function myFunction() {
            $('#show-me-2').hide();
            $('#show-me-3').hide();
        }

        $(document).ready(function() {
           $('input[name="part_is_repairable"]').click(function() {
               if($(this).attr('id') == 'formCheck-2') {
                    $('#show-me-2').show();  
                    $('#show-me-3').show();       
               }
               else {
                    $('#show-me-2').hide();
                    $('#show-me-3').hide();  
               }
           });
        });

        function validate(){
            // for name
            var name = document.myform.usr_name.value;
            var letters = /^[A-Za-z\s]+$/;
          if(!name.match(letters))
          {
            document.getElementById("nameloc").innerHTML="Please Enter Valid Name";
          return false;         
          }
          else {
            document.getElementById("nameloc").innerHTML="";
          }
        // for mobile number
        var num=document.myform.usr_mobile.value;
        if (isNaN(num)){
          document.getElementById("numloc").innerHTML="Please Enter Numeric value only";
          return false;
          var phoneno = /^\d{10}$/;
          if(!num.match(phoneno))
          {
             document.getElementById("numloc").innerHTML="Not a valid Phone Number";
            return false;
          }
          else {
            document.getElementById("numloc").innerHTML="valid Phone Number ";
          }
        }
        else{
            var phoneno = /^\d{10}$/;
          if(!num.match(phoneno))
          {
             document.getElementById("numloc").innerHTML="Not a valid Phone Number";
            return false;
          }
          else {
            document.getElementById("numloc").innerHTML="valid Phone Number ";
          }
        }
      }
    </script>

</body>

</html>
<?php 
    include ('disconnect.php');
?>