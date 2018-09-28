<?php

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
    session_start ();
    session_destroy ();
    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
    die ();
}

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/zgloszenia/db/funkcje_db.php');

$uzytkownik = pobierz_jeden_wiersz_z_tabeli ( 'uzytkownik', $_SESSION ['uzytkownik_id'] );

//$id_uzytkownika = 'A011068';
//$etap_archiwum = htmlspecialchars ( $_POST ['etap_archiwum'] );
$id_uzytkownika = $uzytkownik ['login'];

$tablicajson = array (
    'data' => array ()
);

$lista_zgloszen = pobierz_liste_zgloszen ( $id_uzytkownika );

while ( $wiersz = mssql_fetch_array ( $lista_zgloszen ) ) {

    $sprawa = iconv ( "cp1250", "UTF-8", $wiersz ['Numer'] );

    $agent = iconv ( "cp1250", "UTF-8", $wiersz ['Agent'] );
    if($agent == ' ()') {
        $agent = '';
    }

    $kierownik = iconv ( "cp1250", "UTF-8", $wiersz ['Kierownik'] );
    if($kierownik == ' ()') {
        $kierownik = '';
    }

    $dyrektor = iconv ( "cp1250", "UTF-8", $wiersz ['Dyrektor'] );
    if($dyrektor == ' ()') {
        $dyrektor = '';
    }

    $tablica = array (
        'lp' => '',
        'numer_sprawy' => '<div class="pokaz_szczegoly_zgloszenia" data-id_zgloszenia='.iconv ( "cp1250", "UTF-8", $wiersz ["Id"] ).' >' . $sprawa . '</div>',
        'temat' => iconv ( "cp1250", "UTF-8", $wiersz ['Temat'] ),
        'kategoria' => iconv ( "cp1250", "UTF-8", $wiersz ['Kategoria'] ),
        'etap_sprawy' => iconv ( "cp1250", "UTF-8", $wiersz ['Etap'] ),
        'agent' => $agent,
        'kierownik' => $kierownik,
        'dyrektor' => $dyrektor
    );

        array_push ( $tablicajson ['data'], $tablica );

}

echo json_encode ( $tablicajson );

?>


