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
	
	<title>Account Settings | UBank</title>
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
					Password successfully updated.</div>";
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
					<p>If you got any questions please submit the form below and we will answer it as soon as possible.</p>
					<form action="process_question.php" method="POST">
						<table>
							<tr>
								<td>First name:</td>
								<td><input type="hidden" name="q_name" value="<?php echo $name ?>" />
								<input type="text" value="<?php echo $name ?>" disabled="disabled" /></td>
							</tr>
							<tr>
								<td>Email address:</td>
								<td><input type="hidden" name="q_email" value="<?php echo $email ?>" />
								<input type="email" value="<?php echo $email ?>" disabled="disabled" /></td>
							</tr>
							<tr>
								<td>Category:</td>
								<td>
									<select name="q_type" required="required" data-error="Select your category.">
										<option value=""></option>
										<option value="(C) Services">More information about us</option>
										<option value="(C) Banking">UBank Online Banking</option>
										<option value="(C) Bug">Exploit/Bug Found</option>
										<option value="(C) Job">Job Application</option>
										<option value="(C) Other">Other</option>
									</select>
								</td>
							</tr>	
						</table><br>
						<p>Your Message:<br>
						<input type="text" name="q_message"  required="required"/></p>
						<input type="submit" class="btn btn-success" name="submit_question" value="Submit Question"/>
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
								<td><input type="password" name="old_password" required=""/></td>
							</tr>
							<tr>
								<td>Enter new password:</td>
								<td><input type="password" name="new_password" required=""/></td>
							</tr>
							<tr>
								<td>Enter password again:</td>
								<td><input type="password" name="again_password" required=""/></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="change_password" value="Change Password"/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>