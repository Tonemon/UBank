<?php 
session_start();
include '../_inc/dbconn.php';
        
if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
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
	
	<title> Customer Settings | UBank</title>
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
				if (isset($_GET['add'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						New Customer added. </div>";
				} elseif (isset($_GET['deleted'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Customer deleted.</div>";
				} elseif (isset($_GET['edit'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Customer information changed.</div>";
				} elseif (isset($_GET['error'])) {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Oh. Something went wrong. Please try again.</div>";
				}
			?>
		  
		  <!-- Display sections -->
		  <div class="row text-center">
				  <div class="col-md-3"></div>
				  <div class="col-md-6">
						<select id="sectionselector" class="form-control" data-error="Select your category.">
							<option value="" disabled>Select section to show below...</option>
							<option value="section_new" selected>Add New customer / Requests</option>
							<option value="section_old">Existing Customers</option>
						</select>
				  </div>
				  <div class="col-md-3"></div>
		  </div>
		  <script src="../vendor/jquery/jquery.min.js"></script>
		  <script type="text/javascript">
			$(function() {
				$('#sectionselector').change(function(){
					$('.sectionshow').hide();
					$('#' + $(this).val()).show();
				});
			});
		  </script><br>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row sectionshow" id="section_old" style="display:none">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Display/Edit Customer</div>
				<div class="card-body-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
				<div class="card-body">
					<form action="customer-edit.php" method="POST">
					<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<?php
							include '../_inc/dbconn.php';
							$sql="SELECT * FROM `customer`";
							$result=  mysql_query($sql) or die(mysql_error());
							$sql_min="SELECT MIN(id) from customer";
							$result_min=  mysql_query($sql_min);
							$rws_min=  mysql_fetch_array($result_min);
						?>
						<thead>
						<tr>
							<th></th>
							<th>id</th>
							<th>name</th>
							<th>email</th>
							<th>mobile</th>
							<th>account type</th>
							<th>address</th>
							<th>Branch/Country</th>
							<th>Ifsc Code</th>
						</tr>
						</thead>
						<tbody>
						<?php
                        while($rws=  mysql_fetch_array($result)){
                            echo "<tr><td><input type='radio' name='customer_id' value=".$rws[0];
                            if($rws[0]==$rws_min[0]) echo' checked';
                            echo " /></td>";
                            echo "<td>".$rws[0]."</td>";
                            echo "<td>".$rws[1]."</td>";
							echo "<td>".$rws[8]."</td>";
							echo "<td>".$rws[7]."</td>";
							echo "<td>".$rws[5]."</td>";
							echo "<td>".$rws[6]."</td>";
                            echo "<td>".$rws[10]."</td>";
                            echo "<td>".$rws[11]."</td>";
                            echo "</tr>";
                        }
                        ?>
					  </tbody>
					</table>
					</div><br>
					<input type="submit" class="btn btn-warning" name="submit_id" value="Edit Customer" />
					<a href="#" class="btn btn-danger" id="pagesDropdown" data-toggle="modal" data-target="#deleteModal" aria-haspopup="true">Delete customer</a>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
		  
		  <!-- Delete customer Modal-->
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Are you sure?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			  </div>
			  <div class="modal-body">Are you sure you want to delete this customer?</div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<input type="submit" class="btn btn-danger" name="submit2_id" value="Delete Customer" />
				</form>
			  </div>
			</div>
		  </div>
		</div>
		
		  <!-- new customers row -->
		  <div class="row sectionshow" id="section_new">
		    <div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <div class="card-body-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-plus"></i>
				  Add Customer</div>
				<div class="card-body">
					<form action="customer-add.php" method="POST">
						<table align="center">
							<tr>
								<td> Customer's name</td>
								<td><input type="text" name="customer_name" required=""/></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td>
									M<input type="radio" name="customer_gender" value="M" checked/>
									F<input type="radio" name="customer_gender" value="F" />
								</td>
							</tr>
							<tr>
								<td>DOB</td>
								<td><input type="date" name="customer_dob" required=""/></td>
							</tr>
							<tr>
								<td>Nominee</td>
								<td><input type="text" name="customer_nominee" required=""/></td>
							</tr>
							<tr>
								<td>Country</td>
								<td>
									<select name="branch">
										<option value="United States">United States (US)</option>
										<option value="United Kingdom">United Kingdom (UK)</option>
										<option value="Netherlands">Netherlands (NL)</option>
										
									</select>
								</td>
							</tr>
							<tr>
								<td>Account type</td>
								<td>
									<select name="customer_account">
										<option>savings</option>
										<option>current</option>
										
									</select>
								</td>
							</tr>
							<tr>
								<td>Minimum amount</td>
								<td><input type="text" name="initial" value="1000" min="1000" required=""/></td>
							</tr>
							
							<tr>
								<td>Address:</td>
								<td><textarea name="customer_address" required=""></textarea></td>
							</tr>
							<tr>
								<td>Mobile</td>
								<td><input type="text" name="customer_mobile" required=""/></td>
							</tr>

							<tr>
								<td>Email id</td>
								<td><input type="email" name="customer_email" required=""/></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input type="password" name="customer_pwd" required=""/></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="add_customer" value="Add Customer" />
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<div class="col-xl-8 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Approve new customer account requests</div>
				<div class="card-body-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
				<div class="card-body">
					<form action="customer-approving.php" method="POST">
					<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<?php
							include '../_inc/dbconn.php';
							$sql="SELECT * FROM customernew";
							$result=  mysql_query($sql) or die(mysql_error());
							$sql_min="SELECT MIN(id) from customernew";
							$result_min=  mysql_query($sql_min);
							$rws_min=  mysql_fetch_array($result_min);
						?>
						<thead>
						<tr>
							<th></th>
							<th>id</th>
							<th>Name</th>
							<th>Account</th>
							<th>Branch/Country</th>
							<th>Address</th>
							<th>Mobile</th>
							<th>Birthdate</th>
							<th>Gender</th>
						</tr>
						</thead>
						<tbody>
						<?php
                        while($rws=  mysql_fetch_array($result)){
                            echo "<tr><td><input type='radio' name='newcustomer_id' value=".$rws[0];
                            if($rws[0]==$rws_min[0]) echo' checked';
                            echo " /></td>";
                            echo "<td>".$rws[0]."</td>";
                            echo "<td><b>".$rws[1]."</b> (".$rws[7].")</td>";
							echo "<td>".$rws[4]."</td>";
							echo "<td>".$rws[9]."</td>";
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
					<input type="submit" class="btn btn-success" name="approvenew" value="Approve Customer Request" />
					<input type="submit" class="btn btn-danger" name="deletenew" value="Delete Customer Request" />
				  </form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>