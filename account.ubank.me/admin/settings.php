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
		  
		  <?php
			if (isset($_GET['error'])) {
				echo "<div class='alert alert-danger alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i>
					Wrong credentials. Please try again.</div>";
			} elseif (isset($_GET['success'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Password updated.</div>";
			}
		  ?>
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <div class="card-body-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Admin Options</div>
				<div class="card-body">
					<p>You can change your administrator password below.</p>
					<form action="admin-pwd.php" method="POST">
						<table>
							<tr>
								<td>Enter old password: </td>
								<td><input type="password" name="old_password" required=""/></td>
							</tr>
							<tr>
								<td>Enter new password: </td>
								<td><input type="password" name="new_password" required=""/></td>
							</tr>
							<tr>
								<td>Enter password again: </td>
								<td><input type="password" name="again_password" required=""/></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-default" name="change_password" value="Change Admin Password" />
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<!-- Add these widgets if needed
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-users"></i>
				  Staff Options</div>
				<div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-body">
					<p><a href="staff">Add staff member</a><br>
					<a href="staff">Edit staff member</a><br>
					<a href="staff">Delete staff</a></p>
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
					<p><a href="customer">Add Customer</a><br>
					<a href="customer">Edit customer</a><br>
					<a href="customer">Delete customer</a></p>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div> -->
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>