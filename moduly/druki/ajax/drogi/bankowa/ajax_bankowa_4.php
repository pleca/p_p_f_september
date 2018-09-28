<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

$ua_zam_Ulica = '';
$ua_zam_NrDomu = '';
$ua_zam_NrMieszkania = '';
$ua_zam_KodPocztowy = '';
$ua_zam_Miasto = '';

$ua_kor_Ulica = '';
$ua_kor_NrDomu = '';
$ua_kor_NrMieszkania = '';
$ua_kor_KodPocztowy = '';
$ua_kor_Miasto = '';

$disabled = '';
$update = '';

if($akcja == 'edytuj' ){
    $element_id = explode('-',$element_id);

    $umowa_dane = $bazaDanych->pobierzDane('AdresKorJakZameldowania, AdresKorId, OsobaUprawnionyDoInfId', 'umowa'.mb_ucfirst($droga), 'Id = '.$element_id[2]);
    $umowa_dane = $umowa_dane->fetch_object();

    $umowa_adres_kor_id = $umowa_dane->AdresKorId;

    $uprawniony_dane = $bazaDanych->pobierzDane('Imie, Nazwisko, Pesel', 'umowaOsoba', 'Id = '.$umowa_dane->OsobaUprawnionyDoInfId);

    if($uprawniony_dane) {
        $uprawniony_dane = $uprawniony_dane->fetch_object();

        $ImieUprawnionyDoInfo = $uprawniony_dane->Imie;
        $NazwiskoUprawnionyDoInfo = $uprawniony_dane->Nazwisko;
        $PeselUprawnionyDoInfo = $uprawniony_dane->Pesel;
    }


    $klient_adres = $bazaDanych->pobierzDane('AdresId', 'umowaOsoba', 'Id = '.$element_id[1]);
    $klient_adres = $klient_adres->fetch_object();
    $umowa_adres_zam_id = $klient_adres->AdresId;

    if(!empty($umowa_adres_kor_id)){
        $umowa_adres_kor_dane = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_adres_kor_id);
        $umowa_adres_kor_dane = $umowa_adres_kor_dane->fetch_object();

        $ua_kor_Ulica = $umowa_adres_kor_dane->Ulica;
        $ua_kor_NrDomu = $umowa_adres_kor_dane->NrDomu;
        $ua_kor_NrMieszkania = $umowa_adres_kor_dane->NrMieszkania;
        $ua_kor_KodPocztowy = $umowa_adres_kor_dane->KodPocztowy;
        $miasto_tmp = $bazaDanych->pobierzDane('Wartosc','umowaAdresMiasto','Id = '.$umowa_adres_kor_dane->MiastoId);
        $miasto_tmp = $miasto_tmp->fetch_object();
        $ua_kor_Miasto = $miasto_tmp->Wartosc;
    }

    $umowa_adres_zam_dane = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_adres_zam_id);
    $umowa_adres_zam_dane = $umowa_adres_zam_dane->fetch_object();

    $ua_zam_Ulica = $umowa_adres_zam_dane->Ulica;
    $ua_zam_NrDomu = $umowa_adres_zam_dane->NrDomu;
    $ua_zam_NrMieszkania = $umowa_adres_zam_dane->NrMieszkania;
    $ua_zam_KodPocztowy = $umowa_adres_zam_dane->KodPocztowy;
    $miasto_tmp = $bazaDanych->pobierzDane('Wartosc','umowaAdresMiasto','Id = '.$umowa_adres_zam_dane->MiastoId);
    $miasto_tmp = $miasto_tmp->fetch_object();
    $ua_zam_Miasto = $miasto_tmp->Wartosc;

    if($umowa_dane->AdresKorJakZameldowania == 1){
        $disabled = 'disabled';
    }

    if($umowa_dane->AdresKorJakZameldowania == 0){
        $update = 'update';
    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}


?>

