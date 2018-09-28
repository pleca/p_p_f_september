<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$file = '/var/www/pliki/!szkolenia/'.$_GET['zakladka'].'/'.$_GET['id'].'/'.$_GET['nazwa'];

header("Content-type: application/pdf");
ob_clean();
readfile($file);