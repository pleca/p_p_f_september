<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class DrukiWypelnione extends DrukiMain {

    public function generujListeDrukow($klista_drukow, $kbd, $ktytul){
        echo '<div class="panel panel-default margin_b_10">';
        echo '<div class="panel-heading">'.$ktytul.'</div>';
        echo '<div class="panel-body">';
        echo '<table class="table table-striped tabela_lista_drukow">';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="">ID</th>';
        echo '<th class="col-md-5">Typ Umowy</th>';
        echo '<th class="col-md-4">Klient</th>';
        echo '<th class="col-md-3">Data dodania</th>';
        echo '<th class=""></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        if(!is_null($klista_drukow)){
            while ($poj_klista_drukow = $klista_drukow->fetch_object()) {

                $umowa_typ_tmp = $kbd->pobierzDane('Wartosc, TabelaNazwa','umowaSlownikUmowaTyp','Id = '.$poj_klista_drukow->UmowaTypId);
                if(!is_null($umowa_typ_tmp)){
                    $umowa_typ_tmp = $umowa_typ_tmp->fetch_object();

                    $umowa_rodzaj_id_tmp = $kbd->pobierzDane('*',$umowa_typ_tmp->TabelaNazwa,'UmowaId = '.$poj_klista_drukow->Id);
                    $umowa_rodzaj_id_tmp = $umowa_rodzaj_id_tmp->fetch_object();

                    $kolumna_umowa_osoba = str_replace('umowa','',$umowa_typ_tmp->TabelaNazwa);

                    if($kolumna_umowa_osoba === 'Bankowa'){
                        $umowa_osoba_klient_id_tmp = $kbd->pobierzDane('OsobaId',$umowa_typ_tmp->TabelaNazwa.'Osoba',$kolumna_umowa_osoba.'Id = '.$umowa_rodzaj_id_tmp->Id.' AND NrKlienta = 1');
                        $nazwa_umowy = $umowa_typ_tmp->Wartosc;
                    } else if ($kolumna_umowa_osoba === 'Rzeczowa') {
                        $umowa_osoba_klient_id_tmp = $kbd->pobierzDane('OsobaId',$umowa_typ_tmp->TabelaNazwa.'Osoba',$kolumna_umowa_osoba.'Id = '.$umowa_rodzaj_id_tmp->Id.' AND OsobaTypId = 1 AND NrOsoby = 1');
                        $umowa_rzeczowa_nazwa_tmp = $kbd->pobierzDane('*','umowaSlownikUmowaRzeczowaTyp','Id = '.$umowa_rodzaj_id_tmp->UmowaRzeczowaTypId);
                        $umowa_rzeczowa_nazwa_tmp = $umowa_rzeczowa_nazwa_tmp->fetch_object();
                        $nazwa_umowy = $umowa_rzeczowa_nazwa_tmp->Wartosc;
                    } else if ($kolumna_umowa_osoba === 'Osobowa') {
                        $umowa_osoba_klient_id_tmp = $kbd->pobierzDane('OsobaId',$umowa_typ_tmp->TabelaNazwa.'Osoba',$kolumna_umowa_osoba.'Id = '.$umowa_rodzaj_id_tmp->Id);
                        $nazwa_umowy = $umowa_typ_tmp->Wartosc;
                    } else {
                        $umowa_osoba_klient_id_tmp = $kbd->pobierzDane('OsobaId', $umowa_typ_tmp->TabelaNazwa.'Osoba', $kolumna_umowa_osoba.'Id = '.$umowa_rodzaj_id_tmp->Id);
                        $nazwa_umowy = $umowa_typ_tmp->Wartosc;
                    }
                    if ($umowa_osoba_klient_id_tmp) {
                        $umowa_osoba_klient_id_tmp = $umowa_osoba_klient_id_tmp->fetch_object();
                        $umowa_osoba_klient_tmp = $kbd->pobierzDane('Imie, Nazwisko, Nazwa','umowaOsoba','Id = '.$umowa_osoba_klient_id_tmp->OsobaId);
                        $umowa_osoba_klient_tmp = $umowa_osoba_klient_tmp->fetch_object();

                        if ($umowa_osoba_klient_tmp->Nazwa == NULL) {
                            $dane_klienta = $umowa_osoba_klient_tmp->Imie.' '.$umowa_osoba_klient_tmp->Nazwisko;
                        } else {
                            $dane_klienta = $umowa_osoba_klient_tmp->Nazwa;
                        }

                    } else {
                        $dane_klienta = '';
                    }




                    echo '<tr data-element_id="'.$poj_klista_drukow->Id.'-'.$umowa_osoba_klient_id_tmp->OsobaId.'-'.$umowa_rodzaj_id_tmp->Id.'" data-tabela="umowa" data-akcja="szczeguly_umowy">';
                    echo '<td class=" szczeguly_umowy cursor_p">'.$poj_klista_drukow->Id.'</td>';
                    echo '<td class="col-md-5 szczeguly_umowy cursor_p">'.$nazwa_umowy.'</td>';
                    echo '<td class="col-md-4 szczeguly_umowy cursor_p">'.$dane_klienta.'</td>';
                    echo '<td class="col-md-3 szczeguly_umowy cursor_p">'.$poj_klista_drukow->DataUtworzenia.'</td>';
                    echo '<td class=""  data-element_id="'.$poj_klista_drukow->Id.'-'.$umowa_osoba_klient_id_tmp->OsobaId.'-'.$umowa_rodzaj_id_tmp->Id.'" data-tabela="umowa" data-akcja="szczeguly_umowy">';
                    echo '<i class="fa fa-eye szczeguly_umowy" aria-hidden="true"></i>';
                    if($this->sprawdzUprawnienie('druki_druki_historia')){
                        echo '<i data-element_id="'.$poj_klista_drukow->Id.'" data-tabela="umowa_historia_zmian" class="historiaWyswietl fa fa-calendar" aria-hidden="true"></i>';

                    }
                    echo '</td>';
                    echo '</tr>';
                    //echo $kolumna_umowa_osoba;
                }


            }
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
    }

}