<?php 
session_start();
        
if(!isset($_SESSION['staff_login'])) 
    header('location:../staff/');   
?>
<?php
$id=$_REQUEST['customer_id'];

if(isset($_REQUEST['approve'])){
    include '../_inc/dbconn.php';
    $sql="UPDATE contacts SET status='ACTIVE' WHERE id='$id'";
    mysql_query($sql) or die(mysql_error());
	header("location:requests?approved=1");
	
} if(isset($_REQUEST['delete'])){
    include '../_inc/dbconn.php';
    $sql="DELETE FROM contacts WHERE id='$id'";
    mysql_query($sql) or die(mysql_error());
	header("location:requests?deleted=1");
	
} else {
	header("location:requests?notask=1");
}