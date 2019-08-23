<?php 
	session_start();
	if (!isset($_SESSION['session_staff_start'])) 
    	header('location:../staff/');

?>
<?php
	// gather all information from session data
	$staffdat_email = $_SESSION['session_staff_email'];

	include '../_inc/dbconn.php';
	$sql = "SELECT * FROM UBankMAIN.staff WHERE email='$staffdat_email'";
	$result = mysql_query($sql) or die(mysql_error());
	$res = mysql_fetch_array($result);
	
	// setting all variables
	$staffdat_id = $res[0];
	$staffdat_name = $res[1];
	$staffdat_gender = $res[2];
	$staffdat_account = $res[4];
	$staffdat_address = $res[5];
	$staffdat_mobile = $res[6];
	$staffdat_lastlogin = $res[10];
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
	
	<title><?php echo $staffdat_name; ?>'s Dashboard | UBank Staff Dashboard</title>
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
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-info"></i>
				  General Information</div>
				<div class="card-body-icon">
                    <i class="fas fa-user"></i>
                </div>
				<div class="card-body">
					<span class="heading">Welcome </span><b><?php echo $staffdat_name; ?></b> <small>(<?php if ($staffdat_id == "1"){echo "owner";} else {echo "staff member";} ?>)</small>,<br>
					<span class="heading">Your Last login was on </span><b><?php echo $staffdat_lastlogin; ?></b>,<br>
					<span class="heading">Your Email is: </span><b><?php echo $staffdat_email; ?></b> and this is your </span><b><?php if ($staffdat_account == "admin"){ echo "admin"; } else { echo $staffdat_account;} ?></b> account.
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<?php if ($staffdat_account == "admin"){ ?>
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-shield"></i>
				  Admin Panel</div>
				<div class="card-body">
					<table>
						<tbody>
						<tr>
							<td width="150px"><span class="heading"><b>Staff Overview (Add/Edit/Delete)</b>.</span></td>
							<td><a href="edit/admin?overview" class="btn btn-success"><i class="fas fa-link"></i> Staff &raquo;</a></td>
						</tr>
						<tr><td><br></td></tr>
						<tr>
							<td width="150px"><span class="heading"><b>User Overview (Add/Edit/Delete)</b>.</span><br></td>
							<td><a href="edit/users?overview" class="btn btn-success"><i class="fas fa-link"></i> Users &raquo;</a></td>
						</tr>
						</tbody>
					</table>
					<small><i>Only an Admin/Owner can see this panel.</i></small>
				</div>
			  </div>
			</div>
			<?php } if ($staffdat_account == "staff" || $staffdat_id == "1"){ ?>
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-users"></i>
				  Staff Actions</div>
				<div class="card-body">
					<table>
						<tbody>
						<tr>
							<td width="300px"><span class="heading"><b>Mastercard, Creditcard and Visacard requests</b>.</span><br><br></td>
							<td><a href="requests" class="btn btn-success"><i class="fas fa-link"></i> Requests &raquo;</a><br><br></td>
						</tr>
						<tr>
							<td><span class="heading"><b>Support (questions) Panel</b>.</span></td>
							<td><a href="questions" class="btn btn-success"><i class="fas fa-link"></i> Questions &raquo;</a></td>
						</tr>
						<tr>
							<td><span class="heading"><b>Add/Edit/Delete Users</b>.</span><br></td>
							<td><a href="edit/users?overview" class="btn btn-success"><i class="fas fa-link"></i> Users &raquo;</a><br></td>
						</tr>
						</tbody>
					</table>
				</div>
			  </div>
			</div>
			<?php } ?>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>