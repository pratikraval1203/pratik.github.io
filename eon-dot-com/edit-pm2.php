<?php
    session_start();

    include('connection.php');

    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
    }

    $alert = "";
    if (isset($_POST['submit'])) {
        // print_r($_POST);

        $part_sel_id = $_POST['part_sel_id'];
        // $part_value = $_POST['part_value'];
        // $part_hsn = $_POST['part_hsn'];
        // $part_gst = $_POST['part_gst'];
        $part_min_stock = $_POST['part_min_stock'];
        $part_max_stock = $_POST['part_max_stock'];
        $part_warranty = $_POST['warranty_'.$part_sel_id.''];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        if ($part_min_stock > $part_max_stock) {
            $alert = "Minimum Stock is greater than Maximum Stock";
        }
        else {
            $update_sql = "UPDATE `part_master_two` SET `part_min_stock`='$part_min_stock',`part_max_stock`='$part_max_stock',`part_warranty`='$part_warranty',`part_updated_time`='$updated_time',`part_updated_by`='$updated_by' WHERE `part_id` = '$part_sel_id'";

            if(mysqli_query($conn , $update_sql)) {
                $alert = "Part Data Edited Successfully";
                // echo "<script language='javascript' type='text/javascript'>window.location = 'part-master2.php?msg=".$alert."'</script>";
            }
            else {
                $alert = mysqli_error($conn);
                // echo $alert;
            }
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

    <title>Edit Part Details</title>

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

<body id="page-top">

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
                      ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Part Details </h6>
                            <a class="float-right font-weight-bold mylink" href="part-master2.php">
                                <i class="fa fa-eye"></i>
                                View Part Details List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Part Details</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master2.php">
                                <i class="fa fa-eye"></i>
                                View Part Details List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                        <?php
                            $select_sql = "SELECT part_master_two.part_id, `part_min_stock`, `part_max_stock`, `part_warranty`, part_master_one.part_id, part_master_one.part_desc FROM `part_master_two` LEFT JOIN `part_master_one` ON part_master_two.part_id = part_master_one.part_id WHERE part_master_two.part_id = '$edit_id'";

                            $result = mysqli_query($conn, $select_sql);

                            // print_r($result);

                            while ($data = mysqli_fetch_assoc($result)) {
                                // print_r($data);
                        ?>
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-4">
                                    <label for="part_sel_id">Part:</label>
                                    <select id="part_sel_id" name="part_sel_id" class="form-control mydrpdwn">
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
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="number-input">Minimum Stock</label>
                                    <input class="form-control" type="number" id="number-input" name="part_min_stock" value="<?php echo $data['part_min_stock']; ?>">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="number-input">Maximum Stock</label>
                                    <input class="form-control" type="number" id="number-input" name="part_max_stock" value="<?php echo $data['part_max_stock']; ?>">
                                    
                                </div>
                            
                                <div class="form-group mb-3 col-md-4 clearfix">
                                    <label class="form-label float-left">Warranty Available?</label>
                                <?php
                                    if ($data['part_warranty'] == 1) {
                                    echo "

                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l1_".$data['part_id']."' name='warranty_".$data['part_id']."' value='1' checked>
                                        <label for='l1_".$data['part_id']."'>Yes</label>
                                    </div>
                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l2_".$data['part_id']."' name='warranty_".$data['part_id']."' value='0'>
                                        <label for='l2_".$data['part_id']."'>No</label>
                                    </div>
                                       
                                      ";
                                    }
                                    else {
                                    echo "

                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l1_".$data['part_id']."' name='warranty_".$data['part_id']."' value='1'>
                                        <label for='l1_".$data['part_id']."'>Yes</label>
                                    </div>
                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l2_".$data['part_id']."' name='warranty_".$data['part_id']."' value='0' checked>
                                        <label for='l2_".$data['part_id']."'>No</label>
                                    </div>
                                        
                                      ";
                                    }
                                ?>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group ml-5">
                                    <input class="btn btn-primary" type="submit" name="submit"></input>
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