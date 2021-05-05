<?php
session_start();
 if(!isset($_SESSION['username'])){
     header('location: login.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>ClipTok | Home</title>
</head>
<body>


<form id="searchbar">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">Search</i></button>
    </form>
    
<a href="logout.php" class = "logout">Click here to log out</a>
<div class="post">

<div class="image"><img src="images/placeholder.jpg" alt="Post Picture"></div>


<div class="description" > <p> Hier komt de beschrijving van de post </p> </div>
    

</div>

</body>
</html>