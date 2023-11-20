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



<?php
require_once("nocache.php");




session_start();

// Store the user details in session variables
$user_id = $_SESSION['who'];
$user_level = $_SESSION['level'];


 ?>






  <nav>
      <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="manage_pet_adoption_apps.php">Adoption application</a></li>
          <li><a href="logoff.php">Log out</a></li>
      </ul>
  </nav>

        <div class="login_form">
      
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <br>
            <label for="species">Species:</label>
            <input type="text" id="species" name="species">
            <br>
            <label for="breed">Breed:</label>
            <input type="text" id="breed" name="breed">
            <br>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age">
            <br>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Unknown" selected >Unknown</option>
            </select>
            <br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
            <br>
            <label for="image_name">Image Path Name:</label>
            <input type="text" id="image" name="image_name">
            <br>
            <label for="suburb">Suburb:</label>
            <input type="text" id="suburb" name="suburb">
            <br>
            <label for="state">State:</label>
            <select id="state" name="state">
                <option value="NSW">New South Wales</option>
                <option value="VIC">Victoria</option>
                <option value="QLD">Queensland</option>
                <option value="ACT">Australian Capital Territory</option>
            </select>
            <br>
            <label for="adoption_fee">Adoption Fee:</label>
            <input type="text" id="adoption_fee" name="adoption_fee">
            <br>
            <input type="submit" value="Add Pet" name="submit">
        </form>

        <?php
        if(isset($_POST['submit'])) {
            // Process the form data when it is submitted

            require_once('dbconn.php');



            // Validate and sanitize the input fields as necessary
            // DATA Sanitize function
            function validateInput($data) {

                $dbConn = new mysqli('localhost', 'twa405', 'twa405uD', 'petrescue405');
                $data = $dbConn->escape_string($data);
                $data = htmlspecialchars($data);
                return $data;
            }


            // Sanitize and escape the form inputs to prevent SQL injection. XSS Attack
            $name = validateInput($_POST['name']);
            $species = validateInput($_POST['species']);
            $breed = validateInput($_POST['breed']);
            $age = validateInput($_POST['age']);
            $gender = validateInput($_POST['gender']);
            $description = validateInput($_POST['description']);
            $image_name = validateInput($_POST['image_name']);
            $suburb = validateInput($_POST['suburb']);
            $state = validateInput($_POST['state']);
            $adoption_fee = validateInput($_POST['adoption_fee']);




            // Error handling
            $errors = array();

            // validation checks for mandatory fields, data types, and sizes
            if (empty($name)) {
                $errors[] = "Name is required.";
            } elseif (strlen($name) > 50) {
                $errors[] = "Name should not exceed 50 characters.";
            }

            if (empty($species)) {
                $errors[] = "Species is required.";
            } elseif (strlen($species) > 50) {
                $errors[] = "Species should not exceed 50 characters.";
            }

            if (empty($breed)) {
                $errors[] = "Breed is required.";
            } elseif (strlen($breed) > 50) {
                $errors[] = "Breed should not exceed 50 characters.";
            }

            if (empty($age)) {
                $errors[] = "Age is required.";
            } elseif (!is_numeric($age)) {
                $errors[] = "Age must be a numeric value.";
            }

            if (empty($gender)) {
                $errors[] = "Gender is required.";
            } elseif (!in_array($gender, array("Male", "Female", "Unknown"))) {
                $errors[] = "Invalid gender.";
            }

            if (empty($description)) {
                $errors[] = "Description is required.";
            }

            if (empty($image_name)) {
                $errors[] = "Image path 'ABC/abc.image' is required.";
            } elseif (strlen($breed) > 100) {
                $errors[] = "Character should not exceed 100 characters.";
            }



            if (empty($suburb)) {
                $errors[] = "Suburb is required.";
            } elseif (strlen($suburb) > 50) {
                $errors[] = "Suburb should not exceed 50 characters.";
            }

            if (empty($state)) {
                $errors[] = "State is required.";
            } elseif (!in_array($state, array("NSW", "VIC", "QLD", "ACT"))) {
                $errors[] = "Invalid state.";
            }

            if (empty($adoption_fee)) {
                $errors[] = "Adoption Fee is required.";
            } elseif (!is_numeric($adoption_fee)) {
                $errors[] = "Adoption Fee must be a numeric value.";
            }


            // If no errors, update the petrescue database
            if (empty($errors)) {
                // Database insertion code goes here
                $sql = "INSERT INTO pets (name, species, breed, age, gender, description, image_path, suburb, state, fee) VALUES ('$name', '$species', '$breed', '$age', '$gender', '$description', '$image_name', '$suburb', '$state', '$adoption_fee')";

                // Execute the query
                if (mysqli_query($dbConn, $sql)) {
                    echo "<p>Pet added successfully.</p>";
                } else {
                    echo "<p>Error: " . mysqli_error($dbConn) . "</p>";
                }

            } else {
                // Display error messages
                foreach ($errors as $error) {
                    echo "<p class='error-message'>" . $error . "</p>" . "<br>";
                }
            }






            // Close the database connection
            $dbConn->close();
        }
         ?>
      </div>
        <footer>
            <p><strong>&copy; Otgonbileg Batbileg  <br> SID:22037760</strong></p>
        </footer>
          </div>
      </body>
    </html>
