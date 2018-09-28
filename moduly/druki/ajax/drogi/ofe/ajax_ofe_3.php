<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$disabled = 'disabled';
$update = '';


$CzyZmarlyWskazalOsoby = '';
$CzyBylPosiadaczemRachunkuBankowego = '';
$Nazwa = '';
$Numer = '';
$lista_osob_uprawnionych = 0;
$lista_spadkobiercow = 0;




if($akcja == 'edytuj' ){

    $element_id_tmp = explode('-',$element_id);
    $umowa_dane_tmp = $bazaDanych -> pobierzDane('*', 'umowa'.mb_ucfirst($droga), 'Id='.$element_id_tmp[2]);

    $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

    $CzyZmarlyWskazalOsoby = $umowa_dane_tmp->CzyZmarlyWskazalOsoby;
    $CzyBylPosiadaczemRachunkuBankowego = $umowa_dane_tmp->CzyBylPosiadaczemRachunkuBankowego;

    $rachunek_tmp = $bazaDanych -> pobierzDane('*','umowaRachunekBankowy','OsobaId='.$umowa_dane_tmp->OsobaZmarlyId.' AND Typ = 3');

    if ($rachunek_tmp) {
        $rachunek_tmp = $rachunek_tmp->fetch_object();

        $Nazwa = $rachunek_tmp->Nazwa;
        $Numer = $rachunek_tmp->Numer;
    }


    $element_id = explode('-',$element_id);

    $lista_osob_uprawnionych = $bazaDanych->pobierzDane('OsobaId','umowaOfeOsoba','OfeId = '.$element_id[2].' AND TypOsoby = 4');

    $lista_spadkobiercow = $bazaDanych->pobierzDane('OsobaId','umowaOfeOsoba','OfeId = '.$element_id[2].' AND TypOsoby = 5');

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}

