<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');


class SzkoleniaTesty extends SzkoleniaMain{

    public function generujListePytan($kszkolenia_testy_id, $kbd){
        $rezultat = '';

        $lista_pytan = $kbd->pobierzDane('*', 'szkolenia_testy_pytania', 'szkolenia_testy_id = '.$kszkolenia_testy_id.' AND czy_usuniety = 0' , 'nr_kolejnosci ASC');

        if(!is_null($lista_pytan)){
                $rezultat .= '<div class="odtListaPytanLista" data-szkolenia_testy_id="'.$kszkolenia_testy_id.'">';
                $i = 0;
                    while($poj_lista_pytan = $lista_pytan->fetch_object()){
                        $rezultat .= $this->generujPytanieLista($poj_lista_pytan, $kbd, $i);
                        $i++;
                    }
                $rezultat .= '</div>';

        }else{
            $rezultat .= 'Brak dostepnych pytań...';
        }
        return $rezultat;
    }

    public function generujPytanieLista($kelement, $kbd, $ki){
        $pytanie = '';

        $pytanie_lista_odpowiedzi = $kbd->pobierzDane('*', 'szkolenia_testy_pytania_odpowiedzi', 'szkolenia_testy_pytania_id = '.$kelement->id.' AND czy_usuniety = 0');
        $szst_rodzaj = $kbd->pobierzDane('wartosc, id', 'szkolenia_slownik_testy_pytania_rodzaj', 'id = '.$kelement->szkolenia_slownik_testy_pytania_rodzaj_id.' AND czy_usuniety = 0');
        $szst_rodzaj = $szst_rodzaj->fetch_object();


        $pytanie .= '<div class="panel panel-default">';

            $pytanie .= '<div class="panel-heading listaPyanPanelHeading">';
                $pytanie .= '<div class=" '.(($szst_rodzaj->id == 2) ? 'ph_naglowek' : 'edytujPytanieWidokWysun ph_naglowek_c').'"><span class="badge float_l margin_r_10">'.$kelement->nr_kolejnosci.'</span>'.$kelement->tresc.'</div>';

                $pytanie .= '<i class="fa fa-trash float_r " aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?"  data-content="<button data-element_id=\''.$kelement->id.'\' data-reakcja=\'usun\' data-tabela=\'szkolenia_testy_pytania\'  type=\'button\' class=\'btn btn-danger usunPrzywrocElement margin_r_10 usunTak \'>TAK</button>"></i>';
                $pytanie .= '<i class="fa fa-pencil margin_r_5 float_r edytujPytanieWidokWysun" aria-hidden="true"></i>';

                $pytanie .= '<span class="badge float_r margin_r_5">'.mysqli_num_rows($pytanie_lista_odpowiedzi).'</span>';
                $pytanie .= '<span class="badge float_r margin_r_5">'.$szst_rodzaj->wartosc.'</span>';
                $pytanie .= '<div class="clear_b"></div>';
            $pytanie .= '</div>';

            /*Edytuj pytanie*/
            $pytanie .= '<div data-rodzic_klasa="odtEP_'.$ki.'" class="odtEdytujPytanie odtEP_'.$ki.' ukryj_widok">';
                $pytanie .= '<div class="odtDodajPytanieLewaKolumna "><input data-kolumna="nr_kolejnosci" type="text" class="nr_kolejnosci margin_b_10 prm wymagane" placeholder="Nr kolejności" value="'.$kelement->nr_kolejnosci.'">';
                $pytanie .= '<input data-kolumna="liczba_pkt" type="text" class="margin_b_0 prm wymagane liczba_pkt" placeholder="Liczba PKT" value="'.$kelement->liczba_pkt.'">';
                $pytanie .= '<div class="dropdown float_r szkolenieTestyRodzaj">';
                $pytanie .= '<button class="btn btn-default dropdown-toggle margin_t_0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
                $pytanie .= '<div data-kolumna="szkolenia_slownik_testy_pytania_rodzaj_id" value="'.$kelement->szkolenia_slownik_testy_pytania_rodzaj_id.'" class="attrValue dpUstawOpcjeNazwa prm wymagane float_l">'.$szst_rodzaj->wartosc.'</div>';
                $pytanie .= '<span class="caret"></span>';
                $pytanie .= '</button>';
                $pytanie .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                $szkoleaniaTestyRodzaje = $kbd->pobierzDane('*', 'szkolenia_slownik_testy_pytania_rodzaj', 'czy_usuniety = 0');
                if(!is_null($szkoleaniaTestyRodzaje)){
                    while($poj_szkoleaniaTestyRodzaje = $szkoleaniaTestyRodzaje->fetch_object()){
                        $pytanie .= '<li class="dpUstawOpcje" data-element_id="'.$poj_szkoleaniaTestyRodzaje->id.'">'.mb_ucfirst($poj_szkoleaniaTestyRodzaje->wartosc).'</li>';
                    }
                }
                $pytanie .= '</ul>';
                $pytanie .= '</div></div>';

                $pytanie .= '<textarea data-kolumna="tresc" class="odtTrescPytania float_r prm wymagane" placeholder="Treść...">'.$kelement->tresc.'</textarea>';
                $pytanie .= '<div class="clear_b"></div>';
                $pytanie .= '<button type="button" data-akcja="aktualizuj_pytanie" data-element_id="'.$kelement->id.'" data-tabela="szkolenia_testy_pytania" class="'.(($szst_rodzaj->id == 2) ? 'margin_b_10' : '' ).' btn btn-success zapiszZmianyTest">Zapisz zmiany</button>';
            $pytanie .= '</div>';

            /*-----------------------------------------------------------------------------------------------------*/
            if($szst_rodzaj->id != 2){
                $pytanie .= '<div class="panel-body ukryj_widok">';
                    $pytanie .= '<div class="pytanieListaOdpowiedzi">';
                        $pytanie .= '<table class="table table-striped margin_b_0">';
                            $pytanie .= '<thead>';
                                $pytanie .= '<tr>';
                                    $pytanie .= '<th class="col-md-8">Treść</th>';
                                    $pytanie .= '<th class="col-md-1">poprawna</th>';
                                    $pytanie .= '<th class="col-md-3">';

                                            $pytanie .= '<i class="fa fa-plus-square float_r margin_r_5 olpedWysun" aria-hidden="true"></i>';

                                    $pytanie .= '</th>';
                                $pytanie .= '</tr>';
                            $pytanie .= '</thead>';
                            $pytanie .= '<tbody>';
                                $pytanie .= '<tr class="olp_element_dodaj ukryj_widok olped_'.$ki.'">';
                                    $pytanie .= '<td class="col-md-8"><textarea class="prm wymagane" data-kolumna="tresc" placeholder="Treść odpowiedzi..."></textarea></td>';
                                    $pytanie .= '<td class="col-md-1"><i class="prm wymagane attrValue olpElPojPoprawna fa fa-square-o" aria-hidden="true" data-kolumna="poprawna" value="0"></i></td>';
                                    $pytanie .= '<td class="col-md-3" data-rodzic_klasa="olped_'.$ki.'">';
                                        $pytanie .= '<input type="text" class="ukryj_widok prm wymagane" disabled data-kolumna="szkolenia_testy_pytania_id" value="'.$kelement->id.'"/>';
                                        $pytanie .= '<button type="button" data-akcja="dodaj_odpowiedz" data-tabela="szkolenia_testy_pytania_odpowiedzi" class="btn btn-success dodajOdpowiedzDoPytania margin_b_10">Dodaj odpowiedz</button>';

                                    $pytanie .= '</td>';
                                $pytanie .= '</tr>';
                                if(!is_null($pytanie_lista_odpowiedzi)){
                                    $j = 0;
                                    while($poj_pytanie_lista_odpowiedzi = $pytanie_lista_odpowiedzi->fetch_object()){
                                        $pytanie .= $this->generujOdpowiedziListaPytan($poj_pytanie_lista_odpowiedzi, $j);

                                        $j++;
                                    }
                                }
                            $pytanie .= '</tbody>';
                        $pytanie .= '</table>';
                    $pytanie .= '</div>';
                $pytanie .= '</div>';
            }
        $pytanie .= '</div>';

        return $pytanie;

    }

