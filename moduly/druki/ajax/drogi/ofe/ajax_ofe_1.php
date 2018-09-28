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
    $osobaZmarlyId = $umowa_dane_tmp->OsobaZmarlyId;

}

$osobaZmarly = $bazaDanych -> pobierzDane('*', 'umowaOsoba', 'Id='.$umowa_dane_tmp->OsobaZmarlyId);

    if ($osobaZmarly) {

        $osobaZmarly = $osobaZmarly -> fetch_object();


        $DataSmierci = $umowa_dane_tmp->DataSmierci;
        $Pokrewienstwo = $umowa_dane_tmp->Pokrewienstwo;
        $zm_id = $umowa_dane_tmp->OsobaZmarlyId;
        $Imie = $osobaZmarly->Imie;
        $Nazwisko = $osobaZmarly->Nazwisko;
        $Pesel = $osobaZmarly->Pesel;
        $Dowod = $osobaZmarly->Dowod;
        $Nip = $osobaZmarly->Nip;
        $zm_adres = $bazaDanych -> pobierzDane('*', 'umowaAdres', 'Id='.$osobaZmarly->AdresId);
        $zm_adres = $zm_adres -> fetch_object();
        $Ulica = $zm_adres->Ulica;
        $NrDomu = $zm_adres->NrDomu;
        $NrMieszkania = $zm_adres->NrMieszkania;
        $KodPocztowy = $zm_adres->KodPocztowy;
        $zm_adres_miasto = $bazaDanych -> pobierzDane('*', 'umowaAdresMiasto', 'Id='.$zm_adres->MiastoId);
        $zm_adres_miasto = $zm_adres_miasto -> fetch_object();
        $Wartosc = $zm_adres_miasto->Wartosc;

        $zm_rachunek_emerytalny = $bazaDanych -> pobierzDane('*', 'umowaRachunekBankowy', "OsobaId=".$umowa_dane_tmp->OsobaZmarlyId." AND Typ=2");
        $zm_rachunek_emerytalny = $zm_rachunek_emerytalny -> fetch_object();
        $Numer = $zm_rachunek_emerytalny->Numer;
        $Nazwa = $zm_rachunek_emerytalny->Nazwa;

        $disabled = '';
        $update = 'update wymagane';


}

?>

    <div class="danePosiadaczaRachunkuEmerytalnego">
        <label class=" width_100">DANE ZMARŁEGO POSIADACZA RACHUNKU EMERYTALNEGO/BANKOWEGO</label>
                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Imię"></div>
                <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>

                <label class="margin_t_10 width_100">ADRES ZAMIESZKANIA POSIADACZA RACHUNKU BANKOWEGO</label>
                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Ulica; ?>" value="<?php echo $Ulica; ?>" data-kolumna="Ulica" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomu; ?>" value="<?php echo $NrDomu; ?>" data-kolumna="NrDomu" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>" value="<?php echo $NrMieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="update wymagane sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $Wartosc; ?>" value="<?php echo $Wartosc; ?>" data-kolumna="Wartosc" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

                <label class="margin_t_10 width_100">DANE IDENTYFIKACYJNE</label>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Pesel; ?>" value="<?php echo $Pesel; ?>" data-kolumna="Pesel" type="text" maxlength="11" class="update wymagane sprawdzPesel poleLiczbowe"  placeholder="Pesel"></div>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Dowod; ?>" value="<?php echo $Dowod; ?>" data-kolumna="Dowod" type="text" class="update wymagane sprawdzNumerDowodu duzeMaleLiteryCyfry" maxlength="9" placeholder="Seria i numer dowodu"></div>
                <div class="col-md-4 inputPole"><input data-wartosc_domyslna="<?php echo $Nip; ?>" value="<?php echo $Nip; ?>" data-kolumna="Nip" type="text" maxlength="11" class="update wymagane poleLiczbowe"  placeholder="NIP"></div>


                <label class="margin_t_10 width_100">DANE O RACHUNKU</label>
                <div class="col-md-12 margin_b_10 inputPole"><input data-wartosc_domyslna="<?php echo $Numer; ?>" value="<?php echo $Numer; ?>" data-kolumna="Numer" type="text" maxlength="32" class="update sprawdzIBAN poleLiczbowe" placeholder="Numer rachunku emerytalnego"></div>
                <div class="col-md-12 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwa; ?>" value="<?php echo $Nazwa; ?>" data-kolumna="Nazwa" type="text" class="update duzeMaleLiteryCyfry" placeholder="Podmiot prowadzący rachunek emerytalny"></div>

                <label class="margin_t_10 width_100">POZOSTAŁE INFORMACJE</label>
                <div class="col-md-6 padding_r_10 inputPole"><input data-wartosc_domyslna="<?php echo $DataSmierci; ?>" value="<?php echo $DataSmierci; ?>" data-kolumna="DataSmierci" type="text" maxlength="32" class="update poleLiczbowe datePicker" placeholder="Data śmierci posiadacza rachunku emerytalnego"></div>
                <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Pokrewienstwo; ?>" value="<?php echo $Pokrewienstwo; ?>" data-kolumna="Pokrewienstwo" type="text" class="update duzeMaleLiteryCyfry" placeholder="Stopień pokrewieństwa z uprawnionym"></div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="danePosiadaczaRachunkuEmerytalnego" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="1" data-akcja="<?php echo (empty($zm_id)) ? 'dodaj_posiadacza_rachunku_emerytalnego' : 'aktualizuj_posiadacza_rachunku_emerytalnego'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

    </div>
