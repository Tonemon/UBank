<?php 
session_start();
include '../_inc/dbconn.php';
        
if(!isset($_SESSION['staff_login'])) 
    header('location:../staff/');

// get staff name from session
$reviewer=$_SESSION['name1'];
$id=$_REQUEST['question_id'];
include '../_inc/question_dbconn.php';

if(isset($_REQUEST['q_done'])){
    $sql1="UPDATE questions SET status='REVIEWED' WHERE id='$id'";
    mysql_query($sql1) or die(mysql_error());
	$sql2="UPDATE questions SET readby='$reviewer' WHERE id='$id'";
    mysql_query($sql2) or die(mysql_error());
	header("location:questions?done=1");
	
} elseif(isset($_REQUEST['q_doing'])){
	$sql1="UPDATE questions SET status='DOING' WHERE id='$id'";
    mysql_query($sql1) or die(mysql_error());
	$sql2="UPDATE questions SET readby='$reviewer' WHERE id='$id'";
    mysql_query($sql2) or die(mysql_error());
	header("location:questions?doing=1");
	
} elseif(isset($_REQUEST['q_delete'])){
	$sql="DELETE FROM questions WHERE id='$id'";
	mysql_query($sql) or die(mysql_error());
	header("location:questions?deleted=1");
	
} elseif(isset($_REQUEST['q_review'])){
    $sql="UPDATE questions SET status='TO REVIEW' WHERE id='$id'";
    mysql_query($sql) or die(mysql_error());
	$sql="UPDATE questions SET readby='' WHERE id='$id'";
    mysql_query($sql) or die(mysql_error());
	header("location:questions?review=1");
	
} else {
	header("location:questions?error=1");
}

?>