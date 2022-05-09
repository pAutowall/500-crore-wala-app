<?php
session_start();
include("connection.php");
$id=$_SESSION['id'];
// $query=mysqli_query($db_name,"SELECT * FROM users where $id") or die(mysqli_error());
$queryy = $con -> query("SELECT * FROM users where `users`.`id`='$id'");
 $row=mysqli_fetch_array($queryy);
 $_SESSION['name'] = $row['name'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
//   $query = "UPDATE users SET name = '$name',
//                   email = '$email', password = '$password'
//                   WHERE '$id'";
                $result = $con -> query("UPDATE users SET name = '$name', email = '$email', password = '$password' where `users`.`id`='$id'") or die(mysqli_error($db_name));
                ?>
                
                 <script type="text/javascript">
        alert("Update Successfull.");
        window.location = "profile.php";
        </script>
        <?php
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
    
    <h1>User Profile</h1>
<div class="profile-input-field">
        <h3>Please Fill-out All Fields</h3>
        <form method="post" action="#" >
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" style="width:20em;" placeholder="name" value="<?php echo $row['name']; ?>" required />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" style="width:20em;" placeholder="email" required value="<?php echo $row['email']; ?>" />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password" style="width:20em;" required placeholder="password" value="<?php echo $row['password']; ?>"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" style="width:20em; margin:0;"><br><br>
            <center>
             <a href="logout.php">Log out</a>
           </center>
          </div>
        </form>

        </div>


</body>

</html>