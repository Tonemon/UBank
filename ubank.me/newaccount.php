<?php 
	include '_inc/dbconn.php'; 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="Contact Us | UBank Online Banking">
		<meta name="author" content="UBank Group">
		
		<title>Register New Account | UBank</title>
		
	<!-- PHP header here -->
	<?php include 'index-header.php'; ?>
	
    <!-- Page Content -->
	<?php
				if (isset($_GET['success'])) {
					echo "<br><div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Your account request is submitted. Please check your mail for further
						instructions.</div>";
				} elseif (isset($_GET['password'])) {
					echo "<br><div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> The passwords you entered do not match. Please try again.</div>";
				} elseif (isset($_GET['error'])) {
					echo "<br><div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Something went wrong and your account request can't be
						submitted at this time. Please try again later.</div>";
				}
	?>
	<div class="contact" id="contact">
	  <div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-11">
			<div class="row mt-5">
				<div class="col-lg-6">
					<h1>Open New Account</h2>
					<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
					<p>Placeholder text. </p><br>
					 <p><a class="btn btn-primary js-scroll-trigger" href="#openaccount" role="button">Open your account &raquo;</a><p>
				</div>
				<div class="col-lg-6">
				  <!-- Image -->
				  <img src="vendor/img/newaccount1.jpg" width="500" alt="">
				</div>
			</div>
		</div>
		<div class="col-lg-1"></div>
	  </div><!-- /.row -->
	</div>
	
	<!-- create account form -->
	  <div class="row contact bg-blue-light" id="openaccount">
	    <div class="col-lg-1"></div>
		<div class="col-lg-4">
		  <h1>Create Account</h2>
		  <hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
		  <p>Please provide your real information as stated on your ID or Passport to make a valid banking account.<br><br>
		  All of the fields on the right are required. </p><br><br>
		</div>
		<div class="col-lg-1"></div>
		<div class="col-lg-5"><br><br>
		  <form id="contact-form" method="post" action="newaccount-process.php" role="form">
			<div class="messages"></div>
			<div class="controls">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_name">First name</label>
								<input id="form_name" type="text" name="n_firstname" class="form-control" placeholder="Enter your first name" required="required" data-error="Your First name is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_lastname">Last name</label>
								<input id="form_lastname" type="text" name="n_surname" class="form-control" placeholder="Enter your last name" required="required" data-error="Your Last name is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_email">Email Address</label>
								<input id="form_email" type="email" name="n_email" class="form-control" placeholder="Enter your email address" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="form_gender">Gender</label>
								<select id="form_gender" name="n_gender" class="form-control" required="required" data-error="Select your category.">
									<option value="">...</option>
									<option value="M">M (Male)</option>
									<option value="F">F (Female)</option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="form_birthdate">Date of Birth</label>
								<input id="form_birthdate" type="date" name="n_dob" class="form-control" placeholder="Enter your birth date" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_address">Address</label>
								<input id="form_address" type="text" name="n_address" class="form-control" placeholder="Enter your Home address" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_phone">Phone Number</label>
								<input id="form_phone" type="text" name="n_phone" class="form-control" placeholder="Enter your phone number" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_need">Select your account type</label>
								<select id="form_need" name="n_type" class="form-control" required="required" data-error="Select your category.">
									<option value="">...</option>
									<option value="current">Ecommerce ('Current')</option>
									<option value="savings">Savings</option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_country">Select your country</label>
								<select id="form_country" name="n_country" class="form-control" required="required" data-error="Select your category.">
									<option value="">...</option>
									<option value="United States">United States (US)</option>
									<option value="United Kingdom">United Kingdom (UK)</option>
									<option value="Netherlands">The Netherlands (NL)</option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="form_newpass">Enter new password</label>
								<input id="form_newpass" type="password" name="n_newpass" class="form-control" placeholder="Enter your new password" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label for="form_repeatpass">Repeat new password</label>
								<input id="form_repeatpass" type="password" name="n_repeatpass" class="form-control" placeholder="Repeat your new password" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-12">
							<input type="submit" class="btn btn-success btn-send" value="Create account &raquo;">
						</div>
					</div>
			 </div>
		   </form>
		 </div> <!-- // class="col-lg-6" -->
		<div class="col-lg-1"></div>
	  </div> <!-- // contact form -->
	
	<!-- Clients -->
    <section class="py-5 clients">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="vendor/img/partner_envato.png" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="vendor/img/partner_designmodo.png" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="vendor/img/partner_themeforest.png" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="vendor/img/partner_creativemarket.png" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>

	<!-- PHP footer here -->
	<?php include 'index-footer.php' ?>