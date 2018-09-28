<?php
$upload = $_FILES['obraz'];

$lokalizacja = "/var/www/html/moduly/mailing/tmp";

$nazwa = md5(date('dmYHisu').$liczba_rand.$upload['size'].$upload['name']).'.jpg';

move_uploaded_file ( $upload['tmp_name'], $lokalizacja.'/'.$nazwa );

echo $nazwa;