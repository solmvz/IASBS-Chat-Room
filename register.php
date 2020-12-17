<?php
require "config.php";
require "model/user.php";
include $ShareFolderPath."header.html";
//include $ShareFolderPath."menu.html";

$Message = '';
$uiName_cv = "";
$uiFamily_cv = "";
$uiUsername_cv = "";
$uiPassword_cv = "";
$uiEmail_cv = "";

if(isset($_POST['uiRegister']))
{
    $uiName_cv = $_POST['uiName'];
    $uiFamily_cv = $_POST['uiFamily'];
    $uiUsername_cv = $_POST['uiUsername'];
    $uiPassword_cv = $_POST['uiPassword'];
    $uiEmail_cv = $_POST['uiEmail'];

    $validationMessage = validation();
    if($validationMessage == "") {
        $u = new user();
        $u->setName($_POST['uiName']);
        $u->setFamily($_POST['uiFamily']);
        $u->setUsername($_POST['uiUsername']);
        $u->setPassword($_POST['uiPassword']);
        $u->setEmail($_POST['uiEmail']);
        if($u->Save())
            $Message = 'You have successfully registered.';
        else
            $Message = 'The username already exists. Please use a different username.';
    }
    else
        $Message = $validationMessage;
}


include $ViewPath."register.html";

include $ShareFolderPath."footer.html";


function validation()
{
    $Message = "";
    if($_POST["uiName"] == "")
        $Message = 'Enter your name'."<br/>";
    if($_POST["uiFamily"] == "")
        $Message .= 'Enter your family'."<br/>";
    if($_POST["uiUsername"] == "")
        $Message .= 'Enter your username.'."<br/>";
    if($_POST["uiPassword"] == "")
        $Message .= 'Enter your password'."<br/>";
    if($_POST["uiEmail"] == "")
        $Message .= 'Enter your Email'."<br/>";

    if($_POST["uiPassword"] != $_POST["uiConfirmPassword"])
        $Message .= 'Password and confirmation password do not match.'."<br/>";

    return $Message;
}

?>