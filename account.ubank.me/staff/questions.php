<?php 
	session_start();
	if (!isset($_SESSION['session_staff_start'])) 
    	header('location:../staff/');

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
	
	<title>Questions Page | UBank Staff Dashboard</title>
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
						<i class='fas fa-check'></i> New staff member added. </div>";
				} elseif ($_GET['success'] == "2") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Staff information changed.</div>";
				} elseif ($_GET['success'] == "3") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Staff member deleted.</div>";
				} elseif ($_GET['success'] == "4") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Staff record deleted.</div>";
				} elseif ($_GET['error'] == "1") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Oh. Something went wrong. Please try again.</div>";
				} elseif ($_GET['error'] == "2") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> This Email address or username already exists! Please choose another one and try again.</div>";
				} elseif ($_GET['error'] == "3") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-warning alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-exclamation-triangle"></i> The submitted passwords do not match. No information was changed.</div>';
				} elseif ($_GET['error'] == "4") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-exclamation-triangle"></i> You <b>cannot</b> remove/edit the <b>owner account</b> (id 1). This would make a lot of functions unusable.</div>';
				} elseif ($_GET['error'] == "5") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-warning alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-exclamation-triangle"></i> Please select a staff record first from the "deleted staff" section to delete.</div>';
				} 
			?>
		<?php if ($staffdat_account == "staff" OR $staffdat_id == "1"){ ?>
		  
		  <div class="row text-center">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<select class="form-control" data-error="Select your category." onchange="javascript:location.href = this.value;">
					<option value="" selected disabled>Select section to show below...</option>
					<option value="?review">'To Review' questions</option>
					<option value="?reviewed">'Reviewed' questions</option>
				</select>
			</div>
			<div class="col-md-3"></div>
		  </div><br>
		  
		  <div class="row">

		  	<!-- Display different sections using php isset(GET) -->
		<?php if (isset($_GET['review'])) { ?>
		    <div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-tasks"></i> Question Review Panel</div>
				<div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-body">
				  <?php
					include '../_inc/dbconn.php';
					$sql1 = "SELECT * FROM UBankDAT.questions WHERE status='TO REVIEW' OR status='DOING'";
					$result = mysql_query($sql1) or die(mysql_error());
				  ?>
				  <form action="process" method="POST">
				  <div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					  <thead>
						<tr>
							<th>select</th>
							<th>Sender</th>
							<th>Category</th>
							<th>Message</th>
							<th>Status</th>
							<th>From</th>
							<th>Date</th>
							
						</tr>
					  </thead>
					  <tbody>
						<?php
							while($rws=  mysql_fetch_array($result)){
								echo "<tr><td><input type='radio' name='question_id' value=".$rws[0];
								echo ' checked';
								echo " /></td>";
								echo "<td><b>".$rws[1]."</b> (".$rws[2].")</td>";
								echo "<td>".$rws[3]."</td>";
								echo "<td>".$rws[4]."</td>";
								echo "<td>".$rws[5]." ";
								if ($rws[6] != ""){ echo "<br>(<b>".$rws[6]."</b>)</td>"; };
								echo "<td>".$rws[7]."</td>";
								echo "<td>".$rws[8]."</td>";
								echo "</tr>";
							}
						?>
					  </tbody>
					</table><br>
					<input type="submit" class="btn btn-success" name="question_done" value="Mark Question as 'Done'" />
					<input type="submit" class="btn btn-warning" name="question_doing" value="Mark Question as 'Doing'" />
					<input type="submit" class="btn btn-danger" name="question_delete" value="Delete Question" />
				  </div>
				  </form>
				</div>
			  </div>
		    </div>

		<?php } elseif (isset($_GET['reviewed'])) { ?>
		    <div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-tasks"></i> Reviewed Questions</div>
				<div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-body">
				  <?php
					include '../_inc/dbconn.php';
					$sql="SELECT * FROM UBankDAT.questions WHERE status='REVIEWED'";
					$result=  mysql_query($sql) or die(mysql_error());
				  ?>
				  <form action="process" method="POST">
				  <div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					  <thead>
						<tr>
							<th>select</th>
							<th>Sender</th>
							<th>Category</th>
							<th>Message</th>
							<th>Status</th>
							<th>From</th>
							<th>Reviewer</th>
							
						</tr>
					  </thead>
					  <tbody>
						<?php
							while($rws=  mysql_fetch_array($result)){
								echo "<tr><td><input type='radio' name='question_id' value=".$rws[0];
								echo ' checked';
								echo " /></td>";
								echo "<td><b>".$rws[1]."</b> (".$rws[2].")</td>";
								echo "<td>".$rws[3]."</td>";
								echo "<td>".$rws[4]."</td>";
								echo "<td>".$rws[5]." ";
								if ($rws[6] != ""){ echo "<br>(<b>".$rws[6]."</b>)</td>"; };
								echo "<td>".$rws[7]."</td>";
								echo "<td>".$rws[6]."</td>";
								echo "</tr>";
							}
						?>
					  </tbody>
					</table><br>
					<input type="submit" class="btn btn-success" name="question_review" value="Mark Question as 'TO REVIEW'" />
					<input type="submit" class="btn btn-danger" name="question_delete" value="Delete Question" />
				  </div>
				  </form>
				</div>
			  </div>
		   </div>
		<?php } // close the php sections ?>

		</div> <!-- /.row -->
		<?php } else { ?>
			<div class='alert alert-danger'>
				<i class='fas fa-times'></i> You don't have the rights to perform this action. Please click <a href="dashboard">here</a> to head back home.
			</div><br><br>
		<?php } // header('location:../staff/'); and then display this message ?>
		  
    </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>