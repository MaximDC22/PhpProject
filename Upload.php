<?php include_once('Post.php');?>

<?php

    session_start();
    
    if(!empty($_POST)){ 
       

        try{ 
            
            $fileTmpName = $_FILES["fileToUpload"]["tmp_name"]; 
            if($_FILES["fileToUpload"]["type"] != "image/png"){
                $fileName = $_SESSION['user']."post".date("YmdHis").".jpeg";
            } else {
                $fileName = $_SESSION['user']."post".date("YmdHis").".png";
            }

            $post = new Post();

            $post->setUserId($_SESSION['user']);
            
            
            
            if($_FILES['fileToUpload']['name'] == ""){  
                $fileName = "";
            }

            $post->setImage($fileName); 
            $post->setDescription($_POST['description']);

           $post->submitPost(); 
    

            $uploads_directory = 'uploads/'; 
            move_uploaded_file($fileTmpName, "uploads/".$fileName); //fileToUpload -> /uploads -> fileName
            
              if($_FILES["fileToUpload"]["type"] != "image/png"){
                $image= imagecreatefromjpeg("uploads/".$fileName); 
            } else {
                $image= imagecreatefrompng("uploads/".$fileName); 
            }

           imagejpeg($image, "uploads/".$fileName, 60 );
        


        }catch (\throwable $th){
           $error = $th->getMessage();          
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Post.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Upload post</title>
</head>
<body>

<!-- /*
formulier stuurt gegevens naar een bestand met de naam upload.php
Het specificeert welk inhoudstype moet worden gebruikt bij verzenden van formulier */ -->

<form id="searchbar">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">Search</i></button>
    </form>

    
<div class="container">
    <div class="page">

    <?php if(isset($error)): ?>
    <div class="alert"><strong>Warning!</strong> <?php echo $error?> </div>
    <?php endif;?>

<div class="drag-area">
    <form action="Upload.php" method="post" enctype="multipart/form-data"> 
    
    <h3>Select image to upload:</h3>
    <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/png, image/jpeg, image/jpg">
    </div> 

    <input type="text"  placeholder="Your description.." name="description" id="description">
    <br>
    <input type="submit" value="Upload image" name="submit">
    <input type="reset" value="Reset" name="reset">
    

</form>
</div>
</div>
<div class="post">
<div class="image"><img src="images/placeholder.jpg" alt="Post Picture"></div>
<div class="description" > <p> Hier komt de beschrijving van de post </p> </div>
</div>

</body>
</html>