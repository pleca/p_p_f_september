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

        $odpowiedzialnosc_cywilna_tmp = $bazaDanych->pobierzDane('*', 'umowaOdpowiedzialnoscCywilna', 'Id=' . $umowa_dane_tmp->OdpowiedzialnoscCywilnaId);

        if ($odpowiedzialnosc_cywilna_tmp) {
            $odpowiedzialnosc_cywilna_tmp = $odpowiedzialnosc_cywilna_tmp->fetch_object();

//$NumerSzkody = $odpowiedzialnosc_cywilna_tmp->NumerSzkody;
            $ZgloszonoPojazdZOc = $odpowiedzialnosc_cywilna_tmp->ZgloszonoPojazdZOc;
//$DataZgloszeniaPojazduZOc = $odpowiedzialnosc_cywilna_tmp->DataZgloszeniaPojazduZOc;
            $ZgloszonoOsobeZOc = $odpowiedzialnosc_cywilna_tmp->ZgloszonoOsobeZOc;
//$DataZgloszeniaOsobyZOc = $odpowiedzialnosc_cywilna_tmp->DataZgloszeniaOsobyZOc;
            $WyplaconoZOcSprawcy = $odpowiedzialnosc_cywilna_tmp->WyplaconoZOcSprawcy;
//$SzkodaWPojezdzie = $odpowiedzialnosc_cywilna_tmp->SzkodaWPojezdzie;
//$SzkodaOsobowa = $odpowiedzialnosc_cywilna_tmp->SzkodaOsobowa;
            $KwotaOdszkodowania = $odpowiedzialnosc_cywilna_tmp->KwotaOdszkodowania;
            $PodstawaPrawna = $odpowiedzialnosc_cywilna_tmp->PodstawaPrawna;
            $DataWyroku = $odpowiedzialnosc_cywilna_tmp->DataWyroku;

        }


    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
