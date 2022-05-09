<?php
    session_start();
    include("connection.php");
    if(isset($_POST['request'])) {
        $requestType = $_POST['request'];
        $location = $_POST['location'];
        $expiry = strtotime($_POST['expiry']);
        $foodDescription = $_POST['foodDescription'];
        $result = $con->query("INSERT INTO food VALUES (NULL,".$_SESSION['id'].",'".$foodDescription."','".$location."',".$expiry.",'".$requestType."');");
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"/>
</head>

<body>
    <!--header area start-->
    <header>
        <div class="left_area">
            <h3 class="logo">Food4<span>Thought</span></h3>
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
    </section>

   



    <div id="box1" class="container-1">
    
    <h2>Donation Form</h2>
                    <!-- <a class="close" href="#">&times;</a> -->
                    <div class="content">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group">
                                <label for="requestType">Request Type</label>

                                <select name="request" id="requestType">
                                    <option value="donor">Donor</option>
                                    <option value="reciever">Reciever</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input id="location" type="text" name="location">
                            </div>
                            <div class="form-group">
                                <label for="expiry">Expires After</label>
                                <input id="expiry" type="text" name="expiry">
                            </div>
                            <div class="form-group">
                                <label for="foodDescription">Food Description/ Requirement</label>
                                <textarea id="foodDescription" name="foodDescription" rows="4" cols="50"></textarea>
                            </div>
                            <div class="form-group m-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>

        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/cards.js"></script>
    <script src="js/requestPage.js"></script>
    
</body>

</html>