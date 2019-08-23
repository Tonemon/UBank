<?php 
session_start();
        
if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>
<?php
include '../_inc/dbconn.php';
$name=  mysql_real_escape_string($_REQUEST['admin_name']);
$gender=  mysql_real_escape_string($_REQUEST['admin_gender']);
$dob=  mysql_real_escape_string($_REQUEST['admin_dob']);
$status=  mysql_real_escape_string($_REQUEST['admin_status']);
$dept=  mysql_real_escape_string($_REQUEST['admin_dept']);
$address=  mysql_real_escape_string($_REQUEST['admin_address']);
$mobile=  mysql_real_escape_string($_REQUEST['admin_mobile']);
$login_id= mysql_real_escape_string($_REQUEST['admin_username']); // login id is the replacement for email
$password=  mysql_real_escape_string($_REQUEST['admin_pwd']);

$sql="insert into admin values('','$name','$gender','$dob','$status','$dept','$address','$mobile','$login_id','$password','')";
mysql_query($sql) or die("The username is already registered. Please use another one.");
header('location:admin?add=1');
?>