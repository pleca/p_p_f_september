<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

if($akcja == 'edytuj' ){
    $element_id = explode('-',$element_id);

    $umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id=' . $element_id[2]);

    if ($umowa_dane_tmp) {
        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        $TypSzkodyId = $umowa_dane_tmp->TypSzkodyId;
        $RodzajSzkodyId = $umowa_dane_tmp->RodzajSzkodyId;
        $TypZdarzeniaId = $umowa_dane_tmp->TypZdarzeniaId;

        $wmiosek_fundacja_votum_tmp = $bazaDanych->pobierzDane('*', 'umowaWniosekVotum', 'Id=' . $umowa_dane_tmp->WniosekVotumId);

        if ($wmiosek_fundacja_votum_tmp) {
            $wmiosek_fundacja_votum_tmp = $wmiosek_fundacja_votum_tmp->fetch_object();

            $OpisPrzypadku = $wmiosek_fundacja_votum_tmp->OpisPrzypadku;
            $OsobyWGospodarstwie = $wmiosek_fundacja_votum_tmp->OsobyWGospodarstwie;
            $NieruchomosciId = $wmiosek_fundacja_votum_tmp->NieruchomosciId;
            $Zasoby = $wmiosek_fundacja_votum_tmp->Zasoby;
            $DochodyId = $wmiosek_fundacja_votum_tmp->DochodyId;
            $Turnus = $wmiosek_fundacja_votum_tmp->Turnus;
            $MiejsceTurnusu = $wmiosek_fundacja_votum_tmp->MiejsceTurnusu;
            $Rehabilitacja = $wmiosek_fundacja_votum_tmp->Rehabilitacja;
            $Proteza = $wmiosek_fundacja_votum_tmp->Proteza;
            $Sprzet = $wmiosek_fundacja_votum_tmp->Sprzet;
            $Wozek = $wmiosek_fundacja_votum_tmp->Wozek;
            $PomocRodzinie = $wmiosek_fundacja_votum_tmp->PomocRodzinie;
            $InneDofinansowanie = $wmiosek_fundacja_votum_tmp->InneDofinansowanie;
            $InneOpis = $wmiosek_fundacja_votum_tmp->InneOpis;
            $UdostepnienieRachunku = $wmiosek_fundacja_votum_tmp->UdostepnienieRachunku;
        }

        $nieruchomosci_tmp = $bazaDanych->pobierzDane('*', 'umowaNieruchomosci', 'Id=' . $NieruchomosciId);

        if ($nieruchomosci_tmp) {
            $nieruchomosci_tmp = $nieruchomosci_tmp->fetch_object();

            $Dom = $nieruchomosci_tmp->Dom;
            $PowierzchniaDomu = $nieruchomosci_tmp->PowierzchniaDomu;
            $WlascicielDomu = $nieruchomosci_tmp->WlascicielDomu;
            $Mieszkanie = $nieruchomosci_tmp->Mieszkanie;
            $PowierzchniaMieszkania = $nieruchomosci_tmp->PowierzchniaMieszkania;
            $WlascicielMieszkania = $nieruchomosci_tmp->WlascicielMieszkania;
            $DzialkaRolna = $nieruchomosci_tmp->DzialkaRolna;
            $PowierzchniaDzialkiRolnej = $nieruchomosci_tmp->PowierzchniaDzialkiRolnej;
            $WlascicielDzialkiRolnej = $nieruchomosci_tmp->WlascicielDzialkiRolnej;
            $DzialkaBudowlana = $nieruchomosci_tmp->DzialkaBudowlana;
            $PowierzchniaDzialkiBudowlanej = $nieruchomosci_tmp->PowierzchniaDzialkiBudowlanej;
            $WlascicielDzialkiBudowlanej = $nieruchomosci_tmp->WlascicielDzialkiBudowlanej;

        }

        $dochody_tmp = $bazaDanych->pobierzDane('*', 'umowaDochody', 'Id=' . $DochodyId);

        if ($dochody_tmp) {
            $dochody_tmp = $dochody_tmp->fetch_object();

            $Wynagrodzenie = $dochody_tmp->Wynagrodzenie;
            $Dzialalnosc = $dochody_tmp->Dzialalnosc;
            $Renta = $dochody_tmp->Renta;
            $Emerytura = $dochody_tmp->Emerytura;
            $Zasilek = $dochody_tmp->Zasilek;
            $Socjal = $dochody_tmp->Socjal;
            $Alimenty = $dochody_tmp->Alimenty;
            $SredniDochod = $dochody_tmp->SredniDochod;
        }
    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneDoWnioskuFundacji">

            <label class="margin_t_10 width_100 gray_background">WNIOSEK DO FUNDACJI VOTUM</label>

            <label class="margin_t_10 width_100">Opis przypadku:</label>
            <div class="zpg_opcja zpg_opcja_input">
                <textarea class="form-control update textarea_content policz_znaki" data-liczba_znakow="800" id='textarea_content' rows="6" id="comment" data-kolumna="OpisPrzypadku" data-wartosc_domyslna="<?php echo $OpisPrzypadku; ?>"><?php echo $OpisPrzypadku; ?></textarea>
                Pozostało znaków: <span class="pozostalo_znakow">800</span>
            </div>

            <label class="margin_t_10 width_100">Klient wnioskuj o:</label>
            <div class="zaznaczPoleGrupa" style="display:<?php echo ($TypSzkodyId == 2) ? 'none' : 'block'; ?>;">
                <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $Turnus; ?>" value="<?php echo $Turnus; ?>" data-kolumna="Turnus" class="fa fa<?php echo ($Turnus == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l"> dofinansowanie turnusu rehabilitacyjnego w  </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $MiejsceTurnusu; ?>" value="<?php echo ($Turnus == 1) ? $MiejsceTurnusu : ''; ?>" data-kolumna="MiejsceTurnusu"class="update margin_l_5"/></div>
                </div>
            </div>
            <div class="zaznaczPoleGrupa" style="display:<?php echo ($TypSzkodyId == 2) ? 'none' : 'block'; ?>;">
                <div class="zpg_opcja margin_t_10"><i data-wartosc_domyslna="<?php echo $Rehabilitacja; ?>" value="<?php echo $Rehabilitacja; ?>" data-kolumna="Rehabilitacja" class="fa fa<?php echo ($Rehabilitacja == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> dofinansowanie rehabilitacji w domu</p></div>
            </div>
            <div class="zaznaczPoleGrupa" style="display:<?php echo ($TypSzkodyId == 2) ? 'none' : 'block'; ?>;">
                <div class="zpg_opcja margin_t_10"><i data-wartosc_domyslna="<?php echo $Proteza; ?>" value="<?php echo $Proteza; ?>" data-kolumna="Proteza" class="fa fa<?php echo ($Proteza == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> dofinansowanie zakupu protezy</p></div>
            </div>
            <div class="zaznaczPoleGrupa" style="display:<?php echo ($TypSzkodyId == 2) ? 'none' : 'block'; ?>;">
                <div class="zpg_opcja margin_t_10"><i data-wartosc_domyslna="<?php echo $Sprzet; ?>" value="<?php echo $Sprzet; ?>" data-kolumna="Sprzet" class="fa fa<?php echo ($Sprzet == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> dofinansowanie zakupu sprzętu rehabilitacyjnego</p></div>
            </div>
            <div class="zaznaczPoleGrupa" style="display:<?php echo ($TypSzkodyId == 2) ? 'none' : 'block'; ?>;">
                <div class="zpg_opcja margin_t_10"><i data-wartosc_domyslna="<?php echo $Wozek; ?>" value="<?php echo $Wozek; ?>" data-kolumna="Wozek" class="fa fa<?php echo ($Wozek == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> dofinansowanie zakupu wózka inwalidzkiego</p></div>
            </div>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja margin_t_10"><i data-wartosc_domyslna="<?php echo $PomocRodzinie; ?>" value="<?php echo $PomocRodzinie; ?>" data-kolumna="PomocRodzinie" class="fa fa<?php echo ($PomocRodzinie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> pomoc rodzinie z tytułu trudnej sytuacji materialnej powstałej na skutek utraty osoby bliskiej w wypadku</p></div>
            </div>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja margin_t_10"><i data-wartosc_domyslna="<?php echo $InneDofinansowanie; ?>" value="<?php echo $InneDofinansowanie; ?>" data-kolumna="InneDofinansowanie" class="fa fa<?php echo ($InneDofinansowanie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l"> inne, jakie?  </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $InneOpis; ?>" value="<?php echo ($InneDofinansowanie == 1) ? $InneOpis : ''; ?>" data-kolumna="InneOpis" class="update margin_l_5"/></div>
                </div>
            </div>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja margin_t_10"><i data-wartosc_domyslna="<?php echo $UdostepnienieRachunku; ?>" value="<?php echo $UdostepnienieRachunku; ?>" data-kolumna="UdostepnienieRachunku" class="fa fa<?php echo ($UdostepnienieRachunku == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> udostepnienie rachunku Fundacji w celu gromadzenia darowizn celowych i odpisów 1%</p></div>
            </div>
            <div class="clear_b"></div>

            <label class="margin_t_10 width_100">Osoby pozostające we wspólnym gospodarstwie domowym z Beneficjentem (stopień pokrewieństwa):</label>
            <div class="zpg_opcja zpg_opcja_input">
                <textarea class="form-control update textarea_content policz_znaki" data-liczba_znakow="800" id='textarea_content' rows="6" id="comment" data-kolumna="OsobyWGospodarstwie" data-wartosc_domyslna="<?php echo $OsobyWGospodarstwie; ?>"><?php echo $OsobyWGospodarstwie; ?></textarea>
                Pozostało znaków: <span class="pozostalo_znakow">800</span>
            </div>

            <label class="margin_t_10 width_100">Posiadane nieruchomości (dom, mieszkanie, działka [m2]):</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja">
                    <i data-wartosc_domyslna="<?php echo $Dom; ?>" value="1" data-kolumna="Dom" class="fa fa<?php echo ($Dom == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l"> dom o powierzchni  </p>
                    <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $PowierzchniaDomu; ?>" value="<?php echo ($Dom == 1) ? $PowierzchniaDomu : ''; ?>" data-kolumna="PowierzchniaDomu" maxlength="10" class="update margin_l_5"/></div>
                    <p class="float_l"> właściciel:  </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $WlascicielDomu; ?>" value="<?php echo ($Dom == 1) ? $WlascicielDomu : ''; ?>" data-kolumna="WlascicielDomu" class="update margin_l_5"/></div>
                </div>
            </div>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja margin_t_10">
                    <i data-wartosc_domyslna="<?php echo $Mieszkanie; ?>" value="2" data-kolumna="Mieszkanie" class="fa fa<?php echo ($Mieszkanie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l"> mieszkanie o powierzchni  </p>
                    <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $PowierzchniaMieszkania; ?>" value="<?php echo ($Mieszkanie == 1) ? $PowierzchniaMieszkania : ''; ?>" data-kolumna="PowierzchniaMieszkania" maxlength="10" class="update margin_l_5"/></div>
                    <p class="float_l"> właściciel:  </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $WlascicielMieszkania; ?>" value="<?php echo ($Mieszkanie == 1) ? $WlascicielMieszkania : ''; ?>" data-kolumna="WlascicielMieszkania" class="update margin_l_5"/></div>
                </div>
            </div>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja margin_t_10">
                    <i data-wartosc_domyslna="<?php echo $DzialkaRolna; ?>" value="3" data-kolumna="DzialkaRolna" class="fa fa<?php echo ($DzialkaRolna == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l"> działkę rolną o powierzchni  </p>
                    <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $PowierzchniaDzialkiRolnej; ?>" value="<?php echo ($DzialkaRolna == 1) ? $PowierzchniaDzialkiRolnej : ''; ?>" data-kolumna="PowierzchniaDzialkiRolnej" maxlength="10" class="update margin_l_5"/></div>
                    <p class="float_l"> właściciel:  </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $WlascicielDzialkiRolnej; ?>" value="<?php echo ($DzialkaRolna == 1) ? $WlascicielDzialkiRolnej : ''; ?>" data-kolumna="WlascicielDzialkiRolnej" class="update margin_l_5"/></div>
                </div>
            </div>
            <div class="zaznaczPoleGrupa">
                <div class="zpg_opcja margin_t_10">
                    <i data-wartosc_domyslna="<?php echo $DzialkaBudowlana; ?>" value="4" data-kolumna="DzialkaBudowlana" class="fa fa<?php echo ($DzialkaBudowlana == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p class="float_l"> działkę budowlaną o powierzchni  </p>
                    <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $PowierzchniaDzialkiBudowlanej; ?>" value="<?php echo ($DzialkaBudowlana == 1) ? $PowierzchniaDzialkiBudowlanej : ''; ?>" data-kolumna="PowierzchniaDzialkiBudowlanej" maxlength="10" class="update margin_l_5"/></div>
                    <p class="float_l"> właściciel:  </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $WlascicielDzialkiBudowlanej; ?>" value="<?php echo ($DzialkaBudowlana == 1) ? $WlascicielDzialkiBudowlanej : ''; ?>" data-kolumna="WlascicielDzialkiBudowlanej" class="update margin_l_5"/></div>
                </div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Posiadane zasoby należące do Beneficjenta i osób pozostających we wspólnym gospodarstwie i ich wartość (np. samochód, oszczędności):</label>
            <div class="zpg_opcja zpg_opcja_input">
                <textarea class="form-control update textarea_content policz_znaki" data-liczba_znakow="800" id='textarea_content' rows="6" id="comment" data-kolumna="Zasoby" data-wartosc_domyslna="<?php echo $Zasoby; ?>"><?php echo $Zasoby; ?></textarea>
                Pozostało znaków: <span class="pozostalo_znakow">800</span>
            </div>

            <label class="margin_t_10 width_100">Opis dochodów i źródeł utrzymania wraz z podaniem kwot i osób, których dotyczą:</label>
            <div class="col-md-12 inputPole ">
                <p>1. Wynagrodzenia za pracę:</p>
                <input class="padding_r_10 update" type="text" data-wartosc_domyslna="<?php echo $Wynagrodzenie; ?>" value="<?php echo $Wynagrodzenie; ?>" data-kolumna="Wynagrodzenie"/>
            </div>
            <div class="col-md-12 inputPole ">
                <p>2. Dochody z tytułu powadzonej działalności gospodarczej/ rolniczej:</p>
                <input class="padding_r_10 update" type="text" data-wartosc_domyslna="<?php echo $Dzialalnosc; ?>" value="<?php echo $Dzialalnosc; ?>" data-kolumna="Dzialalnosc"/>
            </div>
            <div class="col-md-12 inputPole ">
                <p>3. Renty:</p>
                <input class="padding_r_10 update" type="text" data-wartosc_domyslna="<?php echo $Renta; ?>" value="<?php echo $Renta; ?>" data-kolumna="Renta"/>
            </div>
            <div class="col-md-12 inputPole ">
                <p>4. Emerytury:</p>
                <input class="padding_r_10 update" type="text" data-wartosc_domyslna="<?php echo $Emerytura; ?>" value="<?php echo $Emerytura; ?>" data-kolumna="Emerytura"/>
            </div>
            <div class="col-md-12 inputPole ">
                <p>5. Zasiłki:</p>
                <input class="padding_r_10 update" type="text" data-wartosc_domyslna="<?php echo $Zasilek; ?>" value="<?php echo $Zasilek; ?>" data-kolumna="Zasilek"/>
            </div>
            <div class="col-md-12 inputPole ">
                <p>6. Świadczenia socjalne i pielęgnacyjne:</p>
                <input class="padding_r_10 update" type="text" data-wartosc_domyslna="<?php echo $Socjal; ?>" value="<?php echo $Socjal; ?>" data-kolumna="Socjal"/>
            </div>
            <div class="col-md-12 inputPole ">
                <p>7. Alimenty:</p>
                <input class="padding_r_10 update" type="text" data-wartosc_domyslna="<?php echo $Alimenty; ?>" value="<?php echo $Alimenty; ?>" data-kolumna="Alimenty"/>
            </div>

            <label>
                <div class="zpg_opcja zpg_opcja_input margin_t_20">
                    <p class="float_l">Średni miesięczny dochód netto na osobę w rodzinie:</p>
                    <input class="padding_r_10 width_30 update" type="text" data-wartosc_domyslna="<?php echo $SredniDochod; ?>" value="<?php echo $SredniDochod; ?>" data-kolumna="SredniDochod"/> zł.</div>
            </label>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneDoWnioskuFundacji" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaWniosekVotum" data-ogolne="1" data-strona="osobowe_wniosek_do_fundacji" data-akcja="<?php echo (!$wmiosek_fundacja_votum_tmp) ? 'dodaj_wniosek_fundacji' : 'aktualizuj_wniosek_fundacji'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>