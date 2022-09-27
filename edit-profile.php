<?php

include('conn.php');

session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] == ""){
    header('Location: index.php');
}else {
    $user = $_SESSION['user'];
}

if(isset($_POST['updateprofile'])){
    $skills = $_POST['skills'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $about = $_POST['about'];
    $title = $_POST['title'];

    $query = "UPDATE `users` SET `email`='$email',`title`='$title',`skills`='$skills',`telephone`='$telephone',`about`='$about' WHERE `email` = '$email' ";

    $result = mysqli_query($sql, $query);

    if($result){
        echo "<script>alert('Record updated successfully')</script>";
        echo "<script>window.location.assign('profile.php')</script>";
    }else {
        echo "<script>alert('Something went wrong')</script>";
        echo "<script>window.location.assign('index.php')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - BiCrypto</title>
    <link rel="stylesheet" href="edit-profile.css">
</head>
<body>
    <div class="logout">
        <a href="logout.php"><img src="./assets/switch.png" alt="Logout icon"></a>
    </div>
    <?php 

        $checkUser = "SELECT * FROM `users` WHERE `email` = '$user'";
        $result = mysqli_query($sql, $checkUser);
        $counUser = mysqli_num_rows($result) > 0;
        if(!$counUser){
            echo "<script>alert('Please login first')</script>";
            echo "<script>window.location.assign('./')</script>";
        }

        if($counUser){
            while($row = mysqli_fetch_assoc($result)){

    ?>

    <div class="container">
            <div class="sidebar">
                <div class="user">
                    <img src="./assets/buffett.jpg" alt="user profile picture" class="img">
                    <h3><?php echo $row['fname'] . " " . $row['lname']; ?></h3>
                    <p><?php echo $row['title'];?></p>
                </div>
                
                <div class="skills">
                    <p class="title">Skills</p>
                    <p class="skill"><?php echo $row['skills'];?> </p>
                </div>

                <div class="action">
                    <center>
                        <a href="edit-profile.php" class="edit-btn">Edit Profile</a>
                    </center>
                </div>
            </div>

        <div class="page">
            <div class="header">
                <img src="./assets/bicrypto-logo.png" alt="LOGO">
            </div>
            <div class="page-inner">
                <h3>Edit Profile</h3>
                <form action="edit-profile.php" method="POST" class="form">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="<?php echo $row['title'];?>" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills</label>
                        <input type="text" id="skills" value="<?php echo $row['skills'];?>" name="skills">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="<?php echo $row['email'];?>" name="email">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Telephone</label>
                        <input type="text" id="telephone" value="<?php echo $row['telephone'];?>" name="telephone">
                    </div>
                    <div class="form-group">
                        <label for="telephone">About</label>
                        <textarea name="about" id="about" cols="30" rows="10"><?php echo $row['about'];?></textarea>
                    </div>

                    <center>
                        <button name="updateprofile" type="submit" class="btn" type="submit">UDPATE</button>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <?php 

            }
        }

    ?>
</body>
</html>