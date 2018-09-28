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
$miesiac = htmlspecialchars ( $_POST ['miesiac'] );
$numer_agenta = $uzytkownik ['login'];

$tablica_typow = array ();
$tablicajson = array (
    array ()
);
$typy_prowizji = pobierz_typy_prowizji_agenta ( $rok, $numer_agenta );

    while ( $wiersz = mssql_fetch_array ( $typy_prowizji ) ) {

        $typ = iconv ( "cp1250", "UTF-8", $wiersz ['Type']);
        $tablica_typow[] = $typ;

    }

$ilosc_typow = mssql_num_rows($typy_prowizji);

$podzial_prowizji = pobierz_podzial_prowizji_agenta($rok, $miesiac, $numer_agenta);

        while ( $wiersz = mssql_fetch_array ( $podzial_prowizji ) ) {


            for ($i=0; $i<$ilosc_typow; $i++) {

                $zmienna_tmp[] = round(iconv("cp1250", "UTF-8", $wiersz [$i]), 2);

            }
            array_push ( $tablicajson [0], $zmienna_tmp );
        }

echo json_encode (  $tablicajson [0] );