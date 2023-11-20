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
    <title>Pet Rescue - Manage Adoption Applications</title>
    <!-- Add your CSS and JavaScript files here -->
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
            <li><a href="index.html">Home</a></li>
            <li><a href="manage_pet_listing.php">Pet Listings</a></li>
            <li><a href="logoff.php">Log out</a></li>
        </ul>
    </nav>

<div class="table">




<?php


        // database connection and no cache
                require_once("nocache.php");
                require_once('dbconn.php');


                // Process the form submission
                  if (isset($_POST['submit-app'])) {

                    // DATA Sanitize function
                    function validateInput($data) {

                        $dbConn = new mysqli('localhost', 'twa405', 'twa405uD', 'petrescue405');
                        $data = $dbConn->escape_string($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }


                    $application_id = validateInput($_POST['application_id']);
                    $decision = validateInput($_POST['decision']);
                    $current_time = date('Y-m-d H:i:s');

                    // Update the application status in the database
                    $updateSql = "UPDATE adoptions SET adoption_date = '$current_time', application_status = '$decision' WHERE application_id = '$application_id'";
                    $updateResult = mysqli_query($dbConn, $updateSql);

                    }




        $sql = "SELECT * FROM adoptions";
        $result = mysqli_query($dbConn, $sql);


        if (mysqli_num_rows($result) > 0) {
            // Display the list of  adoption applications
            echo "<br><br><br><h2>Adoption Applications</h2>";
            echo "<table>";
            echo "<tr><th>Application ID</th><th>Pet ID</th><th>Applicant Name</th><th>Decision</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['application_id'] . "</td>";
                echo "<td>" . $row['pet_id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['application_status'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";




            echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";

            echo "<label for='application_id'>Application ID:</label>";
            echo "<input type='number' name='application_id'" . "><br>";
            echo "<label for='decision'>Decision:</label>";
            echo "<select name='decision'>
                    <option value='approved'>Approved</option>
                    <option value='rejected'>Rejected</option>
                    <option value='pending'>Pending</option>
                  </select>";
            echo "<input type='submit' value='Submit' name='submit-app'>";
            echo "</form>";

        } else {
            echo "<p>No pending adoption applications found.</p>";
        }



          if (isset($_POST['submit-app'])) {
            if ($updateResult) {
              echo "<p class='green'>Application status updated successfully.</p>";
            } else {
              echo "<p class='error-message'>Error updating application status.</p>";
            }
          }


        echo "</div>";

        // Close the database connection
        $dbConn->close();

    ?>



    <footer>
        <p><strong>&copy; Otgonbileg Batbileg  <br> SID:22037760</strong></p>
    </footer>

      </div>
</body>
</html>
