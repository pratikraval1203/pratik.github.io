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

    <title>Item Wise Report</title>

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

                <!-- Page Heading -->
                <!-- <h1 class="h3 mb-2 text-gray-800">Bill Wise Report</h1> -->
                <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                    For more information about DataTables, please visit the <a target="_blank"
                        href="https://datatables.net">official DataTables documentation</a>.
                </p> -->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <?php 
                            if ($alert != "") {
                        ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Item Wise Report</h6>
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Item Wise Report</h6>
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
                                <div class="form-group col-md-3">
                                    <label for="department_name">Department Name</label>
                                    <select class="form-control mydrpdwn" name="department_name" id="department_name" placeholder="Select Department" required="">
                                        <option value="0">ALL</option>
                                        <?php 
                                            $query_dept = "SELECT * FROM `department_master` ORDER BY `department_name`";    
                                            $result_dept = mysqli_query($conn, $query_dept);


                                            while ($data_dept = mysqli_fetch_assoc($result_dept)) {
                                                $dept_id = $data_dept['department_id'];
                                                $dept_name = $data_dept['department_name'];
                                        ?>
                                            <option value="<?php echo $dept_id; ?>"><?php echo $dept_name; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label  class="form-label" for="start_date">Select Start Date </label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" required="required">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="end_date">Select End Date </label>
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
                                        <th class="mywrap">Item Name</th>
                                        <!-- <th>Bill No.</th> -->
                                        <!-- <th>Item ID</th> -->
                                        <th>Total Sale QTY</th>
                                        <!-- <th>Customer</th> -->
                                        <!-- <th>Item Rate</th> -->
                                        <th>Total Item Sell Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (isset($_POST['date_submit'])) {

                                        $department_name = $_POST['department_name'];
                                        $start_date = date('Y-m-d', strtotime($_POST['start_date']));
                                        $end_date = date('Y-m-d', strtotime($_POST['end_date']));

                                        $dept_sql = "SELECT * FROM `item_master` WHERE `item_type` = 1 && `department_name` = '$department_name'";

                                        $dept_result = mysqli_query($conn, $dept_sql);
                                        $count = 0;
                                        $total_dept_item_qty = 0 ;
                                        $total_dept_item_amount = 0;

                                        while ($dept_data = mysqli_fetch_assoc($dept_result)) {
                                            $count = $count + 1;
                                            $item_id = $dept_data['item_id'];

                                            echo '<tr>';
                                                echo "<td nowrap>".$count."</td>";
                                                echo "<td nowrap>".$dept_data['item_name']."</td>";

                                                $select_sql = "SELECT tbl_bills.bill_id, `bill_date`, bill_items.bill_id, `item_id`, `item_qty`, `item_rate` FROM `tbl_bills` LEFT JOIN `bill_items` ON tbl_bills.bill_id = bill_items.bill_id WHERE bill_items.item_id = '$item_id'";
                                    
                                                $result = mysqli_query($conn, $select_sql);
                                                $total_item_qty = 0;
                                                $total_item_amount = 0;

                                                while ($data = mysqli_fetch_assoc($result)) {
                                                    $item_amount = $data['item_qty'] * $data['item_rate'];
                                                    $total_item_amount = $total_item_amount + $item_amount;
                                                    $total_item_qty = $total_item_qty + $data['item_qty'];
                                                }

                                                echo "<td nowrap>".$total_item_qty."</td>";
                                                echo "<td>".$total_item_amount."</td>";
                                            echo '</tr>';

                                            $total_dept_item_qty = $total_dept_item_qty + $total_item_qty;
                                            $total_dept_item_amount = $total_dept_item_amount + $total_item_amount;
                                        }
                                    echo '</tbody>';
                                    echo "<tfoot>";
                                        echo '<tr>';
                                            echo "<th nowrap></th>";
                                            echo "<th nowrap>Total</th>";
                                            echo "<th nowrap>".$total_dept_item_qty."</th>";
                                            echo "<th>".$total_dept_item_amount."</th>";
                                        echo '</tr>';
                                    echo "</tfoot>";
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

            // var department_name = $('#department_name').val();

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
                // win.document.write('<h1>' + department_name + '</h1>');
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