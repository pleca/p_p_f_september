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

            $SygnaturaAkt = $odpowiedzialnosc_karna_tmp->SygnaturaAkt;
            $Oswiadczenie = $odpowiedzialnosc_karna_tmp->Oswiadczenie;
            $WezwanoPolicje = $odpowiedzialnosc_karna_tmp->WezwanoPolicje;
            $MiejscowoscPolicji = $odpowiedzialnosc_karna_tmp->MiejscowoscPolicji;
            $WszczetoPostepowanie = $odpowiedzialnosc_karna_tmp->WszczetoPostepowanie;
            $PostepowanieZarzut = $odpowiedzialnosc_karna_tmp->PostepowanieZarzut;
            $ZarzutArtykul = $odpowiedzialnosc_karna_tmp->ZarzutArtykul;
            $KodeksZarzut = $odpowiedzialnosc_karna_tmp->KodeksZarzut;
            $PostepowanieKarne = $odpowiedzialnosc_karna_tmp->PostepowanieKarne;
            $KarneArtykul = $odpowiedzialnosc_karna_tmp->KarneArtykul;
            $KodeksKarne = $odpowiedzialnosc_karna_tmp->KodeksKarne;
            $SkierowanoAkt = $odpowiedzialnosc_karna_tmp->SkierowanoAkt;
            $Sad = $odpowiedzialnosc_karna_tmp->Sad;
            $ZapadlWyrok = $odpowiedzialnosc_karna_tmp->ZapadlWyrok;
            $Wyrok = $odpowiedzialnosc_karna_tmp->Wyrok;
            $WyrokArtykul = $odpowiedzialnosc_karna_tmp->WyrokArtykul;
            $KodeksArtykul = $odpowiedzialnosc_karna_tmp->KodeksArtykul;
        }


    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneStronyUmowyPopUp">

            <label class="margin_t_10 width_100 gray_background">ODPOWIEDZIALNOŚĆ KARNA</label>

            <label class="margin_t_10 width_100">Sygnatura akt:</label>
            <div class="col-md-4 margin_b_10 inputPole"><input data-wartosc_domyslna="<?php echo $SygnaturaAkt; ?>" value="<?php echo $SygnaturaAkt; ?>" data-kolumna="SygnaturaAkt" type="text" maxlength="32" class="update " placeholder="Sygnatura akt"></div>
            <div class="clear_b"></div>


            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $Oswiadczenie; ?>" value="<?php echo $Oswiadczenie; ?>" data-kolumna="Oswiadczenie" class="fa fa<?php echo ($Oswiadczenie == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>sprawca napisał oświadczenie</p>
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa WezwanoPolicje ">
                <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $WezwanoPolicje; ?>" value="<?php echo $ZWezwanoPolicje; ?>" data-kolumna="WezwanoPolicje" class="fa fa<?php echo ($WezwanoPolicje == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue WezwanoPolicjeTak" aria-hidden="true"></i>
                    <p>na miejsce zdarzenia wezwano policję</p>
                </div>
                    <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">z miejscowości: </p><input type="text" data-wartosc_domyslna="<?php echo $MiejscowoscPolicji; ?>" value="<?php echo ($WezwanoPolicje == 1) ? $MiejscowoscPolicji : ''; ?>" data-kolumna="MiejscowoscPolicji" maxlength="10" class="update"/></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $WszczetoPostepowanie; ?>" value="<?php echo $WszczetoPostepowanie; ?>" data-kolumna="WszczetoPostepowanie" class="fa fa<?php echo ($WszczetoPostepowanie == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>wszczęto postępowanie w sprawie</p>
                </div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa PostepowanieZarzut ">
                <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $PostepowanieZarzut; ?>" value="<?php echo $PostepowanieZarzut; ?>" data-kolumna="PostepowanieZarzut" class="fa fa<?php echo ($PostepowanieZarzut == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue PostepowanieZarzutTak" aria-hidden="true"></i>
                    <p>postawiono sprawcy zarzut</p>
                </div>
                    <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">z artykułu: </p><input type="text" data-wartosc_domyslna="<?php echo $ZarzutArtykul; ?>" value="<?php echo ($PostepowanieZarzut == 1) ? $ZarzutArtykul : ''; ?>" data-kolumna="ZarzutArtykul" maxlength="30" class="update"/></div>
                    <div class="zaznaczPoleGrupa ">
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $KodeksZarzut; ?>" value="1" data-kolumna="KodeksZarzut" class="fa fa<?php echo ($PostepowanieZarzut == 1 && $KodeksZarzut == 1) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">k.k.</p></div>
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $KodeksZarzut; ?>" value="2" data-kolumna="KodeksZarzut" class="fa fa<?php echo ($PostepowanieZarzut == 1 && $KodeksZarzut == 2) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">k.w.</p></div>
                    </div>
                    <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa PostepowanieKarne ">
                <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $PostepowanieKarne; ?>" value="<?php echo $PostepowanieKarne; ?>" data-kolumna="PostepowanieKarne" class="fa fa<?php echo ($PostepowanieKarne == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue PostepowanieKarneTak" aria-hidden="true"></i>
                    <p>postępowanie karne umorzono na podstawie</p>
                </div>
                    <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">artykułu: </p><input type="text" data-wartosc_domyslna="<?php echo $KarneArtykul; ?>" value="<?php echo ($PostepowanieKarne == 1) ? $KarneArtykul : ''; ?>" data-kolumna="KarneArtykul" maxlength="30" class="update"/></div>
                    <div class="zaznaczPoleGrupa ">
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $KodeksKarne; ?>" value="1" data-kolumna="KodeksKarne" class="fa fa<?php echo ($PostepowanieKarne == 1 && $KodeksKarne == 1) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">k.p.k.</p></div>
                        <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $KodeksKarne; ?>" value="2" data-kolumna="KodeksKarne" class="fa fa<?php echo ($PostepowanieKarne == 1 && $KodeksKarne == 2) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">k.p.w.</p></div>
                    </div>
                    <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa SkierowanoAkt ">
                <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $SkierowanoAkt; ?>" value="<?php echo $SkierowanoAkt; ?>" data-kolumna="SkierowanoAkt" class="fa fa<?php echo ($SkierowanoAkt == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue SkierowanoAktTak" aria-hidden="true"></i>
                    <p>skierowano akt oskarżenia do sądu</p>
                </div>
                    <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l"></p><input type="text" data-wartosc_domyslna="<?php echo $Sad; ?>" value="<?php echo ($SkierowanoAkt == 1) ? $Sad : ''; ?>" data-kolumna="Sad" maxlength="80" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa ZapadlWyrok">
                <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZapadlWyrok; ?>" value="<?php echo $ZapadlWyrok; ?>" data-kolumna="ZapadlWyrok" class="fa fa<?php echo ($ZapadlWyrok == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue ZapadlWyrokTak" aria-hidden="true"></i>
                    <p>zapadł wyrok</p>
                </div>
                <div class="zaznaczPoleGrupa ">
                    <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $Wyrok; ?>" value="1" data-kolumna="Wyrok" class="fa fa<?php echo ($ZapadlWyrok == 1 && $Wyrok == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">skazujący </p></div>
                    <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $Wyrok; ?>" value="2" data-kolumna="Wyrok" class="fa fa<?php echo ($ZapadlWyrok == 1 && $Wyrok == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">uniewinniający o czyn z </p></div>
                    <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">artykułu: </p><input type="text" data-wartosc_domyslna="<?php echo $WyrokArtykul; ?>" value="<?php echo ($ZapadlWyrok == 1) ? $WyrokArtykul : ''; ?>" data-kolumna="WyrokArtykul" maxlength="10" class="update"/></div>
                        <div class="zaznaczPoleGrupa ">
                            <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $KodeksArtykul; ?>" value="1" data-kolumna="KodeksArtykul" class="fa fa<?php echo ($ZapadlWyrok == 1 && $KodeksArtykul == 1) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">k.k.</p></div>
                            <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $KodeksArtykul; ?>" value="2" data-kolumna="KodeksArtykul" class="fa fa<?php echo ($ZapadlWyrok == 1 && $KodeksArtykul == 2) ? '-check' : '' ; ?>-square-o fa-lg float_l margin_t_5 attrValue" aria-hidden="true"></i><p class="float_l">k.w.</p></div>
                        </div>
                </div>
                <div class="clear_b"></div>
            </div>

            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="OdpowiedzialnoscKarna" data-ogolne="0" data-strona="6" data-akcja="<?php echo (!$odpowiedzialnosc_karna_tmp) ? 'dodaj_odpowiedzialnosc_karna' : 'aktualizuj_odpowiedzialnosc_karna'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>
        </div>
