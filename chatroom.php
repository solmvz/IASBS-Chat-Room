<?php
ob_start();
session_start();
require_once "config.php";
require_once "model/user.php";

if(!isset($_SESSION['USER'])) 
{
    header('Location: index.php');
}
else
{
    $u = unserialize($_SESSION['USER']);
    $utemp = $_SESSION['NFE'];
    $WelcomeMessage = 'Welcome @'.$u->getUsername().'!';

    include $ShareFolderPath."header.html";
    include $ShareFolderPath."chatroom.html";
    include $ShareFolderPath."profile.html";
    include $ShareFolderPath."userslist.html";
    include $ShareFolderPath."chat.html";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $sendto = $_POST['uiSendto'];
        
        if (!empty($sendto)) 
        {
            $_SESSION['Sendto'] = $sendto;
            header('Location: chatlog.php');
            exit;
        }
    }
    include $ShareFolderPath."footer.html";
}
?>