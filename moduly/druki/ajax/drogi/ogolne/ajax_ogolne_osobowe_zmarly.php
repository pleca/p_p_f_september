<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$disabled = 'disabled';
$update = '';


if($akcja == 'edytuj' ){

    $element_id_tmp = explode('-',$element_id);
    $umowa_dane_tmp = $bazaDanych -> pobierzDane('*', 'umowa'.mb_ucfirst($droga), 'Id='.$element_id_tmp[2]);

    if ($umowa_dane_tmp) {
        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        $TypSzkodyId = $umowa_dane_tmp->TypSzkodyId;
        $RodzajSzkodyId = $umowa_dane_tmp->RodzajSzkodyId;
        $TypZdarzeniaId = $umowa_dane_tmp->TypZdarzeniaId;
        $InnyRodzajSzkody = $umowa_dane_tmp->InnyRodzajSzkody;
    }


    $poszkodowany = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id=' . $umowa_dane_tmp->OsobaPoszkodowanyId);

    if ($poszkodowany) {

        $poszkodowany = $poszkodowany->fetch_object();

        $dw_id = $umowa_dane_tmp->OsobaPoszkodowanyId;
        $dw_imie = $poszkodowany->Imie;
        $dw_nazwisko = $poszkodowany->Nazwisko;
        $dw_pesel = $poszkodowany->Pesel;
        $dw_wiek = $poszkodowany->Wiek;
        $dw_dowod = $poszkodowany->Dowod;
        $dw_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id=' . $poszkodowany->AdresId);
        $dw_adres = $dw_adres->fetch_object();
        $dw_ulica = $dw_adres->Ulica;
        $dw_nr_domu = $dw_adres->NrDomu;
        $dw_nr_mieszkania = $dw_adres->NrMieszkania;
        $dw_kod_pocztowy = $dw_adres->KodPocztowy;
        $dw_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id=' . $dw_adres->MiastoId);
        $dw_adres_miasto = $dw_adres_miasto->fetch_object();
        $dw_miasto = $dw_adres_miasto->Wartosc;
        $dw_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id=' . $poszkodowany->KontaktId);

        if ($dw_kontakt) {
            $dw_kontakt = $dw_kontakt->fetch_object();
            $dw_mail = $dw_kontakt->Mail;
            $dw_telefon = $dw_kontakt->Telefon;
        }

    } else {
        $dw_id = '';
        $dw_imie = '';
        $dw_wiek = '';
        $dw_nazwisko = '';
        $dw_pesel = '';
        $dw_dowod = '';
        $dw_ulica = '';
        $dw_nr_domu = '';
        $dw_nr_mieszkania = '';
        $dw_kod_pocztowy = '';
        $dw_miasto = '';
        $dw_telefon = '';
        $dw_mail = '';
    }

    $disabled = '';
    $update = 'update';

    $disabled = ($umowa_dane_tmp->OsobaPoszkodowanyId == $element_id_tmp[1]) ? 'disabled' : '' ;
}

?>

