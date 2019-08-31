<?php 
session_start();
        
if(!isset($_SESSION['session_user_start'])) 
    header('location:index.php');   
?>
<?php include 'displayinfo.php' ?>

<?php
	if (isset($_REQUEST['contact_delete'])){ // Delete contact process
		$sender_id = $userdat_id; // getting variable from displayinfo.php linked at the top
		$sender_name = $userdat_name;
	
		include '_inc/dbconn.php';
		$realid = $_REQUEST["contact_id"];

		// added more statements to make the deletion more precise
		$sql1 = "DELETE FROM UBankMAIN.contacts WHERE id='$realid' AND sender_id='$sender_id' AND sender_name='$sender_name'";
		$result = mysql_query($sql1) or die(mysql_error());
		header("location:contacts?success=2");

	} elseif (isset($_REQUEST['contact_add'])){ // Create contact process
		$sender_id = $userdat_id;
		$sender_name = $userdat_name;
                
		$contact_name = $_REQUEST['con_name'];
		$contact_accno = $_REQUEST['con_accountno'];
		$contact_ifsc = $_REQUEST['con_ifsc'];
		$contact_branch = $_REQUEST['con_country'];
        
		// requesting information to check if already contact connection
		include '_inc/dbconn.php';
		$sql1 = "SELECT * FROM UBankMAIN.contacts WHERE sender_id='$sender_id' AND reciever_id='$contact_accno'";
		$result1 = mysql_query($sql1) or die(mysql_error());
		$rws1 = mysql_fetch_array($result1);
		$check_sender = $rws1[1]; // sender id from contacts database
		$check_receiver = $rws1[3]; // receiver id from contacts database

		// getting information of contact to compare if information correct        
		$sql2 = "SELECT * FROM UBankMAIN.users WHERE id='$contact_accno'";
		$result2 = mysql_query($sql2) or die(mysql_error());
		$rws2 = mysql_fetch_array($result2) ;
                
		// You can't send request to yourself 
		if ($sender_id == $rws2[0]) {
			header('location:contacts?error=2');

		// You can't add the same contact twice
		} elseif ($check_sender == $sender_id && $check_receiver == $contact_accno) {
			header('location:contacts?error=3');

		// when all contact info is right
		} elseif ($rws2[0] == $contact_accno && $rws2[1] == $contact_name && $rws2[10] == $contact_branch && $rws2[11] == $contact_ifsc) { 
			$sql = "INSERT INTO UBankMAIN.contacts values('','$sender_id','$sender_name','$contact_accno','$contact_name','ACTIVE')";
			mysql_query($sql) or die(mysql_error());
			header("location:contacts?success=1");

		// when something is wrong or user not found
		} else { 
			header('location:contacts?error=1');
		}

	} else { // Display the contacts page
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
			
			<?php
				if ($_GET['success'] == "1") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Contact added. Please wait as the request is being reviewed. </div>";
				} elseif ($_GET['success'] == "2") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Contact deleted successfully.</div>";
				} elseif ($_GET['success'] == "2") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Contact deleted successfully.</div>";
				} elseif ($_GET['error'] == "1") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Something went wrong. Please try again.</div>";
				} elseif ($_GET['error'] == "2") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Error: You cannot add yourself as a contact!</div>";
				} elseif ($_GET['error'] == "3") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Error: You cannot add a contact twice!</div>";
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
					
					<form action="contacts" method="POST">
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
					<a href="#" class="btn btn-danger" id="pagesDropdown" data-toggle="modal" data-target="#deleteContactModal" aria-haspopup="true"><i class="fas fa-trash-alt"></i> Delete Contact</a>
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
					<button type="submit" class="btn btn-danger" name="contact_delete"><i class="fas fa-trash-alt"></i> Delete Contact</button>
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
					<form action='contacts' method='POST'>
						<table>
							<tr><td><span class="heading">Contact Name: </span></td><td><input class="form-control" type='text' name='con_name' required></td></tr>
							<tr><td><span class="heading">Account No: </span></td><td><input class="form-control" type='text' name='con_accountno' required></td></tr>
							<tr><td><span class="heading">Ifsc Code: </span><br><small><a href="#" id="pagesDropdown" data-toggle="modal" data-target="#informationModal">What is this?</a></small></td>
								<td><input class="form-control" type='text' name='con_ifsc' required></td></tr>
							<tr><td><span class="heading">Select Country: &nbsp;</span></td><td>
							<select class="form-control" name="con_country" required>
								<option value='United States'>United States (US)</option>
								<option value='United Kingdom'>United Kingdom (UK)</option>
								<option value='Netherlands'>Netherlands (NL)</option>
							</select></td></tr>
						</table><br>
						<button type="submit" class="btn btn-success" name="contact_add"><i class="fas fa-check"></i> Add New Contact</button>
						<a href="#" class="btn btn-warning" id="pagesDropdown" data-toggle="modal" data-target="#informationModal"><i class="fas fa-life-ring"></i> Help</a>
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

<?php } ?>