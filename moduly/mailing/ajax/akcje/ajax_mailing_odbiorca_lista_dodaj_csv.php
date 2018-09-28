<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$plik = $_FILES['plik'];


$uchwyt = fopen ($plik['tmp_name'],"r");
while (($data = fgetcsv($uchwyt, 1000, ",")))  {
    $num = count($data);
       
    for ($c=0; $c < $num; $c++) {
    	echo '<div class="mailing_odbiorca_email" data-adresat_email="'.$data[$c].'"><p class="mail_napis">'.$data[$c].'</p><span class="usun_mail"><span>x</span></span><div class="clear_b"></div></div>';
    }
}
fclose ($uchwyt);

