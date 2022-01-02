<?php
include("connection.php");
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
    
    $sql = "INSERT INTO food (foodtype, location) VALUES ( '$foodtype', '$location')";   // Use you own column name from login table
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

$query="select * from food"; 
$result=mysqli_query($con,$query); 


      ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/my-login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="js/cards.js" defer></script>
</head>

<body>
    <!--header area start-->
    <header>
        <div class="left_area">
            <h3>Food4<span>Thought</span></h3>
        </div>
        <div class="right_area">
            <a href="logout.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <section>
        <div class="sidebar">
            <center>
                <img src="img/1.png" class="profile_image" alt="">
                <h4>Demo User</h4>
            </center>
            <a href="#"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
            <a href="#popup1"><i class="fas fa-cogs"></i><span>Create Request</span></a>
            <a href="javascript:gclick()"><i class="fas fa-table"></i><span>Create Card</span></a>
            <a href="#"><i class="fas fa-th"></i><span>ABC</span></a>
            <a href="#"><i class="fas fa-info-circle"></i><span>ABC</span></a>
            <a href="#"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
        </div>
        <!--sidebar end-->
    </section>

   



    <div id="box1" class="container-1">
    <?php while($rows=mysqli_fetch_assoc($result)){?>
         <div class="courses-container">
          <div class="course">
            <div class="course-preview">
              <img src="img/map.jpg" height="200" width="200">
            </div>
            <div class="course-info">
              <div class="progress-container">
                <div class="progress"></div>
              </div>
              <h6><?php echo $rows['location']; ?></h6>
              <h2><?php echo $rows['foodtype']; ?></h2>
              <button class="btn">More Info</button>

            </div>
           
        </div>
        <?php } ?>

        <div id="popup1" class="overlay">
            <div class="popup">
                <h2>Donation Form</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        <div class="container-2">

        </div>


</body>

</html>