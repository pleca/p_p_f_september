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


        $dochodzenie_roszczen_tmp = $bazaDanych->pobierzDane('*', 'umowaDochodzenieRoszczen', 'Id=' . $umowa_dane_tmp->DochodzenieRoszczenId);

        if ($dochodzenie_roszczen_tmp) {
            $dochodzenie_roszczen_tmp = $dochodzenie_roszczen_tmp->fetch_object();

            //$RoszczeniaOdUbezpieczyciela = $dochodzenie_roszczen_tmp->RoszczeniaOdUbezpieczyciela;
            //$RoszczeniaOdPracodawcy = $dochodzenie_roszczen_tmp->RoszczeniaOdPracodawcy;
            $ZleconoRoszczenia = $dochodzenie_roszczen_tmp->ZleconoRoszczenia;
            $NazwaPelnomocnika = $dochodzenie_roszczen_tmp->NazwaPelnomocnika;
            $DataZawarciaUmowy = $dochodzenie_roszczen_tmp->DataZawarciaUmowy;
            $DataWypowiedzenia = $dochodzenie_roszczen_tmp->DataWypowiedzenia;
            $WypowiedzenieUmowy = $dochodzenie_roszczen_tmp->WypowiedzenieUmowy;
            //$PrzekazanoDokumentacje = $dochodzenie_roszczen_tmp->PrzekazanoDokumentacje;
            //$IloscKart = $dochodzenie_roszczen_tmp->IloscKart;
        }

    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneStronyUmowyPopUp">

            <label class="margin_t_10 width_100 gray_background">DOCHODZENIE ROSZCZEŃ</label>

            <!--<p>Oświadczam, że zostałem poinformowany o okolicznościach uzasadniających dochodzenie zwrotu wypłaconego odszkodowania od sprawcy wypadku przez ubezpieczyciela lub Ubezpieczeniowy
                Fundusz Gwarancyjny, określonych w ustawie z dnia 22 maja 2003 r. o ubezpieczeniach obowiązkowych, Ubezpieczeniowym Funduszu Gwarancyjnym i Polskim Biurze Ubezpieczycieli
                Komunikacyjnych (Dz.U. Nr 124, poz. 1152). Zgodnie z art. 43. zakładowi ubezpieczeń przysługuje prawo dochodzenia od kierującego pojazdem mechanicznym zwrotu wypłaconego z
                tytułu ubezpieczenia OC posiadaczy pojazdów mechanicznych odszkodowania, jeżeli kierujący:</p>
            <p>1) wyrządził szkodę umyślnie lub w stanie po użyciu alkoholu albo pod wpływem środków odurzających, substancji psychotropowych lub środków zastępczych w rozumieniu przepisów o przeciwdziałaniu narkomanii;</p>
            <p>2) wszedł w posiadanie pojazdu wskutek popełnienia przestępstwa;</p>
            <p>3) nie posiadał wymaganych uprawnień do kierowania pojazdem mechanicznym, z wyjątkiem przypadków, gdy chodziło o ratowanie życia ludzkiego lub mienia albo o pościg za osobą podjęty bezpośrednio po
            popełnieniu przez nią przestępstwa;</p>
            <p>4) zbiegł z miejsca zdarzenia. Zgodnie z art. 110 ust. 1 z chwilą wypłaty przez Fundusz odszkodowania, sprawca szkody i osoba, która nie dopełniła obowiązku zawarcia umowy ubezpieczenia obowiązkowego
            są obowiązani do zwrotu Funduszowi spełnionego świadczenia w przypadku gdy: posiadacz zaidentyfikowanego pojazdu mechanicznego, którego ruchem szkodę tę wyrządzono, nie był ubezpieczony
            obowiązkowym ubezpieczeniem OC posiadaczy pojazdów mechanicznych, lub rolnik, osoba pozostająca z nim we wspólnym gospodarstwie domowym lub osoba pracująca w jego gospodarstwie rolnym wyrządzili szkodę,
            a rolnik nie był ubezpieczony obowiązkowym ubezpieczeniem OC rolników.</p>
            <div class="clear_b"></div>


            <label class="margin_t_10 width_100">W przypadku możliwości żądania od sprawcy lub osoby, która nie dopełniła obowiązku zawarcia umowy ubezpieczenia obowiązkowego zwrotu wypłaconych odszkodowań przez ubezpieczyciela lub UFG:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php /*echo $RoszczeniaOdUbezpieczyciela; */?>" value="1" data-kolumna="RoszczeniaOdUbezpieczyciela" class="fa fa<?php /*echo ($RoszczeniaOdUbezpieczyciela == 1) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>decyduję się na dochodzenie roszczeń od ubezpieczyciela lub UFG</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php /*echo $RoszczeniaOdUbezpieczyciela; */?>" value="2" data-kolumna="RoszczeniaOdUbezpieczyciela" class="fa fa<?php /*echo ($RoszczeniaOdUbezpieczyciela == 2) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>nie decyduję się na dochodzenie roszczeń od ubezpieczyciela lub UFG</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">W przypadku dochodzenia roszczeń bezpośrednio od swojego pracodawcy:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php /*echo $RoszczeniaOdPracodawcy; */?>" value="1" data-kolumna="RoszczeniaOdPracodawcy" class="fa fa<?php /*echo ($RoszczeniaOdPracodawcy == 1) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>decyduję się na dochodzenie roszczeń</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php /*echo $RoszczeniaOdPracodawcy; */?>" value="2" data-kolumna="RoszczeniaOdPracodawcy" class="fa fa<?php /*echo ($RoszczeniaOdPracodawcy == 2) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>nie decyduję się na dochodzenie roszczeń</p></div>
                <div class="clear_b"></div>
            </div>-->

            <label class="margin_t_10 width_100">Czy zlecano dochodzenie roszczeń?</label>
            <div class="zaznaczPoleGrupa ZleconoRoszczenia ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $ZleconoRoszczenia; ?>" value="1" data-kolumna="ZleconoRoszczenia" class="fa fa<?php echo ($ZleconoRoszczenia == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZleconoRoszczeniaNie" aria-hidden="true"></i><p>nie zlecono wcześniej dochodzenia roszczeń żadnemu podmiotowi</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $ZleconoRoszczenia; ?>" value="2" data-kolumna="ZleconoRoszczenia" class="fa fa<?php echo ($ZleconoRoszczenia == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue ZleconoRoszczeniaTak" aria-hidden="true"></i><p>sprawę zlecono wcześniej pełnomocnikowi: </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">nazwa pełnomocnika: </p><input type="text" data-wartosc_domyslna="<?php echo $NazwaPelnomocnika; ?>" value="<?php echo ($ZleconoRoszczenia == 2) ? $NazwaPelnomocnika : ''; ?>" data-kolumna="NazwaPelnomocnika" class="update"/></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">na podstawie umowy z dnia:</p><input type="text" data-wartosc_domyslna="<?php echo $DataZawarciaUmowy; ?>" value="<?php echo ($ZleconoRoszczenia == 2) ? $DataZawarciaUmowy : ''; ?>" data-kolumna="DataZawarciaUmowy" maxlength="10" class="datePicker update"/></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Od wyżej wymienionej umowy klient:</label>
            <div class="zaznaczPoleGrupa WypowiedzenieUmowy ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $CzyZgloszonoRoszczenie; ?>" value="1" data-kolumna="WypowiedzenieUmowy" class="fa fa<?php echo ($WypowiedzenieUmowy == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue WypowiedzenieUmowyTak" aria-hidden="true"></i><p class="float_l">odstąpił, </p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $CzyZgloszonoRoszczenie; ?>" value="2" data-kolumna="WypowiedzenieUmowy" class="fa fa<?php echo ($WypowiedzenieUmowy == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue WypowiedzenieUmowyNie" aria-hidden="true"></i><p class="float_l">wypowiedział </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">dnia:</p><input type="text" data-wartosc_domyslna="<?php echo $DataWypowiedzenia; ?>" value="<?php echo $DataWypowiedzenia; ?>" data-kolumna="DataWypowiedzenia" maxlength="10" class="datePicker update"/></div>
                <div class="clear_b"></div>
            </div>

<!--            <label class="margin_t_10 width_100">Czy przekazano pełnomocnikowi VOTUM S.A. dokumentację?</label>
            <div class="zaznaczPoleGrupa PrzekazanoDokumentacje ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php /*echo $PrzekazanoDokumentacje; */?>" value="1" data-kolumna="PrzekazanoDokumentacje" class="fa fa<?php /*echo ($PrzekazanoDokumentacje == 1) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue PrzekazanoDokumentacjeTak " aria-hidden="true"></i><p class="float_l">TAK, </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><p class="float_l">ile kart:</p><input type="text" data-wartosc_domyslna="<?php /*echo $IloscKart; */?>" value="<?php /*echo ($PrzekazanoDokumentacje == 1) ? $IloscKart : ''; */?>" data-kolumna="IloscKart" maxlength="10" class="update"/></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php /*echo $PrzekazanoDokumentacje; */?>" value="2" data-kolumna="PrzekazanoDokumentacje" class="fa fa<?php /*echo ($PrzekazanoDokumentacje == 2) ? '-check' : '' ; */?>-square-o fa-2 float_l attrValue PrzekazanoDokumentacjeNie " aria-hidden="true"></i><p class="float_l">NIE</p></div>
                <div class="clear_b"></div>
            </div>-->


            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="DochodzenieRoszczen" data-ogolne="0" data-strona="3" data-akcja="<?php echo (!$dochodzenie_roszczen_tmp) ? 'dodaj_dochodzenie_roszczen' : 'aktualizuj_dochodzenie_roszczen'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>
        </div>
