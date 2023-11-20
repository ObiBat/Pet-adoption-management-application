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

// Connect to db


session_start();

// Store the user details in session variables
$user_id = $_SESSION['who'];
$user_level = $_SESSION['level'];


 ?>
 <!DOCTYPE html>
<html>
<head>

  <!-- Google fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
  <!-- Google fonts -->
    <title>Pet Rescue - Manage Pet Listings</title>
    

        <link rel="stylesheet" href="css/Annies_Master.css">
</head>
<body>






<div class="container">



  <nav>
      <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="manage_pet_adoption_apps.php">Adoption application</a></li>
          <li><a href="logoff.php">Log out</a></li>
      </ul>
  </nav>

  <table>
      <tr>
          <th>Photo</th>
          <th>Name</th>
          <th>Species</th>
          <th>Breed</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Description</th>
          <th>Status</th>
          <th>Suburb</th>
          <th>State</th>
          <th>Fee</th>
          <th>Date Added</th>
      </tr>
      <?php

      require_once('dbconn.php');

      // Retrieve pet listings from the database
      $sql = "SELECT * FROM pets";
      $result = mysqli_query($dbConn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td><img class='small_photo' src='" . $row['image_path'] . "' alt='Pet Photo'></td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['species'] . "</td>";
          echo "<td>" . $row['breed'] . "</td>";
          echo "<td>" . $row['age'] . "</td>";
          echo "<td>" . $row['gender'] . "</td>";
          echo "<td>" . $row['description'] . "</td>";
          echo "<td>" . $row['status'] . "</td>";
          echo "<td>" . $row['suburb'] . "</td>";
          echo "<td>" . $row['state'] . "</td>";
          echo "<td>" . $row['fee'] . "</td>";
          echo "<td>" . $row['date_added'] . "</td>";
          echo "</tr>";
      }

      // Close the database connection
      $dbConn->close();
      ?>
  </table>

  <div class="button-container">
    <a href="Adding_pet.php">
        <button>Add Pet</button>
    </a>
    <a href="under_work.php">
        <button>Update Pet</button>
    </a>
    <a href="under_work.php">
        <button>Remove Pet</button>
    </a>
</div>

        <footer>
            <p><strong>&copy; Otgonbileg Batbileg  <br> SID:22037760</strong></p>
        </footer>
      </div>

      </body>
    </html>
