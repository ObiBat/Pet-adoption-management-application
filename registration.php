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
    <title>Pet Rescue - Registration</title>
    <!-- Add your CSS and JavaScript files here -->

        <link rel="stylesheet" href="css/Annies_Master.css">

        <!-- Google fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
        <!-- Google fonts -->
    <script>

    </script>
</head>
<body>

  <div class="container">



  <nav>
      <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="pet_listing.php">Pet Listings</a></li>
          <li><a href="registration.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
      </ul>
  </nav>

  <?php

require_once("dbconn.php");

// Function to validate and sanitize input data
function validateInput($data) {

    $dbConn = new mysqli('localhost', 'twa405', 'twa405uD', 'petrescue405');
    $data = $dbConn->escape_string($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Validate and sanitize the input data
    $first_name = validateInput($_POST["first_name"]);
    $last_name = validateInput($_POST["last_name"]);
    $email = validateInput($_POST["email"]);
    $mobile = validateInput($_POST["mobile"]);
    $password = validateInput($_POST["password"]);

    // Server-side validation
    $errors = [];

    // Check if all fields are filled
    if (empty($first_name) || empty($last_name) || empty($email) || empty($mobile) || empty($password)) {
        $errors[] = "All fields are required.";
    }


// the following code method was modified from CHATGPT generated code https://chat.openai.com/
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }


    // Check if the email is unique
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = mysqli_query($dbConn, $checkEmailQuery);
    if (mysqli_num_rows($checkEmailResult) > 0) {
        $errors[] = "Email address already exists.";
    }

    // If there are no errors, insert the user data into the database
    if (empty($errors)) {
        // Hash the password using sha256 algorithm
        $hashedPassword = hash("sha256", $password);

        // Insert user data into the database
        $insertQuery = "INSERT INTO users (first_name, last_name, email, mobile, password)
                        VALUES ('$first_name', '$last_name', '$email', '$mobile', '$hashedPassword')";
        $insertResult = mysqli_query($dbConn, $insertQuery);

        if ($insertResult) {
            // Registration successful
            echo "<p>Registration successful!</p><br>";
            echo "<p>You can log in now.</p><br>";
            // Redirect to a success page or login page
        } else {
            // Registration failed
            echo "<p></p>Registration failed. Please try again.";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }

    // Close the database connection
    $dbConn->close();
}
?>

<div class="login_form">



<h2>Registration Form</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        <br><br>
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="mobile">Mobile Number:</label>
        <input type="text" id="mobile" name="mobile" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <input type="submit" value="Register" name="submit">
    </form>

    </div>
    <footer>
        <p><strong>&copy; Otgonbileg Batbileg  <br> SID:22037760</strong></p>
    </footer>

      </div>
</body>
</html>
