<?php
require_once "database.php";
class user
{
    public $name;
    public $family;
    private $username;
    private $password;
    private $email;

    function getName() { return $this->name; }
    function setName($name) { $this->name = $name; }

    function getFamily() { return $this->family; } 
    function setFamily($family) { $this->family = $family; }

    function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; } 

    function getPassword() { return $this->password; }

    function setPassword($password)
    {
        $this->password = md5($password);
    }

    function getEmail() { return $this->email; }
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

    private function getUserAsaText()
    {
        return $this->username.' '.$this->password.' '.$this->name.' '.$this->family.PHP_EOL;
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
        if(!$this->IsUsernameExist()) {
            $paramTypes = "sssss";
            $Parameters = array( $this->name, $this->family,
            $this->username, $this->password, $this->email);
            database::ExecuteQuery('AddUser', $paramTypes, $Parameters);
            return true;
        }
        return false;
    }
}
