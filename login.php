<?php


$error = false;



if (!empty($_POST)) {
    
    try {
        include_once(__DIR__ . '/classes/User.php');
        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $user->canLogin();
    } catch (Throwable $error) {
        //if error in class, caught here
        $error = $error->getMessage();
    }
        if($user->canLogin()){
            //LOG IN
            session_start();
            
            $id = $user->findId();
            $_SESSION["username"]=$_POST['username'];
            $_SESSION['id']=$id;
            header("location: index.php");
        }else{
            $error = true;
        }

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
    <title>Cliptok |Login</title>
</head>

<body>
    <div class="main">
    <div class="container">
        <div class="text">Log in to Continue</div>
        <div class="page">
            <div class="title">
                <img src="images/logoBlack.svg">

            </div>

            <form action="#" method="POST">
            <?php if($error): ?>
                <label for="username" style="color:red">Login is incorrect</label>
            <?php endif; ?>
                <input type="text" id="username" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="btnSubmit" id="btnSubmit">Log in</button>

                <div class="login">
                    <p>Don't have an account? <a href="register.php">Sign up</a></p>
                </div>

            </form>
            </div>
</body>

</html>