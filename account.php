<?php
include_once(__DIR__ . '/classes/User.php');
session_start();
if(!isset($_SESSION['username'])){
    header('location: login.php');
}
    var_dump($_SESSION['username']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="page">
            <h1>Edit account:</h1>
            <h2><?php echo htmlspecialchars(($_SESSION['username'])); ?></h2>
            <label for="avatar">Change profile picture here:</label>
            <div id="avatar" class="title">
                <img src="images/logoBlack.svg">
                
            </div>
            <div id="imageUpload">
            <form action="Avatarsubmit.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" id="file" accept="image/png, image/jpeg, image/jpg">
            <button type="submit" name="submit">Upload</button>
            </form>
            </div>
            <form action="#" method="POST">
                <label for="email">Change e-mail</label>
                <input type="text" id="email" name="email" placeholder="email">
                <label for="password">Password required to submit changes</label>
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="btnSubmit" id="btnSubmit">Log in</button>

                <div class="login">
                    <p>Change details later?<a href="index.php">Skip</a></p>
                </div>

            </form>

</body>

</html>