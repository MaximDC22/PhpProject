<?php
include_once(__DIR__ . '/Db.php');
class User
{
    protected $email;
    protected $fullname;
    protected $username;
    protected $password;
    protected $avatar;
    protected $description;




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
    /**
     * Get the value of avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function register()
    {

        $conn = Db::getConnection();
        $username = $this->getUsername();
        $fullname = $this->getFullname();
        $email = $this->getEmail();
        $options = [
            'cost' => 12,
        ];
        $password = password_hash($this->getPassword(), PASSWORD_DEFAULT, $options);

        $statement = $conn->prepare("insert into users (username,password,fullname,email) values (:username, :password, :fullname, :email)");
        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":fullname", $fullname);
        $statement->bindValue(":email", $email);
        //Execute query

        $result = $statement->execute();

        //Return the results fr


        //register ID to profile image
        $stmt = $conn->prepare("select * from users where username = :username and fullname = :fullname");
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':fullname', $fullname);
        $stmt->execute();
        $count = $stmt->rowCount();
        $amount = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($count > 0) {
            
            $userid = $amount['id'];
            $stmt = $conn->prepare('insert into avatars (userid,status) values (:userid, 1)');
            $stmt->bindValue(':userid', $userid);
            $stmt->execute();

            return $result;
        } else {
            echo 'sike';
        }
    }
    public function canLogin()
    {
        $conn = Db::getConnection();

        $username = $this->getUsername();
        $password = $this->getPassword();
        $statement = $conn->prepare('select * from users where username = :username');
        $statement->bindValue(':username', $username);
        $statement->execute();
        $user = $statement->fetch();
        $hash = $user['password'];
        if (!$user) {
            return false;
        }
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }
    public function uniqueCheck()
    {
        $conn = Db::getConnection();

        $username = $this->getUsername();
        $statement = $conn->prepare('select * from users where username = :username');
        $statement->bindValue(':username', $username);
        $statement->execute();
        $check = $statement->fetch();

        if (!empty($check)) {
            return false;
        } else {
            return true;
        }
    }
    public function avatar(){
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
                        
                        //is img uploaded?
                            if($resultImg['status'] == 0){
                                return('<img src="avatars/profile'.$id.'.jpg" class="avatar">');
                        //show standard
                            }else{
                                return('<img src="avatars/default.jpg">');
                            }
                            
                        
                

                
            }else{
                echo 'blip blop';
            }
    }
    public function findId()
    {
        $conn = Db::getConnection();
        $username = $this->getUsername();
        //get user ID for session
        $statement = $conn->prepare('select id from users where username = :username');
        $statement->bindValue(':username', $username);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        $id = $res['id'];
        return $id;
    }
    public function changeMail($newMail, $thisUser)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare('update users set email = :email where username = :username');
        $statement->bindValue(':email', $newMail);
        $statement->bindValue(':username', $thisUser);
        $statement->execute();
    }
    public function changeDesc($newDesc, $thisUser)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare('update users set description = :desc where username = :username');
        $statement->bindValue(':desc', $newDesc);
        $statement->bindValue(':username', $thisUser);
        $statement->execute();
    }
    public function showDesc($thisUser){
        $conn = Db::getConnection();
        $statement = $conn->prepare('select description from users where username = :username');
        $statement->bindValue(':username', $thisUser);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        return htmlspecialchars($res['description']);
    }
}
