<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$disabled = 'disabled';
$update = '';

$CzyPobieralEmeryture = '';
$DataPierwszejWyplaty = '';
$CzyZlozylWniosekOEmeryture = '';
$CzyWydanoPostanowienie = '';
$CzyZgloszonoRoszczenie = '';
$DataZgloszeniaRoszczenia = '';
$CzyWyplaconoSrodki = '';
$CzyZleconoPelnomocnikowi = '';
$KomuZlecono = '';
$CzyOdwolano = '';
$KiedyOdwolano = '';

$element_id_tmp = explode('-',$element_id);
$umowa_dane_tmp = $bazaDanych -> pobierzDane('*', 'umowa'.mb_ucfirst($droga), 'Id='.$element_id_tmp[2]);

$umowa_dane_tmp = $umowa_dane_tmp->fetch_object();
$CzyPobieralEmeryture = $umowa_dane_tmp->CzyPobieralEmeryture;
$DataPierwszejWyplaty = $umowa_dane_tmp->DataPierwszejWyplaty;
$CzyZlozylWniosekOEmeryture = $umowa_dane_tmp->CzyZlozylWniosekOEmeryture;
$CzyWydanoPostanowienie = $umowa_dane_tmp->CzyWydanoPostanowienie;
$CzyZgloszonoRoszczenie = $umowa_dane_tmp->CzyZgloszonoRoszczenie;
$DataZgloszeniaRoszczenia = $umowa_dane_tmp->DataZgloszeniaRoszczenia;
$CzyWyplaconoSrodki = $umowa_dane_tmp->CzyWyplaconoSrodki;
$CzyZleconoPelnomocnikowi = $umowa_dane_tmp->CzyZleconoPelnomocnikowi;
$KomuZlecono = $umowa_dane_tmp->KomuZlecono;
$CzyOdwolano = $umowa_dane_tmp->CzyOdwolano;
$KiedyOdwolano = $umowa_dane_tmp->KiedyOdwolano;


