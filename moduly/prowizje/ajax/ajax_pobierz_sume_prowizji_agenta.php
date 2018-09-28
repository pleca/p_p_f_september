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
$typ_prowizji = htmlspecialchars ( $_POST ['typ_prowizji'] );
$numer_agenta = $uzytkownik ['login'];

$suma_prowizji = pobierz_sume_prowizji_agenta($rok, $numer_agenta, $typ_prowizji);

$ilosc_wierszy = mssql_num_rows($suma_prowizji);

$zmienna_tmp = array ();
$tablicajson = array (
    array ()
);

        while ( $wiersz = mssql_fetch_array ( $suma_prowizji ) ) {

            for($i = 0; $i <= 12; $i++) {

                $dane = round(iconv("cp1250", "UTF-8", $wiersz [$i]), 2);
                $miesiac = $i+1;

                if ($typ_prowizji == '0') {
                    $link = '<div class="suma_prowizji"  data-nr_miesiaca='.$miesiac.'>'.$dane.'</div>';

                } else {
                    $link = '<div class="szczegoly_prowizji" data-nr_miesiaca='.$miesiac.' data-typ_prowizji='.$typ_prowizji.'>'.$dane.'</div>';
                }

                $zmienna_tmp[] = $link;
            }
        }

array_push ( $tablicajson [0], $zmienna_tmp );

echo json_encode ( $tablicajson[0] );