<?php 
	session_start();
	if (!isset($_SESSION['session_staff_start'])) 
    	header('location:../staff/');

?>
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
			if (isset($_GET['approved'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Request sucessfully approved.</div>";
			} elseif (isset($_GET['denied'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Request sucessfully denied.</div>";
			} elseif (isset($_GET['deleted'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Request sucessfully deleted.</div>";
			} elseif (isset($_GET['notask'])) {
				echo "<div class='alert alert-warning alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i>
					No task selected. Please select a task and try again.</div>";
			}
		  ?>
		  
		  <!-- Display sections -->
		  <div class="row text-center">
				  <div class="col-md-3"></div>
				  <div class="col-md-6">
						<select id="sectionselector" class="form-control" data-error="Select your category.">
							<option value="" disabled>Select section to show below...</option>
							<option value="section_contact" selected>Contact Requests Section</option>
							<option value="section_mastercard">(Cards) Mastercard Section</option>
							<option value="section_creditcard">(Cards) Creditcard Section</option>
							<option value="section_visacard">(Cards) Visa card Section</option>
						</select>
				  </div>
				  <div class="col-md-3"></div>
		  </div>
		  <script src="../vendor/jquery/jquery.min.js"></script>
		  <script type="text/javascript">
			$(function() {
				$('#sectionselector').change(function(){
					$('.sectionshow').hide();
					$('#' + $(this).val()).show();
				});
			});
		  </script><br>
		  
		  <!-- Real Cards beginning -->
		  <div class="row">
		    <div class="col-xl-12 mb-6 sectionshow" id="section_contact">
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
					$sql="SELECT * FROM contacts WHERE status='PENDING'";
					$result=  mysql_query($sql) or die(mysql_error());
				  ?>
				  <form action="process_contact.php" method="POST">
				  <div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					  <thead>
						<tr>
							<th>select</th>
							<th>Sender</th>
							<th>Reciever</th>
							<th>Status</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
							while($rws=  mysql_fetch_array($result)){
								echo "<tr><td><input type='radio' name='customer_id' value=".$rws[0];
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
					<input type="submit" class="btn btn-success" name="approve" value="Approve Contact Request" />
					<input type="submit" class="btn btn-danger" name="delete" value="Delete Contact Request" />
				  </div>
				  </form>
				</div>
			  </div>
		   </div>
		   <div class="col-xl-12 mb-6 sectionshow" id="section_mastercard" style="display:none">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-user-check"></i>
				  Approve Mastercard Requests</div>
				<div class="card-body-icon">
                    <i class="fab fa-cc-mastercard"></i>
                </div>
				<div class="card-body">
					<?php
						include '../_inc/dbconn.php';
						$sql="SELECT * FROM req_mastercard WHERE mastercard_status='PENDING'";
						$result=  mysql_query($sql) or die(mysql_error());
					?>
					<form action="process_mastercard.php" method="POST">
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
									echo "<tr><td><input type='radio' name='customer_id' value=".$rws[0];
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
						<input type="submit" class="btn btn-success" name="approve" value="Approve Mastercard Request" />
						<input type="submit" class="btn btn-warning" name="deny" value="Deny Mastercard Request" />
						<input type="submit" class="btn btn-danger" name="delete" value="Delete Mastercard Request" />
					</div>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		    <div class="col-xl-12 mb-6 sectionshow" id="section_creditcard" style="display:none">
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
						$sql="SELECT * FROM req_creditcard WHERE creditcard_status='PENDING'";
						$result=  mysql_query($sql) or die(mysql_error());
					?>
					<form action="process_creditcard" method="POST">
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
									echo "<tr><td><input type='radio' name='customer_id' value=".$rws[0];
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
						<input type="submit" class="btn btn-success" name="approve" value="Approve Creditcard Request" />
						<input type="submit" class="btn btn-warning" name="deny" value="Deny Creditcard Request" />
						<input type="submit" class="btn btn-danger" name="delete" value="Delete Creditcard Request" />
					</div>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<div class="col-xl-12 mb-6 sectionshow" id="section_visacard" style="display:none">
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
						$sql="SELECT * FROM req_visacard WHERE visacard_status='PENDING'";
						$result=  mysql_query($sql) or die(mysql_error());
					?>
					<form action="process_visacard.php" method="POST">
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
									echo "<tr><td><input type='radio' name='customer_id' value=".$rws[0];
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
						<input type="submit" class="btn btn-success" name="approve" value="Approve Visa card Request" />
						<input type="submit" class="btn btn-warning" name="deny" value="Deny Visa card Request" />
						<input type="submit" class="btn btn-danger" name="delete" value="Delete Visa card Request" />
					</div>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row uitproberen -->
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>