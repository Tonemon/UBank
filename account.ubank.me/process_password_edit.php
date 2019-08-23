<?php 
session_start();
include '_inc/dbconn.php';
		
if(!isset($_SESSION['session_user_start'])) 
    header('location:index.php');   
?>

<?php include 'displayinfo.php' ?>

<?php
	$changeid = $_SESSION['session_user_id'];
	if (isset($_REQUEST['change_password'])){
		$sql = "SELECT * FROM UBankMAIN.users WHERE id='$changeid'";
		$result = mysql_query($sql);
		$rws = mysql_fetch_array($result);
					
		$salt = "@g26jQsG&nh*&#8v";
		$old = sha1($_REQUEST['old_password'].$salt);
		$new = sha1($_REQUEST['new_password'].$salt);
		$again = sha1($_REQUEST['again_password'].$salt);
					
		if ($rws[8] == $old && $new == $again){
			$sql1 = "UPDATE UBankMAIN.users SET password='$new' WHERE id='$changeid'";
			mysql_query($sql1) or die(mysql_error());

			session_destroy(); // destroying session to let the user login again using new password
			header('location:index?password=1');
		} else {
			header('location:settings?error=1');
		}
	}
?>