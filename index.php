<?php
session_start();
unset($_SESSION['USER']);
unset($_SESSION['NFE']); //name family email in profile

require "config.php";
require "model/user.php";
include $ShareFolderPath."header.html";

$Message = '';
if(isset($_POST['uiLogin']))
{
    $u = new user();
    $u->setUsername($_POST['uiUsername']);
    $u->setPassword($_POST['uiPassword']);

    if($u->checkUserPass())
    {
        $_SESSION['USER'] = serialize($u);
        $_SESSION['NFE'] = $u->GetNameFamily();
        header('Location: chatroom.php');
    }
    $Message = 'Invalid username or password.';
}

include $ViewPath."login.html";
include $ShareFolderPath."footer.html";
?>