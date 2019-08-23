<?php
include '_inc/bank_dbconn.php';

// getting variables to store in table
$firstname=  mysql_real_escape_string($_REQUEST['n_firstname']);
$surname=  mysql_real_escape_string($_REQUEST['n_surname']);
$fullname=  $firstname . ' ' . $surname;

$email= mysql_real_escape_string($_REQUEST['n_email']);
$gender=  mysql_real_escape_string($_REQUEST['n_gender']);
$dob=  mysql_real_escape_string($_REQUEST['n_dob']);
$address=  mysql_real_escape_string($_REQUEST['n_address']);
$phone=  mysql_real_escape_string($_REQUEST['n_phone']);
$type=  mysql_real_escape_string($_REQUEST['n_type']); // type of account: current or savings
$country= mysql_real_escape_string($_REQUEST['n_country']);

$pass1= mysql_real_escape_string($_REQUEST['n_newpass']);
$pass2= mysql_real_escape_string($_REQUEST['n_repeatpass']);

// insert question to table 'customernew'
	if($pass1==$pass2){
		$sql="insert into customernew values('','$fullname','$gender','$dob','$type','$address',
		'$phone','$email','$pass1','$country')";
		mysql_query($sql) or die(header('location:newaccount?error=1'));
		header('location:newaccount?success=1');
	} else {
		header('location:newaccount?password=1');
	}
?>