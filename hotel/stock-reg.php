<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if(isset($_POST['submit'])) {

    $stock_company_name = $_POST['stock_company_name'];
    $stock_bill_no = $_POST['stock_bill_no'];
    $stock_date = $_POST['stock_date'];
    $stock_barcode_no = $_POST['stock_barcode_no'];
    $stock_item_type = $_POST['stock_item_type'];
    $stock_item_name = $_POST['stock_item_name'];
    $stock_qty = $_POST['stock_qty'];
    $stock_unit = $_POST['stock_unit'];
    $updated_time = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['user_id'];

    $insert_sql = "INSERT INTO `stock_master`(`stock_company_name`, `stock_bill_no`, `stock_date`, `stock_barcode_no`, `stock_item_type`, `stock_item_name`, `stock_qty`, `stock_unit`, `updated_time`, `updated_by`) VALUES  ('$stock_company_name','$stock_bill_no','$stock_date','$stock_barcode_no','$stock_item_type','$stock_item_name','$stock_qty','$stock_unit','$updated_time', '$updated_by')";

    if(mysqli_query($conn , $insert_sql)) {
        $alert = "Stock Added Successfully";
    }
    else {
        $alert = mysqli_error($conn);
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

    <title>Add Stock Entry</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
          include('sidebar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                  include('topbar.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add Stock Entry</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.
                    </p> -->

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <?php 
                            if ($alert != "") {
                        ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Stock Entry</h6>
                            <a class="float-right font-weight-bold mylink" href="stock-master.php">
                                <i class="fa fa-eye"></i>
                                View Stock Entry List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Stock Entry</h6>
                            <a class="float-right font-weight-bold mylink" href="stock-master.php">
                                <i class="fa fa-eye"></i>
                                View Stock Entry List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <div class="card-body p-3">
                            <!-- <div class="text-center mt-5">
                                <h1 class="h4 text-gray-900 mb-4">Add New Customer</h1>
                            </div> -->
                            <form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit ="return validate()" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_company_name">Company Name<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="stock_company_name" name="stock_company_name" placeholder="Company Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_bill_no">Bill No.<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="stock_bill_no" name="stock_bill_no" placeholder="Bill No." required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_date">Bill Date</label>
                                            <input type="date" class="form-control" id="stock_date" name="stock_date" placeholder="Bill Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_barcode_no">Bill Barcode No.</label>
                                            <input type="text" class="form-control" id="stock_barcode_no" name="stock_barcode_no" placeholder="Bill Barcode No.">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_item_type">Item Type<span class="star">*</span></label>
                                            <select class="form-control mydrpdwn" name="stock_item_type" placeholder="Item Type" required="" id="stock_item_type">
                                                <option selected="" disabled=""></option>
                                                <option value="0">Raw Matirial</option>
                                                <option value="1">Item Menu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_item_name ">Item Name<span class="star">*</span></label>
                                            <select class="form-control mydrpdwn" name="stock_item_name" id="stock_item_name" placeholder="Select Item" required="">
                                                <!-- <?php 

                                                  $sql = "SELECT `item_id`,`item_name` FROM `item_master` WHERE `item_id` = '$item_id'";
                                                  $result = mysqli_query($conn, $sql);

                                                  
                                                  while($row = mysqli_fetch_array($result)) {
                                                  echo "<option value='".$row['item_id']."'>".$row['item_name']."</option>";
                                                  }
                                                ?> -->    
                                                <?php 
                                                    $query_dept = "SELECT * FROM `item_master` ORDER BY `item_name`";    
                                                    $result_dept = mysqli_query($conn, $query_dept);


                                                    while ($data_dept = mysqli_fetch_assoc($result_dept)) {
                                                        $dept_id = $data_dept['item_id'];
                                                        $dept_name = $data_dept['item_name'];
                                                ?>
                                                    <option value="<?php echo $dept_id; ?>"><?php echo $dept_name; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="text" id="stock" class="form-control" name="stock" placeholder="Stock" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_qty">Item Qty</label>
                                            <input type="number" class="form-control" id="stock_qty" name="stock_qty" placeholder="Item Qty">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_unit">Stock Unit</label>
                                            <input type="text" class="form-control" id="stock_unit" name="stock_unit" placeholder="Stock Unit">
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="Add Stock">
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                include('footer.php');
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
        include('logout-model.php');
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="js/myjs.js"></script>
    
    <script type="text/javascript">
        $('#stock_item_type').on('change', function (e) {
            var valueSelected = this.value;
            // alert('Miricle...')

            load_data1(valueSelected);

            function load_data1(query)
           {
                $.ajax({
                 url:"fetch-item-by-type.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#stock_item_name').html(data);
                 }
                });
               }
        });

        $('#stock_item_name').on('change', function (e) {
            var valueSelected = this.value;
            // alert(valueSelected);

            load_stock(valueSelected);

            function load_stock(query)
           {
                $.ajax({
                 url:"fetch-item-stock.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#stock').val(data);
                 }
                });
               }
        });

        function validate(){
            
        // for mobile number
        var num=document.myform.cust_mobile.value;
        if (isNaN(num)){
          document.getElementById("").innerHTML="Please Enter Numeric value only";
          return false;
          var phoneno = /^\d{10}$/;
          if(!num.match(phoneno))
          {
             document.getElementById("numloc").innerHTML="Not a valid Phone Number";
            return false;
          }
          else {
            document.getElementById("numloc").innerHTML="";
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
            document.getElementById("numloc").innerHTML="";
          }
        }
      }
    </script>
</body>
</html>
<?php
 include('disconnect.php');
?>