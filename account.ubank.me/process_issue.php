<?php 
session_start();
        
if(!isset($_SESSION['session_user_start'])) 
    header('location:index.php');   
?>
<?php
include '_inc/dbconn.php';
$req_name = $_SESSION['session_user_name'];
$req_accountno = $_SESSION['session_user_id'];
$option = $_REQUEST['card_selection'];
$req_date = date("Y-m-d");

// set the status first to "NOT REQUESTED"
$creditcard_status = $visacard_status = $mastercard_status = "NOT REQUESTED";

// set different variables for every card type that can be requested 
if ($option == 'Creditcard'){
    $creditcard_status = "PENDING";
	
	$sql = "SELECT * FROM UBankDAT.req_creditcard WHERE account_no='$req_accountno'";
    $result = mysql_query($sql) or die(mysql_error());
    $rws = mysql_fetch_array($result);
	$credit_name = $rws[1];
    $credit_id = $rws[2];
    $credit_status = $rws[3];
	
} elseif ($option == 'Visacard') {
    $visacard_status = "PENDING";
    
    $sql = "SELECT * FROM UBankDAT.req_visacard WHERE account_no='$req_accountno'";
    $result = mysql_query($sql) or die(mysql_error());
    $rws = mysql_fetch_array($result);
	$visa_name = $rws[1];
    $visa_id = $rws[2];
    $visa_status = $rws[3];
	
} else {
    $mastercard_status = "PENDING";
    
    $sql = "SELECT * FROM UBankDAT.req_mastercard WHERE account_no='$req_accountno'";
    $result = mysql_query($sql) or die(mysql_error());
    $rws = mysql_fetch_array($result);
    $master_name = $rws[1];
    $master_id = $rws[2];
    $master_status = $rws[3];
}

// Actual card issueing process!

// check first if another request of the same type of card was made earlier (with status "PENDING" or "ISSUED")
if (($option == 'Creditcard' && (($credit_status == 'PENDING')||($credit_status == 'ISSUED'))) || ($option == 'Visacard' && (($visa_status == 'PENDING')||($visa_status == 'ISSUED'))) || ($option == 'Mastercard' && (($master_status == 'PENDING')||($master_status == 'ISSUED')))) {
	echo '<script>alert("You have already made that request!");';
	echo 'window.location= "profile";</script>';
	
// Do these steps if a creditcard is chosen (and no earlier requests of this type were made)
} elseif ($option == 'Creditcard'){
	if ($credit_name == $req_name|| $credit_id == $req_accountno){ 
		// make status 'PENDING' when status is 'DENIED' and update request date (simply let the user request card a second time)
		$sql = "UPDATE UBankDAT.req_creditcard SET creditcard_status='PENDING' WHERE account_no='$req_accountno'";
		mysql_query($sql) or die(mysql_error());
		$sql2 = "UPDATE UBankDAT.req_creditcard SET creditcard_date='$req_date' WHERE account_no='$req_accountno'";
		mysql_query($sql2) or die(mysql_error());

		header("location:profile?request=1");
	} else {
		// if there was no card previous with status 'PENDING' make the new request and set it to 'PENDING'
		$sql = "INSERT INTO UBankDAT.req_creditcard values('','$req_name','$req_accountno','$creditcard_status','$req_date')";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
	}
	
// Do these steps if a visacard is chosen (and no earlier requests of this type were made)
} elseif ($option == 'Visacard'){
	if ($visa_name == $req_name|| $visa_id == $req_accountno){
		// make status 'PENDING' when status is 'DENIED' and update request date (simply let the user request card a second time)
		$sql = "UPDATE UBankDAT.req_visacard SET visacard_status='PENDING' WHERE account_no='$req_accountno'";
		mysql_query($sql) or die(mysql_error());
		$sql2 = "UPDATE UBankDAT.req_visacard SET visacard_date='$req_date' WHERE account_no='$req_accountno'";
		mysql_query($sql2) or die(mysql_error());

		header("location:profile?request=1");
	} else {
		// if there was no card previous with status 'PENDING' make the new request and set it to 'PENDING'
		$sql = "INSERT INTO UBankDAT.req_visacard values('','$req_name','$req_accountno','$visacard_status','$req_date')";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
	}
	
// Do these steps if a mastercard is chosen (and no earlier requests of this type were made)
} else {
	if ($master_name == $req_name|| $master_id == $req_accountno){
		// make status 'PENDING' when status is 'DENIED' and update request date (simply let the user request card a second time)
		$sql = "UPDATE UBankDAT.req_mastercard SET mastercard_status='PENDING' WHERE account_no='$req_accountno'";
		mysql_query($sql) or die(mysql_error());
		$sql2 = "UPDATE UBankDAT.req_mastercard SET mastercard_date='$req_date' WHERE account_no='$req_accountno'";
		mysql_query($sql2) or die(mysql_error());

		header("location:profile?request=1");
	} else {
		// if there was no card previous with status 'PENDING' make the new request and set it to 'PENDING'
		$sql = "INSERT INTO UBankDAT.req_mastercard values('','$req_name','$req_accountno','$mastercard_status','$req_date')";
		mysql_query($sql) or die(mysql_error());
		header("location:profile?request=1");
	}
}
?>