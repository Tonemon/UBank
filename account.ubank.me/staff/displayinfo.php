<?php 
session_start();
include '../_inc/dbconn.php';
		
if(!isset($_SESSION['session_staff_start'])) 
    header('location:../staff/');   
?>

<?php
    // Usage: This file contains all the important information for different processes to be made. It's included in most process_{}.php files instead of the aheader.php and afooter.php file, because that file includes html code and this one doesn't.

    // gather all information from session data
    $staffdat_email = $_SESSION['session_staff_email'];

    include '../_inc/dbconn.php';
    $sql ="SELECT * FROM UBankMAIN.staff WHERE email='$staffdat_email'";
    $result =  mysql_query($sql) or die(mysql_error());
    $res =  mysql_fetch_array($result);
    
    // setting all variables
    $staffdat_id = $res[0];
    $staffdat_name = $res[1];
    $staffdat_gender = $res[2];
    $staffdat_account = $res[4];
    $staffdat_address = $res[5];
    $staffdat_mobile = $res[6];
    $staffdat_username = $res[7];
    $staffdat_lastlogin = $res[10];
?>