<?php
$serverName="localhost";
$dbusername="UBank";
$dbpassword="UBank";
$dbname="UBankQ";
mysql_connect($serverName,$dbusername,$dbpassword)/* or die('the website is down for maintainance')*/;
mysql_select_db($dbname) or die(mysql_error());
?>