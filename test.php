<?php
session_start();
if(isset($_POST['foodtype']) && isset($_POST['location']))
{
    $foodtype = $_POST["foodtype"];
    $location = $_POST["location"];
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "loginsystem";
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die('Could not connect to the database.');
    }
    else {
        $sql = "INSERT INTO food (foodtype, location) VALUES ( '$foodtype', '$location')";   // Use you own column name from login table
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<body>
<h2>Donation Form</h2>
            
                <div class="content">
                    <form action="test.php" method="POST">
                        <div class="form-group">
                            <label for="foodtype">Food type</label>
                            <input id="foodtype" type="foodtype" name="foodtype">

                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input id="location" type="location" name="location">
                        </div>



                        <div class="form-group m-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                Submit
                            </button>
</body>