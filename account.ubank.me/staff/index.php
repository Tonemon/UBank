<?php
  if (isset($_REQUEST['login_submit'])){
    include '../_inc/dbconn.php';
    $login_user = $_REQUEST['loginuser'];

    // password salting (for security reasons)
    $salt = "@g26jQsG&nh*&#8v";
    $login_password = sha1($_REQUEST['loginpassword'].$salt);


    if (preg_match("/@/", $login_user)) { // check for @, if present:
        // getting usefull information for session creation (with email)
        $sql = "SELECT username,password,account,email,id,name FROM UBankMAIN.staff WHERE email='$login_user' AND password='$login_password'";
        $result = mysql_query($sql) or die(mysql_error());
        $res =  mysql_fetch_array($result);

    } else { // no @ present, so login with username:
        // getting usefull information for session creation (with username)
        $sql = "SELECT username,password,account,email,id,name FROM UBankMAIN.staff WHERE username='$login_user' AND password='$login_password'";
        $result = mysql_query($sql) or die(mysql_error());
        $res =  mysql_fetch_array($result);
    }

    $staff_username = $res[0];
    $staff_pass = $res[1];
    $staff_account = $res[2];
    $staff_email = $res[3];
    $staff_id = $res[4];
    $staff_name = $res[5];

    if (($login_user == $staff_username || $login_user == $staff_email) && $login_password == $staff_pass){
        // set important session details (for both admin and staff members)
        session_start();
        $_SESSION['session_staff_start'] = 1;
        $_SESSION['session_staff_username'] = $staff_username;
        $_SESSION['session_staff_email'] = $staff_email;
        $_SESSION['session_staff_id'] = $staff_id;
        $_SESSION['session_staff_name'] = $staff_name;
      
        $_SESSION['session_staff_account'] = $staff_account; // this can be admin/staff
        header('location:dashboard');
    } else { // error
        header('location:?error=1'); 
    }
  }
?>
<?php 
session_start();
        
if(isset($_SESSION['session_staff_start'])) 
    header('location:dashboard');   
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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!-- Custom fonts for this template-->
		<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

		<!-- Custom styles for this template-->
		<link href="../vendor/css/sb-admin.css" rel="stylesheet">
		<title>Login to the Staff Panel | UBank Online Banking</title>
		
		<script type="text/javascript">
			function Forgot() {
				alert("Please contact your system administrator to request a new password.");
			}
		</script>
	</head>
    <body class="login-bg">
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center"><a href="http://ubank.me">&laquo;</a> UBank Staff Panel</div>
        <div class="card-body text-center">
          <?php 
            // success and error messages are displayed here.
            if ($_GET['error'] == "1") {
              echo "<div class='alert alert-danger'>
                    <i class='fas fa-exclamation-triangle'></i>
                    Wrong credentials. Please try again.</div>";
            } elseif ($_GET['success'] == "1"){
              echo "<div class='alert alert-success'>
                    <i class='fas fa-check'></i> Password Changed. Login to continue.</div>";
            } else {
              echo "<p>Login below to your staff dashboard.</p>";
            }
          ?>
          <form action="" method="post" name="login_form">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="usern" class="form-control" name="loginuser" placeholder="Username or Email" required="required">
                <label for="usern">Username or Email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                  <div class="form-label-group">
                    <input type="password" id="password" class="form-control" name="loginpassword" placeholder="Password">
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
			<button class="btn btn-primary btn-block" type="submit" class="btn" name="login_submit">Login</button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="javascript:Forgot();">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Credits footer on every page -->
    <div style="position: fixed;bottom: 0;right: 15px;background-color: #fff;box-shadow: 0 4px 8px rgba(0,0,0,.05);border-radius: 3px 3px 0 0;font-size: 12px;padding: 5px 10px;">Created by <a href="https://github.com/Tonemon" target="blank">Tonemon</a>.</div>

    <!-- Core plugin JavaScript-->
	<script src="../vendor/js/jquery.easing.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>