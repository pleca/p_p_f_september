<?php

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
    session_start ();
    session_destroy ();
    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
    die ();
}

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/moje_sprawy/db/funkcje_db.php');

$uzytkownik = pobierz_jeden_wiersz_z_tabeli ( 'uzytkownik', $_SESSION ['uzytkownik_id'] );

//$id_sprawy = 146824;
$id_sprawy = htmlspecialchars($_GET['id_sprawy']);

//$id_uzytkownika = 'A011068';

$id_uzytkownika = $uzytkownik ['login'];

$tablicajson = array (
    'data' => array ()
);

$lista_spraw = pobierz_wplywy_do_spraw ( $id_sprawy );

while ( $wiersz = mssql_fetch_array ( $lista_spraw ) ) {

    $data = strtotime ( iconv ( "cp1250", "UTF-8", $wiersz ['DataWplywu'] ) );
    $data_krotka = date ( "d-m-Y", $data );

    $wplyw = iconv ( "cp1250", "UTF-8", $wiersz ['KwotaWplywu']);
    $kwota_wplywu = number_format($wplyw, 2, ',', ' ');

    $baza = iconv ( "cp1250", "UTF-8", $wiersz ['KwotaOdKtorejNaliczamyHonorarium']);
    $kwota_bazowa = number_format($baza, 2, ',', ' ');

    $tablica = array (
        'numer_odszkodowania' => iconv ( "cp1250", "UTF-8", $wiersz ['NumerOdszkodowania']),
        'data_wplywu' => $data_krotka,
        'kwota_wplywu' => $kwota_wplywu,
        'kwota_bazowa' => $kwota_bazowa
    );

    array_push ( $tablicajson ['data'], $tablica );
}

echo json_encode ( $tablicajson );

?>


