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

    <title>Stock Entry Master</title>

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
                <!-- <h1 class="h3 mb-2 text-gray-800">Customer Master</h1> -->
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Stock Entry Master</h6>
                            <a class="float-right font-weight-bold mylink" href="stock-reg.php">
                                <i class="fa fa-plus"></i>
                                Add Stock Entry
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Stock Entry Master</h6>
                            <a class="float-right font-weight-bold mylink" href="stock-reg.php">
                                <i class="fa fa-plus"></i>
                                Add Stock Entry
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Company Name</th>
                                        <th>Bill No.</th>
                                        <th>Bill Date</th>
                                        <th>Bill Barcode No.</th>
                                        <th>Item Type</th>
                                        <th>Item Name</th>
                                        <th>Item Qty</th>
                                        <th>Stock Unit</th>
                                        <th>Total stock</th>
                                        <!-- <th>Edit</th> -->
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                      $select_sql = "SELECT * FROM `stock_master` ORDER BY `stock_id` DESC";

                                      $result = mysqli_query($conn, $select_sql);
                                      $count = 0;

                                      while ($data = mysqli_fetch_assoc($result)) {
                                        $count = $count + 1;
                                        $item_id = $data['stock_item_name'];

                                        $item_sql = "SELECT * FROM `item_master` WHERE `item_id` = '$item_id'";

                                      $item_result = mysqli_query($conn, $item_sql);

                                      while ($item_data = mysqli_fetch_assoc($item_result)) {
                                            $item_name = $item_data['item_name'];
                                      }

                                      echo '<tr>';
                                        echo "<td nowrap>".$count."</td>";
                                        echo "<td nowrap>".$data['stock_company_name']."</td>";
                                        echo "<td nowrap>".$data['stock_bill_no']."</td>";
                                        echo "<td nowrap>".date('d-m-Y',strtotime($data['stock_date']))."</td>";     
                                        echo "<td>".$data['stock_barcode_no']."</td>";
                                        echo "<td nowrap>";
                                        if ($data['stock_item_type'] == 0) {
                                            echo "Raw Meterial";
                                        } elseif ($data['stock_item_type'] == 1) {
                                            echo "Item Menu";
                                        }
                                        else { 
                                            echo "Error";
                                        }
                                        echo "</td nowrap>";
                                        echo "<td nowrap>".$item_name."</td>";
                                        echo "<td nowrap>".$data['stock_qty']."</td>";
                                        echo "<td nowrap>".$data['stock_unit']."</td>";
                                        echo '<td nowrap id="total_stock">';

                                            $stock_item_name = $data['stock_item_name'];

                                            $query_total_stock = "SELECT `stock_qty` FROM `stock_master` WHERE `stock_item_name` = '$stock_item_name'";

                                            $result_total_stock = mysqli_query($conn, $query_total_stock);
                                            $total_stock = 0;

                                            if(mysqli_num_rows($result_total_stock) > 0)
                                            {   
                                                while($row = mysqli_fetch_array($result_total_stock))
                                                {
                                                  $total_stock += $row['stock_qty'];
                                                }
                                                echo $total_stock;
                                            }
                                            else
                                            {
                                                echo 'No Data Found';
                                            }

                                        echo '</td>';
                                        // echo '<td nowrap>';
                                        // echo '<a class="btn btn-primary ops" href="stock-edit.php?edit_id='.$data['stock_id'].'&pg_id=stock-master" class="">&nbsp; Edit &nbsp;</a>';
                                        // echo '</td>';
                                        echo '<td nowrap>';
                                        echo '<a class="btn btn-info ops" href="stock-del.php?delete_id='.$data['stock_id'].'&pg_id=stock_master" class="">Delete</a>';
                                        echo '</td>';
                                      echo '</tr>';
                                      }
                                    ?>
                                </tbody>
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

    <script type="text/javascript">
        $('body').on('load', function (e) {

            function load_stock(query)
           {
                $.ajax({
                 url:"fetch-item-stock.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#total_stock').html(data);
                 }
                });
               }
        });
    </script>

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

</body>
</html>
<?php
 include('disconnect.php');
?>