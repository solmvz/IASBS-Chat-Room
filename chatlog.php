<?php

session_start();

date_default_timezone_set('Iran');

require "config.php";
require "model/user.php";
require "model/chat.php";

if(!isset($_SESSION['USER'])) 
{
    header('Location: index.php');
}
else
{    
    $u = unserialize($_SESSION['USER']);
    $utemp = $_SESSION['NFE'];
    $WelcomeMessage = 'Welcome @'.$u->getUsername().'!';

    $sendfrom = $u->getUsername();
    $_SESSION['Sendfrom'] = $sendfrom;
    $sendto = $_SESSION['Sendto'];

    $msg = new chat();
    $msg->setSendTo($sendto);
    $msg->setSendFrom($sendfrom);

    if (isset($_POST["uiSendmsg"])) 
    {
        $text = $_POST['uiMsg'];
        if ($text!="")
        {
            $msg->setText($text);

            $sent = date('H:i')." ".date("Y-m-d");
            $msg->setDate($sent);

            $msg->SendMsg();
            $text="";
        }
    }
    if (isset($_POST['mDelete']))
    {
        $messageid = $_POST['mId'];
        chat::DeleteMsg($messageid); 
    }
}

include $ShareFolderPath."header.html";
include $ShareFolderPath."chatroom.html";
include $ShareFolderPath."profile.html";
include $ShareFolderPath."userslist.html";

include $ViewPath."chatlog.html";

include $ShareFolderPath."footer.html";

?>
