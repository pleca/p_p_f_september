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
$nr_agenta = htmlspecialchars ( $_POST ['nr_agenta'] );
$miesiac = htmlspecialchars ( $_POST ['miesiac'] );

$tablicajson = array (
		array ()
);

$tablica_typow = array ();
$zmienna_tmp = array ();
$tablicajson = array (
    array ()
);
$typy_prowizji = pobierz_typy_prowizji_agenta ( $rok, $nr_agenta );

while ( $wiersz = mssql_fetch_array ( $typy_prowizji ) ) {

    $typ = iconv ( "cp1250", "UTF-8", $wiersz ['Type']);
    $tablica_typow[] = $typ;

}

$ilosc_typow = mssql_num_rows($typy_prowizji);

$podzial_prowizji = prowizje_struktury_z_podzialem_za_miesiac ( $rok, $miesiac, $nr_agenta);

while ( $wiersz = mssql_fetch_assoc ( $podzial_prowizji ) ) {

    $zmienna_tmp[] = $nr_agenta;

    for ($i=1; $i<11; $i++) {

        $dane = round(iconv("cp1250", "UTF-8", $wiersz [$i]), 2);

        $link = '<div class="pokaz_wszystkie_szczegoly_prowizji_agenta" data-id_miesiaca="' . $miesiac . '" data-nr_agenta="' . $nr_agenta . '" data-typ_prowizji="' . $i . '">' . $dane . '</div>';
        $zmienna_tmp[] = $link;
    }
    array_push ( $tablicajson [0], $zmienna_tmp );
}

echo json_encode (  $tablicajson [0] );