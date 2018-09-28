<?php
/*
if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
    session_start ();
    session_destroy ();
    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
    die ();
}


session_start ();
*/


require_once($_SERVER ['DOCUMENT_ROOT'] . 'moduly/raporty/db/funkcje_db.php');

$user = htmlspecialchars ( $_POST ['user'] );
$status = htmlspecialchars ( $_POST ['status'] );
$type = htmlspecialchars ( $_POST ['type'] );
$year = htmlspecialchars ( $_POST ['year'] );
$month = htmlspecialchars ( $_POST ['month'] );
$bona = htmlspecialchars ( $_POST ['bona'] );
$personal = htmlspecialchars ( $_POST ['personal'] );

if((substr($user, 0,2) != 'a0')&&(substr($user, 0,2) != 'A0')){
    $user = 'a000000';
}

$dbResult = php_directorReportGetManagers ($user, $status, $type, $year, $month, $bona, $personal);
#var_dump($dbResult);
#var_dump($row);


$i=0;
while($row = mssql_fetch_assoc($dbResult)){
    $i++;
    $result[] = array("id" => $i)+$row;
}

$result = utf8_converter($result);
$result = json_encode($result);
echo $result;

?>

