<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';



$element_id = explode('-',$element_id);

$id_umowy = $element_id[0];
$id_osoby = $element_id[1];
$id_umowy_rzeczowej = $element_id[2];


$umowa_dane_tmp = $bazaDanych->pobierzDane('*', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id[2]);


if ($umowa_dane_tmp) {
    $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();
    $TypKlienta = $umowa_dane_tmp->UmowaTypKlientaId;
    $UmowaId = $umowa_dane_tmp->UmowaId;
}

//DANE PEŁNOMOCNIKA
$umowa_osoba_pelnomocnik_id_tmp_check = $bazaDanych->pobierzDane('*', 'umowaRzeczowaOsoba', 'RzeczowaId='.$element_id[2].' AND NrOsoby=1 AND OsobaTypId=5');

    if ($umowa_osoba_pelnomocnik_id_tmp_check) {

        $umowa_osoba_pelnomocnik_id_tmp = $umowa_osoba_pelnomocnik_id_tmp_check->fetch_object();

        $umowa_osoba_pelnomocnik_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowa_osoba_pelnomocnik_id_tmp->OsobaId);
        $umowa_osoba_pelnomocnik_tmp = $umowa_osoba_pelnomocnik_tmp->fetch_object();

        $umowa_osoba_pelnomocnik_kontakt_tmp = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowa_osoba_pelnomocnik_tmp->KontaktId);
        $umowa_osoba_pelnomocnik_kontakt_tmp = $umowa_osoba_pelnomocnik_kontakt_tmp->fetch_object();

        $umowa_osoba_pelnomocnik_adres_tmp = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_osoba_pelnomocnik_tmp->AdresId);
        $umowa_osoba_pelnomocnik_adres_tmp = $umowa_osoba_pelnomocnik_adres_tmp->fetch_object();

        $umowa_osoba_pelnomocnik_adres_miasto_tmp = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_osoba_pelnomocnik_adres_tmp->MiastoId);
        $umowa_osoba_pelnomocnik_adres_miasto_tmp = $umowa_osoba_pelnomocnik_adres_miasto_tmp->fetch_object();

        $NazwaPelnomocnika = $umowa_osoba_pelnomocnik_tmp->Nazwa;
        $ImiePelnomocnika = $umowa_osoba_pelnomocnik_tmp->Imie;
        $NazwiskoPelnomocnika = $umowa_osoba_pelnomocnik_tmp->Nazwisko;
        $PeselPelnomocnika = $umowa_osoba_pelnomocnik_tmp->Pesel;
        $DowodPelnomocnika = $umowa_osoba_pelnomocnik_tmp->Dowod;
        $NipPelnomocnika = $umowa_osoba_pelnomocnik_tmp->Nip;
        $KrsPelnomocnika = $umowa_osoba_pelnomocnik_tmp->Krs;
        $DataUrodzeniaPelnomocnika = $umowa_osoba_pelnomocnik_tmp->DataUrodzenia;
        $UlicaPelnomocnika = $umowa_osoba_pelnomocnik_adres_tmp->Ulica;
        $NrDomuPelnomocnika = $umowa_osoba_pelnomocnik_adres_tmp->NrDomu;
        $NrMieszkaniaPelnomocnika = $umowa_osoba_pelnomocnik_adres_tmp->NrMieszkania;
        $KodPocztowyPelnomocnika = $umowa_osoba_pelnomocnik_adres_tmp->KodPocztowy;
        $WartoscMiastoPelnomocnika = $umowa_osoba_pelnomocnik_adres_miasto_tmp->Wartosc;
        $MailPelnomocnika = $umowa_osoba_pelnomocnik_kontakt_tmp->Mail;
        $TelefonPelnomocnika = $umowa_osoba_pelnomocnik_kontakt_tmp->Telefon;



        $urzad_skarbowy_pelnomocnika = $bazaDanych->pobierzDane('*','umowaRzeczowaOsoba','OsobaId = '.$umowa_osoba_pelnomocnik_tmp->Id.' AND OsobaTypId=5 AND NrOsoby=1');
        $urzad_skarbowy_pelnomocnika = $urzad_skarbowy_pelnomocnika->fetch_object();
        $id_urzedu_skarbowego_pelnomocnika_tmp = $urzad_skarbowy_pelnomocnika->UrzadSkarbowyId;

        if($id_urzedu_skarbowego_pelnomocnika_tmp != '0') {

            $urzad_skarbowy_pelnomocnika_tmp = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $id_urzedu_skarbowego_pelnomocnika_tmp);
            $urzad_skarbowy_pelnomocnika_tmp = $urzad_skarbowy_pelnomocnika_tmp->fetch_object();

            $NazwaUSPelnomocnika = $urzad_skarbowy_pelnomocnika_tmp->Nazwa;

            $adres_us_pelnomocnika_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy_pelnomocnika_tmp->AdresId);
            $adres_us_pelnomocnika_tmp = $adres_us_pelnomocnika_tmp->fetch_object();

            $UlicaUSPelnomocnika = $adres_us_pelnomocnika_tmp->Ulica;
            $NrDomuUSPelnomocnika = $adres_us_pelnomocnika_tmp->NrDomu;
            $NrMieszkaniaUSPelnomocnika = $adres_us_pelnomocnika_tmp->NrMieszkania;
            $KodPocztowyUSPelnomocnika = $adres_us_pelnomocnika_tmp->KodPocztowy;

            $miasto_us_pelnomocnika_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_pelnomocnika_tmp->MiastoId);
            $miasto_us_pelnomocnika_tmp = $miasto_us_pelnomocnika_tmp->fetch_object();

            $WartoscMiastoUSPelnomocnika = $miasto_us_pelnomocnika_tmp->Wartosc;
            $WielkoscUdzialuPelnomocnika = $urzad_skarbowy_pelnomocnika->WielkoscUdzialu;

        } else {
            $NazwaUSPelnomocnika = '';
            $UlicaUSPelnomocnika = '';
            $NrDomuUSPelnomocnika = '';
            $NrMieszkaniaUSPelnomocnika = '';
            $KodPocztowyUSPelnomocnika = '';
            $WartoscMiastoUSPelnomocnika = '';
            $WielkoscUdzialuPelnomocnika = '';
        }


    } else {
        $NazwaPelnomocnika = '';
        $ImiePelnomocnika = '';
        $NazwiskoPelnomocnika = '';
        $PeselPelnomocnika = '';
        $DowodPelnomocnika = '';
        $NipPelnomocnika = '';
        $KrsPelnomocnika = '';
        $DataUrodzeniaPelnomocnika = '';
        $UlicaPelnomocnika = '';
        $NrDomuPelnomocnika = '';
        $NrMieszkaniaPelnomocnika = '';
        $KodPocztowyPelnomocnika = '';
        $WartoscMiastoPelnomocnika = '';
        $MailPelnomocnika = '';
        $TelefonPelnomocnika = '';
    }

    //DANE REPREZENTANTA
    $umowa_osoba_reprezentant_id_tmp_check = $bazaDanych->pobierzDane('*', 'umowaRzeczowaOsoba', 'RzeczowaId='.$element_id[2].' AND NrOsoby=1 AND OsobaTypId=6');

    if ($umowa_osoba_reprezentant_id_tmp_check) {

        $umowa_osoba_reprezentant_id_tmp = $umowa_osoba_reprezentant_id_tmp_check->fetch_object();

        $umowa_osoba_reprezentant_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $umowa_osoba_reprezentant_id_tmp->OsobaId);
        $umowa_osoba_reprezentant_tmp = $umowa_osoba_reprezentant_tmp->fetch_object();

        $umowa_osoba_reprezentant_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_osoba_reprezentant_tmp->KontaktId);
        $umowa_osoba_reprezentant_kontakt_tmp = $umowa_osoba_reprezentant_kontakt_tmp->fetch_object();

        $umowa_osoba_reprezentant_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_osoba_reprezentant_tmp->AdresId);
        $umowa_osoba_reprezentant_adres_tmp = $umowa_osoba_reprezentant_adres_tmp->fetch_object();

        $umowa_osoba_reprezentant_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_osoba_reprezentant_adres_tmp->MiastoId);
        $umowa_osoba_reprezentant_adres_miasto_tmp = $umowa_osoba_reprezentant_adres_miasto_tmp->fetch_object();

        $NazwaReprezentanta = $umowa_osoba_reprezentant_tmp->Nazwa;
        $ImieReprezentanta = $umowa_osoba_reprezentant_tmp->Imie;
        $NazwiskoReprezentanta = $umowa_osoba_reprezentant_tmp->Nazwisko;
        $PeselReprezentanta = $umowa_osoba_reprezentant_tmp->Pesel;
        $DowodReprezentanta = $umowa_osoba_reprezentant_tmp->Dowod;
        $NipReprezentanta = $umowa_osoba_reprezentant_tmp->Nip;
        $KrsReprezentanta = $umowa_osoba_reprezentant_tmp->Krs;
        $DataUrodzeniaReprezentanta = $umowa_osoba_reprezentant_tmp->DataUrodzenia;
        $UlicaReprezentanta = $umowa_osoba_reprezentant_adres_tmp->Ulica;
        $NrDomuReprezentanta = $umowa_osoba_reprezentant_adres_tmp->NrDomu;
        $NrMieszkaniaReprezentanta = $umowa_osoba_reprezentant_adres_tmp->NrMieszkania;
        $KodPocztowyReprezentanta = $umowa_osoba_reprezentant_adres_tmp->KodPocztowy;
        $WartoscMiastoReprezentanta = $umowa_osoba_reprezentant_adres_miasto_tmp->Wartosc;
        $MailReprezentanta = $umowa_osoba_reprezentant_kontakt_tmp->Mail;
        $TelefonReprezentanta = $umowa_osoba_reprezentant_kontakt_tmp->Telefon;


        $urzad_skarbowy_reprezentanta = $bazaDanych->pobierzDane('*', 'umowaRzeczowaOsoba', 'OsobaId = ' . $umowa_osoba_reprezentant_tmp->Id . ' AND OsobaTypId=6 AND NrOsoby=1');
        $urzad_skarbowy_reprezentanta = $urzad_skarbowy_reprezentanta->fetch_object();
        $id_urzedu_skarbowego_reprezentanta_tmp = $urzad_skarbowy_reprezentanta->UrzadSkarbowyId;

        if ($id_urzedu_skarbowego_reprezentanta_tmp != '0') {

            $urzad_skarbowy_reprezentanta_tmp = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $id_urzedu_skarbowego_reprezentanta_tmp);
            $urzad_skarbowy_reprezentanta_tmp = $urzad_skarbowy_reprezentanta_tmp->fetch_object();

            $NazwaUSReprezentanta = $urzad_skarbowy_reprezentanta_tmp->Nazwa;

            $adres_us_reprezentanta_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy_reprezentanta_tmp->AdresId);
            $adres_us_reprezentanta_tmp = $adres_us_reprezentanta_tmp->fetch_object();

            $UlicaUSReprezentanta = $adres_us_reprezentanta_tmp->Ulica;
            $NrDomuUSReprezentanta = $adres_us_reprezentanta_tmp->NrDomu;
            $NrMieszkaniaUSReprezentanta = $adres_us_reprezentanta_tmp->NrMieszkania;
            $KodPocztowyUSReprezentanta = $adres_us_reprezentanta_tmp->KodPocztowy;

            $miasto_us_reprezentanta_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_reprezentanta_tmp->MiastoId);
            $miasto_us_reprezentanta_tmp = $miasto_us_reprezentanta_tmp->fetch_object();

            $WartoscMiastoUSReprezentanta = $miasto_us_reprezentanta_tmp->Wartosc;
            $WielkoscUdzialuReprezentanta = $urzad_skarbowy_reprezentanta->WielkoscUdzialu;

        } else {
            $NazwaUSReprezentanta = '';
            $UlicaUSReprezentanta = '';
            $NrDomuUSReprezentanta = '';
            $NrMieszkaniaUSReprezentanta = '';
            $KodPocztowyUSReprezentanta = '';
            $WartoscMiastoUSReprezentanta = '';
            $WielkoscUdzialuReprezentanta = '';
        }

    } else {
        $NazwaReprezentanta = '';
        $ImieReprezentanta = '';
        $NazwiskoReprezentanta = '';
        $PeselReprezentanta = '';
        $DowodPelnomocnika = '';
        $NipReprezentanta = '';
        $KrsReprezentanta = '';
        $DataUrodzeniaReprezentanta = '';
        $UlicaReprezentanta = '';
        $NrDomuReprezentanta = '';
        $NrMieszkaniaReprezentanta = '';
        $KodPocztowyReprezentanta = '';
        $WartoscMiastoReprezentanta = '';
        $MailReprezentanta = '';
        $TelefonReprezentanta = '';
    }

