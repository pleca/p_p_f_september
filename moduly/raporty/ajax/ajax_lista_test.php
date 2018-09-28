<?php
/*
if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
    session_start ();
    session_destroy ();
    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
    die ();
}
*/





require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/prowizje/db/funkcje_db.php');

$tablicajson = array (
    array ()
);

    $tablica[] = array (
        "MeetingID" => 3
    ,"RoomID" => 1
    ,"Attendees" => [2]
    ,"Title" => "Marketing meetings"
    ,"Description" => ""
    ,"StartTimezone" => null
    ,"Start" => "/Date(1370908800000)/"
    ,"End" => "/Date(1370908800000)/"
    ,"EndTimezone" => null
    ,"RecurrenceRule" => null
    ,"RecurrenceID" => null
    ,"RecurrenceException" => null
    ,"IsAllDay" => true
    );

    $tablica[] = array (
        "MeetingID" => 4
    ,"RoomID" => 1
    ,"Attendees" => [1]
    ,"Title" => "Marketing meetings"
    ,"Description" => ""
    ,"StartTimezone" => null
    ,"Start" => "/Date(1370908800000)/"
    ,"End" => "/Date(1370908800000)/"
    ,"EndTimezone" => null
    ,"RecurrenceRule" => null
    ,"RecurrenceID" => null
    ,"RecurrenceException" => null
    ,"IsAllDay" => true
    );

    array_push ( $tablicajson[0], $tablica );


echo json_encode ( $tablica );


/*session_start ();



require_once($_SERVER ['DOCUMENT_ROOT'] . 'moduly/raporty/db/funkcje_db.php');

$dbResult = php_directorReportGetAgents();
$row= mssql_fetch_assoc($dbResult);

while($row = mssql_fetch_assoc($dbResult)){
    $result[] = $row;
}
$result = utf8_converter($result);
$result = json_encode($result);
echo  $result;*/

?>