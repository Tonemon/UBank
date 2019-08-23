<?php 
session_start();
include '_inc/dbconn.php';
		
if(!isset($_SESSION['customer_login'])) 
    header('location:index.php');   
?>

<?php include 'displayinfo.php' ?>

<?php
	$change=$_SESSION['login_id'];
	if(isset($_REQUEST['change_password'])){
		$sql="SELECT * FROM customer WHERE id='$change'";
		$result=mysql_query($sql);
		$rws=  mysql_fetch_array($result);
					
		$salt="@g26jQsG&nh*&#8v";
		$old=  sha1($_REQUEST['old_password'].$salt);
		$new=  sha1($_REQUEST['new_password'].$salt);
		$again=sha1($_REQUEST['again_password'].$salt);
					
		if($rws[9]==$old && $new==$again){
			$sql1="UPDATE customer SET password='$new' WHERE id='$change'";
			mysql_query($sql1) or die(mysql_error());
			header('location:profile?success=1');
		} else {
			header('location:profile?error=1');
		}
	}
?>