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

   $errorMessage = '';

   // check that the form has been submitted
   if(isset($_POST['submit'])) {

     // check that email and password were entered
     if(empty($_POST['email']) || empty($_POST['pword'])) {
        $errorMessage = "Both email and password are required";
     } else {
        // connect to the database
        require_once('dbconn.php');


        // DATA Sanitize function
        function validateInput($data) {

            $dbConn = new mysqli('localhost', 'twa405', 'twa405uD', 'petrescue405');
            $data = $dbConn->escape_string($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // parse email and password for special characters
        $email = validateInput($_POST['email']);
        $password = validateInput($_POST['pword']);

        // hash the password so it can be compared with the db value
        $hashedPassword = hash('sha256', $password);

        // query the db
        $sql = "SELECT is_admin, user_id from users where email = '$email' and password = '$hashedPassword'";
        $rs = $dbConn->query($sql);

        // check number of rows in record set. What does this mean in this context?
        if($rs->num_rows) {
            // start a new session for the user
            session_start();

            // Store the user details in session variables
            $user = $rs->fetch_assoc();
            $_SESSION['who'] = $user['user_id'];
            $_SESSION['level'] = $user['is_admin'];
            // Redirect the user to the secure page

            if ($_SESSION['level'] == "1") {

              header('Location: manage_pet_listing.php');

            } else {
              header('Location: pet_listing.php');
            }


        } else {
            $errorMessage = "Invalid Email or Password";
        }
     }
   }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
          <link rel="stylesheet" href="css/Annies_Master.css">

    <!-- Google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <!-- Google fonts -->

    <link rel="stylesheet" href="styles.css">
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

    <div class="login_form">


    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
       <p style="color:red;"><?php echo $errorMessage;?></p>
       <div class="input-box">
         <label for="email">Email address:</label>
         <input type="text" name="email" maxlength="50" id="email">
       </div>
       <div class="input-box">
         <label for="pword">Password:</label>
         <input type="password" name="pword" maxlength="20" id="pword">
       </div>
       <div class="input-box">
         <input type="submit" value="Login" name="submit">
       </div>
    </form>

    <p>For testing purposes here are some user credentials: <br> </p>
email Plain text password <br>
Annie@AAA.org adopt <br>
Pip@AAA.org catsRBest <br>
steve@gmail.com mypetRescuepassword <br>
rose@gmail.com roseLovesDogs <br>
bob@yahoo.com secure <br>
kate@gmail.com xbox</p>

  </div>
<footer>
    <p><strong>&copy; Otgonbileg Batbileg  <br> SID:22037760</strong></p>
</footer>
</div>
  </body>
</html>
