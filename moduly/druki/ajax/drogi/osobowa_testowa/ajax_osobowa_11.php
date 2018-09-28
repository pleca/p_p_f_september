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

        $OswiadczenieUprawnionegoId = $umowa_dane_tmp->OswiadczenieUprawnionegoId;
        $OsobaPoszkodowanyId = $umowa_dane_tmp->OsobaPoszkodowanyId;
        $OsobaUprawnionyId = $umowa_dane_tmp->OsobaUprawnionyId;


        $OswiadczenieUprawnionego = $bazaDanych->pobierzDane('*', 'umowaOswiadczenieUprawnionego', 'Id=' . $OswiadczenieUprawnionegoId);
        $OsobaPoszkodowany = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id=' . $OsobaPoszkodowanyId);
        $OsobaUprawniony = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id=' . $OsobaUprawnionyId);
        $StosunkiRodzinne = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id=' . $StosunkiRodzinneId);
    }

    if ($OswiadczenieUprawnionego) {
        $OswiadczenieUprawnionego = $OswiadczenieUprawnionego->fetch_object();

        $PogorszenieSytuacjiZyciowej = $OswiadczenieUprawnionego->PogorszenieSytuacjiZyciowej;
        $WystapienieKrzywdy = $OswiadczenieUprawnionego->WystapienieKrzywdy;
        $WiekZmWMomencieSmierci = $OswiadczenieUprawnionego->WiekZmWMomencieSmierci;
        $WiekUprWMomencieSmierci = $OswiadczenieUprawnionego->WiekUprWMomencieSmierci;
        $StosunkiRodzinneId = $OswiadczenieUprawnionego->StosunkiRodzinneId;
        $SytuacjaPoSmierciId = $OswiadczenieUprawnionego->SytuacjaPoSmierciId;

        $StosunkiRodzinne = $bazaDanych->pobierzDane('*', 'umowaStosunkiRodzinne', 'Id=' . $StosunkiRodzinneId);
        $SytuacjaPoSmierci = $bazaDanych->pobierzDane('*', 'umowaSytuacjaPoSmierci', 'Id=' . $SytuacjaPoSmierciId);
    }

    if ($OsobaPoszkodowany) {
        $OsobaPoszkodowany = $OsobaPoszkodowany->fetch_object();

        $ZmarlyWyksztalcenie = $OsobaPoszkodowany->Wyksztalcenie;
        $ZmarlyZawodWyuczony = $OsobaPoszkodowany->ZawodWyuczony;
        $ZmarlyZawodWykonywany = $OsobaPoszkodowany->ZawodWykonywany;
        $ZmarlyDodatkoweUprawnienia = $OsobaPoszkodowany->DodatkoweUprawnienia;
        $ZmarlyZatrudnienie = $OsobaPoszkodowany->Zatrudnienie;
        $ZmarlyZatrudnienieInne = $OsobaPoszkodowany->ZatrudnienieInne;
        $ZmarlyZarobki = $OsobaPoszkodowany->Zarobki;
    }

    if ($OsobaUprawniony) {
        $OsobaUprawniony = $OsobaUprawniony->fetch_object();

        $UprawnionyWyksztalcenie = $OsobaUprawniony->Wyksztalcenie;
        $UprawnionyZawodWyuczony = $OsobaUprawniony->ZawodWyuczony;
        $UprawnionyZawodWykonywany = $OsobaUprawniony->ZawodWykonywany;
        $UprawnionyDodatkoweUprawnienia = $OsobaUprawniony->DodatkoweUprawnienia;
        $UprawnionyZatrudnienie = $OsobaUprawniony->Zatrudnienie;
        $UprawnionyZatrudnienieInne = $OsobaUprawniony->ZatrudnienieInne;
        $UprawnionyZarobki = $OsobaUprawniony->Zarobki;
    }

    if ($StosunkiRodzinne) {
        $StosunkiRodzinne = $StosunkiRodzinne->fetch_object();

        $PokrewienstwoZeZmarlym = $StosunkiRodzinne->PokrewienstwoZeZmarlym;
        $PokrewienstwoInneZeZmarlym = $StosunkiRodzinne->PokrewienstwoInneZeZmarlym;
        $WspolneGospodarstwo = $StosunkiRodzinne->WspolneGospodarstwo;
        $TenSamAdres = $StosunkiRodzinne->TenSamAdres;
        $InnyAdres = $StosunkiRodzinne->InnyAdres;
        $PomagalWObowiazkach = $StosunkiRodzinne->PomagalWObowiazkach;
        $StosunkiZeZmarlym = $StosunkiRodzinne->StosunkiZeZmarlym;
        $BylNaUtrzymaniu = $StosunkiRodzinne->BylNaUtrzymaniu;
        $LozylNaUtrzymanie = $StosunkiRodzinne->LozylNaUtrzymanie;
        $WspolneKonto = $StosunkiRodzinne->WspolneKonto;
        $PartycypowalKoszty = $StosunkiRodzinne->PartycypowalKoszty;
        $WspieralbyFinansowo = $StosunkiRodzinne->WspieralbyFinansowo;
    }

    if ($SytuacjaPoSmierci) {
        $SytuacjaPoSmierci = $SytuacjaPoSmierci->fetch_object();

        $SytuacjaMaterialna = $SytuacjaPoSmierci->SytuacjaMaterialna;
        $MotywacjaUprawnionego = $SytuacjaPoSmierci->MotywacjaUprawnionego;
        $WstrzasPsychiczny = $SytuacjaPoSmierci->WstrzasPsychiczny;
        $KorzystalZeSrodkow = $SytuacjaPoSmierci->KorzystalZeSrodkow;
        $StanUleglPogorszeniu = $SytuacjaPoSmierci->StanUleglPogorszeniu;
        $KorzystalZPorad = $SytuacjaPoSmierci->KorzystalZPorad;
        $Porady = $SytuacjaPoSmierci->Porady;
        $Wdowa = $SytuacjaPoSmierci->Wdowa;
        $Dzieci = $SytuacjaPoSmierci->Dzieci;
        $LiczbaDzieci = $SytuacjaPoSmierci->LiczbaDzieci;
        $WiekDzieci = $SytuacjaPoSmierci->WiekDzieci;

    }




    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneOswiadczenieUprawnionegoPopUp">

            <label class="margin_t_10 width_100 gray_background">OŚWIADCZENIE OSOBY UPRAWNIONEJ</label>

            <label class="margin_t_10 width_100">Oświadczenie osoby uprawnionej jest składane w związku z:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $PogorszenieSytuacjiZyciowej; ?>" value="1" data-kolumna="PogorszenieSytuacjiZyciowej" class="fa fa<?php echo ($PogorszenieSytuacjiZyciowej == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>pogorszeniem sytuacji życiowej w sferze materialnej</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $WystapienieKrzywdy; ?>" value="3" data-kolumna="WystapienieKrzywdy" class="fa fa<?php echo ($WystapienieKrzywdy == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>wystąpieniem krzywdy w związku ze śmiercią członka najbliższej rodziny.</p></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">Wiek zmarłego w momencie śmierci:</label>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $WiekZmWMomencieSmierci; ?>" value="<?php echo ($WiekZmWMomencieSmierci == '0000-00-00') ? '' : $WiekZmWMomencieSmierci; ?>" data-kolumna="WiekZmWMomencieSmierci" maxlength="10" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Wykształcenie zmarłego:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyWyksztalcenie; ?>" value="1" data-kolumna="ZmarlyWyksztalcenie" class="fa fa<?php echo ($ZmarlyWyksztalcenie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">podstawowe</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyWyksztalcenie; ?>" value="2" data-kolumna="ZmarlyWyksztalcenie" class="fa fa<?php echo ($ZmarlyWyksztalcenie == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">zawodowe</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyWyksztalcenie; ?>" value="3" data-kolumna="ZmarlyWyksztalcenie" class="fa fa<?php echo ($ZmarlyWyksztalcenie == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">średnie</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyWyksztalcenie; ?>" value="4" data-kolumna="ZmarlyWyksztalcenie" class="fa fa<?php echo ($ZmarlyWyksztalcenie == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">wyższe</p></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">Wyuczony zawód zmarłego:</label>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $ZmarlyZawodWyuczony; ?>" value="<?php echo $ZmarlyZawodWyuczony; ?>" data-kolumna="ZmarlyZawodWyuczony" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">Zawód wykonywany przez zmarłego:</label>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $ZmarlyZawodWykonywany; ?>" value="<?php echo $ZmarlyZawodWykonywany; ?>" data-kolumna="ZmarlyZawodWykonywany" maxlength="10" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">Dodatkowe kwalifikacje lub uprawnienia zmarłego:</label>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $ZmarlyDodatkoweUprawnienia; ?>" value="<?php echo $ZmarlyDodatkoweUprawnienia; ?>" data-kolumna="ZmarlyDodatkoweUprawnienia" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Zatrudnienie zmarłego:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyZatrudnienie; ?>" value="1" data-kolumna="ZmarlyZatrudnienie" class="fa fa<?php echo ($ZmarlyZatrudnienie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">brak</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyZatrudnienie; ?>" value="2" data-kolumna="ZmarlyZatrudnienie" class="fa fa<?php echo ($ZmarlyZatrudnienie == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">umowa o pracę</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyZatrudnienie; ?>" value="3" data-kolumna="ZmarlyZatrudnienie" class="fa fa<?php echo ($ZmarlyZatrudnienie == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">umowa zlecenie</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyZatrudnienie; ?>" value="4" data-kolumna="ZmarlyZatrudnienie" class="fa fa<?php echo ($ZmarlyZatrudnienie == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">własna działalnośc gospodarcza</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyZatrudnienie; ?>" value="5" data-kolumna="ZmarlyZatrudnienie" class="fa fa<?php echo ($ZmarlyZatrudnienie == 5) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">gospodarstwo rolne</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyZatrudnienie; ?>" value="6" data-kolumna="ZmarlyZatrudnienie" class="fa fa<?php echo ($ZmarlyZatrudnienie == 6) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">prace dorywcze</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $ZmarlyZatrudnienie; ?>" value="7" data-kolumna="ZmarlyZatrudnienie" class="fa fa<?php echo ($ZmarlyZatrudnienie == 7) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">inne: </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $ZmarlyZatrudnienieInne; ?>" value="<?php echo $ZmarlyZatrudnienieInne; ?>" data-kolumna="ZmarlyZatrudnienieInne" class="datePicker update"/></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                    <label><p>Przeciętne miesięczne zarobki zmarłego w okresie 3-ch miesięcy przed wypadkiem wedłuj wiedzy klienta wynosiły</p>
                    <div class="zpg_opcja zpg_opcja_input"> około:
                        <input class="padding_r_10 width_30 update" type="text" data-wartosc_domyslna="<?php echo $ZmarlyZarobki; ?>" value="<?php echo $ZmarlyZarobki; ?>" data-kolumna="ZmarlyZarobki"/> zł netto.</label>
                        </div>
            </div>


            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">Wiek uprawnionego w momencie śmierci zmarłego:</label>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $WiekUprWMomencieSmierci; ?>" value="<?php echo ($WiekUprWMomencieSmierci == '0000-00-00') ? '' : $WiekUprWMomencieSmierci; ?>" data-kolumna="WiekUprWMomencieSmierci" maxlength="10" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Wykształcenie uprawnionego:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyWyksztalcenie; ?>" value="1" data-kolumna="UprawnionyWyksztalcenie" class="fa fa<?php echo ($UprawnionyWyksztalcenie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">podstawowe</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyWyksztalcenie; ?>" value="2" data-kolumna="UprawnionyWyksztalcenie" class="fa fa<?php echo ($UprawnionyWyksztalcenie == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">zawodowe</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyWyksztalcenie; ?>" value="3" data-kolumna="UprawnionyWyksztalcenie" class="fa fa<?php echo ($UprawnionyWyksztalcenie == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">średnie</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyWyksztalcenie; ?>" value="4" data-kolumna="UprawnionyWyksztalcenie" class="fa fa<?php echo ($UprawnionyWyksztalcenie == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">wyższe</p></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">Wyuczony zawód uprawnionego:</label>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $UprawnionyZawodWyuczony; ?>" value="<?php echo $UprawnionyZawodWyuczony; ?>" data-kolumna="UprawnionyZawodWyuczony" maxlength="10" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">Zawód wykonywany przez uprawnionego:</label>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $UprawnionyZawodWykonywany; ?>" value="<?php echo $UprawnionyZawodWykonywany; ?>" data-kolumna="UprawnionyZawodWykonywany" maxlength="10" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                <label class="float_l">Dodatkowe kwalifikacje lub uprawnienia uprawnionego :</label>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $UprawnionyDodatkoweUprawnienia; ?>" value="<?php echo $UprawnionyDodatkoweUprawnienia; ?>" data-kolumna="UprawnionyDodatkoweUprawnienia" maxlength="10" class="update"/></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Zatrudnienie uprawnionego:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyZatrudnienie; ?>" value="1" data-kolumna="UprawnionyZatrudnienie" class="fa fa<?php echo ($UprawnionyZatrudnienie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">brak</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyZatrudnienie; ?>" value="2" data-kolumna="UprawnionyZatrudnienie" class="fa fa<?php echo ($UprawnionyZatrudnienie == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">umowa o pracę</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyZatrudnienie; ?>" value="3" data-kolumna="UprawnionyZatrudnienie" class="fa fa<?php echo ($UprawnionyZatrudnienie == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">umowa zlecenie</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyZatrudnienie; ?>" value="4" data-kolumna="UprawnionyZatrudnienie" class="fa fa<?php echo ($UprawnionyZatrudnienie == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">własna działalnośc gospodarcza</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyZatrudnienie; ?>" value="5" data-kolumna="UprawnionyZatrudnienie" class="fa fa<?php echo ($UprawnionyZatrudnienie == 5) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">gospodarstwo rolne</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyZatrudnienie; ?>" value="6" data-kolumna="UprawnionyZatrudnienie" class="fa fa<?php echo ($UprawnionyZatrudnienie == 6) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">prace dorywcze</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $UprawnionyZatrudnienie; ?>" value="7" data-kolumna="UprawnionyZatrudnienie" class="fa fa<?php echo ($UprawnionyZatrudnienie == 7) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">inne: </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $UprawnionyZatrudnienieInne; ?>" value="<?php echo $UprawnionyZatrudnienieInne; ?>" data-kolumna="UprawnionyZatrudnienieInne" maxlength="10" class="datePicker update"/></div>
                <div class="clear_b"></div>
            </div>

            <div class="zaznaczPoleGrupa margin_t_20">
                <label>
                    <div class="zpg_opcja zpg_opcja_input">
                        <p class="float_l">Średnie miesięczne zarobki uprawnionego z okresu ostatnich 3-ch miesięcy:</p>
                        <input class="padding_r_10 width_30 update" type="text" data-wartosc_domyslna="<?php echo $UprawnionyZarobki; ?>" value="<?php echo $UprawnionyZarobki; ?>" data-kolumna="UprawnionyZarobki"/> zł netto.</div>
                </label>
            </div>

            <label class="margin_t_10 width_100">Zmarły był dla uprawnionego:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PokrewienstwoZeZmarlym; ?>" value="1" data-kolumna="PokrewienstwoZeZmarlym" class="fa fa<?php echo ($PokrewienstwoZeZmarlym == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">mężem/żoną</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PokrewienstwoZeZmarlym; ?>" value="2" data-kolumna="PokrewienstwoZeZmarlym" class="fa fa<?php echo ($PokrewienstwoZeZmarlym == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">partnerem/parnerką</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PokrewienstwoZeZmarlym; ?>" value="3" data-kolumna="PokrewienstwoZeZmarlym" class="fa fa<?php echo ($PokrewienstwoZeZmarlym == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">ojcem/matką</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PokrewienstwoZeZmarlym; ?>" value="4" data-kolumna="PokrewienstwoZeZmarlym" class="fa fa<?php echo ($PokrewienstwoZeZmarlym == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">synem/córką</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PokrewienstwoZeZmarlym; ?>" value="5" data-kolumna="PokrewienstwoZeZmarlym" class="fa fa<?php echo ($PokrewienstwoZeZmarlym == 5) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">bratem/siostrą</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PokrewienstwoZeZmarlym; ?>" value="6" data-kolumna="PokrewienstwoZeZmarlym" class="fa fa<?php echo ($PokrewienstwoZeZmarlym == 6) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">wnukiem/wnuczką</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PokrewienstwoZeZmarlym; ?>" value="7" data-kolumna="PokrewienstwoZeZmarlym" class="fa fa<?php echo ($PokrewienstwoZeZmarlym == 7) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">dziadkiem/babcią</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $PokrewienstwoZeZmarlym; ?>" value="8" data-kolumna="PokrewienstwoZeZmarlym" class="fa fa<?php echo ($PokrewienstwoZeZmarlym == 8) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">inne: </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $PokrewienstwoInneZeZmarlym; ?>" value="<?php echo $PokrewienstwoInneZeZmarlym; ?>" data-kolumna="PokrewienstwoInneZeZmarlym" maxlength="10" class="datePicker update"/></div>
                <div class="clear_b"></div>
            </div>


            <label class="margin_t_10 width_100">Zmarły:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $WspolneGospodarstwo; ?>" value="1" data-kolumna="WspolneGospodarstwo" class="fa fa<?php echo ($WspolneGospodarstwo == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>pozostawał z uprawnionym we wspólnym gospodarstwie</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $TenSamAdres; ?>" value="1" data-kolumna="TenSamAdres" class="fa fa<?php echo ($TenSamAdres == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>był zameldowany pod tym samym adresem co uprawniony</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $InnyAdres; ?>" value="1" data-kolumna="InnyAdres" class="fa fa<?php echo ($InnyAdres == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>nie był zameldowany pod tym samym adresem co uprawniony, ale mieszkali razem</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $PomagalWObowiazkach; ?>" value="1" data-kolumna="PomagalWObowiazkach" class="fa fa<?php echo ($PomagalWObowiazkach == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>pomagał w biezących obowiązkach</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $PomagalWObowiazkach; ?>" value="2" data-kolumna="PomagalWObowiazkach" class="fa fa<?php echo ($PomagalWObowiazkach == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>nie pomagał w biezących obowiązkach</p></div>
                <div class="clear_b"></div>
            </div>


            <label class="margin_t_10 width_100">Stosunki uprawnionego ze zmarłym można określić jako:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $StosunkiZeZmarlym; ?>" value="1" data-kolumna="StosunkiZeZmarlym" class="fa fa<?php echo ($StosunkiZeZmarlym == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">bardzo zażyłe</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $StosunkiZeZmarlym; ?>" value="2" data-kolumna="StosunkiZeZmarlym" class="fa fa<?php echo ($StosunkiZeZmarlym == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">zażyłe</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $StosunkiZeZmarlym; ?>" value="3" data-kolumna="StosunkiZeZmarlym" class="fa fa<?php echo ($StosunkiZeZmarlym == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">powierzchowne</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $StosunkiZeZmarlym; ?>" value="4" data-kolumna="StosunkiZeZmarlym" class="fa fa<?php echo ($StosunkiZeZmarlym == 4) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">złe.</p></div>
                <div class="clear_b"></div>
            </div>


            <label class="margin_t_10 width_100">Zmarły:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $BylNaUtrzymaniu; ?>" value="1" data-kolumna="BylNaUtrzymaniu" class="fa fa<?php echo ($BylNaUtrzymaniu == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>był na moim utrzymaniu</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $LozylNaUtrzymanie; ?>" value="1" data-kolumna="LozylNaUtrzymanie" class="fa fa<?php echo ($LozylNaUtrzymanie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>łożył na moje utrzymanie</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $WspolneKonto; ?>" value="1" data-kolumna="WspolneKonto" class="fa fa<?php echo ($WspolneKonto == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>posiadał z uprawnionym wspólne konto</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $PartycypowalKoszty; ?>" value="1" data-kolumna="PartycypowalKoszty" class="fa fa<?php echo ($PartycypowalKoszty == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>partycypował koszty utrzymania rodziny</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $WspieralbyFinansowo; ?>" value="1" data-kolumna="WspieralbyFinansowo" class="fa fa<?php echo ($WspieralbyFinansowo == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>wdług oceny uprawnionego - w razie potrzeby wspierałby uprawnionego finansowo w przyszłości</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Po śmierci członka rodziny sytuacja materialna uprawnionego:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $SytuacjaMaterialna; ?>" value="1" data-kolumna="SytuacjaMaterialna" class="fa fa<?php echo ($SytuacjaMaterialna == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">nie uległa zmianie</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $SytuacjaMaterialna; ?>" value="2" data-kolumna="SytuacjaMaterialna" class="fa fa<?php echo ($SytuacjaMaterialna == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">pogorszyła się nieznacznie</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $SytuacjaMaterialna; ?>" value="3" data-kolumna="SytuacjaMaterialna" class="fa fa<?php echo ($SytuacjaMaterialna == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">pogorszyła się znacznie</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Motywacja uprawnionego do poprawy sytuacji materialnej:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $MotywacjaUprawnionego; ?>" value="1" data-kolumna="MotywacjaUprawnionego" class="fa fa<?php echo ($MotywacjaUprawnionego == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">nie uległa zmianie</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $MotywacjaUprawnionego; ?>" value="2" data-kolumna="MotywacjaUprawnionego" class="fa fa<?php echo ($MotywacjaUprawnionego == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">poprawiła się</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $MotywacjaUprawnionego; ?>" value="3" data-kolumna="MotywacjaUprawnionego" class="fa fa<?php echo ($MotywacjaUprawnionego == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">pogorszyła się</p></div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Po śmierci członka rodziny uprawniony:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $WstrzasPsychiczny; ?>" value="1" data-kolumna="WstrzasPsychiczny" class="fa fa<?php echo ($WstrzasPsychiczny == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>odczuł</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $WstrzasPsychiczny; ?>" value="2" data-kolumna="WstrzasPsychiczny" class="fa fa<?php echo ($WstrzasPsychiczny == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>nie odczuł znaczącego wstrząsu psychicznego</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio "><i data-wartosc_domyslna="<?php echo $KorzystalZeSrodkow; ?>" value="1" data-kolumna="KorzystalZeSrodkow" class="fa fa<?php echo ($KorzystalZeSrodkow == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>uprawniony korzysta z środków farmakologicznych w związku ze złym stanem psychicznym</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $StanUleglPogorszeniu; ?>" value="1" data-kolumna="StanUleglPogorszeniu" class="fa fa<?php echo ($StanUleglPogorszeniu == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>stan zdrowia uprawnionego uległ pogorszeniu</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $KorzystalZPorad; ?>" value="1" data-kolumna="KorzystalZPorad" class="fa fa<?php echo ($KorzystalZPorad == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>uprawniony korzysta z porad/wsparcia:</p>
                    <div class="zaznaczPoleGrupa margin_l_40 margin_t_5">
                        <div class="zaznaczPoleGrupa ">
                            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $Porady; ?>" value="1" data-kolumna="Porady" class="fa fa<?php echo ($Porady == 1) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>psychiatry</p></div>
                            <div class="clear_b"></div>
                        </div>
                        <div class="zaznaczPoleGrupa ">
                            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $Porady; ?>" value="2" data-kolumna="Porady" class="fa fa<?php echo ($Porady == 2) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>psychologa</p></div>
                            <div class="clear_b"></div>
                        </div>
                        <div class="zaznaczPoleGrupa ">
                            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $Porady; ?>" value="3" data-kolumna="Porady" class="fa fa<?php echo ($Porady == 3) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>pedagoga szkolnego</p></div>
                            <div class="clear_b"></div>
                        </div>
                        <div class="zaznaczPoleGrupa ">
                            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $Porady; ?>" value="4" data-kolumna="Porady" class="fa fa<?php echo ($Porady == 4) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>lekarza pierwszego kontaktu</p></div>
                            <div class="clear_b"></div>
                        </div>
                        <div class="zaznaczPoleGrupa ">
                            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $Porady; ?>" value="5" data-kolumna="Porady" class="fa fa<?php echo ($Porady == 5) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>duchownego</p></div>
                            <div class="clear_b"></div>
                        </div>
                        <div class="zaznaczPoleGrupa ">
                            <div class="zpg_opcja_radio"><i data-wartosc_domyslna="<?php echo $Porady; ?>" value="6" data-kolumna="Porady" class="fa fa<?php echo ($Porady == 6) ? '-check' : '' ; ?>-square-o fa-lg attrValue margin_t_5 float_l" aria-hidden="true"></i><p>rodziny</p></div>
                            <div class="clear_b"></div>
                        </div>
                    </div>
                </div>
                <div class="clear_b"></div>
            </div>

            <label class="margin_t_10 width_100">Zmarły pozostawił po sobie:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $Wdowa; ?>" value="1" data-kolumna="Wdowa" class="fa fa<?php echo ($Wdowa == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">wdowę/wdowca</p></div>
                <div class="zpg_opcja_radio float_l"><i data-wartosc_domyslna="<?php echo $Dzieci; ?>" value="1" data-kolumna="Dzieci" class="fa fa<?php echo ($Dzieci == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p class="float_l">dzieci: </p></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $LiczbaDzieci; ?>" value="<?php echo $LiczbaDzieci; ?>" data-kolumna="LiczbaDzieci" class="update" placeholder="Liczba dzieci"/></div>
                <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $WiekDzieci; ?>" value="<?php echo $WiekDzieci; ?>" data-kolumna="WiekDzieci" class="update" placeholder="Wiek po średniku"/></div>
                <div class="clear_b"></div>
            </div>


                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneOswiadczenieUprawnionegoPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsobowa" data-ogolne="0" data-strona="11" data-akcja="<?php echo (!$OswiadczenieUprawnionego) ? 'dodaj_oswiadczenie_uprawnionego' : 'aktualizuj_oswiadczenie_uprawnionego'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

            </div>

        </div>