?>

    <div class="daneStronyUmowyPopUp">
        <label class="margin_t_10 width_100">CZY POSIADACZ RACHUNKU EMERYTALNEGO POBIERAŁ EMERYTURĘ?</label>
        <div class="zaznaczPoleGrupa ">

            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $CzyPobieralEmeryture; ?>" value="1" data-kolumna="CzyPobieralEmeryture" class="fa fa<?php echo ($CzyPobieralEmeryture == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>TAK, jeśli tak, to kiedy nastąpiła pierwsza wypłata emerytury?</p></div>
            <div class="zpg_opcja zpg_opcja_input"><p class="float_l">data wypłaty:</p><input type="text" data-wartosc_domyslna="<?php echo $DataPierwszejWyplaty; ?>" value="<?php echo ($DataPierwszejWyplaty == '0000-00-00') ? '' : $DataPierwszejWyplaty; ?>" data-kolumna="DataPierwszejWyplaty" maxlength="10" class="datePicker update"/></div>
            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $CzyPobieralEmeryture; ?>" value="2" data-kolumna="CzyPobieralEmeryture" class="fa fa<?php echo ($CzyPobieralEmeryture == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>NIE</p></div>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyPobieralEmeryture; ?>" value="3" data-kolumna="CzyPobieralEmeryture" class="fa fa<?php echo ($CzyPobieralEmeryture == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>BRAK INFORMACJI</p></div>
            <div class="clear_b"></div>
        </div>

        <label class="margin_t_10 width_100">CZY POSIADACZ RACHUNKU EMERYTALNEGO, KTÓRY NIE POBIERAŁ EMERYTURY, ZŁOŻYŁ WNIOSEK O USTALENIE PRAWA DO EMERYTURY?</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $CzyZlozylWniosekOEmeryture; ?>" value="1" data-kolumna="CzyZlozylWniosekOEmeryture" class="fa fa<?php echo ($CzyZlozylWniosekOEmeryture == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>TAK</p></div>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyZlozylWniosekOEmeryture; ?>" value="2" data-kolumna="CzyZlozylWniosekOEmeryture" class="fa fa<?php echo ($CzyZlozylWniosekOEmeryture == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>NIE</p></div>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyZlozylWniosekOEmeryture; ?>" value="3" data-kolumna="CzyZlozylWniosekOEmeryture" class="fa fa<?php echo ($CzyZlozylWniosekOEmeryture == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>BRAK INFORMACJI</p></div>
            <div class="clear_b"></div>
        </div>

        <label class="margin_t_10 width_100">CZY ZOSTAŁO WYDANE POSTANOWIENIE O STWIERDZENIU NABYCIA SPADKU LUB CZY ZOSTAŁ SPORZĄDZONY AKT NOTARIALNY POŚWIADCZENIA DZIEDZICZENIA PO ZMARŁM POSIADACZU RACHUNKU EMERYTALNEGO?</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $CzyWydanoPostanowienie; ?>" value="1" data-kolumna="CzyWydanoPostanowienie" class="fa fa<?php echo ($CzyWydanoPostanowienie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>TAK</p></div>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyWydanoPostanowienie; ?>" value="2" data-kolumna="CzyWydanoPostanowienie" class="fa fa<?php echo ($CzyWydanoPostanowienie == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>NIE</p></div>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyWydanoPostanowienie; ?>" value="3" data-kolumna="CzyWydanoPostanowienie" class="fa fa<?php echo ($CzyWydanoPostanowienie == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>BRAK INFORMACJI</p></div>
            <div class="clear_b"></div>
        </div>

        <label class="margin_t_10 width_100">CZY ZGŁOSZONO JUŻ ROSZCZENIE O WYPŁATĘ ŚRODKÓW PIENIĘŻNYCH DO PODMIOTU PROWADZĄCEGO RACHUNEK BANKOWY?</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $CzyZgloszonoRoszczenie; ?>" value="1" data-kolumna="CzyZgloszonoRoszczenie" class="fa fa<?php echo ($CzyZgloszonoRoszczenie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>TAK, jeśli tak, to kiedy ?</p></div>
            <div class="zpg_opcja zpg_opcja_input"><p class="float_l">data zgłoszenia:</p><input type="text" data-wartosc_domyslna="<?php echo $DataZgloszeniaRoszczenia; ?>" value="<?php echo ($DataZgloszeniaRoszczenia == '0000-00-00') ? '' : $DataZgloszeniaRoszczenia; ?>" data-kolumna="DataZgloszeniaRoszczenia" maxlength="10" class="datePicker update"/></div>
            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $CzyZgloszonoRoszczenie; ?>" value="2" data-kolumna="CzyZgloszonoRoszczenie" class="fa fa<?php echo ($CzyZgloszonoRoszczenie == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>NIE</p></div>
            <div class="clear_b"></div>
        </div>

        <label class="margin_t_10 width_100">CZY UPRAWNIONEMU WYPŁACONO ŚRODKI PIENIĘŻNE Z RACHUNKU EMERYTALNEGO?</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $CzyWyplaconoSrodki; ?>" value="1" data-kolumna="CzyWyplaconoSrodki" class="fa fa<?php echo ($CzyWyplaconoSrodki == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>TAK, zarówno z rachunku OFE, jak i subkonta ZUS</p></div>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyWyplaconoSrodki; ?>" value="2" data-kolumna="CzyWyplaconoSrodki" class="fa fa<?php echo ($CzyWyplaconoSrodki == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>TAK, ale wyłącznie z rachunku OFE</p></div>
            <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyWyplaconoSrodki; ?>" value="3" data-kolumna="CzyWyplaconoSrodki" class="fa fa<?php echo ($CzyWyplaconoSrodki == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>NIE</p></div>
            <div class="clear_b"></div>
        </div>

        <label class="margin_t_10 width_100">CZY ZLECONO PROWADZENIE SPRAWY INNEMU PEŁNOMOCNIKOWI?</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $CzyZleconoPelnomocnikowi; ?>" value="1" data-kolumna="CzyZleconoPelnomocnikowi" class="fa fa<?php echo ($CzyZleconoPelnomocnikowi == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>TAK, jeśli tak, to komu?</p></div>
            <div class="zpg_opcja zpg_opcja_input">
                <input class="width_95" type="text" data-wartosc_domyslna="<?php echo $KomuZlecono; ?>" value="<?php echo ($KomuZlecono == ' ') ? '' : $KomuZlecono; ?>" data-kolumna="KomuZlecono" class="update"/>
            </div>
            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $CzyZleconoPelnomocnikowi; ?>" value="2" data-kolumna="CzyZleconoPelnomocnikowi" class="fa fa<?php echo ($CzyZleconoPelnomocnikowi == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>NIE</p></div>
            <div class="clear_b"></div>
        </div>

        <label class="margin_t_10 width_100">CZY ODWOŁANO PEŁNOMOCNICTWO UDZIELONE INNEMU PEŁNOMOCNIKOWI?</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $CzyOdwolano; ?>" value="1" data-kolumna="CzyOdwolano" class="fa fa<?php echo ($CzyOdwolano == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>TAK, jeśli tak, to kiedy ?</p></div>
            <div class="zpg_opcja zpg_opcja_input"><p class="float_l">data odwołania:</p><input type="text" data-wartosc_domyslna="<?php echo $KiedyOdwolano; ?>" value="<?php echo ($KiedyOdwolano == '0000-00-00') ? '' : $KiedyOdwolano; ?>" data-kolumna="KiedyOdwolano" maxlength="10" class="datePicker update"/></div>
            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $CzyOdwolano; ?>" value="2" data-kolumna="CzyOdwolano" class="fa fa<?php echo ($CzyOdwolano == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>NIE</p></div>
            <div class="clear_b"></div>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOfe" data-ogolne="0" data-strona="2" data-akcja="aktualizuj_strone_umowy" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

    </div>
