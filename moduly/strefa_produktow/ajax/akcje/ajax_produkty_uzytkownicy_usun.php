<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkty_id = $_POST['produkty_id'];
$uzytkownik_id= $_POST['uzytkownik_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

produkty_uzytkownicy_usun($produkty_id, $uzytkownik_id);

