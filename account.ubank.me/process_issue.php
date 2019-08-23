<?php 
session_start();
        
if(!isset($_SESSION['customer_login'])) 
    header('location:index.php');   
?>
<?php
include '_inc/dbconn.php';
$name=$_SESSION['name'];
$account_no=$_SESSION['login_id'];
$option=$_REQUEST['selection'];

// set the status first to "NOT REQUESTED"
$creditcard_status = $visacard_status = $mastercard_status = "NOT REQUESTED";

// set different variables for every card type that can be requested 
if($option=='Creditcard'){
    $creditcard_status="PENDING";
	
	$sql="SELECT * FROM req_creditcard WHERE account_no='$account_no'";
    $result=mysql_query($sql) or die(mysql_error());
    $rws=mysql_fetch_array($result);
    $credit_status=$rws[3];
	$credit_name=$rws[1];
    $credit_id=$rws[2];
	
} elseif ($option=='Visacard') {
    $visacard_status="PENDING";
    
    $sql="SELECT * FROM req_visacard WHERE account_no='$account_no'";
    $result=mysql_query($sql) or die(mysql_error());
    $rws=mysql_fetch_array($result);
    $visa_status=$rws[3];
	$visa_name=$rws[1];
    $visa_id=$rws[2];
	
} else {
    $mastercard_status="PENDING";
    
    $sql="SELECT * FROM req_mastercard WHERE account_no='$account_no'";
    $result=mysql_query($sql) or die(mysql_error());
    $rws=mysql_fetch_array($result);
    $master_status=$rws[3];
    $master_name=$rws[1];
    $master_id=$rws[2];
}

// Actual card issueing process!

// check first if another request of the same type of card was made earlier (with status "PENDING" or "ISSUED")
if(($option=='Creditcard' && (($credit_status=='PENDING')||($credit_status=='ISSUED'))) || ($option=='Visacard' && (($visa_status=='PENDING')||($visa_status=='ISSUED'))) || ($option=='Mastercard' && (($master_status=='PENDING')||($master_status=='ISSUED')))){
	echo '<script>alert("You have already made that request!");';
	echo 'window.location= "profile";</script>';
	
// Do these steps if a creditcard is chosen (and no earlier requests of this type were made)
} elseif($option=='Creditcard'){
	if ($credit_name==$name|| $credit_id==$account_no){ 
		// make status 'PENDING' when status is 'DENIED' (simply let the user request card a second time)
		$sql="UPDATE req_creditcard SET creditcard_status='PENDING' WHERE account_no='$account_no'";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
	} else {
		// if there was no card previous with status 'PENDING' make the new request and set it to 'PENDING'
		$sql="insert into req_creditcard values('','$name','$account_no','$creditcard_status')";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
	}
	
// Do these steps if a visacard is chosen (and no earlier requests of this type were made)
} elseif($option=='Visacard'){
	if ($visa_name==$name|| $visa_id==$account_no){
		// make status 'PENDING' when status is 'DENIED' (simply let the user request card a second time)
		$sql="UPDATE req_visacard SET visacard_status='PENDING' WHERE account_no='$account_no'";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
	} else {
		// if there was no card previous with status 'PENDING' make the new request and set it to 'PENDING'
		$sql="insert into req_visacard values('','$name','$account_no','$visacard_status')";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
	}
	
// Do these steps if a visacard is chosen (and no earlier requests of this type were made)
} else {
	if ($master_name==$name|| $master_id==$account_no){
		// make status 'PENDING' when status is 'DENIED' (simply let the user request card a second time)
		$sql="UPDATE req_mastercard SET mastercard_status='PENDING' WHERE account_no='$account_no'";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
	} else {
		// if there was no card previous with status 'PENDING' make the new request and set it to 'PENDING'
		$sql="insert into req_mastercard values('','$name','$account_no','$mastercard_status')";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
		
	}
	
}
?>