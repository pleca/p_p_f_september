<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$upload = $_FILES['zalacznik'];

$lokalizacja = "/var/www/html/moduly/mailing/tmp";

$rand = rand();
$nazwa = $rand.'_'.$upload['name'];

move_uploaded_file ( $upload['tmp_name'], $lokalizacja.'/'.$nazwa );

echo $nazwa;