    public function generujOdpowiedziListaPytan($kodpowiedz, $kj){
        $odpowiedz = '';

        $odpowiedz .= '<tr class="olpElementPojedynczy olp_element_'.$kodpowiedz->id.$kj.'">';
            $odpowiedz .= '<td class="col-md-8"><textarea class="prm wymagane" data-kolumna="tresc">'.$kodpowiedz->tresc.'</textarea></td>';
            $odpowiedz .= '<td class="col-md-1"><i data-kolumna="poprawna" class="prm wymagane attrValue olpElPojPoprawna fa fa'.(($kodpowiedz->poprawna == 1) ? '-check' : '' ).'-square-o" value="'.$kodpowiedz->poprawna.'" aria-hidden="true"></i></td>';
            $odpowiedz .= '<td class="col-md-3"  data-rodzic_klasa="olp_element_'.$kodpowiedz->id.$kj.'">';
                $odpowiedz .= '<i class="fa fa-floppy-o float_r pytanieZapiszZmiany zapiszZmianyTest" data-element_id="'.$kodpowiedz->id.'" data-tabela="szkolenia_testy_pytania_odpowiedzi" data-akcja="aktualizuj_odpowiedz" aria-hidden="true"></i>';
                $odpowiedz .= '<i class="fa fa-trash float_r margin_r_5" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?"  data-content="<button data-element_id=\''.$kodpowiedz->id.'\' data-reakcja=\'usun\' data-tabela=\'szkolenia_testy_pytania_odpowiedzi\'  type=\'button\' class=\'btn btn-danger usunPrzywrocElement margin_r_10 usunTak \'>TAK</button>"></i>';

            $odpowiedz .= '</td>';
        $odpowiedz .= '</tr>';

        return $odpowiedz;
    }

