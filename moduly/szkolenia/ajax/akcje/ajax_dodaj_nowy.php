<?php

    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

    $akcja = htmlspecialchars($_POST['akcja']);
    $id = htmlspecialchars($_POST['id']);

    $miniatura = '';
    $tytul = '';
    $tresc = '';

    switch ($akcja) {
        case 'dodaj_material':
            $tytul = 'Dodaj materiał';

            $idElement = explode('-',$id);

            $tresc .= '<div data-rodzic_klasa="oknoEdycjiMaterialu" class="oknoEdycji oknoEdycjiMaterialu">';
                $tresc .= '<input class="prm ukryj_widok" disabled data-kolumna="szkolenia_id" type="text" value="'.$idElement[0].'"/>';
                if(!empty($idElement[1])){
                    $tresc .= '<input class="prm ukryj_widok" disabled data-kolumna="material_nadrzedny" type="text" value="'.$idElement[1].'"/>';
                }
                    $tresc .= '<div class="oemGrupaPola">';
                        $tresc .= '<input data-kolumna="nr_kolejnosci" placeholder="Nr kolejności" class=" prm wymagane float_l oeaNrKolejnosci " type="text" value="0"/>';
                        $tresc .= '<input class="oeaTytul prm wymagane float_l" placeholder="Tytuł" data-kolumna="nazwa" type="text" value=""/>';
                        $tresc .= '<div class="clear_b"></div>';
                    $tresc .= '</div>';
                    $tresc .= '<div class="przyciskUploagGrupa">';
                        $tresc .= '<div class="float_l przyciskUpload btn btn-default margin_b_10"><span>Wybierz plik</span><input data-kolumna="plik" class="przyciskUploadPrzycisk "  type="file" name="miniatura"></div>';
                        $tresc .= '<i class="fa fa-trash" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\'\' data-reakcja=\'usun\' data-tabela=\'\' type=\'button\' class=\'btn btn-danger usunPlikPrzyciskUpload usunTak \'>TAK</button>"></i>';
                        $tresc .= '<div class="clear_b"></div>';
                    $tresc .= '</div>';
                $tresc .= '<textarea class="editor prm" data-kolumna="tresc" name="editor" placeholder="Wprowadź tekst..."></textarea>';
                $tresc .= '<textarea class="zajawka  prm" data-kolumna="opis" placeholder="Opis..."></textarea>';
                $tresc .= '<button type="button" data-akcja="dodaj_material" data-element_id="'.$idElement[0].'" data-tabela="szkolenia_materialy" class="btn btn-success zapiszZmiany">Zapisz zmiany</button>';

            $tresc .= '</div>';

            break;

        case 'dodaj_aktualnosc':

            $tytul = 'Dodaj aktualność';
            $tresc = '
                    <div data-rodzic_klasa="oknoEdycjiAktualnosci" class="oknoEdycjiAktualnosci">
                        <input class="oeaTytul prm ukryj_widok" disabled data-kolumna="data_dodania" type="text" value="NOW()"/>
                        <div class="oeaGrupaPola">
                            <input data-kolumna="nr_kolejnosci" placeholder="Nr kolejności" class="prm wymagane float_l oeaNrKolejnosci " type="text" value=""/>
                            <input class="oeaTytul prm wymagane float_l" placeholder="Tytuł" data-kolumna="tytul" type="text" value=""/>
                            <input data-kolumna="data_stop" placeholder="Data widoczności" class="prm wymagane float_l oeaDataWidocznosci dateTimePicker " value=""/>
                            <div class="clear_b"></div>
                        </div>';
            $tresc .= '<div class="dropdown width_80 margin_b_20">';
            $tresc .= '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
            $tresc .= '<div data-kolumna="szkolenie_id" value="0" class="attrValue dpUstawOpcjeNazwa prm wymagane float_l">Brak</div>';
            $tresc .= '<span class="caret"></span>';
            $tresc .= '</button>';
            $tresc .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
            $szkolenia_tmp = $bazaDanych->pobierzDane('*', 'szkolenia', 'czy_usuniety = 0 AND (szkolenia_slownik_status_id = 2)');

            if(!is_null($szkolenia_tmp)){
                while($poj_szkolenia = $szkolenia_tmp->fetch_object()){
                    $tresc .= '<li class="dpUstawOpcje" data-element_id="'.$poj_szkolenia->id.'">'.mb_ucfirst($poj_szkolenia->nazwa).'</li>';
                }
            }
            $tresc .= '</ul>';
            $tresc .= '</div>';
            $tresc .= '<div class="clear_b"></div>';
            $tresc .= '<div class="miniaturaUploadImg"></div>
                        <div class="miniaturaUploagGrupa">
                            <div class="float_l miniaturaUpload btn btn-default margin_b_10"><span>Wybierz miniature</span><input data-kolumna="miniatura" class="miniaturaUploadPrzycisk "  type="file" name="miniatura"></div>
                            <i class="fa fa-trash" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$id.'\' data-reakcja=\'usun\' data-tabela=\'szkolenia_aktualnosci\' type=\'button\' class=\'btn btn-danger usunMiniaturaAktualnosc usunTak \'>TAK</button>"></i>
                            <div class="clear_b"></div>
                        </div>
                        
                        <textarea class="editor prm wymagane" data-kolumna="tresc" name="editor" placeholder="Wprowadź tekst..."></textarea>
                        <textarea class="zajawka prm" data-kolumna="zajawka" placeholder="Opis..."></textarea>
                        <button type="button" data-akcja="dodaj_aktualnosc" data-element_id="" data-tabela="szkolenia_aktualnosci" class="btn btn-success zapiszZmiany">Zapisz zmiany</button>
                    </div> 
                ';
            break;

        case 'dodaj_szkolenie':


                $tytul = 'Dodaj szkolenie';


                    $tresc .= '<div class="oknoDodajSzkolenia"><div data-rodzic_klasa="oeszOgolne" class="oeszOgolne" id="oeszOgolne">';
                        $tresc .= '<div class="form-inline margin_b_10">';
                        $tresc .= '<input data-kolumna="liczba_miejsc" placeholder="Liczba miejsc" class="text-center oeszLiczbaMiejsc wymagane prm inputEdycja" type="text" value="0"/>';

                        $tresc .= '<input data-kolumna="data_start" placeholder="Data rozpoczęcia" class="dateTimePicker prm wymagane oeszDataOd inputEdycja text-center" type="text" value=""/>';

                        $tresc .= '<input data-kolumna="data_stop" placeholder="Data zakończenia" class="dateTimePicker prm wymagane oeszDataDo inputEdycja text-center" type="text" value=""/>';
                        $tresc .= '<div class="dropdown float_r szkolenieStatus">';
                        $tresc .= '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
                        $tresc .= '<div data-kolumna="szkolenia_slownik_status_id" value="4" class="attrValue dpUstawOpcjeNazwa prm wymagane float_l">W przygotowaniu</div>';
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
                        $tresc .= '<input data-kolumna="nazwa" class="oeszTytul float_l prm wymagane" placeholder="Nazwa szkolenia" type="text" value=""/>';


                        $tresc .= '<div class="dropdown float_l szkolenieTyp margin_b_10">';
                        $tresc .= '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';

                        $tresc .= '<div data-kolumna="szkolenia_slownik_rodzaj_id" value="1" class="attrValue dpUstawOpcjeNazwa prm wymagane float_l">Online</div>';
                        $tresc .= '<span class="caret"></span>';
                        $tresc .= '</button>';
                        $tresc .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                        $szkoleaniaRodzaje = $bazaDanych->pobierzDane('*', 'szkolenia_slownik_rodzaj', 'czy_usuniety = 0');
                        if(!is_null($szkoleaniaRodzaje)){
                            while($poj_szkoleaniaRodzaje = $szkoleaniaRodzaje->fetch_object()){
                                $tresc .= '<li class="dpUstawOpcje TypSzkoleniaOpcja" data-element_id="'.$poj_szkoleaniaRodzaje->id.'">'.mb_ucfirst($poj_szkoleaniaRodzaje->wartosc).'</li>';
                            }
                        }
                        $tresc .= '</ul>';
                        $tresc .= '</div>';

                        $tresc .= '<input disabled data-kolumna="miejscowosc" placeholder="Miejscowość" class="prm szkolenieMiejsce inputEdycja text-center margin_b_10" type="text" value=""/>';

                        $tresc .= '<div class="clear_b"></div>';

                        $tresc .= '<textarea data-kolumna="opis" class="editor prm wymagane" name="editor" placeholder="Wprowadź opis..."></textarea>';
                        $tresc .= '<button data-akcja="dodaj_szkolenie" data-element_id="" data-tabela="szkolenia" type="button" class="btn btn-success zapiszZmiany">Zapisz zmiany</button>';
                    $tresc .='</div></div>';


            break;

        case 'dodaj_test':
            $tytul = 'Dodaj test';

            $idElement = explode('-',$id);

            $tresc .= '<div data-rodzic_klasa="oknoDodajTest" class="oknoEdycji oknoDodajTest">';
                $tresc .= '<input class="prm ukryj_widok" disabled data-kolumna="szkolenia_id" type="text" value="'.$idElement[0].'"/>';
                if(!empty($idElement[1])){
                    $tresc .= '<input class="prm ukryj_widok" disabled data-kolumna="material_nadrzedny" type="text" value="'.$idElement[1].'"/>';
                }

                        $tresc .= '<div class="oemGrupaPola">';
                            $tresc .= '<input data-kolumna="nr_kolejnosci" placeholder="Nr kolejności" class=" prm wymagane float_l oeaNrKolejnosci " type="text" value="0"/>';
                            $tresc .= '<input class="oeaTytul prm wymagane float_l" placeholder="Tytuł" data-kolumna="nazwa" type="text" value=""/>';
                            $tresc .= '<div class="clear_b"></div>';
                        $tresc .= '</div>';
                        $tresc .= '<textarea class="zajawka  prm" data-kolumna="opis" placeholder="Opis..."></textarea>';
                        $tresc .= '<button type="button" data-akcja="dodaj_test" data-element_id="'.$idElement[0].'" data-tabela="szkolenia_testy" class="btn btn-success zapiszZmiany">Zapisz zmiany</button>';


                    $tresc .= '</div>';


            break;

        case 'wyswietl_okno_wyslij_wiadomosc':
            $tytul = 'Wyślij wiadomość do wszystkich uczestników';
            $tresc .= '<div class="wyslijWidomoscDoWszystkichUczestnikow">';
                $tresc .= '<input class="width_100 margin_b_10 inputEdycja tytulWiadomosci" data-kolumna="data_dodania" type="text" value="" placeholder="Temat wiadomości"/>';
                $tresc .= '<div class="listaUczestnikow margin_b_10" >';
                    $lista_uczestnikow = $bazaDanych->pobierzDane('uzytkownik_id','szkolenia_id_uzytkownik_id','szkolenia_id = '.$id);
                    while($poj_lista_uczestnikow = $lista_uczestnikow->fetch_object()){
                        $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko, email','uzytkownik','id = '.$poj_lista_uczestnikow->uzytkownik_id);
                        $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();
                        $tresc .= '<div class="pojedynczyUczestnik" data-email="'.$uzytkownik_tmp->email.'">'.$uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko.'<i class="fa float_r fa-trash" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button type=\'button\' class=\'btn btn-danger  usunTak usunUczestnikazListyDoWysylki \'>TAK</button>"></i></div>';
                    }
                    $tresc .= '<div class="clear_b"></div>';
                $tresc .= '</div>';

                $tresc .= '<input class="width_100 margin_b_10 inputEdycja inniAdresaci" data-kolumna="inni_adresaci" type="text" value="" placeholder="Pozostali adresaci - adresy oddzielone średnikiem"/>';

                $tresc .= '<textarea class="editor_prosty prm wymagane trescWiadomosci" data-kolumna="tresc" name="editor" placeholder="Treść wiadomości..."></textarea>';

                $tresc .= '<div class="mailing_podpis_do_wiadomosci">';
                $tresc .= '<p class="mailing_adresat_tytul">Załączniki</p>';
                $tresc .= '<div class="mailing_zalaczniki">';
                $tresc .= '<div class="mailing_zalaczniki_dodaj">';
                $tresc .= '<span class="mailing_zalaczniki_dodaj_napis">DODAJ</span>';
                $tresc .= '<input class="mailing_zalaczniki_dodaj_pole" type="file">';
                $tresc .= '</div>';
                $tresc .= '<div id="mailing_zalaczniki_lista"></div>';
                $tresc .= '<div class="clear_b"></div>';
                $tresc .= '</div>';
                $tresc .= '</div>';


            /*            if(in_array('35', $luzu)){
                            $tresc .= '<div class="mailing_podpis_do_wiadomosci">';
                            $tresc .= '<p class="mailing_adresat_tytul">Załączniki</p>';
                            $tresc .= '<div class="mailing_zalaczniki">';
                            $tresc .= '<div class="mailing_zalaczniki_dodaj"><span class="mailing_zalaczniki_dodaj_napis">DODAJ</span><input type="file" class="mailing_zalaczniki_dodaj_pole" /></div>';
                            $tresc .= '<div id="mailing_zalaczniki_lista"></div>';
                            $tresc .= '<div class="clear_b"></div>';
                            $tresc .= '</div>';
                            $tresc .= '</div>';
                        }*/


                $tresc .= '<button type="button" data-akcja="wiadomosc_do_uczestnika" data-element_id="'.$id.'" data-tabela="szkolenia_testy" class="margin_t_10 btn btn-success przyciskZapiszZmianyZielony wyslijWiadomoscDoUczestnikow">Wyślij</button>';

            $tresc .= '</div>';


        break;
    }

    $dane = array(
            0 => 1
            ,'miniatura' => $miniatura
            ,'tytul' => $tytul
            ,'tresc' => $tresc
    );

    echo json_encode($dane);
    return;