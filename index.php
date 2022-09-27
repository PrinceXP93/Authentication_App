<?php 
$msg = "";
include('conn.php');
if(isset($_POST['Login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // validate form

    if($email == "" || $password == ""){
        $msg = "<p style='text-align: center; color: red'>Invalid parameters</p>";
        header('Location: /');
    }


    // check if user exist in the database
    $checkUser = "SELECT * FROM `users` WHERE `username` = '$email'";
    $result = mysqli_query($sql, $checkUser);
    $counUser = mysqli_num_rows($result) > 0;
    if(!$counUser){
        $msg = "<p style='text-align: center; color: red'>Invalid email address</p>";
    }

    // if the user does exist
    if($counUser){
        while($row = mysqli_fetch_assoc($result)){
            $hash = $row['password'];


            if(password_verify($password, $hash)){
                session_start();
                $_SESSION['user'] = $email;

                header('Location: profile.php');
            }else {
                $msg = "<p style='text-align: center; color: red'>Invalid login credentials</p>";
            }
        }
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" referrerpolicy="no-referrer" />
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <img src="./assets/bicrypto-logo.png" alt="Bi Crypto Logo" class="logo">
            
            <div class="form-container">
                <h3>LOGIN HERE</h3>
                <?php echo $msg;?>
                <form action="index.php" class="form" method="POST">
                    <form action="" class="form">
                        <input type="text" require name="email" placeholder="Email address">
                        <input type="password" require name="password" placeholder="Password">
                        <a href="#">forgot password</a>
                        <button type="submit" name="Login">LOGIN &nbsp; <span class="fa fa-paper-plane"></span></button>
                </form>
                <p>Don't have an account yet? <a href="signup.php">Create an account here</a></p>
            </div>
        </div>
    </div>
</body>
</html>