<?php 
session_start();
        
if(!isset($_SESSION['customer_login'])) 
    header('location:index.php');   
?>
<?php
		$sender_id=$_SESSION["login_id"];
		$sender_name=$_SESSION["name"];
                
		$Payee_name=$_REQUEST['name'];
		$acc_no=$_REQUEST['account_no'];
		$branch=$_REQUEST['branch_select'];
		$ifsc=$_REQUEST['ifsc_code'];
                
		include '_inc/dbconn.php';
		$sql1="SELECT * FROM contacts WHERE sender_id='$sender_id' AND reciever_id='$acc_no'";
		$result1=  mysql_query($sql1);
		$rws1=  mysql_fetch_array($result1);
		$s1=$rws1[1];
		$s2=$rws1[3];
                
		$sql="SELECT * FROM customer WHERE id='$acc_no'";
		$result=  mysql_query($sql) or die(mysql_error());
		$rws=  mysql_fetch_array($result) ;
                
		// can't send request to yourself 
		if($sender_id==$rws[0]) { 
			echo '<script>alert("You can\'t add yourself as a contact!");';
			echo 'window.location= "contacts";</script>';
		// can't add the same contact twice
		} elseif($s1==$sender_id && $s2==$acc_no) { 
			echo '<script>alert("You can\'t add a contact twice!");';
			echo 'window.location= "contacts";</script>';
		// when all contact info is right
		} elseif($rws[0]==$acc_no && $rws[1]==$Payee_name && $rws[10]==$branch && $rws[11]==$ifsc) { 
			$status="PENDING";
			$sql="INSERT INTO UBankMAIN.contacts values('','$sender_id','$sender_name','$acc_no','$Payee_name','$status')";
			mysql_query($sql) or die(mysql_error());
			header("location:contacts?success=1");
		// when something is wrong or user not found
		} else { 
			echo '<script>alert("User Not Found!\n Please enter correct details and try again.");';
			echo 'window.location= "contacts";</script>';
		}