    public function generujTestDoRozwiazania($ktest, $probaid, $kbd){
        $losuj_pytania = $ktest->losuj_pytania;

        if($losuj_pytania == 0){
            $lista_aktywnych_pytan = $kbd->pobierzDane('id', 'szkolenia_testy_pytania', 'szkolenia_testy_id = '.$ktest->id.' AND czy_usuniety = 0', 'nr_kolejnosci ASC');
            while($poj_lista_aktywnych_pytan = $lista_aktywnych_pytan->fetch_object()){
                $dane_tmp = array(
                    'uzytkownik_id' => $_SESSION['uzytkownik_id']
                    ,'szkolenia_testy_id_uzytkownik_id' => $probaid
                    ,'szkolenia_testy_pytania_id' => $poj_lista_aktywnych_pytan->id
                );

                $kbd->wstawDane('szkolenia_testy_wygenerowane_pytania', $dane_tmp);
            }
        }else{
            $lista_aktywnych_pytan = $kbd->pobierzDane('id', 'szkolenia_testy_pytania', 'szkolenia_testy_id = '.$ktest->id.' AND czy_usuniety = 0');
            $listaPytanAktywnychhArray = array();
            $lapi = 0;

            while($poj_lista_aktywnych_pytan = $lista_aktywnych_pytan->fetch_object()){
                $listaPytanAktywnychhArray[$lapi] = $poj_lista_aktywnych_pytan->id;
                $lapi++;

            }

            $listaPytanWylosowanychArray = parent::wylosujLiczbyZakres(mysqli_num_rows($lista_aktywnych_pytan),$losuj_pytania);

            for($i=0;$i<count($listaPytanWylosowanychArray);$i++){
                $dane_tmp = array(
                    'uzytkownik_id' => $_SESSION['uzytkownik_id']
                    ,'szkolenia_testy_id_uzytkownik_id' => $probaid
                    ,'szkolenia_testy_pytania_id' => $listaPytanAktywnychhArray[$listaPytanWylosowanychArray[$i]]
                );

                $kbd->wstawDane('szkolenia_testy_wygenerowane_pytania', $dane_tmp);
            }

        }
    }

