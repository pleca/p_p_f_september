<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class ZarzadzanieKlientami extends DrukiMain {

    public function generujListeKlientow($klista_klientow, $kbd, $ktytul){
        echo '<div class="panel panel-default margin_b_10">';
            echo '<div class="panel-heading">'.$ktytul.'</div>';
                echo '<div class="panel-body">';
                    echo '<table class="table table-striped tabela_lista_klientow">';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th class="">ID</th>';
                                echo '<th class="col-md-4">Imie</th>';
                                echo '<th class="col-md-4">Nazwisko</th>';
                                echo '<th class="col-md-2">Pesel</th>';
                                echo '<th class="col-md-2">Telefon</th>';
                                echo '<th class=""></th>';
                            echo '</tr>';
                        echo '</thead>';
                      /*  echo '<tfoot>';
                            echo '<tr>';
                                echo '<th class="">ID</th>';
                                echo '<th class="col-md-4">Imie</th>';
                                echo '<th class="col-md-4">Nazwisko</th>';
                                echo '<th class="col-md-2">Pesel</th>';
                                echo '<th class="col-md-2">Telefon</th>';
                                echo '<th class=""></th>';
                            echo '</tr>';
                        echo '</tfoot>'; */
                    echo '<tbody>';
                    if(!is_null($klista_klientow)){
                        while ($poj_klista_klientow = $klista_klientow->fetch_object()) {
                            echo '<tr  data-element_id="'.$poj_klista_klientow->Id.'" data-tabela="umowaOsoba" data-akcja="edytuj_klienta">';
                                echo '<td class="edytuj_klienta cursor_p">'.$poj_klista_klientow->Id.'</td>';
                                echo '<td class="col-md-4 edytuj_klienta cursor_p">'.$poj_klista_klientow->Imie.'</td>';
                                echo '<td class="col-md-4 edytuj_klienta cursor_p">'.$poj_klista_klientow->Nazwisko.'</td>';
                                echo '<td class="col-md-2 edytuj_klienta cursor_p">'.$poj_klista_klientow->Pesel.'</td>';
                                $przed_telefon_tmp = $kbd->pobierzDane('Telefon','umowaKontakt','Id = '.$poj_klista_klientow->KontaktId);
                                $przed_telefon_tmp = $przed_telefon_tmp->fetch_object();
                                echo '<td class="col-md-2 edytuj_klienta cursor_p">'.$przed_telefon_tmp->Telefon.'</td>';
                                echo '<td class="" data-element_id="'.$poj_klista_klientow->Id.'" data-tabela="umowaOsoba" data-akcja="edytuj_klienta">';
                                    echo '<i class="fa fa-eye edytuj_klienta" aria-hidden="true"></i>';
                                    if($this->sprawdzUprawnienie('druki_klient_historia')){
                                        echo '<i data-element_id="'.$poj_klista_klientow->Id.'" data-tabela="umowaOsoba_historia_zmian" class="historiaWyswietl fa fa-calendar" aria-hidden="true"></i>';
                                    }
                                echo '</td>';
                            echo '</tr>';
                        }
                    }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
        echo '</div>';
    }

}