<?php 
session_start();
        
if(!isset($_SESSION['staff_login'])) 
    header('location:../staff/');   
?>
<?php
// Selection is made based of the button the staff can press

// Do these steps when card request is approved (by staff)
if(isset($_REQUEST['approve'])) {
    include '../_inc/dbconn.php';
    $id=$_REQUEST['customer_id'];
    
    $sql="SELECT * FROM req_creditcard WHERE id='$id'";
    $result=  mysql_query($sql) or die(mysql_error());
    $rws=  mysql_fetch_array($result);
                
    if($rws[3]=="PENDING")
    $sql="UPDATE req_creditcard SET creditcard_status='ISSUED' WHERE id='$id'";
    mysql_query($sql) or die(mysql_error());
	header("location:requests?creditcard=1");
	
// Do these steps when card request is denied (by staff)
} elseif(isset($_REQUEST['deny'])) {
    include '../_inc/dbconn.php';
    $id=$_REQUEST['customer_id'];
    
    $sql="SELECT * FROM req_creditcard WHERE id='$id'";
    $result=  mysql_query($sql) or die(mysql_error());
    $rws=  mysql_fetch_array($result);
                
    if($rws[3]=="PENDING")
    $sql="UPDATE req_creditcard SET creditcard_status='DENIED' WHERE id='$id'";
    mysql_query($sql) or die(mysql_error());
	header("location:requests?denied=1");
	
// Do these steps when card request is deleted (by staff)
} elseif(isset($_REQUEST['delete'])) {
    include '../_inc/dbconn.php';
    $id=$_REQUEST['customer_id'];
    
    $sql="SELECT * FROM req_creditcard WHERE id='$id'";
    $result=  mysql_query($sql) or die(mysql_error());
    $rws=  mysql_fetch_array($result);         
    if($rws[3]=="PENDING")
	$sql="DELETE FROM req_creditcard WHERE id='$id'";    
    mysql_query($sql) or die(mysql_error());
	header("location:requests?deleted=1");
	
} else {
	header("location:requests?selected=1");
}