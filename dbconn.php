<!--
Otgonbileg Batbileg
SID: 22037760
Web App Project

Reference:

Resources:
1.lecture notes
2. Example codes
3.ChatGPT
4.http://w3schools.com
5.http://au2.php.net/manual/

 -->
<?php
$dbConn = new mysqli('localhost', 'twa405', 'twa405uD', 'petrescue405');
if ($dbConn->connect_error) {
die('Connection error (' . $dbConn->connect_errno . ')'
. $dbConn->connect_error);
}

 ?>
