# UBank Official Project 

[![Build](https://img.shields.io/badge/build-passing-brightgreen.svg)](http://192.168.1.68/websites/ubank)
[![Bootstrap](https://img.shields.io/badge/Bootstrap_version-updateable-orange.svg)](https://getbootstrap.com)
[![Uptime](https://img.shields.io/badge/Uptime-custom-lightgray.svg)](http://192.168.1.68/websites/ubank)
[![Official Commit](https://img.shields.io/badge/Commit_count-11-blue.svg)](http://192.168.1.68/websites/ubank/commits/master)<br>
This is the official repository and backup location for the UBank Project.
# About
I started the UBank project to learn how to make a bank demo using html, css & javascript (for the frontend) and PHP & mysql (for the backend).<br>
To host this project, but keep it offline I used Ampps for the Apache webserver & MySQL for the databases and the PHPMyAdmin console.<br>
Every new update contains a newer version of this project with bug fixes, new functions and/or remodels.<br>
The databases will be included in the backups too (in case the database configuration got updated in an update.)

# When making a backup...
1. First export database configuration file (ie. UBankDB.sql) and if more databases present include them too.
2. Modify this README.md file with the information of the upload below (Change the commit counter too!!).
3. Include the domains (mainly ubank.me & account.ubank.me).<br>
<b>REMEMBER:</b> The backup exists of the two home folders of 'ubank.me' and 'account.ubank.me'. <br>If a new
subdomain will be present, include it in the next version of the backup.

# Update Log

## 10: v3.1.1 Small bug fixed
<b>Backup date:</b> 22-01-2019<br>
<b>Description:</b> A little bug was found and fixed.
- The bug was found in the 'account.ubank.me/process_password_edit.php' file and fixed.

## 9: v3.1 Almost Done
<b>Backup date:</b> 22-01-2019<br>
<b>Description:</b> account.ubank.me is done, ubank.me is almost project done (only text needs to be written).
Updates done on both domains, almost ready for final upload:
- The account.ubank.me domain is done and this time ALL TODO items are done (read more in TODO.txt)
- The ubank.me domain has a new look, but not done yet (read moer in TODO.txt)
- Added support for new users to register themself and admin can approve request that creates an account or
	delete the request which will do nothing.

## 8: v3.0 Mostly Done
<b>Backup date:</b> 21-01-2019<br>
<b>Description:</b> HUGE (Trump imitation) UPDATE to both domains, new database added, almost project done.
A LOT of updates done on both domains, almost ready for final upload:
- The account.ubank.me domain is done and all TODO items are done (read more in TODO.txt)
- The ubank.me domain has a new look, but not done yet (read moer in TODO.txt)
- Added new database for questions from the homepage (ubank.me) and from customers (account.ubank.me)

## 7: v2.6 Database table rename
<b>Backup date:</b> 18-01-2019<br>
<b>Description:</b> Database tables rename + smaller updates on account.ubank.me
BACKUP/TABLE RENAME (with a lot of minor updates) for final upload:
- did a lot of tiny updates on the account.ubank.me domain (read more in TODO.txt)
- renamed 'beneficiary1' to 'contacts', changed 'atm' & 'chequebook' to 'mastercard', 'creditcard' & 'visacard'.

## 6: v2.5 Even more updates
<b>Backup date:</b> 16-01-2019<br>
<b>Description:</b> This update contain's a lot of smaller updates on the account.ubank.me domain.
QUICK/BACKUP UPDATE 3 (with a lot of minor updates) for final upload:
- did a lot of tiny updates on the account.ubank.me domain (read more in TODO.txt)
- fixed 'card-body-icons', because they were too big and above input fields.

## 5: v2.4 More updates
<b>Backup date:</b> 10-01-2019<br>
<b>Description:</b> This version contains even more updates (mostly to account.ubank.me) and bug fixes.
QUICK/BACKUP UPDATE 2 (with a lot of minor updates) for final upload:
- did a lot of tiny updates on the account.ubank.me domain (read more in TODO.txt)

## 4: v2.3 Small updates
<b>Backup date:</b> 06-01-2019<br>
<b>Description:</b> Backup containing a lot of small updates on the account.ubank.me domain.
QUICK/BACKUP UPDATE for final upload (read more in TODO.txt)

## 3: v2.2 Moving + Databases
<b>Backup date:</b> 02-01-2019<br>
<b>Description:</b> Moved experimental --> account and account --> old. Contains exports of databases too.
REMODEL UPDATE for final upload:
- moved the old account.ubank.me -> old.ubank.me
- moved the experimental.ubank.me -> account.ubank.me
- added both database files (UBankDB.sql & UBankDAT.sql)

## 2: v2.0 Official Upload
<b>Backup date:</b> 11-12-2018<br>
<b>Description:</b> Official launch of the beta version of UBank online.
Recently added two database files:
- UBankDAT - new database, phpmyadmin export containing experimental.ubank.me database construction.
- UBandDB - old database, phpmyadmin export containing account.ubank.me database construction.

## 1: Initial Commit 2
<b>Backup date:</b> 28-10-2018<br>
<b>Description:</b> First file upload + first online backup