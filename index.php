<?php

$username ="";
$password = "";

if(!empty($_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $conn = new PDO('mysql:host=localhost;dbname=cliptok', 'root', 'root');
    $stmnt = $conn->prepare("select password from user where username = ':username'");
    $stmnt->bindValue(":username", $username);
    $stmnt->execute();
    $result = $stmnt->fetchAll();
    return $result;
    


}
var_dump($result);


//if(checkLogin($verify)){
  //  session_start();
    // $_SESSION["username"]=$username;
    //header("Location: pagina2.php");
    
//} else {
//    $error = true;
//}


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
    
    <form action="" method ="POST" id="loginform">
    <label for="username"> Username </label>
    <input type="text" id="username" name="username">
    <label for="password"> Password </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="log in">
    </form>
    <a href="http://localhost/login/register.php">register</a>
        
    
</body>
</html>