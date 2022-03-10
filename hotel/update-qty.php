<?php
    session_start();

    if (isset($_POST['action'])) {
        include ('connection.php');

        $entry_id = $_POST['entry_id'];
        $action = $_POST['action'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        if ($action == 'minus') {

            $update_sql = "UPDATE `bill_items` SET `item_qty`=`item_qty` - 1 ,`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `entry_id` = $entry_id";

            if(mysqli_query($conn, $update_sql)) {
                $alert = "Customer Added Successfully";
            }
            else {
                $alert = mysqli_error($conn);
            }

        } elseif ($action == 'plus') {

            $update_sql = "UPDATE `bill_items` SET `item_qty`=`item_qty` + 1 ,`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `entry_id` = $entry_id";

            if(mysqli_query($conn, $update_sql)) {
                $alert = "Customer Added Successfully";
            }
            else {
                $alert = mysqli_error($conn);
            }
            
        } else {
            echo "Error";
        }

        include ('disconnect.php');
    }
?>