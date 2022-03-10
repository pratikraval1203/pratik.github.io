<?php
    session_start();

    include('connection.php');

    $alert = "";

    if (isset($_GET['msg'])) {
        $alert = $_GET['msg'];
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

    <title>Part Master</title>

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
                    <div class="card shadow mb-4 clearfix">
                        <?php 
                            if ($alert == "Records successfully Inserted") {
                               echo '<div class="alert alert-success" role="alert">
                                        Record successfully Inserted
                                    </div>';
                            } elseif ($alert == "Final Records successfully Inserted") {
                                echo'<div class="alert alert-success" role="alert">
                                        Record successfully Insterted
                                    </div>';
                            } elseif ($alert == "Records successfully updated") {
                                echo '<div class="alert alert-success" role="alert">
                                        Record Successfully Updated
                                    </div>';
                            } elseif ($alert == "Record successfully deleted") {
                                echo '<div class="alert alert-success" role="alert">
                                        Record Successfully Deleted
                                    </div>';
                            }
                        ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Part Master</h6>
                            <a class="float-right font-weight-bold mylink" href="pm1-reg.php">
                                <i class="fa fa-plus"></i>
                                Add Part
                            </a>                 
                        </div>
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="form-group float-right">
                                    <input type="text" name="search_text" id="search_text" placeholder="Search..." class="form-control" />
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Part Name</th>
                                            <th>Part No.</th>
                                            <th>Category</th>
                                            <th>Subpart</th>
                                            <th>Measurement Unit</th>
                                            <th>Is Active?</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Part Name</th>
                                            <th>Part No.</th>
                                            <th>Category</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody id="result">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="card-footer">
                            <?php
                                $query = "SELECT max(`part_updated_time`) as uptime,`part_updated_by`,`usr_name` FROM `part_master_one` LEFT JOIN `user_master` ON part_master_one.part_updated_by = user_master.usr_id ORDER BY `part_id` DESC LIMIT 1";

                                $result = mysqli_query($conn,$query);
                            
                                // echo mysqli_error($conn);
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)){
                                        $updated_time = date('j M Y g:i A', strtotime($row['uptime']));
                                        $updated_by = $row['usr_name'];

                                        echo "Last Updated on ".$updated_time." By ".$updated_by;
                                    }
                                }
                            ?>
                        </div> -->
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

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function(){

         load_data();

         function load_data(query)
         {
          $.ajax({
           url:"fetch-pm1.php",
           method:"POST",
           data:{query:query},
           success:function(data)
           {
            $('#result').html(data);
           }
          });
         }
         $('#search_text').keyup(function(){
          var search = $(this).val();
          if(search != '')
          {
           load_data(search);
          }
          else
          {
           load_data();
          }
         });
        });

        $('table').dataTable({searching: false, paging: false, info: false});
    </script>

</body>

</html>
<?php 
    include ('disconnect.php');
?>