    public function wyswietlTestDoRozwiazania($probaid, $kbd){
        $rezultat = '';

        $lista_pytan_testu = $kbd->pobierzDane('*', 'szkolenia_testy_wygenerowane_pytania', 'szkolenia_testy_id_uzytkownik_id = '.$probaid);

        $rezultat .= '<div class="testDoRozwiazaniaPytania">';
            $rezultat .= '<ul class="nav nav-tabs" role="tablist">';
                $j = 1;
                for($i=1;$i<(mysqli_num_rows($lista_pytan_testu)+1);$i++){
                    $rezultat .= '<li role="presentation" class=" '.(($i == 1) ? 'active' : '').' pytanie_'.($i).'"><a href="#pytanie_'.$i.'" aria-controls="pytanie_'.$i.'" role="tab" data-toggle="tab">'.$i.'</a></li>';
                    $j++;
                }
            $rezultat .= '<li role="presentation" class="ukryj_widok pytanie_'.($j).'"><a href="#pytanie_'.$j.'" aria-controls="pytanie_'.$j.'" role="tab" data-toggle="tab">'.$j.'</a></li>';

        $rezultat .= '</ul>';
            $rezultat .= '<div class="tab-content">';
                $i = 1;

                while($poj_lista_pytan_testu = $lista_pytan_testu->fetch_object()){
                    $pytanie_tmp = $kbd->pobierzDane('*', 'szkolenia_testy_pytania', 'id = '.$poj_lista_pytan_testu->szkolenia_testy_pytania_id);
                    $pytanie_tmp = $pytanie_tmp->fetch_object();

                    $rezultat .= '<div role="tabpanel" data-rodzic_klasa="parametry_'.$i.'" class="parametry_'.$i.' tab-pane '.(($i == 1) ? 'active' : '').'" id="pytanie_'.$i.'">';
                        $rezultat .= '<div class="well well-sm margin_b_10">'.$pytanie_tmp->tresc.'</div>';

                        if($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == 2) {
                            $rezultat .= '<textarea data-kolumna="odpowiedz_tresc" class="margin_b_10 prm ">'.$poj_lista_pytan_testu->odpowiedz_tresc.'</textarea>';
                        }else{
                            $lista_odpowiedzi_pytania = $kbd->pobierzDane('*', 'szkolenia_testy_pytania_odpowiedzi', 'szkolenia_testy_pytania_id = '.$pytanie_tmp->id.' AND czy_usuniety = 0');
                            if(!is_null($lista_odpowiedzi_pytania)){
                                $rezultat .= '<ul class="list-group">';
                                while($poj_lista_odpowiedzi_pytania = $lista_odpowiedzi_pytania->fetch_object()){
                                    if($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == '3'){
                                        $rezultat .= '<li data-kolumna="szkolenia_testy_pytania_odpowiedzi_id" value="'.$poj_lista_odpowiedzi_pytania->id.'" class="list-group-item '.(($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == '3') ? 'zaznaczOdpowiedzWiele' : 'zaznaczOdpowiedz' ).' '.((strpos($poj_lista_pytan_testu->szkolenia_testy_pytania_odpowiedzi_id, $poj_lista_odpowiedzi_pytania->id) !== false) ? 'prm' : '').'">'.$poj_lista_odpowiedzi_pytania->tresc.'</li>';
                                    }else{
                                        $rezultat .= '<li data-kolumna="szkolenia_testy_pytania_odpowiedzi_id" value="'.$poj_lista_odpowiedzi_pytania->id.'" class="list-group-item '.(($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == '3') ? 'zaznaczOdpowiedzWiele' : 'zaznaczOdpowiedz' ).' '.(($poj_lista_pytan_testu->szkolenia_testy_pytania_odpowiedzi_id == $poj_lista_odpowiedzi_pytania->id) ? 'prm' : '').'">'.$poj_lista_odpowiedzi_pytania->tresc.'</li>';
                                    }
                                }
                                $rezultat .= '</ul>';
                            }

                        }

                        $rezultat .= '<button type="button" data-pytanie_klasa="pytanie_'.($i+1).'" data-akcja="aktualizuj_odpowiedz_uzytkownika" data-tabela="szkolenia_testy_wygenerowane_pytania" data-proba_id="'.$probaid.'" data-element_id="'.$pytanie_tmp->id.'" class="'.(($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == '3') ? 'OdpowiedziWiele' : '' ).' btn btn-success width_100 zapiszOdpowiedzUzytkownika przejdzDalej">Zapisz i przejdź dalej</button>';

                    $rezultat .= '</div>';

                    $i++;
                }
                $rezultat .= '<div role="tabpanel" class ="tab-pane " id="pytanie_'.$i.'">';
                    $rezultat .= '<button type="button" data-akcja="aktualizuj_odpowiedz_uzytkownika" data-tabela="szkolenia_testy_wygenerowane_pytania" data-proba_id="'.$probaid.'" class="btn btn-success width_100 obliczWynikTestu">Oblicz wynik testu</button>';

                $rezultat .= '</div>';
            $rezultat .= '</div>';
        $rezultat .= '</div>';

        return $rezultat;

    }

