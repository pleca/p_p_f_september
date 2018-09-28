<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$akcja = $_POST['akcja'];
$produkty_id = $_POST['produkty_id'];
$uzytkownik_grupa_id = $_POST['uzytkownik_grupa_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

if($akcja == 'dodaj'){
	produkty_grupa_dodaj_produkty_grupy($produkty_id, $uzytkownik_grupa_id);
}

if($akcja == 'usun'){
	produkty_grupa_usun_produkty_grupy($produkty_id, $uzytkownik_grupa_id);
}

//echo $akcja.$produkty_id.$uzytkownik_grupa_id;