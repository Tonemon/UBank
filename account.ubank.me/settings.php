<?php 
session_start();
include '_inc/dbconn.php';
		
if(!isset($_SESSION['session_user_start'])) 
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
	
	<title><?php echo $userdat_name; ?>'s Account Settings | UBank Online Banking</title>
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
			} elseif (isset($_GET['send'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i> Question send. We will try to answer it as soon as possible. </div>";
			}
		  ?>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <div class="card-body-icon">
                    <i class="far fa-life-ring"></i>
                </div>
				<div class="card-header">
				  <i class="far fa-life-ring"></i>
				  Support Panel</div>
				<div class="card-body">
					<p>If you got any questions please submit the form below and we will answer it as soon as possible.</p>
					<form action="process_question.php" method="POST">
						<table>
							<tr>
								<td>First name:</td>
								<td><input type="hidden" name="q_name" value="<?php echo $userdat_name ?>" />
								<input class="form-control" type="text" value="<?php echo $userdat_name ?>" disabled="disabled" /></td>
							</tr>
							<tr>
								<td>Email address: &nbsp;</td>
								<td><input type="hidden" name="q_email" value="<?php echo $userdat_email ?>" />
								<input class="form-control" type="email" value="<?php echo $userdat_email ?>" disabled="disabled" /></td>
							</tr>
							<tr>
								<td>Category:</td>
								<td>
									<select class="form-control" name="q_type" required="required">
										<option value=""></option>
										<option value="Services">More information about us</option>
										<option value="Banking">UBank Online Banking</option>
										<option value="Bug">Exploit/Bug Found</option>
										<option value="Job">Job Application</option>
										<option value="Other">Other</option>
									</select>
								</td>
							</tr>	
						</table><br>
						<p>Your Message<br>
						<textarea class="form-control" type="text" name="q_message" rows="3" required="required" placeholder="Write your message here..."></textarea></p>
						<input type="submit" class="btn btn-success" name="submit_question" value="Submit my Message"/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Change Password</div>
				<div class="card-body-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
				<div class="card-body">
					<form action="process_password_edit.php" method="POST">
						<table>
							<tr>
								<td>Enter old password:</td>
								<td><input class="form-control" type="password" name="old_password" required=""/></td>
							</tr>
							<tr>
								<td>Enter new password:</td>
								<td><input class="form-control" type="password" name="new_password" required=""/></td>
							</tr>
							<tr>
								<td>Enter password again: &nbsp;</td>
								<td><input class="form-control" type="password" name="again_password" required=""/></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="change_password" value="Change my Password"/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>