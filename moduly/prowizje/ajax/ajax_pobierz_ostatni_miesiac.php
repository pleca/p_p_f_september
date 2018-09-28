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

    for($i = 12; $i>0; $i --) {
        $dane = iconv ( "cp1250", "UTF-8", $wiersz [$i] );

        if ($dane != 0) {
           // var_dump($i);
            $miesiac = $i;
            break;
		}
    }

}

echo json_encode ( $miesiac );