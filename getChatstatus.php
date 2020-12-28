<?php

session_start();

require_once "config.php";
require_once "model/user.php";

if(isset($_SESSION['USER'])) 
{
    $sendto = $_SESSION['Sendto'];
    $sendfrom = $_SESSION['Sendfrom'];
    $status = user::CheckBlocklist($sendfrom, $sendto);
    $_SESSION['uiStatus'] = $status;
    echo $status;
}
?>