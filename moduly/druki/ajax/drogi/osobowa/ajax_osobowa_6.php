<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

if($akcja == 'edytuj' ){
    $element_id = explode('-',$element_id);

    $umowa_id = $element_id[2];

    $umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id[2]);

    if ($umowa_dane_tmp) {
        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        $TypSzkodyId = $umowa_dane_tmp->TypSzkodyId;
        $RodzajSzkodyId = $umowa_dane_tmp->RodzajSzkodyId;
        $TypZdarzeniaId = $umowa_dane_tmp->TypZdarzeniaId;

        $oswiadczenie_poszkodowanego_tmp = $bazaDanych->pobierzDane('*', 'umowaOswiadczeniePoszkodowanego', 'Id=' . $umowa_dane_tmp->OswiadczeniePoszkodowanegoId);

        if ($oswiadczenie_poszkodowanego_tmp) {
            $oswiadczenie_poszkodowanego_tmp = $oswiadczenie_poszkodowanego_tmp->fetch_object();

            $PodWplywem = $oswiadczenie_poszkodowanego_tmp->PodWplywem;
            $PodJakimWplywem = $oswiadczenie_poszkodowanego_tmp->PodJakimWplywem;
            $PieszyRowerzysta = $oswiadczenie_poszkodowanego_tmp->PieszyRowerzysta;
            $MiejsceGdzieSiedzial = $oswiadczenie_poszkodowanego_tmp->MiejsceGdzieSiedzial;
            $MiejsceGdzieSiedzialInne = $oswiadczenie_poszkodowanego_tmp->MiejsceGdzieSiedzialInne;
            $ZapietePasy = $oswiadczenie_poszkodowanego_tmp->ZapietePasy;
            $WlascicielWspolwlasciciel = $oswiadczenie_poszkodowanego_tmp->WlascicielWspolwlasciciel;
            $WiedzaCzyPodWplywem = $oswiadczenie_poszkodowanego_tmp->WiedzaCzyPodWplywem;
            $WiedzaOUprawnieniach = $oswiadczenie_poszkodowanego_tmp->WiedzaOUprawnieniach;
            $NastepstwaObrazen = $oswiadczenie_poszkodowanego_tmp->NastepstwaObrazen;
            $StopienPokrewienstwa = $oswiadczenie_poszkodowanego_tmp->StopienPokrewienstwa;
        }
        $oswiadczenie_uprawnionego_tmp = $bazaDanych->pobierzDane('*', 'umowaOswiadczenieUprawnionego', 'Id=' . $umowa_dane_tmp->OswiadczenieUprawnionegoId);

        if ($oswiadczenie_uprawnionego_tmp) {
            $oswiadczenie_uprawnionego_tmp = $oswiadczenie_uprawnionego_tmp->fetch_object();

            $StopienPokrewienstwa = $oswiadczenie_uprawnionego_tmp->StopienPokrewienstwa;

        }

    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}

