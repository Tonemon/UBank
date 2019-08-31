<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="UBank Online Banking Homepage">
		<meta name="author" content="UBank Group">
		<title>Homepage Online Banking | UBank Online Banking</title>
		
	<!-- PHP header here -->
	<?php include 'index-header.php'; ?>
	
	<!-- Carousel -->
	<div class="row">
	<div  class=" carousel slide" id="ccontrol" data-ride="carousel">
	  <ol class="carousel-indicators">
		<li data-target="#ccontrol" data-slide-to="0" class="active"></li>
		<li data-target="#ccontrol" data-slide-to="1"></li>
		<li data-target="#ccontrol" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
		<div class="carousel-item active">
		  <img class="d-block w-100" src="vendor/img/slideshow1.jpg" alt="First slide">
		  <div class="carousel-caption d-none d-md-block">
			<h2>UBank Online Banking</h2>
			<p>The fastest and most secure bank on the planet.</p>
			<p><a class="btn btn-primary js-scroll-trigger" href="newaccount" role="button">Open your account &raquo;</a><p>
		  </div>
		</div>
		<div class="carousel-item">
		  <img class="d-block w-100" src="vendor/img/slideshow2.jpg" alt="Second slide">
		  <div class="carousel-caption d-none d-md-block">
			<h2>We care about our customers.</h2>
			<p>We developed a new User Control Panel to make it easy to use and to satisfy the needs of our users.</p>
			<p><a class="btn btn-primary js-scroll-trigger" href="#cpanel" role="button">Read more &raquo;</a><p>
		  </div>
		</div>
		<div class="carousel-item">
		  <img class="d-block w-100" src="vendor/img/slideshow3.jpg" alt="Third slide">
		  <div class="carousel-caption d-none d-md-block">
			<h2>Innovative</h2>
			<p>UBank is one of the most innovative banks in the world. We keep on implementing new features to satisfy our users.</p>
			<p><a class="btn btn-primary js-scroll-trigger" href="#features" role="button">Read our Features &raquo;</a><p>
		  </div>
		</div>
	  </div>
	  <a class="carousel-control-prev" href="#ccontrol" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#ccontrol" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	</div>
	</div>
	
	<div class="row features bg-blue-light" id="features">
        <!-- <div class="col-lg-1"></div> -->
        <div class="col-lg-1"></div>
          <div class="col-lg-4">
            <h2><i class="fas fa-feather"></i> Super light & Super fast</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>UBank is one of the lightest banks out there and that makes us super fast. Make smooth and easy transactions with your business partners every day (or at night) and we will make sure the funds will arrive on time and safe.</p>
		  </div>
          <div class="col-lg-3">
            <h2><i class="fas fa-lock"></i> Seriously Secure</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>UBank takes security very seriously and it's our #1 priority. That's why we encrypt all of our users passwords and make sure to regularely check for flaws in our systems to patch. </p>
          </div>
          <div class="col-lg-3">
            <h2><i class="fas fa-server"></i> 100% Uptime</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>Our banking system is run on the best hardware in the world. We make sure to update regularly and keep our systems online at every moment. </p>
          </div>
		  <div class="col-lg-1"></div>
    </div><!-- /.row -->
	
	<div class="container about" id="cpanel">
	  <h1 class="mt-5"><i class="fas fa-server"></i> Our brand new User Control Panel</h1>
	  <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 55%;">
	  <div class="row">
          <div class="col-md-6">
			  <p>
				We have developed a new and easy to use User Control Panel which contains every essential function you will need. The main functions (based on making transfers, viewing card details and your recent activity/transactions) can be found on the homepage. Other functions (like your profile, contacts, or settings) can be found in the sidemenu.<br><br> In the 'general information' section you will find your name, last login date, 
				the type of account you use and your account status. The information in the 'card details' section	can also be found on your UBank <i class="fab fa-cc-mastercard"></i> <b>Mastercard</b>, 
				<i class="fas fa-credit-card"></i><b> Creditcard </b>or <i class="fab fa-cc-visa"></i><b> Visa Card</b>. <br><br>
				<a class="btn btn-primary js-scroll-trigger" href="about" role="button">About us &raquo;</a>
				<a class="btn btn-primary js-scroll-trigger" href="faq" role="button">Our FAQ &raquo;</a><br>
			  </p>
          </div>
		  <div class="col-md-6">
			<img src="vendor/img/screenshot1.png" width="100%" alt="" /></a>
          </div>
        </div>
    </div>
	
	<div class="row bg-blue-dark signup img-rounded ">
		<div class="col-lg-1 text-center">
		</div>
		<div class="col-lg-8">
			<div class="container">
            <h2><i class="fas fa-gift"></i> Register now and receive a gift!</h2>
            <p>Apply for an account between now and 1 <?php echo date("F",strtotime("+3 Months")); ?> <?php echo date("Y"); ?> to recieve $5 cashback on your first transaction.*<br><small><small>* Only applies to new users and users that signup for our newsletter.</small></small></p>
            </div>
		</div>
        <div class="col-lg-3"><br>
            <p><a class="btn btn-primary js-scroll-trigger" href="newaccount" role="button">Open your account &raquo;</a><p>
        </div>
    </div>
	
	<div class="container reviews" id="testimonials">
	  <h1 class="mt-5"><i class="fas fa-comments"></i> Testimonials</h1>
	  <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 25%;">
	  <div class="row">
          <div class="col-md-4">
			  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> 4.5/5 Stars<br><br>
			  <h4><i class="fas fa-quote-left"></i> Great for big businesses.</h4>
			  <p>I make a lot of transfers on a regular basis and this is one of the first banks that makes it so easy and secure to stay and pay online. I didn't have any problems so far and I really enjoy the 100% uptime. <i class="fas fa-quote-right"></i></p>
			  <p class="font-weight-bold">Bert Jones <small>CEO at Emazon</small></p>
          </div>
		  <div class="col-md-4">
			  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 5/5 Stars<br><br>
			  <h4><i class="fas fa-quote-left"></i> Really nice User Panel.</h4>
			  <p>
				I really like the new User Control Panel, because all of the functions can be found easily and it's really fast (just as they advertised). Adding contacts to make transfers is easy and a great solution to the scamming problem. <i class="fas fa-quote-right"></i>
			  </p>
			  <p class="font-weight-bold">Bob Doe <small>Developer at Macrosoft</small></p>
          </div>
          <div class="col-md-4">
			  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> 4.5/5 Stars<br><br>
			  <h4><i class="fas fa-quote-left"></i> Excellent Support.</h4>
			  <p>
				I had two questions about how to make fund transfers and the user support helped me in minutes. The FAQ is very usefull too, because it's well documented 
				and answers on a lot of questions are easy to find. <i class="fas fa-quote-right"></i>
			  </p>
			  <p class="font-weight-bold">John Snow <small>Writer at Old York Times</small></p>
          </div>
        </div>
    </div>
	
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