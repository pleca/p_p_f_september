<?php
// Funkcje bazodanowe moduły sprawy
/*
 * if(!isset($_SERVER['HTTP_REFERER'])){
 * session_start();
 * session_destroy();
 * header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
 * die();
 * }
 */
session_start ();

// session_start();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'db/function_db.php');

function pobierz_liste_jednostek() {
    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( 'php_pobranieJednostek', $polaczenie_ms_sql );

    //mssql_bind ( $procedura, '', SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;

}


