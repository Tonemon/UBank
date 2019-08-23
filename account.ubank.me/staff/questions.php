<?php 
session_start();
        
if(!isset($_SESSION['staff_login'])) 
    header('location:../staff/');   
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
	
	<title>Question Review Page | UBank</title>
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
			if (isset($_GET['done'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Question successfully marked as 'Done'.</div>";
			} elseif (isset($_GET['deleted'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Question successfully deleted.</div>";
			} elseif (isset($_GET['doing'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Question successfully marked as 'doing'.</div>";
			} elseif (isset($_GET['review'])) {
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i>
					Question successfully marked as 'to review'.</div>";
			} elseif (isset($_GET['error'])) {
				echo "<div class='alert alert-warning alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i>
					Oops, something went wrong. Please try again.</div>";
			}
		  ?>
		  
		  <!-- Display sections -->
		  <div class="row text-center">
				  <div class="col-md-3"></div>
				  <div class="col-md-6">
						<select id="sectionselector" class="form-control" data-error="Select your category.">
							<option value="" disabled>Select section to show below...</option>
							<option value="section_review" selected>'Questions Review' Section</option>
							<option value="section_reviewed">'Reviewed Questions' Section</option>
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
		  
		  <!-- Real Cards beginning -->
		  <div class="row">
		    <div class="col-xl-12 mb-6 sectionshow" id="section_review">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-tasks"></i> Question Review Panel</div>
				<div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-body">
				  <?php
					include '../_inc/question_dbconn.php';
					$sql1="SELECT * FROM questions WHERE status='TO REVIEW' OR status='DOING'";
					$result=  mysql_query($sql1) or die(mysql_error());
				  ?>
				  <form action="process_question.php" method="POST">
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
								echo "<td>".$rws[5]."</td>";
								echo "<td>".$rws[7]."</td>";
								echo "<td>".$rws[8]."</td>";
								echo "</tr>";
							}
						?>
					  </tbody>
					</table><br>
					<input type="submit" class="btn btn-success" name="q_done" value="Mark Question as 'Done'" />
					<input type="submit" class="btn btn-warning" name="q_doing" value="Mark Question as 'Doing'" />
					<input type="submit" class="btn btn-danger" name="q_delete" value="Delete Question" />
				  </div>
				  </form>
				</div>
			  </div>
		    </div>
		    <div class="col-xl-12 mb-6 sectionshow" id="section_reviewed" style="display:none">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-tasks"></i> Reviewed Questions</div>
				<div class="card-body-icon">
                    <i class="fas fa-users"></i>
                </div>
				<div class="card-body">
				  <?php
					include '../_inc/question_dbconn.php';
					$sql="SELECT * FROM questions WHERE status='REVIEWED'";
					$result=  mysql_query($sql) or die(mysql_error());
				  ?>
				  <form action="process_question.php" method="POST">
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
								echo "<td>".$rws[5]."</td>";
								echo "<td>".$rws[7]."</td>";
								echo "<td>".$rws[6]."</td>";
								echo "</tr>";
							}
						?>
					  </tbody>
					</table><br>
					<input type="submit" class="btn btn-success" name="q_review" value="Mark Question as 'TO REVIEW'" />
					<input type="submit" class="btn btn-danger" name="q_delete" value="Delete Question" />
				  </div>
				  </form>
				</div>
			  </div>
		   </div>
		  </div> <!-- /.row -->
		  
        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>