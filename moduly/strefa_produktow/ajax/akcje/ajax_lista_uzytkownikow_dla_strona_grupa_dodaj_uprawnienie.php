<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkt_id = $_POST['produkt_id'];
$uzytkownik_id = $_POST['uzytkownik_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

$uprawnienie = lista_uzytkownikow_dla_strona_grupa_sprawdz_czy_istnieje($produkt_id, $uzytkownik_id);

if(mysqli_num_rows($uprawnienie) == '1'){
	$dane = array(
			0 => '0'
	);

}else{
	$dane = array(
			0 => '1'
	);
	lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie($produkt_id, $uzytkownik_id);
}



echo json_encode($dane);