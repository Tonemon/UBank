<?php 
if(isset($_REQUEST['submitBtn'])){
    include '_inc/dbconn.php';
    $username=$_REQUEST['uname'];
    
    //salting of password
    $salt="@g26jQsG&nh*&#8v";
    $password= sha1($_REQUEST['pwd'].$salt);
  
    $sql="SELECT email,password FROM customer WHERE email='$username' AND password='$password'";
    $result=mysql_query($sql) or die(mysql_error());
    $rws=  mysql_fetch_array($result);
    
    $user=$rws[0];
    $pwd=$rws[1];    
    
    if($user==$username && $pwd==$password){
        session_start();
        $_SESSION['customer_login']=1;
        $_SESSION['cust_id']=$username;
		
		header('location:banking'); 
    } else {
		header('location:?error=1'); 
	}
}
?>
<?php 
session_start();
        
if(isset($_SESSION['customer_login'])) 
    header('location:banking');   
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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!-- Custom fonts for this template-->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

		<!-- Custom styles for this template-->
		<link href="vendor/css/sb-admin.css" rel="stylesheet">
		<title>Online Banking Login | UBank</title>
		
		<script type="text/javascript">
			function Register() {
				alert("Please contact your system administrator to register an account.");
			}
			function Forgot() {
				alert("Please contact your system administrator to request a new password.");
			}
		</script>
	</head>
    <body class="login-bg">
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center"><a href="http://ubank.me">&laquo;</a> UBank Online Banking Login</div>
        <div class="card-body text-center">
          <form action="" method="post" name="login_form">
			<?php
				if (isset($_GET['error'])) {
					echo "<div class='alert alert-danger'>
								<i class='fas fa-exclamation-triangle'></i>
								Wrong credentials. Please try again.</div>";
				} else {
					echo "<p>Please login below using your customer account.</p>";
				}
			?>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="email" class="form-control" name="uname" placeholder="Email address" required="required">
                <label for="email">Email Address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                  <div class="form-label-group">
                    <input type="password" id="password" class="form-control" name="pwd" placeholder="Password">
                    <label for="password">Password</label>
					<input type="hidden" name="p" id="p" value="">
                  </div>
				<!-- Password Confirmation (skipping) -->
                <!-- <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                    <label for="confirmPassword">Confirm password</label>
                  </div>
                </div> -->
              </div>
            </div>
			<div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me"> Remember Password
                </label>
              </div>
            </div>
			<button class="btn btn-primary btn-block" type="submit" class="btn" name="submitBtn">Login</button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="javascript:Register();">Register an Account</a>
            <a class="d-block small" href="javascript:Forgot();">Forgot Password?</a> 
          </div>
        </div>
      </div>
    </div>

    <!-- Core plugin JavaScript-->
	<script src="vendor/js/jquery.easing.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
