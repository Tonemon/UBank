<?php 
	session_start();
	include '../_inc/dbconn.php';
	
	$date=date('Y-m-d h:i:s');
	
	$logout_id=$_SESSION['logout_id']; // getting the logoutid from the displayinfo.php file
	$sql="UPDATE admin SET lastlogin='$date' WHERE id='$logout_id'"; // updating the last login time
	mysql_query($sql) or die(mysql_error());

	session_destroy();
	header('location:../admin/');
?>
