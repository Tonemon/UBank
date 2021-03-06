<?php 
session_start();
include '_inc/dbconn.php';
		
if(!isset($_SESSION['session_user_start'])) 
    header('location:index.php');   
?>
<?php include 'displayinfo.php' ?>

<?php
	if (isset($_REQUEST['submit_password'])){ // Change password request
		$changeid = $_SESSION['session_user_id'];

		$sql = "SELECT * FROM UBankMAIN.users WHERE id='$changeid'";
		$result = mysql_query($sql);
		$rws = mysql_fetch_array($result);
						
		$salt = "@g26jQsG&nh*&#8v";
		$old = sha1($_REQUEST['old_password'].$salt);
		$new = sha1($_REQUEST['new_password'].$salt);
		$again = sha1($_REQUEST['again_password'].$salt);
						
		if ($rws[8] == $old && $new == $again){
			$sql1 = "UPDATE UBankMAIN.users SET password='$new' WHERE id='$changeid'";
			mysql_query($sql1) or die(mysql_error());

			session_destroy(); // destroying session to let the user login again using new password
			header('location:index?password=1');

		}
	} elseif (isset($_REQUEST['submit_question'])){ // Submit request process
		// getting variables to store in table
		$name = mysql_real_escape_string($_REQUEST['q_name']);
		$email = mysql_real_escape_string($_REQUEST['q_email']);
		$type = mysql_real_escape_string($_REQUEST['q_type']);
		$message = mysql_real_escape_string($_REQUEST['q_message']);

		// variables to set on the go
		$status = "TO REVIEW";
		$from = "Support Panel";
		$date = date('Y-m-d h:i:s');

		// insert question to table 'users'
		$sql = "INSERT INTO UBankDAT.questions values('','$name','$email','$type','$message','$status','','$from','$date')";
		mysql_query($sql) or die("Your question could not be submitted. Please try again later.");
		header('location:settings?send=1');
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
					<form action="settings" method="POST">
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
										<option value="">Select...</option>
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
						<button type="submit" class="btn btn-success" name="submit_question"><i class="fas fa-check"></i> Submit my Message</button>
					</form>
				</div>
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
					<form action="settings" method="POST">
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
						<button type="submit" class="btn btn-success" name="submit_password"><i class="fas fa-check"></i> Change my password</button>
					</form>
				</div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>

<?php } ?>