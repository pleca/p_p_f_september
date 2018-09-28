<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$file = '/var/www/pliki/!druki_pliki/'.$_GET['id'];

$nazwa_tmp = explode('.',$_GET['id']);

if(end($nazwa_tmp) != 'pdf'){
    header("Content-type: image/jpeg");
}else{
    header("Content-type: application/pdf");
}

ob_clean();
readfile($file);