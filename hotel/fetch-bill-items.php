<?php

    include ('connection.php');

    $bill_id = $_POST['bill_id'];
    $final_amount = 0;
    $final_qty = 0;

    $select_sql = "SELECT * FROM `bill_items` WHERE `bill_id` = '$bill_id' ORDER BY `entry_id` DESC";

    $output = "";

    $result = mysqli_query($conn, $select_sql);
    $count = 0;

    while ($data = mysqli_fetch_assoc($result)) {
        $count = $count + 1;
        $item_id = $data['item_id'];
        $item_qty = $data['item_qty'];
        $item_rate = $data['item_rate'];

        $total_amount = $item_rate * $item_qty;
        $final_amount = $final_amount + $total_amount;

        $final_qty = $final_qty + $item_qty;

        $sql_item = "SELECT * FROM `item_master` WHERE `item_id` = '$item_id'";

        $result_item = mysqli_query($conn, $sql_item);

        $data_item = mysqli_fetch_array($result_item);

        $output .= '<tr style="font-size: 20px;">';
        $output .= "<td nowrap>".$count."</td>";
        $output .= "<td nowrap>".$data_item['item_code'].'-'.$data_item['item_name']."</td>";
        $output .= "<td nowrap>";
        $output .= '<a class="btn btn-sm bg-white text-primary minus" data-id="'.$data['entry_id'].'"><small><i class="fa fa-minus p-1" aria-hidden="true"></i></small></a>';

       // href="update-qty.php?item_id='.$data['entry_id'].'&action=minus"
        $output .= '<span class="btn p-1 bg-white">'.$item_qty.'</span>';

        $output .= '<a class="btn btn-small bg-white text-primary plus" data-id="'.$data['entry_id'].'"><small><i class="fa fa-plus p-1" aria-hidden="true"></i></small></a>';

        // href="update-qty.php?item_id='.$data['entry_id'].'&action=plus"
        $output .= '</td>';
        $output .= "<td nowrap>".$item_rate."</td>";                                        

        $output .= '<td nowrap>';
            $output .= $total_amount;
        // $output .= '<a class="btn btn-primary ops" href="cust-edit.php?edit_id='.$data['entry_id'].'&pg_id=cust-master" class="">&nbsp; Edit &nbsp;</a>';
        // $output .= '</td>';
        $output .= '<td nowrap>';
        $output .= '<a class="btn text-primary delete" data-id="'.$data['entry_id'].'"><i class="far fa-times-circle p-1" aria-hidden="true"></i></a>';
        // $output .= '<a class="text-primary"><i class="far fa-times-circle p-1"></i></a>';
        $output .= '</td>';
        $output .= '</tr>';
    }
        // $output .= '<tr>';
        //     $output .= '<td> Total</td>';
        //     $output .= '<td style="text-align:right;">Total QTY</td>';
        //     $output .= '<td nowrap>'.$final_qty.'</td>';
        //     $output .= '<td></td>';
        //     $output .= '<td>'.$final_amount.'</td>';
        //     $output .= '<th><i class="far fa-times-circle p-1"></th>';
        // $output .= '</tr>';

        $output .= '<input type="hidden" name="final_amount" id="final_amount" value="'.$final_amount.'">';

    $double = array(
            'msg' => 'data of item',
            'statusCode' => 200,
            'data' => array(
                    'output' => $output,
                    'final_amount' => $final_amount
                )
            );

    echo json_encode($double);

    include ('disconnect.php');
?>