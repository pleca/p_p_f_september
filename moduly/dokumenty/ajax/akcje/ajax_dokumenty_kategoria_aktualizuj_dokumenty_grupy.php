<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$akcja = $_POST['akcja'];
$dokumenty_id = $_POST['dokumenty_id'];
$uzytkownik_grupa_id = $_POST['uzytkownik_grupa_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

if($akcja == 'dodaj'){
	dokumenty_kategoria_dodaj_dokumenty_grupy($dokumenty_id, $uzytkownik_grupa_id);
}

if($akcja == 'usun'){
	dokumenty_kategoria_usun_dokumenty_grupy($dokumenty_id, $uzytkownik_grupa_id);
}

//echo $akcja.$dokumenty_id.$uzytkownik_grupa_id;