<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$UmowaDzialajacyWImieniuId = '4';
$disabled = 'disabled';
$update = '';

$element_id_tmp = explode('-',$element_id);
$umowa_dane_tmp = $bazaDanych -> pobierzDane('*', 'umowa'.mb_ucfirst($droga), 'Id='.$element_id_tmp[2]);


if ($umowa_dane_tmp) {

    $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();
    $UmowaDzialajacyWImieniuId = $umowa_dane_tmp->UmowaDzialajacyWImieniuId;

}
$umowaSlownikDzialajacWImieniu = $bazaDanych -> pobierzDane('*','umowaSlownikDzialajacWImieniu', 'czy_usuniety=0' );

if ($UmowaDzialajacyWImieniuId != '4') {

    $umowaDzialajacyWImieniuWartosc = $bazaDanych -> pobierzDane('Wartosc','umowaSlownikDzialajacWImieniu', 'Id='.$UmowaDzialajacyWImieniuId );
    $umowaDzialajacyWImieniuWartosc = $umowaDzialajacyWImieniuWartosc ->fetch_object();



    $dzialajacyWImieniu = $bazaDanych -> pobierzDane('*', 'umowaOsoba', 'Id='.$umowa_dane_tmp->OsobaPoszkodowanyId);

    if ($dzialajacyWImieniu) {

        $dzialajacyWImieniu = $dzialajacyWImieniu -> fetch_object();

        $dw_id = $umowa_dane_tmp->OsobaPoszkodowanyId;
        $dw_imie = $dzialajacyWImieniu->Imie;
        $dw_nazwisko = $dzialajacyWImieniu->Nazwisko;
        $dw_pesel = $dzialajacyWImieniu->Pesel;
        $dw_dowod = $dzialajacyWImieniu->Dowod;
        $dw_adres = $bazaDanych -> pobierzDane('*', 'umowaAdres', 'Id='.$dzialajacyWImieniu->AdresId);
        $dw_adres = $dw_adres -> fetch_object();
        $dw_ulica = $dw_adres->Ulica;
        $dw_nr_domu = $dw_adres->NrDomu;
        $dw_nr_mieszkania = $dw_adres->NrMieszkania;
        $dw_kod_pocztowy = $dw_adres->KodPocztowy;
        $dw_adres_miasto = $bazaDanych -> pobierzDane('*', 'umowaAdresMiasto', 'Id='.$dw_adres->MiastoId);
        $dw_adres_miasto = $dw_adres_miasto -> fetch_object();
        $dw_miasto = $dw_adres_miasto->Wartosc;
        $dw_kontakt = $bazaDanych -> pobierzDane('*', 'umowaKontakt', 'Id='.$dzialajacyWImieniu->KontaktId);

        if($dw_kontakt){
            $dw_kontakt = $dw_kontakt -> fetch_object();
            $dw_mail = $dw_kontakt->Mail;
            $dw_telefon = $dw_kontakt->Telefon;
        }


        $disabled = '';
        $update = 'update wymagane';
    }

}


?>

<div class="daneDzialajacyWImieniu">
    <label class=" width_100">KLIENT DZIAŁA W IMIENIU?</label>
    <div class="sposobPlatnosci margin_b_10">
        <div class="dropdown width_100">
            <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <div data-kolumna="UmowaDzialajacyWImieniuId" data-wartosc_domyslna="<?php echo ($UmowaDzialajacyWImieniuId == '') ? '' : $UmowaDzialajacyWImieniuId ; ?>" value="<?php echo ($UmowaDzialajacyWImieniuId == '') ? '4' : $UmowaDzialajacyWImieniuId ; ?>" class="dpUstawOpcjeNazwa attrValue update wymagane float_l"><?php echo ($UmowaDzialajacyWImieniuId == '4') ? 'Brak' : $umowaDzialajacyWImieniuWartosc->Wartosc ; ?></div>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php
                    while($poj_umowaSlownikDzialajacWImieniu = $umowaSlownikDzialajacWImieniu->fetch_object()){
                        echo '<li class="dpUstawOpcje dzialaWImieniuOpcja" data-element_id="'.$poj_umowaSlownikDzialajacWImieniu->Id.'">'.mb_ucfirst($poj_umowaSlownikDzialajacWImieniu->Wartosc).'</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="dzialajacyWImieniuDane">
        <div class="col-md-6 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_imie; ?>" value="<?php echo $dw_imie; ?>" data-kolumna="Imie" type="text" class="<?php echo $update; ?>  duzeMaleLiteryCyfry" placeholder="Imię"></div>
        <div class="col-md-6 inputPole "><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_nazwisko; ?>" value="<?php echo $dw_nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="<?php echo $update; ?>  duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="3" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>
        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="8" data-kolumna="TypOsoby" type="text" class="update" placeholder=""></div>

        <label class="margin_t_10 width_100">ADRES ZAMELDOWANIA</label>
        <div class="col-md-6 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_ulica; ?>" value="<?php echo $dw_ulica; ?>" data-kolumna="Ulica" type="text" class="<?php echo $update; ?>  duzeMaleLiteryCyfry" placeholder="Ulica"></div>
        <div class="col-md-3 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_nr_domu; ?>" value="<?php echo $dw_nr_domu; ?>" data-kolumna="NrDomu" type="text" class="<?php echo $update; ?>  duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
        <div class="col-md-3 inputPole "><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_nr_mieszkania; ?>" value="<?php echo $dw_nr_mieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
        <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_kod_pocztowy; ?>" value="<?php echo $dw_kod_pocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="<?php echo $update; ?> wymagane sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
        <div class="col-md-8 inputPole margin_t_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_miasto; ?>" value="<?php echo $dw_miasto; ?>" data-kolumna="Wartosc" type="text" class="<?php echo $update; ?> " placeholder="Miejscowość"></div>

        <label class="margin_t_10 width_100">DANE Z DOWODU</label>
        <div class="col-md-6 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_pesel; ?>" value="<?php echo $dw_pesel; ?>" data-kolumna="Pesel" type="text" maxlength="11" class="<?php echo $update; ?> sprawdzPesel poleLiczbowe"  placeholder="Pesel"></div>
        <div class="col-md-6 inputPole "><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_dowod; ?>" value="<?php echo $dw_dowod; ?>" data-kolumna="Dowod" type="text" class="<?php echo $update; ?> sprawdzNumerDowodu duzeMaleLiteryCyfry" maxlength="9" placeholder="Seria i numer dowodu"></div>

        <label class="margin_t_10 width_100">DANE DO KONTAKTU</label>
        <div class="col-md-4 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_telefon; ?>" value="<?php echo $dw_telefon; ?>" data-kolumna="Telefon" type="text" class="update poleLiczbowe" placeholder="Telefon"></div>
        <div class="col-md-8 inputPole "><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $dw_mail; ?>" value="<?php echo $dw_mail; ?>" data-kolumna="Mail" type="text" class="update sprawdzEmail duzeMaleLiteryCyfry" placeholder="Adres e-mail"></div>
    </div>

    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneDzialajacyWImieniu" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="1" data-strona="dzialajacy_w_imieniu" data-akcja="<?php echo (empty($dw_id)) ? 'dodaj_dzialajacy_w_imieniu' : 'aktualizuj_dzialajacy_w_imieniu'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>


</div>
