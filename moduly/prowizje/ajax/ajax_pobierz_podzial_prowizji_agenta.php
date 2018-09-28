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
$zmienna_tmp = array ();
$tablicajson = array (
    array ()
);

$podzial_prowizji = pobierz_podzial_prowizji_agenta($rok, $miesiac, $numer_agenta);

        while ( $wiersz = mssql_fetch_assoc ( $podzial_prowizji ) ) {

            for ($i=1; $i<11; $i++) {

                $dane = round(iconv("cp1250", "UTF-8", $wiersz[$i]), 2);

                $link = '<div class="szczegoly_prowizji" data-nr_miesiaca='.$miesiac.' data-typ_prowizji='.$i.'>'.$dane.'</div>';
                $zmienna_tmp[] = $link;
            }
            array_push ( $tablicajson [0], $zmienna_tmp );
        }

echo json_encode (  $tablicajson [0] );