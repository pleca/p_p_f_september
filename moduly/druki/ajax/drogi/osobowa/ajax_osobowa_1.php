<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$disabled = 'disabled';
$update = '';


if($akcja == 'edytuj' ){
    $element_id = explode('-',$element_id);

    $umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id[2]);

    if ($umowa_dane_tmp) {
        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        $UmowaRodzajUprawnionegoId = $umowa_dane_tmp->UmowaRodzajUprawnionegoId;
        $umowaSlownikRodzajUprawnionego = $bazaDanych -> pobierzDane('*','umowaSlownikRodzajUprawnionego', 'czy_usuniety=0' );

        if ($UmowaRodzajUprawnionegoId != '4' && $UmowaRodzajUprawnionegoId != '0') {

            $umowaSlownikRodzajUprawnionegoWartosc = $bazaDanych -> pobierzDane('Wartosc','umowaSlownikRodzajUprawnionego', 'Id='.$UmowaRodzajUprawnionegoId);
            $umowaSlownikRodzajUprawnionegoWartosc = $umowaSlownikRodzajUprawnionegoWartosc->fetch_object();

            $umowa_uprawiony_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id=' . $umowa_dane_tmp->OsobaUprawnionyId);

            if ($umowa_uprawiony_tmp) {

                $umowa_uprawiony_tmp = $umowa_uprawiony_tmp->fetch_object();

                $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_uprawiony_tmp->KontaktId);
                $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();

                $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_uprawiony_tmp->AdresId);
                $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                $Imie = $umowa_uprawiony_tmp->Imie;
                $Nazwisko = $umowa_uprawiony_tmp->Nazwisko;
                $Pesel = $umowa_uprawiony_tmp->Pesel;
                $Wiek = $umowa_uprawiony_tmp->Wiek;
                $Dowod = $umowa_uprawiony_tmp->Dowod;
                $Ulica = $umowa_osoba_adres_tmp->Ulica;
                $NrDomu = $umowa_osoba_adres_tmp->NrDomu;
                $NrMieszkania = $umowa_osoba_adres_tmp->NrMieszkania;
                $KodPocztowy = $umowa_osoba_adres_tmp->KodPocztowy;
                $WartoscMiasto = $umowa_osoba_adres_miasto_tmp->Wartosc;
                $Mail = $umowa_osoba_kontakt_tmp->Mail;
                $Telefon = $umowa_osoba_kontakt_tmp->Telefon;

                $disabled = '';
                $update = 'update';

            } else {
                $Imie = '';
                $Nazwisko = '';
                $Pesel = '';
                $Dowod = '';
                $Ulica = '';
                $NrDomu = '';
                $NrMieszkania = '';
                $KodPocztowy = '';
                $WartoscMiasto = '';
                $Mail = '';
                $Telefon = '';
                $Wiek = '';
            }
        }

        $umowa_uprawiony_do_inf_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $umowa_dane_tmp->OsobaUprawnionyDoInfId);

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

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>

<div class="daneUprawnionegoPopUp">

    <label class="margin_t_10 width_100 gray_background">W IMIENIU KLIENTA UMOWĘ PODPISUJE</label>

    <!--<label class="margin_t_10 width_100">W imieniu klienta umowę podpisuje:</label>-->
    <div class="sposobPlatnosci margin_b_10">
        <div class="dropdown width_100">
            <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><div data-kolumna="UmowaRodzajUprawnionegoId" data-wartosc_domyslna="<?php echo ($UmowaRodzajUprawnionegoId == '') ? '' : $UmowaRodzajUprawnionegoId; ?>" value="<?php echo ($UmowaRodzajUprawnionegoId == '') ? '4' : $UmowaRodzajUprawnionegoId; ?>" class="dpUstawOpcjeNazwa attrValue update float_l"><?php echo ($UmowaRodzajUprawnionegoId == "4" || $UmowaRodzajUprawnionegoId == "0") ? "Brak" : $umowaSlownikRodzajUprawnionegoWartosc->Wartosc; ?></div>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php
                while($poj_umowaSlownikRodzajUprawnionego = $umowaSlownikRodzajUprawnionego->fetch_object()){
                    echo '<li class="dpUstawOpcje UmowaRodzajUprawnionegoOpcja" data-element_id="'.$poj_umowaSlownikRodzajUprawnionego->Id.'">'.mb_ucfirst($poj_umowaSlownikRodzajUprawnionego->Wartosc).'</li>';
                }
                ?>
            </ul>
        </div>
    </div>


    <label class="margin_t_10 width_100">Imię i nazwisko</label>
    <div class="col-md-6 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Imię"></div>
    <div class="col-md-6 inputPole "><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="9" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>



    <label class="margin_t_10 width_100">Adres zameldowania</label>
    <div class="col-md-6 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $Ulica; ?>" value="<?php echo $Ulica; ?>" data-kolumna="Ulica" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Ulica"></div>
    <div class="col-md-3 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $NrDomu; ?>" value="<?php echo $NrDomu; ?>" data-kolumna="NrDomu" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
    <div class="col-md-3 inputPole "><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $NrMieszkania; ?>" value="<?php echo $NrMieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
    <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input  <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="<?php echo $update; ?> sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy" autocomplete="off"></div>
    <div class="col-md-8 inputPole margin_t_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $WartoscMiasto; ?>" value="<?php echo $WartoscMiasto; ?>" data-kolumna="Wartosc" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

    <label class="margin_t_10 width_100">Dane z dowodu</label>
    <div class="col-md-4 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $Pesel; ?>" value="<?php echo $Pesel; ?>" data-kolumna="Pesel" type="text" maxlength="11" placeholder="Pesel" class="<?php echo $update; ?> peselUprawniony"></div>
    <div class="col-md-4 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $Dowod; ?>" value="<?php echo $Dowod; ?>" data-kolumna="Dowod" type="text" class="<?php echo $update; ?> duzeMaleLiteryCyfry dowodUprawniony" maxlength="9" placeholder="Seria i numer dowodu"></div>
    <div class="col-md-4 inputPole "><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $Wiek; ?>" value="<?php echo $Wiek; ?>" data-kolumna="Wiek" type="text" class="<?php echo $update; ?> poleLiczbowe" maxlength="3" placeholder="Wiek"></div>


    <label class="margin_t_10 width_100">Dane do kontaktu</label>
    <div class="col-md-4 inputPole padding_r_10"><input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $Telefon; ?>" value="<?php echo $Telefon; ?>" data-kolumna="Telefon" type="text" class="update poleLiczbowe telefonUprawniony" placeholder="Telefon"></div>
    <div class="col-md-8 inputPole ">
        <input <?php echo $disabled; ?> data-wartosc_domyslna="<?php echo $Mail; ?>" value="<?php echo $Mail; ?>" data-kolumna="Mail" type="text" class="sprawdzEmail duzeMaleLiteryCyfry emailUprawniony" placeholder="Adres e-mail">
    </div>


    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneUprawnionegoPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="1" data-akcja="<?php echo (!$umowa_uprawiony_tmp) ? 'dodaj_uprawnionych' : 'aktualizuj_uprawnionych'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz</button>
</div>