?>

    <div class="daneORachunkachOfe">
        <label class="margin_t_10 width_100">CZY POSIADACZ RACHUNKU EMERYTALNEGO WSKAZAŁ W UMOWIE O PROWADZENIE RACHUNKU EMERYTALNEGO OSOBY UPRAWNIONE DO OTRZYMANIA ŚRODKÓW PIENIĘŻNYCH Z RACHUNKU EMERYTALNEGO PO JEGO ŚMIERCI?</label>

        <div class="zaznaczPoleGrupa formularzeRachunki">
                <div class="zpg_opcja_radio ">
                    <i data-wartosc_domyslna="<?php echo $CzyZmarlyWskazalOsoby; ?>" value="1" data-kolumna="CzyZmarlyWskazalOsoby" class="fa fa<?php echo ($CzyZmarlyWskazalOsoby == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>TAK, jeśli tak, to kogo wskazał? Osoby wskazane przez zmarłego posiadacza rachunku emerytalnego:</p>
                    <div class="panel panel-default margin_b_10 margin_t_10 ">
                        <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek">LISTA UPRAWNIONYCH<i class="fa dsu_dodaj_nowego_klienta fa-plus float_r" aria-hidden="true"></i></div>
                        <div class="panel-body ukryj_widok daneUprawnionych daneDodatkowegoKlienta1">

                            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
                            <div class="col-md-6 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
                            <div class="col-md-0 inputPole padding_r_10"><input type="hidden" data-wartosc_domyslna="0" value="4" data-kolumna="TypOsoby" type="text" class="update" placeholder=""></div>


                            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneDodatkowegoKlienta1" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="3" data-akcja="dodaj_dodatkowego_klienta" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Dodaj klienta</button>

                            <?php
                            if($lista_osob_uprawnionych){
                                $i = 0;
                                while($poj_lista_osob_uprawnionych = $lista_osob_uprawnionych->fetch_object()){

                                    $umowa_osoba_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$poj_lista_osob_uprawnionych->OsobaId);
                                    $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

                                    $Imie = $umowa_osoba_tmp->Imie;
                                    $Nazwisko = $umowa_osoba_tmp->Nazwisko;


                                    $element_id = explode('-',$element_id);

                                    $element_id = $element_id[0].'-'.$poj_lista_osob_uprawnionych->OsobaId.'-'.$element_id[2];

                                    ?>
                                    <div class="panel panel-default margin_t_10 margin_b_0">
                                        <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek"><?php echo $Imie.' '.$Nazwisko; ?><i class="fa dsu_dodaj_nowego_klienta fa-pencil float_r" aria-hidden="true"></i></div>
                                        <div class="panel-body ukryj_widok daneUprawnionych daneDodatkowegoKlienta_<?php echo $i; ?>">

                                            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
                                            <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>

                                            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneDodatkowegoKlienta_<?php echo $i; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="3" data-akcja="aktualizuj_dodatkowego_klienta" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="zpg_opcja_radio margin_t_10">
                    <i data-wartosc_domyslna="<?php echo $CzyZmarlyWskazalOsoby; ?>" value="2" data-kolumna="CzyZmarlyWskazalOsoby" class="fa fa<?php echo ($CzyZmarlyWskazalOsoby == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>NIE</p>
                </div>
                <div class="zpg_opcja_radio margin_t_10">
                    <i data-wartosc_domyslna="<?php echo $CzyZmarlyWskazalOsoby; ?>" value="3" data-kolumna="CzyZmarlyWskazalOsoby" class="fa fa<?php echo ($CzyZmarlyWskazalOsoby == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p>BRAK INFORMACJI</p>
                </div>
                <div class="clear_b"></div>
        </div>

        <label class="margin_t_10 width_100">SPADKOBIERCY ZMARŁEGO POSIADACZA RACHUNKU EMERYTALNEGO
            <p class="font_size_10">Informacje o spadkobiercach posiadacza rachunku emerytalnego (wypełnić w przypadku, gdy brak osób wskazanych przez posiadacza rachunku emerytalnego jako uprawnione do otrzymania środków pieniężnych z rachunku emerytalnego po jego śmierci lub brak informacji na ten temat).</p>
        </label>

        <div class="zaznaczPoleGrupa dane_o_uprawnionych">
            <div class="panel panel-default margin_b_10 margin_t_10 ">
                <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek">LISTA SPADKOBIERCÓW<i class="fa dsu_dodaj_nowego_klienta fa-plus float_r" aria-hidden="true"></i></div>
                <div class="panel-body ukryj_widok daneSpadkobiercow daneDodatkowegoKlienta2">

                    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
                    <div class="col-md-6 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
                    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" data-wartosc_domyslna="0" value="5" data-kolumna="TypOsoby" type="text" class="update" placeholder=""></div>

                    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneDodatkowegoKlienta2" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="3" data-akcja="dodaj_dodatkowego_klienta" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Dodaj klienta</button>

                    <?php
                    if($lista_spadkobiercow){
                        $j = 0;
                        while($poj_lista_spadkobiercow = $lista_spadkobiercow->fetch_object()){

                            $umowa_osoba_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$poj_lista_spadkobiercow->OsobaId);
                            $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

                            $Imie = $umowa_osoba_tmp->Imie;
                            $Nazwisko = $umowa_osoba_tmp->Nazwisko;


                            $element_id = explode('-',$element_id);

                            $element_id = $element_id[0].'-'.$poj_lista_spadkobiercow->OsobaId.'-'.$element_id[2];

                            ?>
                            <div class="panel panel-default margin_t_10 margin_b_0">
                                <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek"><?php echo $Imie.' '.$Nazwisko; ?><i class="fa dsu_dodaj_nowego_klienta fa-pencil float_r" aria-hidden="true"></i></div>
                                <div class="panel-body ukryj_widok daneSpadkobiercow daneDodatkowegoKlienta_<?php echo $j; ?>">

                                    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
                                    <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>

                                    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneDodatkowegoKlienta_<?php echo $j; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="3" data-akcja="aktualizuj_dodatkowego_klienta" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <label class="margin_t_10 width_100">CZY ZMARŁY BYŁ POSIADACZEM RACHUNKU BANKOWEGO?
            <p class="font_size_10">Wypełnić wyłącznie, gdy przedmiotem umowy ma być dochodzenie roszczeń z rachunku bankowego zmarłego posiadacza.</p>
        </label>

        <div class="zaznaczPoleGrupa formularzeRachunki">
            <div class="zpg_opcja_radio ">
                <i data-wartosc_domyslna="<?php echo $CzyBylPosiadaczemRachunkuBankowego; ?>" value="1" data-kolumna="CzyBylPosiadaczemRachunkuBankowego" class="fa fa<?php echo ($CzyBylPosiadaczemRachunkuBankowego == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                <p>TAK, jeśli tak, to w jakim banku był prowadzony rachunek oraz pod jakim numerem:</p>
                <div class="zpg_opcja zpg_opcja_input">
                    <input class="padding_r_10 width_45 update" type="text" data-wartosc_domyslna="<?php echo $Nazwa; ?>" value="<?php echo ($Nazwa == ' ') ? '' : $Nazwa; ?>" data-kolumna="Nazwa" placeholder="Nazwa banku"/>
                    <input class="width_45 update" type="text" data-wartosc_domyslna="<?php echo $Numer; ?>" value="<?php echo ($Numer == ' ') ? '' : $Numer; ?>" data-kolumna="Numer" placeholder="Numer rachunku bankowego"/>
                </div>
            </div>
            <div class="zpg_opcja_radio margin_t_10">
                <i data-wartosc_domyslna="<?php echo $CzyBylPosiadaczemRachunkuBankowego; ?>" value="2" data-kolumna="CzyBylPosiadaczemRachunkuBankowego" class="fa fa<?php echo ($CzyBylPosiadaczemRachunkuBankowego == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                <p>NIE</p>
            </div>
            <div class="zpg_opcja_radio margin_t_10">
                <i data-wartosc_domyslna="<?php echo $CzyBylPosiadaczemRachunkuBankowego; ?>" value="3" data-kolumna="CzyBylPosiadaczemRachunkuBankowego" class="fa fa<?php echo ($CzyBylPosiadaczemRachunkuBankowego == 3) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                <p>BRAK INFORMACJI</p>
            </div>
            <div class="clear_b"></div>
        </div>

            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="formularzeRachunki" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOfe" data-ogolne="0" data-strona="3" data-akcja="<?php echo (empty($CzyBylPosiadaczemRachunkuBankowego) && empty($CzyZmarlyWskazalOsoby)) ? 'dodaj_pozostałe_informacje_o_ofe' : 'aktualizuj_pozostałe_informacje_o_ofe'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

    </div>

<?php

?>