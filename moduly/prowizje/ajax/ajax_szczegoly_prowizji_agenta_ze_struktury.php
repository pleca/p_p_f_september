<?php

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
	session_start ();
	session_destroy ();
	header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
	die ();
}

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/prowizje/db/funkcje_db.php');

$numer_agenta = htmlspecialchars ( $_POST ['nr_agenta'] );
$miesiac = htmlspecialchars ( $_POST ['miesiac'] );
$typ_prowizji = htmlspecialchars ( $_POST ['typ_prowizji'] );
$rok = htmlspecialchars ( $_POST ['rok'] );

$tablicajson_pr = array (
		array () 
);

$prowizja = pobierz_szczegoly_prowizji_agenta ( $miesiac, $rok, $numer_agenta, $typ_prowizji );

while ( $wiersz = mssql_fetch_array ( $prowizja ) ) {
	
	$numer_sprawy = iconv ( "cp1250", "UTF-8", $wiersz ['CaseNumber'] );
	$krotki_numer_sprawy = substr ( $numer_sprawy, - 7 );
	$kod_jednostki = iconv ( "cp1250", "UTF-8", $wiersz ['UnitNumber'] );
	$numer_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['AgentNumber'] );
	$in_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['AgentName'] );
	$numer_kierownika = iconv ( "cp1250", "UTF-8", $wiersz ['ManagerNumber'] );
	$in_kierownika = iconv ( "cp1250", "UTF-8", $wiersz ['ManagerName'] );
	$numer_dyrektora = iconv ( "cp1250", "UTF-8", $wiersz ['DirectorNumber'] );
	$in_dyrektora = iconv ( "cp1250", "UTF-8", $wiersz ['DirectorName'] );
	$imie_klienta = iconv ( "cp1250", "UTF-8", $wiersz ['ClientName'] );
	$nazwisko_klienta = iconv ( "cp1250", "UTF-8", $wiersz ['ClientSurname'] );
	$kwota_odszk = iconv ( "cp1250", "UTF-8", $wiersz ['CompensationAmount'] );
	$numer_odszk = iconv ( "cp1250", "UTF-8", $wiersz ['CompensationNumber'] );
	$data_wplywu = iconv ( "cp1250", "UTF-8", $wiersz ['AccountDate'] );
	$honorarium_netto = iconv ( "cp1250", "UTF-8", $wiersz ['FeeNetto'] );
	$prowizja_przed = iconv ( "cp1250", "UTF-8", $wiersz ['CommissionBeforeDeduction'] );
	$prowizja_po = iconv ( "cp1250", "UTF-8", $wiersz ['CommissionAfterDeduction'] );
	$nazwa_prowizji = iconv ( "cp1250", "UTF-8", $wiersz ['CommissionName'] );
	
	$tablica_pr = array (
			$krotki_numer_sprawy,
			$numer_sprawy,
			$kod_jednostki,
			$numer_agenta,
			$in_agenta,
			$numer_kierownika,
			$in_kierownika,
			$numer_dyrektora,
			$in_dyrektora,
			$nazwisko_klienta,
			$imie_klienta,
			$kwota_odszk,
			$data_wplywu,
			$honorarium_netto,
			$prowizja_przed,
			$prowizja_po,
			$numer_odszk,
			$nazwa_prowizji 
	);
	
	array_push ( $tablicajson_pr [0], $tablica_pr );
}

echo json_encode ( $tablicajson_pr [0] );