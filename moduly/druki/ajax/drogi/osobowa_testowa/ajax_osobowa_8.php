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

        $inne_odszkodowania_tmp = $bazaDanych->pobierzDane('*', 'umowaInneOdszkodowania', 'Id=' . $umowa_dane_tmp->InneOdszkodowaniaId);

        if ($inne_odszkodowania_tmp) {
            $inne_odszkodowania_tmp = $inne_odszkodowania_tmp->fetch_object();

            $ZgloszonoZNnw = $inne_odszkodowania_tmp->ZgloszonoZNnw;
            $NazwaUbezpieczycielaNnw = $inne_odszkodowania_tmp->NazwaUbezpieczycielaNnw;
            $OkreslonoUszczerbekNnw = $inne_odszkodowania_tmp->OkreslonoUszczerbekNnw;
            $ProcentUszczerbkuNnw = $inne_odszkodowania_tmp->ProcentUszczerbkuNnw;
            $JakiWypadek = $inne_odszkodowania_tmp->JakiWypadek;
            $ZgloszonoSzkode = $inne_odszkodowania_tmp->ZgloszonoSzkode;
            $GdzieZgloszono = $inne_odszkodowania_tmp->GdzieZgloszono;
            $GdzieZgloszonoInne = $inne_odszkodowania_tmp->GdzieZgloszonoInne;
            $ProcentUszczerbku = $inne_odszkodowania_tmp->ProcentUszczerbku;
            $PrzyznanoOdszkodowanie = $inne_odszkodowania_tmp->PrzyznanoOdszkodowanie;
            $WysokoscOdszkodowania = $inne_odszkodowania_tmp->WysokoscOdszkodowania;
            $ZasilekPogrzebowy = $inne_odszkodowania_tmp->ZasilekPogrzebowy;

        }

        $dane_o_niezdolnosci_tmp = $bazaDanych->pobierzDane('*', 'umowaDaneONiezdolnosci', 'Id=' . $umowa_dane_tmp->DaneONiezdolnosciId);

        if ($dane_o_niezdolnosci_tmp) {
            $dane_o_niezdolnosci_tmp = $dane_o_niezdolnosci_tmp->fetch_object();

            $ZwolnienieLekarskie = $dane_o_niezdolnosci_tmp->ZwolnienieLekarskie;
            $DataZwolnienieOd = $dane_o_niezdolnosci_tmp->DataZwolnienieOd;
            $DataZwolnieniaDo = $dane_o_niezdolnosci_tmp->DataZwolnieniaDo;
            $OrzeczenieONiezdolnosci = $dane_o_niezdolnosci_tmp->OrzeczenieONiezdolnosci;
            $TypNiezdolnosci = $dane_o_niezdolnosci_tmp->TypNiezdolnosci;
            $DataNiezdolnosciDo = $dane_o_niezdolnosci_tmp->DataNiezdolnosciDo;
            $UbezpieczycielNazwa = $dane_o_niezdolnosci_tmp->UbezpieczycielNazwa;
            $UbezpieczycielNazwaInne = $dane_o_niezdolnosci_tmp->UbezpieczycielNazwaInne;
            $PrzyznanoSwiadczenie = $dane_o_niezdolnosci_tmp->PrzyznanoSwiadczenie;
            $PrzyznanoSwiadczenieInne = $dane_o_niezdolnosci_tmp->PrzyznanoSwiadczenieInne;
            $WysokoscSwiadczenia = $dane_o_niezdolnosci_tmp->WysokoscSwiadczenia;
            $DataSwiadczeniaDo = $dane_o_niezdolnosci_tmp->DataSwiadczeniaDo;
        }

    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneStronyUmowyPopUp">

            <label class="margin_t_10 width_100 gray_background">INNE ODSZKODOWANIA</label>

            <label class="margin_t_10 width_100">Czy zgłoszono szkodę do ubezpieczyciela NNW?</label>
            <div class="zaznaczPoleGrupa ZgloszonoZNnw ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZgloszonoZNnw; ?>" value="1" data-kolumna="ZgloszonoZNnw" class="fa fa<?php echo ($ZgloszonoZNnw == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZgloszonoZNnwTak" aria-hidden="true"></i><p class="float_l">TAK, </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">nazwa ubezpieczyciela:</p><input type="text" data-wartosc_domyslna="<?php echo $NazwaUbezpieczycielaNnw; ?>" value="<?php echo ($ZgloszonoZNnw == 1) ? $NazwaUbezpieczycielaNnw : ''; ?>" data-kolumna="NazwaUbezpieczycielaNnw" class="update"/></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZgloszonoZNnw; ?>" value="2" data-kolumna="ZgloszonoZNnw" class="fa fa<?php echo ($ZgloszonoZNnw == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Czy ubezpieczyciel NNW określił uszczerbek na zdrowu?</label>
            <div class="zaznaczPoleGrupa OkreslonoUszczerbekNnw ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $OkreslonoUszczerbekNnw; ?>" value="1" data-kolumna="OkreslonoUszczerbekNnw" class="fa fa<?php echo ($OkreslonoUszczerbekNnw == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue OkreslonoUszczerbekNnwTak" aria-hidden="true"></i><p class="float_l">TAK, </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">określony procent uszczerbku:</p><input type="text" data-wartosc_domyslna="<?php echo $ProcentUszczerbkuNnw; ?>" value="<?php echo ($OkreslonoUszczerbekNnw == 1) ? $ProcentUszczerbkuNnw : ''; ?>" data-kolumna="ProcentUszczerbkuNnw" maxlength="10" class="update"/></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $OkreslonoUszczerbekNnw; ?>" value="2" data-kolumna="OkreslonoUszczerbekNnw" class="fa fa<?php echo ($OkreslonoUszczerbekNnw == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Był to wypadek:</label>
            <div class="zaznaczPoleGrupa ">
                    <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $JakiWypadek; ?>" value="1" data-kolumna="JakiWypadek" class="fa fa<?php echo ($JakiWypadek == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">przy pracy</p></div>
                    <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $JakiWypadek; ?>" value="2" data-kolumna="JakiWypadek" class="fa fa<?php echo ($JakiWypadek == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">w drodze do lub z pracy</p></div>
                    <div class="clear_b"></div>
            </div>
            <div class="informacje_o_ubezpieczeniu">
                <div class="zaznaczPoleGrupa ZgloszonoSzkode ">
                    <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $ZgloszonoSzkode; ?>" value="<?php echo $ZgloszonoSzkode; ?>" data-kolumna="ZgloszonoSzkode" class="fa fa<?php echo ($ZgloszonoSzkode == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue ZgloszonoSzkodeTak" aria-hidden="true"></i>
                        <p>zgłoszono szkodę do</p>
                    </div>
                    <div class="zaznaczPoleGrupa ">
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $GdzieZgloszono; ?>" value="1" data-kolumna="GdzieZgloszono" class="fa fa<?php echo ($ZgloszonoSzkode == 1 && $GdzieZgloszono == 1) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue GdzieZgloszono1" aria-hidden="true"></i><p class="float_l">ZUS</p></div>
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $GdzieZgloszono; ?>" value="2" data-kolumna="GdzieZgloszono" class="fa fa<?php echo ($ZgloszonoSzkode == 1 && $GdzieZgloszono == 2) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue GdzieZgloszono2" aria-hidden="true"></i><p class="float_l">KRUS</p></div>
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $GdzieZgloszono; ?>" value="3" data-kolumna="GdzieZgloszono" class="fa fa<?php echo ($ZgloszonoSzkode == 1 && $GdzieZgloszono == 3) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue GdzieZgloszono3" aria-hidden="true"></i><p class="float_l">inne: </p></div>
                        <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $GdzieZgloszonoInne; ?>" value="<?php echo ($ZgloszonoSzkode == 1 && $GdzieZgloszono == 3) ? $GdzieZgloszonoInne : ''; ?>" data-kolumna="GdzieZgloszonoInne" maxlength="10" class="update GdzieZgloszonoInne "/></div>
                        <div class="zpg_opcja_radio margin_l_40 margin_t_5"><p class="float_l">który określił uszczerbek na zdrowiu na: </p></div>
                        <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $ProcentUszczerbku; ?>" value="<?php echo ($ZgloszonoSzkode == 1 && $ZgloszonoSzkode == 1) ? $ProcentUszczerbku : ''; ?>" data-kolumna="ProcentUszczerbku" maxlength="10" class="update"/> %</div>
                    </div>
                        <div class="clear_b"></div>
                </div>
                <div class="zaznaczPoleGrupa PrzyznanoOdszkodowanie ">
                    <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $PrzyznanoOdszkodowanie; ?>" value="<?php echo $PrzyznanoOdszkodowanie; ?>" data-kolumna="PrzyznanoOdszkodowanie" class="fa fa<?php echo ($PrzyznanoOdszkodowanie == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue PrzyznanoOdszkodowanieTak" aria-hidden="true"></i>
                        <p class="float_l">przyznano jednorazowe odszkodowanie z tytułu wypadku przy pracy w wysokości</p>
                        <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $WysokoscOdszkodowania; ?>" value="<?php echo ($PrzyznanoOdszkodowanie == 1) ? $WysokoscOdszkodowania : ''; ?>" data-kolumna="WysokoscOdszkodowania" maxlength="10" class="update"/> zł </div>
                    </div>
                    <div class="clear_b"></div>
                </div>
                <div class="zaznaczPoleGrupa ">
                    <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZasilekPogrzebowy; ?>" value="<?php echo $ZasilekPogrzebowy; ?>" data-kolumna="ZasilekPogrzebowy" class="fa fa<?php echo ($ZasilekPogrzebowy == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                        <p>przyznano zasiłek pogrzebowy</p>
                    </div>
                    <div class="clear_b"></div>
                </div>
            </div>

            <label class="margin_t_10 width_100">W związku z wypadkiem stwierdzono niezdolność do pracy na podstawie:</label>
            <div class="zaznaczPoleGrupa ZwolnienieLekarskie">
                <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZwolnienieLekarskie; ?>" value="<?php echo $ZwolnienieLekarskie; ?>" data-kolumna="ZwolnienieLekarskie" class="fa fa<?php echo ($ZwolnienieLekarskie == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue ZwolnienieLekarskieTak" aria-hidden="true"></i>
                    <p class="float_l">zwolnienia lekarskiego na okres od </p>
                    <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $DataZwolnienieOd; ?>" value="<?php echo ($ZwolnienieLekarskie == 1) ? $DataZwolnienieOd : ''; ?>" data-kolumna="DataZwolnienieOd" maxlength="10" class="update datePicker"/> do </div>
                    <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $DataZwolnieniaDo; ?>" value="<?php echo ($ZwolnienieLekarskie == 1) ? $DataZwolnieniaDo : ''; ?>" data-kolumna="DataZwolnieniaDo" maxlength="10" class="update datePicker"/></div>
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa OrzeczenieONiezdolnosci">
                <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OrzeczenieONiezdolnosci; ?>" value="<?php echo $OrzeczenieONiezdolnosci; ?>" data-kolumna="OrzeczenieONiezdolnosci" class="fa fa<?php echo ($OrzeczenieONiezdolnosci == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue OrzeczenieONiezdolnosciTak" aria-hidden="true"></i>
                    <p>orzeczenia o niezdolności do pracy:</p>
                </div>
                <div class="zaznaczPoleGrupa ">
                    <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $TypNiezdolnosci; ?>" value="1" data-kolumna="TypNiezdolnosci" class="fa fa<?php echo ($OrzeczenieONiezdolnosci == 1 && $TypNiezdolnosci == 1) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue TypNiezdolnosci1" aria-hidden="true"></i><p class="float_l">całkowitej</p></div>
                    <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $TypNiezdolnosci; ?>" value="2" data-kolumna="TypNiezdolnosci" class="fa fa<?php echo ($OrzeczenieONiezdolnosci == 1 && $TypNiezdolnosci == 2) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue TypNiezdolnosci2" aria-hidden="true"></i><p class="float_l">częściowej</p></div>
                    <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $TypNiezdolnosci; ?>" value="3" data-kolumna="TypNiezdolnosci" class="fa fa<?php echo ($OrzeczenieONiezdolnosci == 1 && $TypNiezdolnosci == 3) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue TypNiezdolnosci3" aria-hidden="true"></i><p class="float_l">trwałej </p></div>
                    <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $TypNiezdolnosci; ?>" value="4" data-kolumna="TypNiezdolnosci" class="fa fa<?php echo ($OrzeczenieONiezdolnosci == 1 && $TypNiezdolnosci == 4) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue TypNiezdolnosci4" aria-hidden="true"></i><p class="float_l">okresowej do dnia</p></div>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $DataNiezdolnosciDo; ?>" value="<?php echo ($OrzeczenieONiezdolnosci == 1 && $TypNiezdolnosci == 4) ? $DataNiezdolnosciDo : ''; ?>" data-kolumna="DataNiezdolnosciDo" maxlength="10" class="update datePicker DataNiezdolnosciDo"/></div>
                </div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_10">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UbezpieczycielNazwa; ?>" value="1" data-kolumna="UbezpieczycielNazwa" class="fa fa<?php echo ($UbezpieczycielNazwa == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue UbezpieczycielNazwa1" aria-hidden="true"></i><p class="float_l">ZUS</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UbezpieczycielNazwa; ?>" value="2" data-kolumna="UbezpieczycielNazwa" class="fa fa<?php echo ($UbezpieczycielNazwa == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue UbezpieczycielNazwa2" aria-hidden="true"></i><p class="float_l">KRUS</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UbezpieczycielNazwa; ?>" value="3" data-kolumna="UbezpieczycielNazwa" class="fa fa<?php echo ($UbezpieczycielNazwa == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue UbezpieczycielNazwa3" aria-hidden="true"></i><p class="float_l">inne: </p></div>
                <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $UbezpieczycielNazwaInne; ?>" value="<?php echo ($UbezpieczycielNazwa == 3) ? $UbezpieczycielNazwaInne : ''; ?>" data-kolumna="UbezpieczycielNazwaInne" maxlength="10" class="update UbezpieczycielNazwaInne "/></div>
            </div>
            <div class="zaznaczPoleGrupa margin_t_10">
                <div class="zpg_opcja_radio float_l margin_l_45 margin_t_5"><i data-wartosc_domyslna="<?php echo $PrzyznanoSwiadczenie; ?>" value="1" data-kolumna="PrzyznanoSwiadczenie" class="fa fa<?php echo (($UbezpieczycielNazwa == 1 || $UbezpieczycielNazwa == 2 || $UbezpieczycielNazwa == 3) && $PrzyznanoSwiadczenie == 1) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">przyznał rentę</p></div>
                <div class="zpg_opcja_radio float_l margin_t_5"><i data-wartosc_domyslna="<?php echo $PrzyznanoSwiadczenie; ?>" value="2" data-kolumna="PrzyznanoSwiadczenie" class="fa fa<?php echo (($UbezpieczycielNazwa == 1 || $UbezpieczycielNazwa == 2 || $UbezpieczycielNazwa == 3) && $PrzyznanoSwiadczenie == 2) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">inne świadczenie: </p></div>
                <div class="zpg_opcja zpg_opcja_input margin_t_5"><input type="text" data-wartosc_domyslna="<?php echo $PrzyznanoSwiadczenieInne; ?>" value="<?php echo ($UbezpieczycielNazwa == 1 || $UbezpieczycielNazwa == 2 || $UbezpieczycielNazwa == 3) ? $PrzyznanoSwiadczenieInne : ''; ?>" data-kolumna="PrzyznanoSwiadczenieInne" class="update"/></div>
            </div>

            <div class="zpg_opcja_radio margin_l_45 margin_t_10"><p class="float_l">w wysokości: </p></div>
            <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $WysokoscSwiadczenia; ?>" value="<?php echo ($UbezpieczycielNazwa == 1 || $UbezpieczycielNazwa == 2 || $UbezpieczycielNazwa == 3) ? $WysokoscSwiadczenia : ''; ?>" data-kolumna="WysokoscSwiadczenia" maxlength="10" class="update"/> zł miesięcznie, na okres do: </div>
            <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $DataSwiadczeniaDo; ?>" value="<?php echo ($UbezpieczycielNazwa == 1 || $UbezpieczycielNazwa == 2 || $UbezpieczycielNazwa == 3) ? $DataSwiadczeniaDo : ''; ?>" data-kolumna="DataSwiadczeniaDo" maxlength="10" class="update datePicker"/></div>
            <div class="clear_b"></div>

            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsobowa" data-ogolne="0" data-strona="8" data-akcja="<?php echo (!$inne_odszkodowania_tmp && !$dane_o_niezdolnosci_tmp) ? 'dodaj_inne_odszkodowania_oraz_dane_o_niezdolnosci' : 'aktualizuj_inne_odszkodowania_oraz_dane_o_niezdolnosci'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>
        </div>
