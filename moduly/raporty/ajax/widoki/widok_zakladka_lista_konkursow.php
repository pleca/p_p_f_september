<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
    $konkursyMain = new KonkursyMain($bazaDanych);

    if($konkursyMain->sprawdzUprawnienie('konkurs_dodaj')) {
        echo '<div class="col-md-12 dodajKonkursNowy margin_b_10"><div class="panel panel-default "><div class="panel_naglowek"><i class="float_r fa fa-plus dodaj_konkurs" aria-hidden="true"></i><div class="clear_b"></div></div></div></div>';
    }

    $listaKonkursow = $konkursyMain->wygenerujListeKonkursow($_SESSION['uzytkownik_id'],$_SESSION['uzytkownik_grupa_id']);

    if(count($listaKonkursow) === 0){
        echo '<div class="col-md-12 "><div class="alert alert-danger width_100 margin_b_0" role="alert">'.ERROR_EMPTY_DATA.'</div></div>';
    }else{
        echo '<div class="listaKonkursow">';
            foreach($listaKonkursow as $konkursId){
                $konkursyMain->wygenerujMiniatureKonkursu($konkursId);
            }
        echo '</div>';
    }