<div class="daneStronyUmowyPopUp">

    <label class="margin_t_10 width_100 gray_background">ODPOWIEDZIALNOŚĆ CYWILNA</label>

    <!--            <label class="margin_t_10 width_100">Numer szkody:</label>
            <div class="col-md-4 margin_b_10 inputPole"><input data-wartosc_domyslna="<?php /*echo $NumerSzkody; */?>" value="<?php /*echo $NumerSzkody; */?>" data-kolumna="NumerSzkody" type="text" maxlength="32" class="update " placeholder="Numer szkody"></div>
            <div class="clear_b"></div>-->

    <label class="margin_t_10 width_100">Czy zgłoszono szkodę w pojeździe do ubezpieczyciela OC sprawcy?</label>
    <div class="zaznaczPoleGrupa ZgloszonoPojazdZOc ">
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZgloszonoPojazdZOc; ?>" value="1" data-kolumna="ZgloszonoPojazdZOc" class="fa fa<?php echo ($ZgloszonoPojazdZOc == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZgloszonoPojazdZOcTak" aria-hidden="true"></i><p class="float_l">TAK, </p></div>
        <!--<div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">data zgłoszenia:</p><input type="text" data-wartosc_domyslna="<?php /*echo $DataZgloszeniaPojazduZOc; */?>" value="<?php /*echo ($ZgloszonoPojazdZOc == 1) ? $DataZgloszeniaPojazduZOc : ''; */?>" data-kolumna="DataZgloszeniaPojazduZOc" maxlength="10" class="datePicker update"/></div>-->
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZgloszonoPojazdZOc; ?>" value="2" data-kolumna="ZgloszonoPojazdZOc" class="fa fa<?php echo ($ZgloszonoPojazdZOc == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZgloszonoPojazdZOcNie" aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZgloszonoPojazdZOc; ?>" value="3" data-kolumna="ZgloszonoPojazdZOc" class="fa fa<?php echo ($ZgloszonoPojazdZOc == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZgloszonoPojazdZOcNie" aria-hidden="true"></i><p class="float_l">NIE WIEM</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">Czy zgłoszono szkodę na osobie do ubezpieczyciela OC sprawcy?</label>
    <div class="zaznaczPoleGrupa ZgloszonoOsobeZOc ">
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZgloszonoOsobeZOc; ?>" value="1" data-kolumna="ZgloszonoOsobeZOc" class="fa fa<?php echo ($ZgloszonoOsobeZOc == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZgloszonoOsobeZOcTak" aria-hidden="true"></i><p class="float_l">TAK, </p></div>
        <!--<div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">data zgłoszenia:</p><input type="text" data-wartosc_domyslna="<?php /*echo $DataZgloszeniaOsobyZOc; */?>" value="<?php /*echo ($ZgloszonoOsobeZOc == 1) ? $DataZgloszeniaOsobyZOc : ''; */?>" data-kolumna="DataZgloszeniaOsobyZOc" maxlength="10" class="datePicker update"/></div>-->
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZgloszonoOsobeZOc; ?>" value="2" data-kolumna="ZgloszonoOsobeZOc" class="fa fa<?php echo ($ZgloszonoOsobeZOc == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZgloszonoOsobeZOcNie" aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZgloszonoOsobeZOc; ?>" value="3" data-kolumna="ZgloszonoOsobeZOc" class="fa fa<?php echo ($ZgloszonoOsobeZOc == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZgloszonoOsobeZOcNie" aria-hidden="true"></i><p class="float_l">NIE WIEM</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">Czy ubezpieczyciel wypłacił odszkodowanie z OC sprawcy?</label>
    <div class="zaznaczPoleGrupa ">
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WyplaconoZOcSprawcy; ?>" value="1" data-kolumna="WyplaconoZOcSprawcy" class="fa fa<?php echo ($WyplaconoZOcSprawcy == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $WyplaconoZOcSprawcy; ?>" value="2" data-kolumna="WyplaconoZOcSprawcy" class="fa fa<?php echo ($WyplaconoZOcSprawcy == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="clear_b"></div>
    </div>


    <label>
        <div class="zpg_opcja zpg_opcja_input">
            <p class="float_l">Ubezpieczyciel wypłacił odszkodowanie w kwocie:</p>
            <input class="padding_r_10 width_30 update" type="text" data-wartosc_domyslna="<?php echo $KwotaOdszkodowania; ?>" value="<?php echo $KwotaOdszkodowania; ?>" data-kolumna="KwotaOdszkodowania"/> zł.</div>
    </label>

    <!--            <div class="zaznaczPoleGrupa ">
                            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php /*echo $SzkodaWPojezdzie; */?>" value="<?php /*echo $SzkodaWPojezdzie; */?>" data-kolumna="SzkodaWPojezdzie" class="fa fa<?php /*echo ($SzkodaWPojezdzie == 1) ? '-check' : ''; */?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                                <p>szkody w pojeździe</p>
                            </div>
                        </div>-->
    <div class="zaznaczPoleGrupa SzkodaOsobowa">
        <!--                <div class="zpg_opcja margin_t_10"><i data-wartosc_domyslna="<?php /*echo $SzkodaOsobowa; */?>" value="<?php /*echo $SzkodaOsobowa; */?>" data-kolumna="SzkodaOsobowa" class="fa fa<?php /*echo ($SzkodaOsobowa == 1) ? '-check' : ''; */?>-square-o fa-2 float_l attrValue SzkodaOsobowaTak" aria-hidden="true"></i>
                    <p>szkody osobowej</p>
                </div>-->
        <div class="zpg_opcja_radio margin_l_10"><p class="float_l">na podstawie: </p><i data-wartosc_domyslna="<?php echo $PodstawaPrawna; ?>" value="1" data-kolumna="PodstawaPrawna" class="fa fa<?php echo ($PodstawaPrawna == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l"> decyzji </p></div>
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PodstawaPrawna; ?>" value="2" data-kolumna="PodstawaPrawna" class="fa fa<?php echo ($PodstawaPrawna == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">ugody </p></div>
        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PodstawaPrawna; ?>" value="3" data-kolumna="PodstawaPrawna" class="fa fa<?php echo ($PodstawaPrawna == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">wyroku z dnia: </p></div>
        <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $DataWyroku; ?>" value="<?php echo $DataWyroku; ?>" data-kolumna="DataWyroku" maxlength="10" class="update datePicker"/></div>
        <div class="clear_b"></div>
    </div>

    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="OdpowiedzialnoscCywilna" data-ogolne="0" data-strona="5" data-akcja="<?php echo (!$odpowiedzialnosc_cywilna_tmp) ? 'dodaj_odpowiedzialnosc_cywilna' : 'aktualizuj_odpowiedzialnosc_cywilna'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>
</div>
