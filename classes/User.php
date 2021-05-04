<?php
include_once(__DIR__ . '/Db.php');
class User{
    protected $email;
    protected $fullname;
    protected $username;
    protected $password;

        


    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of fullname
     */ 
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set the value of fullname
     *
     * @return  self
     */ 
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function register(){
        //$conn = Db::getConnection();
        $username = $this->getUsername();
        $fullname = $this->getFullname();
        $email = $this->getEmail();
        $options = [
            'cost' => 14,
        ];
        $password = password_hash($this->getPassword(),PASSWORD_DEFAULT,$options);
        
        //MOMENTEEL NOG HARD-CODED
        $conn = new PDO('mysql:host=localhost;dbname=db_cliptok','root','root');

        $statement = $conn->prepare("insert into users (username,password,fullname,email) values (:username, :password, :fullname, :email)");
        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":fullname", $fullname);
        $statement->bindValue(":email", $email);
            //Execute query
        
            $result = $statement->execute(); 
            
            //Return the results fr
            return $result;
    }
    public function canLogin(){
        //MOMENTEEL NOG HARD-CODED
        $conn = new PDO('mysql:host=localhost;dbname=db_cliptok','root','root');

        $username = $this->getUsername();
        $password = $this->getPassword();
        $statement = $conn->prepare('select * from users where username = :username');
        $statement->bindValue(':username',$username);
        $statement->execute();
        $user = $statement->fetch();
        $hash = $user['password'];
        if(!$user){
            return false;
        }
        if(password_verify($password,$hash)){
            return true;
        }else{
            return false;
        }

    }

}