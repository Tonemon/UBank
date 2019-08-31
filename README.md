# UBank Project 

[![Build](https://img.shields.io/badge/build-passing-brightgreen.svg)](https://github.com/Tonemon/UBank)
[![Bootstrap](https://img.shields.io/badge/Bootstrap_version-updateable-orange.svg)](https://getbootstrap.com)
[![Leading Branch](https://img.shields.io/badge/Leading_Branch-Master-lightgray.svg)](https://github.com/Tonemon/UBank/tree/master)
[![Commit count](https://img.shields.io/badge/Commit_count-view-blue.svg)](https://github.com/Tonemon/UBank/commits/master)<br>
This is the official repository and backup location for the UBank Project.

## About
I started the UBank project to learn how to make a bank demo using html, css & javascript (for the frontend) and PHP & mysql (for the backend).<br>
To host this project, but keep it offline I used Ampps for the Apache webserver & MySQL for the databases and the PHPMyAdmin console.<br>
Every new update contains a newer version of this project with bug fixes, new functions and/or remodels.<br>
The databases will be included in the backups too (in case the database configuration got updated in an update.)

## Features
<i>Coming soon after the Big Remake (new release).</i>

## Installation
If you want to install this project locally, please follow the following steps:
1. Download the latest version of this project (by using the 'Clone' option or the 'download from cloud' button on this page).
2. Make sure your system has apache, php and mysql installed (I'm using AMPPS because it has them all in one place).
3. Extract the two main folders (domains) called ```ubank.me``` and ```account.ubank.me``` to your localhost folder.
3. For optimal performance (and easier access) add the two entries below to your ```.hosts``` file:<br>
(This will let you use a custom url instead of ```localhost/ubank.me``` and ```localhost/account.ubank.me```)
<pre>127.0.0.1 ubank.me
127.0.0.1 account.ubank.me</pre>
4. Go to your PHPMyAdmin configuration (default: ```http://localhost/phpmyadmin/```) and add 2 new databases (called ```UBankDAT``` and ```UBankMAIN```) and add a user (called ```UBank``` with password ```UBank```).<br>
For more information about the PHP connections and the password configuration go to the ```_inc/dbconn.php``` file.
5. Import the ```UBankDAT.sql``` file to the 'UBankDAT' database.
6. Import the ```UBankMAIN.sql``` file to the 'UBankMAIN' database.
7. Make sure the ```UBank``` database user has permission to view/edit both databases.<br>
This can be done on the users page (```Users``` > ```Edit Privileges``` > ```Database``` > ```Add privileges on the following database(s)```)
6. Go to the <a href="http://ubank.me" target="_blank">homepage</a> or <a href="http://account.ubank.me" target="_blank">login page</a> and sign in using the following credentials:
<pre>Normal accounts (current/savings, account.ubank.me)
Username/Email: adam/adam@ubank.me (current), password: adam
Username/Email: henry/henry@ubank.me (savings), password: henry

Staff accounts (staff/admin/owner, account.ubank.me/staff/)
Username: staff/staff@ubank.me (staff account), password: staff
Username: admin/admin@ubank.me (admin account), password: admin
Username: owner/owner@ubank.me (owner account with access to everything), password: owner</pre>


## Credits
In this project I used the following resources:
- [Bootstrap](https://getbootstrap.com) (For style attributes & javascript elements),
- [FontAwesome](https://fontawesome.com) (For the awesome icons),
- [Fake logos](https://github.com/pigment/fake-logos) (As it says, fake logos for the business partners section)