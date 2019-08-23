<?php 
	session_start();
	include '../_inc/dbconn.php';
	
	$date=date('Y-m-d h:i:s');
	// $date=$_SESSION['staff_date']; this is not working
	$id=$_SESSION['id'];
	$sql="UPDATE staff SET lastlogin='$date' WHERE id='$id'";
	mysql_query($sql) or die(mysql_error());

	session_destroy();
	header('location:../staff/');
?>