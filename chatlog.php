<?php

require "config.php";
require "model/user.php";
require "model/chat.php";
include $ShareFolderPath."header.html";
include $ViewPath."chatlog.html";

session_start();
date_default_timezone_set('Iran');

if(isset($_SESSION['USER']))
{    
    $u = unserialize($_SESSION['USER']);
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
           // echo $text;
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




?>


