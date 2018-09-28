<?php
if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
	session_start ();
	session_destroy ();
	header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
	die ();
}

session_start ();
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/zgloszenia/db/funkcje_db.php');

$id_zgloszenia = htmlspecialchars($_POST['id_zgloszenia']);

//$id_uzytkownika = 'A011068';

//$id_uzytkownika = $uzytkownik ['login'];



$szczegoly_zgloszenia = pobierz_szczegoly_zgloszenia ( $id_zgloszenia );

while ( $wiersz = mssql_fetch_array ( $szczegoly_zgloszenia ) ) {
	
	$id = iconv ( "cp1250", "UTF-8", $wiersz ['Id'] );
    $numer = iconv ( "cp1250", "UTF-8", $wiersz ['Numer'] );
    //$data_utworzenia = iconv ( "cp1250", "UTF-8", $wiersz ['DataUtworzenia'] );

    $data_utworzenia = strtotime ( iconv ( "cp1250", "UTF-8", $wiersz ['DataUtworzenia'] ) );
    $data_utworzenia_krotka = date ( "d-m-Y", $data_utworzenia );
    $data_utworzenia = $data_utworzenia_krotka;

    //$data_modyfikacji = iconv ( "cp1250", "UTF-8", $wiersz ['DataModyfikacji'] );

    $data_modyfikacji = strtotime ( iconv ( "cp1250", "UTF-8", $wiersz ['DataModyfikacji'] ) );
    $data_modyfikacji_krotka = date ( "d-m-Y", $data_modyfikacji );
    $data_modyfikacji = $data_modyfikacji_krotka;

    $numer_sprawy = iconv ( "cp1250", "UTF-8", $wiersz ['NumerSprawy'] );
    $kategoria = iconv ( "cp1250", "UTF-8", $wiersz ['Kategoria'] );
    $etap = iconv ( "cp1250", "UTF-8", $wiersz ['Etap'] );
    $agent = iconv ( "cp1250", "UTF-8", $wiersz ['Agent'] );
    $kierownik = iconv ( "cp1250", "UTF-8", $wiersz ['Kierownik'] );
    $dyrektor = iconv ( "cp1250", "UTF-8", $wiersz ['Dyrektor'] );
    $konsultant = iconv ( "cp1250", "UTF-8", $wiersz ['Konsultant'] );

    if($konsultant = '()') {
        $konsultant = 'brak';
    }

    $jednostka = iconv ( "cp1250", "UTF-8", $wiersz ['Jednostka'] );

    if($jednostka = '()') {
        $jednostka = 'brak';
    }

    $klient = iconv ( "cp1250", "UTF-8", $wiersz ['Klient'] );
    $temat = iconv ( "cp1250", "UTF-8", $wiersz ['Temat'] );
    $tresc = iconv ( "cp1250", "UTF-8", $wiersz ['Tresc'] );


}

$dane = "<div class='dane_zgloszenia'>"
    ."<table id='szczegoly_zgloszenia'>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Numer głoszenia:</td><td class='wartosc_kolumny'>".$numer."</td>"
            ."<td class='nazwa_kolumny'>Numer sprawy:</td><td class='wartosc_kolumny'>".$numer_sprawy."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Data utworzenia:</td><td class='wartosc_kolumny'>".$data_utworzenia."</td>"
            ."<td class='nazwa_kolumny'>Data modyfikacji:</td><td class='wartosc_kolumny'>".$data_modyfikacji."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Kategoria:</td><td class='wartosc_kolumny'>".$kategoria."</td>"
            ."<td class='nazwa_kolumny'>Etap:</td><td class='wartosc_kolumny'>".$etap."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Agent:</td><td class='wartosc_kolumny'>".$agent."</td>"
            ."<td class='nazwa_kolumny'>Konsultant:</td><td class='wartosc_kolumny'>".$konsultant."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Dyrektor:</td><td class='wartosc_kolumny'>".$dyrektor."</td>"
            ."<td class='nazwa_kolumny'>Kierownik:</td><td class='wartosc_kolumny'>".$kierownik."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Jednostka:</td><td class='wartosc_kolumny'>".$jednostka."</td>"
            ."<td class='nazwa_kolumny'>Klient:</td><td class='wartosc_kolumny'>".$klient."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Temat:</td><td colspan='3'>".$temat."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Treść:</td><td colspan='3'>".$tresc."</td></tr>"
    ."</table>"
    ."</div>";


$dane = array(
    0 => $numer,
    1 => $dane,
	2 => $id
    //3 => $imie_klienta,
    //4 => $nazwisko_poszkodowanego,
    //5 => $imie_poszkodowanego,
    //6 => $data_rejestracji,
    //7 => $etap_sprawy,
    //8 => $etap,
    //9 => $obslugujacy,
    //10 => $email_obslugujacego,
    //11 => $wartosc_sprawy,
    //12 => $data_roszczenia,
    //13 => $wycena,
    //14 => $data_archiwum,
    ///15 => $powod_przniesienia,
    //16 => $numer_agenta,
    //17 => $nazwa_agenta,
    //18 => $numer_kierownika,
    //19 => $nazwa_kierownika,
    //20 => $numer_dyrektora,
    //21 => $nazwa_dyrektora,
    //22 => $jednostka,
    //23 => $honorarium,
    //24 => $kom_as_string,
    //24 => str_replace(",",'.',$komentarze_tab),
    //25 => $prawnik,
    //26 => $data_pozwu,
    //27 => $wps,
    //30 => $id_sprawy
);

//array_push ( $dane [24], $komentarze_tab );

echo json_encode($dane);


?>


