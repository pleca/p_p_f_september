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

        $CzyNadalPosiadacz = $umowa_dane_tmp->CzyNadalPosiadacz;
        $CzySprzedanoUszkodzony = $umowa_dane_tmp->CzySprzedanoUszkodzony;
        $CzyMialUszkodzenia = $umowa_dane_tmp->CzyMialUszkodzenia;
        $CzyNaprawianoWczesniej = $umowa_dane_tmp->CzyNaprawianoWczesniej;
        $CzyUzytoOryginalneCzesci = $umowa_dane_tmp->CzyUzytoOryginalneCzesci;
        $CzyNaprawionoPoWypadku = $umowa_dane_tmp->CzyNaprawionoPoWypadku;
        $CzyOdszkodowaniePokrylo = $umowa_dane_tmp->CzyOdszkodowaniePokrylo;
        $CzyStanPrzedWypadkiem = $umowa_dane_tmp->CzyStanPrzedWypadkiem;


        $element_id = $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2];

    }
}
?>
<div class="daneStronyUmowyPopUp">
    <label class="margin_t_10 width_100">Czy jest Pan(i) nadal posiadaczem samochodu?</label>
    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $CzyNadalPosiadacz; ?>" value="1" data-kolumna="CzyNadalPosiadacz" class="fa fa<?php echo ($CzyNadalPosiadacz == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyNadalPosiadacz; ?>" value="2" data-kolumna="CzyNadalPosiadacz" class="fa fa<?php echo ($CzyNadalPosiadacz == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">W przypadku sprzedaży samochodu* proszę o informację, czy został on sprzedany w stanie uszkodzonym?</label>
    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $CzySprzedanoUszkodzony; ?>" value="1" data-kolumna="CzySprzedanoUszkodzony" class="fa fa<?php echo ($CzySprzedanoUszkodzony == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzySprzedanoUszkodzony; ?>" value="2" data-kolumna="CzySprzedanoUszkodzony" class="fa fa<?php echo ($CzySprzedanoUszkodzony == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">Czy samochód miał przed wypadkiem inne, nienaprawione uszkodzenia?</label>
    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $CzyMialUszkodzenia; ?>" value="1" data-kolumna="CzyMialUszkodzenia" class="fa fa<?php echo ($CzyMialUszkodzenia == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyMialUszkodzenia; ?>" value="2" data-kolumna="CzyMialUszkodzenia" class="fa fa<?php echo ($CzyMialUszkodzenia == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">Czy samochód miał przed wypadkiem wcześniejsze szkody, które zostały naprawione?</label>
    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $CzyNaprawianoWczesniej; ?>" value="1" data-kolumna="CzyNaprawianoWczesniej" class="fa fa<?php echo ($CzyNaprawianoWczesniej == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyNaprawianoWczesniej; ?>" value="2" data-kolumna="CzyNaprawianoWczesniej" class="fa fa<?php echo ($CzyNaprawianoWczesniej == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyNaprawianoWczesniej; ?>" value="3" data-kolumna="CzyNaprawianoWczesniej" class="fa fa<?php echo ($CzyNaprawianoWczesniej == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE WIEM</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">Jeżeli TAK, to czy do naprawy użyto oryginalnych części zamiennych?</label>
    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $CzyUzytoOryginalneCzesci; ?>" value="1" data-kolumna="CzyUzytoOryginalneCzesci" class="fa fa<?php echo ($CzyUzytoOryginalneCzesci == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyUzytoOryginalneCzesci; ?>" value="2" data-kolumna="CzyUzytoOryginalneCzesci" class="fa fa<?php echo ($CzyUzytoOryginalneCzesci == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyUzytoOryginalneCzesci; ?>" value="3" data-kolumna="CzyUzytoOryginalneCzesci" class="fa fa<?php echo ($CzyUzytoOryginalneCzesci == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE WIEM</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">Czy po wypadku naprawił(a) Pan(i) samochód?</label>
    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $CzyNaprawionoPoWypadku; ?>" value="1" data-kolumna="CzyNaprawionoPoWypadku" class="fa fa<?php echo ($CzyNaprawionoPoWypadku == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyNaprawionoPoWypadku; ?>" value="2" data-kolumna="CzyNaprawionoPoWypadku" class="fa fa<?php echo ($CzyNaprawionoPoWypadku == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">W przypadku dokonania naprawy samochodu proszę o informację, czy otrzymane odszkodowanie wystarczyło na naprawę z wykorzystaniem oryginalnych części zamiennych.</label>
    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $CzyOdszkodowaniePokrylo; ?>" value="1" data-kolumna="CzyOdszkodowaniePokrylo" class="fa fa<?php echo ($CzyOdszkodowaniePokrylo == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyOdszkodowaniePokrylo; ?>" value="2" data-kolumna="CzyOdszkodowaniePokrylo" class="fa fa<?php echo ($CzyOdszkodowaniePokrylo == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="clear_b"></div>
    </div>

    <label class="margin_t_10 width_100">Czy w wyniku przeprowadzonej naprawy przywrócono stan samochodu sprzed wypadku**?</label>
    <div class="zaznaczPoleGrupa">
        <div class="zpg_opcja_radio float_l padding_r_10"><i data-wartosc_domyslna="<?php echo $CzyStanPrzedWypadkiem; ?>" value="1" data-kolumna="CzyStanPrzedWypadkiem" class="fa fa<?php echo ($CzyStanPrzedWypadkiem == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">TAK</p></div>
        <div class="zpg_opcja_radio float_l "><i data-wartosc_domyslna="<?php echo $CzyStanPrzedWypadkiem; ?>" value="2" data-kolumna="CzyStanPrzedWypadkiem" class="fa fa<?php echo ($CzyStanPrzedWypadkiem == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue " aria-hidden="true"></i><p class="float_l">NIE</p></div>
        <div class="clear_b"></div>
    </div>



    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaRzeczowa" data-ogolne="0" data-strona="5" data-akcja="aktualizuj_strone_umowy" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

</div>


