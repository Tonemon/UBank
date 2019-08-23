<?php 
    session_start();
        
    if(!isset($_SESSION['session_user_start'])) {
        header('location:index.php');
    }
?>
<?php
	$t_amount = $_REQUEST['transfer_amount'];
	$sender_id = $_SESSION["session_user_id"];
	$reciever_id = $_REQUEST['receiver'];
	
	// select last transaction id in reciever's passbook.
	include '_inc/dbconn.php';
	$sql = "SELECT MAX(transactionid) FROM UBankDAT.passbook".$reciever_id;
	$result = mysql_query($sql) or die(mysql_error());
	$rws = mysql_fetch_array($result);
	$reciever_last_tid = $rws[0];
	
	// select the details in the last row of reciever's passbook.
	$sql = "SELECT * FROM UBankDAT.passbook".$reciever_id." WHERE transactionid='$reciever_last_tid'";
	$result = mysql_query($sql) or die(mysql_error());
	while ($rws = mysql_fetch_array($result)){
		$r_amount = $rws[7];
		$r_name = $rws[2];
		$r_branch = $rws[3];
		$r_ifsc = $rws[4];
    }
    
    // select the last transaction id in the sender's passbook
    $sql = "SELECT MAX(transactionid) FROM UBankDAT.passbook".$sender_id;
    $result = mysql_query($sql) or die(mysql_error());
    $rws = mysql_fetch_array($result);
    $sender_last_tid=$rws[0];
    
    //select the details in the last row of sender's passbook.
    $sql = "SELECT * FROM UBankDAT.passbook".$sender_id." WHERE transactionid='$sender_last_tid'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($rws = mysql_fetch_array($result)) {
		$s_amount = $rws[7];
		$s_name = $rws[2];
		$s_branch = $rws[3];
		$s_ifsc = $rws[4];
    }
    
    $date = date('Y-m-d h:i');
    $s_total = $s_amount-$t_amount; // balance sender after transaction
    
	// check if balance is high enough to make the tranfer
    if($t_amount<1){
        echo '<script>alert("You cannot transfer less than $1");';
        echo 'window.location= "banking";</script>';
    } elseif($s_total<0){
        echo '<script>alert("Your account balance is too low to proceed with this transfer.");';
        echo 'window.location= "banking";</script>';
    } else{ 
        //insert statement into reciever passbook.
        $r_total = $r_amount + $t_amount;
        $sql1 = "INSERT INTO UBankDAT.passbook".$reciever_id." values('','$date','$r_name','$r_branch','$r_ifsc','$t_amount','0','$r_total','Payment from $s_name')";
        mysql_query($sql1) or die(mysql_error());
        
        //insert statement into sender passbook.
        $s_total=$s_amount-$t_amount;
        $sql2="INSERT INTO UBankDAT.passbook".$sender_id." values('','$date','$s_name','$s_branch','$s_ifsc','0','$t_amount','$s_total','Payment to $r_name')";
        mysql_query($sql2) or die(mysql_error());
        
        echo '<script>alert("Transfer Successful.");';
        echo 'window.location = "banking";</script>';
    }
?>