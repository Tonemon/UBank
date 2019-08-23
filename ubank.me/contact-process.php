<?php
include '_inc/dbconn.php';

// getting variables to store in table
$firstname=  mysql_real_escape_string($_REQUEST['q_firstname']);
$surname=  mysql_real_escape_string($_REQUEST['q_surname']);
$fullname=  $firstname . ' ' . $surname;

$email= mysql_real_escape_string($_REQUEST['q_email']);
$type=  mysql_real_escape_string($_REQUEST['q_type']);
$message= mysql_real_escape_string($_REQUEST['q_message']);

// variables to set on the go
$status= "TO REVIEW";
$from= "Homepage";
$date=date('Y-m-d h:i:s');

// insert question to table 'customer'
$sql="insert into questions values('','$fullname','$email','$type','$message','$status','','$from','$date')";
mysql_query($sql) or die(header('location:contact?error=1'));

header('location:contact?send=1');
?>