if ($TypSzkodyId == 1) {
    ?>



    <div class="daneStronyUmowyPopUp">

        <div class="daneOswiadczenieOsobyPoszkodowanej">

            <label class="margin_t_10 width_100 gray_background">OŚWIADCZENIE OSOBY POSZKODOWANEJ</label>

            <label class="margin_t_10 width_100">Poszkodowany w chwili zdarzenia był:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $PodWplywem; ?>" value="1" data-kolumna="PodWplywem" class="fa fa<?php echo ($PodWplywem == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>był pod wpływem:</p>
                    <div class="zaznaczPoleGrupa ">
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PodJakimWplywem; ?>" value="1" data-kolumna="PodJakimWplywem" class="fa fa<?php echo ($PodJakimWplywem == 1) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">alkoholu</p></div>
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PodJakimWplywem; ?>" value="2" data-kolumna="PodJakimWplywem" class="fa fa<?php echo ($PodJakimWplywem == 2) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">narkotyków</p></div>
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PodJakimWplywem; ?>" value="3" data-kolumna="PodJakimWplywem" class="fa fa<?php echo ($PodJakimWplywem == 3) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">innych środków odurzających </p></div>
                        <div class="clear_b"></div>
                    </div>
                </div>
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $PodWplywem; ?>" value="2" data-kolumna="PodWplywem" class="fa fa<?php echo ($PodWplywem == 2) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>nie był pod wpływem</p>
                </div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Poszkodowany był:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PieszyRowerzysta; ?>" value="1" data-kolumna="PieszyRowerzysta" class="fa fa<?php echo ($PieszyRowerzysta == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue poza_autem" aria-hidden="true"></i><p class="float_l">pieszym</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PieszyRowerzysta; ?>" value="2" data-kolumna="PieszyRowerzysta" class="fa fa<?php echo ($PieszyRowerzysta == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue poza_autem" aria-hidden="true"></i><p class="float_l">rowerzystą</p></div>
                <div class="clear_b"></div>
            </div>


            <div class="sekcja_szkoda_z_autem">
            <label class="margin_t_10 width_100">W pojeździe poszkodowany zajmował miejsce:</label>
            <div class="zaznaczPoleGrupa margin_l_40 margin_t_5">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="1" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 1) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>obok kierowcy</p></div>
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="2" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 2) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>z tyłu za kierowcą</p></div>
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="3" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 3) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>z tyłu za przednim pasażerem</p></div>
                <!--                        <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php /*echo $MiejsceGdzieSiedzial; */?>" value="4" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php /*echo ($MiejsceGdzieSiedzial == 4) ? '-check' : '' ; */?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>z tyłu pośrodku</p></div>-->
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="5" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 5) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p class="float_l">inne: </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzialInne; ?>" value="<?php echo ($MiejsceGdzieSiedzial == 5) ? $MiejsceGdzieSiedzialInne : ''; ?>" data-kolumna="MiejsceGdzieSiedzialInne" class="update float_l"/></div>
                <div class="clear_b"></div>
            </div>
            <div class="clear_b"></div>
            </div>


            <label class="margin_t_10 width_100">Poszkodowany w chwili zdarzenia miał zapięte pasy bezpieczeństwa (założony kask)?</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZapietePasy; ?>" value="1" data-kolumna="ZapietePasy" class="fa fa<?php echo ($ZapietePasy == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZapietePasy; ?>" value="2" data-kolumna="ZapietePasy" class="fa fa<?php echo ($ZapietePasy == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <div class="sekcja_szkoda_z_autem">
            <label class="margin_t_10 width_100">Czy poszkodowany jest posiadaczem/współposiadaczem pojazdu?</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WlascicielWspolwlasciciel; ?>" value="1" data-kolumna="WlascicielWspolwlasciciel" class="fa fa<?php echo ($WlascicielWspolwlasciciel == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WlascicielWspolwlasciciel; ?>" value="2" data-kolumna="WlascicielWspolwlasciciel" class="fa fa<?php echo ($WlascicielWspolwlasciciel == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Wsiadając do pojazdu przed wypadkiem poszkodowany wiedział ze kierujący przed zajęciem miejsca za kierownicą spożywał alkohol lub inne środki odurzające? (wypełnić tylko w przypadku gdy kierujący był pod wpływem alkoholu lub innych środków odurzających)</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WiedzaCzyPodWplywem; ?>" value="1" data-kolumna="WiedzaCzyPodWplywem" class="fa fa<?php echo ($WiedzaCzyPodWplywem == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WiedzaCzyPodWplywem; ?>" value="2" data-kolumna="WiedzaCzyPodWplywem" class="fa fa<?php echo ($WiedzaCzyPodWplywem == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Wsiadając do pojazdu przed wypadkiem poszkodowany wiedział że kierujący pojazdem nie posiada uprawnień do kierowania pojazdem mechanicznym? (wypełnić tylko w przypadku gdy kierujący nie miał uprawnień)</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WiedzaOUprawnieniach; ?>" value="1" data-kolumna="WiedzaOUprawnieniach" class="fa fa<?php echo ($WiedzaOUprawnieniach == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WiedzaOUprawnieniach; ?>" value="2" data-kolumna="WiedzaOUprawnieniach" class="fa fa<?php echo ($WiedzaOUprawnieniach == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>
            </div>

            <label class="margin_t_10 width_100">Leczenie następstw wypadku:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $NastepstwaObrazen; ?>" value="1" data-kolumna="NastepstwaObrazen" class="fa fa<?php echo ($NastepstwaObrazen == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">jest zakończone</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $NastepstwaObrazen; ?>" value="2" data-kolumna="NastepstwaObrazen" class="fa fa<?php echo ($NastepstwaObrazen == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">nie jest zakończone</p></div>
                <div class="clear_b"></div>
            </div>

        </div>

        <?php

        $disabled = 'disabled';
        $update = '';


        $MiejsceHospitalizacji = '';
        $lista_szpitali = 0;

        $lista_szpitali = $bazaDanych->pobierzDane('*','umowaHospitalizacja','IdUmowyOsobowej = '.$umowa_dane_tmp->Id);

        ?>

        <div class="daneOPrzebieguLeczenia">
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja_radio margin_t_10">
                    <label class="margin_t_10 width_100">Poszkodowany po wypadku był leczony w następujących placówkach medycznych:</label>
                    <div class="panel panel-default margin_b_10 margin_t_10 szpitale_box"">
                        <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek">MIEJSCA HOSPITALIZACJI<i class="fa dsu_dodaj_nowego_klienta fa-plus float_r" aria-hidden="true"></i></div>
                        <div class="panel-body ukryj_widok daneSzpitala1">

                            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="MiejsceHospitalizacji" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejsce hospitalizacji"></div>
                            <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="DataOdKiedy" type="text" class="update datePicker" placeholder="od kiedy"></div>
                            <div class="col-md-3 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="DataDoKiedy" type="text" class="update datePicker" placeholder="do kiedy"></div>

                            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneSzpitala1" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaHospitalizacja" data-ogolne="0" data-strona="6" data-akcja="dodaj_szpital" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Dodaj szpital</button>

                            <?php
                            if($lista_szpitali){
                                $i = 0;
                                while($poj_lista_szpitali = $lista_szpitali->fetch_object()){

                                    $Id = $poj_lista_szpitali->Id;
                                    $MiejsceHospitalizacji = $poj_lista_szpitali->MiejsceHospitalizacji;
                                    $DataOdKiedy = $poj_lista_szpitali->DataOdKiedy;
                                    $DataDoKiedy = $poj_lista_szpitali->DataDoKiedy;

                                    ?>
                                    <div class="panel panel-default margin_t_10 margin_b_0">
                                        <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek"><?php echo $MiejsceHospitalizacji.' '.$DataOdKiedy.' do '.$DataDoKiedy; ?><i class="fa dsu_dodaj_nowego_klienta fa-pencil float_r" aria-hidden="true"></i></div>
                                        <div class="panel-body ukryj_widok daneSzpitala_<?php echo $i; ?>">

                                            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $MiejsceHospitalizacji; ?>" value="<?php echo $MiejsceHospitalizacji; ?>" data-kolumna="MiejsceHospitalizacji" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejsce hospitalizacji"></div>

                                            <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $DataOdKiedy; ?>" value="<?php echo $DataOdKiedy; ?>" data-kolumna="DataOdKiedy" type="text" class="update datePicker" placeholder="od kiedy"></div>
                                            <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $DataDoKiedy; ?>" value="<?php echo $DataDoKiedy; ?>" data-kolumna="DataDoKiedy" type="text" class="update datePicker" placeholder="do kiedy"></div>

                                            <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="<?php echo $Id; ?>" data-kolumna="Id" type="text" class="update" placeholder=""></div>

                                            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneSzpitala_<?php echo $i; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaHospitalizacja" data-ogolne="0" data-strona="6" data-akcja="aktualizuj_szpital" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneOswiadczenieOsobyPoszkodowanej" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsobowa" data-ogolne="0" data-strona="6" data-akcja="<?php echo (!$oswiadczenie_poszkodowanego_tmp) ? 'dodaj_oswiadczenie_poszkodowanego' : 'aktualizuj_oswiadczenie_poszkodowanego'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

        </div>

    </div>
<?php } else if ($TypSzkodyId == 2) {

    ?>

    <div class="daneStronyUmowyPopUp">

        <label class="margin_t_10 width_100 gray_background">ANKIETA INFORMACYJNA DOTYCZĄCA WIĘZI MIĘDZY OSOBĄ UPRAWNIONĄ A OSOBĄ ZMARŁĄ W WYNIKU WYPADKU</label>

        <div class="stopien_poinowactwa margin_b_30"
        <label>
            <div class="zpg_opcja zpg_opcja_input margin_t_10 margin_b_10">
                <p class="float_l">Stopień pokrewieństwa/poinowactwa osoby Uprawnionej ze Zmarłą:</p>
                <input class="padding_r_10 width_300 update" type="text" data-wartosc_domyslna="<?php echo $StopienPokrewienstwa; ?>" value="<?php echo $StopienPokrewienstwa; ?>" data-kolumna="StopienPokrewienstwa"/></div>
        </label>
        <button data-reakcja="zapisz_przeladuj_widok" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="stopien_poinowactwa" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOswiadczenieUprawnionego" data-ogolne="0" data-strona="6" data-akcja="aktualizuj_pokrewienstwo" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>
    </div>
    <?php

    $lista_pytan = $bazaDanych->pobierzDane('*','umowaSlownikPytania','czy_usuniety = 0');

    if($lista_pytan){
        $i = 0;
        while($poj_lista_pytan = $lista_pytan->fetch_object()) {

            $NumerPytania = $poj_lista_pytan->NumerPytania;
            $Pytanie = $poj_lista_pytan->Wartosc;

            $lista_odpowiedzi = $bazaDanych->pobierzDane('*', 'umowaAnkiety', 'UmowaId=' . $umowa_id . ' AND PytanieId =' . $NumerPytania);

            if ($lista_odpowiedzi) {
                $lista_odpowiedzi = $lista_odpowiedzi->fetch_object();
                $Odpowiedz = $lista_odpowiedzi->Odpowiedz;
            } else {
                $Odpowiedz = '';
            }

            ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <label class="margin_t_10 width_100 pytanie">
                        <div class="numer"><?php echo $NumerPytania; ?></div>
                        <div class="tresc_pytania"><?php echo $Pytanie; ?></div>
                    </label>
                    <div class="zpg_opcja ukryte zpg_opcja_input pytanie_<?php echo $NumerPytania; ?>">

                        <?php if ($NumerPytania != '22') { ?>
                        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="<?php echo $NumerPytania; ?>" data-kolumna="PytanieId" type="text" placeholder="" class="update" ></div>
                        <textarea class="form-control update textarea_content policz_znaki" rows="3" data-liczba_znakow="338" id="comment" data-kolumna="Odpowiedz"
                                  data-wartosc_domyslna="<?php echo $Odpowiedz; ?>"><?php echo $Odpowiedz; ?></textarea>
                        Pozostało znaków: <span class="pozostalo_znakow">338</span>
                    </div>
                    <button data-reakcja="zapisz_przeladuj_widok" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="pytanie_<?php echo $NumerPytania; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaAnkiety" data-ogolne="0" data-strona="6" data-akcja="<?php echo ($lista_odpowiedzi) ? 'aktualizuj_odpowiedz_do_ankiety' : 'dodaj_odpowiedz_do_ankiety'; ?>" type="button" class="ukryte przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0 zapiszOdpowiedzIPrzejdzDalej">Zapisz zmiany</button>

                    <?php } else {

                        $inne_odszkodowania = $bazaDanych->pobierzDane('*', 'umowaInneOdszkodowania', 'Id =' . $umowa_dane_tmp->InneOdszkodowaniaId);

                        if ($inne_odszkodowania) {
                            $inne_odszkodowania = $inne_odszkodowania->fetch_object();
                            $KwotaZUS = $inne_odszkodowania->KwotaZUS;
                            $KwotaGOPS = $inne_odszkodowania->KwotaGOPS;
                            $KwotaZOC = $inne_odszkodowania->KwotaZOC;
                            $InneSwiadczenia = $inne_odszkodowania->InneSwiadczenia;
                        } else {
                            $KwotaZUS = '';
                            $KwotaGOPS = '';
                            $KwotaZOC = '';
                            $InneSwiadczenia = '';
                        }
                        ?>
                        <div class="zpg_opcja zpg_opcja_input">
                            <p class="float_l">z ZUSu/KRUSu</p>
                            <input class="padding_r_10 width_30 update" type="text" data-wartosc_domyslna="<?php echo $KwotaZUS; ?>" value="<?php echo $KwotaZUS; ?>" data-kolumna="KwotaZUS"/>
                        </div>
                        <div class="zpg_opcja zpg_opcja_input margin_t_10">
                            <p class="float_l">z Miejskiego/Gminnego Ośrodka Pomocy Społecznej</p>
                            <input class="padding_r_10 width_30 update" type="text" data-wartosc_domyslna="<?php echo $KwotaGOPS; ?>" value="<?php echo $KwotaGOPS; ?>" data-kolumna="KwotaGOPS"/>
                        </div>
                        <div class="zpg_opcja zpg_opcja_input margin_t_10">
                            <p class="float_l">od ubezpieczyciela OC sprawcy zdarzenia/bezpośrednio od sprawcy zdarzenia</p>
                            <input class="padding_r_10 width_30 update" type="text" data-wartosc_domyslna="<?php echo $KwotaZOC; ?>" value="<?php echo $KwotaZOC; ?>" data-kolumna="KwotaZOC"/>
                        </div>
                        <div class="zpg_opcja zpg_opcja_input margin_t_10">
                            <p class="float_l">inne niż wymienione powyżej świadczenia. Prosimy podać źródło i wysokość świadczenia:</p>
                            <input class="padding_r_10 width_30 update" type="text" data-wartosc_domyslna="<?php echo $InneSwiadczenia; ?>" value="<?php echo $InneSwiadczenia; ?>" data-kolumna="InneSwiadczenia"/>
                        </div>
                        </div>
                        <button data-reakcja="zapisz_przeladuj_widok" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="pytanie_<?php echo $NumerPytania; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaAnkiety" data-ogolne="0" data-strona="6" data-akcja="<?php echo ($inne_odszkodowania) ? 'aktualizuj_odpowiedz_22' : 'dodaj_odpowiedz_22'; ?>" type="button" class="ukryte przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0 zapiszOdpowiedzIPrzejdzDalej">Zapisz zmiany</button>
                    <?php } ?>
                </li>
            </ul>
            <?php
            $i++;
        }
    }
    ?>

    </div>

<?php } ?>
