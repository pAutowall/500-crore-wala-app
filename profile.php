<?php
session_start();
include("connection.php");
$id=$_SESSION['id'];

$select = mysqli_query($con, "SELECT * FROM `users` WHERE id = '$id'") or die('query failed');
if(mysqli_num_rows($select) > 0){
   $fetch = mysqli_fetch_assoc($select);
}
$_SESSION['name'] = $fetch['name'];
if(isset($_POST['update_profile'])){

  $update_name = mysqli_real_escape_string($con, $_POST['update_name']);
  $update_email = mysqli_real_escape_string($con, $_POST['update_email']);

  mysqli_query($con, "UPDATE `users` SET name = '$update_name', email = '$update_email' WHERE id = '$id'") or die('query failed');
  

  $old_pass = $_POST['old_pass'];
  $update_pass = mysqli_real_escape_string($con, $_POST['update_pass']);
  $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
  $confirm_pass = mysqli_real_escape_string($con, $_POST['confirm_pass']);

  if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
     if($update_pass != $old_pass){
        $message[] = 'old password not matched!';
     }elseif($new_pass != $confirm_pass){
        $message[] = 'confirm password not matched!';
     }else{
        mysqli_query($con, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$id'") or die('query failed');
        $message[] = 'Password updated successfully!';
     }
  }

  $update_image = $_FILES['update_image']['name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_folder = 'uploaded_img/'.$update_image;

  if(!empty($update_image)){
     if($update_image_size > 2000000){
        $message[] = 'image is too large';
     }else{
        $image_update_query = mysqli_query($con, "UPDATE `users` SET pfp = '$update_image' WHERE id = '$id'") or die('query failed');
        if($image_update_query){
           move_uploaded_file($update_image_tmp_name, $update_image_folder);
        }
        $message[] = 'Image updated succssfully!';
     }
  }
  
}
// $query=mysqli_query($db_name,"SELECT * FROM users where $id") or die(mysqli_error());
// $queryy = $con -> query("SELECT * FROM users where `users`.`id`='$id'");
//  $row=mysqli_fetch_array($queryy);
//  $_SESSION['name'] = $row['name'];

// if(isset($_POST['submit'])){
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//   $query = "UPDATE users SET name = '$name',
//                   email = '$email', password = '$password'
//                   WHERE '$id'";
                // $result = $con -> query("UPDATE users SET name = '$name', email = '$email', password = '$password' where `users`.`id`='$id'") or die(mysqli_error($db_name));
                // ?>




<?php
             
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/my-login.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="js/cards.js" defer></script>
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
    <div class="wrapper">
    <!--sidebar start-->
    <section>
        <div class="sidebar">
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
                <!-- <img src="img/FPvkGPgXsAogrsG.jpg" class="profile_image" alt=""> -->
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
    </section>





    <div id="box1" class="container-1">

    <div class="update-profile">

   <?php
      $select = mysqli_query($con, "SELECT * FROM `users` WHERE id = '$id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['pfp'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['pfp'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <!-- <input type="submit" value="update profile" name="update_profile" class="btn"> -->
      <input type="submit" value="update profile" name="update_profile" class="delete-btn"></a>
   </form>

</div>


        <!-- <h1>User Profile</h1>
        <div class="profile-input-field">

            <form method="post" action="#">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" style="width:20em;" placeholder="name"
                        value="<?php echo $row['name']; ?>" required />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" style="width:20em;" placeholder="email"
                        required value="<?php echo $row['email']; ?>" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" style="width:20em;" required
                        placeholder="password" value="<?php echo $row['password']; ?>"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" style="width:20em; margin:0;"><br><br>
                    <center>
                        <a href="logout.php">Log out</a>
                    </center>
                </div>
            </form>

        </div> -->

    </div>
    <nav class="mobile-nav">
         <a href="dashboard.php"><i class="fas fa-desktop" id="bloc-icon"></i></a>
         <a href="dashboard.php?myrequest=true"><i class="fas fa-table"  id="bloc-icon"></i></a>
         <a href="request.php"><i class="fas fa-cogs"  id="bloc-icon"></i></a>
         <a href="#"><i class="fas fa-info-circle"  id="bloc-icon"></i></a>
         <a href="profile.php"><i class="fas fa-sliders-h"  id="bloc-icon"></i></a>
    </nav>

</body>

</html>