<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$file = '/var/www/pliki/!strefa_plikow/'.$_GET['id_d'].'/'.$_GET['nazwa'];

$nazwa_tmp = explode('.',$_GET['nazwa']);

header("Content-type: application/pdf");
header('Content-Disposition: inline; filename="'.$_GET['nazwa'].'"');

ob_clean();
readfile($file);