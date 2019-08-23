<?php 
	include '_inc/dbconn.php'; 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="Contact Us | UBank Online Banking">
		<meta name="author" content="UBank Group">
		
		<title>Contact Us | UBank</title>

	<!-- PHP header here -->
	<?php include 'index-header.php'; ?>
	
    <!-- Page Content -->
	<?php
				if (isset($_GET['send'])) {
					echo "<br><div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Question send. We will try to answer it as soon as possible. </div>";
				} elseif (isset($_GET['error'])) {
					echo "<br><div class='alert alert-danger alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-exclamation-triangle'></i> Something went wrong and your question could not be send. Please try again later.</div>";
				}
	?>
	<div class="contact" id="contact">
	  <div class="row mt-5">
		<div class="col-lg-1"></div>
		<div class="col-lg-7">
			<h1>Contact Us</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
			<p>Have you checked our <a href="faq">FAQ</a> already? <i class="far fa-smile"></i> Most of the questions asked by our customers (and the answers) can be found there.
			If you still can't find an answer feel free to contact us using one of the methods on the right or use
			 our question form below. <br><br> If you want to receive information about our services or the UBank Online Banking platform please subscribe to our newsletter <a href="#">here</a>.</p><br>
			 <p><a class="btn btn-primary js-scroll-trigger" href="faq" role="button">Read our FAQ &raquo;</a> <a class="btn btn-primary js-scroll-trigger" href="#contactform" role="button">Ask a question &raquo;</a><p>
		</div>
		<div class="col-lg-3">
          <!-- Links -->
          <h3>Contact Information</h3>
          <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
          <p>
            <i class="fa fa-home mr-3"></i>Old York, US 12345, US<br>
			<i class="fa fa-home mr-3"></i>Lendon, UK 1122, UK<br>
			<i class="fa fa-home mr-3"></i>Emsterdam, NL 3566, NL
		  </p>
          <p>
            <i class="fa fa-envelope mr-3"></i><a href="mailto:support@ubank.me">support@ubank.me</a><br>
			<i class="fa fa-envelope mr-3"></i><a href="mailto:info@ubank.me">info@ubank.me</a>
			
		  </p>
		  <p>
			<i class="fa fa-phone mr-3"></i> + 01 234 567 88<br>
			<i class="fab fa-whatsapp mr-3"></i> + 01 234 567 89
		  </p>
		</div>
		<div class="col-lg-1"></div>
	  </div><!-- /.row -->
	</div>
	
	<!-- contact form -->
	  <div class="row contact bg-blue-light" id="contactform">
	    <div class="col-lg-1"></div>
		<div class="col-lg-4">
		  <h1>Contact Form</h2>
		  <hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
		  <p>Please enter your name, your surname, a valid email address, your type of question and your message. Please describe your question as accurate as you can so our staff can answer it precisely. <br><br>
		  All fields at the right are required. </p><br><br>
		</div>
		<div class="col-lg-1"></div>
		<div class="col-lg-5"><br><br>
		  <form id="contact-form" method="post" action="contact-process.php" role="form">
			<div class="messages"></div>
			<div class="controls">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_name">First name</label>
								<input id="form_name" type="text" name="q_firstname" class="form-control" placeholder="Enter your first name" required="required" data-error="Your First name is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_lastname">Last name</label>
								<input id="form_lastname" type="text" name="q_surname" class="form-control" placeholder="Enter your last name" required="required" data-error="Your Last name is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_email">Email Address</label>
								<input id="form_email" type="email" name="q_email" class="form-control" placeholder="Enter your email address" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_need">Select your question category</label>
								<select id="form_need" name="q_type" class="form-control" required="required" data-error="Select your category.">
									<option value=""></option>
									<option value="Services">More information about us</option>
									<option value="Banking">UBank Online Banking</option>
									<option value="Bug">Exploit/Bug Found</option>
									<option value="Job">Job Application</option>
									<option value="Other">Other</option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="form_message">Your Message</label>
								<textarea id="form_message" name="q_message" class="form-control" placeholder="Message" rows="4" required="required" data-error="Please, leave us a detailed description."></textarea>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-12">
							<input type="submit" class="btn btn-success btn-send" value="Send message &raquo;">
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