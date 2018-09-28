<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);

$klient_id = sprawa_pobierz_warosc_z_tabeli_po_id('sprawa_klient_id', 'sprawa',  $sprawa_id);

$klient = sprawa_pobierz_dane_z_tabeli_po_id('sprawa_osoba', $klient_id['sprawa_klient_id']);

$klient_adres = sprawa_pobierz_dane_z_tabeli_po_id('sprawa_adres', $klient['sprawa_adres_zameldowania_id']);

$dane = array(
		0 => $klient['imie']
		,1 => $klient['nazwisko']
		,2 => $klient['nr_rachunku']
		,3 => $klient_adres['ulica']
		,4 => $klient_adres['nr_domu']
		,5 => $klient_adres['nr_mieszkania']
		,6 => $klient_adres['kod_pocztowy']
		,7 => $klient_adres['miasto']
		,8 => $klient_id['sprawa_klient_id']

			
);

echo json_encode($dane);



sprawa_aktualizuj_ostatnia_strone($sprawa_id, '14');