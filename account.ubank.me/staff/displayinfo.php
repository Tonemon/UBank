<?php 
session_start();
include '../_inc/dbconn.php';

if(!isset($_SESSION['staff_login'])) 
    header('location:../staff/');   
?>

<?php
                $staff_id=$_SESSION['staff_id'];
                include '../_inc/dbconn.php';
                $sql="SELECT * FROM staff WHERE email='$staff_id'";
                $result=  mysql_query($sql) or die(mysql_error());
                $rws=  mysql_fetch_array($result);
                
                $id=$rws[0];
                $name=$rws[1];
                $dob=$rws[2];
                $department=$rws[4];
                $doj=$rws[5];
                $mobile=$rws[7];
                $email=$rws[8];
                $gender=$rws[10];
                $last_login=$rws[11];
                
                $_SESSION['login_id']=$email;
                $_SESSION['name1']=$name;
                $_SESSION['id']=$id;
?>