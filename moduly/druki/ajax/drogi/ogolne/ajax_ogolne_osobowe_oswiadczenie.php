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

        $postepowanie_tmp = $bazaDanych->pobierzDane('*', 'umowaZgodaNaPostepowanie', 'Id=' . $umowa_dane_tmp->ZgodaNaPostepowanieId);

        if ($postepowanie_tmp) {
            $postepowanie_tmp = $postepowanie_tmp->fetch_object();

            $CzyToczonoPostepowanie = $postepowanie_tmp->CzyToczonoPostepowanie;
            $CzyZawartoUgode = $postepowanie_tmp->CzyZawartoUgode;
            $Sad = $postepowanie_tmp->Sad;
            $SygnaturaAkt = $postepowanie_tmp->SygnaturaAkt;
            $Zobowiazany = $postepowanie_tmp->Zobowiazany;
        }


    }

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
?>
        <div class="daneStronyUmowyPopUp">

            <label class="margin_t_10 width_100 gray_background">OŚWIADCZENIE - ZGODA NA POSTĘPOWANIE SĄDOWE</label>

            <label class="margin_t_10 width_100">Zobowiązany do wypłaty odszkodowania (ubezpieczyciel) wobec którego zostanie lub zostało wytoczone postępowanie sądowe:</label>
            <div class="col-md-6 inputPole ">
                <input class="update" type="text" data-wartosc_domyslna="<?php echo $Zobowiazany; ?>" value="<?php echo $Zobowiazany; ?>" data-kolumna="Zobowiazany"/>
            </div>

            <label class="margin_t_10 width_100">W sprawie:</label>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyToczonoPostepowanie; ?>" value="1" data-kolumna="CzyToczonoPostepowanie" class="fa fa<?php echo ($CzyToczonoPostepowanie == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i>
                    <p> toczyło się postępowanei sądowe w zakresie zadośćuczynienia/odszkodowania w Sądzie: </p>
                    <div class="zpg_opcja zpg_opcja_input float_l"><input type="text" data-wartosc_domyslna="<?php echo $Sad; ?>" value="<?php echo ($CzyToczonoPostepowanie == 1) ? $Sad : ''; ?>" data-kolumna="Sad" class="update margin_l_5"/></div>
                    <p class="float_l"> sygnatura akt: </p>
                    <div class="zpg_opcja zpg_opcja_input"><input type="text" data-wartosc_domyslna="<?php echo $SygnaturaAkt; ?>" value="<?php echo ($CzyToczonoPostepowanie == 1) ? $SygnaturaAkt : ''; ?>" data-kolumna="SygnaturaAkt" class="update margin_l_5"/></div>
                </div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyToczonoPostepowanie; ?>" value="2" data-kolumna="CzyToczonoPostepowanie" class="fa fa<?php echo ($CzyToczonoPostepowanie == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> nie toczyło się postępowanie</p></div>
                <div class="clear_b"></div>
            </div>
            <div class="zaznaczPoleGrupa ">
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyZawartoUgode; ?>" value="1" data-kolumna="CzyZawartoUgode" class="fa fa<?php echo ($CzyZawartoUgode == 1) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> zawarto ugodę</p></div>
                <div class="zpg_opcja_radio margin_t_10"><i data-wartosc_domyslna="<?php echo $CzyZawartoUgode; ?>" value="2" data-kolumna="CzyZawartoUgode" class="fa fa<?php echo ($CzyZawartoUgode == 2) ? '-check' : '' ; ?>-square-o fa-2 float_l attrValue" aria-hidden="true"></i><p> nie zawarto ugody</p></div>
                <div class="clear_b"></div>
            </div>
        </div>


        <?php if ($TypSzkodyId == 2) { ?>

        <div class="daneSwiadkaDoSprawy">

            <?php
            $disabled = 'disabled';
            $update = '';
            $lista_swiadkow = 0;

            $lista_swiadkow = $bazaDanych->pobierzDane('*','umowaListaSwiadkow','IdUmowyOsobowej = '.$umowa_dane_tmp->Id);
            ?>

                        <label class="margin_t_10 width_100">Lista osób, które mogłyby być wezwane w charakterze świadków w sądzie,
                            celem potwierdzenia okoliczności doznanej przeze mnie szkody, naruszonych więzi rodzinnych, oraz wykazania zmiany sytuacji życiowej stosunku do tej,
                            jaka występowała przed zdarzeniem (może to być osoba z kręgu rodziny, znajomych, sąsiad/ka lub inna osoba, proszę podać imię i nazwisko oraz adres
                            zamieszkania świadka)</label>
                        <div class="panel panel-default margin_b_10 margin_t_10">
                            <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek">LISTA ŚWIADKÓW<i class="fa dsu_dodaj_nowego_klienta fa-plus float_r" aria-hidden="true"></i></div>
                            <div class="panel-body ukryj_widok daneSwiadka1">

                                <label class="margin_t_10 width_100">Imię i nazwisko</label>
                                <div class="col-md-6 inputPole padding_r_10">
                                    <input data-wartosc_domyslna="" value="" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię">
                                </div>
                                <div class="col-md-6 inputPole ">
                                    <input data-wartosc_domyslna="" value="" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko">
                                </div>
                                <div class="col-md-0 inputPole padding_r_10">
                                    <input type="hidden" value="13" data-kolumna="OsobaTypId" type="text" class="update" placeholder="">
                                </div>


                                <label class="margin_t_10 width_100">Adres zameldowania</label>
                                <div class="col-md-6 inputPole padding_r_10">
                                    <input data-wartosc_domyslna="" value="" data-kolumna="Ulica" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ulica">
                                </div>
                                <div class="col-md-3 inputPole padding_r_10">
                                    <input data-wartosc_domyslna="" value="" data-kolumna="NrDomu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr domu">
                                </div>
                                <div class="col-md-3 inputPole ">
                                    <input data-wartosc_domyslna="" value="" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania">
                                </div>
                                <div class="col-md-4 inputPole padding_r_10 margin_t_10">
                                    <input data-wartosc_domyslna="" value="" data-kolumna="KodPocztowy" type="text" class="update sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy">
                                </div>
                                <div class="col-md-8 inputPole margin_t_10">
                                    <input data-wartosc_domyslna="" value="" data-kolumna="Wartosc" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejscowość">
                                </div>

                                <!--<div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="MiejsceHospitalizacji" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejsce hospitalizacji"></div>
                                <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="DataOdKiedy" type="text" class="update datePicker" placeholder="od kiedy"></div>
                                <div class="col-md-3 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="DataDoKiedy" type="text" class="update datePicker" placeholder="do kiedy"></div>
-->
                                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneSwiadka1" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="6" data-akcja="dodaj_osobe" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Dodaj świadka</button>

                                <?php
                                if($lista_swiadkow){
                                    $i = 0;
                                    while($poj_lista_swiadkow = $lista_swiadkow->fetch_object()){

                                       // $lista_swiadkow = $lista_swiadkow->fetch_object();

                                        $lista_osob = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$poj_lista_swiadkow->IdOsoby);
                                        $lista_osob = $lista_osob->fetch_object();


                                        $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $lista_osob->KontaktId);
                                        $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();

                                        $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $lista_osob->AdresId);
                                        $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

                                        $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_osoba_adres_tmp->MiastoId);
                                        $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                                        $Id = $lista_osob->Id;
                                        $Imie = $lista_osob->Imie;
                                        $Nazwisko = $lista_osob->Nazwisko;
                                        $Ulica = $umowa_osoba_adres_tmp->Ulica;
                                        $NrDomu = $umowa_osoba_adres_tmp->NrDomu;
                                        $NrMieszkania = $umowa_osoba_adres_tmp->NrMieszkania;
                                        $KodPocztowy = $umowa_osoba_adres_tmp->KodPocztowy;
                                        $WartoscMiasto = $umowa_osoba_adres_miasto_tmp->Wartosc;

                                        ?>
                                        <div class="panel panel-default margin_t_10 margin_b_0">
                                            <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek"><?php echo $Imie.' '.$Nazwisko; ?><i class="fa dsu_dodaj_nowego_klienta fa-pencil float_r" aria-hidden="true"></i></div>
                                            <div class="panel-body ukryj_widok daneSwiadka_<?php echo $i; ?>">

                                                <label class="margin_t_10 width_100">Imię i nazwisko</label>
                                                <div class="col-md-6 inputPole padding_r_10">
                                                    <input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię">
                                                </div>
                                                <div class="col-md-6 inputPole ">
                                                    <input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko">
                                                </div>
                                                <div class="col-md-0 inputPole padding_r_10">
                                                    <input type="hidden" value="13" data-kolumna="OsobaTypId" type="text" class="update" placeholder="">
                                                </div>


                                                <label class="margin_t_10 width_100">Adres zameldowania</label>
                                                <div class="col-md-6 inputPole padding_r_10">
                                                    <input data-wartosc_domyslna="<?php echo $Ulica; ?>" value="<?php echo $Ulica; ?>" data-kolumna="Ulica" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ulica">
                                                </div>
                                                <div class="col-md-3 inputPole padding_r_10">
                                                    <input data-wartosc_domyslna="<?php echo $NrDomu; ?>" value="<?php echo $NrDomu; ?>" data-kolumna="NrDomu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr domu">
                                                </div>
                                                <div class="col-md-3 inputPole ">
                                                    <input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>" value="<?php echo $NrMieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania">
                                                </div>
                                                <div class="col-md-4 inputPole padding_r_10 margin_t_10">
                                                    <input data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="update sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy">
                                                </div>
                                                <div class="col-md-8 inputPole margin_t_10">
                                                    <input data-wartosc_domyslna="<?php echo $WartoscMiasto; ?>" value="<?php echo $WartoscMiasto; ?>" data-kolumna="Wartosc" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejscowość">
                                                </div>
                                                <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="<?php echo $Id; ?>" data-kolumna="Id" type="text" class="update" placeholder=""></div>

                                                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneSwiadka_<?php echo $i; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="6" data-akcja="aktualizuj_swiadka" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

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
        <?php } ?>


            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaZgodaNaPostepowanie" data-ogolne="1" data-strona="osobowe_oswiadczenie" data-akcja="<?php echo (!$postepowanie_tmp) ? 'dodaj_zgoda_na_postepowanie' : 'aktualizuj_zgoda_na_postepowanie'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>