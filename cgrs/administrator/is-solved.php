<?php
	echo $_GET['sol_id'];

	include ('connection.php');
    // $servername = "localhost";
    // $dbuser = "root";
    // $dbpass = "";
    // $database = "db_gri_red_sys";  

    // $conn = mysqli_connect($servername, $dbuser, $dbpass);

    // if (!$conn) {
    //   echo "Database Connection Failed.";
    // }
    // mysqli_select_db($conn, $database);

    $sql = "UPDATE db_form SET is_solved = 1 where sr=".$_GET['sol_id'];
    

    $result= mysqli_query($conn, $sql);

    //echo mysqli_error($conn);
    mysqli_close($conn);
    
    unset($servername);
    unset($dbuser);
    unset($dbpass);
    unset($database);
    unset($conn);
    unset($sql);
    unset($result);

    if ($_GET['pg_id'] == "IT") {
        echo '<script language="javascript" type="text/javascript">window.location = "it.php"</script>';
        // header('location:rejected-complaints.php');
    }
    elseif ($_GET['pg_id'] == "CE") {
        echo '<script language="javascript" type="text/javascript">window.location = "ce.php"</script>';
        // header('location:rejected-complaints.php');
    } 
    elseif ($_GET['pg_id'] == "EC") {
        echo '<script language="javascript" type="text/javascript">window.location = "ec.php"</script>';
        // header('location:rejected-complaints.php');
    }
    elseif ($_GET['pg_id'] == "IC") {
        echo '<script language="javascript" type="text/javascript">window.location = "ic.php"</script>';
        // header('location:rejected-complaints.php');
    }
    elseif ($_GET['pg_id'] == "BM") {
        echo '<script language="javascript" type="text/javascript">window.location = "bm.php"</script>';
        // header('location:rejected-complaints.php');
    }
    elseif ($_GET['pg_id'] == "EE") {
        echo '<script language="javascript" type="text/javascript">window.location = "ee.php"</script>';
        // header('location:rejected-complaints.php');
    }
    elseif ($_GET['pg_id'] == "CH") {
        echo '<script language="javascript" type="text/javascript">window.location = "ch.php"</script>';
        // header('location:rejected-complaints.php');
    }
    else {
         echo '<script language="javascript" type="text/javascript">window.location = "general.php"</script>';
        // header('location:show-complaints.php');
    }
?>