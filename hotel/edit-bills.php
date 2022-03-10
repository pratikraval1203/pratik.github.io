    <?php
  
    session_start();
    date_default_timezone_set("Asia/Kolkata");
    $alert = "";

    include('connection.php');

    if (isset($_GET['edit_id'])) {
    $bill_id = $_GET['edit_id'];
    }

    // $update_bill_status = "UPDATE `tbl_bills` SET `bill_status`= '0' WHERE `bill_id` = '$bill_id'";

    // mysqli_query($conn, $update_bill_status);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Billing Screen</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="select2.min.css">
    <style type="text/css">
        #numloc {
          color: red !important;
        }
        tr,td,th {
            padding-top: 0 !important;
            padding-bottom : 0 !important;
        }
        /*table {
            table-layout: fixed;
        }*/
        .table-wrapper {
            height: 300px !important; 
            overflow-y: auto;
        }
        .mybtn {
            padding: 5% !important;
        }
        .black-link {
            color: #858796;
        }
  </style>
</head>

<body id="page-top" onload="load_body()">

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
                  // include('topbar.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Billing Screen</h1> -->
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.
                    </p> -->

                    <div class="card o-hidden border-0 shadow-lg my-3">
                        <?php 
                            if ($alert != "") {
                        ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Billing Screen</h6>
                            <a class="float-right font-weight-bold mylink">
                                <i class="fa fa-clock"></i>
                                <span id="ct5"></span>
                            </a>             
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Billing Screen</h6>
                            <a class="float-right font-weight-bold mylink">
                                <i class="fa fa-clock"></i>
                                <span id="ct5"></span>
                            </a>            
                        </div>
                      <?php
                      }
                      ?>
                        <div class="card-body p-3">
                            <!-- <div class="text-center mt-5">
                                <h1 class="h4 text-gray-900 mb-4">Add New Customer</h1>
                            </div> -->
                            <form name="myform" id="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit ="return validate()" autocomplete="off">
                            <?php
                                $select_sql = "SELECT * FROM `tbl_bills` WHERE `bill_id` = '$bill_id'";

                                $result = mysqli_query($conn, $select_sql);

                                while ($data_bills = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="bill_no" class="text-primary">Bill No:</label>
                                            <input type="text" class="form-control" id="bill_no" name="bill_no" value="<?php echo $bill_id; ?>" required="" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="table_no" class="text-primary">Table No.<span class="star">*</span></label>
                                            <select class="form-control mydrpdwn" id="table_no" name="table_no" required="">
                                                <?php
                                                    $table_id = $data_bills['table_no'];

                                                    $select_table = "SELECT `table_id`,`table_no` FROM `new_table_master` WHERE `table_id` = '$table_id'";

                                                    $result_table = mysqli_query($conn, $select_table);

                                                    while ($row = mysqli_fetch_array($result_table)) {
                                                        $table_id = $row['table_id'];
                                                        $table_no = $row['table_no'];
                                                ?>
                                                        <option value="<?php echo $table_id; ?>"><?php echo $table_no; ?></option>
                                                <?php
                                                    }
                                                ?>
                                                <?php
                                                    $select_table = "SELECT `table_id`,`table_no` FROM `new_table_master` ORDER BY `table_no`";

                                                    $result_table = mysqli_query($conn, $select_table);

                                                    while ($row = mysqli_fetch_array($result_table)) {
                                                        $table_id = $row['table_id'];
                                                        $table_no = $row['table_no'];
                                                ?>
                                                        <option value="<?php echo $table_id; ?>"><?php echo $table_no; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                           <!--  <input type="number" class="form-control" id="table_no" name="table_no" placeholder="Table No." required=""> -->
                                            <!-- <span id="numloc"></span> -->
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="total_person" class="text-primary">Total Person</label>
                                            <input type="number" class="form-control" id="total_person" name="total_person" placeholder="Total Person" value="<?php echo $data_bills['total_person']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cust_name" class="text-primary">Customer Name</label>
                                            <select class="form-control mydrpdwn" id="cust_name" name="cust_name">
                                                <?php
                                                    $cust_id = $data_bills['cust_id'];

                                                    if ($cust_id == 0) {
                                                ?>
                                                    <option selected="" value="0">Select Customer</option>
                                                <?php
                                                    } else {

                                                        $select_cust = "SELECT `cust_id`,`cust_name` FROM `customer_master` WHERE `cust_id` = '$cust_id'";

                                                        $result_cust = mysqli_query($conn, $select_cust);

                                                        while ($row = mysqli_fetch_array($result_cust)) {
                                                            $cust_id = $row['cust_id'];
                                                            $cust_name = $row['cust_name'];
                                                ?>
                                                        <option value="<?php echo $cust_id; ?>"><?php echo $cust_name; ?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                                <?php
                                                    $select_cust = "SELECT `cust_id`,`cust_name` FROM `customer_master` ORDER BY `cust_name`";

                                                    $result_cust = mysqli_query($conn, $select_cust);

                                                    while ($row = mysqli_fetch_array($result_cust)) {
                                                        $cust_id = $row['cust_id'];
                                                        $cust_name = $row['cust_name'];
                                                ?>
                                                        <option value="<?php echo $cust_id; ?>"><?php echo $cust_name; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php 
                                                $cust_id = $data_bills['cust_id'];

                                                if ($cust_id == 0) {
                                                ?>
                                                    <label for="cust_gst_no" class="text-primary">Customer GST No.</label>
                                                    <input type="text" class="form-control" id="cust_gst_no" name="cust_gst_no" placeholder="Customer GST No." readonly="">
                                                <?php
                                                    } else {

                                                    $select_cust = "SELECT `cust_gst_no` FROM `customer_master` WHERE `cust_id` = '$cust_id'";

                                                    $result_cust = mysqli_query($conn, $select_cust);

                                                    while ($row = mysqli_fetch_array($result_cust)) {
                                                            $cust_gst_no = $row['cust_gst_no'];
                                            ?>
                                            <label for="cust_gst_no" class="text-primary">Customer GST No.</label>
                                            <input type="text" class="form-control" id="cust_gst_no" name="cust_gst_no" placeholder="Customer GST No." readonly="" value="<?php echo $cust_gst_no; ?>">
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mx-1">
                                    <!-- <div class="col-md-2 border">
                                        <div class="navbar">Sidebar 1</div>
                                    </div> -->
                                    <div class="col-md-10 border">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="item_sel_id">Item Code / Item Name</label>
                                                    <select class="form-control mydrpdwn" id="item_sel_id" name="item_sel_id">
                                                        <option selected="" value="0">Select Item</option>
                                                        <?php
                                                            $select_item = "SELECT `item_id`,`item_code`,`item_name` FROM `item_master` WHERE `item_type` = 1";

                                                            $result_item = mysqli_query($conn, $select_item);

                                                            while ($row = mysqli_fetch_array($result_item)) {
                                                                $item_id = $row['item_id'];
                                                                $item_code = $row['item_code'];
                                                                $item_name = $row['item_name'];
                                                        ?>
                                                                <option value="<?php echo $item_id; ?>"><?php echo $item_code."-".$item_name; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="item_qty">Item Qty</label>
                                                    <input type="number" class="form-control" id="item_qty" name="item_qty" value="1">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="item_rate">Item Rate</label>
                                                    <input type="number" class="form-control" id="item_rate" name="item_rate" value="0" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mt-4">
                                                    <input class="btn btn-info mybtn" type="button" id="item_submit" name="submit" value="Add Item">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="table-responsive table-wrapper">
                                            <table id="DataTable" class="table table-bordered">
                                                <thead>
                                                    <tr style="font-size: 20px;">
                                                        <th>Sr</th>
                                                        <th width="50%">Item Code / Item Name</th>
                                                        <th nowrap="">Qty</th>
                                                        <th nowrap="">Rate</th>
                                                        <th nowrap="">Amount</th>
                                                        <th><i class="far fa-times-circle p-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="result" style="max-height: 200px; overflow-y: hidden;">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-2 border">
                                        <div class="">
                                            <table id="DataTable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Running Table</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="result1" style="max-height: 200px; overflow-y: hidden;">
                                                    <?php
                                                        $select_sql = "SELECT `bill_id`,`table_no`,`grand_total` FROM `tbl_bills` WHERE `bill_status` = 2";

                                      $result = mysqli_query($conn, $select_sql);


                                      while ($data = mysqli_fetch_assoc($result)) {
                                        $table_id =$data['table_no'];

                                        $tbl_sql = "SELECT `table_no` FROM `new_table_master` WHERE `table_id` = '$table_id'";

                                        $tbl_result= mysqli_query($conn, $tbl_sql);


                                        while ($tbl_data = mysqli_fetch_assoc($tbl_result)) {
                                      echo '<tr>';
                                        echo "<td nowrap><a class='black-link' href='edit-bills.php?edit_id=".$data['bill_id']."'>".$tbl_data['table_no']."</a></td>";
                                        echo "<td nowrap>".$data['grand_total']."</td>";
                                      echo '</tr>';
                                            }
                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-1">
                                    <div class="col-md-2 border">
                                        <div class="form-group p-1">
                                            <label for="payment_option">Paymet Option</label>
                                            <br>
                                            <?php
                                                if ($data_bills['payment_type'] == 1) {
                                            ?>
                                                <input type="radio" id="cash" name="payment_option" value="1" checked="">
                                                <label for="cash">Cash</label>
                                                <br>
                                                <input type="radio" id="credit" name="payment_option" value="2">
                                                <label for="credit">Credit</label>
                                                <br>
                                                <input type="radio" id="customer_account" name="payment_option" value="3">
                                                <label for="customer_account">Customer Account</label>
                                            <?php
                                                } elseif ($data_bills['payment_type'] == '2') {
                                            ?>
                                                <input type="radio" id="cash" name="payment_option" value="1">
                                                <label for="cash">Cash</label>
                                                <br>
                                                <input type="radio" id="credit" name="payment_option" value="2" checked="">
                                                <label for="credit">Credit</label>
                                                <br>
                                                <input type="radio" id="customer_account" name="payment_option" value="3">
                                                <label for="customer_account">Customer Account</label>
                                            <?php
                                                } elseif ($data_bills['payment_type'] == '3') {
                                            ?>
                                                <input type="radio" id="cash" name="payment_option" value="1">
                                                <label for="cash">Cash</label>
                                                <br>
                                                <input type="radio" id="credit" name="payment_option" value="2">
                                                <label for="credit">Credit</label>
                                                <br>
                                                <input type="radio" id="customer_account" name="payment_option" value="3" checked="">
                                                <label for="customer_account">Customer Account</label>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sub Total</label>
                                                <input class="form-control" type="text" name="sub_total" id="sub_total" required="" value="0" readonly="">
                                            </div>
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <div class="row ml-1">
                                                    <select class="form-control mydrpdwn col-md-2" id="discount_type" name="discount_type">
                                                    <option value="p">%</option>
                                                    <option value="r" selected="">₹</option>
                                                </select>
                                                <input class="form-control ml-2  col-md-3" type="number" step="any" id="discount_value" name="discount_value" required="" value="<?php echo $data_bills['discount']; ?>">
                                                <input class="form-control ml-2  col-md-3" type="number" step="any" id="discount_value1" name="discount_value1" required="" value="<?php echo $data_bills['discount']; ?>" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <?php
                                                $select_sql = "SELECT * FROM `tax_master` ORDER BY `tax_id` DESC";

                                                $result = mysqli_query($conn, $select_sql);


                                                while ($data = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <div class="form-group col-md-6">
                                                <label>SGST (<?php echo $data['tax_sgst']; ?>%)</label>
                                                <input type="hidden" name="sgst" id="sgst" value="<?php echo $data['tax_sgst']; ?>">
                                                <input type="text" class="form-control" name="bill_sgst" id="bill_sgst" value="0" readonly="" required="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>CGST (<?php echo $data['tax_cgst']; ?>%)</label>
                                                <input type="hidden" name="cgst" id="cgst" value="<?php echo $data['tax_cgst']; ?>">
                                                <input type="text" class="form-control" name="bill_cgst" id="bill_cgst" value="0" readonly="" required="">
                                            </div>
                                            <?php
                                                }
                                            ?>
                                            <div class="form-group col-md-12">
                                                <label>Grand Total</label>
                                                <input class="form-control" type="text" name="grand_total" id="grand_total" readonly="" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row p-2 pt-4">
                                            <div class="m-1">
                                                <input type="submit" id="submit" name="submit" class="btn btn-info" value="Save Bill">
                                            </div>
                                            <!-- <div class="col-md-1">
                                                <input type="button" id="print_bill" name="print_bill" class="btn btn-success" value="Print Bill">
                                            </div> -->
                                            <div class="m-1">
                                                <input type="button" id="kot_bill" name="kot_bill" class="btn btn-info" value="KOT Bill">
                                            </div>
                                           <!--  <div class="col-md-1">
                                                <input type="button" name="kot_print" class="btn btn-success" value="KOT Print">
                                            </div> -->
                                            <div class="m-1">
                                                <a class="btn btn-info" href="bill-master.php">Show Bills</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
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
                // include('footer.php');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="select2.min.js"></script>
    <script>
        $("select").select2( {
            // placeholder: "Select Country"
            // allowClear: true
            } );
    </script>

    <script type="text/javascript"> 
        function display_ct5() {
        var x = new Date()
        var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';

        var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
        x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds() + ":" + ampm;
        document.getElementById('ct5').innerHTML = x1;
        display_c5();
         }
         function display_c5(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct5()',refresh)
        }
        display_c5()
    </script>
    
    <script type="text/javascript">

        function load_body() {
            // alert('loaded');
            var bill_id = $('#bill_no').val();

            load_data(bill_id);

            function load_data()
            {
                $.ajax({
                url:"fetch-bill-items.php",
                method:"POST",
                data:{
                    bill_id:bill_id
                },
                success:function(data1)
                {
                    var dataex = JSON.parse(data1);
                    $('#result').html(dataex.data.output);
                    $('#sub_total').val(dataex.data.final_amount);

                    var sub_total = dataex.data.final_amount;
                    var sgst = $('#sgst').val();
                    var cgst = $('#cgst').val();

                    var discount_value = $('#discount_value1').val();

                    grand_total_ex = sub_total - discount_value;

                    var sgst_percent = (sub_total * sgst) / 100;
                    var cgst_percent = (sub_total * cgst) / 100;

                    $('#bill_sgst').val(sgst_percent);
                    $('#bill_cgst').val(cgst_percent);

                    grand_total = grand_total_ex + sgst_percent + cgst_percent;

                    grand_total = Math.round(grand_total * 100) / 100;

                    $('#grand_total').val(grand_total);


                    }
                });

                $("#bill_no").focus();
            }
        }


        $('#kot_bill').on('click', function (e) {
            var bill_id = $('#bill_no').val();
            var table_no = $('#table_no').val();
            var total_person = $('#total_person').val();
            var cust_id = $('#cust_name').val();
            var sub_total = $('#sub_total').val();
            var discount = $('#discount_value1').val();
            var sgst_amount = $('#bill_sgst').val();
            var cgst_amount = $('#bill_cgst').val();
            var grand_total = $('#grand_total').val();
            var payment_type = $("input[name='payment_option']:checked").val();
            var bill_status = 2;

            if (payment_type == 3 && cust_id == 0) {
                alert('Customer must be selected if you want to use customer account as Payment Method...');
                // return false;
                // e.preventDefault();
                return;
            }

            if (table_no == 0) {
                alert('Please Select Table...');
                // return false;
                // e.preventDefault();
                return;
            }

            // alert(payment_type);

            if(bill_id!="" && table_no!="" && cust_id!="" && sub_total!="" && discount!="" && sgst_amount!="" && cgst_amount!="" && grand_total!="" && payment_type!=""){
                $.ajax({
                    url: "update-bill.php",
                    type: "POST",
                    data: {
                        bill_id: bill_id,
                        table_no : table_no,
                        total_person : total_person,
                        cust_id : cust_id,
                        sub_total : sub_total,
                        discount : discount,
                        sgst_amount : sgst_amount,
                        cgst_amount : cgst_amount,
                        grand_total : grand_total,
                        payment_type : payment_type,  
                        bill_status : bill_status      
                    },
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                           if (payment_type == 3) {
                                $.ajax({
                                    url: "cust-acc-insert.php",
                                    type: "POST",
                                    data: {
                                        bill_id: bill_id,
                                        cust_id : cust_id,
                                        grand_total : grand_total,
                                        is_paid : 0    
                                    },
                                    cache: false,
                                    success: function(dataResult){
                                        var dataResult = JSON.parse(dataResult);
                                        if(dataResult.statusCode==200){
                                           // location.reload();
                                           window.location.replace("billing-screen.php");
                                        }
                                        else if(dataResult.statusCode==201){
                                           alert(dataResult.msg);
                                           alert('fhsdf');
                                        }
                                    }
                                });
                            } else {
                                window.location.replace("billing-screen.php");
                            }
                        }
                        else if(dataResult.statusCode==201){
                           alert(dataResult.msg);
                        }
                    }
                });
            }
            else{
                alert('Please Select Item!');
            }

        });

        $('#myform').on('submit', function (e) {
            var bill_id = $('#bill_no').val();
            var table_no = $('#table_no').val();
            var total_person = $('#total_person').val();
            var cust_id = $('#cust_name').val();
            var sub_total = $('#sub_total').val();
            var discount = $('#discount_value1').val();
            var sgst_amount = $('#bill_sgst').val();
            var cgst_amount = $('#bill_cgst').val();
            var grand_total = $('#grand_total').val();
            var payment_type = $("input[name='payment_option']:checked").val();
            var bill_status = 1;

            if (payment_type == 3 && cust_id == 0) {
                alert('Customer must be selected if you want to use customer account as Payment Method...');
                // return false;
                // e.preventDefault();
                return;
            } 

            if (table_no == 0) {
                alert('Please Select Table...');
                // return false;
                // e.preventDefault();
                return;
            }
            // alert(payment_type);

            if(bill_id!="" && table_no!="" && cust_id!="" && sub_total!="" && discount!="" && sgst_amount!="" && cgst_amount!="" && grand_total!="" && payment_type!=""){
                $.ajax({
                    url: "update-bill.php",
                    type: "POST",
                    data: {
                        bill_id: bill_id,
                        table_no : table_no,
                        total_person : total_person,
                        cust_id : cust_id,
                        sub_total : sub_total,
                        discount : discount,
                        sgst_amount : sgst_amount,
                        cgst_amount : cgst_amount,
                        grand_total : grand_total,
                        payment_type : payment_type,  
                        bill_status : bill_status      
                    },
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            if (payment_type == 3) {
                                $.ajax({
                                    url: "cust-acc-insert.php",
                                    type: "POST",
                                    data: {
                                        bill_id: bill_id,
                                        cust_id : cust_id,
                                        grand_total : grand_total,
                                        is_paid : 0    
                                    },
                                    cache: false,
                                    success: function(dataResult){
                                        var dataResult = JSON.parse(dataResult);
                                        if(dataResult.statusCode==200){
                                           // location.reload();
                                           window.location.replace("billing-screen.php");
                                        }
                                        else if(dataResult.statusCode==201){
                                           alert(dataResult.msg);
                                        }
                                    }
                                });
                            } else {
                                window.location.replace("billing-screen.php");
                            }
                        }
                        else if(dataResult.statusCode==201){
                           alert(dataResult.msg);
                        }
                    }
                });

            }
            else{
                alert('Please Select Item!');
            }

        });


        $('#discount_value').on('focusout', function (e) {
            // document.write('miricle....');
            var discount_value = $('#discount_value').val();
            // alert(discount_value);

            var discount_type = $('#discount_type').val();

            if (discount_type == 'r') {
                // alert(discount_type);   
                var sub_total = $('#sub_total').val();
                var grand_total = 0;

                $('#discount_value1').val(discount_value);

                grand_total_ex = sub_total - discount_value;

                var sgst = $('#sgst').val();
                var cgst = $('#cgst').val();

                var sgst_percent = (grand_total_ex * sgst) / 100;
                var cgst_percent = (grand_total_ex * cgst) / 100;

                $('#bill_sgst').val(sgst_percent);
                $('#bill_cgst').val(cgst_percent);

                grand_total = grand_total_ex + sgst_percent + cgst_percent;

                grand_total = Math.round(grand_total * 100) / 100;

                $('#grand_total').val(grand_total);

            } else if (discount_type == 'p') {
                // alert(discount_type);
                var sub_total = $('#sub_total').val();

                var sub_total = $('#sub_total').val();
                var grand_total = 0;

                percent_discout = (sub_total * discount_value) / 100;

                $('#discount_value1').val(percent_discout);

                grand_total_ex = sub_total - percent_discout;

                var sgst = $('#sgst').val();
                var cgst = $('#cgst').val();

                var sgst_percent = (grand_total_ex * sgst) / 100;
                var cgst_percent = (grand_total_ex * cgst) / 100;

                $('#bill_sgst').val(sgst_percent);
                $('#bill_cgst').val(cgst_percent);

                grand_total = grand_total_ex + sgst_percent + cgst_percent;

                grand_total = Math.round(grand_total * 100) / 100;

                $('#grand_total').val(grand_total);


            } else {
                alert('Something Went Wrong...');
            }

        });

        $('#item_submit').on('click', function (e) {
            // alert('Miracle Miracle ...');

            var item_id = $('#item_sel_id').val();
            var item_qty = $('#item_qty').val();
            var item_rate = $('#item_rate').val();
            var bill_id = $('#bill_no').val();
            var final_amount = $('#final_amount').val();

            if(item_id!="0" && item_qty!="" && item_rate!="0" && bill_id!=""){
                $.ajax({
                    url: "insert-bill-item.php",
                    type: "POST",
                    data: {
                        item_id: item_id,
                        item_qty: item_qty,
                        item_rate: item_rate,
                        bill_id: bill_id              
                    },
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            // document.write('leto j ja...');
                            // $("#butsave").removeAttr("disabled");
                            // $('#fupForm').find('input:text').val('');
                            // $("#success").show();
                            // $('#success').html('Data added successfully !');
                            // $('#datatable').data.reload();
                            // alert('Miracle...');
                            // $('#dataTable').DataTable().ajax.reload();
                            // alert('Miracle Miracle Miracle ...');  

                            load_data(bill_id);

                            function load_data()
                            {
                              $.ajax({
                               url:"fetch-bill-items.php",
                               method:"POST",
                               data:{
                                    bill_id:bill_id
                                },
                               success:function(data1)
                               {
                                var dataex = JSON.parse(data1);
                                $('#result').html(dataex.data.output);
                                $('#sub_total').val(dataex.data.final_amount);

                                var sub_total = dataex.data.final_amount;
                                var sgst = $('#sgst').val();
                                var cgst = $('#cgst').val();

                                var sgst_percent = (sub_total * sgst) / 100;
                                var cgst_percent = (sub_total * cgst) / 100;

                                $('#bill_sgst').val(sgst_percent);
                                $('#bill_cgst').val(cgst_percent);

                                grand_total = sub_total + sgst_percent + cgst_percent;

                                grand_total = Math.round(grand_total * 100) / 100;

                                $('#grand_total').val(grand_total);


                               }
                              });
                            }     

                            $('#item_qty').val(1);
                            $('#item_rate').val(0);
                        }
                        else if(dataResult.statusCode==201){
                           alert(dataResult.msg);
                        }
                        

                    }
                });

                $('#item_sel_id').focus();
            }
            else{
                alert('Please Select Item!');

                $('#item_sel_id').focus();
            }
        });


        $('#cust_name').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            var cust_id = valueSelected;

            load_data(valueSelected);
            
            function load_data(query) {
                $.ajax({
                    url:"fetch-cust-gst.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                    $('#cust_gst_no').val(data);
                    }
                });
            }

            // $("#item_sr").hide();

            $("#cust_gst_no").focus();
        });

        $('#item_sel_id').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            var item_id = valueSelected;

            var table_no = $('#table_no').val();
            var table_type = 0;

            // alert(table_no);
            load_data1();
            
            function load_data1() {
                $.ajax({
                    url:"fetch-table-data.php",
                    method:"POST",
                    data:{table_no:table_no},
                    success:function(dataOfTable)
                    {
                        var dataOfTable = JSON.parse(dataOfTable);
                        if(dataOfTable.statusCode==200){
                            // alert(dataResult);
                            table_type = dataOfTable.data.table_type;
                            // alert(table_type); 
                        }
                        else if(dataItem.statusCode==201){
                           alert("Error occured !");
                        }
                    }
                });
            }

            load_data(valueSelected);
            
            function load_data(query) {
                $.ajax({
                    url:"fetch-item-data.php",
                    method:"POST",
                    data:{item_id:item_id},
                    success:function(dataItem)
                    {
                        var dataItem = JSON.parse(dataItem);
                        if(dataItem.statusCode==200){
                            // alert(dataResult);
                            // alert(table_type);
                            if (table_type == 1) {
                                $('#item_rate').val(dataItem.data.item_rate_1);
                            } else if (table_type == 2) {
                                $('#item_rate').val(dataItem.data.item_rate_2);
                            } else if (table_type == 3) {
                                $('#item_rate').val(dataItem.data.item_rate_3);
                            } else if (table_type == 4) {
                                $('#item_rate').val(dataItem.data.item_rate_4);
                            } else if (table_type == 5) {
                                $('#item_rate').val(dataItem.data.item_rate_5);
                            } else if (table_type == 6) {
                                $('#item_rate').val(dataItem.data.item_rate_6);
                            // } else {
                            //     $('#item_rate').val(dataItem.data.item_rate_1);
                            }
                        }
                        else if(dataItem.statusCode==201){
                           alert("Error occured !");
                        }
                    }
                });
            }

            $("#item_rate").focus();
        });

        $(document).on('click', '.plus', function(){
            var entry_id = $(this).data('id');
            var bill_id = $('#bill_no').val();
            $.ajax({
                url:"update-qty.php",
                method:"POST",
                data:{
                    entry_id: entry_id,
                    action:'plus'
                },
                success:function(data)
                {
                    load_data(bill_id);
                }
            });

            function load_data()
            {
              $.ajax({
               url:"fetch-bill-items.php",
               method:"POST",
               data:{
                    bill_id:bill_id
                },
               success:function(data1)
               {
                var dataex = JSON.parse(data1);
                $('#result').html(dataex.data.output);
                $('#sub_total').val(dataex.data.final_amount);

                var sub_total = dataex.data.final_amount;
                var sgst = $('#sgst').val();
                var cgst = $('#cgst').val();

                var sgst_percent = (sub_total * sgst) / 100;
                var cgst_percent = (sub_total * cgst) / 100;

                $('#bill_sgst').val(sgst_percent);
                $('#bill_cgst').val(cgst_percent);

                grand_total = sub_total + sgst_percent + cgst_percent;

                grand_total = Math.round(grand_total * 100) / 100;

                $('#grand_total').val(grand_total);


               }
              });
            }

            
        });

        $(document).on('click', '.minus', function(){
            var entry_id = $(this).data('id');
            var bill_id = $('#bill_no').val();
            // document.write('miricle...');
            // var quantity = $(this).val();
            // var item_id = $(this).data('item_id');
            // var order_id = $(this).data('order_id');
            // var rate = $(this).data('rate');
            $.ajax({
                url:"update-qty.php",
                method:"POST",
                data:{
                    entry_id: entry_id,
                    action:'minus'
                },
                success:function(data)
                {
                    load_data(bill_id);
                }
            });

            function load_data()
            {
              $.ajax({
               url:"fetch-bill-items.php",
               method:"POST",
               data:{
                    bill_id:bill_id
                },
               success:function(data1)
               {
                var dataex = JSON.parse(data1);
                $('#result').html(dataex.data.output);
                $('#sub_total').val(dataex.data.final_amount);

                var sub_total = dataex.data.final_amount;
                var sgst = $('#sgst').val();
                var cgst = $('#cgst').val();

                var sgst_percent = (sub_total * sgst) / 100;
                var cgst_percent = (sub_total * cgst) / 100;

                $('#bill_sgst').val(sgst_percent);
                $('#bill_cgst').val(cgst_percent);

                grand_total = sub_total + sgst_percent + cgst_percent;

                grand_total = Math.round(grand_total * 100) / 100;

                $('#grand_total').val(grand_total);


               }
              });
            }
        });


        $(document).on('click', '.delete', function(){
            var entry_id = $(this).data('id');
            var bill_id = $('#bill_no').val();
            $.ajax({
                url:"delete-bill-items.php",
                method:"POST",
                data:{
                    entry_id: entry_id
                },
                success:function(data)
                {
                    load_data(bill_id);
                }
            });

            function load_data()
            {
              $.ajax({
               url:"fetch-bill-items.php",
               method:"POST",
               data:{
                    bill_id:bill_id
                },
               success:function(data1)
               {
                var dataex = JSON.parse(data1);
                $('#result').html(dataex.data.output);
                $('#sub_total').val(dataex.data.final_amount);

                var sub_total = dataex.data.final_amount;
                var sgst = $('#sgst').val();
                var cgst = $('#cgst').val();

                var sgst_percent = (sub_total * sgst) / 100;
                var cgst_percent = (sub_total * cgst) / 100;

                $('#bill_sgst').val(sgst_percent);
                $('#bill_cgst').val(cgst_percent);

                grand_total = sub_total + sgst_percent + cgst_percent;

                grand_total = Math.round(grand_total * 100) / 100;

                $('#grand_total').val(grand_total);


               }
              });
            }
        });

    </script>
</body>
</html>
<?php
 include('disconnect.php');
?>