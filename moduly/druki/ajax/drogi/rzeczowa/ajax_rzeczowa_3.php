<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$disabled = 'disabled';

$OtrzymanaKwotaWierzytelności = '';
$UzyskanoOdszkodowanie = 0;
$KwotaOdszkodowania = '';

$element_id = explode('-',$element_id);

$umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id[2]);


if($akcja == 'edytuj' ) {

    if ($umowa_dane_tmp) {

        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        $OtrzymanaKwotaWierzytelności = $umowa_dane_tmp->OtrzymanaKwotaWierzytelności;
        $UzyskanoOdszkodowanie = $umowa_dane_tmp->UzyskanoOdszkodowanie;
        $KwotaOdszkodowania = $umowa_dane_tmp->KwotaOdszkodowania;


        $element_id = $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2];

    }
}
?>
<div class="daneoswiadczeniaUmowy">
    <label class="margin_t_10 width_100">KWOTA ODSZKODOWANIA</label>
    <div class="polaOswiadczeniaUmowy ">

        <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $OtrzymanaKwotaWierzytelności; ?>" value="<?php echo $OtrzymanaKwotaWierzytelności; ?>" data-kolumna="OtrzymanaKwotaWierzytelności" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Otrzymana kwota"></div>
        <div class="clear_b"></div>
        <?php if ($umowa_dane_tmp->UmowaRzeczowaTypId == '3' || $umowa_dane_tmp->UmowaRzeczowaTypId == '4') { ?>
        <div class="zaznaczPoleGrupa">
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $UzyskanoOdszkodowanie; ?>" value="0" data-kolumna="UzyskanoOdszkodowanie" class="fa fa<?php echo ($UzyskanoOdszkodowanie == 0) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p> nie uzyskał dodatkowych kwot odszkodowania,</p></div>
            <div class="zpg_opcja_radio margin_t_10 padding_r_10"><i data-wartosc_domyslna="<?php echo $UzyskanoOdszkodowanie ?>" value="1" data-kolumna="UzyskanoOdszkodowanie" class="fa fa<?php echo ($UzyskanoOdszkodowanie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i>
                    <div class="zpg_opcja zpg_opcja_input"><p class="float_l"> uzyskał dodatkowo odszkodowanie w łącznej kwocie</p><input type="text" data-wartosc_domyslna="<?php echo $KwotaOdszkodowania; ?>" value="<?php echo $KwotaOdszkodowania; ?>" data-kolumna="KwotaOdszkodowania" maxlength="10" class="update"/> zł brutto</p></div></div>
            <div class="clear_b"></div>
        </div>
        <?php } ?>
    </div>


    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="polaOswiadczeniaUmowy" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaRzeczowa" data-ogolne="0" data-strona="3" data-akcja="aktualizuj_strone_umowy" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz</button>

</div>


