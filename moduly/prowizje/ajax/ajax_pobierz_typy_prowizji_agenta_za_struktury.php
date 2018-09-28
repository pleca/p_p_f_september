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
$numer_agenta = htmlspecialchars ( $_POST ['nr_agenta'] );


$typy_prowizji = pobierz_typy_prowizji_agenta ( $rok, $numer_agenta );

        while ( $wiersz = mssql_fetch_array ( $typy_prowizji ) ) {

            $typ = iconv ( "cp1250", "UTF-8", $wiersz ['Type']);
            $wartosc = iconv ( "cp1250", "UTF-8", $wiersz ['Value']);
            $typ_int = (int) $typ;

            $tablicajson[] = array ('typ' => $typ, 'wartosc' => $wartosc);

        }

echo json_encode ( $tablicajson );