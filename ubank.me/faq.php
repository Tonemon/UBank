<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="UBank Online Banking FAQ">
		<meta name="author" content="UBank Group">
		
		<title>Frequently Asked Questions (FAQ) | UBank</title>
		
		<script type="text/javascript">
			function Register() {
				alert("Please contact your system administrator to register an account.");
			}
		</script>
		
		<!-- Custom CSS -->
		<link href="vendor/css/faq.css" rel="stylesheet">

	<!-- PHP header here -->
	<?php include 'index-header.php'; ?>
	
	<div class="container mt-5" id="accordion"><br>
        <h1 class="mt-5">Frequently Asked Questions</h1>
		  <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
		  <p class="lead">We have made a selection of the most asked questions and provided them with an answer. If you can't find your question (or answer) here, feel free to contact us and we will help you as soon as possible.</p><br>
		<div class="faqHeader"><i class="fas fa-info-circle"></i> About UBank Group</div>
			<div class="card">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1s1">Is this a real bank and/or company?</a>
					</h6>
				</div>
				<div id="collapse1s1" class="panel-collapse collapse">
					<div class="card-header">
						Sadly not. UBank Online Banking is a fully working bank demo build with HTML, CSS, JavaScript, PHP & Mysql.
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1s2">What’s the difference between UBank and UBank Group?</a>
					</h6>
				</div>
				<div id="collapse1s2" class="panel-collapse collapse">
					<div class="card-header">
						UBank Group is a fake parent company of UBank and holds all of the shares of UBank. 'UBank' is also used as a commercial name.
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1s3">How many people work at UBank?</a>
					</h6>
				</div>
				<div id="collapse1s3" class="panel-collapse collapse">
					<div class="card-header">
						At the moment there is only 1 person working at UBank.
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1s4">How do I apply for a job?</a>
					</h6>
				</div>
				<div id="collapse1s4" class="panel-collapse collapse">
					<div class="card-header">
						Please contact us if you want to apply for a job. At the moment we have two positions open:
						<ul>
							<li>As a <b>staff member</b> you are in control of all the contact requests and card requests. </li>
							<li>As an <b>admin member</b> you are in control of creating new customer and staff accounts and help people with updating their profile information.</li>
						</ul>
					</div>
				</div>
			</div>

			
		<!-- next faq section -->	
        <div class="faqHeader"><i class="fas fa-info-circle"></i> About Online Banking</div>
			<div class="card">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2s1">How can I create a customer account?</a>
					</h6>
				</div>
				<div id="collapse2s1" class="panel-collapse collapse">
					<div class="card-header">
						At the moment you can't create an account on your own. <br> Please contact us with your information and we will make an account for you.
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2s2">How do I reset my password?</a>
					</h6>
				</div>
				<div id="collapse2s2" class="panel-collapse collapse">
					<div class="card-header">
						If you remember your password please do the following:
						<ul>
							<li>Login into your customer account on <a href="http://account.ubank.me" target="_blank">account.ubank.me</a>.</li>
							<li>Click the <i class="fas fa-fw fa-cogs"></i> settings icon in the menu on the left to goto your settings.</li>
							<li>Change your password using the 'Change Password' section.</li>
						</ul>
						If you can't remember your password please contact your system administrator to change it. <br>You will be asked questions to verify that you are indeed the owner
						of your customer account.
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2s3">How do I make a transfer to someone?</a>
					</h6>
				</div>
				<div id="collapse2s3" class="panel-collapse collapse">
					<div class="card-header">
						To make a tranfer to someone you will first need to add them to your <i class="fas fa-address-book"></i> Contacts/Addressbook. This is used to verify that you and your reciepient do in fact know
						each other and that the transfer is to the right person. To add a person to your contacts you will need some information from them like:
						<ul>
							<li>His/Her account name, often their name and surname.</li>
							<li>His/Her account number, where the funds will be transferred to.</li>
							<li>His/Her card country and Ifsc code, to verify the card.</li>
						</ul>
						This information can be found at the back of each UBank <i class="fab fa-cc-mastercard"></i> <b>Mastercard</b>, <i class="fas fa-credit-card"></i><b> Creditcard </b>or <i class="fab fa-cc-visa"></i><b> Visa Card</b>
						and <b>must be the same as on the card</b>, otherwise the contact will not be found.
						After adding a person you can make fund transfers on the <i class="fas fa-home"></i> Homepage in the 'Tranfer funds' section.
						
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2s4">What is the currency used for all transactions?</a>
					</h6>
				</div>
				<div id="collapse2s4" class="panel-collapse collapse">
					<div class="card-header">
						There is <strong>no real currency</strong> used in any of the transactions you make. The balance of your account is displayed in <strong>USD</strong>, but it's <b>not</b> real money.
					</div>
				</div>
			</div>
			<div class="card ">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2s5">Do I need to pay tax when making a tranfer?</a>
					</h6>
				</div>
				<div id="collapse2s5" class="panel-collapse collapse">
					<div class="card-header">
						No tax <i class="far fa-smile"></i>! We believe in tax-free transactions, so you (and your business partner) don't have to lose money in a transaction.
						<br />
					</div>
				</div>
			</div>
			<div class="card ">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2s6">What is the difference between a 'current' and a 'savings' account?</a>
					</h6>
				</div>
				<div id="collapse2s6" class="panel-collapse collapse">
					<div class="card-header">
						When you use <b>a 'current' account</b>, your money can be used in loans. We will inform you when that is the case and you will get a small extra fee, because you participated. When using <b>a 'savings' account</b> 
						your money will not be used in loans and you won't get the small extra fee. <br>We <b>always</b> make sure that transactions on both account types are secure. 
					</div>
				</div>
			</div>
			<div class="card ">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2s7">What is the minimum balance to make transactions?</a>
					</h6>
				</div>
				<div id="collapse2s7" class="panel-collapse collapse">
					<div class="card-header">
						The minimum amount to make a transaction is 1$ and you obviously can't make a higher transaction than your account balance is. <br>
						If you have 5$ or less on your account balance, you will get an alert with the information that it's recommended to make a deposit.
					</div>
				</div>
			</div>
			<div class="card ">
				<div class="card-header">
					<h6 class="card-header">
						<i class="fas fa-question-circle"></i> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2s8">How do I change my profile information?</a>
					</h6>
				</div>
				<div id="collapse2s8" class="panel-collapse collapse">
					<div class="card-header">
						In case you moved or changed your personal information you could contact us and we will change the requested information.<br>
						<i class="fas fa-exclamation-circle"></i> Keep in mind that we <b>cannot</b> change your <u>account type</u> (current or savings) or <u>account number</u>!
					</div>
				</div>
			</div>
	</div><br><br>

	<!-- PHP footer here -->
	<?php include 'index-footer.php' ?>