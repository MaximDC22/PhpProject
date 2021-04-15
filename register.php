<?php
if(!empty($_POST)) {
        $user = $_POST["user"];
        $password = $_POST["password"];

                $options = [
                    "cost" => 14
                ];
                $password = password_hash($password, PASSWORD_DEFAULT, $options);

                $conn = new PDO('mysql:host=localhost;dbname=cliptok', 'root', 'root');
                $query = $conn->prepare("insert into user (username, password) values (:user, :password)");
                $query->bindValue(":user", $user);
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
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

</body>
</html>