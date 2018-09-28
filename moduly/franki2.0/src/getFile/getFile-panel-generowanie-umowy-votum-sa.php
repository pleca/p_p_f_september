<?php

//
//if(!isset($_SERVER['HTTP_REFERER'])){
//    session_start();
//    session_destroy();
//    header ( 'Location: https://'.$_SERVER ['HTTP_HOST'] );
//    die();
//}else{
//
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=panel-generowanie-umowy-votum-sa.mp4");
    readfile('/var/www/pliki/dodatkowe/panel-generowanie-umowy-votum-sa.mp4');
//}