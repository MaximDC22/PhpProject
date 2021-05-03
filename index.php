<?php

//var_dump($_POST);
$error = false;

function checkLogin($username,$password){
    if( $username === "manpersoon" && $password === "debouwer" ){
    return true;
    }else{
        return false;
    }
}

if(!empty($_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];
}

if(checkLogin($username,$password)){
    session_start();
    $_SESSION["username"]=$username;
    header("Location: pagina2.php");
    
} else {
    $error = true;
}
//var_dump(checkLogin($username,$password));
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
        <div class="text">Log in to Continue</div>
        <div class="page">
            <div class="title">
            <img src="images/logoBlack.svg">
               
            </div>
    <?php if($error == true): ?>

        
        <h3>Login is wrong </h3>
        

    <?php endif; ?>
    <form>
                <input type="text" placeholder="Username">
                <input type="password" placeholder="Password">
                <button>Log in</button>

                <div class="login">
                    <p>Don't have an account? <a href="register.php">Sign up</a></p>
                </div>

            </form>
        <?php if(isset($_SESSION["username"])):?>
            <h3>welcome to the website you rapscallion!</h3>
            <a href="logout.php">click here to log out matey</a>
        <?php endif?>
</body>
</html>