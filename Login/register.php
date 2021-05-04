
<?php


if(!empty($_POST)) {
        $user = $_POST["username"];
        $password = $_POST["password"];

                $options = [
                    "cost" => 14
                ];
                $password = password_hash($password, PASSWORD_DEFAULT, $options);

               
                $query = $conn->prepare("insert into users (username, password) values (:username, :password)");
                $query->bindValue(":username", $user);
                $query->bindValue(":password", $password);
                $query->execute();


                
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
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST" >
    <input type="text" name="user" placeholder="username">
    <input type="password" name="password" placeholder="*">
    <input type="submit" >
    </form>
</body>
</html>