<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$disabled = 'disabled';

$element_id = explode('-',$element_id);

$Marka = '';
$Model = '';
$NrRejestracyjny = '';
$Nazwa = '';
$Ulica = '';
$NrDomu = '';
$NrMieszkania = '';
$KodPocztowy = '';
$WartoscMiasto = '';
$DataSzkody = '';
$NumerAkt = '';
$NazwaUbezpieczyciela = '';
$DataUmowyPrzelewu = '';
$NumerSprawy = '';


$umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id[2]);


if($akcja == 'edytuj' ) {

    if ($umowa_dane_tmp) {

        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        $KwotaOdkupienia = $umowa_dane_tmp->KwotaOdkupienia;
        $WysokoscHonorarium = $umowa_dane_tmp->WysokoscHonorarium;
        $OgraniczenieWierzytelnosci = $umowa_dane_tmp->OgraniczenieWierzytelnosci;
        $TytulOgraniczeniaId = $umowa_dane_tmp->TytulOgraniczeniaId;

        $element_id = $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2];

    }
}
?>
<div class="danePozostaleRzeczowe">
    <div class="polaPozostalePolaRzeczowych ">

            <?php if ($umowa_dane_tmp->UmowaRzeczowaTypId == 1 || $umowa_dane_tmp->UmowaRzeczowaTypId == 3) { ?>
                <label class="margin_t_10 width_100">KWOTA ODKUPIENIA:</label>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $KwotaOdkupienia; ?>" value="<?php echo $KwotaOdkupienia; ?>" data-kolumna="KwotaOdkupienia" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Kwota w złotych"></div>
            <?php } else { ?>
                <label class="margin_t_10 width_100">WYSOKOŚĆ HONORARIUM (wyrażona procentowo):</label>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $WysokoscHonorarium; ?>" value="<?php echo $WysokoscHonorarium; ?>" data-kolumna="WysokoscHonorarium" type="number" min="1" max="100" class="update wymagane duzeMaleLiteryCyfry" placeholder="Wartość w procentach"></div>
            <?php } ?>

        <label class="margin_t_10 width_100">CZY KLIENT OGRANICZA WIERZYTELNOŚĆ?</label>
        <div class="zaznaczPoleGrupa">
            <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $OgraniczenieWierzytelnosci ?>" value="1" data-kolumna="OgraniczenieWierzytelnosci" class="fa fa<?php echo ($OgraniczenieWierzytelnosci == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
            <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $OgraniczenieWierzytelnosci; ?>" value="0" data-kolumna="OgraniczenieWierzytelnosci" class="fa fa<?php echo ($OgraniczenieWierzytelnosci == 0) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
            <div class="clear_b"></div>
        </div>
        <label class="margin_t_10 width_100">CEDENT ZBYWA WIERZYTELNOŚCI Z TYTUŁU:</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $TytulOgraniczeniaId; ?>" value="1" data-kolumna="TytulOgraniczeniaId" class="fa fa<?php echo ($TytulOgraniczeniaId == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> utraty wartości handlowej pojazdu,</p></div>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $TytulOgraniczeniaId; ?>" value="2" data-kolumna="TytulOgraniczeniaId" class="fa fa<?php echo ($TytulOgraniczeniaId == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> poniesienia kosztów naprawy pojazdu,</p></div>
            <?php if ($umowa_dane_tmp->UmowaRzeczowaTypId == 2 || $umowa_dane_tmp->UmowaRzeczowaTypId == 4) { ?>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $TytulOgraniczeniaId; ?>" value="3" data-kolumna="TytulOgraniczeniaId" class="fa fa<?php echo ($TytulOgraniczeniaId == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> wypożyczenia pojazdu zastępczego,</p></div>
            <?php } ?>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $TytulOgraniczeniaId; ?>" value="4" data-kolumna="TytulOgraniczeniaId" class="fa fa<?php echo ($TytulOgraniczeniaId == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> szkody całkowitej w pojeździe</p></div>

            <div class="clear_b"></div>
        </div>
    </div>


    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="polaPozostalePolaRzeczowych" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaRzeczowa" data-ogolne="0" data-strona="4" data-akcja="aktualizuj_strone_umowy" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz</button>

</div>


