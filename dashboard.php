<?php
session_start();
include("connection.php");

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
    <link rel="stylesheet" href="css/utils.css">
</head>

<body>
    <div class="gridcontainer">
        <!--header area start-->
        <header class="mainhead">
            <div class="left_area">
                <h3 class="logo">Food4<span>Thought</span></h3>
            </div>
            <div class="right_area">
                <a href="logout.php" class="logout_btn">Logout</a>
            </div>
        </header>
        <!--header area end-->


        <!--sidebar start-->
        <div class="sidebar">
            <center>
                <img src="img/FPvkGPgXsAogrsG.jpg" class="profile_image" alt="">
                <h4>
                <?php 
				  echo "Welcome, ". $_SESSION['name']."!";
                  ?>
                </h4>

            </center>
            <a href="profile.php"><i class="fas fa-sliders-h"></i><span>Profile</span></a>
            <a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
            <a href="request.php"><i class="fas fa-cogs"></i><span>Create Request</span></a>
            <a href="javascript:gclick()"><i class="fas fa-table"></i><span>Create Card</span></a>
            <!-- <a href="#"><i class="fas fa-th"></i><span>ABC</span></a> -->
            <a href="#"><i class="fas fa-info-circle"></i><span>Tracking</span></a>

        </div>
        <!--sidebar end-->
        <div id="box1" class="container-1">
            <?php while($rows=mysqli_fetch_assoc($result)){?>
            <div class="courses-container">
                <div class="course">
                    <div class="course-preview" data="<?php echo $rows['location']; ?>">
                        <img src="img/map.jpg" height="200" width="200">
                    </div>
                    <div class="course-info">
                        <div class="progress-container">
                            <div class="progress"></div>
                        </div>
                        <h6><?php echo $rows['location']; ?></h6>
                        <h2><?php echo $rows['foodDetails']; ?></h2>
                        <?php if($rows['donorId']==$_SESSION['id']) { ?>
                                <button class="btn" id="editButton">Edit</button>
                        <?php } else { ?>
                                <button class="btn" id="applyButton">Apply</button>
                        <?php } ?>
                    </div>


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
        </div>




        <div id="fuxo">
            <?php echo json_encode($_SESSION['userDetails'])?>

        </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/dashboardPage.js"></script>
    <script src="js/cards.js"></script>
</body>

</html>