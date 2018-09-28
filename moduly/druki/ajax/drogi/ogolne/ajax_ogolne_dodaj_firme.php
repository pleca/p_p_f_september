<?php

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
    $akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
    $strona = (isset($_POST['strona'])) ? htmlspecialchars($_POST['strona']) : '';
    $ogolne = (isset($_POST['ogolne'])) ? htmlspecialchars($_POST['ogolne']) : '';

    $Nazwa = '';
    $Imie = '';
    $Nazwisko = '';
    $Pesel = '';
    $Dowod = '';
    $DataUrodzenia = '';
    $Ulica = '';
    $NrDomu = '';
    $NrMieszkania = '';
    $KodPocztowy = '';
    $Mail = '';
    $Telefon = '';
    $WartoscMiasto = '';
    $UmowaTypKlientaId = '1';


    $id_klienta = '';
    $id_urzedu_skarbowego_tmp = '0';

    $umowaSlownikTypKlienta = $bazaDanych->pobierzDane('*', 'umowaSlownikTypKlienta', 'czy_usuniety=0');

    $umowaSlownikTypKlientaDane = $bazaDanych->pobierzDane('*', 'umowaSlownikTypKlienta', 'Id=' . $UmowaTypKlientaId);
    $umowaSlownikTypKlientaDane = $umowaSlownikTypKlientaDane->fetch_object();

if($akcja == 'edytuj' ){


    $element_id = explode('-',$element_id);



    $umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id[2]);


    if ($umowa_dane_tmp) {
        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();
        $UmowaTypKlientaId = $umowa_dane_tmp->UmowaTypKlientaId;
    }

        $umowaSlownikTypKlientaDane = $bazaDanych->pobierzDane('*', 'umowaSlownikTypKlienta', 'Id=' . $UmowaTypKlientaId);
        $umowaSlownikTypKlientaDane = $umowaSlownikTypKlientaDane->fetch_object();

        $umowaOsoba = $bazaDanych->pobierzDane('*', 'umowaRzeczowaOsoba', 'RzeczowaId=' . $element_id[2] . ' AND OsobaTypId=1 AND NrOsoby=1');
        $umowaOsoba = $umowaOsoba->fetch_object();

        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $element_id[1]);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

        $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_osoba_tmp->KontaktId);
        $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();

        $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_osoba_tmp->AdresId);
        $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

        $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_osoba_adres_tmp->MiastoId);
        $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

        $Nazwa = $umowa_osoba_tmp->Nazwa;
        $Imie = $umowa_osoba_tmp->Imie;
        $Nazwisko = $umowa_osoba_tmp->Nazwisko;
        $Pesel = $umowa_osoba_tmp->Pesel;
        $Nip = $umowa_osoba_tmp->Nip;
        $Krs = $umowa_osoba_tmp->Krs;
        $Dowod = $umowa_osoba_tmp->Dowod;
        $DataUrodzenia = $umowa_osoba_tmp->DataUrodzenia;
        $Ulica = $umowa_osoba_adres_tmp->Ulica;
        $NrDomu = $umowa_osoba_adres_tmp->NrDomu;
        $NrMieszkania = $umowa_osoba_adres_tmp->NrMieszkania;
        $KodPocztowy = $umowa_osoba_adres_tmp->KodPocztowy;
        $WartoscMiasto = $umowa_osoba_adres_miasto_tmp->Wartosc;
        $Mail = $umowa_osoba_kontakt_tmp->Mail;
        $Telefon = $umowa_osoba_kontakt_tmp->Telefon;



                    $id_urzedu_skarbowego_tmp = $umowaOsoba->UrzadSkarbowyId;

                    if($id_urzedu_skarbowego_tmp != '0') {

                        $urzad_skarbowy_tmp = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $id_urzedu_skarbowego_tmp);
                        $urzad_skarbowy_tmp = $urzad_skarbowy_tmp->fetch_object();

                        $NazwaUS = $urzad_skarbowy_tmp->Nazwa;

                        $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy_tmp->AdresId);
                        $adres_us_tmp = $adres_us_tmp->fetch_object();

                        $UlicaUS = $adres_us_tmp->Ulica;
                        $NrDomuUS = $adres_us_tmp->NrDomu;
                        $NrMieszkaniaUS = $adres_us_tmp->NrMieszkania;
                        $KodPocztowyUS = $adres_us_tmp->KodPocztowy;

                        $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_tmp->MiastoId);
                        $miasto_us_tmp = $miasto_us_tmp->fetch_object();

                        $WartoscMiastoUS = $miasto_us_tmp->Wartosc;
                        $WielkoscUdzialu = $umowaOsoba->WielkoscUdzialu;

                    }

        $id_klienta = $element_id[1];
        $element_id = $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2];

}


