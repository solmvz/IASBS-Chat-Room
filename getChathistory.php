<?php
session_start();

require_once "config.php";
require_once "model/chat.php";

if(isset($_SESSION['USER'])) 
{
    $sendto = $_SESSION['Sendto'];
    $sendfrom = $_SESSION['Sendfrom'];
    $history = chat::LoadChatHistory($sendfrom, $sendto);
    echo json_encode($history);
}
?>