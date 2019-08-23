<?php 
session_start();
include '../_inc/dbconn.php';
        
if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>
<?php
include '../_inc/dbconn.php';
$id=  mysql_real_escape_string($_REQUEST['customer_id']);
$sql="SELECT * FROM `customer` WHERE id=$id";
$result=  mysql_query($sql) or die(mysql_error());
$rws=  mysql_fetch_array($result);
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
	
	<title> Customer Edit | UBank</title>
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
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <div class="card-body-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Edit Selected Customer</div>
				<div class="card-body">
					<?php
                        $delete_id=  mysql_real_escape_string($_REQUEST['customer_id']);
                        if(isset($_REQUEST['submit2_id'])){
							// delete user from customer table
                            $sql_delete1="DELETE FROM `customer` WHERE `id` = '$delete_id'";
                            mysql_query($sql_delete1) or die(mysql_error());
							// delete users passbook
							$sql_delete2="DROP TABLE passbook".$delete_id;
                            mysql_query($sql_delete2) or die(mysql_error());
							// delete users contacts and set receiver contact to 'ACCOUNT REMOVED'
							$sql_delete3="DELETE FROM `contacts` WHERE `sender_id` = '$delete_id'";
                            mysql_query($sql_delete3) or die(mysql_error());
							$sql_delete4="UPDATE contacts SET `status` = 'ACCOUNT REMOVED' WHERE `reciever_id` = '$delete_id'";
                            mysql_query($sql_delete4) or die(mysql_error());
                            echo "<script type='text/javascript'> window.location.href = 'customer?deleted=1';</script>";
                        }
                    ?>
					<form action="customer-alter.php" method="POST">
					<table>
						<input type="hidden" name="current_id" value="<?php echo $id;?>"/>
						<tr>
							<td>customer's name</td>
							<td><input type="text" name="edit_name" value="<?php echo $rws[1];?>" required=""/></td>
						</tr>
						<tr>
							<td>gender</td>
							<td>
								M<input type="radio" name="edit_gender" value="M" <?php if($rws[2]=="M") echo "checked";?>/>
								F<input type="radio" name="edit_gender" value="F" <?php if($rws[2]=="F") echo "checked";?>/>
							</td>
						</tr>
						<tr>
							<td>DOB</td>
							<td><input type="date" name="edit_dob" value="<?php echo $rws[3];?>"/></td>
						</tr>
						<tr>
							<td>Nominee</td>
							<td><input type="text" name="edit_nominee" value="<?php echo $rws[4];?>" required=""/></td>
						</tr>
						<tr>
							<td>account type</td>
							<td>
								<select name="edit_account">
									<option <?php if($rws[5]=="savings") echo "selected";?>>savings</option>
									<option <?php if($rws[5]=="current") echo "selected";?>>current</option>
								</select>
							</td>
						</tr>			
						<tr>
							<td>Address:</td>
							<td><textarea name="edit_address"><?php echo $rws[6];?></textarea></td>
						</tr>
							<td>mobile</td>
							<td><input type="text" name="edit_mobile" value="<?php echo $rws[7];?>" required=""/></td>
						</tr>
						<tr>
							<td>email id</td>
							<td><input type="text" name="edit_email" value="<?php echo $rws[8];?>" required=""/></td>
						</tr>
					</table><br>
					<input type="submit" class="btn btn-success" name="alter_customer" value="Update information"/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->

<?php include 'afooter.php' ?>