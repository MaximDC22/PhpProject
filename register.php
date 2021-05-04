<?php
if(!empty($_POST)) {

    try{
        include_once(__DIR__ . "/classes/User.php");
        //make new user
        $user = new User();
        //initiate data into user class
        $user->setEmail($_POST['email']);
        $user->setFullname($_POST['fullname']);
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $user->register();
        
    }catch(Throwable $error){
        //if error in class, caught here
        $error = $error->getMessage();

    }
    // start a session and redirect the user to index.php
    session_start();
    $_SESSION['user'] = $user->getEmail();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="text">Sign up to Continue</div>
        <div class="page">
            <div class="title">
                <img src="images/logoBlack.svg">
            </div>
            
            <form action="" method="post">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="fullname" placeholder="Full name">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="sign">Sign up</button>


                <div class="signup">
                    <p>Already have an account? <a href="index.php">Log in</a></p>
                </div>

            </form>
</body>

</html>