<?php
if(!empty($_POST)) {

    try{
        include_once(__DIR__ . "/classes/User.php");
        include_once(__DIR__ . "/classes/Db.php");
        
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
    
    session_start();
    $_SESSION['user'] = $user->getUsername();
    $_SESSION['id'] = $user->findId();
    header("Location: account.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Cliptok |Register</title>
</head>
<body>
<div class="main">
<div class="container">
        <div class="text">Sign up to Continue</div>
        <div class="page">
            <div class="title">
                <img src="images/logoBlack.svg">
            </div>
            
            <form action="" id="registerForm" method="post">
                <input type="text" id="inputEmail" name="email" placeholder="Email" required>
                <input type="text" name="fullname" placeholder="Full name" required>
                <label for="inputUsername" id="labelUsername"></label>
                <input type="text" id="inputUsername" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="sign">Sign up</button>


                <div class="signup">
                    <p>Already have an account? <a href="index.php">Log in</a></p>
                </div>

            </form>
            <script src="app.js"></script>
            </div>
</body>

</html>