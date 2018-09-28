<?php

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
    session_start ();
    session_destroy ();
    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
    die ();
}

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/prowizje/db/funkcje_db.php');

$rok = htmlspecialchars ( $_POST ['rok'] );
$aktualny_miesiac = htmlspecialchars ( $_POST ['aktualny_miesiac'] );
$uzytkownik = pobierz_jeden_wiersz_z_tabeli ( 'uzytkownik', $_SESSION ['uzytkownik_id'] );

$numer_agenta = $uzytkownik ['login'];

$miesiace_tab = array (
    1 => "Styczeń",
    2 => "Luty",
    3 => "Marzec",
    4 => "Kwiecień",
    5 => "Maj",
    6 => "Czerwiec",
    7 => "Lipiec",
    8 => "Sierpień",
    9 => "Wrzesień",
    10 => "Październik",
    11 => "Listopad",
    12 => "Grudzień"
);

$miesiac = array ();

$data [0] = array (
    'Miesiac',
    'Suma'
);

$prowizje_roczne = pobierz_prowizje_z_ostatnich_miesiecy ( $numer_agenta, $typ_prowizji );

$liczba_miesiecy = mssql_num_rows($prowizje_roczne);

$i = 1;

for ($m=$aktualny_miesiac; $m <= 12; $m++) {

    $miesiac[] = $miesiace_tab[$m];

    if($m == 12) {
        for ($n = 1; $n <=$aktualny_miesiac; $n++) {
            $miesiac[] = $miesiace_tab[$n];
        }
    }

}

while ( $wiersz = mssql_fetch_assoc ( $prowizje_roczne ) ) {

    for($i = 1; $i <= 12; $i ++) {

            $dane = round(iconv("cp1250", "UTF-8", $wiersz [$i]), 2);

            $data [] = array(
                $miesiac[$i],
                $dane
            );
    }
}
echo json_encode ( $data );