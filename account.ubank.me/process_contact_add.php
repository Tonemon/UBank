<?php 
session_start();
        
if (!isset($_SESSION['session_user_start'])) 
    header('location:index.php');   
?>
<?php
		// collecting data from current user & form
		$sender_id = $_SESSION["session_user_id"];
		$sender_name = $_SESSION["session_user_name"];
                
		$contact_name = $_REQUEST['contact_name'];
		$contact_accno = $_REQUEST['contact_account_no'];
		$contact_ifsc = $_REQUEST['contact_ifsc_code'];
		$contact_branch = $_REQUEST['contact_branch_select'];
        
		// requesting information to check if already contact connection
		include '_inc/dbconn.php';
		$sql1 = "SELECT * FROM UBankMAIN.contacts WHERE sender_id='$sender_id' AND reciever_id='$contact_accno'";
		$result1 = mysql_query($sql1);
		$rws1 = mysql_fetch_array($result1);
		$check_sender = $rws1[1]; // sender id from contacts database
		$check_receiver = $rws1[3]; // receiver id from contacts database

		// getting information of contact to compare if information correct        
		$sql="SELECT * FROM UBankMAIN.users WHERE id='$contact_accno'";
		$result = mysql_query($sql) or die(mysql_error());
		$rws = mysql_fetch_array($result) ;
                
		// can't send request to yourself 
		if ($sender_id == $rws[0]) { 
			echo '<script>alert("You can\'t add yourself as a contact!");';
			echo 'window.location= "contacts";</script>';
		// can't add the same contact twice
		} elseif ($check_sender == $sender_id && $check_receiver == $contact_accno) { 
			echo '<script>alert("You can\'t add a contact twice!");';
			echo 'window.location= "contacts";</script>';
		// when all contact info is right
		} elseif ($rws[0] == $contact_accno && $rws[1] == $contact_name && $rws[10] == $contact_branch && $rws[11] == $contact_ifsc) { 
			$status = "ACTIVE";
			$sql = "INSERT INTO UBankMAIN.contacts values('','$sender_id','$sender_name','$contact_accno','$contact_name','$status')";
			mysql_query($sql) or die(mysql_error());
			header("location:contacts?success=1");
		// when something is wrong or user not found
		} else { 
			echo '<script>alert("User Not Found!\n Please enter correct details and try again.");';
			echo 'window.location= "contacts";</script>';
		}