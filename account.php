<?php
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/avatarsubmit.php');
session_start();
$error = false;
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
//create user
$u = new User();
//change mail verfiy by password
if (!empty($_POST['email'])) {

    $conn = Db::getConnection();
    $statement = $conn->prepare('select password from users where username = :username');
    $statement->bindValue(':username', $_SESSION['username']);
    $statement->execute();
    $res = $statement->fetch(PDO::FETCH_ASSOC);
    $passwordHash = $res['password'];

    if (password_verify($_POST['password'], $passwordHash)) {

        $u->changeMail($_POST['email'], $_SESSION['username']);
    } else {
        $error = true;
    }
}
//update desc
if (!empty($_POST['desc'])) {
    $u->changeDesc($_POST['desc'], $_SESSION['username']);
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
    <title>Account</title>
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
<div class="main">
    <div class="container">
        
        <div class="page">
            <div class="page">
                <h1>Edit account:</h1>
                <h2><?php echo htmlspecialchars(($_SESSION['username'])); ?></h2>
                <h4 class="desc">
                <?php echo $u->showDesc($_SESSION['username']); ?>
                </h4>
                <div class="profilePic">
                    <?php
                    echo ($u->avatar());
                    ?>
                </div>
                <label for="imageUpload">Change profile picture here:</label>
            </div>

            <div id="imageUpload">
                <form action="avatarsubmit.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file" id="file" accept="image/png, image/jpeg, image/jpg">
                    <button type="submit" name="submit">Upload</button>
                </form>
            </div>
            <form action="#" method="POST">
                <input type="text" name="desc" placeholder='description'>
                <button type="submit">Update</button>
            </form>
            <form action="#" method="POST">
                <label for="email">Change e-mail</label>

                <input type="text" id="email" name="email" placeholder="new mail">
                <?php if (!$error) : ?>
                    <label for="password">Password required to change email</label>
                <?php else : ?>
                    <label for="password" style='color:red'>Password incorrect</label>
                <?php endif ?>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="btnSubmit" id="btnSubmit">Confirm</button>

                <div class="login">
                    <p>Change details later?<a href="index.php">Skip</a></p>
                </div>

            </form>
        </div>
        </div>
</body>

</html>