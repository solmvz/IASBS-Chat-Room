<?php
abstract class person
{
    public $name;
    public $family;

    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function getFamily()
    {
        return $this->family;
    }

    function setFamily($family)
    {
        $this->family = $family;
    }
}

class user extends person
{
    private $username;
    private $password;
    private $email;

    function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password, $hashit=true)
    {
        if($hashit)
            $this->password = md5($password);
        else
            $this->password = $password;
    }
    
    function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    function checkUserPass()
    {
        // $myfile = fopen("users.txt", "r");
        // while (!feof($myfile)) {
        //     $temp = fgets($myfile);
        //     $userinfo = explode(" ",$temp);

        //     if($this->username == $userinfo[0] && $this->password == $userinfo[1]) {
        //         $this->name = $userinfo[2];
        //         $this->family = $userinfo[3];
        //         fclose($myfile);
        //         return true;
        //     }
        // }

        // fclose($myfile);
        // return false;
    }

    private function getUserAsaText()
    {
        // return $this->username.' '.$this->password.' '.$this->name.' '.$this->family.PHP_EOL;
    }

    private function IsUsernameExist()
    {
        $myfile = fopen("users.txt", "r");
        while (!feof($myfile)) {
            $temp = fgets($myfile);
            $userinfo = explode(" ",$temp);

            if($this->username == $userinfo[0]) {
                fclose($myfile);
                return true;
            }
        }
        fclose($myfile);
        return false;
    }

    function Save()
    {
        if(!$this->IsUsernameExist()) {
            $myfile = fopen("users.txt", "a");
            fwrite($myfile, $this->getUserAsaText());
            fclose($myfile);
            return true;
        }
        return false;
    }
}