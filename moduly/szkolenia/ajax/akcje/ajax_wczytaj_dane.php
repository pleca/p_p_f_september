<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

    $szkoleniaMain = new SzkoleniaMain();
    $szkoleniaLista = new SzkoleniaLista();
    $szkoleniaTesty = new SzkoleniaTesty();

    $akcja = htmlspecialchars($_POST['akcja']);

    if($akcja == 'historia_wyswietl') {
        $tabela = htmlspecialchars($_POST['tabela']);
        $id = htmlspecialchars($_POST['id']);

        $tabela = explode('-',$tabela);

        $tytul = 'Historia elementu';
        $tresc = $szkoleniaMain->generujZakladkeHistoria($tabela[0], $tabela[1], $bazaDanych, $id);

        $dane = array(
                0 => 1
                ,'miniatura' => ''
                ,'tytul' => $tytul
                ,'tresc' => $tresc
        );

        echo json_encode($dane);
        return;
    }

    if($akcja !== 'lista_szkolen' ){
        if($akcja !== 'lista_szkolen_kalendarz'){
            if($akcja !== 'lista_pytan') {
                $tabela = htmlspecialchars($_POST['tabela']);
                $id = htmlspecialchars($_POST['id']);

                $element = $bazaDanych->pobierzDane('*', $tabela, 'id = ' . $id);

                if (!empty($element)) {
                    $element = $element->fetch_object();
                } else {
                    $dane = array(
                        0 => 0
                        , 1 => 'Brak danych w bazie!!!'
                    );
                    echo json_encode($dane);
                    return;
                }

                $miniatura = '';
                $tytul = '';
                $tresc = '';
            }
        }


    }

    $i = 0;

    switch ($akcja) {
        case 'wyswietl_aktualnosc':
            if (!empty($element->miniatura)) {
                $miniatura = $szkoleniaMain->pobierzMiniature('aktualnosci', $id, $element->miniatura);
            }
            $tytul = $element->tytul;
            $tresc = htmlspecialchars_decode($element->tresc);

            if(isset($element->szkolenie_id)) {
                $tresc .= '<div class="text-center margin_t_20"><button type="button" data-akcja="zapisz_do_szkolenia" data-szkolenia_id="' . $element->szkolenie_id . '" data-tabela="szkolenia_id_uzytkownik_id" class="btn btn-success zapiszUsunDoSzkolenia">Zapisz się na szkolenie</button></div>';
            }


            break;

        case 'edytuj_aktualnosc':
            $tytul = '';
            if($szkoleniaMain->sprawdzUprawnienie('szkolenia_aktualnosci_usun')){
                $tytul .= '<i class="fa fa-trash" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$id.'\' data-reakcja=\'usun\' data-tabela=\'szkolenia_aktualnosci\' type=\'button\' class=\'btn btn-danger usunPrzywrocElement usunTak usunAktualnosc\'>TAK</button>"></i>';
            }
            $tytul .= 'Edycja aktualności';
            $tresc = $szkoleniaMain->wczytajWidok('/var/www/html/moduly/szkolenia/ajax/widoki/elementy/widok_edytuj_aktualnosc.php',array(
                'element' => $element
                ,'id' => $id
            ));

            break;

        case 'wyswietl_szkolenie':
            $zapisany = $bazaDanych->pobierzDane('szkolenia_id', 'szkolenia_id_uzytkownik_id', 'uzytkownik_id = ' . $_SESSION['uzytkownik_id'] . ' AND szkolenia_id = ' . $id);

            $organizator_tmp = $bazaDanych->pobierzDane('imie, nazwisko', 'uzytkownik', 'id = '.$element->uzytkownik_id);
            $organizator_tmp = $organizator_tmp->fetch_object();

            $tytul = '<i class="fa fa-envelope-o " aria-hidden="true" title="Wyślij wiadomość do organizatora" data-placement="bottom" data-toggle="popover" data-html="true" data-content="<textarea disabled class=\'wyslijWiadomoscDoOrganizatoraNazwa\'>Do: '.$organizator_tmp->imie.' '.$organizator_tmp->nazwisko.'</textarea><textarea disabled class=\'ukryj_widok wyslijWiadomoscDoOrganizatoraTemat\' >[ZAPYTANIE DO SZKOLENIA] ' . $szkoleniaMain->utnijSlowa($element->nazwa) . '</textarea><textarea class=\'wyslijWiadomoscDoOrganizatoraTresc\' placeholder=\'Treść wiadomości...\'></textarea><button data-element_id=\''.$element->id.'\' type=\'button\' class=\'btn btn-success wyslijWiadomosc wyslijWiadomoscDoOrganizatora\'>WYŚLIJ</button>"></i> Informacje ogólne';

            $tresc .= '<div class="oknoSzkolenia '.((!is_null($zapisany)) ? 'zapisany' : '').'">';
                $tresc .= '<div class="oknoSzkoleniaDane">';
                    $tresc .= '<div class="oszNazwa"><div class="well well-sm">' . $element->nazwa . '</div></div>';
                    $tresc .= '<div class="oszOpis"><div class="well well-sm">' . htmlspecialchars_decode($element->opis) . '</div></div>';
                        if ($element->szkolenia_slownik_status_id == 1 || !is_null($zapisany)){
                            $tresc .= '<div class="oszPlan">';
                                if(is_null($zapisany)){
                                    $tresc .= '<div class="well well-sm">';
                                        $tresc .= $szkoleniaMain->generujPlanSzkolenia($id, $bazaDanych);
                                    $tresc .= '</div>';
                                }else{
                                    $tresc .= '<div class="panel panel-default margin_b_10">';
                                        $tresc .= '<div class="panel-heading">Plan szkolenia</div>';
                                        $tresc .= '<div class="panel-body">';
                                            $tresc .= $szkoleniaMain->generujPlanSzkolenia($id, $bazaDanych, false, $zapisany);
                                        $tresc .= '</div>';
                                    $tresc .= '</div>';

                                }
                            $tresc .= '</div>';
                        }
                    $tresc .= '<div class="oszTermin">';
                        $tresc .= '<div class="well well-sm">';
                            $tresc .= '<div>Rozpoczęcie szkolenia: '.$element->data_start.'</div>';
                            $tresc .= '<div>Zakończenie szkolenia: '.$element->data_stop.'</div>';
                        $tresc .= '</div>';
                    $tresc .= '</div>';
                    if ($element->szkolenia_slownik_status_id == 2 && $element->uzytkownik_id != $_SESSION['uzytkownik_id']){
                        if(is_null($zapisany)){
                            if(!$szkoleniaMain->sprawdzUprawnienie('szkolenia_edytuj')) {
                                $tresc .= '<button type="button" data-akcja="zapisz_do_szkolenia" data-szkolenia_id="' . $id . '" data-tabela="szkolenia_id_uzytkownik_id" class="btn btn-success zapiszUsunDoSzkolenia">Zapisz się na szkolenie</button>';
                            }
                        }
                    }
                $tresc .= '</div>';
                if(!is_null($zapisany) || $szkoleniaMain->sprawdzUprawnienie('szkolenia_lista_obecnosci')){
                    $tresc .= '<div class="oknoSzkoleniaUczestnicy">';
                        $tresc .= '<div class="panel panel-default margin_b_0 margin_t_10">';
                            $liczba_zapisanych = $bazaDanych->pobierzDane('uzytkownik_id', 'szkolenia_id_uzytkownik_id', 'szkolenia_id = '.$id);
                            $tresc .= '<div class="panel-heading">Lista uczestników';
                                if(mysqli_num_rows($liczba_zapisanych) != 0) {
                                    if($szkoleniaMain->sprawdzUprawnienie('szkolenia_wyslij_mailing_do_uczestnikow')){
                                        $tresc .= '<i class="float_l fa fa-envelope-open-o wyslijWiadomoscDoWszystkichUczestnikow" data-element_id="' . $id . '" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Wyślij wiadomość do wszystkich uczestników"></i>';
                                    }
                                }
                                $tresc .= '<span class="badge">'.((mysqli_num_rows($liczba_zapisanych) == 0) ? '0': mysqli_num_rows($liczba_zapisanych)).'/'.$element->liczba_miejsc.'</span>';
                                if($szkoleniaMain->sprawdzUprawnienie('szkolenia_lista_obecnosci') && mysqli_num_rows($liczba_zapisanych) != 0) {
                                    $tresc .= '<a target="_blank" href="https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkolenia/listaObecnosci?id=' . $id . '"><i data-toggle="tooltip" data-placement="top" title="Generuj liste obecności" data-element_id="' . $id . '" class="generujListeObecnosci fa float_l margin_r_5 fa-file-text-o" aria-hidden="true"></i></a>';
                                }

                            $tresc .= '</div>';
                            $tresc .= '<div class="panel-body">';
                                $tresc .= $szkoleniaMain->pobierzListeUczestnikow($id, $bazaDanych);
                            $tresc .= '</div>';
                        $tresc .= '</div>';
                    $tresc .= '</div>';
                }
                $tresc .= '<div class="clear_b"></div>';
            $tresc .= '</div>';

            break;

        case 'lista_szkolen':

                $lista_szkolen = $bazaDanych->pobierzDane('*', 'szkolenia', 'czy_usuniety = 0 AND (szkolenia_slownik_rodzaj_id = 2 OR szkolenia_slownik_rodzaj_id = 3)');

                if($lista_szkolen->num_rows != 0) {
                    while ($poj_lista_szkolen = $lista_szkolen->fetch_object()) {
                        $kolor = $bazaDanych->pobierzDane('kolor, kolor_teren, id', 'szkolenia_slownik_status', 'id = '.$poj_lista_szkolen->szkolenia_slownik_status_id);
                        $kolor = $kolor->fetch_object();

                        if($szkoleniaLista->sprawdzUprawnienie('szkolenia_dodaj')) {
                            $zapisany = $bazaDanych->pobierzDane('szkolenia_id', 'szkolenia_id_uzytkownik_id', 'uzytkownik_id = ' . $_SESSION['uzytkownik_id'] . ' AND szkolenia_id = ' . $poj_lista_szkolen->id);

                            $dane[$i] = array(
                                        'id' => $poj_lista_szkolen->id
                                        , 'title' => '<div class="fc-title_nazwa">'.$poj_lista_szkolen->nazwa.'</div>'
                                        , 'start' => $poj_lista_szkolen->data_start
                                        , 'end' => $poj_lista_szkolen->data_stop
                                        , 'backgroundColor' => 'rgb('.(($poj_lista_szkolen->szkolenia_slownik_rodzaj_id == 2) ? $kolor->kolor : $kolor->kolor_teren ).')'
                                        , 'className' => ((!is_null($zapisany)) ? 'zapisany' : '')
                                    );
                            $i++;
                        }else{
                            if($kolor->id != 4){
                                $zapisany = $bazaDanych->pobierzDane('szkolenia_id', 'szkolenia_id_uzytkownik_id', 'uzytkownik_id = ' . $_SESSION['uzytkownik_id'] . ' AND szkolenia_id = ' . $poj_lista_szkolen->id);

                                $dane[$i] = array(
                                            'id' => $poj_lista_szkolen->id
                                            , 'title' => '<div class="fc-title_nazwa">'.$poj_lista_szkolen->nazwa.'</div>'
                                            , 'start' => $poj_lista_szkolen->data_start
                                            , 'end' => $poj_lista_szkolen->data_stop
                                            , 'backgroundColor' => 'rgb('.(($poj_lista_szkolen->szkolenia_slownik_rodzaj_id == 2) ? $kolor->kolor : $kolor->kolor_teren ).')'
                                            , 'className' => ((!is_null($zapisany)) ? 'zapisany' : '')
                                    );
                                $i++;
                            }
                        }


                    }
                }

                echo json_encode($dane);
                return;

            break;

        case 'lista_szkolen_kalendarz':
                echo '<div class="margin_b_20"></div>';

                $lista_typow_szkolen = $bazaDanych->pobierzDane('id, wartosc', 'szkolenia_slownik_status', 'czy_usuniety = 0');

                while ($poj_lista_typow_szkolen = $lista_typow_szkolen->fetch_object()) {
                    if($szkoleniaLista->sprawdzUprawnienie('szkolenia_dodaj')) {
                        $szkoleniaLista->generujListeSzkolen($poj_lista_typow_szkolen->id, $poj_lista_typow_szkolen->wartosc, $bazaDanych, 2, true);
                    }else{
                        if($poj_lista_typow_szkolen->id != 4){
                            $szkoleniaLista->generujListeSzkolen($poj_lista_typow_szkolen->id, $poj_lista_typow_szkolen->wartosc, $bazaDanych, 2, true);
                        }
                    }


                }




                return;

            break;

        case 'edytuj_szkolenie':
                $tytul = '';
                if($szkoleniaMain->sprawdzUprawnienie('szkolenia_usun')){
                    $tytul .= '<i class="fa fa-trash" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-tabela=\'szkolenia\' data-reakcja=\'usun\' data-element_id=\''.$element->id.'\' type=\'button\' class=\'btn btn-danger usunTak usunSzkolenie usunPrzywrocElement\'>TAK</button>"></i>';
                }
                $tytul .= 'Edycja szkolenia';

                $tresc .= '<div class="oknoEdycjiSzkolenia">';
                    $tresc .= '<ul class="nav nav-tabs" role="tablist">';
                        $tresc .= '<li role="presentation" class="active oeszOgolne"><a href="#oeszOgolne" aria-controls="oeszOgolne" role="tab" data-toggle="tab">Ogólne</a></li>';
                        $tresc .= '<li role="presentation" class=" oeszMaterialy"><a href="#oeszMaterialy" aria-controls="oeszMaterialy" role="tab" data-toggle="tab">Materiały</a></li>';
                        $tresc .= '<li role="presentation" class=" oeszUczestnicy"><a href="#oeszUczestnicy" aria-controls="oeszUczestnicy" role="tab" data-toggle="tab">Uczestnicy</a></li>';
                    $tresc .= '</ul>';

                    $tresc .= '<div class="tab-content">';
                        $tresc .= '<div role="tabpanel" data-rodzic_klasa="oeszOgolne" class="tab-pane active oeszOgolne" id="oeszOgolne">';
                            $tresc .= '<div class="form-inline margin_b_10">';
                                $tresc .= '<input data-kolumna="liczba_miejsc" placeholder="Liczba miejsc" class="text-center oeszLiczbaMiejsc wymagane prm inputEdycja" type="text" value="' . $element->liczba_miejsc . '"/>';
                                $data_start = explode(' ', $element->data_start);
                                    $tresc .= '<input data-kolumna="data_start" placeholder="Data rozpoczęcia" class="dateTimePicker prm wymagane oeszDataOd inputEdycja text-center" type="text" value="' . $element->data_start . '"/>';
                                $data_stop = explode(' ', $element->data_stop);
                                    $tresc .= '<input data-kolumna="data_stop" placeholder="Data zakończenia" class="dateTimePicker prm wymagane oeszDataDo inputEdycja text-center" type="text" value="' . $element->data_stop . '"/>';

                                    $tresc .= '<div class="dropdown float_r szkolenieStatus">';
                                    $tresc .= '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
                                        $statusWartosc = $bazaDanych->pobierzDane('wartosc, id', 'szkolenia_slownik_status', 'id = '.$element->szkolenia_slownik_status_id);
                                        $statusWartosc = $statusWartosc->fetch_object();
                                        $tresc .= '<div data-kolumna="szkolenia_slownik_status_id" value="'.$statusWartosc->id.'" class="attrValue dpUstawOpcjeNazwa prm wymagane float_l">'.mb_ucfirst($statusWartosc->wartosc).'</div>';
                                        $tresc .= '<span class="caret"></span>';
                                    $tresc .= '</button>';
                                    $tresc .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                        $szkoleaniaStatusy = $bazaDanych->pobierzDane('*', 'szkolenia_slownik_status', 'czy_usuniety = 0');
                                        if(!is_null($szkoleaniaStatusy)){
                                            while($poj_szkoleniaStatusy = $szkoleaniaStatusy->fetch_object()){
                                                $tresc .= '<li class="dpUstawOpcje" data-element_id="'.$poj_szkoleniaStatusy->id.'">'.mb_ucfirst($poj_szkoleniaStatusy->wartosc).'</li>';
                                            }
                                        }
                                    $tresc .= '</ul>';
                                $tresc .= '</div>';
                                $tresc .= '<div class="clear_b"></div>';
                            $tresc .= '</div>';
                            $tresc .= '<input data-kolumna="nazwa" class="oeszTytul float_l prm wymagane" placeholder="Nazwa szkolenia" type="text" value="' . $element->nazwa . '"/>';
                            $tresc .= '<div class="dropdown szkolenieTyp float_l">';
                                $tresc .= '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
                                $rodzajWartosc = $bazaDanych->pobierzDane('wartosc, id', 'szkolenia_slownik_rodzaj', 'id = '.$element->szkolenia_slownik_rodzaj_id);
                                $rodzajWartosc = $rodzajWartosc->fetch_object();
                                $tresc .= '<div data-kolumna="szkolenia_slownik_rodzaj_id" value="'.$rodzajWartosc->id.'" class="attrValue dpUstawOpcjeNazwa prm wymagane float_l">'.mb_ucfirst($rodzajWartosc->wartosc).'</div>';
                                $tresc .= '<span class="caret"></span>';
                                $tresc .= '</button>';
                                $tresc .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                $szkoleniaRodzaje = $bazaDanych->pobierzDane('*', 'szkolenia_slownik_rodzaj', 'czy_usuniety = 0');
                                if(!is_null($szkoleniaRodzaje)){
                                    while($poj_szkoleniaRodzaje = $szkoleniaRodzaje->fetch_object()){
                                        $tresc .= '<li class="dpUstawOpcje TypSzkoleniaOpcja" data-element_id="'.$poj_szkoleniaRodzaje->id.'">'.mb_ucfirst($poj_szkoleniaRodzaje->wartosc).'</li>';
                                    }
                                }
                                $tresc .= '</ul>';
                                $tresc .= '</div>';

                            $tresc .= '<input ';
                            $tresc .= ($rodzajWartosc->id == 3) ? "" : "disabled";
                            $tresc .= ' data-kolumna="miejscowosc" placeholder="Miejscowość" class="prm szkolenieMiejsce inputEdycja float_l text-center margin_b_10" type="text" value="' . $element->miejscowosc . '"/>';
                            $tresc .= '<div class="clear_b"></div>';

                            $tresc .= '<textarea data-kolumna="opis" class="editor_prosty prm wymagane" name="editor" placeholder="Wprowadź opis...">' . htmlspecialchars_decode($element->opis) . '</textarea>';



                            $tresc .= '<button data-akcja="aktualizuj_szkolenie" data-element_id="'.$id.'" data-tabela="szkolenia" type="button" class="btn btn-success zapiszZmiany">Zapisz zmiany</button>';

                        $tresc .='</div>';
                        $tresc .= '<div role="tabpanel" class="tab-pane oeszMaterialy" id="oeszMaterialy">';
                            $tresc .= $szkoleniaMain->generujPlanSzkolenia($element->id, $bazaDanych, true);
                            //$tresc .= '<button data-akcja="dodaj_material" data-rodzaj="dodaj_nowy" type="button" class="btn btn-success dodaj_material">Dodaj materiał</button>';
                        $tresc .= '</div>';
                        $tresc .= '<div role="tabpanel" class="tab-pane oeszUczestnicy" id="oeszUczestnicy">';


                            $tresc .= $szkoleniaMain->pobierzListeUczestnikow($element->id, $bazaDanych, true);
                        $tresc .= '</div>';
                    $tresc .= '</div>';
                $tresc .= '</div>';

                break;

        case 'edytuj_material':

                $tytul = 'Edytuj materiał';

                $tresc .= '<div data-rodzic_klasa="oknoEdycjiMaterialu" class="oknoEdycji oknoEdycjiMaterialu">';
                    $tresc .= '<input class="prm ukryj_widok" disabled data-kolumna="szkolenia_id" type="text" value="'.$element->szkolenia_id.'"/>';
                     if($element->material_nadrzedny != 0){
                         $tresc .= '<input class="prm ukryj_widok" disabled data-kolumna="material_nadrzedny" type="text" value="'.$element->material_nadrzedny.'"/>';
                     }
                    $tresc .= '<div class="oemGrupaPola">';
                        $tresc .= '<input data-kolumna="nr_kolejnosci" placeholder="Nr kolejności" class=" prm wymagane float_l oeaNrKolejnosci " type="text" value="'.$element->nr_kolejnosci.'"/>';
                        $tresc .= '<input class="oeaTytul prm wymagane float_l" placeholder="Tytuł" data-kolumna="nazwa" type="text" value="'.$element->nazwa.'"/>';
                        $tresc .= '<div class="clear_b"></div>';
                    $tresc .= '</div>';

                    $tresc .= '<div class="przyciskUploagGrupa '.((!is_null($element->tresc)) ? 'ukryj_widok' : '').'">';
                        $tresc .= '<div class="'.((!is_null($element->plik)) ? 'przyciskUploadPodglad' : '' ).' float_l przyciskUpload btn btn-default margin_b_10"><span>'.((!is_null($element->plik)) ? $element->plik : 'Wybierz plik' ).'</span><input data-kolumna="plik" class="przyciskUploadPrzycisk "  type="file" name="miniatura"></div>';
                        $tresc .= '<i class="fa float_l fa-trash " aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\'\' data-reakcja=\'usun\' data-tabela=\'\' type=\'button\' class=\'btn btn-danger usunPlikPrzyciskUpload usunTak \'>TAK</button>"></i>';
                        if(!is_null($element->plik)){
                            $tresc .= '<a href="https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkolenia/wyswietlDokument?zakladka=materialy&id='.$element->id.'&nazwa='.$element->plik.'" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                        }
                        $tresc .= '<div class="clear_b"></div>';
                    $tresc .= '</div>';


                    $tresc .= '<textarea class="editor_prosty prm '.((!is_null($element->plik)) ? 'ukryj_widok' : '').'" data-kolumna="tresc" name="editor" placeholder="Wprowadź tekst..." >'.htmlspecialchars_decode($element->tresc).'</textarea>';
                    $tresc .= '<textarea class="zajawka  prm" data-kolumna="opis" placeholder="Opis..." >'.$element->opis.'</textarea>';
                    $tresc .= '<button type="button" data-akcja="aktualizuj_material" data-element_id="'.$id.'" data-tabela="szkolenia_materialy" class="btn btn-success zapiszZmiany">Zapisz zmiany</button>';
                $tresc .= '</div>';

            break;

        case 'wyswietl_material':
                $tytul = $element->nazwa;
                $tresc = htmlspecialchars_decode($element->tresc);

            break;

        case 'edytuj_test':
                $tytul = 'Edytuj test';

                $idElement = explode('-',$id);

                $testDane = $bazaDanych->pobierzDane('*', 'szkolenia_testy', 'id = '.$idElement[0]);
                $testDane = $testDane->fetch_object();

                $tresc .= '<div data-rodzic_klasa="oknoDodajTest" class="oknoEdycji oknoDodajTest">';
                    $tresc .= '<input class="prm ukryj_widok" disabled data-kolumna="szkolenia_id" type="text" value="'.$idElement[0].'"/>';
                    if(!empty($idElement[1])){
                        $tresc .= '<input class="prm ukryj_widok" disabled data-kolumna="material_nadrzedny" type="text" value="'.$idElement[1].'"/>';
                    }

                    $tresc .= '<ul class="nav nav-tabs" role="tablist">';
                        $tresc .= '<li role="presentation" class="active"><a href="#odtOgolne" aria-controls="odtOgolne" role="tab" data-toggle="tab">Ogólne</a></li>';
                        $tresc .= '<li role="presentation"><a href="#odtEdytorPytan" aria-controls="odtEdytorPytan" role="tab" data-toggle="tab">Edytor pytań</a></li>';
                    $tresc .= '</ul>';
                    $tresc .= '<div class="tab-content" >';
                        $tresc .= '<div role="tabpanel" class="tab-pane active odtOgolne" data-rodzic_klasa="odtOgolne" id="odtOgolne">';
                        $tresc .= '<div class="odtOgolneLewaKolumna">';
                            $tresc .= '<div class="oemGrupaPola">';
                                $tresc .= '<input data-kolumna="nr_kolejnosci" placeholder="Nr kolejności" class=" prm wymagane float_l oeaNrKolejnosci " type="text" value="'.$testDane->nr_kolejnosci.'"/>';
                                $tresc .= '<input class="oeaTytul prm wymagane float_l" placeholder="Tytuł" data-kolumna="nazwa" type="text" value="'.$testDane->nazwa.'"/>';
                                $tresc .= '<div class="clear_b"></div>';
                            $tresc .= '</div>';
                            $tresc .= '<textarea class="zajawka  prm" data-kolumna="opis" placeholder="Opis...">'.$testDane->opis.'</textarea>';
                        $tresc .= '</div>';
                        $tresc .= '<div class="odtOgolnePrawaKolumna">';
                            $tresc .= '<div class="form-group">';
                                $tresc .= '<label for="odtIlePytan" class="odtLabel ">Liczba pytań do wylosowania</label>';
                                $tresc .= '<input data-kolumna="losuj_pytania" type="text" class="prm wymagane odtIle" id="odtIlePytan" placeholder="Ile pytań?" value="'.$testDane->losuj_pytania.'">';
                            $tresc .= '</div>';
                            $tresc .= '<div class="form-group">';
                                $tresc .= '<label for="odtProg" class="odtLabel ">Liczba procent na zaliczenie</label>';
                                $tresc .= '<input data-kolumna="prog" type="text" class="prm wymagane odtIle" id="odtProg" placeholder="Ile %" value="'.$testDane->prog.'">';
                            $tresc .= '</div>';
                            $tresc .= '<div class="form-group">';
                                $tresc .= '<label for="odtIleProb" class="odtLabel ">Liczba dostępnych podejść</label>';
                                $tresc .= '<input data-kolumna="liczba_prob" type="text" class="prm wymagane odtIle" id="odtIleProb" placeholder="Ile prób?" value="'.$testDane->liczba_prob.'">';
                            $tresc .= '</div>';
                            $tresc .= '<div class="form-group">';
                                $tresc .= '<label for="odtIleCzasu" class="odtLabel ">Czas na rozwiązanie testu (min)</label>';
                                $tresc .= '<input data-kolumna="dostepny_czas" type="text" class="prm wymagane odtIle" id="odtIleCzasu" placeholder="Czas(min)" value="'.$testDane->dostepny_czas.'">';
                            $tresc .= '</div>';
                        $tresc .= '</div>';
                        $tresc .= '<div class="clear_b"></div>';
                        $tresc .= '<button type="button" data-akcja="aktualizuj_test" data-element_id="'.$idElement[0].'" data-tabela="szkolenia_testy" class="btn btn-success zapiszZmiany">Zapisz zmiany</button>';


                        $tresc .= '</div>';
                        $tresc .= '<div role="tabpanel" class="tab-pane" id="odtEdytorPytan">';

                            $tresc .= '<div class="panel panel-default margin_b_10"><div class="panel-heading"><i class="float_r fa fa-plus wyswietlDodajPytanie" aria-hidden="true"></i><div class="clear_b"></div></div></div>';

                                $tresc .= '<div data-rodzic_klasa="odtDodajPytanie" class="odtDodajPytanie ukryj_widok">';
                                    $tresc .= '<div class="odtDodajPytanieLewaKolumna "><input data-kolumna="nr_kolejnosci" type="text" class="nr_kolejnosci margin_b_10 prm wymagane" id="" placeholder="Nr kolejności" value="0">';
                                    $tresc .= '<input data-kolumna="liczba_pkt" type="text" class="margin_b_0 prm wymagane liczba_pkt" id="" placeholder="Liczba PKT" value="1">';
                                    $tresc .= '<div class="dropdown float_r szkolenieTestyRodzaj">';
                                        $tresc .= '<button class="btn btn-default dropdown-toggle margin_t_0" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
                                            $tresc .= '<div data-kolumna="szkolenia_slownik_testy_pytania_rodzaj_id" value="2" class="attrValue dpUstawOpcjeNazwa prm wymagane float_l">Otwarte</div>';
                                            $tresc .= '<span class="caret"></span>';
                                        $tresc .= '</button>';
                                        $tresc .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                            $szkoleaniaTestyRodzaje = $bazaDanych->pobierzDane('*', 'szkolenia_slownik_testy_pytania_rodzaj', 'czy_usuniety = 0');
                                            if(!is_null($szkoleaniaTestyRodzaje)){
                                                while($poj_szkoleaniaTestyRodzaje = $szkoleaniaTestyRodzaje->fetch_object()){
                                                    $tresc .= '<li class="dpUstawOpcje" data-element_id="'.$poj_szkoleaniaTestyRodzaje->id.'">'.mb_ucfirst($poj_szkoleaniaTestyRodzaje->wartosc).'</li>';
                                                }
                                            }
                                        $tresc .= '</ul>';
                                    $tresc .= '</div></div>';

                                    $tresc .= '<textarea data-kolumna="tresc" class="odtTrescPytania float_r prm wymagane" placeholder="Treść..."></textarea>';
                                    $tresc .= '<div class="clear_b"></div>';
                                    $tresc .= '<button type="button" data-akcja="dodaj_pytanie" data-element_id="'.$idElement[0].'" data-tabela="szkolenia_testy_pytania" class="btn btn-success zapiszZmianyTest margin_b_10">Dodaj pytanie</button>';
                                $tresc .= '</div>';

                                $tresc .= '<div id="odtListaPytan" class="odtListaPytan">';
                                    $tresc .= $szkoleniaTesty->generujListePytan($idElement[0], $bazaDanych);
                                $tresc .= '</div>';

                        $tresc .= '</div>';
                    $tresc .= '</div>';

                $tresc .= '</div>';

            break;

        case 'lista_pytan':
                $id = htmlspecialchars($_POST['id']);

                $dane = array(
                    'tresc' => $szkoleniaTesty->generujListePytan($id, $bazaDanych)

                );

                echo json_encode($dane);
                return;

            break;

        case 'wyswietl_test':

                $wynikOstatniaProba = 0;
                $statusOstatniegoTestu = 1;
                $test_UzytkownikNaBazie = $bazaDanych->pobierzDane('*', 'szkolenia_testy_id_uzytkownik_id', 'szkolenia_testy_id = '.$element->id.' AND uzytkownik_id = '.$_SESSION['uzytkownik_id'].' AND zakonczony = 0');

                if(!is_null($test_UzytkownikNaBazie)){
                    $test_UzytkownikNaBazie = $test_UzytkownikNaBazie->fetch_object();
                }

                $dzisiaj=date("Y-m-d H:i:s");
                $roznicaMinut = floor((( strtotime( $dzisiaj ) - strtotime( $test_UzytkownikNaBazie->start ) ) / 60));
                $roznicaSekund = (strtotime( $dzisiaj ) - strtotime( $test_UzytkownikNaBazie->start )) % 60;

                if($roznicaMinut < $element->dostepny_czas){
                    $tytul = ' Pozostały czas <span class="testMinuta">'.((($element->dostepny_czas-1)-$roznicaMinut).'</span>:<span class="testSekunda">'.(((60 - $roznicaSekund) < 10) ? '0'.(60 - $roznicaSekund) : 60 - $roznicaSekund )).'</span>';

                    $tresc .= $szkoleniaTesty->wyswietlTestDoRozwiazania($test_UzytkownikNaBazie->id, $bazaDanych);

                }else{

                    if(!is_null($test_UzytkownikNaBazie)) {
                        //$bazaDanych->aktualizujDane('szkolenia_testy_id_uzytkownik_id', array( 'zakonczony' => 1 ), $test_UzytkownikNaBazie->id);

                        $wynik = $szkoleniaTesty->aktualizujWynikTestu($test_UzytkownikNaBazie->id, $bazaDanych);

                        $wartosci = array(
                                    'uzyskany_wynik' => $wynik['procent_uzyskanych_punktow']
                                    , 'zakonczony' => 1
                                    , 'zaliczony' => $wynik['zaliczony']
                        );

                        $bazaDanych->aktualizujDane('szkolenia_testy_id_uzytkownik_id', $wartosci, $test_UzytkownikNaBazie->id);
                    }



                    $tytul = $element->nazwa;

                    $tresc .= '<div class="well well-sm margin_b_0">';
                        $tresc .= $element->opis;
                    $tresc .= '</div>';

                    $liczbaProb = $bazaDanych->pobierzDane('id', 'szkolenia_testy_id_uzytkownik_id', 'szkolenia_testy_id = '.$element->id.' AND uzytkownik_id = '.$_SESSION['uzytkownik_id']);

                    if(!is_null($liczbaProb)){
                        $liczbaProb = $element->liczba_prob - mysqli_num_rows($liczbaProb);
                    }else{
                        $liczbaProb = $element->liczba_prob;
                    }

                    $tresc .= '<div class="well well-sm szczegolyTestu margin_b_0 margin_t_10">';
                        $tresc .= '<div class="">Liczba procent na zaliczenie - '.$element->prog.' %</div>';
                        $tresc .= '<div class="">Pozostała liczba prób - '.$liczbaProb.'</div>';
                        $tresc .= '<div class="">Dostępny czas na rozwiązanie testu - '.$element->dostepny_czas.' min.</div>';
                    $tresc .= '</div>';

                    /*Ostatnia proba*/
                    $ostatnia_proba = $bazaDanych->pobierzDane('*', 'szkolenia_testy_id_uzytkownik_id', 'zakonczony = 1 AND szkolenia_testy_id = '.$element->id.' AND uzytkownik_id = '.$_SESSION['uzytkownik_id'], 'start ASC');

                    if(!is_null($ostatnia_proba)){
                        $tresc .= '<div class="testWyniki margin_t_15">';
                            while($poj_ostatnia_proba = $ostatnia_proba->fetch_object()){
                                $tresc .= '<div class="testPojedynczyWynik ">';
                                    if($poj_ostatnia_proba->sprawdzony == 1){
                                        if($poj_ostatnia_proba->zaliczony == 1){
                                            $klasaKolo = 'zielone';
                                            $statusTestu = 'Zaliczony';
                                        }else{
                                            $klasaKolo = 'czerwone';
                                            $statusTestu = 'Nie zaliczony';
                                        }
                                    }else{
                                        $klasaKolo = 'zolte';
                                    }

                                    $wynikOstatniaProba = $poj_ostatnia_proba->uzyskany_wynik;

                                    $tresc .= '<div class="tpw_kolo '.$klasaKolo.'">'.$poj_ostatnia_proba->uzyskany_wynik.'%</div>';
                                    $tresc .= '<div class="tpw_opcje '.$klasaKolo.'">';
                                        $tresc .= '<div class="tpw_proba">Próba numer - '.$poj_ostatnia_proba->proba_nr.'</div>';
                                        if($poj_ostatnia_proba->sprawdzony == 0){
                                            $statusTestu = 'W trakcie sprawdzania';
                                        }

                                        $statusOstatniegoTestu = $poj_ostatnia_proba->sprawdzony;

                                        $tresc .= '<div class="tpw_status">Status - '.$statusTestu.'</div>';
                                    $tresc .= '</div>';
                                    $tresc .= '<div class="clear_b"></div>';
                                $tresc .= '</div>';
                            }
                        $tresc .= '</div>';
                    }

                    $szkolenie_status_tmp = $bazaDanych->pobierzDane('szkolenia_id', 'szkolenia_testy', 'id = '.$element->id);
                    $szkolenie_status_tmp = $szkolenie_status_tmp->fetch_object();

                    $szkolenia_status = $bazaDanych->pobierzDane('szkolenia_slownik_status_id', 'szkolenia', 'id = '.$szkolenie_status_tmp->szkolenia_id);
                    $szkolenia_status = $szkolenia_status->fetch_object();

                    if($szkolenia_status->szkolenia_slownik_status_id == 1){
                        if($liczbaProb > 0){
                            if($wynikOstatniaProba != 100){
                                if($statusOstatniegoTestu != 0){
                                    $tresc .= '<button type="button" data-akcja="rozwiazuj_test" data-element_id="'.$element->id.'" data-tabela="szkolenia_testy_id_uzytkownik_id" class=" btn btn-success  rozpocznijRozwiazywanieTestu">Rozpocznij test</button>';
                                }
                            }
                        }
                    }


                }



            break;

        case 'wyswietl_test_do_oceny':
                $tytul_tmp = $bazaDanych->pobierzDane('nazwa', 'szkolenia_testy', 'id = '.$element->szkolenia_testy_id);
                $tytul_tmp = $tytul_tmp->fetch_object();

                $tytul = $tytul_tmp->nazwa;

                $tresc = $szkoleniaTesty->wyswietlTestDoOceny($element->id, $bazaDanych);

            break;

        case 'wyswietl_dodaj_uczestnika':
                $tytul = 'Dodaj uczestnika';

                $tresc .= '<div class="lisztaUzytkownikDostepnych">';
                    $tresc .= '<table class="table tabela_szkolenia_lista_uczestnikow_wyszukaj table-striped margin_b_0">';
                        $tresc .= '<thead>';
                            $tresc .= '<tr>';
                                $tresc .= '<th class="col-md-3">Numer</th>';
                                $tresc .= '<th class="col-md-3">Imię</th>';
                                $tresc .= '<th class="col-md-4">Nazwisko</th>';
                                $tresc .= '<th class="col-md-1"></th>';
                            $tresc .= '</tr>';
                        $tresc .= '</thead>';
                        $tresc .= '<tbody>';
                            $lista_uzytkownikow = $bazaDanych->pobierzDane('id, login, imie, nazwisko', 'uzytkownik', 'status = 1');
                            $lista_zapisanych = $bazaDanych->pobierzDane('uzytkownik_id', 'szkolenia_id_uzytkownik_id', 'szkolenia_id = '.$element->id);
                            $lista_zapisanych_array = array();
                            if(!is_null($lista_zapisanych)){
                                $i = 0;
                                while($poj_lista_zapisanych = $lista_zapisanych->fetch_object()) {
                                    $lista_zapisanych_array[$i] = $poj_lista_zapisanych->uzytkownik_id;
                                    $i++;
                                }
                            }

                            while($poj_lista_uzytkownikow = $lista_uzytkownikow->fetch_object()){
                                if (!in_array($poj_lista_uzytkownikow->id, $lista_zapisanych_array)) {
                                    $tresc .= '<tr>';
                                        $tresc .= '<td class="col-md-3">' . $poj_lista_uzytkownikow->login . '</td>';
                                        $tresc .= '<td class="col-md-3">' . $poj_lista_uzytkownikow->imie . '</td>';
                                        $tresc .= '<td class="col-md-4">' . $poj_lista_uzytkownikow->nazwisko . '</td>';
                                        $tresc .= '<td class="col-md-1">';
                                            $tresc .= '<i class="fa fa-plus-square dodajUczesnitkaWyszukajDoSzkolenia" data-szkolenia_id="' . $element->id . '" data-uzytkownik_id="' . $poj_lista_uzytkownikow->id . '" aria-hidden="true"></i>';
                                        $tresc .= '</td>';
                                    $tresc .= '</tr>';
                                }
                            }
                        $tresc .= '</tbody>';
                    $tresc .= '</table>';
                $tresc .= '</div>';
            break;



        default:
            $dane = array(
                    0 => 0
                    ,1 => 'Brak akcji do wykonania!!!'
            );

            echo json_encode($dane);
            return;
    }

    $dane = array(
            0 => 1
            ,'miniatura' => $miniatura
            ,'tytul' => $tytul
            ,'tresc' => $tresc
    );

    echo json_encode($dane);
    return;

