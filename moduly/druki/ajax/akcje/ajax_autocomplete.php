<?php

/*require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$drukiaMain = new DrukiMain();

$umowaJednostkaId = $bazaDanych->pobierzDane('*', 'umowaSlownikKodJednostki', 'czy_usuniety=0');
while($poj_umowaJednostkaId = $umowaJednostkaId->fetch_object()){
    $arr[] = $poj_umowaJednostkaId->Nazwa;
}

echo json_encode($arr);*/

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
    session_start ();
    session_destroy ();
    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
    die ();
}

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/druki/db/funkcje_db.php');


$umowaJednostkaId = pobierz_liste_jednostek();

while ( $wiersz = mssql_fetch_assoc ( $umowaJednostkaId ) ) {

    $numer = iconv ( "cp1250", "UTF-8", $wiersz ['UnitNumber']);
    $nazwa = iconv ( "cp1250", "UTF-8", $wiersz ['UnitName']);

    $arr[] = array ('label' => $numer.' - ' .$nazwa, 'value' => $numer);
}

echo json_encode($arr);