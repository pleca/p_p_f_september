<?php

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
    $akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

    $Zobowiazany = '';
    $NrKredytu = '';
    $DataKredytu = '';
    $ZgloszenieRoszczenDoBanku = 0;
    $NadplaconeRaty = 0;
    $UbezpieczeniPomostowe = 0;
    $UbezpieczeniePomostoweData = '';
    $UbezpieczenieWkladu = 0;
    $UbezpieczenieWkladuData = '';
    $ZlecenieDochodzeniaRoszczen = 0;
    $PelnomocnikNazwa = '';
    $PelnomocnikDataZawarcia = '';
    $PelnomocnikWypowiedzenieUmowy = 0;
    $PelnomocnitWypowiedzenieUmowyData = '';
    $RodzajKredytuId = '0';

    if($akcja == 'edytuj' ){
        $element_id = explode('-',$element_id);

        $umowa_dane = $bazaDanych->pobierzDane('*', 'umowa'.mb_ucfirst($droga), 'Id = '.$element_id[2]);
        $umowa_dane = $umowa_dane->fetch_object();

        $RodzajKredytuId = $umowa_dane->RodzajKredytuId;
        $umowaSlownikTypKredytu = $bazaDanych -> pobierzDane('*','umowaSlownikRodzajKredytu', 'czy_usuniety=0' );


            $umowaSlownikRodzajKredytuWartosc = $bazaDanych->pobierzDane('Wartosc', 'umowaSlownikRodzajKredytu', 'Id=' . $RodzajKredytuId);

            if ($umowaSlownikRodzajKredytuWartosc) {
                $umowaSlownikRodzajKredytuWartosc = $umowaSlownikRodzajKredytuWartosc->fetch_object();
            }


            $Zobowiazany = $umowa_dane->Zobowiazany;
            $UdzielajacyKredytu = $umowa_dane->UdzielajacyKredytu;
            $NrKredytu = $umowa_dane->NrKredytu;
            $DataKredytu = $umowa_dane->DataKredytu;
            $ZgloszenieRoszczenDoBanku = ($umowa_dane->ZgloszenieRoszczenDoBanku == '') ? 0 : $umowa_dane->ZgloszenieRoszczenDoBanku;
            $NadplaconeRaty = ($umowa_dane->NadplaconeRaty == '') ? 0 : $umowa_dane->NadplaconeRaty;

            $UbezpieczeniPomostowe = ($umowa_dane->UbezpieczeniPomostowe == '') ? 0 : $umowa_dane->UbezpieczeniPomostowe;
            $UbezpieczeniePomostoweData = $umowa_dane->UbezpieczeniePomostoweData;

            $UbezpieczenieWkladu = ($umowa_dane->UbezpieczenieWkladu == '') ? 0 : $umowa_dane->UbezpieczenieWkladu;
            $UbezpieczenieWkladuData = $umowa_dane->UbezpieczenieWkladuData;

            $ZlecenieDochodzeniaRoszczen = ($umowa_dane->ZlecenieDochodzeniaRoszczen == '') ? 0 : $umowa_dane->ZlecenieDochodzeniaRoszczen;
            $PelnomocnikNazwa = $umowa_dane->PelnomocnikNazwa;
            $PelnomocnikDataZawarcia = $umowa_dane->PelnomocnikDataZawarcia;

            $PelnomocnikWypowiedzenieUmowy = ($umowa_dane->PelnomocnikWypowiedzenieUmowy == '') ? 0 : $umowa_dane->PelnomocnikWypowiedzenieUmowy;
            $PelnomocnitWypowiedzenieUmowyData = $umowa_dane->PelnomocnitWypowiedzenieUmowyData;


        $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
    }

