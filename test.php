<?php
session_start();
if( !isset($_SESSION['id']) )
    header('Location: login.php');
include("connection.php");
$myrequest = $_GET['myrequest']??null;
$query = $myrequest ? "select * from food where donorId=".$_SESSION['id']." ORDER BY foodId DESC" : "select * from food ORDER BY foodId DESC"; 
$id=$_SESSION['id'];
$result=mysqli_query($con,$query); 
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
    <style type="text/css">.disclaimer { display: none; }</style>

    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/my-login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
        <style>
        
        #load {
            color: black;
            background-color: #eee;
            height: 50px;
            width: 200px;
            border-radius: 10px;
            border-color: #96bdd9;
            box-shadow: inset 0 1px 0 #f4f8fb;
            margin-bottom: 20px;
            outline: none;
        }
        #netframe {
           
            height: 85%;
            border: none;
        }
    </style>
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
				  echo "Welcome, ". $_SESSION['name']."!";
                  ?>
                </h4>

            </center>
            <a href="profile.php"><i class="fas fa-sliders-h"></i><span>Profile</span></a>
            <a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
            <a href="request.php"><i class="fas fa-cogs"></i><span>Create Request</span></a>
            <a href="dashboard.php?myrequest=true"><i class="fas fa-table"></i><span>My Requests</span></a>
            <!-- <a href="#"><i class="fas fa-th"></i><span>ABC</span></a> -->
            <a href="#"><i class="fas fa-info-circle"></i><span>Tracking</span></a>

        </div>
        <!--sidebar end-->
            <div id="box" class="container-1">
                <div>
               Enter A URL:
                <input type="text" name="url" id="url">
                <input type="button" value="load" id="load">
                <br><br>    
            </div>
            <div id="netframe">
                <iframe height="75%" width="100%" class="netframe"  id="main_frame"></iframe>
            </div>
            </div>
         </div>  
         <script>
            
        </script>
        


        
        <nav class="mobile-nav">
            <a href="dashboard.php"><i class="fas fa-desktop" id="bloc-icon"></i></a>
            <a href="dashboard.php?myrequest=true"><i class="fas fa-table" id="bloc-icon"></i></a>
            <a href="request.php"><i class="fas fa-cogs" id="bloc-icon"></i></a>
            <a href="#"><i class="fas fa-info-circle" id="bloc-icon"></i></a>
            <a href="profile.php"><i class="fas fa-sliders-h" id="bloc-icon"></i></a>
        </nav>
        
       
        <script type="text/javascript"  src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
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
        <script src="js/utils.js"></script>
        <script src="js/dashboardPage.js"></script>
        <script src="js/cards.js"></script>
</body>

</html>