    public function wyswietlTestDoOceny($probaid, $kbd){
        $rezultat = '';

        $lista_pytan_testu = $kbd->pobierzDane('*', 'szkolenia_testy_wygenerowane_pytania', 'szkolenia_testy_id_uzytkownik_id = '.$probaid);

        $rezultat .= '<div class="testDoSprawdzeniaPytania">';
            $rezultat .= '<ul class="nav nav-tabs" role="tablist">';
                $j = 1;
                while($poj_lista_pytan_testu = $lista_pytan_testu->fetch_object()) {
                    $pytanie_tmp = $kbd->pobierzDane('szkolenia_slownik_testy_pytania_rodzaj_id', 'szkolenia_testy_pytania', 'id = '.$poj_lista_pytan_testu->szkolenia_testy_pytania_id);
                    $pytanie_tmp = $pytanie_tmp->fetch_object();
                    $rezultat .= '<li role="presentation" class="'.(($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == '2') ? 'otwartePytanie' : '').' '.(($j == 1) ? 'active' : '').' pytanie_'.($j).'"><a href="#pytanie_'.$j.'" aria-controls="pytanie_'.$j.'" role="tab" data-toggle="tab">'.$j.'</a></li>';
                    $j++;
                }

            $rezultat .= '</ul>';
            $rezultat .= '<div class="tab-content">';
            $i = 1;

            $lista_pytan_testu = $kbd->pobierzDane('*', 'szkolenia_testy_wygenerowane_pytania', 'szkolenia_testy_id_uzytkownik_id = '.$probaid);

                while($poj_lista_pytan_testu = $lista_pytan_testu->fetch_object()){
                    $pytanie_tmp = $kbd->pobierzDane('*', 'szkolenia_testy_pytania', 'id = '.$poj_lista_pytan_testu->szkolenia_testy_pytania_id);
                    $pytanie_tmp = $pytanie_tmp->fetch_object();

                        $rezultat .= '<div role="tabpanel" data-rodzic_klasa="parametry_'.$i.'" class="parametry_'.$i.' tab-pane '.(($i == 1) ? 'active' : '').'" id="pytanie_'.$i.'">';
                            $rezultat .= '<div class="well well-sm margin_b_10">'.$pytanie_tmp->tresc.'</div>';

                            if($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == 2) {
                                $rezultat .= '<textarea data-kolumna="odpowiedz_tresc" class="margin_b_10 prm ">'.$poj_lista_pytan_testu->odpowiedz_tresc.'</textarea>';

                                $rezultat .= '<div class="ocenaZaPytanieOtwarte">';
                                    $rezultat .= '<input type="text" class="float_l ozpo_liczba_pkt" value="'.$poj_lista_pytan_testu->uzyskane_punkty.'"/>';
                                    $rezultat .= '<p class="float_l">/ '.$pytanie_tmp->liczba_pkt.'</p>';
                                    $rezultat .= '<button type="button" data-pytanie_klasa="pytanie_'.($i+1).'" data-akcja="ocen_odpowiedz_uzytkownika" data-tabela="szkolenia_testy_wygenerowane_pytania" data-proba_id="'.$probaid.'" data-element_id="'.$pytanie_tmp->id.'" class="btn btn-success float_r ocenOdpowiedzUzytkownika">Oceń</button>';
                                    $rezultat .= '<div class="clear_b"></div>';
                                $rezultat .= '</div>';
                            }else{
                                $lista_odpowiedzi_pytania = $kbd->pobierzDane('*', 'szkolenia_testy_pytania_odpowiedzi', 'szkolenia_testy_pytania_id = '.$pytanie_tmp->id.' AND czy_usuniety = 0');

                                $rezultat .= '<ul class="list-group margin_b_0">';
                                    while($poj_lista_odpowiedzi_pytania = $lista_odpowiedzi_pytania->fetch_object()){
                                        if($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == '3'){
                                            $rezultat .= '<li class="'.(($poj_lista_odpowiedzi_pytania->poprawna == 1) ? 'poprawna_odpowiedz' : '' ).' list-group-item '.((strpos($poj_lista_pytan_testu->szkolenia_testy_pytania_odpowiedzi_id, $poj_lista_odpowiedzi_pytania->id) !== false) ? 'zaznaczonaOdp' : '').'">'.$poj_lista_odpowiedzi_pytania->tresc.'</li>';
                                        }else{
                                            $rezultat .= '<li class="'.(($poj_lista_odpowiedzi_pytania->poprawna == 1) ? 'poprawna_odpowiedz' : '' ).' list-group-item '.(($poj_lista_pytan_testu->szkolenia_testy_pytania_odpowiedzi_id == $poj_lista_odpowiedzi_pytania->id) ? 'zaznaczonaOdp' : '').'">'.$poj_lista_odpowiedzi_pytania->tresc.'</li>';
                                        }
                                    }
                                $rezultat .= '</ul>';
                            }
                        $rezultat .= '</div>';
                        $i++;
                }

            $rezultat .= '</div>';
        $rezultat .= '</div>';

        return $rezultat;

    }

