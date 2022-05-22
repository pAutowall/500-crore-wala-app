<?php
    session_start();
    if( !isset($_SESSION['id']) )
        header('Location: login.php');
    if( !isset($_GET['requestid']) )
        header('Location: dashboard.php');
    include("connection.php");
    $query = "SELECT t.trackingLink,t.deliveryStatus,f.foodDisplayId,r.requestorId,f.donorId
    FROM tracking t
    INNER JOIN requests r
    ON t.requestId = r.requestId
    INNER JOIN food f
    ON r.foodId = f.foodId AND r.requestId = ".$_GET['requestid'].";";
    $id=$_SESSION['id'];
    $result = mysqli_query($con,$query); 
    $select = mysqli_query($con, "SELECT * FROM `users` WHERE id = '$id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/toast.css">
    <link rel="stylesheet" href="css/tracking.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
</head>

<body>

    <!--header area start-->
    <header class="mainhead">
        <div class="left_area">
            <h3 class="logo">Food4<span>Thought</span>
                </button></h3>
        </div>
        <div class="right_area">
            <a href="logout.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!--header area end-->
    <div class="wrapper">
        <!--sidebar start-->
        <div class="sidebar" id="sidebar">
            <center>
                <?php
         if($fetch['pfp'] == ''){
            echo '<img src="images/default-avatar.png" class="profile_image" alt="">
            ';
         }else{
            echo '<img src="uploaded_img/'.$fetch['pfp'].'" class="profile_image" alt="">
            ';
         }
         ?>
                <h4>
                    <?php 
				  echo  $_SESSION['name'];
                  ?>
                </h4>

            </center>
            <a href="profile.php"><i class="fas fa-sliders-h"></i><span>Profile</span></a>
            <a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
            <a href="request.php"><i class="fas fa-cogs"></i><span>Create Request</span></a>
            <a href="dashboard.php?myrequest=true"><i class="fas fa-table"></i><span>My Requests</span></a>
            <!-- <a href="#"><i class="fas fa-th"></i><span>ABC</span></a> -->
            <!-- <a href="tracking.php"><i class="fas fa-info-circle"></i><span>Tracking</span></a> -->

        </div>
        <!--sidebar end-->
        <div id="box" class="container-1">
            <?php while($rows=mysqli_fetch_assoc($result)){?>
            <div class="courses-container">
                <div class="container px-1 px-md-4 py-5 mx-auto">
                    <div class="card">
                        <div class="row d-flex justify-content-between px-3 top">
                            <div class="d-flex">
                                <h5>REQUEST ID : <span class="text-primary font-weight-bold"><?php echo $rows['foodDisplayId']; ?></span></h5>
                            </div>
                            <!-- <div class="d-flex flex-column text-sm-right">
                                <p class="mb-0">Expected Arrival <span>01/12/19</span></p>
                                <p>USPS <span class="font-weight-bold">234094567242423422898</span></p>
                            </div> -->
                        </div>
                        <!-- Add class 'active' to progress -->
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                            <ul id="progressbar" class="text-center">
                                <?php if($rows['deliveryStatus']>="1") {?> 
                                <li class="active step0"></li> 
                                <?php } else { ?>
                                    <li class="step0"></li>
                                <?php } ?>
                                <?php if($rows['deliveryStatus']>="2") {?> 
                                <li class="active step0"></li> 
                                <?php } else { ?>
                                    <li class="step0"></li>
                                <?php } ?>  
                                <?php if($rows['deliveryStatus']>="3") {?> 
                                <li class="active step0"></li> 
                                <?php } else { ?>
                                    <li class="step0"></li>
                                <?php } ?>  
                                <?php if($rows['deliveryStatus']>="4") {?> 
                                <li class="active step0"></li> 
                                <?php } else { ?>
                                    <li class="step0"></li>
                                <?php } ?>
                            </ul>
                            </div>
                        </div>
                        <div class="row justify-content-between top">
                            <div class="row d-flex icon-content">
                                <img class="icon r" src="https://i.imgur.com/9nnc9Et.png">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-bold">Request<br>Accepted</p>
                                </div>
                            </div>
                            <div class="row d-flex icon-content">
                                <img class="icon r" src="https://i.imgur.com/u1AzR7w.png">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-bold">Food<br>Pick Up</p>
                                </div>
                            </div>
                            <div class="row d-flex icon-content">
                                <img class="icon r" src="https://i.imgur.com/TkPm63y.png">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-bold">Food<br>Delivery</p>
                                </div>
                            </div>
                            <div class="row d-flex icon-content">
                                <img class="icon r" src="https://i.imgur.com/HdsziHP.png">
                                <div class="d-flex flex-column">
                                    <p class="font-weight-bold">Food<br>Deliverd</p>
                                </div>
                            </div>
                        </div>
                        <?php if($rows['deliveryStatus'] == 1 && $rows['requestorId'] == $_SESSION['id']) {?>
                            <div class="d-flex justify-content-center my-1"><button type="button" class="btn btn-primary " id="trackingButton" data-ajax-data="<?php echo $_GET['requestid']?>">Add Tracking Info</button></div>
                        <?php } ?>
                        <?php if($rows['deliveryStatus'] == 2 && $rows['donorId'] == $_SESSION['id']) {?>
                            <div class="d-flex justify-content-center my-1"><button type="button" class="btn btn-primary " id="locationReachedButton" data-ajax-data="<?php echo $_GET['requestid']?>">Food Picked Up</button></div>
                        <?php }?>
                        <?php if($rows['deliveryStatus'] == 3 && $rows['requestorId'] == $_SESSION['id']) { ?>
                            <div class="d-flex justify-content-center my-1"><button type="button" class="btn btn-success " id="completeRequestButton" data-ajax-data="<?php echo $_GET['requestid']?>">Complete Request</button></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        
    
                        </div>
        
        <nav class="mobile-nav">
            <a href="dashboard.php"><i class="fas fa-desktop" id="bloc-icon"></i></a>
            <a href="dashboard.php?myrequest=true"><i class="fas fa-table" id="bloc-icon"></i></a>
            <a href="request.php"><i class="fas fa-cogs" id="bloc-icon"></i></a>
            <!-- <a href="#"><i class="fas fa-info-circle" id="bloc-icon"></i></a> -->
            <a href="profile.php"><i class="fas fa-sliders-h" id="bloc-icon"></i></a>
        </nav>
        
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/tracking.js"></script>
        <script src="js/toast.js"></script>
</body>

</html>