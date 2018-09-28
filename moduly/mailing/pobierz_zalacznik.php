<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$nazwa_pliku = $_GET['nazwa'];
$mailing_id = $_GET['mailing_id'];

$nazwa_pliku1 = explode('.', $nazwa_pliku);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Content-Disposition: inline; filename=dokument.$nazwa_pliku1[1]");
readfile('/var/www/pliki/!mailing/historia/'.$mailing_id.'/'.$nazwa_pliku);