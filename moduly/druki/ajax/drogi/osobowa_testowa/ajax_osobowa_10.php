<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

if($akcja == 'edytuj' ){
    $element_id = explode('-',$element_id);

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
            $TypPojazdu = $oswiadczenie_poszkodowanego_tmp->TypPojazdu;
            $TypPojazduInny = $oswiadczenie_poszkodowanego_tmp->TypPojazduInny;
            $PieszyRowerzysta = $oswiadczenie_poszkodowanego_tmp->PieszyRowerzysta;
            $KierowcaPasazer = $oswiadczenie_poszkodowanego_tmp->KierowcaPasazer;
            $MiejsceGdzieSiedzial = $oswiadczenie_poszkodowanego_tmp->MiejsceGdzieSiedzial;
            $MiejsceGdzieSiedzialInne = $oswiadczenie_poszkodowanego_tmp->MiejsceGdzieSiedzialInne;
            $ZapietePasy = $oswiadczenie_poszkodowanego_tmp->ZapietePasy;
            $WlascicielWspolwlasciciel = $oswiadczenie_poszkodowanego_tmp->WlascicielWspolwlasciciel;
            $WiedzaCzyPodWplywem = $oswiadczenie_poszkodowanego_tmp->WiedzaCzyPodWplywem;
            $WiedzaOUprawnieniach = $oswiadczenie_poszkodowanego_tmp->WiedzaOUprawnieniach;
            $NastepstwaObrazen = $oswiadczenie_poszkodowanego_tmp->NastepstwaObrazen;
            $DataZakonczeniaLeczenia = $oswiadczenie_poszkodowanego_tmp->DataZakonczeniaLeczenia;
            $PrzewidzianaDataZakonczenia = $oswiadczenie_poszkodowanego_tmp->PrzewidzianaDataZakonczenia;
            $DataZwolnieniaOd = $oswiadczenie_poszkodowanego_tmp->DataZwolnieniaOd;
            $DataZwolnieniaDo = $oswiadczenie_poszkodowanego_tmp->DataZwolnieniaDo;
            $TerminZwolnienia = $oswiadczenie_poszkodowanego_tmp->TerminZwolnienia;

        }

    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneStronyUmowyPopUp">

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
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PieszyRowerzysta; ?>" value="1" data-kolumna="PieszyRowerzysta" class="fa fa<?php echo ($PieszyRowerzysta == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">pieszym</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PieszyRowerzysta; ?>" value="2" data-kolumna="PieszyRowerzysta" class="fa fa<?php echo ($PieszyRowerzysta == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">rowerzystą</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Typ pojazdu w którym znajdował się poszkodowany:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $TypPojazdu; ?>" value="1" data-kolumna="TypPojazdu" class="fa fa<?php echo ($TypPojazdu == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">samochód</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $TypPojazdu; ?>" value="2" data-kolumna="TypPojazdu" class="fa fa<?php echo ($TypPojazdu == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">komunikacja zbiorowa</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $TypPojazdu; ?>" value="3" data-kolumna="TypPojazdu" class="fa fa<?php echo ($TypPojazdu == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">inny: </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $TypPojazduInny; ?>" value="<?php echo ($TypPojazdu == 3) ? $TypPojazduInny : ''; ?>" data-kolumna="TypPojazduInny" maxlength="10" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">W pojeździe w którym znajdował się poszkodowany był on:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $KierowcaPasazer; ?>" value="1" data-kolumna="KierowcaPasazer" class="fa fa<?php echo ($KierowcaPasazer == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>kierowcą</p>
                </div>
                <div class="clear_b"></div>
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $KierowcaPasazer; ?>" value="2" data-kolumna="KierowcaPasazer" class="fa fa<?php echo ($KierowcaPasazer == 2) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>pasażerem i siedział:</p>
                    <div class="zaznaczPoleGrupa margin_l_40 margin_t_5">
                        <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="1" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 1) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>obok kierowcy</p></div>
                        <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="2" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 2) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>z tyłu za kierowcą</p></div>
                        <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="3" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 3) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>z tyłu za przednim pasażerem</p></div>
                        <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="4" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 4) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>z tyłu pośrodku</p></div>
                        <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzial; ?>" value="5" data-kolumna="MiejsceGdzieSiedzial" class="fa fa<?php echo ($MiejsceGdzieSiedzial == 5) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p class="float_l">inne: </p></div>
                        <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $MiejsceGdzieSiedzialInne; ?>" value="<?php echo ($MiejsceGdzieSiedzial == 5) ? $MiejsceGdzieSiedzialInne : ''; ?>" data-kolumna="MiejsceGdzieSiedzialInne" class="update float_l"/></div>
                        <div class="clear_b"></div>
                    </div>
                </div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Poszkodowany w chwili zdarzenia miał zapięte pasy bezpieczeństwa (założony kask)?</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZapietePasy; ?>" value="1" data-kolumna="ZapietePasy" class="fa fa<?php echo ($ZapietePasy == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZapietePasy; ?>" value="2" data-kolumna="ZapietePasy" class="fa fa<?php echo ($ZapietePasy == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Czy poszkodowany jest posiadaczem/współposiadaczem pojazdu?</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WlascicielWspolwlasciciel; ?>" value="1" data-kolumna="WlascicielWspolwlasciciel" class="fa fa<?php echo ($WlascicielWspolwlasciciel == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WlascicielWspolwlasciciel; ?>" value="2" data-kolumna="WlascicielWspolwlasciciel" class="fa fa<?php echo ($WlascicielWspolwlasciciel == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Wsiadając do pojazdu przed wypadkiem poszkodowany wiedział ze kierujący przed zajęciem miejsca za kierownicą spożywał alkohol lub inne środki odurzające?</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WiedzaCzyPodWplywem; ?>" value="1" data-kolumna="WiedzaCzyPodWplywem" class="fa fa<?php echo ($WiedzaCzyPodWplywem == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WiedzaCzyPodWplywem; ?>" value="2" data-kolumna="WiedzaCzyPodWplywem" class="fa fa<?php echo ($WiedzaCzyPodWplywem == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Wsiadając do pojazdu przed wypadkiem poszkodowany wiedział że kierujący pojazdem nie posiada uprawnień do kierowania pojazdem mechanicznym?</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WiedzaOUprawnieniach; ?>" value="1" data-kolumna="WiedzaOUprawnieniach" class="fa fa<?php echo ($WiedzaOUprawnieniach == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WiedzaOUprawnieniach; ?>" value="2" data-kolumna="WiedzaOUprawnieniach" class="fa fa<?php echo ($WiedzaOUprawnieniach == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Poszkodowany oświadcza, że leczenie następstw doznanych obrażeń:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $NastepstwaObrazen; ?>" value="1" data-kolumna="NastepstwaObrazen" class="fa fa<?php echo ($NastepstwaObrazen == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l">zakończyło się z dniem </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $DataZakonczeniaLeczenia; ?>" value="<?php echo ($NastepstwaObrazen == 1) ? $DataZakonczeniaLeczenia : ''; ?>" data-kolumna="DataZakonczeniaLeczenia" maxlength="10" class="datePicker update margin_l_5"/></div>
                </div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $NastepstwaObrazen; ?>" value="2" data-kolumna="NastepstwaObrazen" class="fa fa<?php echo ($NastepstwaObrazen == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l">jeszcze się nie zakończyło, a przewidywany przez lekarzy termin jego ukończenia to </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $PrzewidzianaDataZakonczenia; ?>" value="<?php echo ($NastepstwaObrazen == 2) ? $PrzewidzianaDataZakonczenia : ''; ?>" data-kolumna="PrzewidzianaDataZakonczenia" maxlength="10" class=" datePicker update margin_l_5"/></div>
                </div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $NastepstwaObrazen; ?>" value="3" data-kolumna="NastepstwaObrazen" class="fa fa<?php echo ($NastepstwaObrazen == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>jeszcze się nie zakończyło, a przewidywany termin jego ukończenia nie jest mi znany,</p></div>

                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $NastepstwaObrazen; ?>" value="4" data-kolumna="NastepstwaObrazen" class="fa fa<?php echo ($NastepstwaObrazen == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>planowane są jeszcze zabiegi operacyjne.</p></div>
                <div class="clear_b"></div>
            </div>


            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">W związku z doznanymi obrażeniami poszkodowany przebywał na zwolnieniu chorobowym od dnia:</label>
                    <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $DataZwolnieniaOd; ?>" value="<?php echo ($DataZwolnieniaOd == '0000-00-00' || $DataZwolnieniaOd == 'NULL' || $DataZwolnieniaOd == '') ? '' : $DataZwolnieniaOd; ?>" data-kolumna="DataZwolnieniaOd" maxlength="10" class="datePicker update"/></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $TerminZwolnienia; ?>" value="1" data-kolumna="TerminZwolnienia" class="fa fa<?php echo ($TerminZwolnienia == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l">do dnia </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $DataZgloszeniaRoszczenia; ?>" value="<?php echo ($TerminZwolnienia == 1) ? $DataZwolnieniaDo : ''; ?>" data-kolumna="DataZwolnieniaDo" maxlength="10" class="datePicker update margin_l_5"/></div>
                </div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $TerminZwolnienia; ?>" value="2" data-kolumna="TerminZwolnienia" class="fa fa<?php echo ($TerminZwolnienia == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>nadal przebywa na zwolnieniu.</p></div>
                <div class="clear_b"></div>
            </div>

            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsobowa" data-ogolne="0" data-strona="10" data-akcja="<?php echo (!$oswiadczenie_poszkodowanego_tmp) ? 'dodaj_oswiadczenie_poszkodowanego' : 'aktualizuj_oswiadczenie_poszkodowanego'; ?>"  type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

            <?php

            $disabled = 'disabled';
            $update = '';


            $MiejsceHospitalizacji = '';
            $DataOdKiedy = '';
            $DataDoKiedy = '';
            $lista_szpitali = 0;
            $lista_placowek = 0;




            if($akcja == 'edytuj' ){

                $element_id_tmp = explode('-',$element_id);
                $umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id_tmp[2]);

                if ($umowa_dane_tmp) {
                    $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

                    $oswiadczenie_poszkodowanego_tmp = $bazaDanych->pobierzDane('PrzebiegLeczeniaId', 'umowaOswiadczeniePoszkodowanego', 'Id=' . $umowa_dane_tmp->OswiadczeniePoszkodowanegoId);

                    if ($oswiadczenie_poszkodowanego_tmp) {
                        $oswiadczenie_poszkodowanego_tmp = $oswiadczenie_poszkodowanego_tmp->fetch_object();
                    }

                    $przebieg_leczenia_dane_tmp = $bazaDanych->pobierzDane('*', 'umowaPrzebiegLeczenia', 'Id=' . $oswiadczenie_poszkodowanego_tmp->PrzebiegLeczeniaId);

                    if ($przebieg_leczenia_dane_tmp) {
                        $przebieg_leczenia_dane_tmp = $przebieg_leczenia_dane_tmp->fetch_object();

                        $WezwanoPogotowie = $przebieg_leczenia_dane_tmp->WezwanoPogotowie;
                        $PogotowieMiejscowosc = $przebieg_leczenia_dane_tmp->PogotowieMiejscowosc;
                        $PogotowieSzpital = $przebieg_leczenia_dane_tmp->PogotowieSzpital;
                        $ZglosilDoLekarza = $przebieg_leczenia_dane_tmp->ZglosilDoLekarza;
                        $DaneLekarza = $przebieg_leczenia_dane_tmp->DaneLekarza;
                        $DanePrzychodni = $przebieg_leczenia_dane_tmp->DanePrzychodni;
                        $Hospitalizacja = $przebieg_leczenia_dane_tmp->Hospitalizacja;
                        $Zabiegi = $przebieg_leczenia_dane_tmp->Zabiegi;
                    }
                }

                    $element_id = explode('-',$element_id);

                    $lista_szpitali = $bazaDanych->pobierzDane('*','umowaHospitalizacja','IdPrzebieguLeczenia = '.$oswiadczenie_poszkodowanego_tmp->PrzebiegLeczeniaId);

                    $lista_placowek = $bazaDanych->pobierzDane('*','umowaPlacowki','IdPrzebieguLeczenia = '.$oswiadczenie_poszkodowanego_tmp->PrzebiegLeczeniaId);

                    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
            }

            ?>

            <div class="daneOPrzebieguLeczenia">

                <label class="margin_t_10 width_100 gray_background">PRZEBIEG LECZENIA (doznane urazy i odczuwane dolegliwości należy opisać w OŚWIADCZENIU)</label>

                <div class="zaznaczPoleGrupa">
                    <div class="zpg_opcja_radio">
                        <i data-wartosc_domyslna="<?php echo $WezwanoPogotowie; ?>" value="1" data-kolumna="WezwanoPogotowie" class="fa fa<?php echo ($WezwanoPogotowie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                        <p>na miejsce zdarzenia wezwano pogotowie z:</p>
                        <div class="zpg_opcja zpg_opcja_input">
                            <input class="padding_r_10 width_45 update" type="text" data-wartosc_domyslna="<?php echo $PogotowieMiejscowosc; ?>" value="<?php echo ($WezwanoPogotowie == 1) ? $PogotowieMiejscowosc : ''; ?>" data-kolumna="PogotowieMiejscowosc" placeholder="Miejscowość"/>
                            <input class="width_45 update" type="text" data-wartosc_domyslna="<?php echo $PogotowieSzpital; ?>" value="<?php echo ($WezwanoPogotowie == 1) ? $PogotowieSzpital : ''; ?>" data-kolumna="PogotowieSzpital" placeholder="Szpital"/>
                        </div>
                    </div>
                </div>
                <div class="zaznaczPoleGrupa">
                    <div class="zpg_opcja_radio margin_t_10">
                        <i data-wartosc_domyslna="<?php echo $ZglosilDoLekarza; ?>" value="1" data-kolumna="ZglosilDoLekarza" class="fa fa<?php echo ($ZglosilDoLekarza == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                        <p>poszkodowany sam zgłosił się do lekarza:</p>
                        <div class="zpg_opcja zpg_opcja_input">
                            <input class="padding_r_10 width_45 update" type="text" data-wartosc_domyslna="<?php echo $DaneLekarza; ?>" value="<?php echo ($ZglosilDoLekarza == 1) ? $DaneLekarza : ''; ?>" data-kolumna="DaneLekarza" placeholder="Dane lekarza"/>
                            <input class="width_45 update" type="text" data-wartosc_domyslna="<?php echo $DanePrzychodni; ?>" value="<?php echo ($ZglosilDoLekarza == 1) ? $DanePrzychodni : ''; ?>" data-kolumna="DanePrzychodni" placeholder="Dane przychodni"/>
                        </div>
                    </div>
                </div>
                <div class="zaznaczPoleGrupa">
                    <div class="zpg_opcja_radio margin_t_10">
                        <i data-wartosc_domyslna="<?php echo $Hospitalizacja; ?>" value="1" data-kolumna="Hospitalizacja" class="fa fa<?php echo ($Hospitalizacja == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue HospitalizacjaTak" aria-hidden="true"></i>
                        <p>po wypadku poszkodowany był hospitalizowany</p>
                        <div class="panel panel-default margin_b_10 margin_t_10 szpitale_box" style="display:<?php echo ($Hospitalizacja == 1) ? 'block' : 'none'; ?>">
                            <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek">MIEJSCA HOSPITALIZACJI<i class="fa dsu_dodaj_nowego_klienta fa-plus float_r" aria-hidden="true"></i></div>
                            <div class="panel-body ukryj_widok daneSzpitala1">

                                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="MiejsceHospitalizacji" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejsce hospitalizacji"></div>
                                <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="DataOdKiedy" type="text" class="update datePicker" placeholder="od kiedy"></div>
                                <div class="col-md-3 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="DataDoKiedy" type="text" class="update datePicker" placeholder="do kiedy"></div>

                                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneSzpitala1" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaHospitalizacja" data-ogolne="0" data-strona="10" data-akcja="dodaj_szpital" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Dodaj szpital</button>

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

                                                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneSzpitala_<?php echo $i; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaHospitalizacja" data-ogolne="0" data-strona="10" data-akcja="aktualizuj_szpital" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

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
                <div class="zaznaczPoleGrupa">
                    <div class="zpg_opcja_radio margin_t_10">
                        <i data-wartosc_domyslna="<?php echo $Zabiegi; ?>" value="1" data-kolumna="Zabiegi" class="fa fa<?php echo ($Zabiegi == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZabiegiTak" aria-hidden="true"></i>
                        <p>przeprowadzono zabiegi operacyjne</p>
                        <div class="panel panel-default margin_b_10 margin_t_10 placowki_box" style="display:<?php echo ($Zabiegi == 1) ? 'block' : 'none'; ?>">
                            <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek">LISTA PLACÓWEK W KTÓRYCH LECZONO POSZKODOWANEGO<i class="fa dsu_dodaj_nowego_klienta fa-plus float_r" aria-hidden="true"></i></div>
                            <div class="panel-body ukryj_widok danePlacowki1">

                                <div class="col-md-9 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="NazwaPlacowki" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwa placówki"></div>
                                <div class="col-md-3 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="DataZabiegu" type="text" class="update datePicker" placeholder="data zabiegu"></div>


                                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="danePlacowki1" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaPlacowki" data-ogolne="0" data-strona="10" data-akcja="dodaj_placowke" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Dodaj placówkę</button>

                                <?php
                               if($lista_placowek){
                                    $i = 0;
                                    while($poj_lista_placowek = $lista_placowek->fetch_object()){

                                        $Id = $poj_lista_placowek->Id;
                                        $NazwaPlacowki = $poj_lista_placowek->NazwaPlacowki;
                                        $DataZabiegu = $poj_lista_placowek->DataZabiegu;

                                        ?>
                                        <div class="panel panel-default margin_t_10 margin_b_0">
                                            <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek"><?php echo $NazwaPlacowki.' - data zabiegu: '.$DataZabiegu; ?><i class="fa dsu_dodaj_nowego_klienta fa-pencil float_r" aria-hidden="true"></i></div>
                                            <div class="panel-body ukryj_widok danePlacowki_<?php echo $i; ?>">

                                                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NazwaPlacowki; ?>" value="<?php echo $NazwaPlacowki; ?>" data-kolumna="NazwaPlacowki" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwa placówki"></div>
                                                <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $DataZabiegu; ?>" value="<?php echo $DataZabiegu; ?>" data-kolumna="DataZabiegu" type="text" class="update datePicker" placeholder="data zabiegu"></div>
                                                <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="<?php echo $Id; ?>" data-kolumna="Id" type="text" class="update" placeholder=""></div>

                                                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="danePlacowki_<?php echo $i; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaPlacowki" data-ogolne="0" data-strona="10" data-akcja="aktualizuj_placowke" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

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
                    <div class="clear_b"></div>
                </div>


                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneOPrzebieguLeczenia" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsobowa" data-ogolne="0" data-strona="10" data-akcja="<?php echo (!$przebieg_leczenia_dane_tmp) ? 'dodaj_przebieg_leczenia' : 'aktualizuj_przebieg_leczenia'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

            </div>

        </div>
