<?php 
session_start();
        
if (!isset($_SESSION['session_user_start'])) 
    header('location:index.php');   
?>
<?php
if (isset($_REQUEST['contact_delete'])) {

	// collecting data from current user & form
	$sender_id = $_SESSION["session_user_id"];
	$sender_name = $_SESSION["session_user_name"];
	
	include '_inc/dbconn.php';
	$queryid = $_REQUEST["contact_id"];

	// added more statements to make the deletion more precise
	$sql = "DELETE FROM UBankMAIN.contacts WHERE id='$queryid' AND sender_id='$sender_id' AND sender_name='$sender_name'";
	$result = mysql_query($sql) or die(mysql_error());
	
	header("location:contacts?deleted=1");
}
?>