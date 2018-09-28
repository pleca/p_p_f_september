<?php
//if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
//    session_start ();
//    session_destroy ();
//    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
//    die ();
//}
//
//session_start ();
//
//require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/raporty/db/funkcje_db.php');
//
//$status = htmlspecialchars ( $_POST ['status'] );
//$type = htmlspecialchars ( $_POST ['type'] );
//$year = htmlspecialchars ( $_POST ['year'] );
//$month = htmlspecialchars ( $_POST ['month'] );
//$bona = htmlspecialchars ( $_POST ['bona'] );
//$personal = htmlspecialchars ( $_POST ['personal'] );
//
//$raport = php_directorReportGetManagers ($status, $type, $year, $month, $bona, $personal);
//$raport = php_directorReportGetAgents ($status, $type, $year, $month, $bona, $personal);
//
//
//$tablicajson[] = array (
//);
//
//while ( $wiersz = mssql_fetch_assoc ( $raport ) ) {
//
//    $dane_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['AgentName']);
//}
//
//
//$tablicajson = array (
//    0 => $dane_agenta
//    );
//
//echo json_encode ( $tablicajson);
