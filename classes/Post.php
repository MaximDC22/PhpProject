<?php
include_once(__DIR__ . '/Db.php');
  class Post{
      
      private $userId;
      private $image;
      private $description;



  //Set the value of a given property
  public function setUserId($userId){ //$userId is een parameter
    $this->userId = $userId;
  }

  //Getter allows you to retrieve or get a given property   
  public function getUserId(){
    return $this->userId; 
  }


  //Images
  public function setImage($image){ //This is the path you are sending to the database
  //Check the image
  self::checkImage($image); 
  //If there is no error, insert the image in the variable
  $this->image = "uploads/" .$image; 
  }

  public function getImage(){
      return $this->image; 

  }


  //A private function because constant, property or method can only be accessed from within the class that defines it.
  //Check if the image field is empty
  private function checkImage($image){
      //if no image is uploaded
      if($image == ""){
          throw new Exception("You need to upload an image!");
      }
  }
  


  //Description
  public function setDescription($description){
      //Check the description
      self::checkDescription($description);
      //If there is no error, insert the description in the variable
      $this->description = $description;
  }

  public function getDescription(){
      return $this->description;
  }

  //A private function because constant, property or method can only be accessed from within the class that defines it.
  //Check if the description field is empty
  private function checkDescription($description){
      //If description field is empty
      if($description == ""){
          throw new Exception("Description field cannot be empty.");
      }
  }



  //Submit post
  public function submitPost(){
      //connection with database
      $conn = Db::getConnection();
      
      //Put the right info in the right place (in database posts)
      $query = $conn->prepare("INSERT INTO post (user_id, description, image) VALUES (:userId, :description, :image)");   


      //Binds the values to the correct parameters
      $query->bindValue(":userId", $this->userId);
      $query->bindValue(":description", $this->description);
      $query->bindValue(":image", $this->image);

      $result = $query->execute();
      return $result;
  }
  }

