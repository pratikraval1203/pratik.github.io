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
        $append = "WHERE part_master_three.part_id = '$last_id' ";
    } else {
        $append = "";
    }

    if (isset($_POST['submit'])) {

        $last_id = $_POST['part_sel_id'];

        $pm3_id = $_POST['pm3_id'];
        $part_three_id = $_POST['part_sel_id'];
        $op_stock = $_POST['part_op_stock'];
        $storage_location = $_POST['part_storage_location'];
        $updated_time = date('Y-m-d H:i:s');

        $sql = "UPDATE `part_master_three` SET `part_id`='$part_three_id',`part_op_stock`='$op_stock',`part_storage_location`='$storage_location',`part_updated_time`='$updated_time' WHERE `pm3_id` = '$pm3_id'";

        if(mysqli_query($conn , $sql)) {
            $alert = "Records successfully updated";
            // echo "<script language='javascript' type='text/javascript'>window.location = 'part-master3.php?msg=".$alert."'</script>";
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

    <title>Edit Part Opening Stock Details</title>

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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Opening Stock</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master3.php">
                                <i class="fa fa-eye"></i>
                                View Part Opening Stock List
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                            <?php
                                    
                                $query = "SELECT part_master_three.part_id, `pm3_id`, `part_op_stock`, `part_storage_location`, part_master_one.part_id, part_master_one.part_desc FROM `part_master_three` LEFT JOIN `part_master_one` ON part_master_three.part_id = part_master_one.part_id WHERE pm3_id = '$edit_id'";

                                $result1 = mysqli_query($conn,$query);

                                while($row = mysqli_fetch_array($result1)) {
                                    $pm3_id = $row['pm3_id'];
                                    $id = $row['part_id'];
                                    $desc = $row['part_desc'];
                                    $op_stock = $row['part_op_stock'];
                                    $storage_location = $row['part_storage_location'];
                                }
                            ?>
                            <div class="form-group mb-3 ml-3 mt-3">
                                <label for="part_sel_id" class="form-label">Part:</label>
                                <!-- <select onchange="self.location=self.location+'?idx='+this.selectedIndex"> -->
                                <select id="part_sel_id" name="part_sel_id" class="mydrpdwn col-md-6 form-control">
                                        <option value="<?php echo $id; ?>">
                                            <?php echo $desc; ?>
                                                
                                        </option>
                                            
                                       <!--  <?php

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
                                        ?> -->
                                </select>
                            </div>
                            <div class="apsection">
                                <div class="form-group mb-3">
                                    <input class="form-control" required="required" type="hidden" id="text-input" name="pm3_id" value="<?= $pm3_id ?>">
                                </div>
                                <div class="form-group mb-3 half">
                                    <label class="form-label" for="text-input">Opening Stock</label>
                                    <input class="form-control" required="required" type="number" id="text-input" name="part_op_stock" value="<?= $op_stock ?>">
                                </div>
                                <div class="form-group mb-3 half">
                                    <label class="form-label" for="text-input">Storage Location</label>
                                    <input class="form-control" required="required" type="text" id="text-input" name="part_storage_location" list="storage"  value="<?= $storage_location ?>" />
                                    <datalist id="storage">
                                        <?php
                                            $query = "SELECT DISTINCT `part_storage_location` FROM `part_master_three`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $part_storage_location = $row['part_storage_location'];
                                            ?>
                                                <option><?php echo $part_storage_location; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </datalist>
                                    <span id="stlloc"></span>
                                </div>
                            </div>
                            <div class="form-group mb-3 quater">
                                <input id="pm3_submit" class="btn btn-success" type="submit" name="submit" value="Change"></input>
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

            //for Storage Location
        var stl = document.myform.part_storage_location.value;
        var l= stl.length;
        var statusmsc = "";
        var statuslsn = "";
        var statuswsn = "";
        var statushsn = "";

        if (l != 7) {
            status = "storage code must be of 7 digit";
            document.getElementById('stlloc').innerHTML = status;
            return false;
        } else {

            var msc = stl[0]+stl[1];
            var lsn = stl[2]+stl[3];
            var wsn = stl[4];
            var hsn = stl[5]+stl[6];

            for(i = 1 ; i < 100 ; i++) {
                if (msc == i) {
                    statusmsc = 1;
                    // document.write(i);
                    break;
                } 
                else {
                    statusmsc = "Main Storage Code not set";
                }   
            }

            for(i = 1 ; i < 100 ; i++) {
                if (lsn == i) {
                    statuslsn = 1;
                    // document.write(statuslsn);
                    break;
                } 
                else {
                    statuslsn = "Length Scale Number not set";
                }   
            }

            for(i = 65 ; i < 90 ; i++) {
                var charCode = String.fromCharCode(i);
                if (wsn == charCode) {
                    statuswsn = 1;
                    // document.write(String.fromCharCode(i));
                    break;
                } 
                else {
                    for( j = 90 ; j < 122 ; j++) {
                        var charCode2 = String.fromCharCode(j);
                        if (wsn == charCode2) {
                            statuswsn = "Width Scale Number Must Be in Capital";
                            // document.write(String.fromCharCode(i));
                            break;
                        }
                        else {
                            statuswsn = "Width Scale Number not set";
                        }
                    }
                }   
            }

            for(i = 1 ; i < 100 ; i++) {
                if (hsn == i) {
                    statushsn = 1;
                    // document.write(i);
                    break;
                } 
                else {
                    statushsn = "Height Scale Number not set";
                }   
            }

            if ( statusmsc == 1) {
                // document.write(statuslsn);
                if (statuslsn == 1) {

                    if (statuswsn == 1) {
                        if (statushsn == 1) {
                            // document.write("hello");
                            document.getElementById("stlloc").innerHTML= "";
                        }
                        else {
                            // document.write("hello");
                            document.getElementById("stlloc").innerHTML= statushsn;
                            return false;
                        }
                    }
                    else {
                        // document.write("hello");
                        document.getElementById("stlloc").innerHTML= statuswsn;
                        return false;
                    }
                }
                else {
                    // document.write("hello");
                    document.getElementById("stlloc").innerHTML= statuslsn;
                    return false;
                }
            }
            else {
                // document.write("hello");
                document.getElementById("stlloc").innerHTML= statusmsc;
                return false;
            }
        }


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