<?php
    session_start();

    include('connection.php');

    $alert = "";
    if (isset($_POST['submit'])) {

        $part_sel_id = $_POST['part_sel_id'];
        $part_value = $_POST['part_value'];
        $po_number = $_POST['po_number'];
        $po_date = $_POST['po_date'];
        $ven_id = $_POST['ven_id'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        $insert_sql = "INSERT INTO `part_master_twenty_two`(`part_id`, `part_value`, `po_number`, `po_date`, `ven_id`, `updated_time`, `updated_by`) VALUES ('$part_sel_id','$part_value','$po_number','$po_date','$ven_id','$updated_time','$updated_by')";

        if(mysqli_query($conn , $insert_sql)) {
            $alert = "Part Data Added Successfully";
        }
        else {
            $alert = mysqli_error($conn);
            // echo $alert;
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

    <title>Add Part Price List</title>

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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Part Price List</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master22.php">
                                <i class="fa fa-eye"></i>
                                View Part Price List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Part Price List</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master22.php">
                                <i class="fa fa-eye"></i>
                                View Part Price List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-4">
                                    <label for="part_sel_id">Part:</label>
                                    <select id="part_sel_id" name="part_sel_id" class="form-control mydrpdwn">
                                        <?php 
                                            $query = "SELECT `part_id`,`part_number`,`part_desc` FROM `part_master_one`";
                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            // print_r($row);
                         
                                            while($row = mysqli_fetch_array($result) ){
                                            $id = $row['part_id'];
                                            $number = $row['part_number'];
                                            $desc = $row['part_desc'];
                                                // foreach ($row as $i) {  
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $number.'-'.$desc; ?></option>
                                        <?php
                                                // }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="text-input">Part Value</label>
                                    <input class="form-control" required="required" type="number" id="text-input" name="part_value">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="ven_id">Vendor Selection</label>
                                    <select id="ven_id" name="ven_id" class="form-control mydrpdwn">
                                        <option selected="" disabled=""></option>
                                        <?php

                                            $query = "SELECT `ven_id`,`ven_name` FROM `vendor_master` ORDER BY `ven_name`";

                                            $result = mysqli_query($conn,$query);
                                            
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $id = $row['ven_id'];
                                                $name = $row['ven_name'];
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <!-- <input class="form-control" type="number" id="number-input" name="part_max_stock"> -->
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="po_number">PO Number</label>
                                    <input class="form-control" type="number" id="po_number" name="po_number">    
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="po_date">PO Date</label>
                                    <input class="form-control" type="date" id="po_date" name="po_date">    
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group ml-5">
                                    <input class="btn btn-primary" type="submit" name="submit"></input>
                                </div>
                                <div class="form-group ml-3">
                                    <input class="btn btn-danger" type="reset" name="clear" value="Clear"></input>
                                </div>
                            </div>
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