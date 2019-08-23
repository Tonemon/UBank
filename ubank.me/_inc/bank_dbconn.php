<?php
$serverName="localhost";
$dbusername="UBankDAT";
$dbpassword="UBankDAT";
$dbname="UBankDAT";
mysql_connect($serverName,$dbusername,$dbpassword)/* or die('the website is down for maintainance')*/;
mysql_select_db($dbname) or die(mysql_error());
?>