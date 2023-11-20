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
   require_once('dbconn.php');





?>



<!DOCTYPE html>
<html>
<head>
    <title>Pet Rescue - Pet Details</title>
    
        <link rel="stylesheet" href="css/Annies_Master.css">

        <!-- Google fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
        <!-- Google fonts -->


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

  <div class="container_details">



    <?php





    $petId = $_GET['petId'];


    $sql = "SELECT * FROM pets WHERE pet_id = $petId";
    $results = $dbConn->query($sql)
    or die ('Problem with query: ' . $dbConn->error);


    while ($petDetails = $results->fetch_assoc()) {
    // Display the pet details
    echo "<h2>Details about " . $petDetails['name'] . "</h2>";
    echo "<div class='center'>";
    echo "<img src='" . $petDetails['image_path'] . "' alt='Pet Photo'>";
    echo "</div>";
    echo "<p>Age: " . $petDetails['age'] . "</p>";
    echo "<p>Gender: " . $petDetails['gender'] . "</p>";
    echo "<p>Breed: " . $petDetails['breed'] . "</p>";
    echo "<p>Description: " . $petDetails['description'] . "</p>";
    echo "<p>Location: " . $petDetails['suburb'] . ", " . $petDetails['state'] . "</p>";
    echo "<p>Adoption Fee: " . $petDetails['fee'] . ".00$</p>";

    }




    if (isset($user_id)) {
        // Display the adoption application form
        $sql_user = "SELECT * FROM users WHERE user_id = $user_id";
        $results_user = $dbConn->query($sql_user)
        or die ('Problem with query: ' . $dbConn->error);


        while ($userdetails = $results_user->fetch_assoc()) {


        echo "<h2>Adoption Application</h2>";
        echo "<form name='adoptionForm' method='GET' action='" . "pet_details.php?id=" . $petId . "'>";
        echo "<input type='hidden' name='petId' value='" . $petId . "'>";
        echo "<input type='hidden' name='user_id' value='" . $user_id . "'>";

        echo "<label for='firstName'>First Name:</label>";
        echo "<input type='text' value='" . $userdetails['first_name'] . "' name='firstName'><br>";

        echo "<label for='lastName'>Last Name:</label>";
        echo "<input type='text' value='" . $userdetails['last_name'] . "' name='lastName'><br>";

        echo "<label for='email'>Email Address:</label>";
        echo "<input type='text' value='" . $userdetails['email'] . "' name='email'><br>";

        echo "<label for='mobile'>Mobile Number</label>";
        echo "<input type='text' value='" . $userdetails['mobile'] . "' name='mobile'><br>";

        echo "<label for='statement'>Statement:</label>";
        echo "<textarea name='statement'></textarea><br>";

        echo "<div class='center'>";
        echo "<input type='submit' value='Submit' name='submit'>";
        echo "</div>";
        echo "</form>";
      }

    } else {
        echo "<p class='error-message'>Please register and log in to submit an adoption application.</p>";
    }

    if(isset($_GET['submit'])) {


      // DATA Sanitize function
      function validateInput($data) {

          $dbConn = new mysqli('localhost', 'twa405', 'twa405uD', 'petrescue405');
          $data = $dbConn->escape_string($data);
          $data = htmlspecialchars($data);
          return $data;
      }

    // Sanitize and escape the form inputs to prevent SQL injection
    $firstName = validateInput($_GET['firstName']);
    $lastName = validateInput($_GET['lastName']);
    $email = validateInput($_GET['email']);
    $mobile = validateInput($_GET['mobile']);
    $statement = validateInput($_GET['statement']);




    // ERROR HANDLING
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    } elseif (strlen($firstName) > 50) {
        $errors[] = "First name Character should not exceed 50 characters.";
    }


    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }  elseif (strlen($lastName) > 50) {
        $errors[] = "Last name Character should not exceed 50 characters.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (strlen($email) > 100) {
        $errors[] = "Email Character should not exceed 100 characters.";
    }

    if (empty($mobile)) {
        $errors[] = "Mobile is required.";
    } elseif (strlen($mobile) > 10) {
        $errors[] = "Mobile number Character should not exceed 10 characters.";
    } elseif (!is_numeric($mobile)) {
        $errors[] = "Mobile number must be a numeric value.";
    }

    if (empty($statement)) {
        $errors[] = "Statement is required.";
    }


    // If no errors, update the petrescue database
    if (empty($errors)) {
        // Database insertion
        $sql = "INSERT INTO adoptions (pet_id, user_id, application_notes) VALUES ('$petId', '$user_id', '$statement')";

        // Execute the query
        if (mysqli_query($dbConn, $sql)) {
            echo "<p>Application submitted successfully.</p>";
        } else {
            echo "<p>Error: " . mysqli_error($dbConn) . "</p>";
        }

    } else {
        // Display error messages
        foreach ($errors as $error) {
            echo "<p class='error-message'>" . $error . "</p>" . "<br>";
        }
    }

  }

    // Close the database connection
    $dbConn->close();
    ?>

    <footer>
        <p><strong>&copy; Otgonbileg Batbileg  <br> SID:22037760</strong></p>
    </footer>
    </div>
  </div>
</body>
</html>
