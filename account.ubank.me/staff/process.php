<?php 
session_start();
include '../_inc/dbconn.php';
include 'displayinfo.php';

if( !isset($_SESSION['session_staff_start'])) 
    header('location:../staff/');   
?>
<?php
// CONTACT PROCESS
	// Approve Contact Request
	if (isset($_REQUEST['contact_approve'])){
		$id = $_REQUEST['contact_id'];

    	$sql = "UPDATE UBankMAIN.contacts SET status='ACTIVE' WHERE id='$id'";
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?contacts&success=1");
		
	// Delete contact request
	} elseif (isset($_REQUEST['contact_delete'])){
		$id = $_REQUEST['contact_id'];

    	$sql="DELETE FROM UBankMAIN.contacts WHERE id='$id'";
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?contacts&success=3");

// MASTERCARD PROCESS
	// Approve Mastercard request
	} elseif (isset($_REQUEST['mastercard_approve'])){
    	$id = $_REQUEST['mastercard_id'];
                
    	$sql = "UPDATE UBankDAT.req_mastercard SET mastercard_status='ISSUED' WHERE id='$id'";
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?mastercard&success=1");
	
	// Deny Mastercard request
	} elseif (isset($_REQUEST['mastercard_deny'])){
		$id = $_REQUEST['mastercard_id'];

    	$sql = "UPDATE UBankDAT.req_mastercard SET mastercard_status='DENIED' WHERE id='$id'";
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?mastercard&success=2");

	// Delete Mastercard request
	} elseif (isset($_REQUEST['mastercard_delete'])){
		$id = $_REQUEST['mastercard_id'];

		$sql="DELETE FROM UBankDAT.req_mastercard WHERE id='$id'";    
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?mastercard&success=3");

// CREDITCARD PROCESS
	// Approve Creditcard request
	} elseif (isset($_REQUEST['creditcard_approve'])){
    	$id = $_REQUEST['creditcard_id'];
                
    	$sql = "UPDATE UBankDAT.req_creditcard SET creditcard_status='ISSUED' WHERE id='$id'";
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?creditcard&success=1");
	
	// Deny Creditcard request
	} elseif (isset($_REQUEST['creditcard_deny'])){
		$id = $_REQUEST['creditcard_id'];

    	$sql = "UPDATE UBankDAT.req_creditcard SET creditcard_status='DENIED' WHERE id='$id'";
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?creditcard&success=2");

	// Delete Creditcard request
	} elseif (isset($_REQUEST['creditcard_delete'])){
		$id = $_REQUEST['creditcard_id'];

		$sql="DELETE FROM UBankDAT.req_creditcard WHERE id='$id'";    
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?creditcard&success=3");

// VISACARD PROCESS
	// Approve Visacard request
	} elseif (isset($_REQUEST['visacard_approve'])){
    	$id = $_REQUEST['visacard_id'];
                
    	$sql = "UPDATE UBankDAT.req_visacard SET visacard_status='ISSUED' WHERE id='$id'";
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?visacard&success=1");
	
	// Deny Visacard request
	} elseif (isset($_REQUEST['visacard_deny'])){
		$id = $_REQUEST['visacard_id'];

    	$sql = "UPDATE UBankDAT.req_visacard SET visacard_status='DENIED' WHERE id='$id'";
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?visacard&success=2");

	// Delete Visacard request
	} elseif (isset($_REQUEST['visacard_delete'])){
		$id = $_REQUEST['visacard_id'];

		$sql="DELETE FROM UBankDAT.req_visacard WHERE id='$id'";    
    	mysql_query($sql) or die(mysql_error());
		header("location:requests?visacard&success=3");

// QUESTIONS PROCESS
	// Mark Question as 'Done'
	} elseif (isset($_REQUEST['question_done'])){
		$reviewer = $staffdat_name; // staffdat_name is a variable from displayinfo.php linked at the top
		$id = $_REQUEST['question_id'];
                
    	$sql1 = "UPDATE UBankDAT.questions SET status='REVIEWED', readby='$reviewer' WHERE id='$id'";
    	mysql_query($sql1) or die(mysql_error());
		header("location:questions?reviewed&success=1"); // CHANGE URL
	
	// Mark Question as 'Doing'
	} elseif (isset($_REQUEST['question_doing'])){
		$reviewer = $staffdat_name;
		$id = $_REQUEST['question_id'];
                
    	$sql1 = "UPDATE UBankDAT.questions SET status='DOING', readby='$reviewer' WHERE id='$id'";
    	mysql_query($sql1) or die(mysql_error());
		header("location:questions?review&success=2"); // CHANGE URL

	// Mark Question as 'To Review'
	} elseif (isset($_REQUEST['question_review'])){
		$id = $_REQUEST['question_id'];
                
    	$sql1 = "UPDATE UBankDAT.questions SET status='TO REVIEW', readby='' WHERE id='$id'";
    	mysql_query($sql1) or die(mysql_error());
		header("location:questions?review&success=3"); // CHANGE URL

	// Delete Question from the list
	} elseif (isset($_REQUEST['question_delete'])){
		$id = $_REQUEST['question_id'];
                
    	$sql="DELETE FROM UBankDAT.questions WHERE id='$id'";
		mysql_query($sql) or die(mysql_error());
		header("location:questions?reviewed&success=4"); // CHANGE URL
		
	} else { // throw an error
		header("location:requests?overview&error=1");
	}
?>