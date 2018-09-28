<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$dokument_id = $_POST['dokument_id'];
$uzytkownik_id = $_POST['uzytkownik_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

$uprawnienie = lista_uzytkownikow_dla_grupy_sprawdz_czy_istnieje($dokument_id, $uzytkownik_id);

if(mysqli_num_rows($uprawnienie) == '1'){
	$dane = array(
			0 => '0'
	);
	
}else{
	$dane = array(
			0 => '1'
	);
	lista_uzytkownikow_dla_grupy_dodaj_uprawnienie($dokument_id, $uzytkownik_id);
}



echo json_encode($dane);