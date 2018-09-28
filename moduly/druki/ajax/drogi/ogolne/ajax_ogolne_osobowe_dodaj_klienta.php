<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$strona = (isset($_POST['strona'])) ? htmlspecialchars($_POST['strona']) : '';
$ogolne = (isset($_POST['ogolne'])) ? htmlspecialchars($_POST['ogolne']) : '';

$element_id = explode('-', $element_id);

if ($akcja == 'edytuj') {

    $id_klienta = $element_id[1];

    if(empty($id_klienta)) {

        $Imie = '';
        $Nazwisko = '';
        $Pesel = '';
        $Wiek = '';
        $Dowod = '';
        $Ulica = '';
        $NrDomu = '';
        $NrMieszkania = '';
        $KodPocztowy = '';
        $Mail = '';
        $Telefon = '';
        $WartoscMiasto = '';
        $SposobPlatnosciId = '';
        $ImieOdbiorcaWynagrodzenia = '';
        $NazwiskoOdbiorcaWynagrodzenia = '';

    } else {

        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $id_klienta );

        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

        $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_osoba_tmp->KontaktId);
        $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();

        $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_osoba_tmp->AdresId);
        $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

        $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_osoba_adres_tmp->MiastoId);
        $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

        $Imie = $umowa_osoba_tmp->Imie;
        $Nazwisko = $umowa_osoba_tmp->Nazwisko;
        $Pesel = $umowa_osoba_tmp->Pesel;
        $Wiek = $umowa_osoba_tmp->Wiek;
        $Dowod = $umowa_osoba_tmp->Dowod;
        $Ulica = $umowa_osoba_adres_tmp->Ulica;
        $NrDomu = $umowa_osoba_adres_tmp->NrDomu;
        $NrMieszkania = $umowa_osoba_adres_tmp->NrMieszkania;
        $KodPocztowy = $umowa_osoba_adres_tmp->KodPocztowy;
        $WartoscMiasto = $umowa_osoba_adres_miasto_tmp->Wartosc;
        $Mail = $umowa_osoba_kontakt_tmp->Mail;
        $Telefon = $umowa_osoba_kontakt_tmp->Telefon;


        $umowa_osobowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id = ' . $element_id[2]);
        $umowa_osobowa_tmp = $umowa_osobowa_tmp->fetch_object();

        $umowa_uprawiony_do_inf_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $umowa_osobowa_tmp->OsobaUprawnionyDoInfId);

        if ($umowa_uprawiony_do_inf_tmp) {
            $umowa_uprawiony_do_inf_tmp = $umowa_uprawiony_do_inf_tmp->fetch_object();

            $ImieUprawnionyDoInfo = $umowa_uprawiony_do_inf_tmp->Imie;
            $NazwiskoUprawnionyDoInfo = $umowa_uprawiony_do_inf_tmp->Nazwisko;
            $PeselUprawnionyDoInfo = $umowa_uprawiony_do_inf_tmp->Pesel;
        } else {
            $ImieUprawnionyDoInfo = '';
            $NazwiskoUprawnionyDoInfo = '';
            $PeselUprawnionyDoInfo = '';
        }
    }

    if($umowa_osobowa_tmp->SposobPlatnosciId == 2) {
        $umowa_rachunek_bankowy_tmp = $bazaDanych->pobierzDane('Numer', 'umowaRachunekBankowy', 'Id = ' . $umowa_osobowa_tmp->RachunekBankowyId);

        if ($umowa_rachunek_bankowy_tmp) {
            $umowa_rachunek_bankowy_tmp = $umowa_rachunek_bankowy_tmp->fetch_object();
            $Numer = $umowa_rachunek_bankowy_tmp->Numer;
            $SposobPlatnosciId = 2;
        }

        $umowa_wynagrodzenie_odbiorca_tmp = $bazaDanych->pobierzDane('Imie, Nazwisko','umowaOsoba','Id = '.$umowa_osobowa_tmp->OdbiorcaId);
        if($umowa_wynagrodzenie_odbiorca_tmp){
            $umowa_wynagrodzenie_odbiorca_tmp = $umowa_wynagrodzenie_odbiorca_tmp->fetch_object();
        }
    }


    $ImieOdbiorcaWynagrodzenia = $umowa_wynagrodzenie_odbiorca_tmp->Imie;
    $NazwiskoOdbiorcaWynagrodzenia = $umowa_wynagrodzenie_odbiorca_tmp->Nazwisko;

    $disabled = ($umowa_osobowa_tmp->OdbiorcaId == $id_klienta) ? 'disabled' : '' ;


}

$element_id = $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2];

