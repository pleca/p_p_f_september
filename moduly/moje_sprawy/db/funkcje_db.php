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

function pobierz_liste_spraw($numer_agenta) {
	$polaczenie_ms_sql = polacz_z_baza_ms_sql ();
	
	$procedura = mssql_init ( 'php_pobranie_spraw_agenta', $polaczenie_ms_sql );
	
	mssql_bind ( $procedura, '@numer_agenta', $numer_agenta, SQLVARCHAR );
	
	$wynik = mssql_execute ( $procedura );

	return $wynik;

}
function pobierz_szczegoly_sprawy($id_sprawy) {

    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( 'php_szczegoly_sprawy', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@id_sprawy', $id_sprawy, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_komentarze_do_spraw($id_sprawy) {

    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( 'php_komentarze_do_sprawy', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@id_sprawy', $id_sprawy, SQLVARCHAR);

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}

function pobierz_wplywy_do_spraw($id_sprawy) {
    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( 'php_wplywy_do_sprawy', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@id_sprawy', $id_sprawy, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;

}

?>