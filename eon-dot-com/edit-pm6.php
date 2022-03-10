<?php
    session_start();

    include('connection.php');

    $alert = "";
    $last_id = "";
    $last_name = "";
    $append = "";
    $edit_id = "";

    $edit_id = $_GET['edit_id'];

    if (isset($_GET['change_id'])) {
        $last_id = $_GET['change_id'];
        // echo $last_id;
        $append = "WHERE part_master_six.part_id = '$last_id' ";
    } else {
        $append = "";
    }

    if (isset($_POST['submit'])) {

        $last_id = $_POST['part_sel_id'];

        $amb_id = $_POST['amb_id'];
        $part_six_id = $_POST['part_sel_id'];
        $part_amb = $_POST['part_amb'];
        $updated_time = date('Y-m-d H:i:s');

        $sql = "UPDATE `part_master_six` SET `part_id`='$part_six_id',`part_amb`='$part_amb',`part_updated_time`='$updated_time' WHERE `amb_id` = '$amb_id'";

        if(mysqli_query($conn , $sql)) {
            $alert = "Records successfully updated";
            // echo "<script language='java script' type='text/javascript'>window.location = 'part-master6.php?msg=".$alert."'</script>";
        } 
        else {
            $alert = mysqli_error($conn);
            // echo $alert;
        }
        // mysqli_close($conn);
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

    <title>Edit Part Brand Details</title>

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
                        } elseif ($alert == "Records successfully deleted") {
                            echo '<div class="alert alert-success" role="alert">
                                    Record Successfully Deleted
                                </div>';
                        }
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Part Brand Details</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master6.php">
                                <i class="fa fa-eye"></i>
                                View Part Brand Details List
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                            <?php
                                    
                                $query = "SELECT part_master_six.part_id, `amb_id`, `part_amb`, part_master_one.part_id, part_master_one.part_desc FROM `part_master_six` LEFT JOIN `part_master_one` ON part_master_six.part_id = part_master_one.part_id WHERE amb_id = '$edit_id'";

                                $result1 = mysqli_query($conn,$query);

                                while($row = mysqli_fetch_array($result1)) {
                                    $amb_id = $row['amb_id'];
                                    $id = $row['part_id'];
                                    $desc = $row['part_desc'];
                                    $part_amb = $row['part_amb'];
                                }
                            ?>
                            <div class="form-group mb-3 ml-3 mt-3">
                            </div>
                            <div class="apsection">
                                <div class="form-group mb-3">
                                    <input class="form-control" required="required" type="hidden" id="text-input" name="amb_id" value="<?= $amb_id ?>">
                                </div>
                                <div class="form-group mb-3 half">
                                    <label for="part_sel_id" class="form-label">Part:</label>
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
                                <div class="form-group mb-3 half">
                                    <label class="form-label" for="text-input">Acceptable Make Brand</label>
                                    <input class="form-control" required="required" type="text" id="text-input" name="part_amb" required="required" value="<?= $part_amb ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3 quater">
                                <input id="amb_submit" class="btn btn-success" type="submit" name="submit" value="Change"></input>
                            </div>
                            <div class="clear"></div>
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