?>
<div class="daneKlientaPopUp">

    <label class="margin_t_10 width_100 gray_background">DANE ZLECENIODAWCY (dane osoby na rzecz której dochodzimy roszczeń)</label>
    <label class="margin_t_10 width_100">Imię i nazwisko</label>
    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>"
                                                        value="<?php echo $Imie; ?>" data-kolumna="Imie"
                                                        type="text"
                                                        class="update wymagane duzeMaleLiteryCyfry"
                                                        placeholder="Imię"></div>
    <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>"
                                            value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko"
                                            type="text" class="update wymagane duzeMaleLiteryCyfry"
                                            placeholder="Nazwisko"></div>
    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>


    <label class="margin_t_10 width_100">Adres zamieszkania</label>
    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Ulica; ?>"
                                                        value="<?php echo $Ulica; ?>"
                                                        data-kolumna="Ulica" type="text"
                                                        class="update wymagane duzeMaleLiteryCyfry"
                                                        placeholder="Ulica"></div>
    <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomu; ?>"
                                                        value="<?php echo $NrDomu; ?>"
                                                        data-kolumna="NrDomu" type="text"
                                                        class="update wymagane duzeMaleLiteryCyfry"
                                                        placeholder="Nr domu"></div>
    <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>"
                                            value="<?php echo $NrMieszkania; ?>"
                                            data-kolumna="NrMieszkania" type="text"
                                            class="update duzeMaleLiteryCyfry"
                                            placeholder="Nr mieszkania"></div>
    <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input
                data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>"
                data-kolumna="KodPocztowy" type="text"
                class="update wymagane sprawdzKodPocztowy poleLiczbowe" maxlength="6"
                placeholder="Kod pocztowy" autocomplete="off"></div>
    <div class="col-md-8 inputPole margin_t_10"><input
                data-wartosc_domyslna="<?php echo $WartoscMiasto; ?>"
                value="<?php echo $WartoscMiasto; ?>" data-kolumna="Wartosc" type="text"
                class="update wymagane duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

    <label class="margin_t_10 width_100">Dane z dowodu</label>
    <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Pesel; ?>"
                                                        value="<?php echo $Pesel; ?>"
                                                        data-kolumna="Pesel" type="text" maxlength="11"
                                                        class="update wymagane sprawdzPesel poleLiczbowe"
                                                        placeholder="Pesel"></div>
    <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Dowod; ?>"
                                                        value="<?php echo $Dowod; ?>" data-kolumna="Dowod"
                                                        type="text"
                                                        class="update sprawdzNumerDowoduLubPusty duzeMaleLiteryCyfry"
                                                        maxlength="9" placeholder="Seria i numer dowodu"></div>
    <div class="col-md-4 inputPole "><input data-wartosc_domyslna="<?php echo $Wiek; ?>"
                                            value="<?php echo $Wiek; ?>" data-kolumna="Wiek"
                                            type="text"
                                            class="update poleLiczbowe"
                                            maxlength="3" placeholder="Wiek"></div>

    <label class="margin_t_10 width_100">Dane do kontaktu</label>
    <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Telefon; ?>"
                                                        value="<?php echo $Telefon; ?>"
                                                        data-kolumna="Telefon" type="text"
                                                        class="update poleLiczbowe"
                                                        placeholder="Telefon"></div>
    <div class="col-md-8 inputPole "><input data-wartosc_domyslna="<?php echo $Mail; ?>"
                                            value="<?php echo $Mail; ?>" data-kolumna="Mail" type="text"
                                            class="update sprawdzEmail duzeMaleLiteryCyfry"
                                            placeholder="Adres e-mail"></div>


    <label class="margin_t_10 width_100 gray_background">DANE DO WYNAGRODZENIA</label>
    <div class="numerRachunku">
        <label class=" width_100">Numer rachunku</label>
        <div class="col-md-12 margin_b_10 inputPole"><input value="<?php echo $Numer; ?>" data-kolumna="Numer" type="text" maxlength="32" class="update sprawdzIBAN poleLiczbowe" placeholder="Numer rachunku bankowego" autocomplete="off"></div>
    </div>
    <div class="zpg_opcja_radio float_r padding_r_10 margin_t_10 margin_b_10"><i data-wartosc_domyslna="<?php echo ($umowa_osobowa_tmp->OdbiorcaId == $id_klienta) ? '1' : '0' ; ?>" value="<?php echo ($umowa_osobowa_tmp->OdbiorcaId == $id_klienta) ? '1' : '0' ; ?>" data-kolumna="OdbiorcaWynagrodzeniaKlient" class="fa fa<?php echo ($umowa_osobowa_tmp->OdbiorcaId == $id_klienta) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue rachunek_klienta update" aria-hidden="true"></i><p class="float_l">Posiadaczem rachunku bankowego jest klient</p></div>

    <div class="dane_odbiorcy">
        <label class="width_100">Imię i nazwisko</label>
        <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $ImieOdbiorcaWynagrodzenia; ?>" value="<?php echo $ImieOdbiorcaWynagrodzenia; ?>" data-kolumna="ImieWynagrodzenie" type="text" class="update duzeMaleLiteryCyfry" <?php echo $disabled; ?> placeholder="Imię"></div>
        <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $NazwiskoOdbiorcaWynagrodzenia; ?>" value="<?php echo $NazwiskoOdbiorcaWynagrodzenia; ?>" data-kolumna="NazwiskoWynagrodzenie" type="text" class="update duzeMaleLiteryCyfry" <?php echo $disabled; ?> placeholder="Nazwisko"></div>
    </div>


    <label class="margin_t_10 width_100 gray_background">DANE UPRAWNIONEGO DO INFORMACJI TELEFONICZNEJ</label>
    <label class="margin_t_10 width_100">Imię i nazwisko</label>
    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $ImieUprawnionyDoInfo; ?>" value="<?php echo $ImieUprawnionyDoInfo; ?>" data-kolumna="ImieTel" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
    <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $NazwiskoUprawnionyDoInfo; ?>" value="<?php echo $NazwiskoUprawnionyDoInfo; ?>" data-kolumna="NazwiskoTel" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="10" data-kolumna="OsobaTypIdTel" type="text" class="update" placeholder=""></div>

    <label class="margin_t_10 width_100">PESEL</label>
    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $PeselUprawnionyDoInfo; ?>" value="<?php echo $PeselUprawnionyDoInfo; ?>" data-kolumna="PeselTel" type="text" maxlength="11" placeholder="Pesel" class="update"></div>


    <button data-reakcja="zapisz_zmiany" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneKlientaPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="1" data-strona="zakladki"
            data-akcja="<?php echo (empty($id_klienta)) ? 'dodaj_klienta_osobowe' : 'aktualizuj_klienta_osobowe'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>
</div>

