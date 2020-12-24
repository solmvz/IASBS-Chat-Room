<?php
session_start();
require "model/user.php";

if(!isset($_SESSION['USER'])) 
{
    header('Location: index.php');
}
else
{
    $u = unserialize($_SESSION['USER']);
    $utemp = $_SESSION['NFE'];
    $WelcomeMessage = 'Welcome @'.$u->getUsername().'!';

}

require "config.php";
include $ShareFolderPath."header.html";
include $ShareFolderPath."chatroom.html";
include $ShareFolderPath."profile.html";
include $ViewPath."userslist.html";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // collect value of input field
    $sendto = $_POST['uiSendto'];
    if (!empty($sendto)) {
        $_SESSION['Sendto'] = $sendto;
        header('Location: chatlog.php');
        //echo $name;
    }
}

include $ShareFolderPath."footer.html";