?>


    <?php if ($akcja == 'nowy'){ ?>
    <div class="panel panel-default margin_b_0">
            <div class="panel-heading ">DANE KLIENTA</div>
            <div class="panel-body">
                <?php } ?>
                <div class="daneKlientaRzeczowe">

                    <label class=" width_100">RODZAJ KLIENTA</label>
                    <div class="sposobPlatnosci margin_b_10">
                        <div class="dropdown width_100">
                            <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div data-kolumna="UmowaTypKlientaId" data-wartosc_domyslna="<?php echo $UmowaTypKlientaId; ?>" value="<?php echo $UmowaTypKlientaId ; ?>" class="dpUstawOpcjeNazwa attrValue update float_l" id=" "><?php echo $umowaSlownikTypKlientaDane->Wartosc; ; ?></div>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <?php
                                    while ($poj_umowaSlownikTypKlienta = $umowaSlownikTypKlienta->fetch_object()) {

                                            if ($poj_umowaSlownikTypKlienta->Id != '4') {
                                                echo '<li class="dpUstawOpcje typKlientaOpcja" data-element_id="' . $poj_umowaSlownikTypKlienta->Id . '">' . mb_ucfirst($poj_umowaSlownikTypKlienta->Wartosc) . '</li>';
                                            }
                                    }


                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="polaUzaleznioneOdybierzTypKlienta">

                        <div class="col-md-12 inputPole padding_b_10 NazwaFirmy" style="display:<?php echo ($UmowaTypKlientaId != '1') ? 'block' : 'none' ; ?>"><input data-wartosc_domyslna="<?php echo $Nazwa; ?>" value="<?php echo $Nazwa; ?>" data-kolumna="Nazwa" type="text" class="update duzeMaleLiteryCyfry wartoscUzalezniona" placeholder="Pełna nazwa"></div>
                        <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
                        <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
                        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>
                        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="NrOsoby" type="text" class="update" placeholder=""></div>

                        <label class="margin_t_10 width_100">ADRES ZAMELDOWANIA</label>
                        <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Ulica; ?>" value="<?php echo $Ulica; ?>" data-kolumna="Ulica" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                        <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomu; ?>" value="<?php echo $NrDomu; ?>" data-kolumna="NrDomu" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                        <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>" value="<?php echo $NrMieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                        <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="update wymagane sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                        <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiasto; ?>" value="<?php echo $WartoscMiasto; ?>" data-kolumna="Wartosc" type="text" class="update wymagane sduzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

                        <label class="margin_t_10 width_100">DANE IDENTYFIKACYJNE</label>
                        <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Pesel; ?>" value="<?php echo $Pesel; ?>" data-kolumna="Pesel" type="text" maxlength="11" class="update sprawdzPesel poleLiczbowe"  placeholder="Pesel"></div>
                        <div class="col-md-4 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $Dowod; ?>" value="<?php echo $Dowod; ?>" data-kolumna="Dowod" type="text" class="update duzeMaleLiteryCyfry" maxlength="9" placeholder="Seria i numer dowodu"></div>
                        <div class="col-md-4 inputPole "><input data-wartosc_domyslna="<?php echo $DataUrodzenia; ?>" value="<?php echo $DataUrodzenia; ?>" data-kolumna="DataUrodzenia" type="date" class="update datePicker" placeholder="Data urodzenia"></div>
                        <div class="col-md-6 inputPole padding_t_10 padding_r_10"><input data-wartosc_domyslna="<?php echo $Nip; ?>" value="<?php echo $Nip; ?>" data-kolumna="Nip" type="text" maxlength="14" class="update poleLiczbowe"  placeholder="NIP"></div>
                        <div class="col-md-6 inputPole padding_t_10"><input data-wartosc_domyslna="<?php echo $Krs; ?>" value="<?php echo $Krs; ?>" data-kolumna="Krs" type="text" class="update duzeMaleLiteryCyfry" maxlength="9" placeholder="KRS/EDG"></div>

                        <label class="margin_t_10 width_100">DANE DO KONTAKTU</label>
                        <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Telefon; ?>" value="<?php echo $Telefon; ?>" data-kolumna="Telefon" type="text" class="update poleLiczbowe" placeholder="Telefon"></div>
                        <div class="col-md-8 inputPole "><input data-wartosc_domyslna="<?php echo $Mail; ?>" value="<?php echo $Mail; ?>" data-kolumna="Mail" type="text" class="update sprawdzEmail duzeMaleLiteryCyfry" placeholder="Adres e-mail"></div>
                    </div>
                </div>
                <button data-reakcja="zapisz_zmiany" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneKlientaRzeczowe" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="1" data-strona="zakladki" data-akcja="<?php echo ($akcja == 'nowy') ? 'dodaj_firme' : 'aktualizuj_firme'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz klienta</button>

                <div class="daneUrzeduSkarbowegoKlienta" style="display:<?php echo ($UmowaTypKlientaId == '1') ? 'block' : 'none'; ?>">
                    <label class="margin_t_10 width_100">URZĄD SKARBOWY KLIENTA</label>
                    <div class="col-md-12 inputPole"><input data-wartosc_domyslna="<?php echo $NazwaUS; ?>" value="<?php echo $NazwaUS; ?>" data-kolumna="Nazwa" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Pełna nazwa Urzędu Skarbowego"></div>
                    <div class="col-md-6 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $UlicaUS; ?>" value="<?php echo $UlicaUS; ?>" data-kolumna="Ulica" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                    <div class="col-md-3 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $NrDomuUS; ?>" value="<?php echo $NrDomuUS; ?>" data-kolumna="NrDomu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                    <div class="col-md-3 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $NrMieszkaniaUS; ?>" value="<?php echo $NrMieszkaniaUS; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                    <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowyUS; ?>" value="<?php echo $KodPocztowyUS; ?>" data-kolumna="KodPocztowy" type="text" class="update sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                    <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiastoUS; ?>" value="<?php echo $WartoscMiastoUS; ?>" data-kolumna="Wartosc" type="text" class="update" placeholder="Miejscowość"></div>
                    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="NrOsoby" type="text" class="update" placeholder=""></div>
                    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>


                    <label class="margin_t_10 width_100">WIELKOŚC UDZIAŁU KLIENTA W WIERZYTELNOŚCI</label>
                    <div class="col-md-12 inputPole"><input data-wartosc_domyslna="<?php echo $WielkoscUdzialu; ?>" value="<?php echo $WielkoscUdzialu; ?>" data-kolumna="WielkoscUdzialu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Wartość wpisać procentowo lub ułamkiem"></div>

                    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneUrzeduSkarbowegoKlienta" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaUrzadSkarbowy" data-strona="<?php echo ($akcja == 'nowy') ? 'zakladki' : 'dodaj_firme'; ?>" data-ogolne="1" data-akcja="<?php echo ($id_urzedu_skarbowego_tmp == '0') ? 'dodaj_urzad_skarbowy' : 'aktualizuj_urzad_skarbowy'; ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz Urząd Skarbowy</button>
                </div>

                <?php if ($akcja == 'nowy'){ ?>
            </div>
    </div>
<?php } ?>
