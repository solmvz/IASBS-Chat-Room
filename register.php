<?php
require "config.php";
require "model/user.php";
include $ShareFolderPath."header.html";

$Message = "";
$uiName_cv = "";
$uiFamily_cv = "";
$uiEmail_cv = "";
$uiUsername_cv = "";

if(isset($_POST['uiRegister']))
{
    $uiName_cv = $_POST['uiName'];
    $uiFamily_cv = $_POST['uiFamily'];
    $uiEmail_cv = $_POST['uiUsername'];
    $uiUsername_cv = $_POST['uiUsername'];

    $validationMessage = validation();
    if($validationMessage == "") 
    {
        $u = new user();
        $u->setName($_POST['uiName']);
        $u->setFamily($_POST['uiFamily']);
        $u->setEmail($_POST['uiEmail']);
        $u->setUsername($_POST['uiUsername']);
        $u->setPassword($_POST['uiPassword']);
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
    if($_POST["uiUsername"] == "")
        // fill
    if($_POST["uiPassword"] == "")
        // fill

    return $Message;
}
?>