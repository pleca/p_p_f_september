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

    if($akcja == 'edytuj' ){
        $element_id = explode('-',$element_id);

        $umowa_dane_tmp = $bazaDanych->pobierzDane('SposobPlatnosciId, OdbiorcaId, RachunekBankowyId','umowa'.mb_ucfirst($droga),'Id = '.$element_id[2]);

        if(!is_null($umowa_dane_tmp)) {
            $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();
        }

        if($umowa_dane_tmp->SposobPlatnosciId == 2) {
            $umowa_rachunek_bankowy_tmp = $bazaDanych->pobierzDane('Numer', 'umowaRachunekBankowy', 'Id = ' . $umowa_dane_tmp->RachunekBankowyId);

            if ($umowa_rachunek_bankowy_tmp) {
            $umowa_rachunek_bankowy_tmp = $umowa_rachunek_bankowy_tmp->fetch_object();
            $Numer = $umowa_rachunek_bankowy_tmp->Numer;
            $SposobPlatnosciId = 2;
            }

            $umowa_wynagrodzenie_odbiorca_tmp = $bazaDanych->pobierzDane('Imie, Nazwisko','umowaOsoba','Id = '.$umowa_dane_tmp->OdbiorcaId);
            if($umowa_wynagrodzenie_odbiorca_tmp){
                $umowa_wynagrodzenie_odbiorca_tmp = $umowa_wynagrodzenie_odbiorca_tmp->fetch_object();
            }
        }


        $klient_id = $element_id[1];

        $Imie = $umowa_wynagrodzenie_odbiorca_tmp->Imie;
        $Nazwisko = $umowa_wynagrodzenie_odbiorca_tmp->Nazwisko;

        $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];

        $disabled = ($umowa_dane_tmp->OdbiorcaId == $klient_id) ? 'disabled' : '' ;
    }

?>
    <div class="daneStronyUmowyPopUp">

        <label class="margin_t_10 width_100 gray_background">DANE DO WYNAGRODZENIA</label>


        <div class="numerRachunku">
            <label class=" width_100">Numer rachunku</label>
            <div class="col-md-12 margin_b_10 inputPole"><input value="<?php echo $Numer; ?>" data-kolumna="Numer" type="text" maxlength="32" class="update sprawdzIBAN poleLiczbowe" placeholder="Numer rachunku bankowego"></div>
        </div>

        <div class="zpg_opcja_radio float_r padding_r_10 margin_t_10 margin_b_10"><i data-wartosc_domyslna="<?php echo ($umowa_dane_tmp->OdbiorcaId == $klient_id) ? '1' : '0' ; ?>" value="<?php echo ($umowa_dane_tmp->OdbiorcaId == $klient_id) ? '1' : '0' ; ?>" data-kolumna="OdbiorcaWynagrodzeniaKlient" class="fa fa<?php echo ($umowa_dane_tmp->OdbiorcaId == $klient_id) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue rachunek_klienta update" aria-hidden="true"></i><p class="float_l">Posiadaczem rachunku bankowego jest klient</p></div>


        <div class="dane_odbiorcy">
            <label class="width_100">Imię i nazwisko</label>
            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" <?php echo $disabled; ?> placeholder="Imię"></div>
            <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" <?php echo $disabled; ?> placeholder="Nazwisko"></div>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowa<?php echo mb_ucfirst($droga); ?>" data-strona="osobowe_wynagrodzenie" data-ogolne="1" data-akcja="<?php echo ($umowa_dane_tmp->RachunekBankowyId == NULL || $umowa_dane_tmp->RachunekBankowyId == 0) ? 'dodaj_wynagrodzenie_osobowe' : 'aktualizuj_wynagrodzenie_osobowe' ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success zmienOdbiorce width_100 margin_b_0">Zapisz</button>

    </div>