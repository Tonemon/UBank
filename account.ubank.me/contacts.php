<?php 
session_start();
        
if(!isset($_SESSION['session_user_start'])) 
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
	
	<title><?php echo $userdat_name; ?>'s Contacts | UBank Online Banking</title>
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
		  
		  <!-- Cookies 
			<div class="alert alert-info alert-icon-block alert-dismissible" role="alert" >
				<div class="alert-icon">
					<span class="icon-question-circle"></span>
                </div>
                <i class="fas fa-fw fa-info-circle"></i>  We use cookies to offer you the best experience on our website. Continuing browsing, you accept our cookie policy.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
            </div> -->
			
			<?php
				if (isset($_GET['success'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Contact added. Please wait as the request is being reviewed. </div>";
				} elseif (isset($_GET['deleted'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Contact deleted successfully.</div>";
				}
			?>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-8 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="fas fa-address-book"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-address-book"></i>
				  View / Delete your Contacts</div>
				<div class="card-body">
					<?php
						include '_inc/dbconn.php';
						$requester_id = $_SESSION["session_user_id"];
						$sql = "SELECT * FROM UBankMAIN.contacts WHERE sender_id='$requester_id'";
						$result=  mysql_query($sql) or die(mysql_error());
					?>
					
					<form action="process_contact_delete.php">
					<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<?php
							include '_inc/dbconn.php';
							$request_id=$_SESSION["session_user_id"];
							$sql="SELECT * FROM UBankMAIN.contacts WHERE sender_id='$request_id'";
							$result=  mysql_query($sql) or die(mysql_error());
						?>
						<thead>
						<tr>
							<th>Select</th>
							<th>Name of Contact</th>
							<th>Connection Status</th>
							<th>Contact Account No</th>
							</tr>
					  </thead>
					  <tbody>
						<?php
                        while ($rws = mysql_fetch_array($result)){
                            
                            echo "<tr><td><input type='radio' name='contact_id' value=".$rws[0];
                            echo ' checked';
                            echo " /></td>";
                            echo "<td>".$rws[4]."</td>";
                            echo "<td>".$rws[5]."</td>";
                            echo "<td>".$rws[3]."</td>";
                           
                            echo "</tr>";
                        } ?>
					  </tbody>
					</table>
					<p><i class="fas fa-info-circle"></i> <i>You can re-add the same contact if you deleted it on accident.</i></p>
					<a href="#" class="btn btn-danger" id="pagesDropdown" data-toggle="modal" data-target="#deleteContactModal" aria-haspopup="true">Delete Contact</a>
					</div>
				</div>
			  </div>
			</div>
			
			<!-- Delete contact Modal-->
			<div class="modal fade" id="deleteContactModal" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Are you sure?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">×</span>
					</button>
				  </div>
				  <div class="modal-body">Are you sure you want to delete this contact? You can re-add the same contact when deleted on accident.</div>
				  <div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-danger" name="contact_delete" value="Delete Contact" />
					</form>
				  </div>
				</div>
			  </div>
			</div>
			
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-plus"></i>
				  Add Contact</div>
				<div class="card-body">
					<form action='process_contact_add.php' method='post'>
						<table>
							<tr><td><span class="heading">Contact Name: </span></td><td><input class="form-control" type='text' name='contact_name' required></td></tr>
							<tr><td><span class="heading">Account No: </span></td><td><input class="form-control" type='text' name='contact_account_no' required></td></tr>
							<tr><td><span class="heading">Ifsc Code: </span><br><small><a href="#" id="pagesDropdown" data-toggle="modal" data-target="#informationModal">What is this?</a></small></td>
								<td><input class="form-control" type='text' name='contact_ifsc_code' required></td></tr>
							<tr><td><span class="heading">Select Country: &nbsp;</span></td><td>
							<select class="form-control" name="contact_branch_select" required>
								<option value='United States'>United States (US)</option>
								<option value='United Kingdom'>United Kingdom (UK)</option>
								<option value='Netherlands'>Netherlands (NL)</option>
							</select></td></tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="submitBtn" value="Add New Contact" class="addstaff_button">
						<a href="#" class="btn btn-warning" id="pagesDropdown" data-toggle="modal" data-target="#informationModal">Help!</a>
					</form><br>
					<i><p><i class='fas fa-info-circle'></i> Give your Card details to the person you are doing business with so he can transfer the funds to you.</p></i>
				</div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
		
		<div class="modal fade" id="informationModal" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i> Adding new Contacts</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">×</span>
					</button>
				  </div>
				  <div class="modal-body">
					<p> To add someone to your contact list you will need some information about the person. This information is used to verify
					and connect you to that person so it's possible to make fund transfers in the future.<br><br> The following information is essential and <b><u>must be the same as on the card</u></b>, otherwise the person wil not be found.
					The following information can be found on your <i class="fab fa-cc-mastercard"></i> <b>Mastercard</b>, <i class="fas fa-credit-card"></i><b> Creditcard </b>or <i class="fab fa-cc-visa"></i><b> Visa Card</b>.
						<ul>
							<li><b>Contact name</b>, must be right, can't be a nickname.</li>
							<li><b>Account number</b>, to make the funds to.</li>
							<li><b>Ifsc code</b>, can be found on the front of the card.</li>
							<li><b>Branch</b>, can be found next to the Ifsc code.</li>
						</ul>
					The Ifsc code exists of 5 characters, the first 2 letters of the branch/country, 2 random numbers and 1 letter. For example, a ifsc code for a user in the Netherlands could be: NL39E. 
					</p>
				  </div>
				  <div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
		</div>

    <?php include 'afooter.php' ?>