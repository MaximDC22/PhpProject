<?php
if(!empty($_POST)) {



                $options = [
                    "cost" => 14
                ];

                $conn = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
                $username = $_POST["username"];
                $password = $_POST["password"];
                $fname = $_POST["fullname"];
                $password = password_hash($password, PASSWORD_DEFAULT, $options);


                $statement = $conn->prepare("INSERT into users (username, password,fname) values (:username, :password, :fname)");
                $statement->bindValue(":username", $username);
                $statement->bindValue(":password", $password);
                $statement->bindValue(":fname", $fname);

        //Execute query
        $result = $statement->execute(); 

        //Return the results from the query
        return $result;

                
        }
if(!empty($_POST)){
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
                    <p>Already have an account? <a href="login.php">Log in</a></p>
                </div>

            </form>
</body>
</html>