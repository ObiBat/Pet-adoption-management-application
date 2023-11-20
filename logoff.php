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
   // ensure the page is not cached
   require_once("nocache.php");

   // get access to the session variables
   session_start();

   // Now destroy the session
   session_destroy();

   // Redirect the user to the starting page (login.php)
   header("location: index.html");
?>
