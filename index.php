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

<nav role="navigation">
  <div id="menuToggle">
    <!--
    A fake / hidden checkbox is used as click reciever,
    so you can use the :checked selector on it.
    -->
    <input type="checkbox" />
    
    <!--
    Some spans to act as a hamburger.
    
    They are acting like a real hamburger,
    not that McDonalds stuff.
    -->
    <span></span>
    <span></span>
    <span></span>
    
    <!--
    Too bad the menu has to be inside of the button
    but hey, it's pure CSS magic.
    -->
    <ul id="menu">
      <a href="account.php"><li><?php echo htmlspecialchars(($_SESSION['username']));?></li></a>

      <a href="logout.php"><li>Logout</li></a>
      
    </ul>
  </div>
</nav>
<form id="searchbar">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">Search</i></button>
    </form>
    

<div class="post">

<div class="image"><img src="images/placeholder.jpg" alt="Post Picture"></div>


<div class="description" > <p> Hier komt de beschrijving van de post </p> </div>
    

</div>

</body>
</html>