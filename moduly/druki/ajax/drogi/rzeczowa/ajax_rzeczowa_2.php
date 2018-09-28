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

        $DataSzkody = $umowa_dane_tmp->DataSzkody;
        $NumerAkt = $umowa_dane_tmp->NumerAkt;
        $NazwaUbezpieczyciela = $umowa_dane_tmp->NazwaUbezpieczyciela;
        $DataUmowyPrzelewu = $umowa_dane_tmp->DataUmowyPrzelewu;
        $NumerSprawy = $umowa_dane_tmp->NumerSprawy;
        $pojazd_id_tmp = $umowa_dane_tmp->PojazdId;
        $ubezpieczyciel_id_tmp = $umowa_dane_tmp->UbezpieczycielId;

        $umowa_pojazd_tmp = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id=' . $pojazd_id_tmp);
        if ($umowa_pojazd_tmp){
            $umowa_pojazd_tmp = $umowa_pojazd_tmp->fetch_object();

            $Marka = $umowa_pojazd_tmp->Marka;
            $Model = $umowa_pojazd_tmp->Model;
            $NrRejestracyjny = $umowa_pojazd_tmp->NrRejestracyjny;
        }

        $umowa_ubezpieczyciel_tmp = $bazaDanych->pobierzDane('*', 'umowaUbezpieczyciel', 'Id=' . $ubezpieczyciel_id_tmp);
        if ($umowa_ubezpieczyciel_tmp) {
            $umowa_ubezpieczyciel_tmp = $umowa_ubezpieczyciel_tmp->fetch_object();

            $Nazwa = $umowa_ubezpieczyciel_tmp->Nazwa;

            $umowa_ubezpieczyciel_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id=' . $umowa_ubezpieczyciel_tmp->AdresId);
            $umowa_ubezpieczyciel_adres_tmp = $umowa_ubezpieczyciel_adres_tmp->fetch_object();

            $Ulica = $umowa_ubezpieczyciel_adres_tmp->Ulica;
            $NrDomu = $umowa_ubezpieczyciel_adres_tmp->NrDomu;
            $NrMieszkania = $umowa_ubezpieczyciel_adres_tmp->NrMieszkania;
            $KodPocztowy = $umowa_ubezpieczyciel_adres_tmp->KodPocztowy;

            $umowa_ubezpieczyciel_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id=' . $umowa_ubezpieczyciel_adres_tmp->MiastoId);
            $umowa_ubezpieczyciel_miasto_tmp = $umowa_ubezpieczyciel_miasto_tmp->fetch_object();

            $WartoscMiasto = $umowa_ubezpieczyciel_miasto_tmp->Wartosc;
        }


        $element_id = $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2];

    }
}
?>
<div class="danePrzedmiotuUmowy">
    <label class="margin_t_10 width_100">DANE POJAZU</label>
    <label class="margin_t_10 width_100">Marka, model, numer rejestracyjny</label>
    <div class="polaPrzedmiotuUmowy ">

            <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Marka; ?>" value="<?php echo $Marka; ?>" data-kolumna="Marka" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Marka pojazdu"></div>
            <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Model; ?>" value="<?php echo $Model; ?>" data-kolumna="Model" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Model pojazdu"></div>
            <div class="col-md-4 inputPole "><input data-wartosc_domyslna="<?php echo $NrRejestracyjny; ?>" value="<?php echo $NrRejestracyjny; ?>" data-kolumna="NrRejestracyjny" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Numer rejestracyjny"></div>


            <label class="margin_t_10 width_100">DANE TOWARZYSTWA UBEZPIECZENIOWEGO</label>
            <div class="col-md-12 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwa; ?>" value="<?php echo $Nazwa; ?>" data-kolumna="Nazwa" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nazwa Towarzystwa Ubezpieczeniowego"></div>
            <div class="col-md-6 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $Ulica; ?>" value="<?php echo $Ulica; ?>" data-kolumna="Ulica" type="text" class="update <?php echo ($umowa_dane_tmp->UmowaRzeczowaTypId == '1' || $umowa_dane_tmp->UmowaRzeczowaTypId == '2') ? 'wymagane' : ''; ?> duzeMaleLiteryCyfry" placeholder="Ulica"></div>
            <div class="col-md-3 inputPole padding_r_10 margin_t_10" ><input data-wartosc_domyslna="<?php echo $NrDomu; ?>" value="<?php echo $NrDomu; ?>" data-kolumna="NrDomu" type="text" class="update <?php echo ($umowa_dane_tmp->UmowaRzeczowaTypId == '1' || $umowa_dane_tmp->UmowaRzeczowaTypId == '2') ? 'wymagane' : ''; ?> duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
            <div class="col-md-3 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>" value="<?php echo $NrMieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
            <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="update <?php echo ($umowa_dane_tmp->UmowaRzeczowaTypId == '1' || $umowa_dane_tmp->UmowaRzeczowaTypId == '2') ? 'wymagane' : ''; ?> sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
            <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiasto; ?>" value="<?php echo $WartoscMiasto; ?>" data-kolumna="Wartosc" type="text" class="update <?php echo ($umowa_dane_tmp->UmowaRzeczowaTypId == '1' || $umowa_dane_tmp->UmowaRzeczowaTypId == '2') ? 'wymagane' : ''; ?> duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>


            <label class="margin_t_10 width_100">Data szkody, numer akt</label>
            <div class="col-md-6 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $DataSzkody; ?>" value="<?php echo $DataSzkody; ?>" data-kolumna="DataSzkody" type="text" class="update wymagane datePicker" placeholder="Data wystąpienia szkody"></div>
            <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $NumerAkt; ?>" value="<?php echo $NumerAkt; ?>" data-kolumna="NumerAkt" type="text" class="update <?php echo ($umowa_dane_tmp->UmowaRzeczowaTypId == '1' || $umowa_dane_tmp->UmowaRzeczowaTypId == '2') ? 'wymagane' : ''; ?>" placeholder="Numer akt szkodowych"></div>

            <?php if ($umowa_dane_tmp->UmowaRzeczowaTypId == '3' || $umowa_dane_tmp->UmowaRzeczowaTypId == '4') { ?>
            <div class="col-md-12 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $NazwaUbezpieczyciela; ?>" value="<?php echo $NazwaUbezpieczyciela; ?>" data-kolumna="NazwaUbezpieczyciela" type="text" class="update <?php echo ($umowa_dane_tmp->UmowaRzeczowaTypId == '3' || $umowa_dane_tmp->UmowaRzeczowaTypId == '4') ? 'wymagane' : ''; ?> duzeMaleLiteryCyfry" placeholder="Nazwa Ubezpieczyciela"></div>
            <div class="col-md-6 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $DataUmowyPrzelewu; ?>" value="<?php echo $DataUmowyPrzelewu; ?>" data-kolumna="DataUmowyPrzelewu" type="text" class="update datePicker" placeholder="Data umowy przelewu wierzytelności"></div>
            <div class="col-md-6 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $NumerSprawy; ?>" value="<?php echo $NumerSprawy; ?>" data-kolumna="NumerSprawy" type="text" class="update <?php echo ($umowa_dane_tmp->UmowaRzeczowaTypId == '3' || $umowa_dane_tmp->UmowaRzeczowaTypId == '4') ? 'wymagane' : ''; ?>" placeholder="Numer sprawy"></div>
            <?php } ?>
    </div>


    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="polaPrzedmiotuUmowy" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaRzeczowa" data-ogolne="0" data-strona="2" data-akcja="<?php echo (!$pojazd_id_tmp && !$ubezpieczyciel_id_tmp) ? 'dodaj_przedmiot_umowy' : 'aktualizuj_przedmiot_umowy'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz</button>

</div>