    public function aktualizujWynikTestu($kprobaId, $kbd, $kliczbaPytan = ''){

        $uzyskane_punkty = $kbd->pobierzDane('uzyskane_punkty, szkolenia_testy_pytania_id', 'szkolenia_testy_wygenerowane_pytania', 'szkolenia_testy_id_uzytkownik_id = '.$kprobaId);
        $uzyskane_punkty_suma = 0;
        $do_zdobycia_punkty = 0;
        $otwarte_pytanie = false;
        $wyslanaWiadomosc = 0;
        $wyslanaWiadomoscKomunikat = '';

        while($poj_uzyskane_punkty = $uzyskane_punkty->fetch_object()){
            $uzyskane_punkty_suma = $uzyskane_punkty_suma + $poj_uzyskane_punkty->uzyskane_punkty;

            $dozp_tmp = $kbd->pobierzDane('liczba_pkt, szkolenia_slownik_testy_pytania_rodzaj_id', 'szkolenia_testy_pytania', 'id = '.$poj_uzyskane_punkty->szkolenia_testy_pytania_id);
            $dozp_tmp = $dozp_tmp->fetch_object();

            if($dozp_tmp->szkolenia_slownik_testy_pytania_rodzaj_id == 2){
                $otwarte_pytanie = true;
            }

            $do_zdobycia_punkty = $do_zdobycia_punkty + $dozp_tmp->liczba_pkt;
        }

        $kbd->aktualizujDane('szkolenia_testy_id_uzytkownik_id', array( 'maksymalny_wynik' => $do_zdobycia_punkty), $kprobaId);

        if(!$otwarte_pytanie){
            $kbd->aktualizujDane('szkolenia_testy_id_uzytkownik_id', array( 'sprawdzony' => '1'), $kprobaId);
        }

        $procent_uzyskanych_punktow = floor(($uzyskane_punkty_suma/$do_zdobycia_punkty)*100);

        $test_id = $kbd->pobierzDane('szkolenia_testy_id, uzytkownik_id', 'szkolenia_testy_id_uzytkownik_id', 'id = '.$kprobaId);
        $test_id = $test_id->fetch_object();

        $test_prog = $kbd->pobierzDane('prog, nazwa, uzytkownik_id', 'szkolenia_testy', 'id = '.$test_id->szkolenia_testy_id);
        $test_prog = $test_prog->fetch_object();

        if($otwarte_pytanie){

            /*wyslanie wiadomosci do prowadzacego*/
            $trescMail = '';

            $organizator_tmp = $kbd->pobierzDane('email', 'uzytkownik', 'id = '.$test_prog->uzytkownik_id);
            $organizator_tmp = $organizator_tmp->fetch_object();

            $nadawca_tmp = $kbd->pobierzDane('imie, nazwisko, email', 'uzytkownik', 'id = '.$test_id->uzytkownik_id);
            $nadawca_tmp = $nadawca_tmp->fetch_object();

            if(is_null($kliczbaPytan)){
                $trescMail .= '<p>Zaloguj się do panelu i sprawdź wynik swojego testu!!!</p>';
                $komunikat = $this->wyslijWiadomoscEmail('[TEST - AKTUALIZACJA WYNIKU] '.$test_prog->nazwa, $trescMail, $nadawca_tmp->email, 'automat@votum-sa.pl', 'PANEL PRZEDSTAWICIELA');
                $wyslanaWiadomosc = 1;
                $wyslanaWiadomoscKomunikat = 'Wysłano maila do użytkownika o aktualnym wyniku testu!!!';
            }else{
                $trescMail .= '<p>Zaloguj się do panelu i oceń pytania otwarte!</p>';
                $trescMail .= '<p style="margin: 0 0 0 0;">ID: '.$kprobaId.'</p>';
                $trescMail .= '<p style="margin: 0 0 0 0;">Nazwa: '.$test_prog->nazwa.'</p>';
                $trescMail .= '<p style="margin: 0 0 0 0;">Osoba: '.$nadawca_tmp->imie.' '.$nadawca_tmp->nazwisko.'</p>';

                $komunikat = $this->wyslijWiadomoscEmail('[TEST DO SPRAWDZENIA] '.$test_prog->nazwa, $trescMail, $organizator_tmp->email, $nadawca_tmp->email, $nadawca_tmp->imie.' '.$nadawca_tmp->nazwisko);
                $wyslanaWiadomosc = 1;
                $wyslanaWiadomoscKomunikat = 'Przesłano informację do prowadzącego o teście do sprawdzenia!!!';
            }

            //var_dump($komunikat);

        }

        $zaliczony = 0;

        if($procent_uzyskanych_punktow >= $test_prog->prog){
            $zaliczony = 1;
        }

        return array(
                'zaliczony' => $zaliczony
                ,'procent_uzyskanych_punktow' => $procent_uzyskanych_punktow
                ,'wyslanaWiadomosc' => $wyslanaWiadomosc
                ,'wyslanaWiadomoscKomunikat' => $wyslanaWiadomoscKomunikat
        );
    }

