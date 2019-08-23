<?php
	// This file contains the code to set the (different) user information and set the user id for the logout process
	
	
	$admin_id=$_SESSION['admin_id']; // login username
	include '../_inc/dbconn.php';
	$sql="SELECT * FROM admin WHERE login_id='$admin_id'"; // select user info from db with login_id = login username
	$result=  mysql_query($sql) or die(mysql_error());
	$rws=  mysql_fetch_array($result);

	// select variables for later use
	$adminname=$rws[1];
	$last_login=$rws[10];
	$departement=$rws[5];

	$real_id=$rws[0]; // set the user id for logout process (creating the last_login)
	$_SESSION['logout_id']=$real_id; // set the session for the logout id (timestamp)
?>