<?php
    session_start();
    if( !isset($_SESSION['id']) )
        header('Location: login.php');
    include("connection.php");
    $myrequest = $_GET['myrequest']??null;
    $query = $myrequest ? "select * from food where donorId=".$_SESSION['id']." ORDER BY foodId DESC" : "select * from food ORDER BY foodId DESC"; 
    $id=$_SESSION['id'];
    $result = mysqli_query($con,$query); 
    $select = mysqli_query($con, "SELECT * FROM `users` WHERE id = '$id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
    }
    $appliedQuery = mysqli_query($con,'SELECT f.foodId 
        from food f
        INNER JOIN requests r
        ON r.foodId = f.foodId AND r.requestorId = '.$_SESSION['id'].'
        ORDER BY f.foodId;
    ');
    $alreadyApplied = array();
    while($applied = mysqli_fetch_assoc($appliedQuery)){
        $alreadyApplied[] = $applied['foodId'];
    }
    $donorQuery = mysqli_query($con,'SELECT f.foodId 
        from food f
        INNER JOIN requests r
        ON r.foodId = f.foodId AND f.donorId = '.$_SESSION['id'].'
        ORDER BY f.foodId;
    ');
    $hasRecievedRequestForDonation = array();
    while($donation = mysqli_fetch_assoc($donorQuery)){
        $hasRecievedRequestForDonation[] = $donation['foodId'];
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
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
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
            <?php while($rows=mysqli_fetch_assoc($result)){?>
            <div class="courses-container">
                <div class="course">
                    <div class="course-preview" data="<?php echo $rows['location']; ?>">
                        <img src="img/map.jpg" height="200" width="200">
                    </div>
                    <div class="course-info">
                        <!-- <div class="progress-container">
                            <div class="progress"></div>
                        </div> -->
                        <h6><?php echo $rows['location']; ?></h6>
                        <h2><?php echo $rows['foodDetails']; ?></h2>
                        <p class="mobile-1">
                            <?php if($rows['donorId']==$_SESSION['id']) { ?>
                            <?php $ajaxData = $rows?>
                            <button class="btn btn-apply-edit" id="editButton" data-toggle="modal"
                                data-target="#editModal"
                                data-ajax-data="<?php echo htmlentities(json_encode($ajaxData)) ?>">Edit</button>
                            <?php } else { ?>
                                
                            <?php $ajaxData = ['foodDisplayId' => $rows['foodDisplayId'], 'foodId' => $rows['foodId']]?>
                            <button class="btn btn-apply-edit" id="applyButton" data-toggle="modal"
                                data-target="#applyModal"
                                data-ajax-data="<?php echo htmlentities(json_encode($ajaxData)) ?>"
                                <?php if(in_array($rows['foodId'],$alreadyApplied)) { echo 'disabled'; } else { echo ''; } ?> >Apply</button>
                            <?php } ?>
                            <?php if(in_array($rows['foodId'],$hasRecievedRequestForDonation)) { echo '<button class="btn btn-view-edit btn-warning" id="viewButton" data-toggle="modal">View Requests</button>'; } else { echo ''; } ?>
                        </p>
                        <div>
                            <div class="modal-footer" id="mobile-2">
                            
                                <?php if($rows['donorId']==$_SESSION['id']) { ?>
                                <?php $ajaxData = $rows?>
                                <button class="btn btn-apply-edit" id="editButton" data-toggle="modal"
                                    data-target="#editModal"
                                    data-ajax-data="<?php echo htmlentities(json_encode($ajaxData)) ?>">Edit</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-apply-edit" id="locationButton" data="<?php echo $rows['location']; ?>">Location</button>
                                <?php $ajaxData = ['foodDisplayId' => $rows['foodDisplayId'], 'foodId' => $rows['foodId']]?>
                                <button class="btn btn-apply-edit" id="applyButton" data-toggle="modal"
                                    data-target="#applyModal"
                                    data-ajax-data="<?php echo htmlentities(json_encode($ajaxData)) ?>" 
                                    <?php if(in_array($rows['foodId'],$alreadyApplied)) { echo 'disabled'; } else { echo ''; } ?> >Apply</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <?php } ?>


        </div>



        <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Request ID:</label>
                                <input type="text" class="form-control" id="recipient-name" disabled>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="applyModalSubmit" type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group" id="editRequestModal">
                                <label for="requestType">Request Type</label>

                                <select name="request" id="requestType" disabled>
                                    <option value="donor">Donor</option>
                                    <option value="reciever">Reciever</option>
                                </select>

                                <div class="form-group editrequestmodal">
                                    <label for="location">Location</label>
                                    <input id="location" type="text" name="location">
                                </div>
                                <div class="form-group editrequestmodal">
                                    <label for="expiry">Expires After</label>
                                    <input id="expiry" type="text" name="expiry">
                                </div>
                                <div class="form-group editrequestmodal">
                                    <label for="foodDescription">Food Description/ Requirement</label>
                                    <textarea id="foodDescription" name="foodDescription" rows="4" cols="50"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary editrequestmodal" id="editModalSubmit" type="button"
                            class="btn btn-primary">Save Data</button>
                    </div>

                </div>
            </div>
        </div>
        <nav class="mobile-nav">
            <a href="dashboard.php"><i class="fas fa-desktop" id="bloc-icon"></i></a>
            <a href="dashboard.php?myrequest=true"><i class="fas fa-table" id="bloc-icon"></i></a>
            <a href="request.php"><i class="fas fa-cogs" id="bloc-icon"></i></a>
            <a href="#"><i class="fas fa-info-circle" id="bloc-icon"></i></a>
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
        <script src="js/utils.js"></script>
        <script src="js/dashboardPage.js"></script>
        <script src="js/cards.js"></script>
</body>

</html>