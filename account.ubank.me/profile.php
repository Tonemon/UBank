<?php 
session_start();
include '_inc/dbconn.php';
		
if(!isset($_SESSION['customer_login'])) 
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
	
	<title>My Account | UBank</title>
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
					<?php
						$cust_id=$_SESSION['cust_id'];
						include '_inc/dbconn.php';
						$sql="SELECT * FROM customer WHERE email='$cust_id'";
						$result=  mysql_query($sql) or die(mysql_error());
						$rws=  mysql_fetch_array($result);
						
						$name= $rws[1];
						$account_no= $rws[0];
						$dob=$rws[3];
						$nominee=$rws[4];
						$branch=$rws[10];
						$branch_code= $rws[11];
						
						$gender=$rws[2];
						$mobile=$rws[7];
						$email=$rws[8];
						$address=$rws[6];
						
						$last_login= $rws[12];
						
						$acc_status=$rws[13];
						$acc_type=$rws[5];				
					?>
					<p>
						<span class="heading">Name: <b></span><?php echo $name;?></b><br>
						<span class="heading">Email addres: <b></span><?php echo $email;?></b><br>
						<span class="heading">Home Address: <b></span><?php echo $address;?></b><br>
						<span class="heading">Mobile: <b></span><?php echo $mobile;?></b><br>
						<span class="heading">gender: <b></span><?php if($gender=='M') echo "Male"; else echo "Female";?></b><br>
						<br>
						<span class="heading">Account Type: <b></span><?php if($acc_type=='current') echo "Current"; else echo "Savings"; ?></b> (<i>cannot be changed</i>)<br>
						<span class="heading">Account No: <b></span><?php echo $account_no;?></b> (<i>cannot be changed</i>)
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
								$sender_id=$_SESSION["login_id"];
								$sql="SELECT * FROM req_creditcard WHERE account_no='$sender_id'";
								$result=mysql_query($sql) or die(mysql_error());
								$rws=mysql_fetch_array($result);
								$creditcard_status=$rws[3];
								$creditcard_id=$rws[2];
								
								$sql="SELECT * FROM req_visacard WHERE account_no='$sender_id'";
								$result=mysql_query($sql) or die(mysql_error());
								$rws=mysql_fetch_array($result);
								$visacard_status=$rws[3];
								$visacard_id=$rws[2];
								
								$sql="SELECT * FROM req_mastercard WHERE account_no='$sender_id'";
								$result=mysql_query($sql) or die(mysql_error());
								$rws=mysql_fetch_array($result);
								$mastercard_status=$rws[3];
								$mastercard_id=$rws[2];
								
								if(($creditcard_id==$sender_id) || ($visacard_id==$sender_id) || ($mastercard_id==$sender_id)) {
									echo "<table class='table table-bordered'>";
									echo "<thead>";
									echo "<tr>";
									echo "<th>Requested Card</th>";
									echo "<th>Status</th>";
									echo "</tr>";
									echo "</thead>";
									
									echo "<tbody>";
									echo "<tr>";
									echo "<td><i class='fab fa-cc-mastercard'></i> Mastercard </td><td>$mastercard_status</td></tr>";
									echo "<td><i class='fas fa-credit-card'></i> Creditcard </td><td>$creditcard_status</td></tr>";
									echo "<td><i class='fab fa-cc-visa'></i> Visa Card </td><td>$visacard_status</td></tr>";
									echo "</tr>";
									echo "</tbody>";
									echo "</table>";
								}
							?>
					</div>
					<?php if (($creditcard_status == 'ISSUED') && ($visacard_status == 'ISSUED') && ($mastercard_status == 'ISSUED')) {
						echo "<p><i>All requested cards are issued. If you got any problems, please contact your system administrator.</i></p>";
					} else {
						echo "<p><i>Please keep in mind that the deliver time per item can be around 14 days.</i></p>";
					} ?>
					<form action="process_issue.php" method="POST">
						<table>
							<tr><td>Issue your new: 
							<select name="selection">
								<option value='Mastercard' selected>Mastercard</option>
								<option value='Creditcard'>Creditcard</option>
								<option value='Visacard'>Visa Card</option>
							</select></td></tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="submitBtn" value="Request">
						</table>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>