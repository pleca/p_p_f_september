<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$file = '/var/www/pliki/!podcasty/'.$_GET['id'].'/'.$_GET['nazwa'];

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header("Cache-Control: must-revalidate");
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}

