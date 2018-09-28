<?php
/**
 * Created by PhpStorm.
 * User: szczepaniak
 * Date: 14.09.2018
 * Time: 13:52
 */

if(!isset($_SERVER['HTTP_REFERER'])){
    session_start();
    session_destroy();
    header ( 'Location: https://'.$_SERVER ['HTTP_HOST'] );
    die();
}else{

    header('Content-Description: attachment');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=PelnomocnictwoKAiRP.pdf");
    readfile('/var/www/pliki/!dokumenty/dodatkowe/KAiRP.pdf');

}