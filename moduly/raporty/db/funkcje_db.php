<?php
//Funkcje bazodanowe moduły sprawy
/*
if(!isset($_SERVER['HTTP_REFERER'])){
    session_start();
    session_destroy();
    header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
    die();
}

session_start ();
*/


function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        $item = iconv ( "cp1250", "UTF-8", $item );
    });
    return $array;
}


require_once ($_SERVER ['DOCUMENT_ROOT'] . 'db/function_db.php');

function php_directorReportGetManagers($user, $status=false, $type=false, $year=false, $month=false, $bona=false, $personal=false) {

    $par = 'a000140';
    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();
    $procedura = mssql_init ('[dbo].[php_directorReportGetManagers]', $polaczenie_ms_sql);

    mssql_bind ( $procedura, '@directorAgentNumber', $user, SQLVARCHAR );
    if($status != ''){ mssql_bind ( $procedura, '@caseState', $status, SQLVARCHAR );}
    if($type != ''){ mssql_bind ( $procedura, '@caseKind', $type, SQLVARCHAR );}
    if($year != ''){ mssql_bind ( $procedura, '@registerYear', $year, SQLVARCHAR );}
    if($month != ''){ mssql_bind ( $procedura, '@registerMonth', $month, SQLVARCHAR );}
    if($bona != ''){ mssql_bind ( $procedura, '@isBona', $bona, SQLVARCHAR );}
    if($personal != ''){ mssql_bind ( $procedura, '@isPersonal', $personal, SQLVARCHAR );}
    $wynik = mssql_execute($procedura);
    return $wynik;
}


function php_directorReportGetAgents($user, $ManagerId=false, $status=false, $type=false, $year=false, $month=false, $bona=false, $personal=false) {

    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( '[dbo].[php_directorReportGetAgents]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@directorAgentNumber', $user, SQLVARCHAR );
    if (isset($ManagerId)) {  mssql_bind($procedura, '@ManagerId', $ManagerId, SQLVARCHAR);  }
    if($status != ''){ mssql_bind ( $procedura, '@caseState', $status, SQLVARCHAR );}
    if($type != ''){ mssql_bind ( $procedura, '@caseKind', $type, SQLVARCHAR );}
    if($year != ''){ mssql_bind ( $procedura, '@registerYear', $year, SQLVARCHAR );}
    if($month != ''){ mssql_bind ( $procedura, '@registerMonth', $month, SQLVARCHAR );}
    if($bona != ''){ mssql_bind ( $procedura, '@isBona', $bona, SQLVARCHAR );}
    if($personal != ''){ mssql_bind ( $procedura, '@isPersonal', $personal, SQLVARCHAR );}

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}

function php_directorReportCaseGroupForChart($user, $ManagerId=false, $status=false, $type=false, $year=false, $month=false, $bona=false, $personal=false) {

    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( '[dbo].[php_directorReportCaseGroupForChart]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@directorAgentNumber', $user, SQLVARCHAR );
    if (isset($ManagerId)) {  mssql_bind($procedura, '@ManagerId', $ManagerId, SQLVARCHAR);  }
    if($status != ''){ mssql_bind ( $procedura, '@caseState', $status, SQLVARCHAR );}
    if($type != ''){ mssql_bind ( $procedura, '@caseKind', $type, SQLVARCHAR );}
    if($year != ''){ mssql_bind ( $procedura, '@registerYear', $year, SQLVARCHAR );}
    if($month != ''){ mssql_bind ( $procedura, '@registerMonth', $month, SQLVARCHAR );}
    if($bona != ''){ mssql_bind ( $procedura, '@isBona', $bona, SQLVARCHAR );}
    if($personal != ''){ mssql_bind ( $procedura, '@isPersonal', $personal, SQLVARCHAR );}

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}

function php_directorReportCaseGroupForChart2($user, $ManagerId=false, $status=false, $type=false, $year=false, $month=false, $bona=false, $personal=false) {

    $polaczenie_ms_sql = polacz_z_baza_ms_sql ();

    $procedura = mssql_init ( '[dbo].[php_directorReportCaseGroupForChart2]', $polaczenie_ms_sql );

    mssql_bind ( $procedura, '@directorAgentNumber', $user, SQLVARCHAR );
    if (isset($ManagerId)) {  mssql_bind($procedura, '@ManagerId', $ManagerId, SQLVARCHAR);  }
    if($status != ''){ mssql_bind ( $procedura, '@caseState', $status, SQLVARCHAR );}
    if($type != ''){ mssql_bind ( $procedura, '@caseKind', $type, SQLVARCHAR );}
    if($year != ''){ mssql_bind ( $procedura, '@registerYear', $year, SQLVARCHAR );}
    if($month != ''){ mssql_bind ( $procedura, '@registerMonth', $month, SQLVARCHAR );}
    if($bona != ''){ mssql_bind ( $procedura, '@isBona', $bona, SQLVARCHAR );}
    if($personal != ''){ mssql_bind ( $procedura, '@isPersonal', $personal, SQLVARCHAR );}

    $wynik = mssql_execute ( $procedura );

    return $wynik;
}