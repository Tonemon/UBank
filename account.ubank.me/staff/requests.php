<?php 
	session_start();
	if (!isset($_SESSION['session_staff_start'])) 
    	header('location:../staff/');
?>
<?php include 'displayinfo.php' ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="../vendor/img/favicon.png"/>
	<meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS-->
    <link href="../vendor/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../vendor/css/sb-admin.css" rel="stylesheet">


    <!-- Page level plugin CSS-->
    <link href="../vendor/js/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	
	<title> Request Approval Page | UBank Staff Dashboard</title>
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
						<i class='fas fa-check'></i> Request sucessfully approved. </div>";
				} elseif ($_GET['success'] == "2") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Request sucessfully denied.</div>";
				} elseif ($_GET['success'] == "3") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Request sucessfully deleted.</div>";
				} elseif ($_GET['error'] == "1") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Oh. Something went wrong. Please try again.</div>";
				} elseif ($_GET['error'] == "2") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> No task selected. Please select a task and try again.</div>";
				}
			?>
		<?php if ($staffdat_account == "staff" OR $staffdat_id == "1"){ ?>
		  
		  <div class="row text-center">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<select class="form-control" data-error="Select your category." onchange="javascript:location.href = this.value;">
					<option value="" selected disabled>Select section to show below...</option>
					<option value="?overview">Overview</option>
					<option value="?contacts">Approve Contact Requests</option>
					<option value="?mastercard">Approve Mastercard Requests</option>
					<option value="?creditcard">Approve Creditcard Requests</option>
					<option value="?visacard">Approve Visa card Requests</option>
				</select>
			</div>
			<div class="col-md-3"></div>
		  </div><br>

		  <div class="row">

		  <!-- Display different sections using php isset(GET) -->
		<?php if (isset($_GET['overview'])) { ?>
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-user-check"></i> Overview</div>
				<div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-body">
				   (add information here)
				</div>
			  </div>
		   </div>

		<?php } elseif (isset($_GET['contacts'])) { ?>
		    <div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-user-check"></i>
				  Approve Contact Requests</div>
				<div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-body">
				  <?php
					include '../_inc/dbconn.php';
					$sql = "SELECT * FROM UBankMAIN.contacts WHERE status='PENDING'";
					$result = mysql_query($sql) or die(mysql_error());
				  ?>
				  <form action="process" method="POST">
				  <div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					  <thead>
						<tr>
							<th>Id</th>
							<th>Sender</th>
							<th>Reciever</th>
							<th>Status</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
							while($rws=  mysql_fetch_array($result)){
								echo "<tr><td><input type='radio' name='contact_id' value=".$rws[0];
								echo ' checked';
								echo " /></td>";
								echo "<td><b>".$rws[2]."</b> (".$rws[1].")</td>";
								echo "<td><b>".$rws[4]."</b> (".$rws[3].")</td>";
								echo "<td>".$rws[5]."</td>";
							   
								echo "</tr>";
							}
						?>
					  </tbody>
					</table><br>
					<input type="submit" class="btn btn-success" name="contact_approve" value="Approve Contact Request" />
					<input type="submit" class="btn btn-danger" name="contact_delete" value="Delete Contact Request" />
				  </div>
				  </form>
				</div>
			  </div>
		   </div>

		<?php } elseif (isset($_GET['mastercard'])) { ?>
		   <div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-user-check"></i>
				  Approve Mastercard Requests</div>
				<div class="card-body-icon">
                    <i class="fab fa-cc-mastercard"></i>
                </div>
				<div class="card-body">
					<?php
						include '../_inc/dbconn.php';
						$sql="SELECT * FROM UBankDAT.req_mastercard WHERE mastercard_status='PENDING'";
						$result=  mysql_query($sql) or die(mysql_error());
					?>
					<form action="process" method="POST">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>select</th>
								<th>Name</th>
								<th>Account No.</th>
								<th>Mastercard Status</th>
							</tr>
						  </thead>
						  <tbody>
							<?php
								while($rws=  mysql_fetch_array($result)){
									echo "<tr><td><input type='radio' name='mastercard_id' value=".$rws[0];
									echo ' checked';
									echo " /></td>";
									echo "<td>".$rws[1]."</td>";
									echo "<td>".$rws[2]."</td>";
									echo "<td>".$rws[3]."</td>";
									
									echo "</tr>";
								}
							?>
						  </tbody>
						</table><br>
						<input type="submit" class="btn btn-success" name="mastercard_approve" value="Approve Mastercard Request" />
						<input type="submit" class="btn btn-warning" name="mastercard_deny" value="Deny Mastercard Request" />
						<input type="submit" class="btn btn-danger" name="mastercard_delete" value="Delete Mastercard Request" />
					</div>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></div>
			  </div>
			</div>

		<?php } elseif (isset($_GET['creditcard'])) { ?>
		    <div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-user-check"></i>
				  Approve Creditcard Requests</div>
				<div class="card-body-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
				<div class="card-body">
					<?php
						include '../_inc/dbconn.php';
						$sql="SELECT * FROM UBankDAT.req_creditcard WHERE creditcard_status='PENDING'";
						$result=  mysql_query($sql) or die(mysql_error());
					?>
					<form action="process" method="POST">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>select</th>
								<th>Name</th>
								<th>Account No.</th>
								<th>Creditcard Status</th>
							</tr>
						  </thead>
						  <tbody>
							<?php
								while($rws=  mysql_fetch_array($result)){
									echo "<tr><td><input type='radio' name='creditcard_id' value=".$rws[0];
									echo ' checked';
									echo " /></td>";
									echo "<td>".$rws[1]."</td>";
									echo "<td>".$rws[2]."</td>";
									echo "<td>".$rws[3]."</td>";
									
									echo "</tr>";
								}
							?>
						  </tbody>
						</table><br>
						<input type="submit" class="btn btn-success" name="creditcard_approve" value="Approve Creditcard Request" />
						<input type="submit" class="btn btn-warning" name="creditcard_deny" value="Deny Creditcard Request" />
						<input type="submit" class="btn btn-danger" name="creditcard_delete" value="Delete Creditcard Request" />
					</div>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></div>
			  </div>
			</div>

		<?php } elseif (isset($_GET['visacard'])) { ?>
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-user-check"></i>
				  Approve Visa Card Requests</div>
				<div class="card-body-icon">
                    <i class="fab fa-cc-visa"></i>
                </div>
				<div class="card-body">
					<?php
						include '../_inc/dbconn.php';
						$sql="SELECT * FROM UBankDAT.req_visacard WHERE visacard_status='PENDING'";
						$result=  mysql_query($sql) or die(mysql_error());
					?>
					<form action="process" method="POST">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>select</th>
								<th>Name</th>
								<th>Account No.</th>
								<th>Visa Card Status</th>
							</tr>
						  </thead>
						  <tbody>
							<?php
								while($rws=  mysql_fetch_array($result)){
									echo "<tr><td><input type='radio' name='visacard_id' value=".$rws[0];
									echo ' checked';
									echo " /></td>";
									echo "<td>".$rws[1]."</td>";
									echo "<td>".$rws[2]."</td>";
									echo "<td>".$rws[3]."</td>";
									
									echo "</tr>";
								}
							?>
						  </tbody>
						</table><br>
						<input type="submit" class="btn btn-success" name="visacard_approve" value="Approve Visa card Request" />
						<input type="submit" class="btn btn-warning" name="visacard_deny" value="Deny Visa card Request" />
						<input type="submit" class="btn btn-danger" name="visacard_delete" value="Delete Visa card Request" />
					</div>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></div>
			  </div>
			</div>
		<?php } // close the php sections ?>

		</div> <!-- /.row -->
		<?php } else { ?>
			<div class='alert alert-danger'>
				<i class='fas fa-times'></i> You don't have the rights to perform this action. Please click <a href="dashboard">here</a> to head back home.
			</div><br><br>
		<?php } // header('location:../staff/'); and then display this message ?>

    </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>