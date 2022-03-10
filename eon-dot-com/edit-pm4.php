<?php
    session_start();

    include('connection.php');

    $alert = "";
    $last_id = "";
    $last_name = "";
    $append = "";
    $action = "";
    $edit_id = "";

    $edit_id = $_GET['edit_id'];

    if (isset($_GET['change_id'])) {
        $last_id = $_GET['change_id'];
        // echo $last_id;
        $append = "WHERE part_master_eight.part_id = '$last_id' ";
    } else {
        $append = "";
    }

    if (isset($_GET['msg'])) {
        $alert = $_GET['msg'];
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

        $last_inhouse = $_POST['part_inhouse_repair'];
        $last_repairable = $_POST['part_is_repairable'];
        $last_id = $_POST['part_sel_id'];

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
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Repairable Part Entry</title>

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
                            }
                        ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Repairable Part</h6>
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Repairable Part</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master4.php">
                                <i class="fa fa-eye"></i>
                                View Repairable Part List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                            <?php
                                $select_sql = "SELECT * FROM part_master_one o, part_master_eight e, vendor_master v where o.part_id = e.part_id and e.ven_id = v.ven_id && pm8_id = '$edit_id'";

                                // echo $select_sql;

                                $result = mysqli_query($conn, $select_sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $pm8_id = $row['pm8_id'];
                                    $id = $row['part_id'];
                                    $desc = $row['part_desc'];
                                    $ven_id = $row['ven_id'];
                            ?>
                            <div class="row mt-3 mx-3">
                                 <div class="form-group col-md-4">
                                    <!-- <label for="part_sel_id" class="form-label">Part:</label> -->
                                    <!-- <select onchange="self.location=self.location+'?idx='+this.selectedIndex"> -->
                                    <select id="part_sel_id" name="part_sel_id" class="mydrpdwn form-control">
                                            <?php
                                            $part_id = $data['part_id'];

                                            $query = "SELECT `part_id`,`part_number`,`part_desc` FROM `part_master_one` WHERE `parT_id` = '$part_id'";
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
                        <?php
                            }
                        ?>
                        </form>
                    </div>
                    <!-- /.card mb-4 shadow -->

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