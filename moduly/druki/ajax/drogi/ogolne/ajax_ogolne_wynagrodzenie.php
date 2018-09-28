<?php

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
    $akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

    $Numer = '';
    $Imie = '';
    $Nazwisko = '';
    $Ulica = '';
    $NrDomu = '';
    $NrMieszkania = '';
    $KodPocztowy = '';
    $WartoscMiasto = '';
    $SposobPlatnosciId = '';

    $umowatmp = $bazaDanych->pobierzDane('UmowaTypIdd','umowa','Id = '.$element_id[0]);

    if(!is_null($umowa_tmp)) {
        $umowa_tmp = $umowa_tmp->fetch_object();
    }

    if($akcja == 'edytuj' ){
        $element_id = explode('-',$element_id);

        $umowa_dane_tmp = $bazaDanych->pobierzDane('SposobPlatnosciId, OdbiorcaId, RachunekBankowyId','umowa'.mb_ucfirst($droga),'Id = '.$element_id[2]);

        if(!is_null($umowa_dane_tmp)) {
            $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();
        }

        if($umowa_dane_tmp->SposobPlatnosciId == 2){
            $umowa_rachunek_bankowy_tmp = $bazaDanych->pobierzDane('Numer, OsobaId','umowaRachunekBankowy','Id = '.$umowa_dane_tmp->RachunekBankowyId);

            if ($umowa_rachunek_bankowy_tmp) {
                $umowa_rachunek_bankowy_tmp = $umowa_rachunek_bankowy_tmp->fetch_object();
                $Numer = $umowa_rachunek_bankowy_tmp->Numer;
            }

            $SposobPlatnosciId = 2;

            $umowa_wynagrodzenie_odbiorca_tmp = $bazaDanych->pobierzDane('Imie, Nazwisko, AdresId','umowaOsoba','Id = '.$umowa_rachunek_bankowy_tmp->OsobaId);
            if($umowa_wynagrodzenie_odbiorca_tmp){
                $umowa_wynagrodzenie_odbiorca_tmp = $umowa_wynagrodzenie_odbiorca_tmp->fetch_object();
            }
        }else{

            $umowa_wynagrodzenie_odbiorca_tmp = $bazaDanych->pobierzDane('Imie, Nazwisko, AdresId','umowaOsoba','Id = '.$umowa_dane_tmp->OdbiorcaId);
            if($umowa_wynagrodzenie_odbiorca_tmp) {
                $umowa_wynagrodzenie_odbiorca_tmp = $umowa_wynagrodzenie_odbiorca_tmp->fetch_object();
                $SposobPlatnosciId = 1;
            }
        }

        $uwo_adres_tmp = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_wynagrodzenie_odbiorca_tmp->AdresId);
        if($uwo_adres_tmp) {
            $uwo_adres_tmp = $uwo_adres_tmp->fetch_object();
        }

        $uwoa_miasto_tmp = $bazaDanych->pobierzDane('Wartosc','umowaAdresMiasto','Id = '.$uwo_adres_tmp->MiastoId);
        if($uwoa_miasto_tmp) {
            $uwoa_miasto_tmp = $uwoa_miasto_tmp->fetch_object();
        }

        $Imie = $umowa_wynagrodzenie_odbiorca_tmp->Imie;
        $Nazwisko = $umowa_wynagrodzenie_odbiorca_tmp->Nazwisko;
        $Ulica = $uwo_adres_tmp->Ulica;
        $NrDomu = $uwo_adres_tmp->NrDomu;
        $NrMieszkania = $uwo_adres_tmp->NrMieszkania;
        $KodPocztowy = $uwo_adres_tmp->KodPocztowy;
        $WartoscMiasto = $uwoa_miasto_tmp->Wartosc;

        $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
    }

?>
    <div class="daneStronyUmowyPopUp">

        <label class="margin_t_10 width_100 gray_background">DANE DO WYNAGRODZENIA</label>

        <!--<label class="margin_T_10 width_100">Sposób płatności:</label>
        <div class="sposobPlatnosci margin_b_10">
            <div class="dropdown width_100">
                <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <div data-kolumna="SposobPlatnosciId" data-wartosc_domyslna="<?php /*echo ($SposobPlatnosciId == '') ? '' : $SposobPlatnosciId ; */?>" value="<?php /*echo ($SposobPlatnosciId == '') ? '1' : $SposobPlatnosciId ; */?>" class="dpUstawOpcjeNazwa attrValue update wymagane float_l"><?php /*echo ($SposobPlatnosciId == '' || $SposobPlatnosciId == 1) ? 'Przekaz pocztowy' : 'Rachunek bankowy' ; */?></div>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
/*                        $slownik_sposob_platnosci = $bazaDanych->pobierzDane('*', 'umowaSlownikSposobPlatnosci', 'czy_usuniety = 0');
                        while($poj_slownik_sposob_platnosci = $slownik_sposob_platnosci->fetch_object()){
                            echo '<li class="dpUstawOpcje" data-element_id="'.$poj_slownik_sposob_platnosci->Id.'">'.mb_ucfirst($poj_slownik_sposob_platnosci->Wartosc).'</li>';
                        }
                    */?>
                </ul>
            </div>
        </div>-->

        <div class="numerRachunku">
            <label class=" width_100">Numer rachunku</label>
            <div class="col-md-12 margin_b_10 inputPole"><input data-wartosc_domyslna="<?php echo $Numer; ?>" value="<?php echo $Numer; ?>" data-kolumna="Numer" type="text" maxlength="32" class="update sprawdzIBAN wymagane poleLiczbowe" placeholder="Numer rachunku bankowego"></div>
            <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="2" data-kolumna="SposobPlatnosciId" type="text" class="update" placeholder=""></div>
        </div>

        <label class=" width_100">Imię i nazwisko</label>
        <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" <?php echo ($umowa_tmp != 3) ? 'wymagane' : ''; ?> placeholder="Imię"></div>
        <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" <?php echo ($umowa_tmp != 3) ? 'wymagane' : ''; ?> placeholder="Nazwisko"></div>

        <label class="margin_t_10 width_100">Adres</label>
        <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Ulica; ?>" value="<?php echo $Ulica; ?>" data-kolumna="Ulica" type="text" class="update duzeMaleLiteryCyfry" <?php echo ($umowa_tmp != 3) ? 'wymagane' : ''; ?> placeholder="Ulica"></div>
        <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomu; ?>" value="<?php echo $NrDomu; ?>" data-kolumna="NrDomu" type="text" class="update duzeMaleLiteryCyfry" <?php echo ($umowa_tmp != 3) ? 'wymagane' : ''; ?> placeholder="Nr domu"></div>
        <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>" value="<?php echo $NrMieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
        <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="update poleLiczbowe sprawdzKodPocztowy" <?php echo ($umowa_tmp != 3) ? 'wymagane' : ''; ?> placeholder="Kod pocztowy" maxlength="6"></div>
        <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiasto; ?>" value="<?php echo $WartoscMiasto; ?>" data-kolumna="Wartosc" type="text" class="update duzeMaleLiteryCyfry" <?php echo ($umowa_tmp != 3) ? 'wymagane' : ''; ?> placeholder="Miejscowość"></div>


        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowa<?php echo mb_ucfirst($droga); ?>" data-strona="wynagrodzenie" data-ogolne="1" data-akcja="<?php echo ($SposobPlatnosciId == '') ? 'dodaj_wynagrodzenie' : 'aktualizuj_wynagrodzenie'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz</button>

    </div>