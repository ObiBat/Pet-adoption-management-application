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
require_once("nocache.php");

session_start();

  if (isset($_SESSION['who'])) {
      // Page was redirected from the specific source
      $user_id = $_SESSION['who'];
      $user_level = $_SESSION['level'];
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Annie's Animal Adoptions</title>
    <link rel="stylesheet" href="css/Annies_Master.css">


<!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
<!-- Google fonts -->

</head>
<body>

    <div class="container">

      <nav>
          <ul>
              <li><a href="manage_pet_listing.php">Go back</a></li>
          </ul>
      </nav>

        <br>
        <h1 class="center"> This function is being developed soon enough.</h1>

    <footer>
        <p><strong>&copy; Otgonbileg Batbileg  <br> SID:22037760</strong></p>
    </footer>

    </div>
</body>
</html>
