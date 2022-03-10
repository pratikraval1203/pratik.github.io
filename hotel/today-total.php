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

    <title>Today's Total</title>

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
                <div class="card shadow mb-4 mt-5">
                    <div class="card-header">
                        <h2 class="font-weight-bold text-center">Today's Total</h2>               
                    </div>
                    <div class="card-body">
                        <?php
                            $current_date = date('Y-m-d');
                            // $current_date = '2021-10-19';

                            $select_sql = "SELECT * FROM `tbl_bills` WHERE `bill_status` = 1 && `bill_date` = '$current_date' ORDER BY `bill_id` DESC";

                            $result = mysqli_query($conn, $select_sql);
                            $count = 0;
                            $total_item_total = 0;
                            $total_discount = 0;
                            $total_cgst = 0;
                            $total_sgst = 0;
                            $total_grand_total = 0;

                            while ($data = mysqli_fetch_assoc($result)) {
                                $count = $count + 1;

                                $payment_type_show = "None";
                                $payment_type = $data['payment_type'];

                                if ($payment_type == 1) {
                                    $payment_type_show = "Cash";
                                } elseif ($payment_type == 2) {
                                    $payment_type_show = "Credit";
                                } elseif ($payment_type == 3) {
                                    $payment_type_show = "Customer Account";
                                }

                                $table_id = $data['table_no'];
                                $table_no = '';

                                $table_sql = "SELECT `table_id`,`table_no` FROM `new_table_master` WHERE `table_id` = '$table_id'";

                                $table_result = mysqli_query($conn, $table_sql);

                                while ($table_data = mysqli_fetch_assoc($table_result)) {
                                    $table_no = $table_data['table_no'];
                                }

                                $total_item_total += $data['sub_total'];
                                $total_discount += $data['discount'];
                                $total_cgst += $data['cgst_amount'];
                                $total_sgst += $data['sgst_amount'];
                                $total_grand_total += $data['grand_total'];
                            }

                            echo "<h1 class='text-center font-weight-bold text-primary'>".$total_grand_total."</h1>";
                        ?>
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
                style = style + 'td {padding: 1% !important;}';
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