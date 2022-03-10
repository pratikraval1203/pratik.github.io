<?php
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";
  if (isset($_GET['msg'])) {
        $alert = $_GET['msg'];
    }

  include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Settlement Report</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- for masters -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mycss.css" >

    <style type="text/css">
        td {
            padding: 1% !important;
        }
        th {
            /*color: red !important;*/
            white-space: pre-wrap !important;
        }
        th.mywrap {
            white-space: nowrap !important;
        }
    </style>

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

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <?php 
                            if ($alert != "") {
                        ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Monthly Report</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="billing-screen.php">
                                <i class="fa fa-plus"></i>
                                Add New Bill
                            </a>     -->             
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Monthly Report</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="billing-screen.php">
                                <i class="fa fa-plus"></i>
                                Add New Bill
                            </a> -->                 
                        </div>
                      <?php
                      }
                      ?>
                    <div class="card-body">
                        <div class="row">
                            <form name="myform1" class="col-md-8 row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <!-- <div class="form-group col-md-3">
                                    <label for="table_no" class="text-primary">Table No.</label>
                                    <select class="form-control mydrpdwn" id="table_no" name="table_no" required="">
                                        <option selected="" value="0">Select Table</option>
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
                                </div> -->
                                <div class="form-group col-md-3">
                                    <label  class="form-label" for="start_date">Select Start Date </label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" required="required" max="<?php echo date('Y-m-d'); ?>">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="end_date">Select Date </label>
                                    <input type="date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" id="end_date" name="end_date" class="datepicker" required="required">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="end_date" style="display: none;">Select End Date </label>
                                    <br>
                                    <input class="btn btn-primary" type="submit" value="Submit" name="date_submit">
                                </div>
                            </form>
                            <div class="col-md-4">
                                <div class="form-group col-md-4 float-right">
                                    <label for="end_date" style="display: none;">Select End Date </label>
                                    <br>
                                    <button class="btn btn-info btn-pdf">Print PDF</button>
                                </div>
                                <div class="form-group col-md-5 float-right">
                                    <label for="end_date" style="display: none;">Select End Date </label>
                                    <br>
                                    <button class="btn btn-success btn-report">Get Excel</button>
                                </div>
                            </div>
                        </div> 
                        <hr>
                        <div class="table-responsive table-wrapper report-table" id="tab">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Date</th>
                                        <th>Item Total</th>
                                        <th>Discount Amount</th>
                                        <th>CGST Amount</th>
                                        <th>SGST Amount</th>
                                        <th>Grand Total</th>
                                        <th>Cash</th>
                                        <th>Credit</th>
                                        <th>Customer Account</th>
                                        <th>Swiggy</th>
                                        <th>Zomato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (isset($_POST['date_submit'])) {

                                        $start_date = date('Y-m-d', strtotime($_POST['start_date']));
                                        $end_date = date('Y-m-d', strtotime($_POST['end_date']));

                                        $count = 0;
                                        $final_item_total = 0;
                                        $final_discount = 0;
                                        $final_cgst = 0;
                                        $final_sgst = 0;
                                        $final_grand_total = 0;
                                        $final_cash = 0;
                                        $final_credit = 0;
                                        $final_customer_account = 0;

                                        function displayDates($date1, $date2, $format = 'd-m-Y' ) {
                                            $dates = array();
                                            $current = strtotime($date1);
                                            $date2 = strtotime($date2);
                                            $stepVal = '+1 day';
                                            while( $current <= $date2 ) {
                                                $dates[] = date($format, $current);
                                                $current = strtotime($stepVal, $current);
                                            }
                                            return $dates;
                                        }
                                        $date = displayDates($start_date,$end_date);

                                        foreach ($date as $key ) {
                                            $final_date = date('Y-m-d', strtotime($key));

                                            $select_sql = "SELECT * FROM `tbl_bills` WHERE `bill_status` = 1 && `bill_date` = '$final_date'";

                                            $result = mysqli_query($conn, $select_sql);

                                            // if (mysqli_num_rows($result) == 0) {
                                            //     continue;
                                            // }

                                            $count += 1;
                                            $total_item_total = 0;
                                            $total_discount = 0;
                                            $total_cgst = 0;
                                            $total_sgst = 0;
                                            $total_grand_total = 0;
                                            $total_cash = 0;
                                            $total_credit = 0;
                                            $total_customer_account = 0;

                                            while ($data = mysqli_fetch_assoc($result)) {

                                                $payment_type = $data['payment_type'];

                                                $total_item_total += $data['sub_total'];
                                                $total_discount += $data['discount'];
                                                $total_cgst += $data['cgst_amount'];
                                                $total_sgst += $data['sgst_amount'];
                                                $total_grand_total += $data['grand_total'];

                                                if ($payment_type == 1) {
                                                    $total_cash += $data['grand_total'];
                                                } elseif ($payment_type == 2) {
                                                    $total_credit += $data['grand_total'];
                                                } elseif ($payment_type == 3) {
                                                    $total_customer_account += $data['grand_total'];
                                                }
                                            }
                                            echo '<tr>';
                                                echo "<td nowrap>".$count."</td>";
                                                echo "<td nowrap style='width: 13%;'>".$key."</td>";
                                                echo "<td>".$total_item_total."</td>";
                                                echo "<td>".$total_discount."</td>";
                                                echo "<td>".$total_cgst."</td>";
                                                echo "<td>".$total_sgst."</td>";
                                                echo "<td>".$total_grand_total."</td>";
                                                echo "<td>".$total_cash."</td>";
                                                echo "<td>".$total_credit."</td>";
                                                echo "<td>".$total_customer_account."</td>";
                                                echo "<td nowrap>0</td>";
                                                echo "<td nowrap>0</td>";
                                            echo '</tr>';

                                            $final_item_total += $total_item_total;
                                            $final_discount += $total_discount;
                                            $final_cgst += $total_cgst;
                                            $final_sgst += $total_sgst;
                                            $final_grand_total += $total_grand_total;
                                            $final_cash += $total_cash;
                                            $final_credit += $total_credit;
                                            $final_customer_account += $total_customer_account;

                                        }
                                        echo '</tbody>';
                                        echo '<tfoot>';
                                            echo '<tr>';
                                                echo "<th nowrap></th>";
                                                echo "<th></th>";
                                                echo "<th>".$final_item_total."</th>";
                                                echo "<th>".$final_discount."</th>";
                                                echo "<th>".$final_cgst."</th>";
                                                echo "<th>".$final_sgst."</th>";
                                                echo "<th>".$final_grand_total."</th>";
                                                echo "<th>".$final_cash."</th>";
                                                echo "<th>".$final_credit."</th>";
                                                echo "<th>".$final_customer_account."</th>";
                                                echo "<th nowrap>0</th>";
                                                echo "<th nowrap>0</th>";
                                            echo '</tr>';   
                                        echo '</tfoot>';
                                    }
                                ?>
                            </table>
                        </div>
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

    <!-- for masters -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
        $('table').dataTable({searching: false, paging: false, info: false});

        $(".btn-report").click(function(){
            $("#dataTable").table2excel({
                // exclude CSS class
                exclude: ".noExl",
                name: "Report",
                filename: "report", //do not include extension
                fileext: ".xls" // file extension
            });
        });

        $(".btn-pdf").click(function(){ 

            createPDF();

            function createPDF() {
                var sTable = document.getElementById('tab').innerHTML;

                var style = "";

                style = style + '<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">';
                style = style + '<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">';
                style = style + '<link href="css/sb-admin-2.min.css" rel="stylesheet">';


                style = style + '<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">';
                style = style + '<link rel="stylesheet" href="css/mycss.css" >';

                style = style + '<style type="text/css">';
                style = style + 'td {padding: 5px !important;}';
                style = style + 'th {white-space: pre-wrap !important;}';
                style = style + 'th.mywrap {white-space: nowrap !important;}';
                style = style + '</style>';

                // var script = "<script type='text/javascript'> $('table').dataTable({searching: false, paging: false, info: false}); &lt;/script>";

                // CREATE A WINDOW OBJECT.
                var win = window.open('', '', 'height=700,width=700');

                win.document.write('<html><head>');
                win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
                win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
                win.document.write('</head>');
                win.document.write('<body>');
                win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
                win.document.write('</body></html>');

                win.document.close();   // CLOSE THE CURRENT WINDOW.

                win.print();    // PRINT THE CONTENTS.
            }
        });
    </script>
    <script src="js/jquery.table2excel.js"></script>

</body>
</html>
<?php
 include('disconnect.php');
?>