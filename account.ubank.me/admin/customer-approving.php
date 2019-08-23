<?php 
session_start();
        
if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>
<?php
include '../_inc/dbconn.php';
// use id from table to select right user from customernew table
$newid=  mysql_real_escape_string($_REQUEST['newcustomer_id']);

// Do this when a 'new customer' request is approved
if(isset($_REQUEST['approvenew'])){
	$sql="SELECT * FROM customernew WHERE id=$newid";
	$result=  mysql_query($sql) or die(mysql_error());
	$rws=  mysql_fetch_array($result);

	$name=  $rws[1];
	$gender=  $rws[2];
	$dob=  $rws[3];
	$nominee= "Homepage";
	$type=  $rws[4];
	$address=  $rws[5];
	$mobile=  $rws[6];
	$email= $rws[7];

	//salting of password for encryption
	$salt="@g26jQsG&nh*&#8v";
	$password= sha1($rws[8].$salt);

	// adding Ifsc code with earlier selected country/branch (two numbers are random generated to make Ifsc almost unique)
	$branch= $rws[9];
	$date=date("Y-m-d");
	$specialchar=rand(1,9);
	$specialchar2=rand(1,9);
	switch($branch){
	case 'United States': $ifsc="US".$specialchar.$specialchar2."K";
		break;
	case 'United Kingdom': $ifsc="UK".$specialchar.$specialchar2."C";
		break;
	case 'Netherlands': $ifsc="NL".$specialchar.$specialchar2."E";
		break;
	}

	// insert new customer to table 'customer'
	$sql="insert into customer values('','$name','$gender','$dob','$nominee','$type','$address','$mobile',
		'$email','$password','$branch','$ifsc','','ACTIVE')";
	mysql_query($sql) or die("Email already exists!");

	// getting customer id of the new customer created earlier and making a passbook.#id# table with customer id
	$sql2="SELECT * FROM customer WHERE name='$name'";
	$result=mysql_query($sql2) or die(mysql_error());
	$rws=  mysql_fetch_array($result);

	$id=$rws[0];
	$insert_branch=$rws[10];
	$insert_ifsc=$rws[11];

	$sql1="CREATE TABLE passbook".$id." 
		(transactionid int(5) AUTO_INCREMENT, transactiondate date, name VARCHAR(255), branch VARCHAR(255), ifsc VARCHAR(255), credit int(10), debit int(10), 
		amount float(10,2), narration VARCHAR(255), PRIMARY KEY (transactionid))";
	mysql_query($sql1) or die(mysql_error());

	// inserting a record with earlier info in customer's passbook
	$sql4="insert into passbook".$id." values('','$date','$name','$insert_branch','$insert_ifsc','0','0','0','Account Open')";
	mysql_query($sql4) or die(mysql_error());

	// removing the account request record in the customernew table
	$sql_delete1="DELETE FROM customernew WHERE `id` = '$newid'";
	mysql_query($sql_delete1) or die(mysql_error());
	header('location:customer?add=1');

// Do this when a 'new customer' request is deleted
} elseif(isset($_REQUEST['deletenew'])){
	$sql_delete2="DELETE FROM customernew WHERE `id` = '$newid'";
	mysql_query($sql_delete2) or die(mysql_error());
	header('location:customer?deleted=1');
	
} else {
	header("location:questions?error=1");
}
?>