?>
    <div class="daneStronyUmowyPopUp">

        <label class="margin_t_10 width_100">Umowa dotyczy kredytu:</label>
        <div class="sposobPlatnosci margin_b_10">
            <div class="dropdown width_100">
                <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><div data-kolumna="RodzajKredytuId" data-wartosc_domyslna="<?php echo ($RodzajKredytuId == "0") ? "0" : $RodzajKredytuId; ?>" value="<?php echo ($RodzajKredytuId == "0") ? "0" : $RodzajKredytuId; ?>" class="dpUstawOpcjeNazwa attrValue update float_l"><?php echo ($RodzajKredytuId == "0") ? "Brak" : mb_ucfirst($umowaSlownikRodzajKredytuWartosc->Wartosc); ?></div>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                    while($poj_umowaSlownikTypKredytu = $umowaSlownikTypKredytu->fetch_object()){
                        echo '<li class="dpUstawOpcje UmowaRodzajUprawnionegoOpcja" data-element_id="'.$poj_umowaSlownikTypKredytu->Id.'">'.mb_ucfirst($poj_umowaSlownikTypKredytu->Wartosc).'</li>';
                    }
                    ?>

                </ul>
            </div>
        </div>


        <div class="col-md-12 inputPole margin_b_10"><input data-wartosc_domyslna="<?php echo $Zobowiazany; ?>" value="<?php echo $Zobowiazany; ?>" data-kolumna="Zobowiazany" type="text" class="update duzeMaleLiteryCyfry" placeholder="Bank do którego aktualnie są wpłacane raty"></div>
        <div class="col-md-12 inputPole margin_b_10"><input data-wartosc_domyslna="<?php echo $UdzielajacyKredytu; ?>" value="<?php echo $UdzielajacyKredytu; ?>" data-kolumna="UdzielajacyKredytu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Udzielajacy Kredytu"></div>
        <div class="col-md-5 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $DataKredytu; ?>" value="<?php echo $DataKredytu; ?>" data-kolumna="DataKredytu" type="text" class="update datePicker" maxlength="10" placeholder="Data kredytu"></div>
        <div class="col-md-7 inputPole "><input data-wartosc_domyslna="<?php echo $NrKredytu; ?>" value="<?php echo $NrKredytu; ?>" data-kolumna="NrKredytu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Numer kredytu"></div>

        <label class="margin_t_10 width_100">ODPOWIEDZIALNOŚ ZOBOWIĄZANEGO</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $ZgloszenieRoszczenDoBanku; ?>" value="<?php echo $ZgloszenieRoszczenDoBanku; ?>" data-kolumna="ZgloszenieRoszczenDoBanku" class="fa fa<?php echo ($ZgloszenieRoszczenDoBanku == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>Zgłoszono roszczenie do Banku</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $NadplaconeRaty; ?>" value="<?php echo $NadplaconeRaty; ?>" data-kolumna="NadplaconeRaty" class="fa fa<?php echo ($NadplaconeRaty == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>Nadpłaconych rat w związku z zastosowaną indeksacją</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $UbezpieczeniPomostowe; ?>" value="<?php echo $UbezpieczeniPomostowe; ?>" data-kolumna="UbezpieczeniPomostowe" class="fa fa<?php echo ($UbezpieczeniPomostowe == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>nienależnie pobranej opłaty w związku z likwidacją ubezpieczenia pomostowego</p></div>
            <div class="zpg_opcja zpg_opcja_input"><p class="float_l">data zgłoszenia:</p><input type="text" data-wartosc_domyslna="<?php echo $UbezpieczeniePomostoweData; ?>" value="<?php echo $UbezpieczeniePomostoweData; ?>" data-kolumna="UbezpieczeniePomostoweData" maxlength="10" class="datePicker <?php echo ($UbezpieczeniPomostowe == 1) ? 'update' : '' ; ?>"/></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $UbezpieczenieWkladu; ?>" value="<?php echo $UbezpieczenieWkladu; ?>" data-kolumna="UbezpieczenieWkladu" class="fa fa<?php echo ($UbezpieczenieWkladu == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p>nienależnie pobranej opłaty w związku z likwidacją ubezpieczenia wkładu własnego</p></div>
            <div class="zpg_opcja zpg_opcja_input"><p class="float_l">data zgłoszenia:</p><input type="text" data-wartosc_domyslna="<?php echo $UbezpieczenieWkladuData; ?>" value="<?php echo $UbezpieczenieWkladuData; ?>" data-kolumna="UbezpieczenieWkladuData" maxlength="10" class="datePicker <?php echo ($UbezpieczenieWkladuData == 1) ? 'update' : '' ; ?>"/></div>
            <div class="clear_b"></div>
        </div>

        <label class="margin_t_10 width_100">DOCHODZENIE ROSZCZEŃ</label>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $ZlecenieDochodzeniaRoszczen; ?>" value="<?php echo $ZlecenieDochodzeniaRoszczen; ?>" data-kolumna="ZlecenieDochodzeniaRoszczen" class="fa fa<?php echo ($ZlecenieDochodzeniaRoszczen == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue duzeMaleLiteryCyfry" aria-hidden="true"></i><p>sprawę zlecano wcześniej pełnomocnikowi</p></div>
            <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $PelnomocnikNazwa; ?>" value="<?php echo $PelnomocnikNazwa; ?>" data-kolumna="PelnomocnikNazwa" class="<?php echo ($ZlecenieDochodzeniaRoszczen == 1) ? 'update' : '' ; ?>"/></div>
            <div class="zpg_opcja zpg_opcja_input"><p class="float_l">z którym zawarto umowę dnia: </p><input type="text" data-wartosc_domyslna="<?php echo $PelnomocnikDataZawarcia; ?>" value="<?php echo $PelnomocnikDataZawarcia; ?>" data-kolumna="PelnomocnikDataZawarcia" maxlength="10" class="datePicker <?php echo ($ZlecenieDochodzeniaRoszczen == 1) ? 'update' : '' ; ?>"/></div>

            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $PelnomocnikWypowiedzenieUmowy; ?>" value="<?php echo $PelnomocnikWypowiedzenieUmowy; ?>" data-kolumna="PelnomocnikWypowiedzenieUmowy" class="fa fa<?php echo ($PelnomocnikWypowiedzenieUmowy == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l  attrValue" aria-hidden="true"></i><p>umowę z wyżej wymienionym pełnomocnikiem wypowiedziano</p></div>
            <div class="zpg_opcja zpg_opcja_input"><p class="float_l">w dniu:</p><input type="text" data-wartosc_domyslna="<?php echo $PelnomocnitWypowiedzenieUmowyData; ?>" value="<?php echo $PelnomocnitWypowiedzenieUmowyData; ?>" data-kolumna="PelnomocnitWypowiedzenieUmowyData" maxlength="10" class="datePicker <?php echo ($PelnomocnikWypowiedzenieUmowy == 1) ? 'update' : '' ; ?>"/></div>
            <div class="clear_b"></div>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaBankowa" data-strona="2" data-ogolne="0" data-akcja="aktualizuj_strone_umowy" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>


    </div>