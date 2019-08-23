<?php 
  if (isset($_REQUEST['submit_login'])){
    include '_inc/dbconn.php';
    $login_user = $_REQUEST['loginuser'];
      
    // password salting (for security reasons)
    $salt = "@g26jQsG&nh*&#8v";
    $login_password = sha1($_REQUEST['loginpassword'].$salt);
    

    if (preg_match("/@/", $login_user)) { // check for @, if present:
        // getting usefull information for session creation (with email)
        $sql = "SELECT username,password,accstatus,email,id,name FROM UBankMAIN.users WHERE email='$login_user' AND password='$login_password'";
        $result = mysql_query($sql) or die(mysql_error());
        $res =  mysql_fetch_array($result);

    } else { // no @ present, so login with username:
        // getting usefull information for session creation (with username)
        $sql = "SELECT username,password,accstatus,email,id,name FROM UBankMAIN.users WHERE username='$login_user' AND password='$login_password'";
        $result = mysql_query($sql) or die(mysql_error());
        $res =  mysql_fetch_array($result);
    }

    $db_user = $res[0];
    $db_pass = $res[1];
    $db_accstatus = $res[2];
    $db_email = $res[3];
    $db_id = $res[4];
    $db_name = $res[5];

    if (($login_user == $db_user || $login_user == $db_email) && $login_password == $db_pass){
      if ($db_accstatus == "ACTIVE"){
        session_start();
        $_SESSION['session_user_start'] = 1;
        $_SESSION['session_user_username'] = $db_user;
        $_SESSION['session_user_email'] = $db_email;
        $_SESSION['session_user_id'] = $db_id;
        $_SESSION['session_user_name'] = $db_name;
        
        header('location:banking');
      } else {
        header('location:?disabled=1');
      }
    } else {
  	 header('location:?error=1'); 
  	}
  }
?>
<?php 
  session_start();
  if ($_SESSION['session_user_start'] == "1"){
    header('location:banking');   
  }
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
		<title>Login to Dashboard | UBank Online Banking</title>
		
		<script type="text/javascript">
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
				} elseif (isset($_GET['disabled'])) {
          echo "<div class='alert alert-danger'>
                <i class='fas fa-exclamation-triangle'></i>
                Your account is disabled. Please <a href='http://ubank.me/contact'>contact support</a> for more information.</div>";
        } elseif (isset($_GET['password'])) {
          echo "<div class='alert alert-success'>
                <i class='fas fa-check'></i>
                Password updated. Please login using your new password to continue.</div>";
        } else {
					echo "<p>Login below to your banking account.</p>";
				}
			?>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="username" class="form-control" name="loginuser" placeholder="Username" required="required">
                <label for="username">Username or Email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                  <div class="form-label-group">
                    <input type="password" id="password" class="form-control" name="loginpassword" placeholder="Password">
                    <label for="password">Password</label>
					<input type="hidden" name="p" id="p" value="">
                  </div>
              </div>
            </div>
			<div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me"> Remember Password
                </label>
              </div>
            </div>
			<button class="btn btn-primary btn-block" type="submit" class="btn" name="submit_login">Login <i class="fas fa-sign-in-alt"></i></button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="http://ubank.me/newaccount" target="_blank">Register an Account</a>
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
