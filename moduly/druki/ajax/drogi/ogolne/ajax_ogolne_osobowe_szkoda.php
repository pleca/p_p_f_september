<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

if($akcja == 'edytuj'){
    $element_id_tmp = explode('-',$element_id);

    $umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'UmowaId=' .$element_id_tmp[0]);

    if ($umowa_dane_tmp) {
        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        $TypSzkodyId = $umowa_dane_tmp->TypSzkodyId;
        $RodzajSzkodyId = $umowa_dane_tmp->RodzajSzkodyId;
        $TypZdarzeniaId = $umowa_dane_tmp->TypZdarzeniaId;
        $InnyRodzajSzkody = $umowa_dane_tmp->InnyRodzajSzkody;

    }

    $element_id = $element_id_tmp[0].'-'.$element_id_tmp[1].'-'.$element_id_tmp[2];
}
?>
        <div class="daneStronyUmowyPopUp">
            <?php if ($akcja == 'nowy'){ ?>
            <div class="panel panel-default margin_b_0">
                <div class="panel-heading ">Typ szkody</div>
                    <div class="panel-body">
                <?php } ?>
            <label class="margin_t_10 width_100">Wskaż typ szkody</label>
            <div class="zaznaczPoleGrupa typ_szkody_opcja">
                <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $TypSzkodyId; ?>" value="1" data-kolumna="TypSzkodyId" data-opcja="obrazenia" class="fa fa<?php echo ((isset($_COOKIE['EventTypeID']) && $_COOKIE['EventTypeID'] == 1) || $TypSzkodyId == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue typ_szkody <?php echo (isset($_COOKIE['EventTypeID']) && $_COOKIE['EventTypeID'] == 1) ? 'update' : '' ; ?>" aria-hidden="true"></i><p class="float_l">Obrażenia ciała</p></div>
                <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $TypSzkodyId; ?>" value="2" data-kolumna="TypSzkodyId" data-opcja="smierc" class="fa fa<?php echo ((isset($_COOKIE['EventTypeID']) && $_COOKIE['EventTypeID'] == 2) || $TypSzkodyId == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue typ_szkody <?php echo (isset($_COOKIE['EventTypeID']) && $_COOKIE['EventTypeID'] == 2) ? 'update' : '' ; ?>" aria-hidden="true"></i><p class="float_l">Skutek śmiertelny</p></div>
            </div>
            <div class="clear_b"></div>

            <label class="margin_t_10 width_100">Podaj rodzaj szkody</label>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $RodzajSzkodyId; ?>" value="1" data-kolumna="RodzajSzkodyId" data-opcja="komunikacyjna" class="fa fa<?php echo ($RodzajSzkodyId == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue rodzaj_szkody" aria-hidden="true"></i><p class="float_l">Komunikacyjny</p></div>
                <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $RodzajSzkodyId; ?>" value="2" data-kolumna="RodzajSzkodyId" data-opcja="w_rolnictwie" class="fa fa<?php echo ($RodzajSzkodyId == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue rodzaj_szkody" aria-hidden="true"></i><p class="float_l">W rolnictwie</p></div>
                <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $RodzajSzkodyId; ?>" value="4" data-kolumna="RodzajSzkodyId" data-opcja="w_pracy" class="fa fa<?php echo ($RodzajSzkodyId == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue rodzaj_szkody" aria-hidden="true"></i><p class="float_l">W pracy</p></div>
                <div class="zpg_opcja_radio float_l zpg_opcja_input"><i data-wartosc_domyslna="<?php echo $RodzajSzkodyId; ?>" value="3" data-kolumna="RodzajSzkodyId" data-opcja="inny" class="fa fa<?php echo ($RodzajSzkodyId == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue rodzaj_szkody" aria-hidden="true"></i><p class="float_l">Inny:
                <input type="text" data-wartosc_domyslna="<?php echo $InnyRodzajSzkody; ?>" value="<?php echo $InnyRodzajSzkody; ?>" data-kolumna="InnyRodzajSzkody" class="update"/></p></div>
            </div>
            <div class="clear_b"></div>

            <div class="informacje_o_uczestnikach" style="display:<?php echo ($RodzajSzkodyId == 1) ? 'block' : 'none'; ?>">
                <label class="margin_t_10 width_100">Informacje o uczestnikach zdarzenia</label>
                <div class="zaznaczPoleGrupa">
                    <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $TypZdarzeniaId; ?>" value="1" data-kolumna="TypZdarzeniaId" class="fa fa<?php echo ($TypZdarzeniaId == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">Poszkodowany znajdował się w pojeździe</p></div>
                    <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $TypZdarzeniaId; ?>" value="2" data-kolumna="TypZdarzeniaId" class="fa fa<?php echo ($TypZdarzeniaId == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">Poszkodowanym był pieszy lub rowerzystą</p></div>
                </div>
                <div class="clear_b"></div>
            </div>

            <button data-reakcja="zapisz_zmiany" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsobowa" data-ogolne="1" data-strona="zakladki"
                    data-akcja="<?php echo ($akcja == 'nowy') ? 'dodaj_umowe_osobowa' : 'aktualizuj_strone_umowy'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>
            <?php if ($akcja == 'nowy'){ ?>
        </div>
    </div>
<?php } ?>
</div>