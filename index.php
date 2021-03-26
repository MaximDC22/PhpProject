<?php

var_dump($_POST);
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
var_dump(checkLogin($username,$password));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>test login 1</h1>
    <?php if($error == true): ?>

        
        <h3>Login is wrong </h3>
        

    <?php endif; ?>
    <form action="#" method ="post" id="loginform">
    <label for="username"> Username </label>
    <input type="text" id="username" name="username">
    <label for="password"> Password </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="log in">
    </form>
        <?php if(isset($_SESSION["username"])):?>
            <h3>welcome to the website you rapscallion!</h3>
            <a href="logout.php">click here to log out matey</a>
        <?php endif?>
</body>
</html>