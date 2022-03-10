<?php
   if (isset($_POST['lc_submit'])) {
   	echo "Your complaint submitted....!!!";
   	$host="localhost";
    $dbuser="root";
    $dbpass="";

    $con=mysqli_connect($host,$dbuser,$dbpass);

    if ($con) {
    	echo "connected";
    }else{
    	echo "connection failed";
    }

    $dbname="db_clg_gri_red_sys";

    mysqli_select_db($con,$dbname);

    $name=$_POST['lc_name'];
    $en_no=$_POST['lc_enno'];
    $de_ment=$_POST['d_ment'];
    $complaint=$_POST['lc_complaint'];
    $is_accepted=0;
    $is_rejected=0;
    $is_deleted=0;

    $insertquery="INSERT INTO db_form(s_name,en_no,d_ment,description,is_accepted,is_rejected,is_solved)
    VALUES
    ('$name','$en_no','$de_ment','$complaint','$is_accepted','$is_rejected','$is_solved')";

    mysqli_query($con,$insertquery);

    mysqli_close($con);

    header('location:index.php?cmp=yes');

}else{
	echo "Somthing goes wrong";
}
?>