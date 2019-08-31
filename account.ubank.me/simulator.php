<?php 
	session_start();
	if (!isset($_SESSION['session_user_start'])){
		header('location:index');
	}
?>
<?php include 'displayinfo.php' ?>

<?php
	if (isset($_REQUEST['simulate_process'])){ // Deposit funds process
		$actionid = $_SESSION['session_user_id'];
		$sim_action = mysql_real_escape_string($_REQUEST['sim_action']);
		$sim_amount = mysql_real_escape_string($_REQUEST['sim_amount']);
		$date = date('Y-m-d h:i');

		$sql = "SELECT * FROM UBankMAIN.users WHERE id='$actionid'";
		$result = mysql_query($sql);
		$rws = mysql_fetch_array($result);

		// Select the last transaction id in the sender's passbook
	    $sql1 = "SELECT MAX(transactionid) FROM UBankDAT.passbook".$actionid;
	    $result1 = mysql_query($sql1) or die(mysql_error());
	    $rws1 = mysql_fetch_array($result1);
	    $sim_last_id = $rws1[0];
	    
	    //select the details in the last row of sender's passbook.
	    $sql2 = "SELECT * FROM UBankDAT.passbook".$actionid." WHERE transactionid='$sim_last_id'";
	    $result2 = mysql_query($sql2) or die(mysql_error());
	    while ($rws2 = mysql_fetch_array($result2)) {
			$s_amount = $rws2[7];
	    }

		if ($sim_action == "Withdraw"){ // Withdraw process
			$sim_total = $s_amount-$sim_amount; // balance after withdraw
			$sql1 = "INSERT INTO UBankDAT.passbook".$actionid." values('','$date','$rws[1]','$rws[10]','$rws[11]','0','$sim_amount','$sim_total','Withdraw from $rws[1]\'s account.')";
	        mysql_query($sql1) or die(header('location:simulator?error=1'));
	        header('location:simulator?success=2');

		} else { // Deposit process
			$sim_total = $s_amount+$sim_amount; // balance after deposit
			$sql2 = "INSERT INTO UBankDAT.passbook".$actionid." values('','$date','$rws[1]','$rws[10]','$rws[11]','$sim_amount','0','$sim_total','Deposit to $rws[1]\'s account.')";
	        mysql_query($sql2) or die(header('location:simulator?error=1'));
	        header('location:simulator?success=1');

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
	
	<title>ATM Simulator | UBank Online Banking</title>
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
		  
		  <?php
				if ($_GET['success'] == "1") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Deposit successfull. Please wait a second for the system to process the request.</div>";
				} elseif ($_GET['success'] == "2") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Withdraw successfull. Please wait a second for the system to process the request.</div>";
				} elseif ($_GET['error'] == "1") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Something went wrong. Please try again.</div>";
				}
			?>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-5 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="fas fa-funnel-dollar"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-funnel-dollar"></i>
				  ATM Simulator</div>
				<div class="card-body">
					<div class="table-responsive">
					<p> Because there is no real way to test the deposit/withdraw feature on this system, you can fake a deposit/withdraw here. After filling in the form below, the amount will be added to your account.</p>
					<form action="simulator" method="POST">
						<table>
							<tr>
								<td>Action to perform: &nbsp;</td>
								<td>
									<select class="form-control" name="sim_action" required="required">
										<option value="">Select...</option>
										<option value="Withdraw">Withdraw</option>
										<option value="Deposit">Deposit</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Enter Amount:</td>
								<td><input class="form-control" type="number" name="sim_amount" placeholder="Amount (in $)" required="required" /></td>
							</tr>
						</table><br>
						<button type="submit" class="btn btn-success" name="simulate_process"><i class="fas fa-play"></i> Simulate ATM transaction</button>
					</form>
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
					<span class="heading">Name on Card: </span><b><?php echo $userdat_name;?></b><br>
					<span class="heading">Ifsc Code: </span><b><?php echo $userdat_branchcode;?></b><br>
					<span class="heading">Country: </span><b><?php echo $userdat_branch;?></b><br>
					<span class="heading">Your Account No: </span><b><?php echo $userdat_id;?></b>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>

<?php } ?>