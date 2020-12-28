<?php
require_once "database.php";

class user
{
    public $name;
    public $family;
    private $username;
    private $password;
    private $email;

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function getFamily() { return $this->family; } 
    public function setFamily($family) { $this->family = $family; }

    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; } 

    public function getPassword() { return $this->password; }
    public function setPassword($password){ $this->password = md5($password); }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; } 

    public function checkUserPass()
    {
        $paramTypes = "ss";
        $Parameters = array($this->username,$this->password);
        $result = database::ExecuteQuery('CheckUserPass', $paramTypes, $Parameters);

        if(mysqli_num_rows($result) > 0)
        {
            $row = $result->fetch_array();
            $this->setName($row["name"]);
            $this->setFamily($row["family"]);
            return true;
        }
        return false;
    }

    private function IsUsernameExist()
    {
        $paramTypes = "s";
        $Parameters = array($this->username);
        $result = database::ExecuteQuery('IsUsernameExist', $paramTypes, $Parameters);

        if(mysqli_num_rows($result) > 0)
              return true;
        return false;
    }

    function Save()
    {
        if(!$this->IsUsernameExist()) 
        {
            $paramTypes = "sssss";
            $Parameters = array( $this->name, $this->family,
            $this->username, $this->password, $this->email);
            database::ExecuteQuery('AddUser', $paramTypes, $Parameters);
            return true;
        }
        return false;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public static function GetAllUsers()
    {
        $result = database::ExecuteQuery('GetAllUsers');
        $usersList = array();
        $i = 0;
        while ($row = $result->fetch_array())
        {
            $tempUser = new user();
            $tempUser->setUsername($row['username']);
            $tempUser->setName($row['name']);
            $tempUser->setFamily($row['family']);
            $usersList[$i++] = $tempUser->jsonSerialize();
        }
        return $usersList;
    }

    public function GetNameFamily()
    {
        $paramTypes = "ss";
        $Parameters = array($this->username,$this->password);
        $result = database::ExecuteQuery('GetNameFamily', $paramTypes, $Parameters);
        $row = $result->fetch_array();
        $temp = array($row['name'], $row['family'], $row['email']);
        return $temp;
    }

    public static function BlockUser($user1, $user2){
        $paramTypes = "ss";
        $Parameters = array($user1, $user2);
        database::ExecuteQuery('AddBlocklist', $paramTypes, $Parameters);
    }

    public static function UnblockUser($user1, $user2){
        $paramTypes = "ss";
        $Parameters = array($user1, $user2);
        database::ExecuteQuery('removeBlocklist', $paramTypes, $Parameters);
    }

    public static function CheckBlocklist($user1, $user2){
        $paramTypes = "ss";
        $Parameters = array($user1, $user2);
        $result = database::ExecuteQuery('CheckBlocklist', $paramTypes, $Parameters);
        if(mysqli_num_rows($result) > 0){
            $row = $result->fetch_array();
            $status = $row['status'];
            return $status;
        }
        else
        {
            return 0;
        }
    }
}