$element_id = $UmowaId.'-'.$id_osoby.'-'.$id_umowy_rzeczowej;

//$element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];



?>
    <div class="daneStronyUmowyPopUp">

        <div class="panel panel-default margin_b_0 margin_t_10">
            <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek font_weight_700">PEŁNOMOCNIK WŁAŚCICIELA<?php echo (!$umowa_osoba_pelnomocnik_id_tmp_check) ? '<i class="fa fa-plus float_r" aria-hidden="true"></i>' : '<i class="fa fa-pencil float_r" aria-hidden="true"></i>'?></div>
            <div class="panel-body ukryj_widok danePelnomocnikaWlasciciela">

                <div class="col-md-12 inputPole padding_b_10"><input data-wartosc_domyslna="<?php echo $NazwaPelnomocnika; ?>" value="<?php echo $NazwaPelnomocnika; ?>" data-kolumna="Nazwa" type="text" class="update duzeMaleLiteryCyfry" placeholder="Pełna nazwa"></div>
                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $ImiePelnomocnika; ?>" value="<?php echo $ImiePelnomocnika; ?>" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
                <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $NazwiskoPelnomocnika; ?>" value="<?php echo $NazwiskoPelnomocnika; ?>" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
                <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="NrOsoby" type="text" class="update" placeholder=""></div>
                <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="5" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>

                <label class="margin_t_10 width_100">ADRES ZAMELDOWANIA</label>
                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $UlicaPelnomocnika; ?>" value="<?php echo $UlicaPelnomocnika; ?>" data-kolumna="Ulica" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomuPelnomocnika; ?>" value="<?php echo $NrDomuPelnomocnika; ?>" data-kolumna="NrDomu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkaniaPelnomocnika; ?>" value="<?php echo $NrMieszkaniaPelnomocnika; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowyPelnomocnika; ?>" value="<?php echo $KodPocztowyPelnomocnika; ?>" data-kolumna="KodPocztowy" type="text" class="update sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiastoPelnomocnika; ?>" value="<?php echo $WartoscMiastoPelnomocnika; ?>" data-kolumna="Wartosc" type="text" class="update sduzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

                <label class="margin_t_10 width_100">DANE IDENTYFIKACYJNE</label>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $PeselPelnomocnika; ?>" value="<?php echo $PeselPelnomocnika; ?>" data-kolumna="Pesel" type="text" maxlength="11" class="update sprawdzPesel poleLiczbowe"  placeholder="Pesel"></div>
                <div class="col-md-4 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $DowodPelnomocnika; ?>" value="<?php echo $DowodPelnomocnika; ?>" data-kolumna="Dowod" type="text" class="update duzeMaleLiteryCyfry" maxlength="9" placeholder="Seria i numer dowodu"></div>
                <div class="col-md-4 inputPole "><input data-wartosc_domyslna="<?php echo $DataUrodzeniaPelnomocnika; ?>" value="<?php echo $DataUrodzeniaPelnomocnika; ?>" data-kolumna="DataUrodzenia" type="date" class="update datePicker" placeholder="Data urodzenia"></div>
                <div class="col-md-6 inputPole padding_t_10 padding_r_10"><input data-wartosc_domyslna="<?php echo $NipPelnomocnika; ?>" value="<?php echo $NipPelnomocnika; ?>" data-kolumna="Nip" type="text" maxlength="14" class="update poleLiczbowe"  placeholder="NIP"></div>
                <div class="col-md-6 inputPole padding_t_10"><input data-wartosc_domyslna="<?php echo $KrsPelnomocnika; ?>" value="<?php echo $KrsPelnomocnika; ?>" data-kolumna="Krs" type="text" class="update duzeMaleLiteryCyfry" maxlength="9" placeholder="KRS/EDG"></div>

                <label class="margin_t_10 width_100">DANE DO KONTAKTU</label>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $TelefonPelnomocnika; ?>" value="<?php echo $TelefonPelnomocnika; ?>" data-kolumna="Telefon" type="text" class="update poleLiczbowe" placeholder="Telefon"></div>
                <div class="col-md-8 inputPole "><input data-wartosc_domyslna="<?php echo $MailPelnomocnika; ?>" value="<?php echo $MailPelnomocnika; ?>" data-kolumna="Mail" type="text" class="update sprawdzEmail duzeMaleLiteryCyfry" placeholder="Adres e-mail"></div>

                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="danePelnomocnikaWlasciciela" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="1" data-strona="rzeczowe_pelnomocnik" data-akcja="<?php echo (!$umowa_osoba_pelnomocnik_id_tmp_check) ? "dodaj_firme" : "aktualizuj_firme" ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz pełnomocnika</button>

                    <div class="daneUrzeduSkarbowegoPelnomocnikaWlasciciela">

                        <label class="margin_t_10 width_100">URZĄD SKARBOWY PEŁNOMOCNIKA</label>
                        <div class="col-md-12 inputPole"><input data-wartosc_domyslna="<?php echo $NazwaUSPelnomocnika; ?>" value="<?php echo $NazwaUSPelnomocnika; ?>" data-kolumna="Nazwa" type="text" class="update duzeMaleLiteryCyfry" placeholder="Pełna nazwa Urzędu Skarbowego"></div>
                        <div class="col-md-6 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $UlicaUSPelnomocnika; ?>" value="<?php echo $UlicaUSPelnomocnika; ?>" data-kolumna="Ulica" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                        <div class="col-md-3 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $NrDomuUSPelnomocnika; ?>" value="<?php echo $NrDomuUSPelnomocnika; ?>" data-kolumna="NrDomu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                        <div class="col-md-3 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $NrMieszkaniaUSPelnomocnika; ?>" value="<?php echo $NrMieszkaniaUSPelnomocnika; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                        <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowyUSPelnomocnika; ?>" value="<?php echo $KodPocztowyUSPelnomocnika; ?>" data-kolumna="KodPocztowy" type="text" class="update sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                        <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiastoUSPelnomocnika; ?>" value="<?php echo $WartoscMiastoUSPelnomocnika; ?>" data-kolumna="Wartosc" type="text" class="update" placeholder="Miejscowość"></div>
                        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="NrOsoby" type="text" class="update" placeholder=""></div>
                        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="5" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>

                        <label class="margin_t_10 width_100">WIELKOŚC UDZIAŁU PEŁNOMOCNIKA W WIERZYTELNOŚCI</label>
                        <div class="col-md-12 inputPole"><input data-wartosc_domyslna="<?php echo $WielkoscUdzialuPelnomocnika; ?>" value="<?php echo $WielkoscUdzialuPelnomocnika; ?>" data-kolumna="WielkoscUdzialu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Wartość wpisać procentowo lub ułamkiem"></div>
                    </div>
                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneUrzeduSkarbowegoPelnomocnikaWlasciciela" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaUrzadSkarbowy" data-strona="1" data-ogolne="rzeczowe_pelnomocnik" data-akcja="<?php echo ($id_urzedu_skarbowego_pelnomocnika_tmp == '0') ? "dodaj_urzad_skarbowy" : "aktualizuj_urzad_skarbowy" ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz Urząd Skarbowy pełnomocnika</button>
            </div>
        </div>

        <?php if ($TypKlienta != '1') { ?>

        <div class="panel panel-default margin_b_0 margin_t_10">
            <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek font_weight_700">REPREZENTANT WŁAŚCICIELA<?php echo (!$umowa_osoba_reprezentant_id_tmp_check) ? '<i class="fa fa-plus float_r" aria-hidden="true"></i>' : '<i class="fa fa-pencil float_r" aria-hidden="true"></i>'?></div>
            <div class="panel-body ukryj_widok daneReprezentantaWlasciciela">

                <div class="col-md-12 inputPole padding_b_10"><input data-wartosc_domyslna="<?php echo $NazwaReprezentanta; ?>" value="<?php echo $NazwaReprezentanta; ?>" data-kolumna="Nazwa" type="text" class="update duzeMaleLiteryCyfry" placeholder="Pełna nazwa"></div>
                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $ImieReprezentanta; ?>" value="<?php echo $ImieReprezentanta; ?>" data-kolumna="Imie" type="text" class="update duzeMaleLiteryCyfry" placeholder="Imię"></div>
                <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $NazwiskoReprezentanta; ?>" value="<?php echo $NazwiskoReprezentanta; ?>" data-kolumna="Nazwisko" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>
                <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="NrOsoby" type="text" class="update" placeholder=""></div>
                <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="6" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>

                <label class="margin_t_10 width_100">ADRES ZAMELDOWANIA</label>
                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $UlicaReprezentanta; ?>" value="<?php echo $UlicaReprezentanta; ?>" data-kolumna="Ulica" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomuReprezentanta; ?>" value="<?php echo $NrDomuReprezentanta; ?>" data-kolumna="NrDomu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkaniaReprezentanta; ?>" value="<?php echo $NrMieszkaniaReprezentanta; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowyReprezentanta; ?>" value="<?php echo $KodPocztowyReprezentanta; ?>" data-kolumna="KodPocztowy" type="text" class="update sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiastoReprezentanta; ?>" value="<?php echo $WartoscMiastoReprezentanta; ?>" data-kolumna="Wartosc" type="text" class="update duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

                <label class="margin_t_10 width_100">DANE IDENTYFIKACYJNE</label>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $PeselReprezentanta; ?>" value="<?php echo $PeselReprezentanta; ?>" data-kolumna="Pesel" type="text" maxlength="11" class="update sprawdzPesel poleLiczbowe"  placeholder="Pesel"></div>
                <div class="col-md-4 inputPole padding_r_10 "><input data-wartosc_domyslna="<?php echo $DowodReprezentanta; ?>" value="<?php echo $DowodReprezentanta; ?>" data-kolumna="Dowod" type="text" class="update duzeMaleLiteryCyfry" maxlength="9" placeholder="Seria i numer dowodu"></div>
                <div class="col-md-4 inputPole "><input data-wartosc_domyslna="<?php echo $DataUrodzeniaReprezentanta; ?>" value="<?php echo $DataUrodzeniaReprezentanta; ?>" data-kolumna="DataUrodzenia" type="date" class="update datePicker" placeholder="Data urodzenia"></div>
                <div class="col-md-6 inputPole padding_t_10 padding_r_10"><input data-wartosc_domyslna="<?php echo $NipReprezentanta; ?>" value="<?php echo $NipReprezentanta; ?>" data-kolumna="Nip" type="text" maxlength="14" class="update poleLiczbowe"  placeholder="NIP"></div>
                <div class="col-md-6 inputPole padding_t_10"><input data-wartosc_domyslna="<?php echo $KrsReprezentanta; ?>" value="<?php echo $KrsReprezentanta; ?>" data-kolumna="Krs" type="text" class="update duzeMaleLiteryCyfry" maxlength="9" placeholder="KRS/EDG"></div>

                <label class="margin_t_10 width_100">DANE DO KONTAKTU</label>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="Telefon" type="text" class="update poleLiczbowe" placeholder="Telefon"></div>
                <div class="col-md-8 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="Mail" type="text" class="update sprawdzEmail duzeMaleLiteryCyfry" placeholder="Adres e-mail"></div>

                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneReprezentantaWlasciciela" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="1" data-strona="rzeczowe_pelnomocnik" data-akcja="<?php echo (!$umowa_osoba_reprezentant_id_tmp_check) ? "dodaj_firme" : "aktualizuj_firme" ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz reprezentanta</button>

                    <div class="daneUrzeduSkarbowegoReprezentantaWlasciciela">

                        <label class="margin_t_10 width_100">URZĄD SKARBOWY REPREZENTANTA</label>
                        <div class="col-md-12 inputPole"><input data-wartosc_domyslna="<?php echo $NazwaUSReprezentanta; ?>" value="<?php echo $NazwaUSReprezentanta; ?>" data-kolumna="Nazwa" type="text" class="update duzeMaleLiteryCyfry" placeholder="Pełna nazwa Urzędu Skarbowego"></div>
                        <div class="col-md-6 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $UlicaUSReprezentanta; ?>" value="<?php echo $UlicaUSReprezentanta; ?>" data-kolumna="Ulica" type="text" class="update duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                        <div class="col-md-3 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $NrDomuUSReprezentanta; ?>" value="<?php echo $NrDomuUSReprezentanta; ?>" data-kolumna="NrDomu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                        <div class="col-md-3 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $NrMieszkaniaUSReprezentanta; ?>" value="<?php echo $NrMieszkaniaUSReprezentanta; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                        <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowyUSReprezentanta; ?>" value="<?php echo $KodPocztowyUSReprezentanta; ?>" data-kolumna="KodPocztowy" type="text" class="update sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                        <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiastoUSReprezentanta; ?>" value="<?php echo $WartoscMiastoUSReprezentanta; ?>" data-kolumna="Wartosc" type="text" class="update" placeholder="Miejscowość"></div>
                        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="NrOsoby" type="text" class="update" placeholder=""></div>
                        <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="6" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>

                        <label class="margin_t_10 width_100">WIELKOŚC UDZIAŁU REPREZENTANTA W WIERZYTELNOŚCI</label>
                        <div class="col-md-12 inputPole"><input data-wartosc_domyslna="<?php echo $WielkoscUdzialuReprezentanta; ?>" value="<?php echo $WielkoscUdzialuReprezentanta; ?>" data-kolumna="WielkoscUdzialu" type="text" class="update duzeMaleLiteryCyfry" placeholder="Wartość wpisać procentowo lub ułamkiem"></div>

                        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneUrzeduSkarbowegoReprezentantaWlasciciela" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaUrzadSkarbowy" data-strona="rzeczowe_pelnomocnik" data-ogolne="1" data-akcja="<?php echo ($id_urzedu_skarbowego_reprezentanta_tmp == '0') ? "dodaj_urzad_skarbowy" : "aktualizuj_urzad_skarbowy" ?>" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz Urząd Skarbowy reprezentanta</button>
                    </div>
            </div>
        </div>
        <?php } ?>
    </div>