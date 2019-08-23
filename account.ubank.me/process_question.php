<?php
include '_inc/dbconn.php';

// getting variables to store in table
$name = mysql_real_escape_string($_REQUEST['q_name']);
$email = mysql_real_escape_string($_REQUEST['q_email']);
$type = mysql_real_escape_string($_REQUEST['q_type']);
$message = mysql_real_escape_string($_REQUEST['q_message']);

// variables to set on the go
$status = "TO REVIEW";
$from = "Support Panel";
$date = date('Y-m-d h:i:s');

// insert question to table 'users'
$sql = "INSERT INTO UBankDAT.questions values('','$name','$email','$type','$message','$status','','$from','$date')";
mysql_query($sql) or die("Your question could not be submitted. Please try again later.");

header('location:settings?send=1');
?>