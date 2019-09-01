# UBank Project 
<p align="center">My own banking software made with 5 programming languages (screenshots below).<br>
  <img alt="PICTURE logo" src="https://user-images.githubusercontent.com/18640201/64076772-3cad6480-ccc9-11e9-961b-1a82e197906c.PNG" width="400">
  <img alt="PICTURE logo" src="https://user-images.githubusercontent.com/18640201/64076773-3cad6480-ccc9-11e9-91c7-c7037c05738a.PNG" width="400">
  <img alt="PICTURE logo" src="https://user-images.githubusercontent.com/18640201/64077024-34a2f400-cccc-11e9-93ad-ff7e5b40bb17.PNG" width="400">
  <img alt="PICTURE logo" src="https://user-images.githubusercontent.com/18640201/64077027-34a2f400-cccc-11e9-8b69-f69d32fc7a67.PNG" width="400"><br>
  More screenshots <a href="https://github.com/Tonemon/UBank/wiki/Screenshots">here</a>.
</p>

## About
UBank is a small banking system, which can be installed online/offline for personal use. I started the UBank project to learn how to make a bank demo using html, css & javascript for the frontend and PHP & mysql for the backend. After a while I kept adding new features to expand it and at the moment it got a homepage, a user panel and an administrator panel. To host this project, but keep it offline (for security purposes) I used Ampps for the Apache webserver & MySQL application, because it's installed automatically and it's very usefull for managing offline domains on your pc. To access the MySQL databases I used the PHPMyAdmin console in AMPPS.

## Features
<ul>
	<li>2 Different user accounts and 3 different admin accounts on two seperate systems:<br>
		Main user login page (http://account.ubank.me):
		<ul>
			<li>Current account: normal tranfer account 'and where you money can be used in loans'.</li>
			<li>Savings account: same as current 'but it won't get used in loans'.</li>
		</ul>
		Admin login panel (http://account.ubank.me/staff/):
		<ul>
			<li>Owner account: only one (because of the highest permissions), has access to all of the administrator functions in the panel.</li>
			<li>Admin account: unlimited, has access to the maintenance panel, can add/edit/remove staff and users.</li>
			<li>Staff account: unlimited, can approve/deny card requests, can answers user questions, can add/edit/remove users.</li>
		</ul>
	</li>
	<li>Add users to your contact list to transfer funds to them. You will need to know their full name, account number, country and ifsc code.</li>
	<li>Users can request cards for their account (mastercard, visacard or creditcard) and staff members can approve/deny them.</li>
	<li>User can ask questions, which will be answered by a staff member.</li>
	<li>Everyone can go to their settings page to change their account password manually. Other changes require a support ticket for the staff to change the information.</li>
</ul>

## Important Details
1. The UBank project has two domains: ```ubank.me``` (homepage with information and account creation) and ```account.ubank.me```. The ```account.ubank.me``` domain is separated in two different login pages: ```account.ubank.me``` for the normal users and ```account.ubank.me/staff/``` for the owner, administrators and staff members.
2. This project contains two databases (called ```UBankMAIN``` and ```UBankDAT```) and one database user (called ```UBank``` with password ```UBank```). This user needs to have full access to both databases. If you want to change the username/password of this user, please go to all of the ```_inc/dbconn.php``` files and change it there after changing in the PHPMyAdmin panel.
3. Feel free to add/remove any user except the owner account (with userid 1 in the ```UBankMAIN``` database, staff table), because you will not be able to add new administrator accounts and it will create big problems with other fuctions.
4. It's recommended (for security reasons) to change the password hashing salt after the installation on the ```account.ubank.me``` domain for both of hte login systems. It's also recommended to make them different for the user panel and staff panel for extra security.
5. It's recommended to change the owner account password (with userid 1), because this account has all permissions to the user and staff panel.

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