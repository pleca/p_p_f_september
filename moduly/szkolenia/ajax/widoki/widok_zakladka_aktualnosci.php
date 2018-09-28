<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$bazaDanych = new main_BazaDanych();
$szkoleniaAktualnosci = new SzkoleniaAktualnosci($bazaDanych);

$lista_aktualnosci = $szkoleniaAktualnosci->wygenerujListeAktualnosci($_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id']);

if($szkoleniaAktualnosci->sprawdzUprawnienie('szkolenia_aktualnosci_dodaj')) {
    echo '<div class="panel panel-default margin_b_0" style="margin: 0 10px;"><div class="panel-heading"><i data-akcja="dodaj_aktualnosc" data-rodzaj="dodaj_nowy" class="float_r fa fa-plus dodaj_element_szkolenia" aria-hidden="true"></i><div class="clear_b"></div></div></div>';
}

if(count($lista_aktualnosci) !== 0){
	$i = 0;
	echo '<div class="lista_aktualnosci">';
        foreach($lista_aktualnosci as $wartosc){
            $aktualnosc_tmp = $bazaDanych->pobierzDane('*','szkolenia_aktualnosci','id = '.$wartosc);
            $aktualnosc_tmp = $aktualnosc_tmp->fetch_object();

            $szkoleniaAktualnosci->generujAktualnosc($i, $aktualnosc_tmp->id, $aktualnosc_tmp->miniatura, $aktualnosc_tmp->tytul, $aktualnosc_tmp->tresc, $aktualnosc_tmp->zajawka, $aktualnosc_tmp->uzytkownik_id);
            $i++;
        }
        echo '<div class="clear_b"></div>';
    echo '</div>';

    echo '<div class="la_1 lak float_l"></div>';
    echo '<div class="la_2 lak float_l"></div>';
    echo '<div class="la_3 lak float_l"></div>';

    echo '<div class="clear_b"></div>';
}else{
	echo '<p class="margin_t_10 margin_l_10">Brak nowych wiadomości...</p>';

}