    public function GenerujListeTestow($klista_testow, $ktytul, $kbd){
        $rezultat = '';

        $rezultat .= '<div class="panel panel-default">';
            $rezultat .= '<div class="panel-heading">'.$ktytul.'</div>';
            $rezultat .= '<div class="panel-body">';
                $rezultat .= '<table class="table tabela_lista_testow table-striped margin_b_0">';
                    $rezultat .= '<thead>';
                    $rezultat .= '<tr>';
                        $rezultat .= '<th class="">ID</th>';
                        $rezultat .= '<th class="col-md-2">Nazwa</th>';
                        $rezultat .= '<th class="col-md-1">Próba</th>';
                        $rezultat .= '<th class="col-md-2">Data</th>';
                        $rezultat .= '<th class="col-md-2">Imię</th>';
                        $rezultat .= '<th class="col-md-3">Nazwisko</th>';
                        $rezultat .= '<th class="col-md-1">Próg</th>';
                        $rezultat .= '<th class="col-md-1">Wynik</th>';
                        $rezultat .= '<th class="">';

                        $rezultat .= '</th>';
                    $rezultat .= '</tr>';
                    $rezultat .= '</thead>';
                    $rezultat .= '<tbody>';
                        if(!is_null($klista_testow)){
                            while($poj_klista_testow = $klista_testow->fetch_object()){
                                $nazwaTestu = $kbd->pobierzDane('nazwa, uzytkownik_id', 'szkolenia_testy', 'id = '.$poj_klista_testow->szkolenia_testy_id);
                                if(!$this->sprawdzUprawnienie('szkolenia_testy_sprawdz_wszystkie')){
                                    if($nazwaTestu->uzytkownik_id == $_SESSION['uzytkownik_id']){
                                        $rezultat .= '<tr class="cursor_p wyswietlTestDoOceny" data-rodzaj="wczytaj_dane" data-akcja="wyswietl_test_do_oceny" data-tabela="szkolenia_testy_id_uzytkownik_id" data-element_id="'.$poj_klista_testow->id.'">';
                                            $rezultat .= '<td class="">'.$poj_klista_testow->id.'</td>';

                                            $nazwaTestu = $nazwaTestu->fetch_object();
                                                $rezultat .= '<td class="col-md-2">'.$nazwaTestu->nazwa.'</td>';
                                            $rezultat .= '<td class="col-md-1">'.$poj_klista_testow->proba_nr.'</td>';
                                            $rezultat .= '<td class="col-md-2">'.$poj_klista_testow->start.'</td>';
                                            $uzytkownik = $kbd->pobierzDane('imie, nazwisko', 'uzytkownik', 'id = '.$poj_klista_testow->uzytkownik_id);
                                            $uzytkownik = $uzytkownik->fetch_object();
                                                $rezultat .= '<td class="col-md-2">'.$uzytkownik->imie.'</td>';
                                                $rezultat .= '<td class="col-md-3">'.$uzytkownik->nazwisko.'</td>';
                                            $test = $kbd->pobierzDane('prog', 'szkolenia_testy', 'id = '.$poj_klista_testow->szkolenia_testy_id);
                                            $test = $test->fetch_object();
                                                $rezultat .= '<td class="col-md-1">'.$test->prog.'%</td>';
                                            $rezultat .= '<td class="col-md-1">'.$poj_klista_testow->uzyskany_wynik.'%</td>';
                                            $rezultat .= '<td class="">';
                                                $rezultat .= '<i class="fa fa-eye float_r wyswietlTestDoOceny" data-rodzaj="wczytaj_dane" data-akcja="wyswietl_test_do_oceny" data-tabela="szkolenia_testy_id_uzytkownik_id" data-element_id="'.$poj_klista_testow->id.'" aria-hidden="true"></i>';

                                            $rezultat .= '</td>';
                                        $rezultat .= '</tr>';
                                    }
                                }else{
                                    $rezultat .= '<tr class="cursor_p wyswietlTestDoOceny" data-rodzaj="wczytaj_dane" data-akcja="wyswietl_test_do_oceny" data-tabela="szkolenia_testy_id_uzytkownik_id" data-element_id="'.$poj_klista_testow->id.'">';
                                        $rezultat .= '<td class="">'.$poj_klista_testow->id.'</td>';

                                        $nazwaTestu = $nazwaTestu->fetch_object();
                                            $rezultat .= '<td class="col-md-2">'.$nazwaTestu->nazwa.'</td>';
                                        $rezultat .= '<td class="col-md-1">'.$poj_klista_testow->proba_nr.'</td>';
                                        $rezultat .= '<td class="col-md-2">'.$poj_klista_testow->start.'</td>';
                                        $uzytkownik = $kbd->pobierzDane('imie, nazwisko', 'uzytkownik', 'id = '.$poj_klista_testow->uzytkownik_id);
                                        $uzytkownik = $uzytkownik->fetch_object();
                                            $rezultat .= '<td class="col-md-2">'.$uzytkownik->imie.'</td>';
                                            $rezultat .= '<td class="col-md-3">'.$uzytkownik->nazwisko.'</td>';
                                        $test = $kbd->pobierzDane('prog', 'szkolenia_testy', 'id = '.$poj_klista_testow->szkolenia_testy_id);
                                        $test = $test->fetch_object();
                                            $rezultat .= '<td class="col-md-1">'.$test->prog.'%</td>';
                                            $rezultat .= '<td class="col-md-1">'.$poj_klista_testow->uzyskany_wynik.'%</td>';
                                        $rezultat .= '<td class="">';
                                            $rezultat .= '<i class="fa fa-eye float_r wyswietlTestDoOceny" data-rodzaj="wczytaj_dane" data-akcja="wyswietl_test_do_oceny" data-tabela="szkolenia_testy_id_uzytkownik_id" data-element_id="'.$poj_klista_testow->id.'" aria-hidden="true"></i>';

                                        $rezultat .= '</td>';
                                    $rezultat .= '</tr>';
                                }

                            }
                        }

                    $rezultat .= '</tbody>';
                $rezultat .= '</table>';
            $rezultat .= '</div>';
        $rezultat .= '</div>';

        return $rezultat;
    }

}