<?php

require "config.php";
require "model/user.php";
include $ShareFolderPath."header.html";
include $ViewPath."chatlog.html";
//require $ViewPath."chatlog.html";
global $counter;
$counter=1;

session_start();

$sendto = $_SESSION['Sendto'];
echo "Sending Message to ".$sendto;

if(isset($_SESSION['name'])){
    $u = unserialize($_SESSION['USER']);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $text = $_POST['uiMsg'];
        $chatlog = 'userlog/'.$u->getUsername().'.html';
        $fp = fopen($chatlog, 'a');
        if ($text!=""){
            //$textmsg = $u->getUsername.date("h:i:sa").
            fwrite($fp, "<div id='m".$counter."'>(".date("g:i A").") <b>".$_SESSION['name'].
            "</b>: ".stripslashes(htmlspecialchars($text)));
            $counter += 1;
        }
        fclose($fp);
    }

    if(file_exists('userlog/'.$u->getUsername().'.html') && filesize('userlog/'.$u->getUsername().'.html') > 0){
        $handle = fopen('userlog/'.$u->getUsername().'.html', "r");
        $contents = fread($handle, filesize('userlog/'.$u->getUsername().'.html'));
        fclose($handle);
        echo $contents;
    }
}




?>


