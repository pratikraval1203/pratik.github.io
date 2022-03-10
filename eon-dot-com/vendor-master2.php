<?php 
  session_start();

  include ('connection.php');

    if (isset($_POST['ven_sel_id'])) {
        // echo "string";
        $last_id = $_POST['ven_sel_id'];
        // echo $last_id;
        $append = "WHERE vendor_master_two.ven_id = '$last_id' ";
    } else {
        $append = "WHERE vendor_master_two.ven_id = 'none' ";
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

    <title>Vendor Contact Person Details</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/mycss.css">

    <link rel="stylesheet" href="select2.min.css" />
    <style>
        /*.select2-dropdown {
            top: 22px !important; 
            left: 8px !important;
        }*/
    </style>
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
                    <div class="card shadow mb-4">
                        <!-- <?php
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
                        ?> -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Vendor Contact Person Details</h6>
                            <a class="float-right font-weight-bold mylink" href="vendor2-reg.php">
                                <i class="fa fa-plus"></i>
                                Add Contact Person Details
                            </a>                 
                        </div>
                        <div class="card-body">
                            <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                                <div class="row mt-3">
                                    <div class="form-group col-md-3">
                                        <!-- <label for="part_sel_id" class="form-label">Select Vendor:</label> -->
                                        <select id="ven_sel_id" class=" mydrpdwn form-control" data-show-subtext="true" data-live-search="true" name="ven_sel_id" required="required" onchange="this.form.submit()">
                                            <!-- I took out onchange="self.location= 'vendor2-reg.php?change_id='+this.selectedIndex" from select -->
                                            <?php

                                                if ($last_id == "") {
                                                    $last_name = "Vendor";
                                                } else {
                                                    $query = "SELECT `ven_id`,`ven_name` FROM `vendor_master` WHERE ven_id = '$last_id'";

                                                    $result1 = mysqli_query($conn,$query);

                                                    while($row = mysqli_fetch_array($result1)) {
                                                        $id = $row['ven_id'];
                                                        $name = $row['ven_name'];
                                                        if ($last_id == $id) {
                                                            $last_name = $name;
                                                        }
                                                    }
                                                }
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $last_name; ?></option>
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
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered nowrap" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Contact Person Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Address</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM `vendor_master_two`".$append." ORDER BY `vm2_id` DESC";

                                        $result = mysqli_query($conn,$sql);
                                        $count = 0;

                                        while($row = mysqli_fetch_array($result) ){
                                            $count = $count + 1;

                                            // SELECT `vm2_id`, `ven_id`, `cp_name`, `cp_dept`, `cp_designation`, `cp_mobile`, `cp_email`, `cp_address`, `updated_time`, `updated_by` FROM `vendor_master_two` WHERE 1
                                           
                                            echo '
                                               <tr>
                                                <td>'.$count.'</td>
                                                <td>'.$row["cp_name"].'</td>
                                                <td>'.$row["cp_email"].'</td>
                                                <td>'.$row["cp_mobile"].'</td>
                                                <td>'.$row["cp_dept"].'</td>
                                                <td>'.$row["cp_designation"].'</td>
                                                <td>'.$row["cp_address"].'</td>
                                                <td>
                                                  <a class="btn btn-info" href="edit-vendor2.php?edit_id='.$row['vm2_id'].'">Edit</a>
                                                </td>
                                                <td>
                                                  <a class="btn btn-danger" href="del-vendor2.php?delete_id='.$row['vm2_id'].'&table=main">Delete</a>
                                                </td>
                                               </tr>
                                              ';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card mb-3 -->

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

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="select2.min.js"></script>
    <script>
        $("select").select2( {
            // placeholder: "Select Country"
            // allowClear: true
            } );
        $('th').attr('nowrap','nowrap');
        $('td').attr('nowrap','nowrap');
    </script>


    <script type="text/javascript" src="js/myjs.js"></script>


</body>

</html>
<?php 
    include ('disconnect.php');
?>