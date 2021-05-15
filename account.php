<?php
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/avatarsubmit.php');
$error = false;
session_start();
if(!isset($_SESSION['username'])){
    header('location: login.php');
}
if(!empty($_POST)){
    
$conn = Db::getConnection();
$statement = $conn->prepare('select password from users where username = :username');
$statement->bindValue(':username',$_SESSION['username']);
$statement->execute();
$res = $statement->fetch(PDO::FETCH_ASSOC);
    $passwordHash = $res['password'];
    
    if(password_verify($_POST['password'],$passwordHash)){
    $u= new User();
    $u->changeMail($_POST['email'],$_SESSION['username']);
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
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="account" >
    <h1>ACCOUNT here</h1>
        </div>
    <div class="page">
        <div class="page">
            <h1>Edit account:</h1>
            <h2><?php echo htmlspecialchars(($_SESSION['username'])); ?></h2>
            <div>
            <?php 
            include_once(__DIR__ . '/classes/Db.php');
            $conn = Db::getConnection();
                $statement = $conn->prepare('SELECT * FROM users where username = :username');
                $statement->bindValue(':username',$_SESSION['username']);
                $result = $statement->execute();
                $count = $statement->rowCount();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                if($count>0){
                    //while there are still users in array result
                    
                        //set id to id from stmtnt
                        $id = $user['id'];
                        //check if user already uploaded his own image
                        $stmt = $conn->prepare( "select * from avatars where userid= :uid");
                        $stmt->bindValue(':uid',$id);
                        $stmt->execute();
                        $resultImg = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        
                        
                            //what to show in browser:
                                echo'<div>';
                                //is img uploaded?
                                    if($resultImg['status'] == 0){
                                        echo '<img src="avatars/profile'.$id.'.jpg" height="200px">';
                                //show standard
                                    }else{
                                        echo '<img src="avatars/default.jpg">';
                                    }
                                    echo $row['username'];
                                echo'</div>';
                        

                        
                    }else{
                        echo 'blip blop';
                    }
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
                <?php if(!$error): ?>
                <label for="password">Password required to submit changes</label>
                <?php else: ?>
                    <label for="password" style = 'color:red' >Password incorrect</label>
                <?php endif ?>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="btnSubmit" id="btnSubmit">Confirm</button>

                <div class="login">
                    <p>Change details later?<a href="index.php">Skip</a></p>
                </div>

            </form>
            </div>
</body>

</html>