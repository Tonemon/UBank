<?php 
	session_start();
	if (!isset($_SESSION['session_user_start'])){
		header('location:index');
	}
?>
<?php
	// gather all information from session data
	$userdat_email = $_SESSION['session_user_email'];

	include '_inc/dbconn.php';
	$sql = "SELECT * FROM UBankMAIN.users WHERE email='$userdat_email'";
	$result = mysql_query($sql) or die(mysql_error());
	$res = mysql_fetch_array($result);
	
	// setting all variables
	$userdat_id = $res[0];
	$userdat_name = $res[1];
	$userdat_gender = $res[2];
	$userdat_acctype = $res[4];
	$userdat_address = $res[5];
	$userdat_mobile = $res[6];
	$userdat_branch = $res[10];
	$userdat_branchcode = $res[11];
	$userdat_lastlogin = $res[12];
	$userdat_accstatus = $res[13];
?>

<?php
	if (isset($_REQUEST['transfer_funds'])){ // Transfer funds process
		$t_amount = $_REQUEST['transfer_amount'];
		$sender_id = $_SESSION["session_user_id"];
		$reciever_id = $_REQUEST['receiver'];
		
		// Select last transaction id in reciever's passbook.
		include '_inc/dbconn.php';
		$sql = "SELECT MAX(transactionid) FROM UBankDAT.passbook".$reciever_id;
		$result = mysql_query($sql) or die(mysql_error());
		$rws = mysql_fetch_array($result);
		$reciever_last_tid = $rws[0];
		
		// Select the details in the last row of reciever's passbook.
		$sql = "SELECT * FROM UBankDAT.passbook".$reciever_id." WHERE transactionid='$reciever_last_tid'";
		$result = mysql_query($sql) or die(mysql_error());
		while ($rws = mysql_fetch_array($result)){
			$r_amount = $rws[7];
			$r_name = $rws[2];
			$r_branch = $rws[3];
			$r_ifsc = $rws[4];
	    }
    
	    // Select the last transaction id in the sender's passbook
	    $sql = "SELECT MAX(transactionid) FROM UBankDAT.passbook".$sender_id;
	    $result = mysql_query($sql) or die(mysql_error());
	    $rws = mysql_fetch_array($result);
	    $sender_last_tid = $rws[0];
	    
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
	    
		// Check if balance is high enough to make the tranfer
	    if ($t_amount<1){
	        echo '<script>alert("You cannot transfer less than $1");';
	        echo 'window.location= "banking";</script>';
	    } elseif($s_total<0){
	        echo '<script>alert("Your account balance is too low to proceed with this transfer.");';
	        echo 'window.location= "banking";</script>';
	    } else { 
	        // insert statement into reciever passbook.
	        $r_total = $r_amount + $t_amount;
	        $sql1 = "INSERT INTO UBankDAT.passbook".$reciever_id." values('','$date','$r_name','$r_branch','$r_ifsc','$t_amount','0','$r_total','Payment from $s_name')";
	        mysql_query($sql1) or die(mysql_error());
	        
	        // insert statement into sender passbook.
	        $s_total = $s_amount - $t_amount;
	        $sql2 = "INSERT INTO UBankDAT.passbook".$sender_id." values('','$date','$s_name','$s_branch','$s_ifsc','0','$t_amount','$s_total','Payment to $r_name')";
	        mysql_query($sql2) or die(mysql_error());
	        
	        echo '<script>alert("Transfer Successful.");'; // CHANGE MESSAGE AND URL REDIRECT
	        echo 'window.location = "banking";</script>';
	    }
	} else {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="vendor/img/favicon.png"/>
	<meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS-->
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="vendor/css/sb-admin.css" rel="stylesheet">


    <!-- Page level plugin CSS-->
    <link href="vendor/js/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	
	<title><?php echo $userdat_name; ?>'s Dashboard | UBank Online Banking</title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs 
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol> -->
		  
		  <!-- Cookies -->
		  <?php
				$sql2="SELECT * FROM UBankDAT.passbook$userdat_id";
                $result2=  mysql_query($sql2) or die(mysql_error());
                $res2=  mysql_fetch_array($result2);
				
				if ($res2[7]<=5) {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-hand-holding-usd'></i> <b>Warning</b>:
						Your balance is currently $<b>".$res2[7]."</b>. We recommended you to make a deposit before you start online banking.</div>";
				// show cookie alert on default (and when balance not too low)
				} elseif ($res2[7]>=1000000000) {
					echo "<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> <b>Warning</b>:
						You are almost too <i class='fas fa-money-bill-wave'></i><b> rich </b><i class='fas fa-money-bill-wave'></i> for us to keep your money. Please store a lower amount of money instead of $<b>".$res2[7]."</b>.</div>";
				// show cookie alert on default (and when balance not too low)
				} else {
					echo "<div class='alert alert-info alert-icon-block alert-dismissible' role='alert'>
						<i class='fas fa-fw fa-info-circle'></i>  We use cookies to offer you the best experience on our website. Continuing browsing, you accept our cookie policy.
						<a href='#' class='close' data-dismiss='alert' aria-label='Close'><span class='fa fa-times'></span></a></div>";
				}
			?>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <div class="card-body-icon">
                    <i class="fas fa-user"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-info"></i>
				  General Information</div>
				<div class="card-body">
					<p>
						<span class="heading">Welcome </span><b><?php echo $userdat_name;?></b> (user),<br>
						<span class="heading">Your Last login was on </span><b><?php echo $userdat_lastlogin;?></b>,<br>
						<span class="heading">Your Account status is </span><b><?php echo $userdat_accstatus;?></b> and it's your <b><?php echo $userdat_acctype;?></b> account.
					</p>
					<?php 
					if ($acc_type) {
						echo "<i><p><i class='fas fa-info-circle'></i> Because this is your savings account, your money is stored and not used for loans/other transactions. <a href='http://ubank.me/faq' target='_blank'>Read more</a>.</p></i>";
					} else {
						echo "<i><p><i class='fas fa-info-circle'></i> Give your Card details to the person you are doing business with so he can transfer the funds to you.</p></i>";
					}	?>
				</div>
			  </div>
			</div>
			<div class="col-xl-5 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="far fa-money-bill-alt"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-fighter-jet"></i>
				  Transfer Funds</div>
				<div class="card-body">
				  <div class="table-responsive">
				  <p> To transfer funds to someone you will need to setup your addresbook first. All active accounts in your addresbook will show up below.</p>
					<?php
						include '_inc/dbconn.php';
						$contact_senderid = $_SESSION["session_user_id"];
						$sql3 = "SELECT * FROM UBankMAIN.contacts WHERE sender_id='$contact_senderid' AND status='ACTIVE'";
						$result3 = mysql_query($sql3);
						$res3 = mysql_fetch_array($result3);
						$contact_id = $res3[1];              
					?>
					<?php       
					if($contact_senderid == $contact_id){
						echo "<form action='banking' method='POST'>";
						echo "<table>";
						echo "<tr><td>Select your reciepient: &nbsp;</td><td> <select class='form-control' name='receiver'>";

						$sql4="SELECT * FROM UBankMAIN.contacts WHERE sender_id='$contact_senderid' AND status='ACTIVE'";
						$result4 = mysql_query($sql4);
							
						while ($res4 = mysql_fetch_array($result4)) {
							echo "<option value='$res4[3]'>$res4[4]</option>";
						}
						
						echo "</td></tr></select>";
						echo "<tr><td>Enter Amount: </td><td><input class='form-control' type='number' name='transfer_amount' placeholder='Amount (in $)' required></td></table>";
						echo "<table><tr><td style='padding:5px;'><button class='btn btn-success' type='submit' class='btn' name='transfer_funds'>Transfer Funds <i class='fas fa-paper-plane'></i></button>
						</td></tr></table></form>"; 
					} else {
						echo "<i><p>You have no active contacts on this account. Please goto your <a href='contacts'>contacts</a> to make a transaction.</p></i>";
					}
					?>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-xl-3 mb-6">
			  <div class="card o-hidden mb-3" id="details">
				<div class="card-header">
				  <i class="fas fa-money-bill-alt"></i>
				  Card Details</div>
				<div class="card-body-icon">
                    <i class="fas fa-fw fa-credit-card"></i>
                </div>
				<div class="card-body">
				  <?php
						$sql4 = "SELECT * FROM UBankDAT.passbook".$_SESSION['session_user_id'] ;
						$result4 = mysql_query($sql4) or die(mysql_error());
						while ($res4 = mysql_fetch_array($result4)) {
							$user_balance = $res4[7];
						}            
					?>
					<span class="heading">Current Balance: $</span><b><?php echo $user_balance;?></b><br><br>
					<span class="heading">Official Names: </span><b><?php echo $userdat_name;?></b><br>
					<span class="heading">Ifsc Code: </span><b><?php echo $userdat_branchcode;?></b><br>
					<span class="heading">Country: </span><b><?php echo $userdat_branch;?></b><br>
					<span class="heading">Your Account No: </span><b><?php echo $userdat_id;?></b>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->

          <!-- Area Chart Example
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated today at</div>
          </div> -->

          <div class="card mb-3" id="activity">
            <div class="card-header">
              <i class="fas fa-chart-line"></i>
              Recent Activity/Transactions</div>
            <div class="card-body">
			<?php include '_inc/dbconn.php';
				$sql = "SELECT * FROM UBankDAT.passbook".$_SESSION['session_user_id'];
				$result = mysql_query($sql) or die(mysql_error()); 
			?>		
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Description</th>
                      <th>Credit (deposited)</th>
                      <th>Debit (withdrawn/transfered)</th>
                      <th>Balance after</th>
					  <th>Transaction Date</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
                        while($rws = mysql_fetch_array($result)){
                            
                            echo "<tr>";
                            echo "<td>".$rws[0]."</td>";
                            echo "<td>".$rws[8]."</td>";
                            echo "<td> $".$rws[5]."</td>";
                            echo "<td> $".$rws[6]."</td>";
                            echo "<td> $".$rws[7]."</td>";
							echo "<td>".$rws[1]."</td>";
                           
                            echo "</tr>";
                        } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></div>
          </div>

        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>

<?php } ?>