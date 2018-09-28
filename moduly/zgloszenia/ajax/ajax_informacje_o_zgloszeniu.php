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
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/zgloszenia/db/funkcje_db.php');

$uzytkownik = pobierz_jeden_wiersz_z_tabeli ( 'uzytkownik', $_SESSION ['uzytkownik_id'] );

//$id_zgloszenia = 3532;
$id_zgloszenia = htmlspecialchars($_POST['id_zgloszenia']);

//$id_uzytkownika = 'A011068';

//$id_uzytkownika = $uzytkownik ['login'];

$tablica_danych = array (
    array ()
);

$zgloszenie = pobierz_informacje_o_zgloszeniu ( $id_zgloszenia );

$n = 0;

while ( $wiersz = mssql_fetch_array ( $zgloszenie ) ) {


    $zakladka = iconv ( "cp1250", "UTF-8", $wiersz ['Zakladka']);



    $tablica_zakladek[] = $zakladka;



    for ($i=1; $i<13; $i++) {

        $pole = iconv("cp1250", "UTF-8", $wiersz ['Pole' . $i . 'Nazwa']);

        if ($pole != NULL) {
            $tablica_naglowkow[$n][] = $pole;
            //$tablica_danych[1] = $tablica_naglowkow;
        }

        $wartosc = iconv("cp1250", "UTF-8", $wiersz ['Pole' . $i . 'Wartosc']);
        if ($wartosc != NULL) {
            $tablica_wartosci[$n][] = $wartosc;
            //$tablica_danych[2] = $tablica_naglowkow;
        }
    }
/*
    if (count($tablica_naglowkow[$n]) == '0') {
        $zakladki = count($tablica_zakladek);
        unset($tablica_zakladek[$zakladki-1]);
    }
*/

//if ($zakladka == '') {

    $dane_menu[$n] = array(
        0 => count($tablica_naglowkow[$n]),
        1 => count($tablica_wartosci[$n]),
    );

//}
    $n++;

}

        // wyświetlanie zakładek

        $zakladki .= "<ul class='nav nav-tabs margin_t_40 menu_zgloszen'>";
        for ($i = 0; $i < count($tablica_zakladek); $i++) {

            if($tablica_zakladek[$i] != NULL) {

                $zakladki .= "<li><a data-toggle='tab' id='#zakladka_" . $i . "' href='#zakladka_" . $i . "'>" . $tablica_zakladek[$i] . "</a></li>";
            }
        }
        $zakladki .= "</ul>";

        // wyświetlanie pól zakładek

        $tresc_zakladki = "<div class='tab-content tresc_zgloszen'>";

        for ($i = 0; $i < count($tablica_zakladek); $i++) {



            $tresc_zakladki .= "<div id='zakladka_" . $i . "' class='tab-pane fade'>";
            $tresc_zakladki .= "<div class='dane_zgloszenia'><table id='szczegoly_zgloszenia'>";
            for ($j = 0; $j < $dane_menu[$i][1]; $j++) {



                $tresc_zakladki .= "<tr>";
                $tresc_zakladki .= "<td class='nazwa_kolumny_inf'>" . $tablica_naglowkow[$i][$j] . "</td>";
                $tresc_zakladki .= "<td class='wartosc_kolumny_inf'>" . $tablica_wartosci[$i][$j] . "</td>";
                $tresc_zakladki .= "</tr>";

            }
            $tresc_zakladki .= "</table></div></div>";


        }
        $tresc_zakladki .= "</div>";





$dane = array (
    0 => $zakladki,
    1 => $tresc_zakladki,
    2 => $tablica_naglowkow,
    3 => $tablica_wartosci,
    4 => count($tablica_zakladek),
);

//echo json_encode ( $dane_menu[0][0] );

echo json_encode ( $dane );

?>


