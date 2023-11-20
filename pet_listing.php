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
   // ensure page is not cached
   require_once("nocache.php");


        // connect to the database
        require_once('dbconn.php');


?>
<!DOCTYPE html>
<html>
<head>
    <title>Pet Rescue - Pet Listings</title>

    <!-- Google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <!-- Google fonts -->



    <link rel="stylesheet" href="css/Annies_Master.css">
</head>
<body>

    <div class="container">


      <?php

      session_start();

        if (isset($_SESSION['who'])) {

            $user_id = $_SESSION['who'];
            $user_level = $_SESSION['level'];
            echo "      <nav>
                      <ul>
                          <li><a href='index.html'>Home</a></li>
                          <li><a href='pet_listing.php'>Pet Listings</a></li>
                          <li><a href='logoff.php'>Log Out</a></li>
                      </ul>
                  </nav>";
        } else {

            echo "      <nav>
                      <ul>
                          <li><a href='index.html'>Home</a></li>
                          <li><a href='pet_listing.php'>Pet Listings</a></li>
                          <li><a href='registration.php'>Register</a></li>
                          <li><a href='login.php'>Login</a></li>
                      </ul>
                  </nav>";
        }




       ?>




  <form class="search-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <label for="species">Species:</label>
    <input type="text" id="species" name="species" placeholder="Enter species">

    <label for="gender">Gender:</label>
    <select id="gender" name="gender">
        <option value="Unknown">Any</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <input type="submit" value="submit" name="submit">
</form>

    <div class="pet-container">

    <?php

    if(isset($_POST['submit'])) {



      // DATA Sanitize function
      function validateInput($data) {

          $dbConn = new mysqli('localhost', 'twa405', 'twa405uD', 'petrescue405');
          $data = $dbConn->escape_string($data);
          $data = htmlspecialchars($data);
          return $data;
      }

      // Sanitising the DATA
      $species = validateInput($_POST['species']);
      $gender = validateInput($_POST['gender']);




      $sql = "SELECT * FROM pets WHERE species LIKE '%$species%' AND gender LIKE '%$gender%'";
      $result = mysqli_query($dbConn, $sql);

      if (mysqli_num_rows($result) > 0) {
          // Display the pet listings
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<div class='pet'>";
              echo "<img src='" . $row['image_path'] . "' alt='"  . "'><br>";
              echo "Name: " . $row['name'] . "<br>";
              echo "Suburb: " . $row['suburb'] . "<br>";
              echo "State: " . $row['state'] . "<br>";
              echo "<a class='btn-view-details' href='pet_details.php?petId=" . $row['pet_id'] . "'>View Details</a>";
              echo "</div>";
          }
        } else {
            echo "<p>No pets found.</p>";
        }
      }
      else {

        $adoption_pending = "Adoption Pending";
        $adoption_available = "Available";

        $sql = "SELECT * FROM pets WHERE status = '$adoption_pending' OR status = '$adoption_available'";
        $result = mysqli_query($dbConn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Display the pet listings
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<div class='pet'>";
              echo "<img src='" . $row['image_path'] . "' alt='"  . "'><br>";
              echo "Name: " . $row['name'] . "<br>";
              echo "Suburb: " . $row['suburb'] . "<br>";
              echo "State: " . $row['state'] . "<br>";

              // the following code method was modified from CHATGPT generated code https://chat.openai.com/
              echo "<a class='btn-view-details' href='pet_details.php?petId=" . $row['pet_id'] . "'>View Details</a>";
              echo "</div>";
                }
              }

            }


    // Close the DB connection
    $dbConn->close();
    ?>
    </div>
    </div>

    <footer>
        <p><strong>&copy; Otgonbileg Batbileg  <br> SID:22037760</strong></p>
    </footer>
</body>
</html>
