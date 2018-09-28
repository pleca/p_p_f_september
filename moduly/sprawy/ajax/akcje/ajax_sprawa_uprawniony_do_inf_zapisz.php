<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$uprawniony_imie = htmlspecialchars($_POST['uprawniony_imie']);
$uprawniony_nazwisko = htmlspecialchars($_POST['uprawniony_nazwisko']);
$uprawniony_pesel = htmlspecialchars($_POST['uprawniony_pesel']);
$typ_osoba = htmlspecialchars($_POST['typ_osoba']);
$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$uprawniony_do_inf_id = htmlspecialchars($_POST['uprawniony_do_inf_id']);
$akcja = htmlspecialchars($_POST['akcja']);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '4');

if($akcja === 'dodaj'){
	$uprawniony_do_inf = sprawa_uprawniony_do_inf_dodaj_nowy($uprawniony_imie, $uprawniony_nazwisko, $uprawniony_pesel, $typ_osoba, $sprawa_id);
	
	echo $uprawniony_do_inf['id'];
}

if($akcja === 'edytuj'){
	$uprawniony_do_inf = sprawa_uprawniony_do_inf_zapisz_zmiany($uprawniony_do_inf_id, $uprawniony_imie, $uprawniony_nazwisko, $uprawniony_pesel);
	
	echo $uprawniony_do_inf_id;
	
}


