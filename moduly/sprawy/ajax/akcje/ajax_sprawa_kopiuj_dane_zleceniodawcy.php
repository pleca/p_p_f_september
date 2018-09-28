<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars ( $_POST ['sprawa_id'] );
$id_klienta_1 = htmlspecialchars ( $_POST ['id_klienta_1'] );

$klient = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $id_klienta_1 );

$klient_adres = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_adres', $klient ['sprawa_adres_zameldowania_id'] );

$dane = array (
		0 => $klient ['imie'],
		1 => $klient ['nazwisko'],
		2 => $klient_adres ['ulica'],
		3 => $klient_adres ['nr_domu'],
		4 => $klient_adres ['nr_mieszkania'],
		5 => $klient_adres ['kod_pocztowy'],
		6 => $klient_adres ['miejscowosc'],
		7 => $klient ['nr_rachunku_bankowego'] 
);

echo json_encode ( $dane );
