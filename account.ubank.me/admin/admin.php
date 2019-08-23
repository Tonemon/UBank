<?php 
session_start();
include '../_inc/dbconn.php';
        
if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>
<?php include 'displayinfo.php' ?>

<?php
	$delete_id=  mysql_real_escape_string($_REQUEST['editadmin_id']);
	if(isset($_REQUEST['delete_admin'])){
		$sql_delete="DELETE FROM `admin` WHERE `id` = '$delete_id'";
		mysql_query($sql_delete) or die(mysql_error());
		header('location:admin?deleted=1');
	}
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
	
	<title> Admin Settings | UBank</title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

      <div id="content-wrapper">
        <div class="container-fluid">

		<?php if ($real_id == 1){ ?>
		
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
				}
			?>
		  
		  <div class="alert alert-warning alert-dismissible fade show" role="alert">
		    <i class="fas fa-exclamation-triangle"></i>
			<strong>Admin panel: </strong> Watch out while making changes to admin accounts. These can be harmful and irreversible!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <!-- <div class="card-body-icon">
                    <i class="fas fa-user-plus"></i>
                </div> -->
				<div class="card-header">
				  <i class="fas fa-user-plus"></i>
				  Add Admin member</div>
				<div class="card-body">
					<form action="admin-add.php" method="POST">
						<table>
							<tr>
								<td>Admin's name</td>
								<td><input type="text" name="admin_name" required=""/></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td>
									M<input type="radio" name="admin_gender" value="M" checked/>
									F<input type="radio" name="admin_gender" value="F" />
								</td>
							</tr>
							<tr>
								<td>DOB</td>
								<td><input type="date" name="admin_dob" required=""/></td>
							</tr>
							<tr>
								<td>Relationship</td>
								<td>
									<select name="admin_status">
										<option>unmarried</option>
										<option>married</option>
										<option>divorced</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Department</td>
								<td>
									<select name="admin_dept">
										<option>revenue</option>
										<option>developer</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><textarea name="admin_address" required=""></textarea></td>
							</tr>
							<tr>
								<td>Mobile</td>
								<td><input type="text" name="admin_mobile" required=""/></td>
							</tr>

							<tr>
								<td>Username</td>
								<td><input type="text" name="admin_username" required=""/></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input type="password" name="admin_pwd" required=""/></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="add_admin" value="Add Admin member" class='addadmin_button'/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<div class="col-xl-8 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Display/Delete Admin</div>
				<div class="card-body-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
				<div class="card-body">
					<form action="" method="POST">
					<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<?php
							include '../_inc/dbconn.php';
							$sql="SELECT * FROM `admin`";
							$result=  mysql_query($sql) or die(mysql_error());
							$sql_min="SELECT MIN(id) from admin";
							$result_min=  mysql_query($sql_min);
							$rws_min=  mysql_fetch_array($result_min);
						?>
						<thead>
						<tr>
							<th></th>
							<th>id</th>
							<th>name</th>
							<th>username</th>
							<th>mobile</th>
							<th>department</th>
							<th>address</th>
							<th>DOB</th>
							<th>gender</th>
						</tr>
						</thead>
						<tbody>
						<?php
                        while($rws=  mysql_fetch_array($result)){
                            echo "<tr><td><input type='radio' name='editadmin_id' value=".$rws[0];
                            if($rws[0]==$rws_min[0]) echo' checked';
                            echo " /></td>";
                            echo "<td>".$rws[0]."</td>";
                            echo "<td>".$rws[1]."</td>";
							echo "<td>".$rws[8]."</td>";
							echo "<td>".$rws[7]."</td>";
							echo "<td>".$rws[5]."</td>";
							echo "<td>".$rws[6]."</td>";
							echo "<td>".$rws[3]."</td>";
                            echo "<td>".$rws[2]."</td>";
                            echo "</tr>";
                        }
                        ?>
					  </tbody>
					</table>
					</div><br>
					<a href="#" class="btn btn-danger" id="pagesDropdown" data-toggle="modal" data-target="#deleteModal" aria-haspopup="true">Delete admin member</a>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
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
			  <div class="modal-body">Are you sure you want to delete this <b>admin member</b>? It may lead to <b>huge problems</b> if you delete the wrong admin!</div>
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
			<i class='fas fa-times'></i> You don't have the rights to perform this action. Please click <a href="home">here</a> to head back home.
		</div><br><br>
		<?php } ?>
		
<?php include 'afooter.php' ?>