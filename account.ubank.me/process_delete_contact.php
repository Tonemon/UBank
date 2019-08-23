<?php 
session_start();
        
if(!isset($_SESSION['customer_login'])) 
    header('location:index.php');   
?>
<?php
if(isset($_REQUEST['submit_id'])){
	include '_inc/dbconn.php';
	$customer_id=$_REQUEST["customer_id"];
	$sql="DELETE FROM contacts WHERE id='$customer_id'";
	$result=  mysql_query($sql) or die(mysql_error());

	header("location:contacts?deleted=1");
}
?>