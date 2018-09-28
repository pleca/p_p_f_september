<?php

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$file = '/var/www/pliki/!druki/'.$_GET['id'].'/'.$_GET['nazwa'];

$nazwa_tmp = explode('.',$_GET['nazwa']);

if(end($nazwa_tmp) != 'pdf'){
    header("Content-type: image/jpeg");
}else{
    header("Content-type: application/pdf");

    if(isMobile()){
    header("Content-Disposition:attachment;filename=".$_GET['nazwa'].".pdf");
    }
{
    
}
    
}
ob_clean();
#echo file_get_contents($file);
readfile($file);
