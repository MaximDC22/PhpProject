<?php
include_once(__DIR__ . '/Db.php');
class User
{
    protected $email;
    protected $fullname;
    protected $username;
    protected $password;
    protected $avatar;




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
            var_dump($amount);
            $userid = $amount['id'];
            $stmt = $conn->prepare('insert into avatars (userid,status) values (:userid, 1)');
            $stmt->bindValue(':userid', $userid);
            $stmt->execute();
            // start a session and redirect the user to index.php
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
}
