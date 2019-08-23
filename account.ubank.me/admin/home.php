<?php 
session_start();
include '../_inc/dbconn.php';

if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
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
	
	<title> Admin Dashboard | UBank</title>
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
						<span class="heading">Welcome </span><b><?php echo $adminname; ?></b>
						<?php
							if ($real_id == 1){
								echo "<small>(Owner)</small>";
							} else {
								echo "<small>(Admin)</small>";
							}
						?>,
						<br>
						<span class="heading">Your Last login was on </span><b><?php echo $last_login; ?></b>,<br>
						<span class="heading">Your Department is </span><b><?php echo $departement; ?></b>,<br>
						<span class="heading">Your Username is </span><b><?php echo $admin_id; ?></b>.
						
					</p>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<!-- Admin settings section only for admin id 1 -->
			<?php if ($real_id == 1){ ?>
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-crown"></i>
				  Admin Options (Owner only)</div>
				<div class="card-body-icon">
                    <i class="fas fa-crown"></i>
                </div>
				<div class="card-body">
					<p><a href="admin"><i class="fas fa-user-plus"></i> Add admin member &raquo;</a><br>
					<a href="admin"><i class="fas fa-user-edit"></i> Edit admin member &raquo;</a><br>
					<a href="admin"><i class="fas fa-user-minus"></i> Delete admin &raquo;</a><br></p>
				</div>
				<div class="card-footer small text-muted"><i class="fas fa-info-circle"></i> <b>Only the owner (you)</b> can see this section.</div>
			  </div>
			</div>
			<?php } else {} ?>
			<!-- end admin section -->
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-users"></i>
				  Staff Options</div>
				<div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-body">
					<p><a href="staff"><i class="fas fa-user-plus"></i> Add staff member &raquo;</a><br>
					<a href="staff"><i class="fas fa-user-edit"></i> Edit staff member &raquo;</a><br>
					<a href="staff"><i class="fas fa-user-minus"></i> Delete staff &raquo;</a></p>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-users"></i>
				  Customer Options</div>
				<div class="card-body">
					<p><a href="customer"><i class="fas fa-user-plus"></i> Add Customer &raquo;</a><br>
					<a href="customer"><i class="fas fa-user-edit"></i> Edit customer &raquo;</a><br>
					<a href="customer"><i class="fas fa-user-minus"></i> Delete customer &raquo;</a></p>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>