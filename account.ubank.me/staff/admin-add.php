<?php 
session_start();
        
if(!isset($_SESSION['session_staff_start'])) 
    header('location:../staff/');   
?>
<?php
include '../_inc/dbconn.php';
$status = "admin"; // account status to be inserted in database
$req_name = mysql_real_escape_string($_REQUEST['admin_name']);
$req_gender = mysql_real_escape_string($_REQUEST['admin_gender']);
$req_dob = mysql_real_escape_string($_REQUEST['admin_dob']);
$req_address = mysql_real_escape_string($_REQUEST['admin_address']);
$req_mobile = mysql_real_escape_string($_REQUEST['admin_mobile']);
$req_username = mysql_real_escape_string($_REQUEST['admin_username']);
$req_email = mysql_real_escape_string($_REQUEST['admin_email']);

// password salting (for security reasons)
$salt = "@g26jQsG&nh*&#8v";
$req_password = sha1(mysql_real_escape_string($_REQUEST['admin_password']).$salt);

$sql="INSERT INTO UBankMAIN.staff values('','$req_name','$req_gender','$req_dob','$status','$req_address','$req_mobile','$req_username','$req_email','$req_password','')";
mysql_query($sql) or die("The username is already registered. Please use another one.");
header('location:admin?add=1');
?>