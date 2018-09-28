<?php
//Funkcje bazodanowe moduły sprawy

  if(!isset($_SERVER['HTTP_REFERER'])){
  session_start();
  session_destroy();
  header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
  die();
 }

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'db/function_db.php');

function pobierz_typy_prowizji_agenta($rok, $numer_agenta) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetCommissionsTypeForAgentNumberAndYear]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmAgentNumber', $numer_agenta, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_sume_prowizji_agenta($rok, $numer_agenta, $typ_prowizji) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetAllSumForAgentNumberAndYear]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmAgentNumber', $numer_agenta, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmTypeId', $typ_prowizji, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_podzial_prowizji_agenta($rok, $miesiac, $numer_agenta) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetSumForAgentNumberMonthAndYear]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmMonth', $miesiac, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmAgentNumber', $numer_agenta, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_szczegoly_prowizji_agenta ($id_miesiaca, $rok, $nr_agenta, $typ_prowizji) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetLinesForMonthWithMonthNumber]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmMonth', $id_miesiaca, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmAgentNumber', $nr_agenta, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmType', $typ_prowizji, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_prowizje_agentow_ze_struktury($numer_agenta, $rok, $typ_prowizji) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetAllSumForStructByYearAndAgentNumber]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmAgentNumber', $numer_agenta, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmTypeId', $typ_prowizji, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_typy_prowizji_agenta_ze_struktury($rok, $numer_agenta) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetCommissionsTypeForStructByAgentNumberAndYear]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmAgentNumber', $numer_agenta, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function prowizje_struktury_z_podzialem_za_miesiac($rok, $miesiac, $agent) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetSumForAgentNumberMonthAndYear]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmMonth', $miesiac, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmAgentNumber', $agent, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_prowizje_z_ostatnich_miesiecy($numer_agenta, $typ_prowizji) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetAllSumForLastTwelveMonhtsByAgentNumber]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmTypeId', $typ_prowizji, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmAgentNumber', $numer_agenta, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_prowizje_wszystkich_agentow ($rok, $typ_prowizji) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetAllSumForStructByYearAndAgentNumberAll]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmTypeId', $typ_prowizji, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}
function pobierz_sume_prowizji($rok, $typ_prowizji) {
    $polaczenie_ms_sql = polacz_z_baza_anakonda_na_ms_sql ();

    $procedura = mssql_init ( '[commission].[GetAllSumForAgentNumberAndYearAll]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@prmYear', $rok, SQLVARCHAR );
    mssql_bind ( $procedura, '@prmTypeId', $typ_prowizji, SQLVARCHAR );

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}