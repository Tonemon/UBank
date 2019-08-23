<?php 
	session_start();
	include '_inc/dbconn.php';
		
	if (!isset($_SESSION['session_user_start']))
    header('location:index.php');   
?>
<?php include 'displayinfo.php' ?>

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
	
	<title><?php echo $userdat_name; ?>'s Account Overview | UBank Online Banking</title>
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
			if (isset($_GET['error'])) {
				echo "<div class='alert alert-danger alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i>
					A card request could not be made at this time. Please try again later.</div>";
			} elseif (isset($_GET['request'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Card request successful. We will send you a confirmation soon.</div>";
			}
		  ?>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <div class="card-body-icon">
                    <i class="fas fa-fw fa-user-circle"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-fw fa-user-circle"></i>
				  Personal/Card Details</div>
				<div class="card-body">
					<p>
						<span class="heading">Name: <b></span><?php echo $userdat_name;?></b><br>
						<span class="heading">Email addres: <b></span><?php echo $userdat_email;?></b><br>
						<span class="heading">Home Address: <b></span><?php echo $userdat_address;?></b><br>
						<span class="heading">Mobile: <b></span><?php echo $userdat_mobile;?></b><br>
						<span class="heading">gender: <b></span><?php if($userdat_gender=='M') echo "Male"; else echo "Female";?></b><br>
						<br>
						<span class="heading">Account Type: <b></span><?php if($userdat_acctype=='current') echo "Current"; else echo "Savings"; ?></b> (<i>cannot be changed</i>)<br>
						<span class="heading">Account No: <b></span><?php echo $userdat_id;?></b> (<i>cannot be changed</i>)
					</p>
					<p><i>Please contact us via the <a href="settings">support panel</a> if you want to change/update the information displayed.</i></p>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<div class="col-xl-5 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-money-check-alt"></i>
				  Issue New Card (Master/Visa/Creditcard)</div>
				<div class="card-body">
					<p> If you need a new card, please issue one below and we will send you a new one as soon as possible. The following cards can be issued:
					<i class="fab fa-cc-mastercard"></i> <b>Mastercard</b>, <i class="fas fa-credit-card"></i><b> Creditcard </b>or <i class="fab fa-cc-visa"></i><b> Visa Card</b>.</p>
					<div class="table-responsive">
							<?php
								include '_inc/dbconn.php';
								$requester_id=$_SESSION["session_user_id"];

								// request information for creditcards
								$sql = "SELECT * FROM UBankDAT.req_creditcard WHERE account_no='$requester_id'";
								$result = mysql_query($sql) or die(mysql_error());
								$rws = mysql_fetch_array($result);
								$creditcard_status = $rws[3];
								$creditcard_id = $rws[2];
								$creditcard_date = $rws[4];

								// request information for visacards
								$sql = "SELECT * FROM UBankDAT.req_visacard WHERE account_no='$requester_id'";
								$result = mysql_query($sql) or die(mysql_error());
								$rws = mysql_fetch_array($result);
								$visacard_status = $rws[3];
								$visacard_id = $rws[2];
								$visacard_date = $rws[4];

								// request information for mastercards
								$sql = "SELECT * FROM UBankDAT.req_mastercard WHERE account_no='$requester_id'";
								$result = mysql_query($sql) or die(mysql_error());
								$rws = mysql_fetch_array($result);
								$mastercard_status = $rws[3];
								$mastercard_id = $rws[2];
								$mastercard_date = $rws[4];
								
								if (($creditcard_id == $requester_id) || ($visacard_id == $requester_id) || ($mastercard_id == $requester_id)) {
									echo "<table class='table table-bordered'>";
									echo "<thead>";
									echo "<tr>";
									echo "<th>Available Cards</th>";
									echo "<th>Status</th>";
									echo "<th>Date issued</th>";
									echo "</tr>";
									echo "</thead>";
									
									echo "<tbody>";
									echo "<tr>";
									echo "<td><i class='fab fa-cc-mastercard'></i> Mastercard </td><td>$mastercard_status</td><td>$mastercard_date</td></tr>";
									echo "<td><i class='fas fa-credit-card'></i> Creditcard </td><td>$creditcard_status</td><td>$creditcard_date</td></tr>";
									echo "<td><i class='fab fa-cc-visa'></i> Visa Card </td><td>$visacard_status</td><td>$visacard_date</td></tr>";
									echo "</tr>";
									echo "</tbody>";
									echo "</table>";
								}
							?>
					</div>
					<?php if (($creditcard_status == 'ISSUED') && ($visacard_status == 'ISSUED') && ($mastercard_status == 'ISSUED')) {
						echo "<p><i>All requested cards are issued. If you got any problems or you want to issue another one, please contact your system administrator.</i></p>";
					} else {
						echo "<p><i>Please keep in mind that the deliver time per requested item can be around 14 days. You can issue your cards again when one's status is 'denied'.</i></p>";
					?>
					<form action="process_issue.php" method="POST">
						<table>
							<tr><td>Issue your new: &nbsp;</td><td>
							<select class="form-control" name="card_selection">
								<option value='Mastercard' selected>Mastercard</option>
								<option value='Creditcard'>Creditcard</option>
								<option value='Visacard'>Visa Card</option>
							</select></td></tr>
							<tr><td><input type="submit" class="btn btn-success" name="submitRequest" value="Request"></td><td /></tr>
						</table>
					</form>
					<?php } ?>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>