<?php
if (isset($_POST['submit'])){
    //set file variable to name of file that is submit
    $file = $_FILES['file'];
    //get the necessary variables of the submit file
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    //explode on '.' to check for extensions
    $fileExt = explode('.',$fileName);
    //set final value of array from explode to lowercase to be sure
    $fileActualExt = strtolower( end($fileExt));
    //set allowed ext
    $allowed = array('jpg','jpeg','png','pdf');

    if(in_array($fileActualExt, $allowed)){
        //check error
        if($fileError === 0){
            //check size
            if($fileSize < 80000){
                //give unique id based on ms
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                //set new destination
                $fileDestination = 'avatars/'.$fileNameNew;
                //change tmp destination to new destination
                move_uploaded_file($fileTmpName,$fileDestination);
                header('Location: account.php?uploadSucces');
            }else{
                echo 'your file is too big';
            }
        }else{
            echo 'there was an error uploading the file';
        }
    }else{
        echo 'wrong filetype';
    }
}