<div class="daneStronyUmowyPopUp">
    <label class="width_100 gray_background">ADRES DO KORESPONDENCJI</label>
    <div class="zaznaczPoleGrupa margin_b_10">
        <div class="zpg_opcja"><i data-kolumna="AdresKorJakZameldowania" data-wartosc_domyslna="<?php echo $umowa_dane->AdresKorJakZameldowania; ?>" value="<?php echo $umowa_dane->AdresKorJakZameldowania; ?>" class="fa fa<?php echo ($umowa_dane->AdresKorJakZameldowania == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue zmienAdres" aria-hidden="true"></i><p>Taki jak zameldowania</p></div>
        <div class="clear_b"></div>
    </div>
    <div class="adresDoKorespondencjiUmowa">
        <div class="col-md-6 inputPole adk_ulica padding_r_10"><input <?php echo $disabled; ?> data-zam_wartosc="<?php echo $ua_zam_Ulica; ?>" data-wartosc_domyslna="<?php echo $ua_kor_Ulica ; ?>" value="<?php echo ($umowa_dane->AdresKorJakZameldowania == 1) ? $ua_zam_Ulica : $ua_kor_Ulica ; ?>" data-kolumna="Ulica" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Ulica"></div>
        <div class="col-md-3 inputPole adk_nr_domu padding_r_10"><input <?php echo $disabled; ?> data-zam_wartosc="<?php echo $ua_zam_NrDomu; ?>" data-wartosc_domyslna="<?php echo $ua_kor_NrDomu ; ?>" value="<?php echo ($umowa_dane->AdresKorJakZameldowania == 1) ? $ua_zam_NrDomu : $ua_kor_NrDomu ; ?>" data-kolumna="NrDomu" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
        <div class="col-md-3 inputPole adk_nr_mieszkania "><input <?php echo $disabled; ?> data-zam_wartosc="<?php echo $ua_zam_NrMieszkania; ?>" data-wartosc_domyslna="<?php echo $ua_kor_NrMieszkania ; ?>" value="<?php echo ($umowa_dane->AdresKorJakZameldowania == 1) ? $ua_zam_NrMieszkania : $ua_kor_NrMieszkania ; ?>" data-kolumna="NrMieszkania" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
        <div class="col-md-4 inputPole adk_kod_pocztowy padding_r_10 margin_t_10"><input <?php echo $disabled; ?> data-zam_wartosc="<?php echo $ua_zam_KodPocztowy; ?>" data-wartosc_domyslna="<?php echo $ua_kor_KodPocztowy ; ?>" value="<?php echo ($umowa_dane->AdresKorJakZameldowania == 1) ? $ua_zam_KodPocztowy : $ua_kor_KodPocztowy ; ?>" data-kolumna="KodPocztowy" type="text" class="<?php echo $update; ?> poleLiczbowe sprawdzKodPocztowy" placeholder="Kod pocztowy"></div>
        <div class="col-md-8 inputPole adk_miasto margin_t_10"><input <?php echo $disabled; ?> data-zam_wartosc="<?php echo $ua_zam_Miasto; ?>" data-wartosc_domyslna="<?php echo $ua_kor_Miasto ; ?>" value="<?php echo ($umowa_dane->AdresKorJakZameldowania == 1) ? $ua_zam_Miasto : $ua_kor_Miasto ; ?>" data-kolumna="Wartosc" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>
    </div>

    <label class="margin_t_10 width_100 gray_background">DANE UPRAWNIONEGO DO INFORMACJI TELEFONICZNEJ</label>

    <label class="margin_t_10 width_100">Imię i nazwisko</label>
    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $ImieUprawnionyDoInfo; ?>" value="<?php echo $ImieUprawnionyDoInfo; ?>" data-kolumna="ImieTel" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
    <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $NazwiskoUprawnionyDoInfo; ?>" value="<?php echo $NazwiskoUprawnionyDoInfo; ?>" data-kolumna="NazwiskoTel" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="10" data-kolumna="OsobaTypIdTel" type="text" class="update" placeholder=""></div>

    <label class="margin_t_10 width_100">PESEL</label>
    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $PeselUprawnionyDoInfo; ?>" value="<?php echo $PeselUprawnionyDoInfo; ?>" data-kolumna="PeselTel" type="text" maxlength="11" placeholder="Pesel" class="update"></div>


    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaBankowa" data-strona="4" data-ogolne="0" data-akcja="aktualizuj_adres_do_korespondencji_bankowa" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

</div>
