<?php 
session_start();
include '../_inc/dbconn.php';
        
if(!isset($_SESSION['session_staff_start'])) 
    header('location:../staff/');   
?>
<?php include 'displayinfo.php' ?>

<?php /* NEED TO FIX THIS AND ADD MULTIPLE WHERE STATEMENTS!!! Check unotes for more info!!
	$delete_id = mysql_real_escape_string($_REQUEST['editadmin_id']);
	if(isset($_REQUEST['delete_admin'])){
		$sql_delete="DELETE FROM UBankMAIN.staff WHERE `id` = '$delete_id'";
		mysql_query($sql_delete) or die(mysql_error());
		header('location:admin?deleted=1');
	} */
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
	
	<title>Staff Overview | UBank Staff Dashboard</title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

      <div id="content-wrapper">
        <div class="container-fluid">
		<?php if ($staffdat_account == "admin"){ ?>
		
          <!-- Breadcrumbs 
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol> -->
		  
		  <?php
				if (isset($_GET['add'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						New admin added. </div>";
				} elseif (isset($_GET['deleted'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Admin deleted.</div>";
				} elseif (isset($_GET['edit'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Admin information changed.</div>";
				} /* elseif (isset($_GET['overview'])) {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i>
						<strong>Admin panel: </strong> Watch out while making changes to admin accounts. These can be harmful and irreversible!</div>";
				} */
			?>

		  <div class="row text-center">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<select class="form-control" data-error="Select your category." onchange="javascript:location.href = this.value;">
					<option value="" selected disabled>Select section to show below...</option>
					<option value="?overview">Add New Staff / Deleted Staff</option>
					<option value="?all">Existing Staff Members</option>
				</select>
			</div>
			<div class="col-md-3"></div>
		  </div><br>

		  <!-- Display different sections using php isset(GET) -->
		<?php if (isset($_GET['overview'])) { ?>		  
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3">
			    <div class="card-body-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-plus"></i>
				  Add new Staff member</div>
				<div class="card-body">
					<form action="admin-add.php" method="POST">
						<table>
							<tr>
								<td width="100px">Full Name</td>
								<td><input class="form-control" type="text" name="admin_name" required /></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td>
									<input type="radio" name="admin_gender" value="M" checked/> Male<br>
									<input type="radio" name="admin_gender" value="F" /> Female
								</td>
							</tr>
							<tr>
								<td>DOB</td>
								<td><input class="form-control" type="date" name="admin_dob" required /></td>
							</tr>
							<tr>
								<td>Account type</td>
								<td>
									<select class="form-control" name="admin_account" required="required" >
										<option value="staff">Staff Member</option>
										<option value=""></option>
										<option value="admin">Administrator</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Address</td>
								<td><input class="form-control" type=text name="admin_address" required /></td>
							</tr>
							<tr>
								<td>Mobile</td>
								<td><input class="form-control" type="text" name="admin_mobile" required /></td>
							</tr>
							<tr>
								<td>Username</td>
								<td><input class="form-control" type="text" name="admin_username" required /></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><input class="form-control" type="email" name="admin_email" required /></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input class="form-control" type="password" name="admin_password" required /></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="add_admin" value="Add new Admin" class='addadmin_button'/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></div>
			  </div>
			</div>
			<div class="col-xl-8 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-user-minus"></i>
				  Deleted Users</div>
				<div class="card-body">
				  <form action="admin-edit" method="POST">
					<div class="table-responsive">
					<small class="form-text">The users on this this page are either removed or they closed their account. The reason can be found on the right.<br>NOTICE: These accounts <b>cannot</b> be recovered! This page allows you <b>only</b> to <b>keep track of removed accounts</b> and can be used when someone contacts us about their deleted account.</small><br>
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<?php
							include '../_inc/dbconn.php';
							$query2="SELECT * FROM UBankMAIN.usersclosed";
							$res2=  mysql_query($query2) or die(mysql_error());
							
							$sql_min="SELECT MIN(id) from UNotesMAIN.usersclosed";
							$result_min=  mysql_query($sql_min);
							$rws2 = mysql_fetch_array($result_min);
						?>
						<thead>
						<tr>
							<th></th>
							<th>name (id)</th>
							<th>Type</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>How</th>
							<th>Reason</th>
						</tr>
						</thead>
						<tbody>
						<?php
                        while($rws=  mysql_fetch_array($res2)){
                           echo "<tr><td><input type='radio' name='record_id' value=".$rws[0];
                           echo " /></td>";
                           echo "<td>".$rws[1]." (<b>".$rws[0]."</b>)</td>";
									echo "<td>".$rws[3]."</td>";
									echo "<td>".$rws[4]."</td>";
									echo "<td>".$rws[5]."</td>";
									echo "<td>".$rws[6]."</td>";
									if ($rws[7] == "## inactive ##"){
										echo "<td><i>This user has been inactive for too long (+2 years).</i></td>";
									} elseif ($rws[7] == "## unusual ##"){
										echo "<td><i>This account showed unusual/fraudulent activity.</i></td>";
									} elseif ($rws[7] == "## exploiting ##"){
										echo "<td><i>This account was used for exploiting purposes.</i></td>";
									} elseif ($rws[7] == "## other ##"){
										echo "<td><i>This account is deleted because of other (unlisted) reasons.</i></td>";
									} else {
										echo "<td>".$rws[7]."</td>";
									}
                      		echo "</tr>";
                        }
                        ?>
					  </tbody>
					</table>
					</div><br>
					<button type="submit" class="btn btn-danger" name="delete_record"><i class="fas fa-trash-alt"></i> Delete selected record</button>
				  </form>
				</div>
			  </div>
			</div>
		  </div> <!-- /.row -->

		  <?php } elseif (isset($_GET['all'])) { ?>
		<!-- Edit existing users row -->
		  <div class="row">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Display/Edit Staff</div>
				<div class="card-body">
					<form action="admin-edit" method="POST">
					<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<?php
							include '../_inc/dbconn.php';
							$query2="SELECT * FROM UBankMAIN.staff";
							$res2=  mysql_query($query2) or die(mysql_error());
							
							$sql_min = "SELECT MIN(id) from UNotesMAIN.staff";
							$result_min = mysql_query($sql_min);
							$rws2 = mysql_fetch_array($result_min); // same fix. check /banking transfer funds to user and use the same system fix
						?>
						<thead>
						<tr>
							<th></th>
							<th>id</th>
							<th>name</th>
							<th>username</th>
							<th>email address</th>
							<th>last login</th>
							<th>account type</th>
							<th>account status</th>
						</tr>
						</thead>
						<tbody>
						<?php
                  	while($rws=  mysql_fetch_array($res2)){
                        echo "<tr><td><input type='radio' name='user_id' value=".$rws[0];
                        if($rws[0]==$rws2[0]){ echo ' checked'; }
                        echo " /></td>";
                        echo "<td>".$rws[0]."</td>";
                        echo "<td>".$rws[1]."</td>";
								echo "<td>".$rws[11]."</td>";
								echo "<td>".$rws[7]."</td>";
								echo "<td>".$rws[9]."</td>";
								echo "<td>".$rws[4]."</td>";
                        echo "<td>".$rws[10]."</td>";
                        echo "</tr>";
                     }
                  ?>
					  </tbody>
					</table>
					</div><br>
					<button type="submit" class="btn btn-warning" name="edit_user"><i class="fas fa-user-edit"></i> Edit user</button>
					<a href="#" class="btn btn-danger" id="pagesDropdown" data-toggle="modal" data-target="#deleteModal" aria-haspopup="true"><i class="fas fa-trash-alt"></i> Delete user</a>
				</div>
			  </div>
			</div>
		  </div> <!-- /.row -->
		  
		  <!-- Delete user Modal-->
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Permanently delete this user?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			  </div>
			 <div class="modal-body">This user will be deleted permanently and you can't recover it in the future.
			  Please check if it's the right one, because it may lead to <b>huge problems</b> if you delete the wrong user!<br><br>
			  <b>Remember</b>: If you want to warn a user first, set the <b>account status</b> to <b>disabled</b> by editing the account. After 2 warnings the account should be deleted.<br>
			  	<small id="typeHelp" class="form-text">Reason</small>
					<select class="form-control" name="delete_reason" required="required">
						<option value="## inactive ##" selected>Inactive for a long period (+2 years)</option>
						<option value="## unusual ##">Unusual or fraudulent activity</option>
						<option value="## exploiting ##">User exploiting (premium) features</option>
						<option value="## other ##">Other</option>
					</select>
			 </div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger" name="delete_user"><i class="fas fa-trash-alt"></i> Delete this user!</button>
			  </div>
			 </form>
			</div>
		  </div>
		</div>

		<?php } ?>
        </div><!-- /.container-fluid -->
		
		<!-- Delete admin member Modal-->
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Are you sure?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			  </div>
			  <div class="modal-body">Are you sure you want to delete <b>this</b> admin? It may lead to <b>huge problems</b> if you delete the wrong administrator account!</div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<input class="btn btn-danger" type="submit" name="delete_admin" value="Delete Admin Member" />
				</form>
			  </div>
			</div>
		  </div>
		</div>

		<?php } else { ?>
		<div class='alert alert-danger'>
			<i class='fas fa-times'></i> You don't have the rights to perform this action. Please click <a href="dashboard">here</a> to head back home.
		</div><br><br>
		<?php } // header('location:../staff/'); and then display this message ?>
		
<?php include 'afooter.php' ?>