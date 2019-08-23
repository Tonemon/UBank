<?php 
session_start();
        
if(!isset($_SESSION['customer_login'])) 
    header('location:index');   
?>
<?php
                $cust_id=$_SESSION['cust_id'];
                include '_inc/dbconn.php';
                $sql="SELECT * FROM customer WHERE email='$cust_id'";
                $result=  mysql_query($sql) or die(mysql_error());
                $rws=  mysql_fetch_array($result);
                
                
                $name= $rws[1];
                $account_no= $rws[0];
                $branch=$rws[10];
                $branch_code= $rws[11];
                $last_login= $rws[12];
                $acc_status=$rws[13];
                $address=$rws[6];
                $acc_type=$rws[5];
                
                $gender=$rws[2];
                $mobile=$rws[7];
                $email=$rws[8];
                
                $_SESSION['login_id']=$account_no;
                $_SESSION['name']=$name;
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
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="vendor/css/sb-admin.css" rel="stylesheet">


    <!-- Page level plugin CSS-->
    <link href="vendor/js/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	
	<title>Dashboard | UBank</title>
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
		  
		  <!-- Cookies -->
		  <?php
				$sql="SELECT * FROM passbook$account_no";
                $result=  mysql_query($sql) or die(mysql_error());
                $rws=  mysql_fetch_array($result);
				
				if (isset($_GET['add'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						New Customer added. </div>";
				} elseif (isset($_GET['deleted'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Customer deleted.</div>";
				} elseif (isset($_GET['edit'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Customer information changed.</div>";
				// show alert that your balance is lower than 5$ and it's recommended to make a deposit
				} elseif ($rws[7]<=5) {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-hand-holding-usd'></i> Warning:
						Your balance is currently $5 or less ($<b>".$rws[7]."</b> precisely). It's recommended to make a deposit before you start online banking.</div>";
				// show cookie alert on default (and when balance not too low)
				} else {
					echo "<div class='alert alert-info alert-icon-block alert-dismissible' role='alert'>
						<i class='fas fa-fw fa-info-circle'></i>  We use cookies to offer you the best experience on our website. Continuing browsing, you accept our cookie policy.
						<a href='#' class='close' data-dismiss='alert' aria-label='Close'><span class='fa fa-times'></span></a></div>";
				}
			?>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <div class="card-body-icon">
                    <i class="fas fa-user"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-info"></i>
				  General Information</div>
				<div class="card-body">
					<p>
						<span class="heading">Welcome <b></span><?php echo $name;?></b> <small>(user)</small>,<br>
						<span class="heading">Your Last login was on <b></span><?php echo $last_login;?></b>,<br>
						<span class="heading">Your Account status is <b></span><?php echo $acc_status;?></b> and it's your <b><?php echo $acc_type;?></b> account.
					</p>
					<?php 
					if ($acc_type) {
						echo "<i><p><i class='fas fa-info-circle'></i> Because this is your savings account, your money is stored and not used for loans/other transactions. <a href='http://ubank.me/faq' target='_blank'>Read more</a>.</p></i>";
					} else {
						echo "<i><p><i class='fas fa-info-circle'></i> Give your Card details to the person you are doing business with so he can transfer the funds to you.</p></i>";
					}	?>
				</div>
			  </div>
			</div>
			<div class="col-xl-5 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
			    <div class="card-body-icon">
                    <i class="far fa-money-bill-alt"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-fighter-jet"></i>
				  Transfer Funds</div>
				<div class="card-body">
				  <div class="table-responsive">
				  <p> To transfer funds to someone you will need to setup your addresbook first. All active accounts in your addresbook will show up below.</p>
					<?php
						include '_inc/dbconn.php';
						$sender_id=$_SESSION["login_id"];
						$sql="SELECT * FROM contacts WHERE sender_id='$sender_id' AND status='ACTIVE'";
						$result=  mysql_query($sql);
						$rws=mysql_fetch_array($result);
						$s_id=$rws[1];              
					?>
					<?php       
					if($sender_id==$s_id){
						echo "<form action='process_transfer' method='POST'>";
						echo "<table>";
						echo "<tr><td>Select your reciepient:</td><td> <select name='transfer'>" ; 
					
						$sql1="SELECT * FROM contacts WHERE sender_id='$sender_id' AND status='ACTIVE'";
						$result=  mysql_query($sql);
							
						while($rws=mysql_fetch_array($result)) {
							echo "<option value='$rws[3]'>$rws[4]</option>";
						}
						
						echo "</td></tr></select>";
						echo "<tr><td>Enter Amount: </td><td><input type='number' name='t_val' placeholder='Amount in dollar ($)' required></td></table>";
						echo "<table><tr><td style='padding:5px;'><input type='submit' class='btn btn-success' name='submitBtn' value='Transfer' class='addstaff_button'></td></tr></table></form>"; 
					} else {
						echo "<i><p>You have no active contacts on this account. Please goto your <a href='contacts'>contacts</a> to make a transaction.</p></i>";
					}
					?>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-xl-3 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-money-bill-alt"></i>
				  Card Details</div>
				<div class="card-body-icon">
                    <i class="fas fa-fw fa-credit-card"></i>
                </div>
				<div class="card-body">
				  <?php
						$sql="SELECT * FROM passbook".$_SESSION['login_id'] ;
						$result=  mysql_query($sql) or die(mysql_error());
						while($rws=  mysql_fetch_array($result))
						{
						$balance=$rws[7];
						}            
					?>
				  <p><span class="heading">Your Balance: $</span><?php echo $balance;?></p>
				  <p>
					<span class="heading">Ifsc Code: </span><?php echo $branch_code;?><br>
					<span class="heading">Country: </span><?php echo $branch;?><br>
					<span class="heading">Account No: </span><?php echo $account_no;?>
				  </p>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->

          <!-- Area Chart Example
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated today at</div>
          </div> -->

          <div class="card mb-3" id="activity">
            <div class="card-header">
              <i class="fas fa-chart-line"></i>
              Recent Activity/Transactions</div>
            <div class="card-body">
			<?php include '_inc/dbconn.php';
				$sender_id=$_SESSION["login_id"];
				$sql="SELECT * FROM passbook".$sender_id;
				$result=  mysql_query($sql) or die(mysql_error()); 
			?>		
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Description</th>
                      <th>Credit &uarr; (amount)</th>
                      <th>Debit &darr; (amount)</th>
                      <th>Balance (amount)</th>
					  <th>Transaction Date</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
                        while($rws=  mysql_fetch_array($result)){
                            
                            echo "<tr>";
                            echo "<td>".$rws[0]."</td>";
                            echo "<td>".$rws[8]."</td>";
                            echo "<td> $".$rws[5]."</td>";
                            echo "<td> $".$rws[6]."</td>";
                            echo "<td> $".$rws[7]."</td>";
							echo "<td>".$rws[1]."</td>";
                           
                            echo "</tr>";
                        } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
          </div>

        </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>