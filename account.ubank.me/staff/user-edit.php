<?php 
session_start();
include '../_inc/dbconn.php';
        
if(!isset($_SESSION['session_staff_start'])) 
    header('location:../staff/');   
?>
<?php

	if (isset($_REQUEST['add_user'])){ // Create new user process

		$new_name = mysql_real_escape_string($_REQUEST['user_name']);
		$new_gender = mysql_real_escape_string($_REQUEST['user_gender']);
		$new_dob = mysql_real_escape_string($_REQUEST['user_dob']);
		$new_account = mysql_real_escape_string($_REQUEST['user_account']);
		$new_country = mysql_real_escape_string($_REQUEST['user_country']);
		$new_address = mysql_real_escape_string($_REQUEST['user_address']);
		$new_mobile = mysql_real_escape_string($_REQUEST['user_mobile']);

		$new_username = mysql_real_escape_string($_REQUEST['user_username']);
		$new_email = mysql_real_escape_string($_REQUEST['user_email']);
		$new_credit = mysql_real_escape_string($_REQUEST['user_credit']);

		// Salting the password for account encryption
		$salt = "@g26jQsG&nh*&#8v";
		$new_password = sha1($_REQUEST['user_password'].$salt);

		// adding Ifsc code with earlier selected country (two numbers are random generated to make Ifsc almost unique)
		$date = date("Y-m-d");
		$specialchar = rand(1,9);
		$specialchar2 = rand(1,9);
		$specialchar3 = chr(rand(65,90)); // random letter

		switch ($new_country){
		case 'United States': $new_ifsc="US".$specialchar.$specialchar2.$specialchar3;
		    break;
		case 'United Kingdom': $new_ifsc="UK".$specialchar.$specialchar2.$specialchar3;
		    break;
		case 'Netherlands': $new_ifsc="NL".$specialchar.$specialchar2.$specialchar3;
		    break;
		}

		// Insert new user to table 'users'
		$sql1 = "INSERT INTO UBankMAIN.users values('','$new_name','$new_gender','$new_dob','$new_account','$new_address','$new_mobile','$new_email','$new_password','$new_username','$new_country','$new_ifsc','','ACTIVE')";
		mysql_query($sql1) or die(header('location:users?overview&error=2')); // Redirect, message: Email/Username exists.

		// Getting new userid from 'users' table and making a passbook.#id# table with the userid
		$sql2 = "SELECT * FROM UBankMAIN.users WHERE name='$new_name'";
		$result = mysql_query($sql2) or die(header('location:users?overview&error=1')); // Redirect, message: Something wrong.
		$rws = mysql_fetch_array($result);

		$insert_id = $rws[0];
		$insert_country = $rws[10];
		$insert_ifsc = $rws[11];

		$sql3 = "CREATE TABLE UBankDAT.passbook".$insert_id." (transactionid int(5) AUTO_INCREMENT, transactiondate date, name VARCHAR(255), branch VARCHAR(255), ifsc VARCHAR(255), credit int(10), debit int(10), amount float(10,2), narration VARCHAR(255), PRIMARY KEY (transactionid))";
		mysql_query($sql3) or die(header('location:users?overview&error=1')); // Redirect, message: Something wrong.

		// Inserting record with amount into users passbook
		$sql4 = "INSERT INTO UBankDAT.passbook".$insert_id." values('','$date','$new_name','$insert_country','$insert_ifsc','$new_credit','0','$new_credit','Account Open')";
		mysql_query($sql4) or die(header('location:users?overview&error=1')); // Redirect, message: Something wrong.
		header('location:users?overview&success=1');

	} elseif (isset($_REQUEST['delete_user'])){ // Delete user process
		$deleteid = mysql_real_escape_string($_REQUEST['user_id']);

		// Delete user from 'users' table
			$sql_delete1 = "DELETE FROM UBankMAIN.users WHERE id='$deleteid'";
			mysql_query($sql_delete1) or die(mysql_error());

		// Delete users passbook table
			$sql_delete2 = "DROP TABLE UBankDAT.passbook".$deleteid;
			mysql_query($sql_delete2) or die(mysql_error());

		// Delete users contacts and set receiver contact to 'ACCOUNT REMOVED'
			$sql_delete3 = "DELETE FROM UBankMAIN.contacts WHERE sender_id='$delete_id'";
 			mysql_query($sql_delete3) or die(mysql_error());
			$sql_delete4 = "UPDATE UBankMAIN.contacts SET status='ACCOUNT REMOVED' WHERE reciever_id='$delete_id'";
			mysql_query($sql_delete4) or die(header('location:users?overview&error=1'));

		header('location:users?all&success=3');
		//echo "<script type='text/javascript'> window.location.href = 'customer?deleted=1';</script>";

	} elseif (isset($_REQUEST['delete_record'])){ // Delete user record from deleted user page
		$recordid = $_POST['record_id'];
		
		if ($recordid == ""){ // Recordid empty (no record selected to delete)
			header('location:users?deleted&error=4'); // Redirect, message: no record selected to delete

		} else { // Delete user from 'usersclosed' table
			$sql_delete1 = "DELETE FROM UBankMAIN.usersclosed WHERE id='$recordid'";
        	mysql_query($sql_delete1) or die(header('location:users?deleted&error=1')); // Redirect, message: Something wrong.
			header('location:users?overview&success=4');
		}

	} elseif (isset($_REQUEST['new_delete'])){ // Delete record from account requests page
		$newuserid = $_POST['newuser_id'];

		if ($newuserid == ""){ // Newuserid empty (no record selected to delete)
			header('location:users?overview&error=4'); // Redirect, message: no record selected to delete

		} else { // Delete user from 'newusers' table
			$sql_delete1 = "DELETE FROM UBankMAIN.newusers WHERE id='$newuserid'";
        	mysql_query($sql_delete1) or die(header('location:users?deleted&error=1')); // Redirect, message: Something wrong.
			header('location:users?overview&success=4');
		}

	} elseif (isset($_REQUEST['new_approve'])){ // Approve account creation request
		$addid = mysql_real_escape_string($_REQUEST['newuser_id']);
		$sql1 = "SELECT * FROM UBankMAIN.newusers WHERE id=$addid";
		$result1 = mysql_query($sql1) or die(mysql_error());
		$res = mysql_fetch_array($result1);

		$add_name = $res[1];
		$add_gender = $res[4];
		$add_dob = $res[5];
		$add_account = $res[6];
		$add_country = $res[10];
		$add_address = $res[7];
		$add_mobile = $res[8];

		$add_username = $res[2];
		$add_email = $res[3];
		$add_credit = "0";

		// Salting the password for account encryption
		$salt = "@g26jQsG&nh*&#8v";
		$add_password = sha1($res[9].$salt);

		// adding Ifsc code with earlier selected country (two numbers are random generated to make Ifsc almost unique)
		$date = date("Y-m-d");
		$specialchar = rand(1,9);
		$specialchar2 = rand(1,9);
		$specialchar3 = chr(rand(65,90)); // random letter

		switch ($add_country){
		case 'United States': $add_ifsc="US".$specialchar.$specialchar2.$specialchar3;
		    break;
		case 'United Kingdom': $add_ifsc="UK".$specialchar.$specialchar2.$specialchar3;
		    break;
		case 'Netherlands': $add_ifsc="NL".$specialchar.$specialchar2.$specialchar3;
		    break;
		}

		// Insert new user to table 'users'
		$sql2 = "INSERT INTO UBankMAIN.users values('','$add_name','$add_gender','$add_dob','$add_account','$add_address','$add_mobile','$add_email','$add_password','$add_username','$add_country','$add_ifsc','','ACTIVE')";
		mysql_query($sql2) or die(header('location:users?overview&error=2')); // Redirect, message: Email/Username exists.

		// Getting new userid from 'users' table and making a passbook.#id# table with the userid
		$sql3 = "SELECT * FROM UBankMAIN.users WHERE name='$add_name'";
		$result3 = mysql_query($sql3) or die(header('location:users?overview&error=1')); // Redirect, message: Something wrong.
		$rws = mysql_fetch_array($result3);

		$insert_id = $rws[0];
		$insert_country = $rws[10];
		$insert_ifsc = $rws[11];

		$sql4 = "CREATE TABLE UBankDAT.passbook".$insert_id." (transactionid int(5) AUTO_INCREMENT, transactiondate date, name VARCHAR(255), branch VARCHAR(255), ifsc VARCHAR(255), credit int(10), debit int(10), amount float(10,2), narration VARCHAR(255), PRIMARY KEY (transactionid))";
		mysql_query($sql4) or die(header('location:users?overview&error=1')); // Redirect, message: Something wrong.

		// Inserting record with amount into users passbook
		$sql5 = "INSERT INTO UBankDAT.passbook".$insert_id." values('','$date','$add_name','$insert_country','$insert_ifsc','$add_credit','0','$add_credit','Account Open')";
		mysql_query($sql5) or die(header('location:users?overview&error=1')); // Redirect, message: Something wrong.
		header('location:users?overview&success=1');

		// removing the account request record in the customernew table
		$sql6 = "DELETE FROM UBankMAIN.newusers WHERE id='$addid'";
		mysql_query($sql6) or die(header('location:users?overview&error=1')); // Redirect, message: Something wrong.
		header('location:users?overview&success=1');

	} elseif (isset($_REQUEST['edit_user'])){ // Edit user information
		$userid = $_POST['user_id'];

		$sql1 = "SELECT * FROM UBankMAIN.users WHERE id=$userid";
		$result1 = mysql_query($sql1) or die(mysql_error());
		$res2 = mysql_fetch_array($result1);
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
	    
	<title>User Edit | UBank Staff Dashboard</title>
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
			  <div class="card o-hidden mb-3">
			    <div class="card-body-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Edit Selected User</div>
				<div class="card-body">
					<form action="user-edit.php" method="POST">
						<input type="hidden" name="alter_id" value="<?php echo $userid;?>"/>
						<table>
							<tr>
								<td width="100px">Full Name</td>
								<td><input class="form-control" type="text" name="alter_name" value="<?php echo $res2[1]; ?>" required=""/></td>
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
										<option value="current" <?php if ($res2[4]=="current"){ echo "selected"; } ?> >Current account</option>
										<option value="savings" <?php if ($res2[4]=="savings"){ echo "selected"; } ?> >Savings account</option>
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
								<td><input class="form-control" type="email" name="alter_email" value="<?php echo $res2[7]; ?>" required /></td>
							</tr>
							<tr>
								<td>Username</td>
								<td><input class="form-control" type="text" name="alter_username" value="<?php echo $res2[9]; ?>" required /></td>
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
						<input type="submit" class="btn btn-success" name="user_alter" value="Update information"/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>

<?php	
	} elseif (isset($_REQUEST['user_alter'])){ // Update user request
		include '../_inc/dbconn.php';
		$alterid = $_POST['alter_id'];
		
		$alt_name = mysql_real_escape_string($_REQUEST['alter_name']);
		$alt_gender = mysql_real_escape_string($_REQUEST['alter_gender']);
		$alt_dob = mysql_real_escape_string($_REQUEST['alter_dob']);
		$alt_account = mysql_real_escape_string($_REQUEST['alter_account']);
		$alt_address = mysql_real_escape_string($_REQUEST['alter_address']);
		$alt_mobile = mysql_real_escape_string($_REQUEST['alter_mobile']);
		$alt_username = mysql_real_escape_string($_REQUEST['alter_username']);
		$alt_email = mysql_real_escape_string($_REQUEST['alter_email']);

		$alt_pass = mysql_real_escape_string($_REQUEST['alter_new_password']);
		$alt_pass2 = mysql_real_escape_string($_REQUEST['alter_new_password2']);

		if ($alt_pass == ""){ // Actions when no new password is provided
			$updatesql = "UPDATE UBankMAIN.users SET name='$alt_name', gender='$alt_gender', dob='$alt_dob', account='$alt_account', address='$alt_address', mobile='$alt_mobile', email='$alt_email', username='$alt_username' WHERE id='$alterid'";
			mysql_query($updatesql) or die(mysql_error());
			header('location:users?all&success=2');

		} else { // new password provided
			if ($alt_pass == $alt_pass2){ // the two passwords match
				$salt = "@g26jQsG&nh*&#8v";
				$alt_password = sha1($alt_pass.$salt); // salting password
				
				$updatesql2 = "UPDATE UBankMAIN.users SET name='$alt_name', gender='$alt_gender', dob='$alt_dob', account='$alt_account', address='$alt_address', mobile='$alt_mobile', email='$alt_email', password='$alt_password', username='$alt_username' WHERE id='$alterid'";
				mysql_query($updatesql2) or die(mysql_error());
				header('location:users?all&success=2');

			} else { // the two passwords do not match
				header('location:users?all&error=3');
			}
		}
	} else {
		header("location:users?all&error=1");
	}
?>