<?php 
	session_start();
	include '../_inc/dbconn.php';

	if(!isset($_SESSION['session_staff_start'])) 
    	header('location:../staff/');   
?>
<?php include 'displayinfo.php' ?>

<?php
	if (isset($_REQUEST['change_password'])){ // Change password
		$sql1 = "SELECT password FROM UBankMAIN.staff WHERE id='$staffdat_id'";
		$result = mysql_query($sql1) or die(header('location:settings?error=1'));
		$res = mysql_fetch_array($result);

		$pwd_old = $_POST['old_password'];
		$pwd_new = $_POST['new_password'];
		$pwd_again = $_POST['again_password'];

		// Salting of password as encryption
		$salt = "@g26jQsG&nh*&#8v";
		$new_password = sha1($pwd_new.$salt);
		$old_password = sha1($pwd_old.$salt);
		
		if($res[0] == $old_password && $pwd_new == $pwd_again){ // Everything is right, change password
			$sql2 = "UPDATE UBankMAIN.staff SET password='$new_password' WHERE id='$staffdat_id'";
			mysql_query($sql2) or die(header('location:settings?error=1'));

			session_destroy(); // destroying session to let the user login again using new password
			header('location:index?success=1');
		} elseif ($res[0] != $old_password){ // Old password does not match the database
			header('location:settings?error=3');
		} else { // New passwords do not match
			header('location:settings?error=2');
		}
	} else {
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
	
	<title> Settings | UBank Staff Dashboard</title>
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
						<i class='fas fa-check'></i> Password Changed. </div>";
				} elseif ($_GET['error'] == "1") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Oh. Something went wrong. Please try again.</div>";
				} elseif ($_GET['error'] == "2") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-warning alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-exclamation-triangle"></i> The submitted passwords do not match. No information was changed.</div>';
				} elseif ($_GET['error'] == "3") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-warning alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-exclamation-triangle"></i> The old password does not match the database. No information was changed.</div>';
				}
			?>

		  <div class="row">
		  	<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-info"></i>
				  Your Information</div>
				<div class="card-body-icon">
                    <i class="fas fa-user"></i>
                </div>
				<div class="card-body">
					<span class="heading">Welcome </span><b><?php echo $staffdat_name; ?></b> <small>(<?php if ($staffdat_id == "1"){echo "owner";} else {echo "staff member";} ?>)</small>,<br>
					<span class="heading">Your Last login was on </span><b><?php echo $staffdat_lastlogin; ?></b>,<br>
					<span class="heading">Your Email is: <b><?php echo $staffdat_email; ?></b> and this is your </span><b><?php if ($staffdat_account == "admin"){ echo "admin"; } else { echo $staffdat_account;} ?></b> account.
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></div>
			  </div>
			</div>
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <div class="card-body-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Admin Options</div>
				<div class="card-body">
					<p>You can change your account password below.</p>
					<form action="settings.php" method="POST">
						<table>
							<tr>
								<td width="170px">Enter old password</td>
								<td><input class="form-control" type="password" name="old_password" required=""/></td>
							</tr>
							<tr>
								<td>Enter new password</td>
								<td><input class="form-control" type="password" name="new_password" required=""/></td>
							</tr>
							<tr>
								<td>Enter password again</td>
								<td><input class="form-control" type="password" name="again_password" required=""/></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="change_password" value="Change Admin Password" />
					</form>
				</div>
			  </div>
			</div> 
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>

<?php } ?>