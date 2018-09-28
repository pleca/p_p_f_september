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

        $oswiadczenie_tmp = $bazaDanych->pobierzDane('*', 'umowaOswiadczenie', 'Id=' . $umowa_dane_tmp->OswiadczenieId);

        if ($oswiadczenie_tmp) {
            $oswiadczenie_tmp = $oswiadczenie_tmp->fetch_object();

            $Miejscowosc = $oswiadczenie_tmp->Miejscowosc;
            $Data = $oswiadczenie_tmp->Data;
            $Tresc = $oswiadczenie_tmp->Tresc;

            $autor_oswiadczenia = $bazaDanych -> pobierzDane('*', 'umowaOsoba', 'Id='.$oswiadczenie_tmp->OsobaId);

            if ($autor_oswiadczenia) {

                $autor_oswiadczenia = $autor_oswiadczenia->fetch_object();

                $Imie = $autor_oswiadczenia->Imie;
                $Nazwisko = $autor_oswiadczenia->Nazwisko;
                $osw_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id=' . $autor_oswiadczenia->AdresId);
                $osw_adres = $osw_adres->fetch_object();
                $Ulica = $osw_adres->Ulica;
                $NrDomu = $osw_adres->NrDomu;
                $NrMieszkania = $osw_adres->NrMieszkania;
                $KodPocztowy = $osw_adres->KodPocztowy;
                $osw_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id=' . $osw_adres->MiastoId);
                $osw_adres_miasto = $osw_adres_miasto->fetch_object();
                $Miasto = $osw_adres_miasto->Wartosc;

            }

        }

    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneOswiadczenie">

            <label class="margin_t_10 width_100 gray_background">OŚWIADCZENIE</label>

            <label class="margin_t_10 width_100">Miejscowość i data</label>
            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Miejscowosc; ?>" value="<?php echo $Miejscowosc; ?>" data-kolumna="Miejscowosc" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>
            <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Data; ?>" value="<?php echo $Data; ?>" data-kolumna="Data" type="text" class="update datePicker" placeholder="Data"></div>

            <label class="margin_t_10 width_100">Imię i nazwisko</label>
            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Imię"></div>
            <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>

            <label class="margin_t_10 width_100">Adres</label>
            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Ulica; ?>" value="<?php echo $Ulica; ?>" data-kolumna="Ulica" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Ulica"></div>
            <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomu; ?>" value="<?php echo $NrDomu; ?>" data-kolumna="NrDomu" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
            <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>" value="<?php echo $NrMieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
            <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="update wymagane sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
            <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $Miasto; ?>" value="<?php echo $Miasto; ?>" data-kolumna="Wartosc" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

            <label class="margin_t_10 width_100">Treść oświadczenia</label>
            <div class="zpg_opcja zpg_opcja_input">
                <textarea class="form-control update textarea_content" id='textarea_content' rows="6" id="comment" data-kolumna="Tresc" data-wartosc_domyslna="<?php echo $Tresc; ?>"><?php echo $Tresc; ?></textarea>
            </div>


                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneOswiadczenie" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOswiadczenie" data-ogolne="0" data-strona="12" data-akcja="<?php echo (!$oswiadczenie_tmp) ? 'dodaj_oswiadczenie' : 'aktualizuj_oswiadczenie'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

            </div>
        </div>
