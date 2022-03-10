<?php 
  session_start();

  include ('connection.php');

  $alert = "";
  $last_id = "";

  if (isset($_GET['msg'])) {
    $alert = $_GET['msg'];
   }

    if (isset($_POST['tm_sel_id'])) {
        // echo "string";
        $last_id = $_POST['tm_sel_id'];
        // echo $last_id;
        $append = "WHERE tmmt.tm_id = '$last_id' ";
    } else {
        $append = "WHERE tmmt.tm_id = 'none' ";
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

    <title>Track Machine Detail Entry</title>

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
                        <?php 
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Track Machine Detail Entry</h6>
                            <a class="float-right font-weight-bold mylink" href="tm2-reg.php">
                                <i class="fa fa-plus"></i>
                                Add Track Machine Details
                            </a>                 
                        </div>
                        <div class="card-body">
                            <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                                <div class="row mt-3">
                                    <div class="form-group col-md-4">
                                        <label for="tm_sel_id">Track Machine:</label>
                                        <select id="tm_sel_id" name="tm_sel_id" class="form-control mydrpdwn" onchange="this.form.submit()" data-show-subtext="true" data-live-search="true">
                                            <?php

                                                if ($last_id == "") {
                                                    $last_name = "Track Machine";
                                                    $type = "";
                                                    $brand = "";
                                                } else {
                                                    $query = "SELECT `tm_id`,`tm_brand`,`tm_type`,`tm_model_no` FROM `track_machine_master_one` WHERE tm_id = '$last_id'";

                                                    $result1 = mysqli_query($conn,$query);

                                                    while($row = mysqli_fetch_array($result1)) {
                                                        $id = $row['tm_id'];

                                                        $type = $row['tm_type'];
                                                        if ($last_id == $id) {
                                                            $last_name = $type;
                                                        }
                                                    }
                                                }
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $type; ?></option>
                                            <?php 
                                                $query = "SELECT `tm_id`,`tm_brand`,`tm_type`,`tm_model_no` FROM `track_machine_master_one` ORDER BY `tm_model_no`";
                                                $result = mysqli_query($conn,$query);
                                            
                                                // echo mysqli_error($conn);

                                                // print_r($row);
                             
                                                while($row = mysqli_fetch_array($result) ){
                                                $id = $row['tm_id'];
                                                $type = $row['tm_type'];
                                                    // foreach ($row as $i) {  
                                            ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $type; ?></option>
                                            <?php
                                                    // }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <hr>
                           <!--  <div class="clearfix">
                                <div class="form-group float-right">
                                    <input type="text" name="search_text" id="search_text" placeholder="Search..." class="form-control" />
                                </div>
                            </div> -->
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Track Machine</th>
                                            <th>Part</th>
                                            <th>Catagory</th>
                                            <th>Part Description</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = "SELECT * FROM track_machine_master_two tmmt, part_master_one pmo, track_machine_master_one tmmo ".$append." && pmo.part_id = tmmt.part_id and tmmt.tm_id = tmmo.tm_id ORDER BY `tm2_id` DESC";

                                        // echo $query;
                                      $result = mysqli_query($conn, $query);
                                      $count = 0;

                                      if(mysqli_num_rows($result) > 0)
                                      {
                                       
                                       while($row = mysqli_fetch_array($result))
                                       {
                                        $count = $count + 1;
                                        echo '
                                         <tr>
                                          <td>'.$count.'</td>
                                          <td>'.$row['tm_type'].'</td>
                                          <td>'.$row['part_number'].'-'.$row["part_desc"].'</td>
                                          <td>'.$row["tm_catagory"].'</td>
                                          <td>'.$row["tm_part_desc"].'</td>
                                          <td>
                                            <a class="btn btn-info" href="edit-tm2.php?edit_id='.$row['tm2_id'].'">Edit</a>
                                          </td>
                                          <td>
                                            <a class="btn btn-danger" href="del-tm2.php?delete_id='.$row['tm2_id'].'&table=main">Delete</a>
                                          </td>
                                         </tr>
                                        ';
                                       }
                                       // echo $output;
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

    <script>
        $(document).ready(function(){

         load_data();

         function load_data(query)
         {
          $.ajax({
           url:"fetch-tm2.php",
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