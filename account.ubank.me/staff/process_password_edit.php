<?php 
session_start();
include '../_inc/dbconn.php';

if(!isset($_SESSION['staff_login'])) 
    header('location:../staff/');   
?>

<?php include 'displayinfo.php' ?>

<?php
	$user=$_SESSION['login_id'];
	if(isset($_REQUEST['change_password'])){
		$sql="SELECT * FROM staff WHERE email='$user'";
		$result=mysql_query($sql);
		$rws=  mysql_fetch_array($result);
		$old=  mysql_real_escape_string($_REQUEST['old_password']);
		$new=  mysql_real_escape_string($_REQUEST['new_password']);
		$again=  mysql_real_escape_string($_REQUEST['again_password']);
		
		if($rws[9]==$old && $new==$again){
			$sql1="UPDATE staff SET pwd='$new' WHERE email='$user'";
			mysql_query($sql1) or die(mysql_error());
			header('location:settings?success=1');
		} else {
			header('location:settings?error=1');
		}
	}
?>