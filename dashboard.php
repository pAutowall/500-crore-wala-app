<?php
// include("auth_session.php");
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

    <!-- <div class="content"></div> -->



    <div id="box1" class="container-1">
        
        </div>

        <div id="popup1" class="overlay">
            <div class="popup">
                <h2>Donation Form</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    <form>
                        <div class="form-group">
                            <label for="name">Food type</label>
                            <input id="name" type="text">

                        </div>

                        <div class="form-group">
                            <label for="email">Quantity</label>
                            <input id="email" type="email">

                        </div>

                        <div class="form-group">
                            <label for="password">Location</label>
                            <input id="password" type="password" name="password">
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
