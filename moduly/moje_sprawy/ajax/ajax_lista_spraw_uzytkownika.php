<?php

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
    session_start ();
    session_destroy ();
    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
    die ();
}

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/moje_sprawy/db/funkcje_db.php');

$uzytkownik = pobierz_jeden_wiersz_z_tabeli ( 'uzytkownik', $_SESSION ['uzytkownik_id'] );

//$id_uzytkownika = 'A011068';
//$etap_archiwum = htmlspecialchars ( $_POST ['etap_archiwum'] );
$id_uzytkownika = $uzytkownik ['login'];

$tablicajson = array (
    'data' => array ()
);

$lista_spraw = pobierz_liste_spraw ( $id_uzytkownika );

while ( $wiersz = mssql_fetch_array ( $lista_spraw ) ) {

    $data_wplyw = strtotime ( iconv ( "cp1250", "UTF-8", $wiersz ['Sprawa_data_wplywu'] ) );
    $data_krotka_wplyw = date ( "Y-m-d", $data_wplyw );

    $data_wplyw_ostatni = iconv ( "cp1250", "UTF-8", $wiersz ['Data_ostatniego_wplywu'] );
    $data_krotka_wplyw_ostatni = date ( "Y-m-d", $data_wplyw_ostatni );

    $data_ostatniego_komentarza = strtotime ( iconv ( "cp1250", "UTF-8", $wiersz ['Data_ostatniego_komentarza'] ) );
    $data_krotka_ostatniego_komentarza = date ( "Y-m-d", $data_ostatniego_komentarza );

    if ($data_krotka_ostatniego_komentarza == '1970-01-01') {
        $data_krotka_ostatniego_komentarza = '';
    }

    $sprawa = iconv ( "cp1250", "UTF-8", $wiersz ['Spraw_numer'] );

    $tablica = array (
        'lp' => '',
        'numer_sprawy' => '<div class="pokaz_szczegoly_sprawy" data-id_sprawy='.iconv ( "cp1250", "UTF-8", $wiersz ["Sprawa_id"] ).' >' . $sprawa . '</div>',
        'data_wplywu' => $data_krotka_wplyw,
        'data_ostatniego_wplywu' => $data_wplyw_ostatni,
        'data_ostatniego_komentarza' => $data_krotka_ostatniego_komentarza,
        'nazwisko_imie_klienta' => iconv ( "cp1250", "UTF-8", $wiersz ['Klient_nazwisko'] ) . ' ' . iconv ( "cp1250", "UTF-8", $wiersz ['Klient_imie'] ),
        'etap_sprawy' => iconv ( "cp1250", "UTF-8", $wiersz ['Etap_sprawy'] ),
        'agent' => iconv ( "cp1250", "UTF-8", $wiersz ['Agent'] ),
        'grupa_spraw' => iconv ( "cp1250", "UTF-8", $wiersz ['Grupa_spraw'] ),
        'etap_w_kancelari' => iconv ( "cp1250", "UTF-8", $wiersz ['Kancelaria_etap'] ),
        'kierownik' => iconv ( "cp1250", "UTF-8", $wiersz ['Kierownik'] ),
        'dyrektor' => iconv ( "cp1250", "UTF-8", $wiersz ['Dyrektor'] ),
        'imie_doradcy' => iconv ( "cp1250", "UTF-8", $wiersz ['Doradca_imie'] ),
        'nazwisko_doradcy' => iconv ( "cp1250", "UTF-8", $wiersz ['Doradca_nazwisko'] ),
        'imie_prawnika' => iconv ( "cp1250", "UTF-8", $wiersz ['Prawnik_imie'] ),
        'nazwisko_prawnika' => iconv ( "cp1250", "UTF-8", $wiersz ['Nazwisko_prawnika'] ),
        'komentarz' => iconv ( "cp1250", "UTF-8", $wiersz ['Komentarz'] ),
        'kwota_wplywu' => iconv ( "cp1250", "UTF-8", $wiersz ['Kwota_ostatniego_wplywu'] ),
        'typ_szkody' => iconv ( "cp1250", "UTF-8", $wiersz ['Typ_szkody'] )
    );

        array_push ( $tablicajson ['data'], $tablica );

}

echo json_encode ( $tablicajson );

?>


