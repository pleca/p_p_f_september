<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    session_start();
    session_destroy();
    header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
    die();
}else{
    require_once('klasa_Filmy.js');
    require_once('filmyObslugaZdarzen.js');

}