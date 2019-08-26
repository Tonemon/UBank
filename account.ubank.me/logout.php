<?php 
	session_start();
	include '_inc/dbconn.php';

	$date = date('Y-m-d H:i:s');
	$id = $_SESSION['session_user_id'];
	$sql = "UPDATE UBankMAIN.users SET lastlogin='$date' WHERE id='$id'";
	mysql_query($sql) or die(mysql_error());

	session_destroy();
	header('location:index');
?>