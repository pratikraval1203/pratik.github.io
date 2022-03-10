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
        $append = "WHERE part_master_six.part_id = '$last_id' ";
    } else {
        $append = "";
    }
    $action = $_SERVER['PHP_SELF']."?change_id=".$last_id;

    if (isset($_POST['final_submit'])) {

        $final_id = $_POST['final_id'];
        $final_part_amb = $_POST['final_part_amb'];
        $updated_time = date('Y-m-d H:i:s');

        $count1 = count($_POST['final_id']);

        for ($i= 0 ; $i < $count1 ; $i++) {
            $final_sql = "INSERT INTO `part_master_six` (`part_id`, `part_amb`, `part_updated_time`,`part_updated_by`) VALUES ('{$final_id[$i]}','{$final_part_amb[$i]}','$updated_time','')";

            if (mysqli_error($conn)) {
                $msg = mysqli_error($conn);
                echo "<script type='text/Javascript'>alert('$msg')</script>";
             } 

            if(mysqli_query($conn , $final_sql)) {
                    $alert = "Final Records successfully Inserted";
                } 
        }
        $final_sql2 = "TRUNCATE TABLE  `part_master_six_ex`"; 

            if(mysqli_query($conn , $final_sql2)) {
                // echo "Final Records successfully Deleted";
            }

    }
    elseif (isset($_POST['submit'])) {
    

        $last_id = $_POST['part_sel_id'];

        $part_six_id = $_POST['part_sel_id'];
        $part_amb = $_POST['part_amb'];
        $updated_time = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `part_master_six_ex`(`part_id`, `part_amb`, `part_updated_time`, `part_updated_by`) VALUES ('$part_six_id','$part_amb','$updated_time','')";

        if(mysqli_query($conn , $sql)) {
            $alert = "Records successfully Inserted";
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

    <title>Add Part Master 6</title>

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

        label {
            display: revert;
            margin-bottom: 50px;
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add PM6</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master6.php">
                                <i class="fa fa-eye"></i>
                                View Part Master 6 List
                            </a>                 
                        </div>
                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $action; ?>" method="post" onsubmit="return validate()">
                            <div class="form-group mb-3 ml-3 mt-3">
                                
                            </div>
                            <div class="apsection">
                                <div class="form-group mb-3 half">
                                    <label for="part_sel_id" class="form-label">Select Part:</label>
                                    <select id="part_sel_id" class="mydrpdwn form-control" name="part_sel_id" onchange="self.location= 'pm6-reg.php?change_id='+this.selectedIndex" required="required">
                                    <?php

                                        if ($last_id == "") {
                                            $last_name = "Select Part";
                                        } else {
                                            $query = "SELECT `part_id`,`part_desc` FROM `part_master_one` WHERE part_id = '$last_id'";

                                            $result1 = mysqli_query($conn,$query);

                                            while($row = mysqli_fetch_array($result1)) {
                                                $id = $row['part_id'];
                                                $desc = $row['part_desc'];
                                                if ($last_id == $id) {
                                                    $last_name = $desc;
                                                }
                                            }
                                        }
                                    ?>
                                        <option value="<?php echo $id; ?>"><?php echo $last_name; ?></option>
                                    <?php

                                        $query = "SELECT `part_id`,`part_desc` FROM `part_master_one`";

                                        $result = mysqli_query($conn,$query);
                                    
                                        echo mysqli_error($conn);

                                        while($row = mysqli_fetch_array($result)){
                                            $id = $row['part_id'];
                                            $desc = $row['part_desc'];
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $desc; ?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                                </div>
                                <div class="form-group mb-3 half">
                                    <label class="form-label" for="text-input">Acceptable Make Brand</label>
                                    <input class="form-control" required="required" type="text" id="text-input" name="part_amb" required="required">
                                </div>
                            </div>
                            <div class="form-group mb-3 quater">
                                <input id="amb_submit" class="btn btn-success" type="submit" name="submit" value="Add More"></input>
                            </div>
                            <div class="clear"></div>
                        </form>
                    </div>
                    <!-- /.card mb-4 shadow -->

                    <div class="card mb-4 shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Added Brands</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="part-master3.php">
                                <i class="fa fa-eye"></i>
                                View Part Master 3 List
                            </a>   -->               
                        </div>
                        <!-- <caption>Temp Database Data</caption> -->
                        <form id="part_master32" class="bootstrap-form-with-validation" action="<?php $action ?>" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr style='background: whitesmoke;'>
                                        <!-- <th>Part ID</th> -->
                                        <th>Part Name</th>
                                        <th>Acceptable Make Brand</th>
                                        <!-- <th>Edit</th> -->
                                        <th>Delete</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    $sql = "SELECT part_master_six_ex.part_id, `amb_id`, `part_amb`, part_master_one.part_id, part_master_one.part_desc FROM `part_master_six_ex` LEFT JOIN `part_master_one` ON part_master_six_ex.part_id = part_master_one.part_id";

                                    $result = mysqli_query($conn,$sql);

                                    while($row = mysqli_fetch_array($result) ){
                                        $amb_id = $row['amb_id'];
                                        $part_id = $row['part_id'];
                                        $part_desc = $row['part_desc'];
                                        $part_amb = $row['part_amb'];
                                    ?>
                                        <tr>
                                            <td>
                                                <!-- <input type='checkbox' name='update[]' value='<?= $part_id ?>'> -->
                                                <input type="hidden" name="final_id[]" value="<?= $part_id ?>">
                                                <input type="hidden" name="amb_id[]" value="<?= $amb_id ?>">
                                                <input type='text' name='final_desc[]>' value='<?= $part_desc ?>' readonly>
                                            </td>
                                            <td><input type='text' name='final_part_amb[]' value='<?= $part_amb ?>' readonly>
                                            </td>
                                            <td>
                                                <?php
                                                    echo "<a class='btn btn-danger' href='del-pm6.php?delete_id=".$amb_id."&change_id=".$part_id."&table=temp'>Delete</a>";
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

                    <div class="card mb-4 shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Brands of Currently Selected Part</h6>               
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>Part ID</th> -->
                                            <th>Part Name</th>
                                            <th>Acceptable Make Brand</th>
                                           <!-- <th>Edit</th>
                                            <th>Delete</th>  -->    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        $sql = "SELECT part_master_six.part_id, `amb_id`, `part_amb`, part_master_one.part_id, part_master_one.part_desc FROM `part_master_six` LEFT JOIN `part_master_one` ON part_master_six.part_id = part_master_one.part_id ".$append;

                                        $result = mysqli_query($conn,$sql);

                                        while($row = mysqli_fetch_array($result) ){
                                            $amb_id = $row['amb_id'];
                                            $part_id = $row['part_id'];
                                            $part_desc = $row['part_desc'];
                                            $part_amb = $row['part_amb'];
                                        ?>
                                            <tr>
                                                <td><?php echo $part_desc; ?></td>
                                                <td><?php echo $part_amb; ?></td>
                                            </tr>
                                        <?php
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