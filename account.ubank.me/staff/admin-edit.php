<?php 
session_start();
include '../_inc/dbconn.php';

if(!isset($_SESSION['session_staff_start'])) 
    header('location:../staff/');   
?>
<?php
	//$id=  mysql_real_escape_string($_REQUEST['staff_id']);
	//$sql="SELECT * FROM UBankMAIN.staff WHERE id=$id";
	//$result=  mysql_query($sql) or die(mysql_error());
	//$rws=  mysql_fetch_array($result);
	if (isset($_REQUEST['add_staff'])){ // Create user request
		// variables from user information
		$new_name=  mysql_real_escape_string($_REQUEST['admin_name']);
		$new_gender=  mysql_real_escape_string($_REQUEST['admin_gender']);
		$new_dob=  mysql_real_escape_string($_REQUEST['admin_dob']);
		$new_account=  mysql_real_escape_string($_REQUEST['admin_account']);
		$new_address=  mysql_real_escape_string($_REQUEST['admin_address']);
		$new_mobile=  mysql_real_escape_string($_REQUEST['admin_mobile']);
		$new_username=  mysql_real_escape_string($_REQUEST['admin_username']);
		$new_email= mysql_real_escape_string($_REQUEST['admin_email']);
		// $new_date= date("Y-m-d H:i:s"); Not needed
		
		//salting of password as encryption
		$salt="@g26jQsG&nh*&#8v";
		$new_password= sha1($_REQUEST['admin_password'].$salt);
		
		// insert new admin to table 'staff'
		$sql1 = "INSERT INTO UBankMAIN.staff values('','$new_name','$new_gender','$new_dob','$new_account','$new_address','$new_mobile','$new_username','$new_email','$new_password','')";
		mysql_query($sql1) or die(header('location:admin?overview&error=2')); // Redirect, message: username/email already taken.
		header('location:admin?all&success=1'); // on success displays: New staff member added.
		
	} elseif (isset($_REQUEST['delete_staff'])){ // Delete staff request
		$delete_id= $_POST['staff_id'];
		$delete_reason= $_POST['delete_reason'];

		if ($delete_id != "1"){ // if id is not the id of the owner
			$delete_info = "SELECT * FROM UBankMAIN.staff WHERE id='$delete_id'"; // getting more user information
        	$delete_result = mysql_query($delete_info) or die("Error while getting more information.");
        	$del = mysql_fetch_array($delete_result);
		
        	// inserting into 'staffclosed' & deleting from 'staff' table
        	$deletesql_1 = "INSERT INTO UBankMAIN.staffclosed values('$delete_id','$del[1]','$del[7]','$del[4]','$del[6]','$del[8]','deleted','$delete_reason')";
			mysql_query($deletesql_1) or die("Error while inserting into 'staffclosed' table. (1/2 done)");
			// deleting record from 'staff' table
        	$deletesql_2 = "DELETE FROM UBankMAIN.staff WHERE id='$delete_id'";
        	mysql_query($deletesql_2) or die("Error while deleting user from 'users' table. (2/2 done)");
        	header('location:admin?overview&success=3');

		} else { // delete id == 1 and owner cannot be removed, display error
			header('location:admin?all&error=4');
		}
	} elseif (isset($_REQUEST['delete_record'])){ // Delete user record from deleted user page
		$recordid = $_POST['record_id'];
		
		if ($recordid == ""){ // recordid empty
			header('location:admin?overview&error=5');
		} else { // delete staff from 'staffclosed' table
			$sql_delete1 = "DELETE FROM UBankMAIN.staffclosed WHERE id='$recordid'";
        	mysql_query($sql_delete1) or die("Error deleting staff from 'staffclosed' table.");
			header('location:admin?overview&success=4');
		}
		
	} elseif (isset($_REQUEST['edit_staff'])){ // View note request
		$staffid = $_POST['staff_id'];

		if ($staffid == "1"){ // Don't let admin's change owner information
			header('location:admin?all&error=4');
		} else { // $staffid is not the id of the owner

			$sql2 = "SELECT * FROM UBankMAIN.staff WHERE id='$staffid'";
			$result2 = mysql_query($sql2) or die(mysql_error());
			$res2 = mysql_fetch_array($result2);
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
	
	<title>Editing: <?php echo $res2[1]; ?> | UBank</title>
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
                    <i class="fas fa-user-edit"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Edit Selected Staff Member</div>
				<div class="card-body">
					<form action="admin-edit" method="POST">
						<input type="hidden" name="alter_id" value="<?php echo $staffid;?>"/>
						<table>
							<tr>
								<td width="100px">Full Name</td>
								<td><input class="form-control" type="text" name="alter_name" value="<?php echo $res2[1]; ?>" required /></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td>
									<input type="radio" name="alter_gender" value="M" <?php if ($res2[2]=="M") { echo "checked"; };?> /> Male<br>
									<input type="radio" name="alter_gender" value="F" <?php if ($res2[2]=="F") { echo "checked"; };?> /> Female
								</td>
							</tr>
							<tr>
								<td>DOB</td>
								<td><input class="form-control" type="date" name="alter_dob" value="<?php echo $res2[3]; ?>" required /></td>
							</tr>
							<tr>
								<td>Account type</td>
								<td>
									<select class="form-control" name="alter_account" required="required" >
										<option value="staff" <?php if ($res2[4]=="staff"){ echo "selected"; } ?> >Staff Member</option>
										<option value=""></option>
										<option value="admin" <?php if ($res2[4]=="admin"){ echo "selected"; } ?> >Administrator</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Address</td>
								<td><input class="form-control" type=text name="alter_address" value="<?php echo $res2[5]; ?>" required /></td>
							</tr>
							<tr>
								<td>Mobile</td>
								<td><input class="form-control" type="text" name="alter_mobile" value="<?php echo $res2[6]; ?>" required /></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><input class="form-control" type="email" name="alter_email" value="<?php echo $res2[8]; ?>" required /></td>
							</tr>
							<tr>
								<td>Username</td>
								<td><input class="form-control" type="text" name="alter_username" value="<?php echo $res2[7]; ?>" required /></td>
							</tr>
						</table><br>
						<small>Use the form below ONLY when changing password. Do not enter the old password.</small>
						<table>
							<tr>
								<td>New Password</td>
								<td width="300px"><input type="password" class="form-control" name="alter_new_password" value="" placeholder="Enter new password here." /></td>
							</tr>
							<tr>
								<td>Re-enter Password &nbsp;</td>
								<td><input type="password" class="form-control" name="alter_new_password2" value="" placeholder="Re-enter new password here." /></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="staff_alter" value="Update information"/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>

<?php	
		}
	} elseif (isset($_REQUEST['staff_alter'])){ // Update staff request
		$alterid = $_POST['alter_id'];
		
		$alt_name = mysql_real_escape_string($_REQUEST['alter_name']);
		$alt_gender = mysql_real_escape_string($_REQUEST['alter_gender']);
		$alt_dob = mysql_real_escape_string($_REQUEST['alter_dob']);
		$alt_account = mysql_real_escape_string($_REQUEST['alter_account']);
		$alt_address = mysql_real_escape_string($_REQUEST['alter_address']);
		$alt_mobile = mysql_real_escape_string($_REQUEST['alter_mobile']);
		$alt_username = mysql_real_escape_string($_REQUEST['alter_username']);
		$alt_email = mysql_real_escape_string($_REQUEST['alter_email']);

		$alt_pass=  mysql_real_escape_string($_REQUEST['alter_new_password']);
		$alt_pass2=  mysql_real_escape_string($_REQUEST['alter_new_password2']);

		if ($alt_pass == ""){ // Actions when no new password is provided
			$updatesql = "UPDATE UBankMAIN.staff SET name='$alt_name', gender='$alt_gender', dob='$alt_dob', account='$alt_account', address='$alt_address', mobile='$alt_mobile', username='$alt_username', email='$alt_email' WHERE id='$alterid'";
			mysql_query($updatesql) or die(mysql_error());
			header('location:admin?all&success=2');

		} else { // new password provided
			if ($alt_pass == $alt_pass2){ // the two passwords match
				$salt = "@g26jQsG&nh*&#8v";
				$alt_password = sha1($alt_pass.$salt); // salting password
				
				$updatesql2 = "UPDATE UBankMAIN.staff SET name='$alt_name', gender='$alt_gender', dob='$alt_dob', account='$alt_account', address='$alt_address', mobile='$alt_mobile', username='$alt_username', email='$alt_email', password='$alt_password' WHERE id='$alterid'";
				mysql_query($updatesql2) or die(mysql_error());
				header('location:admin?all&success=2');

			} else { // the two passwords do not match
				header('location:admin?all&error=3');
			}
		}
	} else {
		header("location:admin?all&error=1");
	}
?>