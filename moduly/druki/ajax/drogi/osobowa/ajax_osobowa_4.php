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

        $odpowiedzialnosc_karna_tmp = $bazaDanych->pobierzDane('*', 'umowaOdpowiedzialnoscKarna', 'Id=' . $umowa_dane_tmp->OdpowiedzialnoscKarnaId);

        if ($odpowiedzialnosc_karna_tmp) {
            $odpowiedzialnosc_karna_tmp = $odpowiedzialnosc_karna_tmp->fetch_object();

            $WezwanoPolicje = $odpowiedzialnosc_karna_tmp->WezwanoPolicje;
            $MiejscowoscPolicji = $odpowiedzialnosc_karna_tmp->MiejscowoscPolicji;
            $RodzajZakonczenia = $odpowiedzialnosc_karna_tmp->RodzajZakonczenia;
            $Sad = $odpowiedzialnosc_karna_tmp->Sad;
        }


    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneStronyUmowyPopUp">

            <label class="margin_t_10 width_100 gray_background">ODPOWIEDZIALNOŚĆ KARNA</label>

            <div class="zaznaczPoleGrupa margin_t_10 WezwanoPolicje ">
                <div class="zpg_opcja zpg_opcja_input">
                    <i data-wartosc_domyslna="<?php echo $WezwanoPolicje; ?>" value="<?php echo $WezwanoPolicje; ?>" data-kolumna="WezwanoPolicje" class="fa fa<?php echo ($WezwanoPolicje == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue WezwanoPolicjeTak" aria-hidden="true"></i>
                    <p class="float_l">na miejsce zdarzenia wezwano policję z miejscowości:  </p>
                            <input type="text" data-wartosc_domyslna="<?php echo $MiejscowoscPolicji; ?>" value="<?php echo ($WezwanoPolicje == 1) ? $MiejscowoscPolicji : ''; ?>" data-kolumna="MiejscowoscPolicji" maxlength="40" class="update width_45"/>
                </div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Sprawa została zakończona:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $RodzajZakonczenia; ?>" value="1" data-kolumna="RodzajZakonczenia" class="fa fa<?php echo ($RodzajZakonczenia == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> oświadczeniem sprawcy,</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $RodzajZakonczenia; ?>" value="2" data-kolumna="RodzajZakonczenia" class="fa fa<?php echo ($RodzajZakonczenia == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> mandatem wystawionym przez policję,</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $RodzajZakonczenia; ?>" value="3" data-kolumna="RodzajZakonczenia" class="fa fa<?php echo ($RodzajZakonczenia == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> umorzeniem przez Prokuraturę,</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $RodzajZakonczenia; ?>" value="4" data-kolumna="RodzajZakonczenia" class="fa fa<?php echo ($RodzajZakonczenia == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l"> wyrokiem Sądu  </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $Sad; ?>" value="<?php echo ($RodzajZakonczenia == 4) ? $Sad : ''; ?>" data-kolumna="Sad" maxlength="120" class="update margin_l_5 width_45"/></div>
                </div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $RodzajZakonczenia; ?>" value="5" data-kolumna="RodzajZakonczenia" class="fa fa<?php echo ($RodzajZakonczenia == 5) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> nadal trwa postępowanie</p></div>
                <div class="clear_b"></div>
            </div>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="OdpowiedzialnoscKarna" data-ogolne="0" data-strona="4" data-akcja="<?php echo (!$odpowiedzialnosc_karna_tmp) ? 'dodaj_odpowiedzialnosc_karna' : 'aktualizuj_odpowiedzialnosc_karna'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>