<?php 
session_start();
include '../_inc/dbconn.php';

if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>

<?php include 'displayinfo.php' ?>

<?php
	// This script executes the admin password request from settings.php
	
	if(isset($_REQUEST['change_password'])){
		$sql="SELECT * FROM admin WHERE id='$real_id'";
		$result=mysql_query($sql);
		$rws=  mysql_fetch_array($result);
		$old=  mysql_real_escape_string($_REQUEST['old_password']);
		$new=  mysql_real_escape_string($_REQUEST['new_password']);
		$again=  mysql_real_escape_string($_REQUEST['again_password']);
		
			if($rws[9]==$old && $new==$again){
				$sql1="UPDATE admin SET pwd='$new' WHERE id='$real_id'";
				mysql_query($sql1) or die(mysql_error());
				header('location:settings?success=1');
			} else {
				header('location:settings?error=1');
			}
	}
?>