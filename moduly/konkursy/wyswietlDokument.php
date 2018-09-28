<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$file = '/var/www/pliki/!konkursy/'.$_GET['id'].'/'.$_GET['nazwa'];

$nazwa_tmp = explode('.',$_GET['nazwa']);

$bazaDancyh = new main_BazaDanych();
$konkursyMain = new KonkursyMain();

$nazwaDokumentu = $bazaDancyh->pobierzDane('nazwa','konkurs_dokumenty','konkurs_id = '.$_GET['id'].' AND nazwa_pliku = "'.$_GET['nazwa'].'"');
$nazwaDokumentu = $nazwaDokumentu->fetch_object();

$konkursyMain->dodajWpisDoHistorii($bazaDanych, $_GET['id'], 'konkurs_id', DOCUMENT_DOWNLOAD, $nazwaDokumentu->nazwa, $_GET['nazwa'] , 'konkurs_historia_zmian');


if(end($nazwa_tmp) === 'pdf'){
    header("Content-type: application/pdf");
    header('Content-Disposition: inline; filename="'.$nazwaDokumentu->nazwa.'.'.end($nazwa_tmp).'"');
}else{
    header("Content-type: application/octet-stream");
    header('Content-Disposition: attachment; filename="'.$nazwaDokumentu->nazwa.'.'.end($nazwa_tmp).'"');
}

ob_clean();
readfile($file);