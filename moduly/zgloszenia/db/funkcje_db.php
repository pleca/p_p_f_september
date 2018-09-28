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

function pobierz_liste_zgloszen($numer_agenta) {
	$polaczenie_ms_sql = polacz_z_baza_ms_sql ();
	
	$procedura = mssql_init ( 'php_pobranie_zgloszen_agenta', $polaczenie_ms_sql );
	
	mssql_bind ( $procedura, '@agentNumber', $numer_agenta, SQLVARCHAR );
	
	$wynik = mssql_execute ( $procedura );

	return $wynik;

}
function pobierz_szczegoly_zgloszenia($id_zgloszenia) {
    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( 'php_szczegoly_zgloszenia', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@noticeId', $id_zgloszenia, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;

}
function pobierz_informacje_o_zgloszeniu($id_zgloszenia) {
    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( 'php_dodatkowe_informacje_zgloszenia', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@noticeId', $id_zgloszenia, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;

}

?>