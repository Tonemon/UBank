<?php
	include '_inc/dbconn.php'; 
	if (isset($_REQUEST['register_account'])){ // Submit contact form request
		// getting variables to store in table
		$firstname=  mysql_real_escape_string($_REQUEST['n_firstname']);
		$surname=  mysql_real_escape_string($_REQUEST['n_surname']);
		$fullname=  $firstname . ' ' . $surname;

		$email= mysql_real_escape_string($_REQUEST['n_email']);
		$gender=  mysql_real_escape_string($_REQUEST['n_gender']);
		$dob=  mysql_real_escape_string($_REQUEST['n_dob']);
		$address=  mysql_real_escape_string($_REQUEST['n_address']);
		$phone=  mysql_real_escape_string($_REQUEST['n_phone']);
		$type=  mysql_real_escape_string($_REQUEST['n_type']); // type of account: current or savings
		$country= mysql_real_escape_string($_REQUEST['n_country']);

		$pass1= mysql_real_escape_string($_REQUEST['n_newpass']);
		$pass2= mysql_real_escape_string($_REQUEST['n_repeatpass']);

		// insert question to table 'customernew'
		if($pass1 == $pass2){
			$insertsql = "insert into customernew values('','$fullname','$gender','$dob','$type','$address',
			'$phone','$email','$pass1','$country')";
			mysql_query($insertsql) or die(header('location:newaccount?error=1'));
			header('location:newaccount?success=1');
		} else {
			header('location:newaccount?password=1');
		}
	} else {
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="Register new account | UBank Online Banking">
		<meta name="author" content="UBank Group">
		
		<title>Register New Account | UBank Online Banking</title>
		
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
	<div class="contact">
	  <div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-11">
			<div class="row mt-5">
				<div class="col-lg-6">
					<h1>Open New Account</h2>
					<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla rhoncus pulvinar neque at sagittis. Maecenas elementum quam eu purus eleifend, pharetra eleifend diam tempor. Ut ultricies lectus sed diam placerat pharetra. Cras ornare rutrum enim. Praesent scelerisque, lectus sed hendrerit cursus, magna lectus tincidunt quam, sed volutpat felis dui ut dolor. Nunc finibus tincidunt tellus, a rutrum lorem. In ornare ligula in ligula scelerisque, faucibus imperdiet tellus posuere. Donec id metus suscipit ligula ultricies tempor. Aenean gravida egestas erat, sed venenatis arcu aliquet nec. Etiam fermentum odio ac pellentesque imperdiet. Aenean rhoncus gravida pellentesque. </p><br>
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
		<div class="col-lg-3">
		  <h1>Create Account</h2>
		  <hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
		  <p>When creating a new account, please keep in mind:<br>
		  	<ul>
		  		<li>Provide your <b>real information</b> as stated on your ID or Passport to make a valid banking account.</li>
		  		<li>After submitting the form on the right your <b>request will be send to validation</b> and will be <b>approved</b> or <b>denied</b>.</li>
		  		<li>Don't make <b>multiple accounts requests</b> with the same user information because they will be denied.</li>
		  	</ul><br><br>
		  <b>All of the fields on the right are required.</b></p><br><br>
		</div>
		<div class="col-lg-1"></div>
		<div class="col-lg-6"><br><br>
		  <form method="POST" action="newaccount">
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
							<input type="submit" class="btn btn-success btn-send" name="register_account" value="Create account &raquo;">
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
              <img class="img-fluid d-block mx-auto" width="200px" height="50px" src="vendor/img/partner1.png" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" width="150px" height="50px" src="vendor/img/partner2.png" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" width="200px" height="50px" src="vendor/img/partner3.png" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="vendor/img/partner4.png" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>

	<!-- PHP footer here -->
	<?php include 'index-footer.php' ?>

<?php } ?>