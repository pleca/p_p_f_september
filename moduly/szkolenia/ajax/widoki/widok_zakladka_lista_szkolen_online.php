<?php 

    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
    $szkoleniaLista = new SzkoleniaLista();

    if($szkoleniaLista->sprawdzUprawnienie('szkolenia_dodaj')) {
        echo '<div class="panel panel-default margin_b_10" ><div class="panel-heading"><i data-akcja="dodaj_szkolenie" data-rodzaj="dodaj_nowy" class="float_r fa fa-plus dodaj_element_szkolenia" aria-hidden="true"></i><div class="clear_b"></div></div></div>';
    }

    $ile_szkolen = $bazaDanych->pobierzDane('id', 'szkolenia', 'czy_usuniety = 0 AND szkolenia_slownik_rodzaj_id = 1');

    if(!is_null($ile_szkolen)){
        $lista_typow_szkolen = $bazaDanych->pobierzDane('id, wartosc', 'szkolenia_slownik_status', 'czy_usuniety = 0');

        while ($poj_lista_typow_szkolen = $lista_typow_szkolen->fetch_object()) {
            if($szkoleniaLista->sprawdzUprawnienie('szkolenia_dodaj')) {
                $szkoleniaLista->generujListeSzkolen($poj_lista_typow_szkolen->id, $poj_lista_typow_szkolen->wartosc, $bazaDanych, 1);
            }else{
                if($poj_lista_typow_szkolen->id != 4){
                    $szkoleniaLista->generujListeSzkolen($poj_lista_typow_szkolen->id, $poj_lista_typow_szkolen->wartosc, $bazaDanych, 1);
                }
            }

        }
    }else{
        echo '<p class="margin_t_10 ">Brak nowych szkoleń...</p>';
    }

