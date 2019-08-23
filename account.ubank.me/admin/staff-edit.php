<?php 
session_start();
include '../_inc/dbconn.php';

if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>
<?php
include '../_inc/dbconn.php';
$id=  mysql_real_escape_string($_REQUEST['staff_id']);
$sql="SELECT * FROM `staff` WHERE id=$id";
$result=  mysql_query($sql) or die(mysql_error());
$rws=  mysql_fetch_array($result);
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
	
	<title> Staff Edit | UBank</title>
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
					<?php
                        $delete_id=  mysql_real_escape_string($_REQUEST['staff_id']);
                        if(isset($_REQUEST['submit2_id'])){
                            $sql_delete="DELETE FROM `staff` WHERE `id` = '$delete_id'";
                            mysql_query($sql_delete) or die(mysql_error());
                            echo "<script type='text/javascript'> window.location.href = 'staff?deleted=1';</script>";
                        }
                    ?>
					<form action="staff-alter.php" method="POST">
					<table>
						<input type="hidden" name="current_id" value="<?php echo $id;?>"/>
						<tr>
							<td>Staff's name</td>
							<td><input type="text" name="edit_name" value="<?php echo $rws[1];?>" required=""/></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td>
								M<input type="radio" name="edit_gender" value="M" <?php if($rws[10]=="M") echo "checked";?>/>
								F<input type="radio" name="edit_gender" value="F" <?php if($rws[10]=="F") echo "checked";?>/>
							</td>
						</tr>
						<tr>
							<td>
								DOB
							</td>
							<td>
								<input type="date" name="edit_dob" value="<?php echo $rws[2];?>"/>
							</td>
						</tr>
						<tr>
							<td>Relationship</td>
							<td>
								<select name="edit_status">
									<option <?php if($rws[3]=="unmarried") echo "selected";?>>unmarried</option>
									<option <?php if($rws[3]=="married") echo "selected";?>>married</option>
									<option <?php if($rws[3]=="divorced") echo "selected";?>>divorced</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Department</td>
							<td>
								<select name="edit_dept">
									<option <?php if($rws[4]=="revenue") echo "selected";?>>revenue</option>
									<option <?php if($rws[4]=="developer") echo "selected";?>>developer</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								DOJ
							</td>
							<td>
								<input type="date" name="edit_doj" value="<?php echo $rws[5];?>"/>
							</td>
						</tr>
						<tr>
							<td>Address:</td>
							<td><textarea name="edit_address"><?php echo $rws[6];?></textarea></td>
						</tr>
						
							<td>Mobile</td>
							<td><input type="text" name="edit_mobile" value="<?php echo $rws[7];?>" required=""/></td>
						</tr>
						<tr>
							<td>Email id</td>
							<td><input type="text" name="edit_email" value="<?php echo $rws[8];?>" required=""/></td>
						</tr>
					</table><br>
					<input type="submit" class="btn btn-success" name="alter" value="Update information"/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>