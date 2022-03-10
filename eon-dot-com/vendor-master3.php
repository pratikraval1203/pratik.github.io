<?php 
  session_start();

  include ('connection.php');

  if (isset($_POST['ven_sel_id'])) {
        // echo "string";
        $last_id = $_POST['ven_sel_id'];
        // echo $last_id;
        $append = "WHERE vendor_master_three.ven_id = '$last_id' ";
    } else {
        $append = "WHERE vendor_master_three.ven_id = 'none' ";
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

    <title>Parts Provided By Vendor</title>

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
                            <h6 class="m-0 font-weight-bold float-left text-primary">List of Parts Provided</h6>
                            <a class="float-right font-weight-bold mylink" href="vendor3-reg.php">
                                <i class="fa fa-plus"></i>
                                Add Parts Provided
                            </a>                 
                        </div>
                        <div class="card-body">
                            <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                                <div class="row mt-3">
                                    <div class="form-group col-md-3">
                                        <!-- <label for="part_sel_id" class="form-label">Select Vendor:</label> -->
                                        <select id="ven_sel_id" class="mydrpdwn form-control" name="ven_sel_id" required="required" onchange="this.form.submit()">
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
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Part Name</th>
                                            <th>Part Number</th>
                                            <th>Part Catagory</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT `vm3_id`,`part_desc`, `part_number`, `part_catagory` FROM `vendor_master_three` LEFT JOIN `part_master_one` ON vendor_master_three.part_id = part_master_one.part_id ".$append." ORDER BY `vm3_id` DESC";

                                        // echo $sql;

                                        $result = mysqli_query($conn,$sql);
                                        $count = 0;

                                        while($row = mysqli_fetch_array($result) ){
                                            $count = $count + 1;
                                           
                                            echo '
                                               <tr>
                                                <td>'.$count.'</td>
                                                <td>'.$row["part_desc"].'</td>
                                                <td>'.$row["part_number"].'</td>
                                                <td>'.$row["part_catagory"].'</td>
                                                <td>
                                                  <a class="btn btn-info" href="edit-vendor3.php?edit_id='.$row['vm3_id'].'">Edit</a>
                                                </td>
                                                <td>
                                                  <a class="btn btn-danger" href="del-vendor3.php?delete_id='.$row['vm3_id'].'&table=main">Delete</a>
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
    </script>

</body>

</html>
<?php 
    include ('disconnect.php');
?>