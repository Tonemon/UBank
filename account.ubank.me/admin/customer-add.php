<?php 
session_start();
        
if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>
<?php
include '../_inc/dbconn.php';
$name=  mysql_real_escape_string($_REQUEST['customer_name']);
$gender=  mysql_real_escape_string($_REQUEST['customer_gender']);
$dob=  mysql_real_escape_string($_REQUEST['customer_dob']);
$nominee=  mysql_real_escape_string($_REQUEST['customer_nominee']);
$type=  mysql_real_escape_string($_REQUEST['customer_account']);
$credit=  mysql_real_escape_string($_REQUEST['initial']);
$address=  mysql_real_escape_string($_REQUEST['customer_address']);
$mobile=  mysql_real_escape_string($_REQUEST['customer_mobile']);
$email= mysql_real_escape_string($_REQUEST['customer_email']);

//salting of password for encryption
$salt="@g26jQsG&nh*&#8v";
$password= sha1($_REQUEST['customer_pwd'].$salt);

// adding Ifsc code with earlier selected country/branch (two numbers are random generated to make Ifsc almost unique)
$branch=  mysql_real_escape_string($_REQUEST['branch']);
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
$sql4="insert into passbook".$id." values('','$date','$name','$insert_branch','$insert_ifsc','$credit','0','$credit','Account Open')";
mysql_query($sql4) or die(mysql_error());
header('location:customer?add=1');
?>