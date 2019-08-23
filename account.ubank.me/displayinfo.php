<?php 
session_start();
include '_inc/dbconn.php';
		
if(!isset($_SESSION['session_user_start'])) 
    header('location:index.php');   
?>

<?php
    // Usage: This file contains all the important information for different processes to be made. It's included in most process_{}.php files instead of the aheader.php and afooter.php file, because that file includes html code and this one doesn't.

    // gather all information from session data
    $userdat_email = $_SESSION['session_user_email'];

    include '_inc/dbconn.php';
    $sql ="SELECT * FROM UBankMAIN.users WHERE email='$userdat_email'";
    $result =  mysql_query($sql) or die(mysql_error());
    $res =  mysql_fetch_array($result);
    
    // setting all variables
    $userdat_id = $res[0];
    $userdat_name = $res[1];
    $userdat_gender = $res[2];
    $userdat_acctype = $res[4];
    $userdat_address = $res[5];
    $userdat_mobile = $res[6];
    $userdat_branch = $res[10];
    $userdat_branchcode = $res[11];
    $userdat_lastlogin = $res[12];
    $userdat_accstatus = $res[13];
?>