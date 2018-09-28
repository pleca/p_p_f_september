<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$dokumenty_id = $_POST['dokumenty_id'];
$uzytkownik_id= $_POST['uzytkownik_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

dokumenty_uzytkownicy_usun($dokumenty_id, $uzytkownik_id);

