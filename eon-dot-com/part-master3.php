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

    if (isset($_POST['part_sel_id'])) {
        // echo "string";
        $last_id = $_POST['part_sel_id'];
        // echo $last_id;
        $append = "WHERE part_master_three.part_id = '$last_id'";
    } else {
        $append = "WHERE part_master_three.part_id = 'none'";
    }

    // if (isset($_GET['change_id'])) {
    //     $last_id = $_GET['change_id'];
    //     // echo $last_id;
    //     $append = "WHERE part_master_three.part_id = '$last_id' ";
    // } else {
    //     $append = "WHERE part_master_three.part_id = 'none' ";
    // }
    // $action = $_SERVER['PHP_SELF']."?change_id=".$last_id;    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Part Opening Stock Entry</title>

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

    <style type="text/css">
        .half {
            width: 40%;
            float: left;
            padding: 2%;
            /*border : black solid 1px;*/
        }
        .quater {
            width: 20%;
            float: left;
            padding: 5%;
        }
        #part_master3 , #part_master32 {
            /*border : solid 1px black;*/
        }
        .clear {
            width: auto;
            clear: both;
        }

        input {
            border: 0;
        }
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
                    <div class="card mb-4 shadow">
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Part Opening Stock Entry</h6>
                            <a class="float-right font-weight-bold mylink" href="pm3-reg.php">
                                <i class="fa fa-plus"></i>
                                Add Opening Stock
                            </a>                 
                        </div>
                        <div class="card-body">
                            <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
<!--                                 <div class="row mt-3"> -->
                                    <div class="form-group mb-3 mt-3">
                                        <!-- <label for="part_sel_id" class="form-label">Select Part:</label> -->
                                        <select id="part_sel_id" class="mydrpdwn col-md-3 form-control" name="part_sel_id" required="required" onchange="this.form.submit()">
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
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $id = $row['part_id'];
                                                    $number = $row['part_number'];
                                                    $desc = $row['part_desc'];
                                                ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $number."-".$desc; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                <!-- </div> -->
                            </form>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Part Name</th>
                                            <th>Opening Stock</th>
                                            <th>Storage Location</th>
                                            <th>Edit</th>
                                            <th>Delete</th>      
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Part Name</th>
                                            <th>OP Stock</th>
                                            <th>Storage code</th>
                                            <th>Edit</th>
                                            <th>Delete</th>      
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
<?php

    $query = "SELECT * FROM `part_master_three` LEFT JOIN `part_master_one` ON part_master_three.part_id = part_master_one.part_id ".$append." ORDER BY `pm3_id` DESC";

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
      <td>'.$row['part_number']."-".$row['part_desc'].'</td>
      <td>'.$row["part_op_stock"].'</td>
      <td>'.$row["part_storage_location"].'</td>
      <td>
        <a class="btn btn-info" href="edit-pm3.php?edit_id='.$row['pm3_id'].'">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="del-pm3.php?delete_id='.$row['pm3_id'].'&table=main">Delete</a>
      </td>
     </tr>
    ';
   }
  }
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

    <script>
        $(document).ready(function(){

         load_data();

         function load_data(query)
         {
          $.ajax({
           url:"fetch-pm3.php",
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

        $('table').dataTable({searching: true, paging: false, info: false});
    </script>

</body>

</html>
<?php 
    include ('disconnect.php');
?>