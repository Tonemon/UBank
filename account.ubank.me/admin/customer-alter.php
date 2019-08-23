<?php 
session_start();
        
if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>

<?php
include '../_inc/dbconn.php';
$name=  mysql_real_escape_string($_REQUEST['edit_name']);
$gender=  mysql_real_escape_string($_REQUEST['edit_gender']);
$dob=  mysql_real_escape_string($_REQUEST['edit_dob']);
$id=  mysql_real_escape_string($_REQUEST['current_id']);
$type=  mysql_real_escape_string($_REQUEST['edit_account']);
$nominee=  mysql_real_escape_string($_REQUEST['edit_nominee']);
$address=  mysql_real_escape_string($_REQUEST['edit_address']);
$mobile=  mysql_real_escape_string($_REQUEST['edit_mobile']);
$email=  mysql_real_escape_string($_REQUEST['edit_email']);

$sql="UPDATE customer SET  name='$name', dob='$dob', nominee='$nominee', account='$type', 
     address='$address', mobile='$mobile', email='$email', gender='$gender' WHERE id='$id'";
mysql_query($sql) or die(mysql_error());
header('location:customer?edit=1');
?>