<div class="danePoszkodowany">

    <?php
    if ($TypSzkodyId == 1) {
        ?>

        <label class="margin_t_10 width_100 gray_background">DANE POSZKODOWANEGO (wypełnić jeśli inny niż Zleceniodawca)</label>

        <div class="zpg_opcja_radio float_r padding_r_10 margin_t_10 margin_b_0"><i data-wartosc_domyslna="<?php echo ($umowa_dane_tmp->OsobaPoszkodowanyId != $element_id_tmp[1]) ? '1' : '0' ; ?>" value="<?php echo ($umowa_dane_tmp->OsobaPoszkodowanyId != $element_id_tmp[1]) ? '1' : '0' ; ?>" data-kolumna="PoszkodowanyKlientem" class="fa fa<?php echo ($umowa_dane_tmp->OsobaPoszkodowanyId != $element_id_tmp[1]) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue inny_poszkodowany" aria-hidden="true"></i><p class="float_l">Poszkodowany inny niż Zleceniodawca</p></div>

        <?php
    } else {
        echo '<label class="margin_t_10 width_100 gray_background">DANE ZMARŁEGO</label>';
    }
    ?>

    <label class="margin_t_10 width_100">Imię i nazwisko</label>
    <div class="col-md-6 inputPole padding_r_10"><input  data-wartosc_domyslna="<?php echo $dw_imie; ?>" value="<?php echo $dw_imie; ?>" data-kolumna="Imie" type="text" class="<?php echo $update ; ?> duzeMaleLiteryCyfry" placeholder="Imię"></div>
    <div class="col-md-6 inputPole "><input  data-wartosc_domyslna="<?php echo $dw_nazwisko; ?>" value="<?php echo $dw_nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="<?php echo ($TypSzkodyId == 1) ? '8' : '4' ; ?>" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>

    <label class="margin_t_10 width_100">Adres zamieszkania</label>
    <div class="col-md-6 inputPole padding_r_10"><input  data-wartosc_domyslna="<?php echo $dw_ulica; ?>" value="<?php echo $dw_ulica; ?>" data-kolumna="Ulica" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Ulica"></div>
    <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $dw_nr_domu; ?>" value="<?php echo $dw_nr_domu; ?>" data-kolumna="NrDomu" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
    <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $dw_nr_mieszkania; ?>" value="<?php echo $dw_nr_mieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
    <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input  data-wartosc_domyslna="<?php echo $dw_kod_pocztowy; ?>" value="<?php echo $dw_kod_pocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="<?php echo $update; ?> sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy" autocomplete="off"></div>
    <div class="col-md-8 inputPole margin_t_10"><input  data-wartosc_domyslna="<?php echo $dw_miasto; ?>" value="<?php echo $dw_miasto; ?>" data-kolumna="Wartosc" type="text" class="<?php echo $update; ?>" placeholder="Miejscowość"></div>

    <label class="margin_t_10 width_100">Dane z dowodu</label>
    <div class="col-md-4 inputPole padding_r_10"><input  data-wartosc_domyslna="<?php echo $dw_pesel; ?>" value="<?php echo $dw_pesel; ?>" data-kolumna="Pesel" type="text" maxlength="11" class="<?php echo $update; ?> sprawdzPesel poleLiczbowe" placeholder="Pesel"></div>
    <div class="col-md-4 inputPole padding_r_10"><input  data-wartosc_domyslna="<?php echo $dw_dowod; ?>" value="<?php echo $dw_dowod; ?>" data-kolumna="Dowod" type="text" class="<?php echo $update; ?> sprawdzNumerDowoduLubPusty duzeMaleLiteryCyfry" maxlength="9"  placeholder="Seria i numer dowodu"></div>
    <div class="col-md-4 inputPole "><input  data-wartosc_domyslna="<?php echo $dw_wiek; ?>" value="<?php echo $dw_wiek; ?>" data-kolumna="Wiek" type="text" class="<?php echo $update; ?> poleLiczbowe" maxlength="3"  placeholder="Wiek"></div>

    <?php if ($TypSzkodyId == 1) { ?>
        <label class="margin_t_10 width_100">Dane do kontaktu</label>
        <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $dw_telefon; ?>" value="<?php echo $dw_telefon; ?>" data-kolumna="Telefon" type="text" class="update poleLiczbowe"  placeholder="Telefon"></div>
        <div class="col-md-8 inputPole "><input  data-wartosc_domyslna="<?php echo $dw_mail; ?>" value="<?php echo $dw_mail; ?>" data-kolumna="Mail" type="text" class="update sprawdzEmail duzeMaleLiteryCyfry"  placeholder="Adres e-mail"></div>
    <?php } ?>

    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="danePoszkodowany" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="1" data-strona="osobowe_zmarly" data-akcja="<?php echo (!$poszkodowany) ? 'dodaj_osobe' : 'aktualizuj_osobe' ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0 zmienPoszkodowanego">Zapisz zmiany</button>

</div>
