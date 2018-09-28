<?php

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
	session_start ();
	session_destroy ();
	header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
	die ();
}

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/prowizje/db/funkcje_db.php');

$uzytkownik = pobierz_jeden_wiersz_z_tabeli ( 'uzytkownik', $_SESSION ['uzytkownik_id'] );

$rok = htmlspecialchars ( $_POST ['rok'] );
$numer_agenta = $uzytkownik ['login'];

$prowizja_miesiac = pobierz_sume_prowizji_agenta($rok, $numer_agenta, '0');

while ( $wiersz = mssql_fetch_assoc ( $prowizja_miesiac ) ) {

    for($i=12; $i>0; $i--) {

        $dane = iconv ( "cp1250", "UTF-8", $wiersz [$i] );

        if ($dane != 0) {
            $miesiac = $i;
            break;
		}

    }

}

$data_tmp  = array (
    'Agent',
    'Kwota'
);

$prowizja = pobierz_prowizje_agentow_ze_struktury ( $numer_agenta, $rok, '0' );

while ( $wiersz = mssql_fetch_assoc ( $prowizja ) ) {

	$dane_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['Agent'] );
    $dane_agenta = substr($dane_agenta, 0, -10);
	$dane = round ( iconv ( "cp1250", "UTF-8", $wiersz [$miesiac] ), 2 );

    $data [] = array (
        0 => $dane_agenta,
        1 => $dane
    );

}

foreach ($data as $klucz => $wiersz) {
    $numer[$klucz]  = $wiersz[0];
    $edycja[$klucz] = $wiersz[1];
}

array_multisort($edycja, SORT_DESC, $data);

$wyjscie = array_slice ($data, 0, 13);

array_unshift ($wyjscie, $data_tmp );

echo json_encode ( $wyjscie );