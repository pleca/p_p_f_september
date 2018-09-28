<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');


$drukiaMain = new DrukiMain();

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '' ;
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '' ;
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '' ;
$strona = (isset($_POST['strona'])) ? htmlspecialchars($_POST['strona']) : '' ;
$dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;

$komunikat = 'Brak akcji do wykonania!!!';
$rodzajOut = 'blad';
$przeladujWidokZakladki = 0;
$przeladujSzczegolyElementu = 0;
$ukryjPopUp1 = 0;
$element_id_out = $element_id;

switch ($akcja) {

    case 'dodaj_umowe_osobowa':

        if (empty($element_id[0])) {
            $umowa_id_tmp = $bazaDanych->wstawDane('umowa', array(
                'PrzedstawicielId' => $_SESSION['uzytkownik_id']
            , 'DataUtworzenia' => 'NOW()'
            , 'ZgodaGiodo' => '1'
            , 'UmowaTypId' => '4'
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id_tmp, 'umowa_id', 'Dodanie umowy', '', $umowa_id_tmp, 'umowa_historia_zmian');

            $umowa_osobowa_id_tmp = $bazaDanych->wstawDane('umowaOsobowa', array(
                'UmowaId' => $umowa_id_tmp
            , 'RodzajSzkodyId' => $dane['RodzajSzkodyId']
            , 'TypSzkodyId' => $dane['TypSzkodyId']
            , 'TypZdarzeniaId' => $dane['TypZdarzeniaId']
            , 'InnyRodzajSzkody' => $dane['InnyRodzajSzkody']
            ));

        }

        unset($_COOKIE['EventTypeID']);
        setcookie('EventTypeID', null, -1, '/');

        $element_id_out = $umowa_id_tmp . '-' . $osoba_id_tmp . '-' . $umowa_osobowa_id_tmp;


    $komunikat = 'Zmiany zostały zapisane!!!';
    $rodzajOut = 'sukces';
    break;

    case 'dodaj_klienta':

        $element_id = explode('-', $element_id);

        if (empty($element_id[0])) {
            $umowa_id_tmp = $bazaDanych->wstawDane('umowa', array(
                'PrzedstawicielId' => $_SESSION['uzytkownik_id']
            , 'DataUtworzenia' => 'NOW()'
            , 'ZgodaGiodo' => '1'
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id_tmp, 'umowa_id', 'Dodanie umowy', '', $umowa_id_tmp, 'umowa_historia_zmian');
        }

        $kontakt_id_tmp = $bazaDanych->wstawDane('umowaKontakt', array(
            'Mail' => $dane['Mail']
        , 'Telefon' => $dane['Telefon']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $kontakt_id_tmp, 'umowaKontakt_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaKontakt_historia_zmian');

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id', 'umowaAdresMiasto', 'Wartosc = "' . $dane['Wartosc'] . '"');
        if (is_null($adres_miasto_id_tmp)) {
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto', array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        } else {
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres', array(
            'Ulica' => $dane['Ulica']
        , 'NrDomu' => $dane['NrDomu']
        , 'NrMieszkania' => $dane['NrMieszkania']
        , 'KodPocztowy' => $dane['KodPocztowy']
        , 'MiastoId' => $adres_miasto_id_tmp

        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        if ($droga === 'osobowa') {
            $OsobaTypId = $dane['OsobaTypId'];
        } else {
            $OsobaTypId = '1';
        }


        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        , 'Nazwisko' => $dane['Nazwisko']
        , 'Pesel' => $dane['Pesel']
        , 'Dowod' => strtoupper($dane['Dowod'])
        , 'AdresId' => $adres_id_tmp
        , 'KontaktId' => $kontakt_id_tmp
        , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        , 'OsobaTypId' => $OsobaTypId
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaOsoba_historia_zmian');

        if ($droga === 'bankowa') {
            $bazaDanych->aktualizujDane('umowa', array('UmowaTypId' => '1'), $umowa_id_tmp);

            $umowa_bankowa_id = $bazaDanych->wstawDane('umowaBankowa', array(
                'UmowaId' => $umowa_id_tmp
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_bankowa_id, 'umowaBankowa_id', 'Dodanie umowy', '', $umowa_bankowa_id, 'umowaBankowa_historia_zmian');

            $bazaDanych->wstawDane('umowaBankowaOsoba', array(
                'BankowaId' => $umowa_bankowa_id
            , 'OsobaId' => $osoba_id_tmp
            ));

            $element_id_out = $umowa_id_tmp . '-' . $osoba_id_tmp . '-' . $umowa_bankowa_id;

        }

        if ($droga === 'ofe') {
            $bazaDanych->aktualizujDane('umowa', array('UmowaTypId' => '2'), $umowa_id_tmp);

            $umowa_ofe_id = $bazaDanych->wstawDane('umowaOfe', array(
                'UmowaId' => $umowa_id_tmp
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_ofe_id, 'umowaOfe_id', 'Dodanie umowy', '', $umowa_ofe_id, 'umowaOfe_historia_zmian');

            $bazaDanych->wstawDane('umowaOfeOsoba', array(
                'OfeId' => $umowa_ofe_id
            , 'OsobaId' => $osoba_id_tmp
            , 'TypOsoby' => '1'
            ));

            $element_id_out = $umowa_id_tmp . '-' . $osoba_id_tmp . '-' . $umowa_ofe_id;

        }

        if ($droga === 'osobowa') {
            $bazaDanych->aktualizujDane('umowa', array('UmowaTypId' => '4'), $umowa_id_tmp);

            if (empty($element_id[2])) {
                $umowa_osobowa_id = $bazaDanych->wstawDane('umowaOsobowa', array(
                    'UmowaId' => $umowa_id_tmp
                ));
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osobowa_id, 'umowaOsobowa_id', 'Dodanie umowy', '', $umowa_osobowa_id, 'umowaOsobowa_historia_zmian');
            }

            if (isset($dane['TypOsoby'])) {
                $bazaDanych->wstawDane('umowaOsobowaOsoba', array(
                    'OsobowaId' => $element_id[2]
                , 'OsobaId' => $osoba_id_tmp
                , 'TypOsoby' => $dane['TypOsoby']
                ));
            } else {
                $bazaDanych->wstawDane('umowaOsobowaOsoba', array(
                    'OsobowaId' => $umowa_osobowa_id
                , 'OsobaId' => $osoba_id_tmp
                , 'TypOsoby' => '1'
                ));
            }

            $element_id_out = $umowa_id_tmp . '-' . $osoba_id_tmp . '-' . $umowa_osobowa_id;
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_klienta_osobowe':
        unset($_COOKIE['VictimFirstName']);
        setcookie('VictimFirstName', null, -1, '/');

        unset($_COOKIE['VictimLastName']);
        setcookie('VictimLastName', null, -1, '/');

        $element_id = explode('-', $element_id);

        $umowa_id_tmp = $element_id[0];

        //$osobowa_id_tmp = $element_id[2];

        $kontakt_id_tmp = $bazaDanych->wstawDane('umowaKontakt', array(
            'Mail' => $dane['Mail']
        , 'Telefon' => $dane['Telefon']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $kontakt_id_tmp, 'umowaKontakt_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaKontakt_historia_zmian');

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id', 'umowaAdresMiasto', 'Wartosc = "' . $dane['Wartosc'] . '"');
        if (is_null($adres_miasto_id_tmp)) {
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto', array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        } else {
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres', array(
            'Ulica' => $dane['Ulica']
        , 'NrDomu' => $dane['NrDomu']
        , 'NrMieszkania' => $dane['NrMieszkania']
        , 'KodPocztowy' => $dane['KodPocztowy']
        , 'MiastoId' => $adres_miasto_id_tmp

        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        , 'Nazwisko' => $dane['Nazwisko']
        , 'Pesel' => $dane['Pesel']
        , 'Wiek' => $dane['Wiek']
        , 'Dowod' => strtoupper($dane['Dowod'])
        , 'AdresId' => $adres_id_tmp
        , 'KontaktId' => $kontakt_id_tmp
        , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        , 'OsobaTypId' => $dane['OsobaTypId']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaOsoba_historia_zmian');


        //$bazaDanych->aktualizujDane('umowa', array('UmowaTypId' => '4'), $umowa_id_tmp);

        /*$umowa_osobowa_id = $bazaDanych->wstawDane('umowaOsobowa', array(
            'UmowaId' => $umowa_id_tmp
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osobowa_id, 'umowaOsobowa_id', 'Dodanie umowy', '', $umowa_osobowa_id, 'umowaOsobowa_historia_zmian');*/

        $bazaDanych->wstawDane('umowaOsobowaOsoba', array(
            'OsobowaId' => $element_id[2]
        , 'OsobaId' => $osoba_id_tmp
        , 'TypOsoby' => $dane['OsobaTypId']
        ));

        /*
        if (isset($dane['TypOsoby'])) {
            $bazaDanych->wstawDane('umowaOsobowaOsoba', array(
                'OsobowaId' => $element_id[2]
            , 'OsobaId' => $osoba_id_tmp
            , 'TypOsoby' => $dane['OsobaTypId']
            ));
        } else {
            $bazaDanych->wstawDane('umowaOsobowaOsoba', array(
                'OsobowaId' => $umowa_osobowa_id
            , 'OsobaId' => $osoba_id_tmp
            , 'TypOsoby' => '1'
            ));
        }
        */

        $osoba_id_tel_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['ImieTel']
        ,'Nazwisko' => $dane['NazwiskoTel']
        ,'Pesel' => $dane['PeselTel']
        ,'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        ,'OsobaTypId' => $dane['OsobaTypIdTel']
        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tel_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');


        $dodajOsobe = $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
            'OsobaUprawnionyDoInfId' => $osoba_id_tel_tmp
        ), $element_id[2]);

        $bazaDanych->wstawDane('umowa' . mb_ucfirst($droga).'Osoba', array(
            mb_ucfirst($droga).'Id' => $element_id[2]
        , 'OsobaId' => $osoba_id_tel_tmp
        , 'TypOsoby' => $dane['OsobaTypIdTel']
        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Dodanie dzialajacy w imieniu', '', $osoba_id_tmp, 'umowa'.mb_ucfirst($droga).'_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id_tmp, 'umowa_id', 'Dodanie dzialajacy w imieniu', '', $osoba_id_tmp, 'umowa_historia_zmian');




                if ($dane['OdbiorcaWynagrodzeniaKlient'] == 1) {

                    $umowa_osobowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id = ' . $element_id[2]);
                    $umowa_osobowa_tmp = $umowa_osobowa_tmp->fetch_object();

                    $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy', array(
                        'Numer' => $dane['Numer']
                    , 'OsobaId' => $element_id[1]
                    , 'Typ' => '1'
                    ));

                    $bazaDanych->aktualizujDane('umowaOsobowa', array(
                        'SposobPlatnosciId' => '2'
                    ,'RachunekBankowyId' => $rachunek_bankowy_id_tmp
                    ,'OdbiorcaId' => $element_id[1]
                    ),$element_id[2]);

                } else {

                    $osoba_wynagrodzenie_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
                        'Imie' => $dane['ImieWynagrodzenie']
                    , 'Nazwisko' => $dane['NazwiskoWynagrodzenie']
                    , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
                    , 'OsobaTypId' => '2'
                    ));

                    $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy', array(
                        'Numer' => $dane['Numer']
                    , 'OsobaId' => $osoba_wynagrodzenie_id_tmp
                    , 'Typ' => '1'
                    ));

                    $bazaDanych->aktualizujDane('umowaOsobowa', array(
                        'SposobPlatnosciId' => '2'
                    ,'RachunekBankowyId' => $rachunek_bankowy_id_tmp
                    ,'OdbiorcaId' => $osoba_wynagrodzenie_id_tmp
                    ),$element_id[2]);

                }



        $element_id_out = $umowa_id_tmp . '-' . $osoba_id_tmp . '-' . $element_id[2];

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_przedmiot_umowy':

        $element_id = explode('-', $element_id);

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id', 'umowaAdresMiasto', 'Wartosc = "' . $dane['Wartosc'] . '"');
        if (is_null($adres_miasto_id_tmp)) {
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto', array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        } else {
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres', array(
            'Ulica' => $dane['Ulica']
        , 'NrDomu' => $dane['NrDomu']
        , 'NrMieszkania' => $dane['NrMieszkania']
        , 'KodPocztowy' => $dane['KodPocztowy']
        , 'MiastoId' => $adres_miasto_id_tmp
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $ubezpieczyciel_id_tmp = $bazaDanych->wstawDane('umowaUbezpieczyciel', array(
            'Nazwa' => $dane['Nazwa']
        , 'AdresId' => $adres_id_tmp
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $ubezpieczyciel_tmp, 'umowaUbezpieczyciel_id', 'Dodanie Ubezpieczyciela', '', $dane['Nazwa'], 'umowaUbezpieczyciel_historia_zmian');

        $pojazd_id_tmp = $bazaDanych->wstawDane('umowaPojazd', array(
            'Marka' => $dane['Marka']
        , 'Model' => $dane['Model']
        , 'NrRejestracyjny' => $dane['NrRejestracyjny']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $pojazd_id_tmp, 'umowaPojazd_id', 'Dodanie Marki pojazdu', '', $dane['Marka'], 'umowaPojazd_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $pojazd_id_tmp, 'umowaPojazd_id', 'Dodanie Modelu Pojazdu', '', $dane['Model'], 'umowaPojazd_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $pojazd_id_tmp, 'umowaPojazd_id', 'Dodanie Numeru Rejestracyjnego', '', $dane['NrRejestracyjny'], 'umowaPojazd_historia_zmian');


        $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
            'PojazdId' => $pojazd_id_tmp
        , 'UbezpieczycielId' => $ubezpieczyciel_id_tmp
        , 'DataSzkody' => $dane['DataSzkody']
        , 'NumerAkt' => $dane['NumerAkt']
        , 'NazwaUbezpieczyciela' => $dane['NazwaUbezpieczyciela']
        , 'DataUmowyPrzelewu' => $dane['DataUmowyPrzelewu']
        , 'NumerSprawy' => $dane['NumerSprawy']
        ), $element_id[2]);

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaRzeczowa_id', 'Dodanie DataSzkody', '', $dane['DataSzkody'], 'umowaRzeczowa_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaRzeczowa_id', 'Dodanie NumerAkt', '', $dane['NumerAkt'], 'umowaRzeczowa_historia_zmian');

        if (isset($dane['NazwaUbezpieczyciela']) || isset($dane['DataUmowyPrzelewu']) || isset($dane['NumerSprawy'])) {
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaRzeczowa_id', 'Dodanie NazwaUbezpieczyciela', '', $dane['NazwaUbezpieczyciela'], 'umowaRzeczowa_historia_zmian');
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaRzeczowa_id', 'Dodanie DataUmowyPrzelewu', '', $dane['DataUmowyPrzelewu'], 'umowaRzeczowa_historia_zmian');
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaRzeczowa_id', 'Dodanie NumerSprawy', '', $dane['NumerSprawy'], 'umowaRzeczowa_historia_zmian');
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_firme':

        $element_id = explode('-', $element_id);


        if (empty($element_id[0])) {
            $umowa_id_tmp = $bazaDanych->wstawDane('umowa', array(
                'PrzedstawicielId' => $_SESSION['uzytkownik_id']
            , 'DataUtworzenia' => 'NOW()'
            , 'ZgodaGiodo' => '1'
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id_tmp, 'umowa_id', 'Dodanie umowy', '', $umowa_id_tmp, 'umowa_historia_zmian');
        }

        $kontakt_id_tmp = $bazaDanych->wstawDane('umowaKontakt', array(
            'Mail' => $dane['Mail']
        , 'Telefon' => $dane['Telefon']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $kontakt_id_tmp, 'umowaKontakt_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaKontakt_historia_zmian');

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id', 'umowaAdresMiasto', 'Wartosc = "' . $dane['Wartosc'] . '"');
        if (is_null($adres_miasto_id_tmp)) {
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto', array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        } else {
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres', array(
            'Ulica' => $dane['Ulica']
        , 'NrDomu' => $dane['NrDomu']
        , 'NrMieszkania' => $dane['NrMieszkania']
        , 'KodPocztowy' => $dane['KodPocztowy']
        , 'MiastoId' => $adres_miasto_id_tmp

        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Nazwa' => $dane['Nazwa']
        , 'Imie' => $dane['Imie']
        , 'Nazwisko' => $dane['Nazwisko']
        , 'Pesel' => $dane['Pesel']
        , 'DataUrodzenia' => $dane['DataUrodzenia']
        , 'Nip' => $dane['Nip']
        , 'Krs' => $dane['Krs']
        , 'Dowod' => strtoupper($dane['Dowod'])
        , 'AdresId' => $adres_id_tmp
        , 'KontaktId' => $kontakt_id_tmp
        , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaOsoba_historia_zmian');


        $bazaDanych->aktualizujDane('umowa', array('UmowaTypId' => '3'), $umowa_id_tmp);

        //$umowa_rzeczowa_id = $element_id[2];

        if (empty($element_id[2])) {
            $umowa_rzeczowa_id = $bazaDanych->wstawDane('umowaRzeczowa', array(
                'UmowaId' => $umowa_id_tmp,
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_rzeczowa_id, 'umowaRzeczowa_id', 'Dodanie umowy', '', $umowa_rzeczowa_id, 'umowaRzeczowa_historia_zmian');

            if(isset($dane['UmowaTypKlientaId'])) {
                $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                    'UmowaTypKlientaId' => $dane['UmowaTypKlientaId']
                ), $umowa_rzeczowa_id);
            } else {
                $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                    'UmowaTypKlientaId' => 1
                ), $umowa_rzeczowa_id);
            }
        } else if (isset($dane['PelnomocnikKlienta'])) {
            $umowa_rzeczowa_id = $element_id[2];
            $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                'PelnomocnikKlienta' => $dane['PelnomocnikKlienta']
            ), $umowa_rzeczowa_id);
        } else if (isset($dane['ReprezentantKlienta'])) {
            $umowa_rzeczowa_id = $element_id[2];
            $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                'ReprezentantKlienta' => $dane['ReprezentantKlienta']
            ), $umowa_rzeczowa_id);
        } else {
            $umowa_rzeczowa_id = $element_id[2];
        }


        //if(!isset($dane['PelnomocnikKlienta'])) {
        $bazaDanych->wstawDane('umowaRzeczowaOsoba', array(
            'RzeczowaId' => $umowa_rzeczowa_id
        , 'OsobaId' => $osoba_id_tmp
        , 'NrOsoby' => $dane['NrOsoby']
        , 'OsobaTypId' => $dane['OsobaTypId']
        ));
        //}


        $element_id_out = $umowa_id_tmp . '-' . $osoba_id_tmp . '-' . $umowa_rzeczowa_id;

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_dodatkowego_klienta':
        $element_id = explode('-', $element_id);

        $kontakt_id_tmp = $bazaDanych->wstawDane('umowaKontakt', array(
            'Mail' => $dane['Mail']
        , 'Telefon' => $dane['Telefon']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $kontakt_id_tmp, 'umowaKontakt_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaKontakt_historia_zmian');

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id', 'umowaAdresMiasto', 'Wartosc = "' . $dane['Wartosc'] . '"');
        if (is_null($adres_miasto_id_tmp)) {
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto', array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        } else {
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres', array(
            'Ulica' => $dane['Ulica']
        , 'NrDomu' => $dane['NrDomu']
        , 'NrMieszkania' => $dane['NrMieszkania']
        , 'KodPocztowy' => $dane['KodPocztowy']
        , 'MiastoId' => $adres_miasto_id_tmp

        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        , 'Nazwisko' => $dane['Nazwisko']
        , 'Pesel' => $dane['Pesel']
        , 'Dowod' => $dane['Dowod']
        , 'AdresId' => $adres_id_tmp
        , 'KontaktId' => $kontakt_id_tmp
        , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        , 'OsobaTypId' => '3'
        ));

        if ($droga == 'bankowa') {
            $bazaDanych->wstawDane('umowaBankowaOsoba', array(
                'BankowaId' => $element_id[2]
            , 'OsobaId' => $osoba_id_tmp
            ));
        } else if ($droga == 'ofe') {
            $bazaDanych->wstawDane('umowaOfeOsoba', array(
                'OfeId' => $element_id[2]
            , 'OsobaId' => $osoba_id_tmp
            , 'TypOsoby' => $dane['TypOsoby']
            ));
        }

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa' . mb_ucfirst($droga) . '_id', 'Dodanie dodatkowego klienta', '', $osoba_id_tmp, 'umowa' . mb_ucfirst($droga) . '_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie dodatkowego klienta', '', $osoba_id_tmp, 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'przepisz_odbiorce':

        $element_id = explode('-', $element_id);
        $umowa_osobowa_id = $element_id[2];
        $umowa_osoba_id = $element_id[1];


        $umowa_osobowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id = ' . $umowa_osobowa_id);
        $umowa_osobowa_tmp = $umowa_osobowa_tmp->fetch_object();

        /*$umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$umowa_osobowa_tmp->OsobaPoszkodowanyId);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();*/

        $bazaDanych->aktualizujDane('umowaOsobowa', array('OdbiorcaId' => $umowa_osoba_id), $umowa_osobowa_id);

        $komunikat = 'Zmiany zostały zapisane!!!';
        //$komunikat = $dane['OdbiorcaWynagrodzeniaKlient'];
        $przeladujSzczegolyElementu = 1;
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_wynagrodzenie':
        $element_id = explode('-', $element_id);

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id', 'umowaAdresMiasto', 'Wartosc = "' . $dane['Wartosc'] . '"');
        if (is_null($adres_miasto_id_tmp)) {
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto', array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        } else {
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres', array(
            'Ulica' => $dane['Ulica']
        , 'NrDomu' => $dane['NrDomu']
        , 'NrMieszkania' => $dane['NrMieszkania']
        , 'KodPocztowy' => $dane['KodPocztowy']
        , 'MiastoId' => $adres_miasto_id_tmp
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        , 'Nazwisko' => $dane['Nazwisko']
        , 'AdresId' => $adres_id_tmp
        , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        , 'OsobaTypId' => '2'
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaOsoba_historia_zmian');

        if ($dane['SposobPlatnosciId'] == 1) {
            $bazaDanych->aktualizujDane($tabela, array(
                'SposobPlatnosciId' => $dane['SposobPlatnosciId']
            , 'OdbiorcaId' => $osoba_id_tmp
            ), $element_id[2]);
        }

        if ($dane['SposobPlatnosciId'] == 2) {
            $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy', array(
                'Numer' => $dane['Numer']
            , 'OsobaId' => $osoba_id_tmp
            ));
            $bazaDanych->aktualizujDane($tabela, array(
                'SposobPlatnosciId' => $dane['SposobPlatnosciId']
            , 'RachunekBankowyId' => $rachunek_bankowy_id_tmp
            ), $element_id[2]);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela . '_id', 'Edycja RachunekBankowyId', '', $rachunek_bankowy_id_tmp, $tabela . '_historia_zmian');
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie Numeru Rachunku', '', $dane['Numer'], 'umowa_historia_zmian');
        }

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela . '_id', 'Edycja OdbiorcaId', '', $osoba_id_tmp, $tabela . '_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie odbiorcy wyn.', '', $osoba_id_tmp, 'umowa_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela . '_id', 'Edycja SposobPlatnosciId', '', $dane['SposobPlatnosciId'], $tabela . '_historia_zmian');

        $przeladujSzczegolyElementu = 1;
        $element_id_out = $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2];
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';

        break;

    case 'dodaj_wynagrodzenie_osobowe':

        $element_id = explode('-', $element_id);

        if ($dane['OdbiorcaWynagrodzeniaKlient'] == 1) {

            $umowa_osobowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id = ' . $element_id[2]);
            $umowa_osobowa_tmp = $umowa_osobowa_tmp->fetch_object();

            $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy', array(
                'Numer' => $dane['Numer']
            , 'OsobaId' => $element_id[1]
            , 'Typ' => '1'
            ));

            $bazaDanych->aktualizujDane('umowaOsobowa', array(
                'SposobPlatnosciId' => '2'
            ,'RachunekBankowyId' => $rachunek_bankowy_id_tmp
            ,'OdbiorcaId' => $element_id[1]
            ),$element_id[2]);

        } else {

            $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
                'Imie' => $dane['Imie']
            , 'Nazwisko' => $dane['Nazwisko']
            , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
            , 'OsobaTypId' => '2'
            ));

            $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy', array(
                'Numer' => $dane['Numer']
            , 'OsobaId' => $osoba_id_tmp
            , 'Typ' => '1'
            ));

            $bazaDanych->aktualizujDane('umowaOsobowa', array(
                'SposobPlatnosciId' => '2'
            ,'RachunekBankowyId' => $rachunek_bankowy_id_tmp
            ,'OdbiorcaId' => $osoba_id_tmp
            ),$element_id[2]);

        }

        $przeladujSzczegolyElementu = 1;
        $element_id_out = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';

        break;

    case 'aktualizuj_wynagrodzenie_osobowe':

        $element_id = explode('-',$element_id);

        $umowa_dane = $bazaDanych->pobierzDane('SposobPlatnosciId, RachunekBankowyId, OdbiorcaId', $tabela, 'Id = '.$element_id[2]);
        $umowa_dane = $umowa_dane->fetch_object();

        $rachunek_bankowy_dane_tmp = $bazaDanych->pobierzDane('Numer, OsobaId, Typ', 'umowaRachunekBankowy', 'Id = '.$umowa_dane->RachunekBankowyId);
        $rachunek_bankowy_dane_tmp = $rachunek_bankowy_dane_tmp->fetch_object();

        if (isset($dane['OdbiorcaWynagrodzeniaKlient'])){

            if ($dane['OdbiorcaWynagrodzeniaKlient'] == 1) {

                $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                    'Numer' => $dane['Numer']
                , 'OsobaId' => $element_id[1]
                ), $umowa_dane->RachunekBankowyId);

                $bazaDanych->aktualizujDane($tabela, array(
                    'OdbiorcaId' => $element_id[1]
                ), $element_id[2]);

            } else {

                $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
                    'Imie' => $dane['Imie']
                , 'Nazwisko' => $dane['Nazwisko']
                , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
                , 'OsobaTypId' => '2'
                ));

                $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy', array(
                    'Numer' => $dane['Numer']
                , 'OsobaId' => $osoba_id_tmp
                , 'Typ' => '1'
                ));

                $bazaDanych->aktualizujDane('umowaOsobowa', array(
                    'SposobPlatnosciId' => '2'
                ,'RachunekBankowyId' => $rachunek_bankowy_id_tmp
                ,'OdbiorcaId' => $osoba_id_tmp
                ),$element_id[2]);
            }

            $przeladujSzczegolyElementu = 1;

        } else {

                if(isset($dane['Numer'])) {
                    $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                        'Numer' => $dane['Numer']
                    ), $umowa_dane->RachunekBankowyId);
                }

                if (isset($dane['Imie']) || isset($dane['Nazwisko'])) {

                    $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $umowa_dane->OdbiorcaId);
                    $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

                    if (isset($dane['Imie'])) {
                        if ($dane['Imie'] != $umowa_osoba_tmp->Imie) {
                            $bazaDanych->aktualizujDane('umowaOsoba', array('Imie' => $dane['Imie']), $umowa_dane->OdbiorcaId);
                        }
                    }

                    if (isset($dane['Nazwisko'])) {
                        if ($dane['Nazwisko'] != $umowa_osoba_tmp->Nazwisko) {
                            $bazaDanych->aktualizujDane('umowaOsoba', array('Nazwisko' => $dane['Nazwisko']), $umowa_dane->OdbiorcaId);
                        }
                    }

                    if (isset($dane['Numer'])) {
                        $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                            'OsobaId' => $umowa_dane->OdbiorcaId
                        ), $umowa_dane->RachunekBankowyId);

                        $bazaDanych->aktualizujDane($tabela, array(
                            'RachunekBankowyId' => $umowa_dane->RachunekBankowyId
                        ), $element_id[2]);

                    }
                }

                $przeladujSzczegolyElementu = 1;
        }

        $element_id_out = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_uprawnionych':

        $element_id = explode('-',$element_id);

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');


        if(is_null($adres_miasto_id_tmp)){
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        }else{
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }


        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres',array(
            'Ulica' => $dane['Ulica']
        ,'NrDomu' => $dane['NrDomu']
        ,'NrMieszkania' => $dane['NrMieszkania']
        ,'KodPocztowy' => $dane['KodPocztowy']
        ,'MiastoId' => $adres_miasto_id_tmp

        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $kontakt_id_tmp = $bazaDanych->wstawDane('umowaKontakt',array(
            'Mail' => $dane['Mail']
        ,'Telefon' => $dane['Telefon']
        ));


        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $kontakt_id_tmp, 'umowaKontakt_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaKontakt_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        ,'Nazwisko' => $dane['Nazwisko']
        ,'Pesel' => $dane['Pesel']
        ,'Wiek' => $dane['Wiek']
        ,'Dowod' => $dane['Dowod']
        ,'AdresId' => $adres_id_tmp
        ,'KontaktId' => $kontakt_id_tmp
        ,'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        ,'OsobaTypId' => $dane['OsobaTypId']
        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaOsoba_historia_zmian');


        $dodajOsobe = $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
            'OsobaUprawnionyId' => $osoba_id_tmp
        ,'UmowaRodzajUprawnionegoId' => $dane['UmowaRodzajUprawnionegoId']
        ), $element_id[2]);


        if (isset($dane['OsobaTypId'])) {
            $bazaDanych->wstawDane('umowa' . mb_ucfirst($droga).'Osoba', array(
                mb_ucfirst($droga).'Id' => $element_id[2]
            , 'OsobaId' => $osoba_id_tmp
            , 'TypOsoby' => $dane['OsobaTypId']
            ));
        }

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Dodanie dzialajacy w imieniu', '', $osoba_id_tmp, 'umowa'.mb_ucfirst($droga).'_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie dzialajacy w imieniu', '', $osoba_id_tmp, 'umowa_historia_zmian');

        $osoba_id_tel_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['ImieTel']
        ,'Nazwisko' => $dane['NazwiskoTel']
        ,'Pesel' => $dane['PeselTel']
        ,'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        ,'OsobaTypId' => $dane['OsobaTypIdTel']
        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tel_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');

        $dodajOsobe = $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
            'OsobaUprawnionyDoInfId' => $osoba_id_tel_tmp
        ), $element_id[2]);

        if (isset($dane['TypOsobyTel'])) {
            $bazaDanych->wstawDane('umowa' . mb_ucfirst($droga) . 'Osoba', array(
                mb_ucfirst($droga) . 'Id' => $element_id[2]
            , 'OsobaId' => $osoba_id_tel_tmp
            , 'TypOsoby' => $dane['TypOsobyTel']
            ));
        }

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Dodanie dzialajacy w imieniu', '', $osoba_id_tmp, 'umowa'.mb_ucfirst($droga).'_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie dzialajacy w imieniu', '', $osoba_id_tmp, 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';

        break;

    case 'dodaj_dzialajacy_w_imieniu':

        $element_id = explode('-',$element_id);

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');


        if(is_null($adres_miasto_id_tmp)){
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        }else{
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }


        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres',array(
            'Ulica' => $dane['Ulica']
        ,'NrDomu' => $dane['NrDomu']
        ,'NrMieszkania' => $dane['NrMieszkania']
        ,'KodPocztowy' => $dane['KodPocztowy']
        ,'MiastoId' => $adres_miasto_id_tmp

        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $kontakt_id_tmp = $bazaDanych->wstawDane('umowaKontakt',array(
            'Mail' => $dane['Mail']
        ,'Telefon' => $dane['Telefon']
        ));


        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $kontakt_id_tmp, 'umowaKontakt_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaKontakt_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        ,'Nazwisko' => $dane['Nazwisko']
        ,'Pesel' => $dane['Pesel']
        ,'Dowod' => $dane['Dowod']
        ,'AdresId' => $adres_id_tmp
        ,'KontaktId' => $kontakt_id_tmp
        ,'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        ,'OsobaTypId' => $dane['OsobaTypId']
        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaOsoba_historia_zmian');


            $dodajOsobe = $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                'UmowaDzialajacyWImieniuId' => $dane['UmowaDzialajacyWImieniuId']
            , 'OsobaPoszkodowanyId' => $osoba_id_tmp
            ), $element_id[2]);

           $bazaDanych->wstawDane('umowa' . mb_ucfirst($droga).'Osoba', array(
                mb_ucfirst($droga).'Id' => $element_id[2]
            , 'OsobaId' => $osoba_id_tmp
            , 'TypOsoby' => $dane['TypOsoby']
            ));


        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Dodanie dzialajacy w imieniu', '', $osoba_id_tmp, 'umowa'.mb_ucfirst($droga).'_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie dzialajacy w imieniu', '', $osoba_id_tmp, 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';

        break;

    case 'dodaj_dokument_do_umowy':
        $element_id = explode('-',$element_id);

        $nazwa_pliku = $drukiaMain->zapiszPlik('plik', $_FILES['plik']['name'], '/var/www/pliki/!druki/'.$element_id[0]);

        $dane['ZalacznikPlikNazwa'] = $nazwa_pliku;
        $dane = array_merge($dane, array('UmowaId' => $element_id[0]));

        $umowa_zalacznik_id = $bazaDanych->wstawDane('umowaZalacznik', $dane);
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_zalacznik_id, 'umowaZalacznik_id', 'Dodanie dokumentu', '', $nazwa_pliku, 'umowaZalacznik_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie dokumentu', '', $nazwa_pliku, 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_posiadacza_rachunku_emerytalnego':
        $element_id = explode('-',$element_id);

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');
        if(is_null($adres_miasto_id_tmp)){
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        }else{
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres',array(
            'Ulica' => $dane['Ulica']
        ,'NrDomu' => $dane['NrDomu']
        ,'NrMieszkania' => $dane['NrMieszkania']
        ,'KodPocztowy' => $dane['KodPocztowy']
        ,'MiastoId' => $adres_miasto_id_tmp

        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        ,'Nazwisko' => $dane['Nazwisko']
        ,'Pesel' => $dane['Pesel']
        ,'Dowod' => $dane['Dowod']
        ,'Nip' => $dane['Nip']
        ,'AdresId' => $adres_id_tmp
        ,'KontaktId' => $kontakt_id_tmp
        ,'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        ,'OsobaTypId' => '4'
        ));

        $bazaDanych->aktualizujDane('umowa'.mb_ucfirst($droga), array (
            'OsobaZmarlyId' => $osoba_id_tmp
        ,'DataSmierci' => $dane['DataSmierci']
        ,'Pokrewienstwo' => $dane['Pokrewienstwo']
        ),$element_id[2]);

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Dodanie zmarłego', '', $osoba_id_tmp, 'umowa'.mb_ucfirst($droga).'_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie zmarłego', '', $osoba_id_tmp, 'umowa_historia_zmian');

        $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy',array(
            'Numer' => $dane['Numer']
        ,'OsobaId' => $osoba_id_tmp
        ,'Nazwa' => $dane['Podmiot']
        ,'Typ' => '2'
        ));

        $bazaDanych->wstawDane('umowaOfeOsoba',array(
            'OfeId' => $element_id[2]
        ,'OsobaId' => $osoba_id_tmp
        ,'TypOsoby' => '3'
        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja RachunekBankowyId', '', $rachunek_bankowy_id_tmp, $tabela.'_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie Numeru Rachunku', '', $dane['Numer'], 'umowa_historia_zmian');


        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_dochodzenie_roszczen':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $nazwa_kolumny = $tabela.'Id';

        $kolumna_id_tmp = $umowa_tmp->$nazwa_kolumny;

        $dochodzenie_roszczen_id_tmp = $bazaDanych->wstawDane('umowaDochodzenieRoszczen',array(
            'ZleconoRoszczenia' => $dane['ZleconoRoszczenia']
        ,'NazwaPelnomocnika' => $dane['NazwaPelnomocnika']
        ,'DataZawarciaUmowy' => $dane['DataZawarciaUmowy']
        ,'WypowiedzenieUmowy' => $dane['WypowiedzenieUmowy']
        ,'DataWypowiedzenia' => $dane['DataWypowiedzenia']

        ));

        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                $nazwa_kolumny => $dochodzenie_roszczen_id_tmp
            ), $element_id[2]
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_szpital':

        $element_id = explode('-',$element_id);

        //$umowa_tmp = $bazaDanych->pobierzDane('*','umowaHospitalizacja','IdUmowyOsobowej='.$element_id[2]);
        //$umowa_tmp = $umowa_tmp->fetch_object();

        //$oswiadczenie_poszkodowanego_tmp = $bazaDanych->pobierzDane('PrzebiegLeczeniaId','umowaOswiadczeniePoszkodowanego','Id='.$umowa_tmp->OswiadczeniePoszkodowanegoId);
        //$oswiadczenie_poszkodowanego_tmp = $oswiadczenie_poszkodowanego_tmp->fetch_object();

        $szpital_id_tmp = $bazaDanych->wstawDane('umowaHospitalizacja',array(
            'IdUmowyOsobowej' => $element_id[2]
        ,'MiejsceHospitalizacji' => $dane['MiejsceHospitalizacji']
        ,'DataOdKiedy' => $dane['DataOdKiedy']
        ,'DataDoKiedy' => $dane['DataDoKiedy']
        ));

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_przebieg_leczenia':

        $element_id = explode('-',$element_id);

        //$umowa_tmp = $bazaDanych->pobierzDane('OswiadczeniePoszkodowanegoId','umowaOsobowa','Id='.$element_id[2]);
        //$umowa_tmp = $umowa_tmp->fetch_object();


        $przebieg_leczenia_id_tmp = $bazaDanych->wstawDane('umowaPrzebiegLeczenia',array(
            'Obrazenia' => $dane['Obrazenia']
        ,'PrzeprowadzonoZabiegi' => $dane['PrzeprowadzonoZabiegi']
        ,'MiejscePrzebywania' => $dane['MiejscePrzebywania']
        ,'InneMiejscePrzebywania' => $dane['InneMiejscePrzebywania']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                'PrzebiegLeczeniaId' => $przebieg_leczenia_id_tmp
            ), $element_id[2]
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_szpital':

        $szpital_tmp = $bazaDanych->pobierzDane('*','umowaHospitalizacja','Id='.$dane['Id']);

        if ($szpital_tmp) {
            $szpital_tmp = $szpital_tmp->fetch_object();

            if(isset($dane['MiejsceHospitalizacji']) || isset($dane['DataOdKiedy']) || isset($dane['DataDoKiedy'])) {

                $dane_szpital = array();

                if (isset($dane['MiejsceHospitalizacji'])) {
                    $dane_szpital = array_merge($dane_szpital, array('MiejsceHospitalizacji' => $dane['MiejsceHospitalizacji']));
                    if ($dane['MiejsceHospitalizacji'] != $szpital_tmp->MiejsceHospitalizacji) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataOdKiedy'])) {
                    $dane_szpital = array_merge($dane_szpital, array('DataOdKiedy' => $dane['DataOdKiedy']));
                    if ($dane['DataOdKiedy'] != $szpital_tmp->DataOdKiedy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataDoKiedy'])) {
                    $dane_szpital = array_merge($dane_szpital, array('DataDoKiedy' => $dane['DataDoKiedy']));
                    if ($dane['DataDoKiedy'] != $szpital_tmp->DataDoKiedy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                $bazaDanych->aktualizujDane('umowaHospitalizacja', $dane_szpital, $dane['Id']);
            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_placowke':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('OswiadczeniePoszkodowanegoId','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $oswiadczenie_poszkodowanego_tmp = $bazaDanych->pobierzDane('PrzebiegLeczeniaId','umowaOswiadczeniePoszkodowanego','Id='.$umowa_tmp->OswiadczeniePoszkodowanegoId);
        $oswiadczenie_poszkodowanego_tmp = $oswiadczenie_poszkodowanego_tmp->fetch_object();

        $placowka_id_tmp = $bazaDanych->wstawDane('umowaPlacowki',array(
            'IdPrzebieguLeczenia' => $oswiadczenie_poszkodowanego_tmp->PrzebiegLeczeniaId
        ,'NazwaPlacowki' => $dane['NazwaPlacowki']
        ,'DataZabiegu' => $dane['DataZabiegu']
        ));

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_placowke':

        $placowka_tmp = $bazaDanych->pobierzDane('*','umowaPlacowki','Id='.$dane['Id']);

        if ($placowka_tmp) {
            $placowka_tmp = $placowka_tmp->fetch_object();

            if(isset($dane['NazwaPlacowki']) || isset($dane['DataZabiegu'])) {

                $dane_placowki = array();

                if (isset($dane['NazwaPlacowki'])) {
                    $dane_placowki = array_merge($dane_placowki, array('NazwaPlacowki' => $dane['NazwaPlacowki']));
                    if ($dane['NazwaPlacowki'] != $placowka_tmp->NazwaPlacowki) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataZabiegu'])) {
                    $dane_placowki = array_merge($dane_placowki, array('DataZabiegu' => $dane['DataZabiegu']));
                    if ($dane['DataZabiegu'] != $placowka_tmp->DataZabiegu) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                $bazaDanych->aktualizujDane('umowaPlacowki', $dane_placowki, $dane['Id']);
            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_przebieg_leczenia':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }

        //$umowa_tmp = $bazaDanych->pobierzDane('OswiadczeniePoszkodowanegoId', 'umowaOsobowa','Id = '.$element_id[2]);
        //$umowa_tmp = $umowa_tmp->fetch_object();

        $przebieg_leczenia_tmp = $bazaDanych->pobierzDane('PrzebiegLeczeniaId','umowaOsobowa','Id = '.$element_id[2]);

        if ($przebieg_leczenia_tmp) {
            $przebieg_leczenia_tmp = $przebieg_leczenia_tmp->fetch_object();

            if(isset($dane['Obrazenia']) || isset($dane['PrzeprowadzonoZabiegi']) || isset($dane['DanePrzychodni']) || isset($dane['MiejscePrzebywania']) || isset($dane['InneMiejscePrzebywania'])) {

                $dane_przebieg_leczenia = array();

                if (isset($dane['Obrazenia'])) {
                    $dane_przebieg_leczenia = array_merge($dane_przebieg_leczenia, array('Obrazenia' => $dane['Obrazenia']));
                    if ($dane['Obrazenia'] != $przebieg_leczenia_tmp->Obrazenia) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PrzeprowadzonoZabiegi'])) {
                    $dane_przebieg_leczenia = array_merge($dane_przebieg_leczenia, array('PrzeprowadzonoZabiegi' => $dane['PrzeprowadzonoZabiegi']));
                    if ($dane['PrzeprowadzonoZabiegi'] != $przebieg_leczenia_tmp->PrzeprowadzonoZabiegi) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DanePrzychodni'])) {
                    $dane_przebieg_leczenia = array_merge($dane_przebieg_leczenia, array('DanePrzychodni' => $dane['DanePrzychodni']));
                    if ($dane['DanePrzychodni'] != $przebieg_leczenia_tmp->DanePrzychodni) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['MiejscePrzebywania'])) {
                    $dane_przebieg_leczenia = array_merge($dane_przebieg_leczenia, array('MiejscePrzebywania' => $dane['MiejscePrzebywania']));
                    if ($dane['MiejscePrzebywania'] != $przebieg_leczenia_tmp->MiejscePrzebywania) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['InneMiejscePrzebywania'])) {
                    $dane_przebieg_leczenia = array_merge($dane_przebieg_leczenia, array('InneMiejscePrzebywania' => $dane['InneMiejscePrzebywania']));
                    if ($dane['InneMiejscePrzebywania'] != $przebieg_leczenia_tmp->InneMiejscePrzebywania) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }


                $bazaDanych->aktualizujDane('umowaPrzebiegLeczenia', $dane_przebieg_leczenia, $przebieg_leczenia_tmp->PrzebiegLeczeniaId);

            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_odpowiedzialnosc_karna':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $nazwa_kolumny = $tabela.'Id';

        $kolumna_id_tmp = $umowa_tmp->$nazwa_kolumny;

        $odpowiedzialnosc_karna_id_tmp = $bazaDanych->wstawDane('umowaOdpowiedzialnoscKarna',array(
            'WezwanoPolicje' => $dane['WezwanoPolicje']
        ,'MiejscowoscPolicji' => $dane['MiejscowoscPolicji']
        ,'Sad' => $dane['Sad']
        ,'RodzajZakonczenia' => $dane['RodzajZakonczenia']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                $nazwa_kolumny => $odpowiedzialnosc_karna_id_tmp
            ), $element_id[2]
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_zgoda_na_postepowanie':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();


        $postepowanie_id_tmp = $bazaDanych->wstawDane('umowaZgodaNaPostepowanie',array(
            'Zobowiazany' => $dane['Zobowiazany']
        ,'SygnaturaAkt' => $dane['SygnaturaAkt']
        ,'Sad' => $dane['Sad']
        ,'CzyToczonoPostepowanie' => $dane['CzyToczonoPostepowanie']
        ,'CzyZawartoUgode' => $dane['CzyZawartoUgode']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                'ZgodaNaPostepowanieId' => $postepowanie_id_tmp
            ), $element_id[2]
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_odpowiedzialnosc_cywilna':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $nazwa_kolumny = $tabela.'Id';

        $kolumna_id_tmp = $umowa_tmp->$nazwa_kolumny;

        $odpowiedzialnosc_cywilna_id_tmp = $bazaDanych->wstawDane('umowaOdpowiedzialnoscCywilna',array(
            'ZgloszonoPojazdZOc' => $dane['ZgloszonoPojazdZOc']
        ,'ZgloszonoOsobeZOc' => $dane['ZgloszonoOsobeZOc']
        ,'WyplaconoZOcSprawcy' => $dane['WyplaconoZOcSprawcy']
        ,'KwotaOdszkodowania' => $dane['KwotaOdszkodowania']
        ,'PodstawaPrawna' => $dane['PodstawaPrawna']
        ,'DataWyroku' => $dane['DataWyroku']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                $nazwa_kolumny => $odpowiedzialnosc_cywilna_id_tmp
            ), $element_id[2]
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_inne_odszkodowania_oraz_dane_o_niezdolnosci':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $inne_odszkodowania_id_tmp = $bazaDanych->wstawDane('umowaInneOdszkodowania',array(
            'ZgloszonoZNnw' => $dane['ZgloszonoZNnw']
        ,'NazwaUbezpieczycielaNnw' => $dane['NazwaUbezpieczycielaNnw']
        ,'OkreslonoUszczerbekNnw' => $dane['OkreslonoUszczerbekNnw']
        ,'ProcentUszczerbkuNnw' => $dane['ProcentUszczerbkuNnw']
        ,'JakiWypadek' => $dane['JakiWypadek']
        ,'ZgloszonoSzkode' => $dane['ZgloszonoSzkode']
        ,'GdzieZgloszono' => $dane['GdzieZgloszono']
        ,'GdzieZgloszonoInne' => $dane['GdzieZgloszonoInne']
        ,'ProcentUszczerbku' => $dane['ProcentUszczerbku']
        ,'PrzyznanoOdszkodowanie' => $dane['PrzyznanoOdszkodowanie']
        ,'WysokoscOdszkodowania' => $dane['WysokoscOdszkodowania']
        ,'ZasilekPogrzebowy' => $dane['ZasilekPogrzebowy']
        ));

        $dane_o_niezdolnosci_id_tmp = $bazaDanych->wstawDane('umowaDaneONiezdolnosci',array(
            'ZwolnienieLekarskie' => $dane['ZwolnienieLekarskie']
        ,'DataZwolnienieOd' => $dane['DataZwolnienieOd']
        ,'DataZwolnieniaDo' => $dane['DataZwolnieniaDo']
        ,'OrzeczenieONiezdolnosci' => $dane['OrzeczenieONiezdolnosci']
        ,'TypNiezdolnosci' => $dane['TypNiezdolnosci']
        ,'DataNiezdolnosciDo' => $dane['DataNiezdolnosciDo']
        ,'UbezpieczycielNazwa' => $dane['UbezpieczycielNazwa']
        ,'UbezpieczycielNazwaInne' => $dane['UbezpieczycielNazwaInne']
        ,'PrzyznanoSwiadczenie' => $dane['PrzyznanoSwiadczenie']
        ,'PrzyznanoSwiadczenieInne' => $dane['PrzyznanoSwiadczenieInne']
        ,'WysokoscSwiadczenia' => $dane['WysokoscSwiadczenia']
        ,'DataSwiadczeniaDo' => $dane['DataSwiadczeniaDo']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                'InneOdszkodowaniaId' => $inne_odszkodowania_id_tmp
            , 'DaneONiezdolnosciId' => $dane_o_niezdolnosci_id_tmp
            ), $element_id[2]
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_dochodzenie_roszczen':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }

        $umowa_tmp = $bazaDanych->pobierzDane('DochodzenieRoszczenId', 'umowaOsobowa','Id = '.$element_id[2]);

        if ($umowa_tmp) {
            $umowa_tmp = $umowa_tmp->fetch_object();

            if(isset($dane['ZleconoRoszczenia']) || isset($dane['NazwaPelnomocnika']) || isset($dane['DataZawarciaUmowy']) || isset($dane['WypowiedzenieUmowy']) || isset($dane['DataWypowiedzenia'])) {
                $dochodzenie_roszczen_tmp = $bazaDanych->pobierzDane('*','umowaDochodzenieRoszczen','Id='.$umowa_tmp->DochodzenieRoszczenId);
                $dochodzenie_roszczen_tmp = $dochodzenie_roszczen_tmp->fetch_object();

                $dane_roszczenia = array();

                if (isset($dane['ZleconoRoszczenia'])) {
                    $dane_roszczenia = array_merge($dane_roszczenia, array('ZleconoRoszczenia' => $dane['ZleconoRoszczenia']));
                    if ($dane['ZleconoRoszczenia'] != $dochodzenie_roszczen_tmp->ZleconoRoszczenia) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['NazwaPelnomocnika'])) {
                    $dane_roszczenia = array_merge($dane_roszczenia, array('NazwaPelnomocnika' => $dane['NazwaPelnomocnika']));
                    if ($dane['NazwaPelnomocnika'] != $dochodzenie_roszczen_tmp->NazwaPelnomocnika) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataZawarciaUmowy'])) {
                    $dane_roszczenia = array_merge($dane_roszczenia, array('DataZawarciaUmowy' => $dane['DataZawarciaUmowy']));
                    if ($dane['DataZawarciaUmowy'] != $dochodzenie_roszczen_tmp->DataZawarciaUmowy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WypowiedzenieUmowy'])) {
                    $dane_roszczenia = array_merge($dane_roszczenia, array('WypowiedzenieUmowy' => $dane['WypowiedzenieUmowy']));
                    if ($dane['WypowiedzenieUmowy'] != $dochodzenie_roszczen_tmp->WypowiedzenieUmowy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataWypowiedzenia'])) {
                    $dane_roszczenia = array_merge($dane_roszczenia, array('DataWypowiedzenia' => $dane['DataWypowiedzenia']));
                    if ($dane['DataWypowiedzenia'] != $dochodzenie_roszczen_tmp->DataWypowiedzenia) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                $bazaDanych->aktualizujDane('umowaDochodzenieRoszczen', $dane_roszczenia, $umowa_tmp->DochodzenieRoszczenId);

            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_inne_odszkodowania_oraz_dane_o_niezdolnosci':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }

        $inne_odszk_tmp = $bazaDanych->pobierzDane('InneOdszkodowaniaId', 'umowaOsobowa','Id = '.$element_id[2]);

        if ($inne_odszk_tmp) {
            $inne_odszk_tmp = $inne_odszk_tmp->fetch_object();

            if(isset($dane['ZgloszonoZNnw']) || isset($dane['NazwaUbezpieczycielaNnw']) || isset($dane['OkreslonoUszczerbekNnw']) || isset($dane['ProcentUszczerbkuNnw']) || isset($dane['JakiWypadek']) || isset($dane['ZgloszonoSzkode']) || isset($dane['GdzieZgloszono']) || isset($dane['GdzieZgloszonoInne']) || isset($dane['ProcentUszczerbku'])  || isset($dane['PrzyznanoOdszkodowanie']) || isset($dane['WysokoscOdszkodowania']) || isset($dane['ZasilekPogrzebowy'])) {
                $inne_odszkodowania_tmp = $bazaDanych->pobierzDane('*','umowaInneOdszkodowania','Id='.$inne_odszk_tmp->InneOdszkodowaniaId);
                $inne_odszkodowania_tmp = $inne_odszkodowania_tmp->fetch_object();

                $dane_inne_odszkodowania = array();

                if (isset($dane['ZgloszonoZNnw'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('ZgloszonoZNnw' => $dane['ZgloszonoZNnw']));
                    if ($dane['ZgloszonoZNnw'] != $inne_odszkodowania_tmp->ZgloszonoZNnw) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['NazwaUbezpieczycielaNnw'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('NazwaUbezpieczycielaNnw' => $dane['NazwaUbezpieczycielaNnw']));
                    if ($dane['NazwaUbezpieczycielaNnw'] != $inne_odszkodowania_tmp->NazwaUbezpieczycielaNnw) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['OkreslonoUszczerbekNnw'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('OkreslonoUszczerbekNnw' => $dane['OkreslonoUszczerbekNnw']));
                    if ($dane['OkreslonoUszczerbekNnw'] != $inne_odszkodowania_tmp->OkreslonoUszczerbekNnw) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['ProcentUszczerbkuNnw'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('ProcentUszczerbkuNnw' => $dane['ProcentUszczerbkuNnw']));
                    if ($dane['ProcentUszczerbkuNnw'] != $inne_odszkodowania_tmp->ProcentUszczerbkuNnw) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['JakiWypadek'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('JakiWypadek' => $dane['JakiWypadek']));
                    if ($dane['JakiWypadek'] != $inne_odszkodowania_tmp->JakiWypadek) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['ZgloszonoSzkode'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('ZgloszonoSzkode' => $dane['ZgloszonoSzkode']));
                    if ($dane['ZgloszonoSzkode'] != $inne_odszkodowania_tmp->ZgloszonoSzkode) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['GdzieZgloszono'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('GdzieZgloszono' => $dane['GdzieZgloszono']));
                    if ($dane['GdzieZgloszono'] != $inne_odszkodowania_tmp->GdzieZgloszono) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['GdzieZgloszonoInne'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('GdzieZgloszonoInne' => $dane['GdzieZgloszonoInne']));
                    if ($dane['GdzieZgloszonoInne'] != $inne_odszkodowania_tmp->GdzieZgloszonoInne) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['ProcentUszczerbku'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('ProcentUszczerbku' => $dane['ProcentUszczerbku']));
                    if ($dane['ProcentUszczerbku'] != $inne_odszkodowania_tmp->ProcentUszczerbku) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PrzyznanoOdszkodowanie'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('PrzyznanoOdszkodowanie' => $dane['PrzyznanoOdszkodowanie']));
                    if ($dane['PrzyznanoOdszkodowanie'] != $inne_odszkodowania_tmp->PrzyznanoOdszkodowanie) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WysokoscOdszkodowania'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('WysokoscOdszkodowania' => $dane['WysokoscOdszkodowania']));
                    if ($dane['WysokoscOdszkodowania'] != $inne_odszkodowania_tmp->WysokoscOdszkodowania) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['ZasilekPogrzebowy'])) {
                    $dane_inne_odszkodowania = array_merge($dane_inne_odszkodowania, array('ZasilekPogrzebowy' => $dane['ZasilekPogrzebowy']));
                    if ($dane['ZasilekPogrzebowy'] != $inne_odszkodowania_tmp->ZasilekPogrzebowy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                $bazaDanych->aktualizujDane('umowaInneOdszkodowania', $dane_inne_odszkodowania, $inne_odszk_tmp->InneOdszkodowaniaId);
            }
        }

        $dane_niezdolnosc_tmp = $bazaDanych->pobierzDane('DaneONiezdolnosciId', 'umowaOsobowa','Id = '.$element_id[2]);

        if ($dane_niezdolnosc_tmp) {
            $dane_niezdolnosc_tmp = $dane_niezdolnosc_tmp->fetch_object();

            if(isset($dane['ZwolnienieLekarskie']) || isset($dane['DataZwolnienieOd']) || isset($dane['DataZwolnieniaDo']) || isset($dane['OrzeczenieONiezdolnosci']) || isset($dane['TypNiezdolnosci']) || isset($dane['DataNiezdolnosciDo']) || isset($dane['UbezpieczycielNazwa']) || isset($dane['UbezpieczycielNazwaInne'])  || isset($dane['PrzyznanoSwiadczenie']) || isset($dane['PrzyznanoSwiadczenieInne']) || isset($dane['WysokoscSwiadczenia']) || isset($dane['DataSwiadczeniaDo'])) {
                $dane_o_niezdolnosci_tmp = $bazaDanych->pobierzDane('*','umowaInneOdszkodowania','Id='.$dane_niezdolnosc_tmp->DaneONiezdolnosciId);
                $dane_o_niezdolnosci_tmp = $dane_o_niezdolnosci_tmp->fetch_object();

                $dane_o_niezdolnosci = array();

                if (isset($dane['ZwolnienieLekarskie'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('ZwolnienieLekarskie' => $dane['ZwolnienieLekarskie']));
                    if ($dane['ZwolnienieLekarskie'] != $dane_o_niezdolnosci_tmp->ZwolnienieLekarskie) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataZwolnienieOd'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('DataZwolnienieOd' => $dane['DataZwolnienieOd']));
                    if ($dane['DataZwolnienieOd'] != $dane_o_niezdolnosci_tmp->DataZwolnienieOd) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataZwolnieniaDo'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('DataZwolnieniaDo' => $dane['DataZwolnieniaDo']));
                    if ($dane['DataZwolnieniaDo'] != $dane_o_niezdolnosci_tmp->DataZwolnieniaDo) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['OrzeczenieONiezdolnosci'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('OrzeczenieONiezdolnosci' => $dane['OrzeczenieONiezdolnosci']));
                    if ($dane['OrzeczenieONiezdolnosci'] != $dane_o_niezdolnosci_tmp->OrzeczenieONiezdolnosci) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['TypNiezdolnosci'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('TypNiezdolnosci' => $dane['TypNiezdolnosci']));
                    if ($dane['TypNiezdolnosci'] != $dane_o_niezdolnosci_tmp->TypNiezdolnosci) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataNiezdolnosciDo'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('DataNiezdolnosciDo' => $dane['DataNiezdolnosciDo']));
                    if ($dane['DataNiezdolnosciDo'] != $dane_o_niezdolnosci_tmp->DataNiezdolnosciDo) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['UbezpieczycielNazwa'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('UbezpieczycielNazwa' => $dane['UbezpieczycielNazwa']));
                    if ($dane['UbezpieczycielNazwa'] != $dane_o_niezdolnosci_tmp->UbezpieczycielNazwa) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['UbezpieczycielNazwaInne'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('UbezpieczycielNazwaInne' => $dane['UbezpieczycielNazwaInne']));
                    if ($dane['UbezpieczycielNazwaInne'] != $dane_o_niezdolnosci_tmp->UbezpieczycielNazwaInne) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PrzyznanoSwiadczenie'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('PrzyznanoSwiadczenie' => $dane['PrzyznanoSwiadczenie']));
                    if ($dane['PrzyznanoSwiadczenie'] != $dane_o_niezdolnosci_tmp->PrzyznanoSwiadczenie) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PrzyznanoSwiadczenieInne'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('PrzyznanoSwiadczenieInne' => $dane['PrzyznanoSwiadczenieInne']));
                    if ($dane['PrzyznanoSwiadczenieInne'] != $dane_o_niezdolnosci_tmp->PrzyznanoSwiadczenieInne) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WysokoscSwiadczenia'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('WysokoscSwiadczenia' => $dane['WysokoscSwiadczenia']));
                    if ($dane['WysokoscSwiadczenia'] != $dane_o_niezdolnosci_tmp->WysokoscSwiadczenia) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataSwiadczeniaDo'])) {
                    $dane_o_niezdolnosci = array_merge($dane_o_niezdolnosci, array('DataSwiadczeniaDo' => $dane['DataSwiadczeniaDo']));
                    if ($dane['DataSwiadczeniaDo'] != $dane_o_niezdolnosci_tmp->DataSwiadczeniaDo) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                $bazaDanych->aktualizujDane('umowaDaneONiezdolnosci', $dane_o_niezdolnosci, $dane_niezdolnosc_tmp->DaneONiezdolnosciId);
            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_pozostałe_informacje_o_ofe':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOfe','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $osoba_id_tmp = $umowa_tmp->OsobaZmarlyId;

        //$rachunek_tmp = $bazaDanych->pobierzDane('*','umowaRachunekBankowy','OsobaId='.$umowa_tmp->OsobaZmarlyId.' AND Typ = 3');
        //$rachunek_tmp = $rachunek_tmp->fetch_object();


        $umowa_id_tmp = $bazaDanych->aktualizujDane('umowaOfe', array(
            'CzyZmarlyWskazalOsoby' => $dane['CzyZmarlyWskazalOsoby']
        ,'CzyBylPosiadaczemRachunkuBankowego' => $dane['CzyBylPosiadaczemRachunkuBankowego']
        ), $element_id[2]);

        $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy',array(
            'Numer' => $dane['Numer']
        ,'OsobaId' => $osoba_id_tmp
        ,'Nazwa' => $dane['Nazwa']
        ,'Typ' => '3'
        ), 'OsobaId='.$osoba_id_tmp.' AND Typ = 3');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_urzad_skarbowy':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*', 'umowaRzeczowaOsoba', 'RzeczowaId=' . $element_id[2] . ' AND NrOsoby='.$dane['NrOsoby'].' AND OsobaTypId='.$dane['OsobaTypId']);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');
        if(is_null($adres_miasto_id_tmp)){
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        }else{
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres',array(
            'Ulica' => $dane['Ulica']
        ,'NrDomu' => $dane['NrDomu']
        ,'NrMieszkania' => $dane['NrMieszkania']
        ,'KodPocztowy' => $dane['KodPocztowy']
        ,'MiastoId' => $adres_miasto_id_tmp
        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $urzad_skarbowy_id_tmp = $bazaDanych->wstawDane('umowaUrzadSkarbowy',array(
            'Nazwa' => $dane['Nazwa']
        ,'AdresId' => $adres_id_tmp
        ));

        $bazaDanych->aktualizujDaneZWarunkiem('umowa'.mb_ucfirst($droga).'Osoba',
            array (
                'WielkoscUdzialu' => $dane['WielkoscUdzialu']
            ,'UrzadSkarbowyId' => $urzad_skarbowy_id_tmp
            ), 'OsobaId='.$umowa_tmp->OsobaId.' AND RzeczowaId=' . $element_id[2] . ' AND NrOsoby='.$dane['NrOsoby'].' AND OsobaTypId='.$dane['OsobaTypId']);


        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_oswiadczenie':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('OswiadczeniePoszkodowanegoId','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');
        if(is_null($adres_miasto_id_tmp)){
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        }else{
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres',array(
            'Ulica' => $dane['Ulica']
        ,'NrDomu' => $dane['NrDomu']
        ,'NrMieszkania' => $dane['NrMieszkania']
        ,'KodPocztowy' => $dane['KodPocztowy']
        ,'MiastoId' => $adres_miasto_id_tmp
        ));

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        , 'Nazwisko' => $dane['Nazwisko']
        , 'AdresId' => $adres_id_tmp
        , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie osoby', '', $osoba_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaOsoba_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaOsoba_historia_zmian');

        $oswiadczenie_id_tmp = $bazaDanych->wstawDane('umowaOswiadczenie', array(
            'Miejscowosc' => $dane['Miejscowosc']
        , 'Data' => $dane['Data']
        , 'OsobaId' => $osoba_id_tmp
        , 'Tresc' => $dane['Tresc']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                'OswiadczenieId' => $oswiadczenie_id_tmp
            ), $element_id[2]);


        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_oswiadczenie':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('OswiadczenieId','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $oswiadczenie_tmp = $bazaDanych->pobierzDane('*','umowaOswiadczenie','Id='.$umowa_tmp->OswiadczenieId);
        $oswiadczenie_tmp = $oswiadczenie_tmp->fetch_object();

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){

            $osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$oswiadczenie_tmp->OsobaId);
            $osoba_tmp = $osoba_tmp->fetch_object();

            $umowa_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$osoba_tmp->AdresId);
            $umowa_adres_tmp = $umowa_adres_tmp->fetch_object();

            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $oswiadczenie_tmp->OsobaId, 'umowaOsoba_id', 'Edycja Ulica', $umowa_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $oswiadczenie_tmp->OsobaId, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $oswiadczenie_tmp->OsobaId, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $oswiadczenie_tmp->OsobaId, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','Id = '.$umowa_adres_tmp->MiastoId);
                $umowa_adres_miasto_tmp = $umowa_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $oswiadczenie_tmp->OsobaId, 'umowaOsoba_id', 'Edycja Miasto', $umowa_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp), $osoba_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres', $dane_adres, $osoba_tmp->AdresId);

            //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_tmp->OsobaId, 'umowaOsoba_id', 'Edycja US', $UrzadSkarbowyId, $osoba_tmp->AdresId, 'umowaRzeczowaOsoba_historia_zmian');

        }


        if(isset($dane['Imie']) || isset($dane['Nazwisko'])) {
            if($dane['Imie'] != $osoba_tmp->Imie) {
                $bazaDanych->aktualizujDane('umowaOsoba',
                    array(
                        'Imie' => $dane['Imie']
                    ), $oswiadczenie_tmp->OsobaId);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $oswiadczenie_tmp->OsobaId, 'umowaOsoba_id', 'Edycja imienia osoby do oświadczenia', $osoba_tmp->Imie, $dane['Imie'], 'umowaOsoba_historia_zmian');
            }
            if($dane['Nazwisko'] != $osoba_tmp->Nazwisko) {
                $bazaDanych->aktualizujDane('umowaOsoba',
                    array(
                        'Nazwisko' => $dane['Nazwisko']
                    ), $oswiadczenie_tmp->OsobaId);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $oswiadczenie_tmp->OsobaId, 'umowaOsoba_id', 'Edycja nazwiska osoby do oświadczenia', $osoba_tmp->Nazwisko, $dane['Nazwisko'], 'umowaOsoba_historia_zmian');
            }

        }

        if(isset($dane['Miejscowosc']) || isset($dane['Data']) || isset($dane['Tresc'])) {
            if($dane['Miejscowosc'] != $umowa_tmp->Miejscowosc) {
                $bazaDanych->aktualizujDane('umowaOswiadczenie',
                    array(
                        'Miejscowosc' => $dane['Miejscowosc']
                    ), $umowa_tmp->OswiadczenieId);
                //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_tmp->OsobaId, 'umowaOsoba_id', 'Edycja Wysokości udziału', $umowa_tmp->WielkoscUdzialu, $dane['WielkoscUdzialu'], 'umowaRzeczowaOsoba_historia_zmian');
            }
            if($dane['Data'] != $umowa_tmp->Data) {
                $bazaDanych->aktualizujDane('umowaOswiadczenie',
                    array(
                        'Data' => $dane['Data']
                    ), $umowa_tmp->OswiadczenieId);
                //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_tmp->OsobaId, 'umowaOsoba_id', 'Edycja Wysokości udziału', $umowa_tmp->WielkoscUdzialu, $dane['WielkoscUdzialu'], 'umowaRzeczowaOsoba_historia_zmian');
            }
            if($dane['Tresc'] != $umowa_tmp->Tresc) {
                $bazaDanych->aktualizujDane('umowaOswiadczenie',
                    array(
                        'Tresc' => $dane['Tresc']
                    ), $umowa_tmp->OswiadczenieId);
                //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_tmp->OsobaId, 'umowaOsoba_id', 'Edycja Wysokości udziału', $umowa_tmp->WielkoscUdzialu, $dane['WielkoscUdzialu'], 'umowaRzeczowaOsoba_historia_zmian');
            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

/*    case 'dodaj_szpital':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('OswiadczeniePoszkodowanegoId', 'umowaOsobowa', 'Id=' . $element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $oswiadczenie_poszkodowanego_tmp = $bazaDanych->pobierzDane('PrzebiegLeczeniaId', 'umowaOswiadczeniePoszkodowanego', 'Id=' . $umowa_tmp->OswiadczeniePoszkodowanegoId);
        $oswiadczenie_poszkodowanego_tmp = $oswiadczenie_poszkodowanego_tmp->fetch_object();

        $przebieg_leczenia_id_tmp = $bazaDanych->wstawDane('umowaHospitalizacja',array(
            'Ulica' => $dane['Ulica']
        ,'NrDomu' => $dane['NrDomu']
        ,'NrMieszkania' => $dane['NrMieszkania']
        ,'KodPocztowy' => $dane['KodPocztowy']
        ,'MiastoId' => $adres_miasto_id_tmp
        )
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;*/

    case 'dodaj_zdarzenie':

        $element_id = explode('-', $element_id);

        if(!empty($dane['MarkaA']) || !empty($dane['ModelA']) || !empty($dane['NrRejestracyjnyA']) || !empty($dane['KrajRejestracjiA']) || !empty($dane['NumerPolisyA']) || !empty($dane['KierujacyPojazdemA']) || !empty($dane['PosiadaczPojazduA']) || !empty($dane['UbezpieczycielA']) || !empty($dane['SprawcaPojazdA'])) {
            $pojazd_a_id_tmp = $bazaDanych->wstawDane('umowaPojazd', array(
                'Marka' => $dane['MarkaA']
            , 'Model' => $dane['ModelA']
            , 'Typ' => $dane['TypA']
            , 'NrRejestracyjny' => $dane['NrRejestracyjnyA']
            , 'KrajRejestracji' => $dane['KrajRejestracjiA']
            , 'NumerPolisy' => $dane['NumerPolisyA']
            , 'KierujacyPojazdem' => $dane['KierujacyPojazdemA']
            , 'PosiadaczPojazdu' => $dane['PosiadaczPojazduA']
            , 'Ubezpieczyciel' => $dane['UbezpieczycielA']
            , 'SprawcaPojazd' => $dane['SprawcaPojazdA']
            ));
        }

        if(!empty($dane['MarkaB']) || !empty($dane['ModelB']) || !empty($dane['NrRejestracyjnyB']) || !empty($dane['KrajRejestracjiB']) || !empty($dane['NumerPolisyB']) || !empty($dane['KierujacyPojazdemB']) || !empty($dane['PosiadaczPojazduB']) || !empty($dane['UbezpieczycielB']) || !empty($dane['SprawcaPojazdB'])) {
            $pojazd_b_id_tmp = $bazaDanych->wstawDane('umowaPojazd', array(
                'Marka' => $dane['MarkaB']
            , 'Model' => $dane['ModelB']
            , 'Typ' => $dane['TypB']
            , 'NrRejestracyjny' => $dane['NrRejestracyjnyB']
            , 'KrajRejestracji' => $dane['KrajRejestracjiB']
            , 'NumerPolisy' => $dane['NumerPolisyB']
            , 'KierujacyPojazdem' => $dane['KierujacyPojazdemB']
            , 'PosiadaczPojazdu' => $dane['PosiadaczPojazduB']
            , 'Ubezpieczyciel' => $dane['UbezpieczycielB']
            , 'SprawcaPojazd' => $dane['SprawcaPojazdB']
            ));
        }

        $zdarzenie_id_tmp = $bazaDanych->wstawDane('umowaZdarzenie', array(
            'Miejscowosc' => $dane['Miejscowosc']
        , 'Data' => $dane['Data']
        , 'Godzina' => $dane['Godzina']
        , 'PojazdAId' => $pojazd_a_id_tmp
        , 'PojazdBId' => $pojazd_b_id_tmp
        , 'OpisZdarzenia' => $dane['OpisZdarzenia']
        , 'OpisObrazen' => $dane['OpisObrazen']
        ));

        $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
            'ZdarzenieId' => $zdarzenie_id_tmp
        ), $element_id[2]);

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_oswiadczenie_poszkodowanego':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $oswiadczenie_poszkodowanego_id_tmp = $bazaDanych->wstawDane('umowaOswiadczeniePoszkodowanego',array(
            'PodWplywem' => $dane['PodWplywem']
        ,'PodJakimWplywem' => $dane['PodJakimWplywem']
        ,'PieszyRowerzysta' => $dane['PieszyRowerzysta']
        ,'KierowcaPasazer' => $dane['KierowcaPasazer']
        ,'MiejsceGdzieSiedzial' => $dane['MiejsceGdzieSiedzial']
        ,'MiejsceGdzieSiedzialInne' => $dane['MiejsceGdzieSiedzialInne']
        ,'ZapietePasy' => $dane['ZapietePasy']
        ,'WlascicielWspolwlasciciel' => $dane['WlascicielWspolwlasciciel']
        ,'WiedzaCzyPodWplywem' => $dane['WiedzaCzyPodWplywem']
        ,'WiedzaOUprawnieniach' => $dane['WiedzaOUprawnieniach']
        ,'NastepstwaObrazen' => $dane['NastepstwaObrazen']
        ));


        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                'OswiadczeniePoszkodowanegoId' => $oswiadczenie_poszkodowanego_id_tmp
            ), $element_id[2]
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_oswiadczenie_uprawnionego':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $bazaDanych->aktualizujDane('umowaOsoba',
            array (
                'Wiek' => $dane['WiekPoszkodowany']
            , 'Wyksztalcenie' => $dane['WyksztalceniePoszkodowany']
            , 'ZawodWyuczony' => $dane['ZawodWyuczonyPoszkodowany']
            , 'ZawodWykonywany' => $dane['ZawodWykonywanyPoszkodowany']
            , 'DodatkoweUprawnienia' => $dane['DodatkoweUprawnieniaPoszkodowany']
            , 'Zatrudnienie' => $dane['ZatrudnieniePoszkodowany']
            , 'ZatrudnienieInne' => $dane['ZatrudnienieInnePoszkodowany']
            , 'Zarobki' => $dane['ZarobkiPoszkodowany']
            ), $umowa_tmp->OsobaPoszkodowanyId
        );

        $bazaDanych->aktualizujDane('umowaOsoba',
            array (
                'Wiek' => $dane['WiekUprawniony']
            , 'Wyksztalcenie' => $dane['WyksztalcenieUprawniony']
            , 'ZawodWyuczony' => $dane['ZawodWyuczonyUprawniony']
            , 'ZawodWykonywany' => $dane['ZawodWykonywanyUprawniony']
            , 'DodatkoweUprawnienia' => $dane['DodatkoweUprawnieniaUprawniony']
            , 'Zatrudnienie' => $dane['ZatrudnienieUprawniony']
            , 'ZatrudnienieInne' => $dane['ZatrudnienieInneUprawniony']
            , 'Zarobki' => $dane['ZarobkiUprawniony']
            ), $umowa_tmp->OsobaUprawnionyId
        );

        $stosunki_rodzinne_id_tmp = $bazaDanych->wstawDane('umowaStosunkiRodzinne',array(
            'PokrewienstwoZeZmarlym' => $dane['PokrewienstwoZeZmarlym']
        ,'PokrewienstwoInneZeZmarlym' => $dane['PokrewienstwoInneZeZmarlym']
        ,'WspolneGospodarstwo' => $dane['WspolneGospodarstwo']
        ,'TenSamAdres' => $dane['TenSamAdres']
        ,'InnyAdres' => $dane['InnyAdres']
        ,'PomagalWObowiazkach' => $dane['PomagalWObowiazkach']
        ,'StosunkiZeZmarlym' => $dane['StosunkiZeZmarlym']
        ,'BylNaUtrzymaniu' => $dane['BylNaUtrzymaniu']
        ,'LozylNaUtrzymanie' => $dane['LozylNaUtrzymanie']
        ,'WspolneKonto' => $dane['WspolneKonto']
        ,'PartycypowalKoszty' => $dane['PartycypowalKoszty']
        ,'WspieralbyFinansowo' => $dane['WspieralbyFinansowo']
        ));

        $sytuacja_po_smierci_id_tmp = $bazaDanych->wstawDane('umowaSytuacjaPoSmierci',array(
            'SytuacjaMaterialna' => $dane['SytuacjaMaterialna']
        ,'MotywacjaUprawnionego' => $dane['MotywacjaUprawnionego']
        ,'WstrzasPsychiczny' => $dane['WstrzasPsychiczny']
        ,'KorzystalZeSrodkow' => $dane['KorzystalZeSrodkow']
        ,'StanUleglPogorszeniu' => $dane['StanUleglPogorszeniu']
        ,'KorzystalZPorad' => $dane['KorzystalZPorad']
        ,'Porady' => $dane['Porady']
        ,'Wdowa' => $dane['Wdowa']
        ,'Dzieci' => $dane['Dzieci']
        ,'LiczbaDzieci' => $dane['LiczbaDzieci']
        ,'WiekDzieci' => $dane['WiekDzieci']
        ));

        $oswiadczenie_uprawnionego_id_tmp = $bazaDanych->wstawDane('umowaOswiadczenieUprawnionego',array(
            'PogorszenieSytuacjiZyciowej' => $dane['PogorszenieSytuacjiZyciowej']
        ,'WystapienieKrzywdy' => $dane['WystapienieKrzywdy']
        ,'WiekZmWMomencieSmierci' => $dane['WiekZmWMomencieSmierci']
        ,'WiekUprWMomencieSmierci' => $dane['WiekUprWMomencieSmierci']
        ));

        $bazaDanych->aktualizujDane('umowaOswiadczenieUprawnionego',
            array (
                'StosunkiRodzinneId' => $stosunki_rodzinne_id_tmp
            , 'SytuacjaPoSmierciId' => $sytuacja_po_smierci_id_tmp
            ), $oswiadczenie_uprawnionego_id_tmp
        );

        $bazaDanych->aktualizujDane('umowaOsobowa',
            array (
                'OswiadczenieUprawnionegoId' => $oswiadczenie_uprawnionego_id_tmp
            ), $element_id[2]
        );

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_oswiadczenie_poszkodowanego':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }

        $umowa_tmp = $bazaDanych->pobierzDane('OswiadczeniePoszkodowanegoId', 'umowaOsobowa','Id = '.$element_id[2]);

        if ($umowa_tmp) {
            $umowa_tmp = $umowa_tmp->fetch_object();

            if (
                isset($dane['PodWplywem']) ||
                isset($dane['PodJakimWplywem']) ||
                isset($dane['PieszyRowerzysta']) ||
                isset($dane['KierowcaPasazer']) ||
                isset($dane['MiejsceGdzieSiedzial']) ||
                isset($dane['MiejsceGdzieSiedzialInne']) ||
                isset($dane['ZapietePasy']) ||
                isset($dane['WlascicielWspolwlasciciel']) ||
                isset($dane['WiedzaCzyPodWplywem']) ||
                isset($dane['WiedzaOUprawnieniach']) ||
                isset($dane['NastepstwaObrazen'])
                ) {

                $oswiadczenie_poszkodowanego_tmp = $bazaDanych->pobierzDane('*','umowaOswiadczeniePoszkodowanego','Id='.$umowa_tmp->OswiadczeniePoszkodowanegoId);
                $oswiadczenie_poszkodowanego_tmp = $oswiadczenie_poszkodowanego_tmp->fetch_object();

                $dane_oswiadczenie = array();

                if (isset($dane['PodWplywem'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('PodWplywem' => $dane['PodWplywem']));
                    if ($dane['PodWplywem'] != $oswiadczenie_poszkodowanego_tmp->PodWplywem) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PodJakimWplywem'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('PodJakimWplywem' => $dane['PodJakimWplywem']));
                    if ($dane['PodJakimWplywem'] != $oswiadczenie_poszkodowanego_tmp->PodJakimWplywem) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PieszyRowerzysta'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('PieszyRowerzysta' => $dane['PieszyRowerzysta']));
                    if ($dane['PieszyRowerzysta'] != $oswiadczenie_poszkodowanego_tmp->PieszyRowerzysta) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['KierowcaPasazer'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('KierowcaPasazer' => $dane['KierowcaPasazer']));
                    if ($dane['KierowcaPasazer'] != $oswiadczenie_poszkodowanego_tmp->KierowcaPasazer) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['MiejsceGdzieSiedzial'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('MiejsceGdzieSiedzial' => $dane['MiejsceGdzieSiedzial']));
                    if ($dane['MiejsceGdzieSiedzial'] != $oswiadczenie_poszkodowanego_tmp->MiejsceGdzieSiedzial) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['MiejsceGdzieSiedzialInne'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('MiejsceGdzieSiedzialInne' => $dane['MiejsceGdzieSiedzialInne']));
                    if ($dane['MiejsceGdzieSiedzialInne'] != $oswiadczenie_poszkodowanego_tmp->MiejsceGdzieSiedzialInne) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['ZapietePasy'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('ZapietePasy' => $dane['ZapietePasy']));
                    if ($dane['ZapietePasy'] != $oswiadczenie_poszkodowanego_tmp->ZapietePasy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WlascicielWspolwlasciciel'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('WlascicielWspolwlasciciel' => $dane['WlascicielWspolwlasciciel']));
                    if ($dane['WlascicielWspolwlasciciel'] != $oswiadczenie_poszkodowanego_tmp->WlascicielWspolwlasciciel) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WiedzaCzyPodWplywem'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('WiedzaCzyPodWplywem' => $dane['WiedzaCzyPodWplywem']));
                    if ($dane['WiedzaCzyPodWplywem'] != $oswiadczenie_poszkodowanego_tmp->WiedzaCzyPodWplywem) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WiedzaOUprawnieniach'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('WiedzaOUprawnieniach' => $dane['WiedzaOUprawnieniach']));
                    if ($dane['WiedzaOUprawnieniach'] != $oswiadczenie_poszkodowanego_tmp->WiedzaOUprawnieniach) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['NastepstwaObrazen'])) {
                    $dane_oswiadczenie = array_merge($dane_oswiadczenie, array('NastepstwaObrazen' => $dane['NastepstwaObrazen']));
                    if ($dane['NastepstwaObrazen'] != $oswiadczenie_poszkodowanego_tmp->NastepstwaObrazen) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                $bazaDanych->aktualizujDane('umowaOswiadczeniePoszkodowanego', $dane_oswiadczenie, $umowa_tmp->OswiadczeniePoszkodowanegoId);

            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_odpowiedzialnosc_karna':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }

        $umowa_tmp = $bazaDanych->pobierzDane('OdpowiedzialnoscKarnaId', 'umowaOsobowa','Id = '.$element_id[2]);

        if ($umowa_tmp) {
            $umowa_tmp = $umowa_tmp->fetch_object();

            if(isset($dane['WezwanoPolicje']) || isset($dane['MiejscowoscPolicji']) || isset($dane['Sad']) || isset($dane['RodzajZakonczenia'])) {
                $odpowiedzialnosc_karna_tmp = $bazaDanych->pobierzDane('*','umowaOdpowiedzialnoscKarna','Id='.$umowa_tmp->OdpowiedzialnoscKarnaId);
                $odpowiedzialnosc_karna_tmp = $odpowiedzialnosc_karna_tmp->fetch_object();

                $dane_odpowiedzialnosc_karna = array();

                if (isset($dane['WezwanoPolicje'])) {
                    $dane_odpowiedzialnosc_karna = array_merge($dane_odpowiedzialnosc_karna, array('WezwanoPolicje' => $dane['WezwanoPolicje']));
                    if ($dane['WezwanoPolicje'] != $odpowiedzialnosc_karna_tmp->ZleconoRoszczenia) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['MiejscowoscPolicji'])) {
                    $dane_odpowiedzialnosc_karna = array_merge($dane_odpowiedzialnosc_karna, array('MiejscowoscPolicji' => $dane['MiejscowoscPolicji']));
                    if ($dane['MiejscowoscPolicji'] != $odpowiedzialnosc_karna_tmp->MiejscowoscPolicji) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Sad'])) {
                    $dane_odpowiedzialnosc_karna = array_merge($dane_odpowiedzialnosc_karna, array('Sad' => $dane['Sad']));
                    if ($dane['Sad'] != $odpowiedzialnosc_karna_tmp->Sad) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['RodzajZakonczenia'])) {
                    $dane_odpowiedzialnosc_karna = array_merge($dane_odpowiedzialnosc_karna, array('RodzajZakonczenia' => $dane['RodzajZakonczenia']));
                    if ($dane['RodzajZakonczenia'] != $odpowiedzialnosc_karna_tmp->RodzajZakonczenia) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                $bazaDanych->aktualizujDane('umowaOdpowiedzialnoscKarna', $dane_odpowiedzialnosc_karna, $umowa_tmp->OdpowiedzialnoscKarnaId);

            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_zgoda_na_postepowanie':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }

        $umowa_tmp = $bazaDanych->pobierzDane('ZgodaNaPostepowanieId', 'umowaOsobowa','Id = '.$element_id[2]);

        if ($umowa_tmp) {
            $umowa_tmp = $umowa_tmp->fetch_object();

            if(isset($dane['Zobowiazany']) || isset($dane['SygnaturaAkt']) || isset($dane['Sad']) || isset($dane['CzyToczonoPostepowanie']) || isset($dane['CzyZawartoUgode'])) {
                $postepowanie_tmp = $bazaDanych->pobierzDane('*','umowaZgodaNaPostepowanie','Id='.$umowa_tmp->ZgodaNaPostepowanieId);
                $postepowanie_tmp = $postepowanie_tmp->fetch_object();

                $dane_postepowanie = array();

                if (isset($dane['Zobowiazany'])) {
                    $dane_postepowanie = array_merge($dane_postepowanie, array('Zobowiazany' => $dane['Zobowiazany']));
                    if ($dane['Zobowiazany'] != $postepowanie_tmp->Zobowiazany) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['SygnaturaAkt'])) {
                    $dane_postepowanie = array_merge($dane_postepowanie, array('SygnaturaAkt' => $dane['SygnaturaAkt']));
                    if ($dane['SygnaturaAkt'] != $postepowanie_tmp->SygnaturaAkt) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Sad'])) {
                    $dane_postepowanie = array_merge($dane_postepowanie, array('Sad' => $dane['Sad']));
                    if ($dane['Sad'] != $postepowanie_tmp->Sad) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['CzyToczonoPostepowanie'])) {
                    $dane_postepowanie = array_merge($dane_postepowanie, array('CzyToczonoPostepowanie' => $dane['CzyToczonoPostepowanie']));
                    if ($dane['CzyToczonoPostepowanie'] != $postepowanie_tmp->CzyToczonoPostepowanie) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['CzyZawartoUgode'])) {
                    $dane_postepowanie = array_merge($dane_postepowanie, array('CzyZawartoUgode' => $dane['CzyZawartoUgode']));
                    if ($dane['CzyZawartoUgode'] != $postepowanie_tmp->CzyZawartoUgode) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                $bazaDanych->aktualizujDane('umowaZgodaNaPostepowanie', $dane_postepowanie, $umowa_tmp->ZgodaNaPostepowanieId);

            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_odpowiedzialnosc_cywilna':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }

        $umowa_tmp = $bazaDanych->pobierzDane('OdpowiedzialnoscCywilnaId', 'umowaOsobowa','Id = '.$element_id[2]);

        if ($umowa_tmp) {
            $umowa_tmp = $umowa_tmp->fetch_object();

            if(isset($dane['ZgloszonoPojazdZOc']) || isset($dane['ZgloszonoOsobeZOc']) || isset($dane['WyplaconoZOcSprawcy']) || isset($dane['KwotaOdszkodowania']) || isset($dane['PodstawaPrawna']) || isset($dane['DataWyroku'])) {
                $odpowiedzialnosc_cywilna_tmp = $bazaDanych->pobierzDane('*','umowaOdpowiedzialnoscCywilna','Id='.$umowa_tmp->OdpowiedzialnoscCywilnaId);
                $odpowiedzialnosc_cywilna_tmp = $odpowiedzialnosc_cywilna_tmp->fetch_object();

                $dane_odpowiedzialnosc_cywilna = array();

                if (isset($dane['ZgloszonoPojazdZOc'])) {
                    $dane_odpowiedzialnosc_cywilna = array_merge($dane_odpowiedzialnosc_cywilna, array('ZgloszonoPojazdZOc' => $dane['ZgloszonoPojazdZOc']));
                    if ($dane['ZgloszonoPojazdZOc'] != $odpowiedzialnosc_cywilna_tmp->ZgloszonoPojazdZOc) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                if (isset($dane['ZgloszonoOsobeZOc'])) {
                    $dane_odpowiedzialnosc_cywilna = array_merge($dane_odpowiedzialnosc_cywilna, array('ZgloszonoOsobeZOc' => $dane['ZgloszonoOsobeZOc']));
                    if ($dane['ZgloszonoOsobeZOc'] != $odpowiedzialnosc_cywilna_tmp->ZgloszonoOsobeZOc) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                if (isset($dane['WyplaconoZOcSprawcy'])) {
                    $dane_odpowiedzialnosc_cywilna = array_merge($dane_odpowiedzialnosc_cywilna, array('WyplaconoZOcSprawcy' => $dane['WyplaconoZOcSprawcy']));
                    if ($dane['WyplaconoZOcSprawcy'] != $odpowiedzialnosc_cywilna_tmp->WyplaconoZOcSprawcy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                if (isset($dane['KwotaOdszkodowania'])) {
                    $dane_odpowiedzialnosc_cywilna = array_merge($dane_odpowiedzialnosc_cywilna, array('KwotaOdszkodowania' => $dane['KwotaOdszkodowania']));
                    if ($dane['KwotaOdszkodowania'] != $odpowiedzialnosc_cywilna_tmp->KwotaOdszkodowania) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PodstawaPrawna'])) {
                    $dane_odpowiedzialnosc_cywilna = array_merge($dane_odpowiedzialnosc_cywilna, array('PodstawaPrawna' => $dane['PodstawaPrawna']));
                    if ($dane['PodstawaPrawna'] != $odpowiedzialnosc_cywilna_tmp->PodstawaPrawna) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DataWyroku'])) {
                    $dane_odpowiedzialnosc_cywilna = array_merge($dane_odpowiedzialnosc_cywilna, array('DataWyroku' => $dane['DataWyroku']));
                    if ($dane['DataWyroku'] != $odpowiedzialnosc_cywilna_tmp->DataWyroku) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                $bazaDanych->aktualizujDane('umowaOdpowiedzialnoscCywilna', $dane_odpowiedzialnosc_cywilna, $umowa_tmp->OdpowiedzialnoscCywilnaId);

            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_zdarzenie':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }

        $umowa_tmp = $bazaDanych->pobierzDane('ZdarzenieId', 'umowaOsobowa','Id = '.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $zdarzenie_tmp = $bazaDanych->pobierzDane('*', 'umowaZdarzenie','Id = '.$umowa_tmp->ZdarzenieId);
        $zdarzenie_tmp = $zdarzenie_tmp->fetch_object();


        if(isset($dane['MarkaA']) || isset($dane['ModelA']) || isset($dane['TypA']) || isset($dane['NrRejestracyjnyA']) || isset($dane['KrajRejestracjiA']) || isset($dane['NumerPolisyA']) || isset($dane['KierujacyPojazdemA']) || isset($dane['PosiadaczPojazduA']) || isset($dane['UbezpieczycielA']) || isset($dane['SprawcaPojazdA'])) {

            $umowa_pojazd_a_tmp = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id = ' . $zdarzenie_tmp->PojazdAId);

            if (!$umowa_pojazd_a_tmp) {

                //$umowa_pojazd_a_tmp = $umowa_pojazd_a_tmp->fetch_object();

                //$komunikat = $umowa_pojazd_a_tmp->Id;

                $pojazd_a_id_tmp = $bazaDanych->wstawDane('umowaPojazd', array(
                    'Marka' => $dane['MarkaA']
                , 'Model' => $dane['ModelA']
                , 'Typ' => $dane['TypA']
                , 'NrRejestracyjny' => $dane['NrRejestracyjnyA']
                , 'KrajRejestracji' => $dane['KrajRejestracjiA']
                , 'NumerPolisy' => $dane['NumerPolisyA']
                , 'KierujacyPojazdem' => $dane['KierujacyPojazdemA']
                , 'PosiadaczPojazdu' => $dane['PosiadaczPojazduA']
                , 'Ubezpieczyciel' => $dane['UbezpieczycielA']
                , 'SprawcaPojazd' => $dane['SprawcaPojazdA']
                ));

                $bazaDanych->aktualizujDane('umowaZdarzenie', array(
                    'PojazdAId' => $pojazd_a_id_tmp
                ), $umowa_tmp->ZdarzenieId);

            } else {

                $umowa_pojazd_a_tmp = $umowa_pojazd_a_tmp->fetch_object();

                $dane_pojazd_a = array();

                if (isset($dane['SprawcaPojazdA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('SprawcaPojazd' => $dane['SprawcaPojazdA']));
                    if ($dane['SprawcaPojazdA'] != $umowa_pojazd_a_tmp->SprawcaPojazd) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['MarkaA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('Marka' => $dane['MarkaA']));
                    if ($dane['MarkaA'] != $umowa_pojazd_a_tmp->Marka) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['ModelA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('Model' => $dane['ModelA']));
                    if ($dane['ModelA'] != $umowa_pojazd_a_tmp->Model) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['TypA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('Typ' => $dane['TypA']));
                    if ($dane['TypA'] != $umowa_pojazd_a_tmp->Typ) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['NrRejestracyjnyA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('NrRejestracyjny' => $dane['NrRejestracyjnyA']));
                    if ($dane['NrRejestracyjnyA'] != $umowa_pojazd_a_tmp->NrRejestracyjny) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['KrajRejestracjiA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('KrajRejestracji' => $dane['KrajRejestracjiA']));
                    if ($dane['KrajRejestracjiA'] != $umowa_pojazd_a_tmp->KrajRejestracji) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['NumerPolisyA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('NumerPolisy' => $dane['NumerPolisyA']));
                    if ($dane['NumerPolisyA'] != $umowa_pojazd_a_tmp->NumerPolisy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['KierujacyPojazdemA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('KierujacyPojazdem' => $dane['KierujacyPojazdemA']));
                    if ($dane['KierujacyPojazdemA'] != $umowa_pojazd_a_tmp->KierujacyPojazdem) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PosiadaczPojazduA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('PosiadaczPojazdu' => $dane['PosiadaczPojazduA']));
                    if ($dane['PosiadaczPojazduA'] != $umowa_pojazd_a_tmp->PosiadaczPojazdu) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['UbezpieczycielA'])) {
                    $dane_pojazd_a = array_merge($dane_pojazd_a, array('Ubezpieczyciel' => $dane['UbezpieczycielA']));
                    if ($dane['UbezpieczycielA'] != $umowa_pojazd_a_tmp->Ubezpieczyciel) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                $bazaDanych->aktualizujDane('umowaPojazd', $dane_pojazd_a, $zdarzenie_tmp->PojazdAId);
            }
        }

        if(isset($dane['MarkaB']) || isset($dane['ModelB'] )|| isset($dane['TypB']) || isset($dane['NrRejestracyjnyB']) || isset($dane['KrajRejestracjiB']) || isset($dane['NumerPolisyB']) || isset($dane['KierujacyPojazdemB']) || isset($dane['PosiadaczPojazduB']) || isset($dane['UbezpieczycielB']) || isset($dane['SprawcaPojazdB'])) {


            $umowa_pojazd_b_tmp = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id = ' . $zdarzenie_tmp->PojazdBId);
            if (!$umowa_pojazd_b_tmp) {

                //$umowa_pojazd_a_tmp = $umowa_pojazd_a_tmp->fetch_object();

                //$komunikat = $umowa_pojazd_a_tmp->Id;

                $pojazd_b_id_tmp = $bazaDanych->wstawDane('umowaPojazd', array(
                    'Marka' => $dane['MarkaB']
                , 'Model' => $dane['ModelB']
                , 'Typ' => $dane['TypB']
                , 'NrRejestracyjny' => $dane['NrRejestracyjnyB']
                , 'KrajRejestracji' => $dane['KrajRejestracjiB']
                , 'NumerPolisy' => $dane['NumerPolisyB']
                , 'KierujacyPojazdem' => $dane['KierujacyPojazdemB']
                , 'PosiadaczPojazdu' => $dane['PosiadaczPojazduB']
                , 'Ubezpieczyciel' => $dane['UbezpieczycielB']
                , 'SprawcaPojazd' => $dane['SprawcaPojazdB']
                ));

                $bazaDanych->aktualizujDane('umowaZdarzenie', array(
                    'PojazdBId' => $pojazd_b_id_tmp
                ), $umowa_tmp->ZdarzenieId);

            } else {

                $umowa_pojazd_b_tmp = $umowa_pojazd_b_tmp->fetch_object();

                $dane_pojazd_b = array();

                if (isset($dane['SprawcaPojazdB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('SprawcaPojazd' => $dane['SprawcaPojazdB']));
                    if ($dane['SprawcaPojazdB'] != $umowa_pojazd_b_tmp->SprawcaPojazd) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['MarkaB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('Marka' => $dane['MarkaB']));
                    if ($dane['MarkaB'] != $umowa_pojazd_b_tmp->Marka) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['ModelB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('Model' => $dane['ModelB']));
                    if ($dane['ModelB'] != $umowa_pojazd_b_tmp->Model) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['TypB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('Typ' => $dane['TypB']));
                    if ($dane['TypB'] != $umowa_pojazd_b_tmp->Typ) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['NrRejestracyjnyB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('NrRejestracyjny' => $dane['NrRejestracyjnyB']));
                    if ($dane['NrRejestracyjnyB'] != $umowa_pojazd_b_tmp->NrRejestracyjny) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['KrajRejestracjiB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('KrajRejestracji' => $dane['KrajRejestracjiB']));
                    if ($dane['KrajRejestracjiB'] != $umowa_pojazd_b_tmp->KrajRejestracji) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['NumerPolisyB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('NumerPolisy' => $dane['NumerPolisyB']));
                    if ($dane['NumerPolisyB'] != $umowa_pojazd_b_tmp->NumerPolisy) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['KierujacyPojazdemB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('KierujacyPojazdem' => $dane['KierujacyPojazdemB']));
                    if ($dane['KierujacyPojazdemB'] != $umowa_pojazd_b_tmp->KierujacyPojazdem) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PosiadaczPojazduB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('PosiadaczPojazdu' => $dane['PosiadaczPojazduB']));
                    if ($dane['PosiadaczPojazduB'] != $umowa_pojazd_b_tmp->PosiadaczPojazdu) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['UbezpieczycielB'])) {
                    $dane_pojazd_b = array_merge($dane_pojazd_b, array('Ubezpieczyciel' => $dane['UbezpieczycielB']));
                    if ($dane['UbezpieczycielA'] != $umowa_pojazd_b_tmp->Ubezpieczyciel) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
            }

            $bazaDanych->aktualizujDane('umowaPojazd', $dane_pojazd_b, $zdarzenie_tmp->PojazdBId);
        }


        if(isset($dane['Data']) || isset($dane['Miejscowosc']) || isset($dane['OpisZdarzenia']) || isset($dane['OpisObrazen']) || isset($dane['Godzina'])) {

            $dane_zdarzenie = array();

            if (isset($dane['Data'])) {
                $dane_zdarzenie = array_merge($dane_zdarzenie, array('Data' => $dane['Data']));
            }
            if (isset($dane['Miejscowosc'])) {
                $dane_zdarzenie = array_merge($dane_zdarzenie, array('Miejscowosc' => $dane['Miejscowosc']));
            }
            if (isset($dane['Godzina'])) {
                $dane_zdarzenie = array_merge($dane_zdarzenie, array('Godzina' => $dane['Godzina']));
            }
            if (isset($dane['OpisZdarzenia'])) {
                $dane_zdarzenie = array_merge($dane_zdarzenie, array('OpisZdarzenia' => $dane['OpisZdarzenia']));
            }
            if (isset($dane['OpisObrazen'])) {
                $dane_zdarzenie = array_merge($dane_zdarzenie, array('OpisObrazen' => $dane['OpisObrazen']));
            }
            if (isset($zdarzenie_tmp->PojazdAId)) {
                $dane_zdarzenie = array_merge($dane_zdarzenie, array('PojazdAId' => $zdarzenie_tmp->PojazdAId));
            }
            if (isset($zdarzenie_tmp->PojazdBId)) {
                $dane_zdarzenie = array_merge($dane_zdarzenie, array('PojazdBId' => $zdarzenie_tmp->PojazdBId));
            }


        }

        $bazaDanych->aktualizujDane('umowaZdarzenie', $dane_zdarzenie , $umowa_tmp->ZdarzenieId);

        //$przeladujSzczegolyElementu = 1;
        $komunikat = 'Zmiany zostały zapisane!!!';
        //$komunikat = $umowa_pojazd_a_tmp;
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_pozostałe_informacje_o_ofe':


        $element_id = explode('-',$element_id);
        $umowa_id = $element_id[2];

        $umowa_dane_tmp = $bazaDanych -> pobierzDane('*', 'umowa'.mb_ucfirst($droga), 'Id='.$umowa_id);

        $umowa_dane_tmp = $umowa_dane_tmp->fetch_object();

        if(isset($dane['CzyBylPosiadaczemRachunkuBankowego'])) {

            $bazaDanych->aktualizujDane('umowaOfe',
                array(
                    'CzyBylPosiadaczemRachunkuBankowego' => $dane['CzyBylPosiadaczemRachunkuBankowego']
                ), $umowa_id
            );

        }

        if(isset($dane['Numer'])) {

            $rachunek_tmp = $bazaDanych->pobierzDane('*', 'umowaRachunekBankowy', 'OsobaId=' . $umowa_dane_tmp->OsobaZmarlyId . ' AND Typ = 3');
            $rachunek_tmp = $rachunek_tmp->fetch_object();
            $RachunekId = $rachunek_tmp->Id;

            $bazaDanych->aktualizujDane('umowaRachunekBankowy',
                array(
                    'Numer' => $dane['Numer']
                ), $RachunekId
            );
        }

        if(isset($dane['Nazwa'])) {

            $rachunek_tmp = $bazaDanych->pobierzDane('*', 'umowaRachunekBankowy', 'OsobaId=' . $umowa_dane_tmp->OsobaZmarlyId . ' AND Typ = 3');
            $rachunek_tmp = $rachunek_tmp->fetch_object();
            $RachunekId = $rachunek_tmp->Id;

            $bazaDanych->aktualizujDane('umowaRachunekBankowy',
                array(
                    'Nazwa' => $dane['Nazwa']
                ), $RachunekId
            );
        }


        if(isset($dane['CzyZmarlyWskazalOsoby'])) {

            $bazaDanych->aktualizujDane('umowaOfe',
                array(
                    'CzyZmarlyWskazalOsoby' => $dane['CzyZmarlyWskazalOsoby']
                ), $umowa_id
            );

        }


        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_klienta':

        if($droga != ''){
            $element_id = explode('-',$element_id);
            $umowa_id =$element_id[2];
            $element_id = $element_id[1];
        }

        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$element_id);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

        if(isset($dane['Mail']) || isset($dane['Telefon'])){
            $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt','id = '.$umowa_osoba_tmp->KontaktId);
            $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();
            $dane_kontakt = array();

            if(isset($dane['Mail'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Mail' => $dane['Mail']));
                if($dane['Mail'] != $umowa_osoba_kontakt_tmp->Mail){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['Telefon'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Telefon' => $dane['Telefon']));
                if($dane['Telefon'] != $umowa_osoba_kontakt_tmp->Telefon){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    $przeladujWidokZakladki = 1;
                }
            }
            $bazaDanych->aktualizujDane('umowaKontakt',$dane_kontakt,$umowa_osoba_tmp->KontaktId);
        }

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$umowa_osoba_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres',$dane_adres,$umowa_osoba_tmp->AdresId);
        }

        unset($dane['Mail']);
        unset($dane['Telefon']);
        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);


        $dane['Dowod'] = strtoupper($dane['Dowod']);

        $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);
        $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

        if(array_key_exists('Imie',$dane) || array_key_exists('Nazwisko', $dane) || array_key_exists('Pesel', $dane)){
            $przeladujWidokZakladki = 1;
        }

        if($droga != ''){
            $tabela = 'umowa';
        }

        $przeladujSzczegolyElementu = 1;
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_klienta_osobowe':

        if($droga != ''){
            $element_id = explode('-',$element_id);
            $umowa_id =$element_id[2];
            $element_id = $element_id[1];
        }

        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$element_id);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();
        if(isset($dane['Wiek'])){
            $bazaDanych->aktualizujDane('umowaOsoba', array('Wiek' => $dane['Wiek']), $element_id);
        }

        if(isset($dane['Mail']) || isset($dane['Telefon'])){
            $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt','id = '.$umowa_osoba_tmp->KontaktId);
            $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();
            $dane_kontakt = array();

            if(isset($dane['Mail'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Mail' => $dane['Mail']));
                if($dane['Mail'] != $umowa_osoba_kontakt_tmp->Mail){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['Telefon'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Telefon' => $dane['Telefon']));
                if($dane['Telefon'] != $umowa_osoba_kontakt_tmp->Telefon){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    $przeladujWidokZakladki = 1;
                }
            }
            $bazaDanych->aktualizujDane('umowaKontakt',$dane_kontakt,$umowa_osoba_tmp->KontaktId);
        }
        if (isset($dane['Imie'])){
            $osoba_id_tmp = $bazaDanych->aktualizujDane('umowaOsoba', array(
                'Imie' => $dane['Imie']
            ),$umowa_osoba_tmp->Id);
        };
        if (isset($dane['Nazwisko'])){
            $osoba_id_tmp = $bazaDanych->aktualizujDane('umowaOsoba', array(
                'Nazwisko' => $dane['Nazwisko']
            ),$umowa_osoba_tmp->Id);
        };
        if (isset($dane['Pesel'])){
            $osoba_id_tmp = $bazaDanych->aktualizujDane('umowaOsoba', array(
                'Pesel' => $dane['Pesel']
            ),$umowa_osoba_tmp->Id);
        };
        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$umowa_osoba_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres',$dane_adres,$umowa_osoba_tmp->AdresId);
        }

        $umowa_osobowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa','Id = '.$umowa_id);
        $umowa_osobowa_tmp = $umowa_osobowa_tmp->fetch_object();

        $umowa_osoba_tel_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','Id = '.$umowa_osobowa_tmp->OsobaUprawnionyDoInfId);

        if($umowa_osoba_tel_tmp) {
            $umowa_osoba_tel_tmp = $umowa_osoba_tel_tmp->fetch_object();

            if (isset($dane['ImieTel'])) {
                $bazaDanych->aktualizujDane('umowaOsoba',
                    array('Imie' => $dane['ImieTel']), $umowa_osobowa_tmp->OsobaUprawnionyDoInfId
                );
            }
            if (isset($dane['NazwiskoTel'])) {
                $bazaDanych->aktualizujDane('umowaOsoba',
                    array('Nazwisko' => $dane['NazwiskoTel']), $umowa_osobowa_tmp->OsobaUprawnionyDoInfId
                );
            }
            if (isset($dane['PeselTel'])) {
                $bazaDanych->aktualizujDane('umowaOsoba',
                    array('Pesel' => $dane['PeselTel']), $umowa_osobowa_tmp->OsobaUprawnionyDoInfId
                );
            }
        } else {
            $osoba_id_tel_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
                'Imie' => $dane['ImieTel']
            ,'Nazwisko' => $dane['NazwiskoTel']
            ,'Pesel' => $dane['PeselTel']
            ,'PrzedstawicielId' => $_SESSION['uzytkownik_id']
            ,'OsobaTypId' => $dane['OsobaTypIdTel']
            ));


            $dodajOsobe = $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                'OsobaUprawnionyDoInfId' => $osoba_id_tel_tmp
            ), $umowa_id);

            $bazaDanych->wstawDane('umowa' . mb_ucfirst($droga).'Osoba', array(
                mb_ucfirst($droga).'Id' => $umowa_id
            , 'OsobaId' => $osoba_id_tel_tmp
            , 'TypOsoby' => $dane['OsobaTypIdTel']
            ));

        }



        $rachunek_bankowy_dane_tmp = $bazaDanych->pobierzDane('Numer, OsobaId, Typ', 'umowaRachunekBankowy', 'Id = '.$umowa_osobowa_tmp->RachunekBankowyId);
        $rachunek_bankowy_dane_tmp = $rachunek_bankowy_dane_tmp->fetch_object();

        if (isset($dane['OdbiorcaWynagrodzeniaKlient'])){

            if ($dane['OdbiorcaWynagrodzeniaKlient'] == 1) {

                $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                    'Numer' => $dane['Numer']
                , 'OsobaId' => $element_id
                ), $umowa_osobowa_tmp->RachunekBankowyId);

                $bazaDanych->aktualizujDane('umowaOsobowa', array(
                    'OdbiorcaId' => $element_id
                ), $umowa_id);

            } else {

                $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
                    'Imie' => $dane['ImieWynagrodzenie']
                , 'Nazwisko' => $dane['NazwiskoWynagrodzenie']
                , 'PrzedstawicielId' => $_SESSION['uzytkownik_id']
                , 'OsobaTypId' => '2'
                ));

                $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy', array(
                    'Numer' => $dane['Numer']
                , 'OsobaId' => $osoba_id_tmp
                , 'Typ' => '1'
                ));

                $bazaDanych->aktualizujDane('umowaOsobowa', array(
                    'SposobPlatnosciId' => '2'
                ,'RachunekBankowyId' => $rachunek_bankowy_id_tmp
                ,'OdbiorcaId' => $osoba_id_tmp
                ),$umowa_id);
            }

            $przeladujSzczegolyElementu = 1;

        } else {

            if(isset($dane['Numer'])) {
                $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                    'Numer' => $dane['Numer']
                ), $umowa_osobowa_tmp->RachunekBankowyId);
            }

            if (isset($dane['ImieWynagrodzenie']) || isset($dane['NazwiskoWynagrodzenie'])) {

                $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $umowa_osobowa_tmp->OdbiorcaId);
                $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

                if (isset($dane['ImieWynagrodzenie'])) {
                    if ($dane['ImieWynagrodzenie'] != $umowa_osoba_tmp->Imie) {
                        $bazaDanych->aktualizujDane('umowaOsoba', array('Imie' => $dane['ImieWynagrodzenie']), $umowa_osobowa_tmp->OdbiorcaId);
                    }
                }

                if (isset($dane['NazwiskoWynagrodzenie'])) {
                    if ($dane['NazwiskoWynagrodzenie'] != $umowa_osoba_tmp->Nazwisko) {
                        $bazaDanych->aktualizujDane('umowaOsoba', array('Nazwisko' => $dane['NazwiskoWynagrodzenie']), $umowa_osobowa_tmp->OdbiorcaId);
                    }
                }

                if (isset($dane['Numer'])) {
                    $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                        'OsobaId' => $umowa_osobowa_tmp->OdbiorcaId
                    ), $umowa_osobowa_tmp->RachunekBankowyId);

                    $bazaDanych->aktualizujDane($tabela, array(
                        'RachunekBankowyId' => $umowa_osobowa_tmp->RachunekBankowyId
                    ), $umowa_id);

                }
            }

            $przeladujSzczegolyElementu = 1;
        }

        unset($dane['ImieWynagrodzenie']);
        unset($dane['NazwiskoWynagrodzenie']);
        unset($dane['ImieTel']);
        unset($dane['NazwiskoTel']);
        unset($dane['PeselTel']);
        unset($dane['Mail']);
        unset($dane['Telefon']);
        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);


        $dane['Dowod'] = strtoupper($dane['Dowod']);

        $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);
        $bazaDanych->aktualizujDane($tabela, $dane, $element_id);


        if(array_key_exists('Imie',$dane) || array_key_exists('Nazwisko', $dane) || array_key_exists('Pesel', $dane)){
            $przeladujWidokZakladki = 1;
        }

        if($droga != ''){
            $tabela = 'umowa';
        }

        $przeladujSzczegolyElementu = 1;
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_przedmiot_umowy':

        if($droga != ''){
            $element_id = explode('-',$element_id);
        }
        $umowa_tmp = $bazaDanych->pobierzDane('*', 'umowaRzeczowa','Id = '.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $ubezpieczyciel_tmp = $bazaDanych->pobierzDane('*', 'umowaUbezpieczyciel','Id = '.$umowa_tmp->UbezpieczycielId);
        $ubezpieczyciel_tmp = $ubezpieczyciel_tmp->fetch_object();


        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$ubezpieczyciel_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$ubezpieczyciel_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres', $dane_adres, $ubezpieczyciel_tmp->AdresId);
        }

        if(isset($dane['Nazwa'])){
            if($dane['Nazwa'] != $ubezpieczyciel_tmp->Nazwa){
                $bazaDanych->aktualizujDane('umowaUbezpieczyciel', array('Nazwa' => $dane['Nazwa']),$ubezpieczyciel_tmp->Id);
            }
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $ubezpieczyciel_tmp->Id, 'umowaUbezpieczyciel_id', 'Edycja Nazwy Ubezpieczyciela', $ubezpieczyciel_tmp->Nazwa, $dane['Nazwa'], 'umowaUbezpieczyciel_historia_zmian');
        }


        if(isset($dane['Marka']) || isset($dane['Model']) || isset($dane['NrRejestracyjny'])){
            $umowa_pojazd_tmp = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id = ' . $umowa_tmp->PojazdId);
            $umowa_pojazd_tmp = $umowa_pojazd_tmp->fetch_object();
            $dane_auto = array();

            if(isset($dane['Marka'])){
                $dane_auto = array_merge($dane_auto, array('Marka' => $dane['Marka']));
                if($dane['Marka'] != $umowa_pojazd_tmp->Marka){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['Model'])){
                $dane_auto = array_merge($dane_auto, array('Model' => $dane['Model']));
                if($dane['Model'] != $umowa_pojazd_tmp->Model){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['NrRejestracyjny'])){
                $dane_auto = array_merge($dane_auto, array('NrRejestracyjny' => $dane['NrRejestracyjny']));
                if($dane['NrRejestracyjny'] != $umowa_pojazd_tmp->NrRejestracyjny){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                }
            }

            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_pojazd_tmp->Id, 'umowaPojazd_id', 'Edycja Marki pojazdu', $umowa_pojazd_tmp->Marka, $dane['Marka'], 'umowaPojazd_historia_zmian');
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_pojazd_tmp->Id, 'umowaPojazd_id', 'Edycja Modelu Pojazdu', $umowa_pojazd_tmp->Model, $dane['Model'], 'umowaPojazd_historia_zmian');
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_pojazd_tmp->Id, 'umowaPojazd_id', 'Edycja Numeru Rejestracyjnego', $umowa_pojazd_tmp->NrRejestracyjny, $dane['NrRejestracyjny'], 'umowaPojazd_historia_zmian');


            $bazaDanych->aktualizujDane('umowaPojazd', $dane_auto, $umowa_pojazd_tmp->Id);
        }

        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);
        unset($dane['Nazwa']);

        unset($dane['Marka']);
        unset($dane['Model']);
        unset($dane['NrRejestracyjny']);

        $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $element_id[2], $dane, $tabela);
        $bazaDanych->aktualizujDane($tabela, $dane, $element_id[2]);


        if($droga != ''){
            $tabela = 'umowa';
        }

        $przeladujSzczegolyElementu = 1;
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_firme':


        if($droga != ''){
            $element_id = explode('-',$element_id);
            $element_umowa_id = $element_id[2];
            $element_id = $element_id[1];
        }

        $umowaOsoba = $bazaDanych->pobierzDane('*', 'umowaRzeczowaOsoba', 'RzeczowaId=' . $element_umowa_id . ' AND NrOsoby='.$dane['NrOsoby']. ' AND OsobaTypId='.$dane['OsobaTypId']);
        $umowaOsoba = $umowaOsoba->fetch_object();



/*        if(isset($dane['UmowaTypKlientaId']) && $dane['UmowaTypKlientaId'] = '4') {
            $bazaDanych->aktualizujDane('umowaRzeczowaOsoba', array(
                'OsobaId' => '0'
            ), $element_umowa_id);
        }*/

        if(isset($dane['PelnomocnikKlienta'])) {
            $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                'PelnomocnikKlienta' => $dane['PelnomocnikKlienta']
            ), $element_umowa_id);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_umowa_id, 'umowaRzeczowa_id', 'Wprowadzenie Pelnomocnika', $umowaOsoba->PelnomocnikKlienta, $dane['PelnomocnikKlienta'], 'umowa' . mb_ucfirst($droga).'_historia_zmian');
        }

        unset($dane['PelnomocnikKlienta']);

        if(isset($dane['ReprezentantKlienta'])) {
            $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                'ReprezentantKlienta' => $dane['ReprezentantKlienta']
            ), $element_umowa_id);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_umowa_id, 'umowaRzeczowa_id', 'Wprowadzenie ReprezentantaKlienta', $umowaOsoba->ReprezentantKlienta, $dane['ReprezentantKlienta'], 'umowa' . mb_ucfirst($droga).'_historia_zmian');
        }

        unset($dane['ReprezentantKlienta']);

        if(isset($dane['UmowaTypKlientaId'])){
            $bazaDanych->aktualizujDane('umowa'.mb_ucfirst($droga), array(
                'UmowaTypKlientaId' => $dane['UmowaTypKlientaId']
            ), $element_umowa_id);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_umowa_id, 'umowaRzeczowa_id', 'Zmiana typu klienta', $umowaOsoba->UmowaTypKlientaId, $dane['UmowaTypKlientaId'], 'umowa' . mb_ucfirst($droga).'_historia_zmian');
        }
        unset($dane['UmowaTypKlientaId']);

        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$umowaOsoba->OsobaId);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

        if(isset($dane['Mail']) || isset($dane['Telefon'])){
            $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt','id = '.$umowa_osoba_tmp->KontaktId);
            $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();
            $dane_kontakt = array();

            if(isset($dane['Mail'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Mail' => $dane['Mail']));
                if($dane['Mail'] != $umowa_osoba_kontakt_tmp->Mail){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['Telefon'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Telefon' => $dane['Telefon']));
                if($dane['Telefon'] != $umowa_osoba_kontakt_tmp->Telefon){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    $przeladujWidokZakladki = 1;
                }
            }

            $bazaDanych->aktualizujDane('umowaKontakt',$dane_kontakt,$umowa_osoba_tmp->KontaktId);
        }

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$umowa_osoba_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres',$dane_adres,$umowa_osoba_tmp->AdresId);
        }


        unset($dane['Mail']);
        unset($dane['Telefon']);
        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);


        if(isset($dane['Krs'])) {
            $bazaDanych->aktualizujDane($tabela, array(
                'Krs' => $dane['Krs']
            ), $umowaOsoba->OsobaId);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja KRS', $umowaOsoba->Krs, $dane['Krs'], 'umowaOsoba_historia_zmian');
        };
        if(isset($dane['Nip'])) {
            $bazaDanych->aktualizujDane($tabela, array(
                'Nip' => $dane['Nip']
            ), $umowaOsoba->OsobaId);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja NIP', $umowaOsoba->Krs, $dane['Nip'], 'umowaOsoba_historia_zmian');
        };
        if(isset($dane['DataUrodzenia'])) {
            $bazaDanych->aktualizujDane($tabela, array(
                'DataUrodzenia' => $dane['DataUrodzenia']
            ), $umowaOsoba->OsobaId);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja DataUrodzenia', $umowaOsoba->DataUrodzenia, $dane['DataUrodzenia'], 'umowaOsoba_historia_zmian');
        };
        if(isset($dane['Dowod'])) {
            $dane['Dowod'] = strtoupper($dane['Dowod']);
            $bazaDanych->aktualizujDane($tabela, array(
                'Dowod' => $dane['Dowod']
            ), $umowaOsoba->OsobaId);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowaOsoba->OsobaId, 'umowaOsoba_id', 'Edycja Dowod', $umowaOsoba->Dowod, $dane['Dowod'], 'umowaOsoba_historia_zmian');
        };


        if(array_key_exists('Nazwa',$dane) ||array_key_exists('Imie',$dane) || array_key_exists('Nazwisko', $dane) || array_key_exists('Pesel', $dane)){
            $przeladujWidokZakladki = 1;
        }


        if($droga != ''){
            $tabela = 'umowa';
        }



        $przeladujSzczegolyElementu = 1;
        //$komunikat = print_r($dane);
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_dodatkowego_klienta':
        $element_id = explode('-',$element_id);
        $umowa_id = $element_id[0];
        $element_id = $element_id[1];

        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$element_id);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

        if(isset($dane['Mail']) || isset($dane['Telefon'])){
            $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt','id = '.$umowa_osoba_tmp->KontaktId);
            $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();
            $dane_kontakt = array();

            if(isset($dane['Mail'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Mail' => $dane['Mail']));
                if($dane['Mail'] != $umowa_osoba_kontakt_tmp->Mail){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');

                }
            }
            if(isset($dane['Telefon'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Telefon' => $dane['Telefon']));
                if($dane['Telefon'] != $umowa_osoba_kontakt_tmp->Telefon){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    $przeladujWidokZakladki = 1;
                }
            }

            $bazaDanych->aktualizujDane('umowaKontakt',$dane_kontakt,$umowa_osoba_tmp->KontaktId);
        }

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$umowa_osoba_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres',$dane_adres,$umowa_osoba_tmp->AdresId);
        }

        unset($dane['Mail']);
        unset($dane['Telefon']);
        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);

        $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);
        $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id, 'umowa_id', 'Edycja dodatkowy klient', '', $element_id, 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_wynagrodzenie':
        $element_id = explode('-',$element_id);
        $osoba_id_tmp = 0;
        $umowa_dane = $bazaDanych->pobierzDane('SposobPlatnosciId, RachunekBankowyId, OdbiorcaId', $tabela, 'Id = '.$element_id[2]);
        $umowa_dane = $umowa_dane->fetch_object();

        if($umowa_dane->SposobPlatnosciId == '1'){
            if(isset($dane['SposobPlatnosciId'])) {
                $rachunek_bankowy_id_tmp = $bazaDanych->wstawDane('umowaRachunekBankowy', array(
                    'Numer' => $dane['Numer']
                ,'OsobaId' => $umowa_dane->OdbiorcaId
                ));

                $bazaDanych->aktualizujDane($tabela, array(
                    'RachunekBankowyId' => $rachunek_bankowy_id_tmp
                ,'OdbiorcaId' => 'null'
                ,'SposobPlatnosciId' => $dane['SposobPlatnosciId']
                ), $element_id[2]);

                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela . '_id', 'Edycja RachunekBankowyId', '', $rachunek_bankowy_id_tmp, $tabela . '_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela . '_id', 'Edycja Numer', '', $dane['Numer'], $tabela . '_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja Numer ', '', $dane['Numer'], 'umowa_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela . '_id', 'Edycja SposobPlatnosciId', $umowa_dane->SposobPlatnosciId, $dane['SposobPlatnosciId'], $tabela . '_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela . '_id', 'Edycja OdbiorcaId', $umowa_dane->OdbiorcaId, '', $tabela . '_historia_zmian');

                //$przeladujSzczegolyElementu = 1;
            }

            $osoba_id_tmp = $umowa_dane->OdbiorcaId;
        }
        if($umowa_dane->SposobPlatnosciId == '2'){
            $rachunek_bankowy_dane_tmp = $bazaDanych->pobierzDane('Numer, OsobaId', 'umowaRachunekBankowy', 'Id = '.$umowa_dane->RachunekBankowyId);
            $rachunek_bankowy_dane_tmp = $rachunek_bankowy_dane_tmp->fetch_object();

/*            if(isset($dane['SposobPlatnosciId'])){
                $bazaDanych->deleteDane('umowaRachunekBankowy','Id = '.$umowa_dane->RachunekBankowyId);
                $bazaDanych->aktualizujDane($tabela, array(
                    'RachunekBankowyId' => 'null'
                ,'OdbiorcaId' => $rachunek_bankowy_dane_tmp->OsobaId
                ,'SposobPlatnosciId' => $dane['SposobPlatnosciId']
                ), $element_id[2]);

                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja Numer', $rachunek_bankowy_dane_tmp->Numer, '', $tabela.'_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja Numer', $rachunek_bankowy_dane_tmp->Numer, '', 'umowa_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja RachunekBankowyId', $umowa_dane->RachunekBankowyId, '', $tabela.'_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja SposobPlatnosciId', $umowa_dane->SposobPlatnosciId, $dane['SposobPlatnosciId'], $tabela.'_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja OdbiorcaId', '', $rachunek_bankowy_dane_tmp->OsobaId, $tabela.'_historia_zmian');

                $przeladujSzczegolyElementu = 1;
            }*/

            if(isset($dane['Numer'])){
                $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                    'Numer' => $dane['Numer']
                ), $umowa_dane->RachunekBankowyId);

                if(!isset($dane['SposobPlatnosciId'])) {
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela . '_id', 'Edycja Numer', $rachunek_bankowy_dane_tmp->Numer, $dane['Numer'], $tabela . '_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja Numer', $rachunek_bankowy_dane_tmp->Numer, $dane['Numer'], 'umowa_historia_zmian');

                }

                //$przeladujSzczegolyElementu = 1;
            }

            $osoba_id_tmp = $rachunek_bankowy_dane_tmp->OsobaId;

        }



        if(isset($dane['Imie']) || isset($dane['Nazwisko']) || isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])) {
            $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','Id = '.$osoba_id_tmp);
            $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

            if(isset($dane['Imie'])){
                if($dane['Imie'] != $umowa_osoba_tmp->Imie){
                    $bazaDanych->aktualizujDane('umowaOsoba', array('Imie' => $dane['Imie']), $osoba_id_tmp);
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Edycja od. wyn. Imie', $umowa_osoba_tmp->Imie, $dane['Imie'], 'umowaOsoba_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja od. wyn. Imie', $umowa_osoba_tmp->Imie, $dane['Imie'], $tabela.'_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja od. wyn. Imie', $umowa_osoba_tmp->Imie, $dane['Imie'], 'umowa_historia_zmian');

                    //$przeladujSzczegolyElementu = 1;
                }
            }

            if(isset($dane['Nazwisko'])){
                if($dane['Nazwisko'] != $umowa_osoba_tmp->Nazwisko){
                    $bazaDanych->aktualizujDane('umowaOsoba', array('Nazwisko' => $dane['Nazwisko']), $osoba_id_tmp);
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaOsoba_id', 'Edycja od. wyn. Nazwisko', $umowa_osoba_tmp->Nazwisko, $dane['Nazwisko'], 'umowaOsoba_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja od. wyn. Nazwisko', $umowa_osoba_tmp->Nazwisko, $dane['Nazwisko'], $tabela.'_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja od. wyn. Nazwisko', $umowa_osoba_tmp->Nazwisko, $dane['Nazwisko'], 'umowa_historia_zmian');

                    //$przeladujSzczegolyElementu = 1;
                }
            }

            if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
                $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','Id = '.$umowa_osoba_tmp->AdresId);
                $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

                if(isset($dane['Ulica'])){
                    if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                        $bazaDanych->aktualizujDane('umowaAdres', array('Ulica' => $dane['Ulica']), $umowa_osoba_tmp->AdresId);
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaAdres_id', 'Edycja od. wyn. Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja od. wyn. Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], $tabela.'_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja od. wyn. Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowa_historia_zmian');
                    }
                }

                if(isset($dane['NrDomu'])){
                    if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                        $bazaDanych->aktualizujDane('umowaAdres', array('NrDomu' => $dane['NrDomu']), $umowa_osoba_tmp->AdresId);
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaAdres_id', 'Edycja od. wyn. NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja od. wyn. NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], $tabela.'_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja od. wyn. NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowa_historia_zmian');
                    }
                }

                if(isset($dane['NrMieszkania'])){
                    if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                        $bazaDanych->aktualizujDane('umowaAdres', array('NrMieszkania' => $dane['NrMieszkania']), $umowa_osoba_tmp->AdresId);
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaAdres_id', 'Edycja od. wyn. NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja od. wyn. NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], $tabela.'_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja od. wyn. NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowa_historia_zmian');
                    }
                }

                if(isset($dane['KodPocztowy'])){
                    if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                        $bazaDanych->aktualizujDane('umowaAdres', array('KodPocztowy' => $dane['KodPocztowy']), $umowa_osoba_tmp->AdresId);
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $osoba_id_tmp, 'umowaAdres_id', 'Edycja od. wyn. KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja od. wyn. KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], $tabela.'_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja od. wyn. KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowa_historia_zmian');
                    }
                }

                if(isset($dane['Wartosc'])){
                    $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','Id = '.$umowa_osoba_adres_tmp->MiastoId);
                    $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                    if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){

                        $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                        if(is_null($miasto_id_tmp)){
                            $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                        }else{
                            $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                            $miasto_id_tmp = $miasto_id_tmp->Id;
                        }

                        $bazaDanych->aktualizujDane('umowaAdres', array('MiastoId' => $miasto_id_tmp), $umowa_osoba_tmp->AdresId);
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_tmp->MiastoId, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], $tabela.'_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->MiastoId, $miasto_id_tmp, $tabela.'_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja od. wyn. Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowa_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[1], 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                    }
                }
            }
        }

        //$przeladujSzczegolyElementu = 1;
        $element_id_out = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_strone_umowy':
        $element_id = explode('-',$element_id);
        $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $element_id[2], $dane, $tabela);
        $bazaDanych->aktualizujDane($tabela, $dane, $element_id[2]);

        $element_id_out = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];

        //$przeladujWidokZakladki = 1;
        //$przeladujSzczegolyElementu = 1;
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_pokrewienstwo':
        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('OswiadczenieUprawnionegoId', 'umowaOsobowa','Id = '.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        if ($umowa_tmp->OswiadczenieUprawnionegoId == NULL) {

            $id_oswiadczenia_uprawnionego = $bazaDanych->wstawDane('umowaOswiadczenieUprawnionego',array(
                'StopienPokrewienstwa' => $dane['StopienPokrewienstwa']
            ));

            $bazaDanych->aktualizujDane('umowaOsobowa', array (
                'OswiadczenieUprawnionegoId' => $id_oswiadczenia_uprawnionego
            ), $element_id[2]);
        } else {
            $bazaDanych->aktualizujDane('umowaOswiadczenieUprawnionego', array('StopienPokrewienstwa' => $dane['StopienPokrewienstwa']), $umowa_tmp->OswiadczenieUprawnionegoId);
        }

        //$drukiaMain->porownajZmianyDoHistorii($bazaDanych, $element_id[2], $dane, $tabela);
        //$bazaDanych->aktualizujDane('umowaOswiadczenieUprawnionego', array('StopienPokrewienstwa' => $dane['StopienPokrewienstwa']), $umowa_tmp->OswiadczenieUprawnionegoId);

        //$element_id_out = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];

        $komunikat = 'Zmiany zostały zapisane!!!';
        //$komunikat = $umowa_tmp->OswiadczenieUprawnionegoId;
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_dodatkowe_informacje':
        $element_id = explode('-',$element_id);

        if(isset($dane['ProcentWynagrodzenia'])){
            $ProcentWynagrodzenia_tmp = $bazaDanych->pobierzDane('ProcentWynagrodzenia','umowa'.mb_ucfirst($droga),'Id = '.$element_id[2]);
            $ProcentWynagrodzenia_tmp = $ProcentWynagrodzenia_tmp->fetch_object();

            if($dane['ProcentWynagrodzenia'] != $ProcentWynagrodzenia_tmp->ProcentWynagrodzenia){
                $bazaDanych->aktualizujDane('umowa'.mb_ucfirst($droga), array('ProcentWynagrodzenia' => $dane['ProcentWynagrodzenia']), $element_id[2]);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Edycja ProcentWynagrodzenia', $ProcentWynagrodzenia_tmp->ProcentWynagrodzenia, $dane['ProcentWynagrodzenia'], 'umowa'.mb_ucfirst($droga).'_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja ProcentWynagrodzenia', $ProcentWynagrodzenia_tmp->ProcentWynagrodzenia, $dane['ProcentWynagrodzenia'], 'umowa_historia_zmian');
            }
            unset($dane['ProcentWynagrodzenia']);
        }

        if(isset($dane['UmowaRzeczowaTypId'])){
            $UmowaRzeczowaTypId_tmp = $bazaDanych->pobierzDane('UmowaRzeczowaTypId','umowa'.mb_ucfirst($droga),'Id = '.$element_id[2]);
            $UmowaRzeczowaTypId_tmp = $UmowaRzeczowaTypId_tmp->fetch_object();

            if($dane['UmowaRzeczowaTypId'] != $UmowaRzeczowaTypId_tmp->UmowaRzeczowaTypId){
                $bazaDanych->aktualizujDane('umowa'.mb_ucfirst($droga), array('UmowaRzeczowaTypId' => $dane['UmowaRzeczowaTypId']), $element_id[2]);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Edycja UmowaRzeczowaTypId', $UmowaRzeczowaTypId_tmp->UmowaRzeczowaTypId, $dane['UmowaRzeczowaTypId'], 'umowa'.mb_ucfirst($droga).'_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja UmowaRzeczowaTypId', $UmowaRzeczowaTypId_tmp->UmowaRzeczowaTypId, $dane['UmowaRzeczowaTypId'], 'umowa_historia_zmian');
            }
            unset($dane['UmowaRzeczowaTypId']);

            //$bazaDanych->aktualizujDane('umowa',array('UmowaTypId' => '4' ),$umowa_id_tmp);
        }

        if(isset($dane['UmowaOsobowaTypId'])){
            $UmowaOsobowaTypId_tmp = $bazaDanych->pobierzDane('UmowaOsobowaTypId','umowa'.mb_ucfirst($droga),'Id = '.$element_id[2]);
            $UmowaOsobowaTypId_tmp = $UmowaOsobowaTypId_tmp->fetch_object();

            if($dane['UmowaOsobowaTypId'] != $UmowaOsobowaTypId_tmp->UmowaOsobowaTypId){
                $bazaDanych->aktualizujDane('umowa'.mb_ucfirst($droga), array('UmowaOsobowaTypId' => $dane['UmowaOsobowaTypId']), $element_id[2]);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Edycja UmowaOsobowaTypId', $UmowaOsobowaTypId_tmp->UmowaOsobowaTypId, $dane['UmowaOsobowaTypId'], 'umowa'.mb_ucfirst($droga).'_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja UmowaOsobowaTypId', $UmowaOsobowaTypId_tmp->UmowaOsobowaTypId, $dane['UmowaOsobowaTypId'], 'umowa_historia_zmian');
            }
            unset($dane['UmowaOsobowaTypId']);

        }


        $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $element_id[0], $dane, $tabela);

        $bazaDanych->aktualizujDane($tabela, $dane, $element_id[0]);

        $element_id_out = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];

        $przeladujSzczegolyElementu = 1;
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_adres_do_korespondencji_bankowa':

        $element_id = explode('-',$element_id);

        if(isset($dane['AdresKorJakZameldowania'])){
            $bazaDanych->aktualizujDane('umowaBankowa',array( 'AdresKorJakZameldowania' => $dane['AdresKorJakZameldowania']),$element_id[2]);

            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaBankowa_id', 'Edycja AdresKorJakZameldowania', ($dane['AdresKorJakZameldowania'] == 1) ? '0' : '1' , $dane['AdresKorJakZameldowania'] , 'umowaBankowa_historia_zmian');
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja AdresKorJakZameldowania', ($dane['AdresKorJakZameldowania'] == 1) ? '0' : '1' , $dane['AdresKorJakZameldowania'] , 'umowa_historia_zmian');
        }

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $adres_id_tmp = $bazaDanych->pobierzDane('AdresKorId','umowaBankowa','Id = '.$element_id[2]);
            $adres_id_tmp = $adres_id_tmp->fetch_object();
            $adres_id_tmp = $adres_id_tmp->AdresKorId;

            $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');
            if(is_null($adres_miasto_id_tmp)){
                $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array(
                    'Wartosc' => $dane['Wartosc']
                ));
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

            }else{
                $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
                $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
            }

            if(is_null($adres_id_tmp)){
                $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres',array(
                    'Ulica' => $dane['Ulica']
                ,'NrDomu' => $dane['NrDomu']
                ,'NrMieszkania' => $dane['NrMieszkania']
                ,'KodPocztowy' => $dane['KodPocztowy']
                ,'MiastoId' => $adres_miasto_id_tmp

                ));
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu do kor', '', $adres_id_tmp, 'umowaAdres_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaBankowa_id', 'Dodanie adresu do kor', '', $adres_id_tmp, 'umowaBankowa_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie adresu do kor', '', $adres_id_tmp, 'umowa_historia_zmian');

                $bazaDanych->aktualizujDane('umowaBankowa',array( 'AdresKorId' => $adres_id_tmp),$element_id[2]);
            }else{
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Edycja MiastoId', '', $adres_miasto_id_tmp, 'umowaAdres_historia_zmian');
                $bazaDanych->aktualizujDane('umowaAdres',array( 'MiastoId' => $adres_miasto_id_tmp),$adres_id_tmp);

                unset($dane['Wartosc']);

                $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $adres_id_tmp, $dane, 'umowaAdres');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaBankowa_id', 'Edycja adresu do kor', '', $adres_id_tmp, 'umowaBankowa_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja adresu do kor', '', $adres_id_tmp, 'umowa_historia_zmian');

                $bazaDanych->aktualizujDane('umowaAdres', $dane, $adres_id_tmp);
            }

        }

        $umowa_id_tmp = $bazaDanych->pobierzDane('OsobaUprawnionyDoInfId','umowaBankowa','Id = '.$element_id[2]);
        $umowa_id_tmp = $umowa_id_tmp->fetch_object();

        if(isset($dane['ImieTel']) || isset($dane['NazwiskoTel']) || isset($dane['OsobaTypIdTel']) || isset($dane['PeselTel'])) {
            $uprawniony_id_tmp = $bazaDanych->pobierzDane('Imie, Nazwisko, Pesel', 'umowaOsoba', 'Id = ' . $umowa_id_tmp->OsobaUprawnionyDoInfId);


            if ($uprawniony_id_tmp == NULL) {

                //$komunikat = $umowa_id_tmp->OsobaUprawnionyDoInfId.'0';
                $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
                    'Imie' => $dane['ImieTel']
                ,'Nazwisko' => $dane['NazwiskoTel']
                ,'Pesel' => $dane['PeselTel']
                ,'OsobaTypId' => $dane['OsobaTypIdTel']
                ));

                $bazaDanych->aktualizujDane('umowaBankowa',array('OsobaUprawnionyDoInfId' => $osoba_id_tmp),$element_id[2]);

            } else {

                //$komunikat = $umowa_id_tmp->OsobaUprawnionyDoInfId.'1';
                $uprawniony_id_tmp = $uprawniony_id_tmp->fetch_object();

                if(isset($dane['ImieTel'])) {
                    $bazaDanych->aktualizujDane('umowaOsoba',array(
                        'Imie' => $dane['ImieTel']
                    ), $umowa_id_tmp->OsobaUprawnionyDoInfId);
                }

                if(isset($dane['NazwiskoTel'])) {
                    $bazaDanych->aktualizujDane('umowaOsoba',array(
                        'Nazwisko' => $dane['NazwiskoTel']
                    ), $umowa_id_tmp->OsobaUprawnionyDoInfId);
                }

                if(isset($dane['PeselTel'])) {
                    $bazaDanych->aktualizujDane('umowaOsoba',array(
                        'Pesel' => $dane['PeselTel']
                    ), $umowa_id_tmp->OsobaUprawnionyDoInfId);
                }
            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        //$komunikat = $umowa_id_tmp->OsobaUprawnionyDoInfId;
        $rodzajOut = 'sukces';
        break;

    case 'usun_przywroc_element':
        $element_id = explode('-',$element_id);

        $nazwa_pliku = $bazaDanych->pobierzDane('ZalacznikPlikNazwa','umowaZalacznik','Id = '.$element_id[0]);
        $nazwa_pliku = $nazwa_pliku->fetch_object();

        $bazaDanych->usunDane($tabela,$element_id[0]);

        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowaZalacznik_id', 'Edycja czy_usuniety', '0', '1', 'umowaZalacznik_historia_zmian');
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[1], 'umowa_id', 'Usunięcie dokumentu', $nazwa_pliku->ZalacznikPlikNazwa, '', 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_dzialajacy_w_imieniu':

        $element_id = explode('-',$element_id);


            $dane_umowa_tmp = $bazaDanych->pobierzDane('UmowaDzialajacyWImieniuId, OsobaPoszkodowanyId', 'umowa'.mb_ucfirst($droga),'Id ='.$element_id[2] );
            $dane_umowa_tmp = $dane_umowa_tmp->fetch_object();

            $OsobaDzialajacyId = $dane_umowa_tmp->OsobaPoszkodowanyId;


        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$OsobaDzialajacyId);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

        if(isset($dane['Mail']) || isset($dane['Telefon'])){
            $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt','id = '.$umowa_osoba_tmp->KontaktId);
            $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();
            $dane_kontakt = array();

            if(isset($dane['Mail'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Mail' => $dane['Mail']));
                if($dane['Mail'] != $umowa_osoba_kontakt_tmp->Mail){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['Telefon'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Telefon' => $dane['Telefon']));
                if($dane['Telefon'] != $umowa_osoba_kontakt_tmp->Telefon){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    $przeladujWidokZakladki = 1;
                }
            }
            $bazaDanych->aktualizujDane('umowaKontakt', $dane_kontakt, $umowa_osoba_tmp->KontaktId);
        }

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$umowa_osoba_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres', $dane_adres, $umowa_osoba_tmp->AdresId);
        }


            if(isset($dane['UmowaDzialajacyWImieniuId'])) {
                if ($dane['UmowaDzialajacyWImieniuId'] != $dane_umowa_tmp->UmowaDzialajacyWImieniuId) {
                    $bazaDanych->aktualizujDane('umowa'.mb_ucfirst($droga), array(
                        'UmowaDzialajacyWImieniuId' => $dane['UmowaDzialajacyWImieniuId']
                    ), $element_id[2]);

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa' . mb_ucfirst($droga) . '_id', 'Edycja UmowaDzialajacyWImieniuId', $dane_umowa_tmp->UmowaDzialajacyWImieniuId, $dane['UmowaDzialajacyWImieniuId'], 'umowa' . mb_ucfirst($droga) . '_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja UmowaDzialajacyWImieniuId', $dane_umowa_tmp->UmowaDzialajacyWImieniuId, $dane['UmowaDzialajacyWImieniuId'], 'umowa_historia_zmian');

                    if ($dane['UmowaDzialajacyWImieniuId'] === '4') {
                        $bazaDanych->aktualizujDane('umowa'.mb_ucfirst($droga), array(
                            'OsobaPoszkodowanyId' => 'null'
                        ), $element_id[2]);

                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa' . mb_ucfirst($droga) . '_id', 'Edycja OsobaDzialajacyId', $dane_umowa_tmp->OsobaPoszkodowanyId, '', 'umowa' . mb_ucfirst($droga) . '_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Edycja OsobaDzialajacyId', $dane_umowa_tmp->OsobaPoszkodowanyId, '', 'umowa_historia_zmian');
                    }
                }
            }

        unset($dane['Mail']);
        unset($dane['Telefon']);
        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);


        $dane['Dowod'] = strtoupper($dane['Dowod']);

        $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $OsobaDzialajacyId, $dane, $tabela);
        $bazaDanych->aktualizujDane($tabela, $dane, $OsobaDzialajacyId);

        if(array_key_exists('Imie',$dane) || array_key_exists('Nazwisko', $dane) || array_key_exists('Pesel', $dane)){
            $przeladujWidokZakladki = 1;
        }

        if($droga != ''){
            $tabela = 'umowa';
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';

        break;

    case 'aktualizuj_uprawnionych':

        $element_id = explode('-',$element_id);


        $dane_umowa_tmp = $bazaDanych->pobierzDane('OsobaUprawnionyId, UmowaRodzajUprawnionegoId', 'umowa'.mb_ucfirst($droga),'Id ='.$element_id[2] );
        $dane_umowa_tmp = $dane_umowa_tmp->fetch_object();

        $OsobaUprawnionyId = $dane_umowa_tmp->OsobaUprawnionyId;

            $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $OsobaUprawnionyId);
            $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

            if(isset($dane['Wiek'])){
                $bazaDanych->aktualizujDane('umowaOsoba', array('Wiek' => $dane['Wiek']), $OsobaUprawnionyId);
            }

            if (isset($dane['Mail']) || isset($dane['Telefon'])) {
                $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'id = ' . $umowa_osoba_tmp->KontaktId);
                $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();
                $dane_kontakt = array();

                if (isset($dane['Mail'])) {
                    $dane_kontakt = array_merge($dane_kontakt, array('Mail' => $dane['Mail']));
                    if ($dane['Mail'] != $umowa_osoba_kontakt_tmp->Mail) {
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaUprawnionyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Telefon'])) {
                    $dane_kontakt = array_merge($dane_kontakt, array('Telefon' => $dane['Telefon']));
                    if ($dane['Telefon'] != $umowa_osoba_kontakt_tmp->Telefon) {
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaUprawnionyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                        $przeladujWidokZakladki = 1;
                    }
                }
                $bazaDanych->aktualizujDane('umowaKontakt', $dane_kontakt, $umowa_osoba_tmp->KontaktId);
            }

            if (isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])) {
                $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'id = ' . $umowa_osoba_tmp->AdresId);
                $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
                $dane_adres = array();

                if (isset($dane['Ulica'])) {
                    $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                    if ($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica) {
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaUprawnionyId, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                if (isset($dane['NrDomu'])) {
                    $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                    if ($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu) {
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaUprawnionyId, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                    }
                }

                if (isset($dane['NrMieszkania'])) {
                    $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                    if ($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania) {
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaUprawnionyId, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                    }
                }

                if (isset($dane['KodPocztowy'])) {
                    $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                    if ($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy) {
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaUprawnionyId, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                    }
                }

                if (isset($dane['Wartosc'])) {
                    $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'id = ' . $umowa_osoba_adres_tmp->MiastoId);
                    $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                    if ($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc) {
                        $miasto_id_tmp = $bazaDanych->pobierzDane('Id', 'umowaAdresMiasto', 'Wartosc = "' . $dane['Wartosc'] . '"');

                        if (is_null($miasto_id_tmp)) {
                            $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto', array('Wartosc' => $dane['Wartosc']));
                            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                        } else {
                            $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                            $miasto_id_tmp = $miasto_id_tmp->Id;
                        }

                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaUprawnionyId, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                    }
                    $bazaDanych->aktualizujDane('umowaAdres', array('MiastoId' => $miasto_id_tmp), $umowa_osoba_tmp->AdresId);
                }

                $bazaDanych->aktualizujDane('umowaAdres', $dane_adres, $umowa_osoba_tmp->AdresId);
            }

            unset($dane['Mail']);
            unset($dane['Telefon']);
            unset($dane['Ulica']);
            unset($dane['NrDomu']);
            unset($dane['NrMieszkania']);
            unset($dane['KodPocztowy']);
            unset($dane['Wartosc']);

        if (isset($dane['UmowaRodzajUprawnionegoId'])) {
            $bazaDanych->aktualizujDane('umowaOsobowa', array('UmowaRodzajUprawnionegoId' => $dane['UmowaRodzajUprawnionegoId']), $element_id[2]);
        }

            unset($dane['UmowaRodzajUprawnionegoId']);


            $dane['Dowod'] = strtoupper($dane['Dowod']);

            $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $OsobaUprawnionyId, $dane, $tabela);
            $bazaDanych->aktualizujDane($tabela, $dane, $OsobaUprawnionyId);


            if (array_key_exists('Imie', $dane) || array_key_exists('Nazwisko', $dane) || array_key_exists('Pesel', $dane)) {
                $przeladujWidokZakladki = 1;
            }


        if($droga != ''){
            $tabela = 'umowa';
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';

        break;

    case 'aktualizuj_posiadacza_rachunku_emerytalnego':

        $element_id = explode('-',$element_id);

        $umowa_umowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOfe','id = '.$element_id[2]);
        $umowa_umowa_tmp = $umowa_umowa_tmp->fetch_object();

        $OsobaZmarlyId = $umowa_umowa_tmp->OsobaZmarlyId;

        $umowa_zmarly_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$umowa_umowa_tmp->OsobaZmarlyId);
        $umowa_zmarly_tmp = $umowa_zmarly_tmp->fetch_object();

        $dane_kontakt = array();
        $bazaDanych->aktualizujDane('umowaKontakt',$dane_kontakt,$umowa_osoba_tmp->KontaktId);


        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_zmarly_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$umowa_zmarly_tmp->AdresId);
            $umowa_zmarly_adres_tmp = $umowa_zmarly_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_zmarly_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_zmarly_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_zmarly_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_zmarly_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_zmarly_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_zmarly_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_zmarly_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_zmarly_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_zmarly_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_zmarly_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_zmarly_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_zmarly_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_zmarly_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_zmarly_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_zmarly_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_zmarly_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_zmarly_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_zmarly_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$umowa_zmarly_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres', $dane_adres, $umowa_zmarly_tmp->AdresId);
        }

        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);

        $dane['Dowod'] = strtoupper($dane['Dowod']);

        $umowa_rachunek_tmp = $bazaDanych->pobierzDane('*', 'umowaRachunekBankowy', "OsobaId=".$OsobaZmarlyId." AND Typ=2");
        $umowa_rachunek_tmp = $umowa_rachunek_tmp->fetch_object();

        if(isset($dane['Numer'])) {
            if ($dane['Numer'] != $umowa_rachunek_tmp->Numer) {
                $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                    'Numer' => $dane['Numer']
                ), $umowa_rachunek_tmp->Id);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_rachunek_tmp->Id, 'umowaRachunekBankowy_id', 'Edycja Numeru Rachunku Emerytalnego', $umowa_rachunek_tmp->Numer,  $dane['Numer'], 'umowaRachunekBankowy_historia_zmian');
            }
        }
        if(isset($dane['Nazwa'])) {
            if ($dane['Nazwa'] != $umowa_rachunek_tmp->Nazwa) {
                $bazaDanych->aktualizujDane('umowaRachunekBankowy', array(
                    'Nazwa' => $dane['Nazwa']
                ), $umowa_rachunek_tmp->Id);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_rachunek_tmp->Id, 'umowaRachunekBankowy_id', 'Edycja Nazwy', $umowa_rachunek_tmp->Nazwa, $dane['Nazwa'], 'umowaRachunekBankowy_historia_zmian');
            }
        }

        unset($dane['Numer']);
        unset($dane['Nazwa']);

        if(isset($dane['DataSmierci'])) {
            if ($dane['DataSmierci'] != $umowa_umowa_tmp->DataSmierci) {
                $bazaDanych->aktualizujDane('umowaOfe', array(
                    'DataSmierci' => $dane['DataSmierci']
                ), $element_id[2]);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaOfe_id', 'Edycja Daty Smierci', $umowa_umowa_tmp->DataSmierci, $dane['DataSmierci'], 'umowaOfe_historia_zmian');
            }
        }
        if(isset($dane['Pokrewienstwo'])) {
            if ($dane['Pokrewienstwo'] != $umowa_umowa_tmp->Pokrewienstwo) {
                $bazaDanych->aktualizujDane('umowaOfe', array(
                    'Pokrewienstwo' => $dane['Pokrewienstwo']
                ), $element_id[2]);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaOfe_id', 'Edycja Pokrewienstwa', $umowa_umowa_tmp->Pokrewienstwo, $dane['Pokrewienstwo'], 'umowaOfe_historia_zmian');
            }
        }

        $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $OsobaZmarlyId, $dane, $tabela);
        //$bazaDanych->aktualizujDane($tabela, $dane, $OsobaZmarlyId);

        if(array_key_exists('Imie',$dane) || array_key_exists('Nazwisko', $dane) || array_key_exists('Pesel', $dane)){
            $przeladujWidokZakladki = 1;
        }

        if($droga != ''){
            $tabela = 'umowa';
        }

        $przeladujSzczegolyElementu = 1;
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_urzad_skarbowy':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*', 'umowaRzeczowaOsoba', 'RzeczowaId=' . $element_id[2] . ' AND NrOsoby='.$dane['NrOsoby'].' AND OsobaTypId='.$dane['OsobaTypId']);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $UrzadSkarbowyId = $umowa_tmp->UrzadSkarbowyId;

        $urzad_tmp = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy','Id = '.$UrzadSkarbowyId);
        $urzad_tmp = $urzad_tmp->fetch_object();

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$urzad_tmp->AdresId);
            $umowa_adres_tmp = $umowa_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $urzad_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $urzad_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $urzad_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $urzad_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','Id = '.$umowa_adres_tmp->MiastoId);
                $umowa_adres_miasto_tmp = $umowa_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $urzad_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Miasto', $umowa_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp), $urzad_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres', $dane_adres, $urzad_tmp->AdresId);
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_tmp->OsobaId, 'umowaOsoba_id', 'Edycja US', $UrzadSkarbowyId, $urzad_tmp->AdresId, 'umowaRzeczowaOsoba_historia_zmian');

        }


        if(isset($dane['Nazwa'])) {
            if($dane['Nazwa'] != $urzad_tmp->Nazwa) {
                $bazaDanych->aktualizujDane('umowaUrzadSkarbowy',
                    array(
                        'Nazwa' => $dane['Nazwa']
                    ), $UrzadSkarbowyId);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $UrzadSkarbowyId, 'umowaUrzadSkarbowy_id', 'Edycja Nazwy US', $urzad_tmp->Nazwa, $dane['Nazwa'], 'umowaUrzadSkarbowy_historia_zmian');
            }
        }

        if(isset($dane['WielkoscUdzialu'])) {
            if($dane['WielkoscUdzialu'] != $umowa_tmp->WielkoscUdzialu) {
                $bazaDanych->aktualizujDaneZWarunkiem('umowaRzeczowaOsoba',
                    array(
                        'WielkoscUdzialu' => $dane['WielkoscUdzialu']
                    ), 'OsobaId='.$umowa_tmp->OsobaId);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_tmp->OsobaId, 'umowaOsoba_id', 'Edycja Wysokości udziału', $umowa_tmp->WielkoscUdzialu, $dane['WielkoscUdzialu'], 'umowaRzeczowaOsoba_historia_zmian');
            }
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'usun_firme_urzad':
        $element_id = explode('-',$element_id);

        if(isset($dane['PelnomocnikKlienta'])) {
            $bazaDanych->deleteDane('umowaRzeczowaOsoba', 'RzeczowaId=' . $element_id[2] . ' AND NrOsoby=1 AND OsobaTypId=5');
            $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                'PelnomocnikKlienta' => 0
            ), $element_id[2]);
            //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_tmp->OsobaId, 'umowaOsoba_id', 'Edycja US', $umowa_tmp->WielkoscUdzialu, $dane['WielkoscUdzialu'], 'umowaRzeczowaOsoba_historia_zmian');
        }

        if(isset($dane['ReprezentantKlienta'])) {
            $bazaDanych->deleteDane('umowaRzeczowaOsoba', 'RzeczowaId=' . $element_id[2] . ' AND NrOsoby=1 AND OsobaTypId=6');
            $bazaDanych->aktualizujDane('umowa' . mb_ucfirst($droga), array(
                'ReprezentantKlienta' => 0
            ), $element_id[2]);
            //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowaRzeczowa_id', 'Usuniecie ReprezentantaKlienta', $umowaOsoba->ReprezentantKlienta, $dane['ReprezentantKlienta'], 'umowa' . mb_ucfirst($droga).'_historia_zmian');
        }

        //$komunikat = $element_id[2];
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_oswiadczenie_uprawnionego':

        $element_id = explode('-', $element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa','UmowaId = '.$element_id[0]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $SytuacjaPoSmierci_id = $bazaDanych->wstawDane('umowaOswiadczenieUprawnionego', array(
            'SytuacjaMaterialna' => $dane['SytuacjaMaterialna']
        , 'MotywacjaUprawnionego' => $dane['MotywacjaUprawnionego']
        , 'WstrzasPsychiczny' => $dane['WstrzasPsychiczny']
        , 'KorzystalZeSrodkow' => $dane['KodPocztowy']
        , 'StanUleglPogorszeniu' => $dane['StanUleglPogorszeniu']
        , 'KorzystalZPorad' => $dane['KorzystalZPorad']
        , 'Porady' => $dane['Porady']
        , 'Wdowa' => $dane['Wdowa']
        , 'Dzieci' => $dane['Dzieci']
        , 'LiczbaDzieci' => $dane['LiczbaDzieci']
        , 'WiekDzieci' => $dane['WiekDzieci']
        ));

        $StosunkiRodzinne_id = $bazaDanych->wstawDane('umowaStosunkiRodzinne', array(
            'PokrewienstwoZeZmarlym' => $dane['PokrewienstwoZeZmarlym']
        , 'PokrewienstwoInneZeZmarlym' => $dane['PokrewienstwoInneZeZmarlym']
        , 'WspolneGospodarstwo' => $dane['WspolneGospodarstwo']
        , 'TenSamAdres' => $dane['TenSamAdres']
        , 'InnyAdres' => $dane['InnyAdres']
        , 'PomagalWObowiazkach' => $dane['PomagalWObowiazkach']
        , 'StosunkiZeZmarlym' => $dane['StosunkiZeZmarlym']
        , 'BylNaUtrzymaniu' => $dane['BylNaUtrzymaniu']
        , 'LozylNaUtrzymanie' => $dane['LozylNaUtrzymanie']
        , 'WspolneKonto' => $dane['WspolneKonto']
        , 'PartycypowalKoszty' => $dane['PartycypowalKoszty']
        , 'WspieralbyFinansowo' => $dane['WspieralbyFinansowo']
        ));

        $OswiadczenieUprawnionego_id = $bazaDanych->wstawDane('umowaOswiadczenieUprawnionego', array(
            'PogorszenieSytuacjiZyciowej' => $dane['PogorszenieSytuacjiZyciowej']
        , 'WystapienieKrzywdy' => $dane['WystapienieKrzywdy']
        , 'WiekZmWMomencieSmierci' => $dane['WiekZmWMomencieSmierci']
        , 'WiekUprWMomencieSmierci' => $dane['WiekUprWMomencieSmierci']
        , 'StosunkiRodzinneId' => $SytuacjaPoSmierci_id
        , 'SytuacjaPoSmierciId' => $StosunkiRodzinne_id
        ));

        $bazaDanych->aktualizujDane('umowaOsoba', array(
            'Wyksztalcenie' => $dane['ZmarlyWyksztalcenie']
        , 'ZawodWyuczony' => $dane['ZmarlyZawodWyuczony']
        , 'ZawodWykonywany' => $dane['ZmarlyZawodWykonywany']
        , 'DodatkoweUprawnienia' => $dane['ZmarlyDodatkoweUprawnienia']
        , 'Zatrudnienie' => $dane['ZmarlyZatrudnienie']
        , 'ZatrudnienieInne' => $dane['ZmarlyZatrudnienieInne']
        , 'Zarobki' => $dane['ZmarlyZarobki']
        ), $umowa_tmp->OsobaPoszkodowanyId);

        $bazaDanych->aktualizujDane('umowaOsoba', array(
            'Wyksztalcenie' => $dane['UprawnionyWyksztalcenie']
        , 'ZawodWyuczony' => $dane['UprawnionyZawodWyuczony']
        , 'ZawodWykonywany' => $dane['UprawnionyZawodWykonywany']
        , 'DodatkoweUprawnienia' => $dane['UprawnionyDodatkoweUprawnienia']
        , 'Zatrudnienie' => $dane['UprawnionyZatrudnienie']
        , 'ZatrudnienieInne' => $dane['UprawnionyZatrudnienieInne']
        , 'Zarobki' => $dane['UprawnionyZarobki']
        ), $umowa_tmp->OsobaUprawnionyId);


        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_oswiadczenie_uprawnionego':

        $element_id = explode('-', $element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa','UmowaId = '.$element_id[0]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $OswiadczenieUprawnionego = $bazaDanych->pobierzDane('*', 'umowaOswiadczenieUprawnionego','Id = '.$umowa_tmp->OswiadczenieUprawnionegoId);
        $OswiadczenieUprawnionego = $OswiadczenieUprawnionego->fetch_object();

        if(isset($dane['SytuacjaMaterialna']) || isset($dane['MotywacjaUprawnionego']) || isset($dane['WstrzasPsychiczny']) || isset($dane['KorzystalZeSrodkow']) || isset($dane['StanUleglPogorszeniu']) || isset($dane['KorzystalZPorad']) || isset($dane['Porady']) || isset($dane['Wdowa']) || isset($dane['Dzieci']) || isset($dane['LiczbaDzieci']) || isset($dane['WiekDzieci'])){
            $SytuacjaPoSmierci = $bazaDanych->pobierzDane('*', 'umowaSytuacjaPoSmierci','Id = '.$OswiadczenieUprawnionego->SytuacjaPoSmierciId);
            $SytuacjaPoSmierci = $SytuacjaPoSmierci->fetch_object();
            $dane_sytuacja_po_smierci = array();

            if(isset($dane['SytuacjaMaterialna'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('SytuacjaMaterialna' => $dane['SytuacjaMaterialna']));
                if($dane['SytuacjaMaterialna'] != $SytuacjaPoSmierci->SytuacjaMaterialna){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['MotywacjaUprawnionego'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('MotywacjaUprawnionego' => $dane['MotywacjaUprawnionego']));
                if($dane['MotywacjaUprawnionego'] != $SytuacjaPoSmierci->MotywacjaUprawnionego){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['WstrzasPsychiczny'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('WstrzasPsychiczny' => $dane['WstrzasPsychiczny']));
                if($dane['WstrzasPsychiczny'] != $SytuacjaPoSmierci->WstrzasPsychiczny){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['KorzystalZeSrodkow'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('KorzystalZeSrodkow' => $dane['KorzystalZeSrodkow']));
                if($dane['KorzystalZeSrodkow'] != $SytuacjaPoSmierci->KorzystalZeSrodkow){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['StanUleglPogorszeniu'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('StanUleglPogorszeniu' => $dane['StanUleglPogorszeniu']));
                if($dane['StanUleglPogorszeniu'] != $SytuacjaPoSmierci->StanUleglPogorszeniu){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['KorzystalZPorad'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('KorzystalZPorad' => $dane['KorzystalZPorad']));
                if($dane['KorzystalZPorad'] != $SytuacjaPoSmierci->KorzystalZPorad){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['Porady'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('Porady' => $dane['Porady']));
                if($dane['Porady'] != $SytuacjaPoSmierci->Porady){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['Wdowa'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('Wdowa' => $dane['Wdowa']));
                if($dane['Wdowa'] != $SytuacjaPoSmierci->Wdowa){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['Dzieci'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('Dzieci' => $dane['Dzieci']));
                if($dane['Dzieci'] != $SytuacjaPoSmierci->Dzieci){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['LiczbaDzieci'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('LiczbaDzieci' => $dane['LiczbaDzieci']));
                if($dane['LiczbaDzieci'] != $SytuacjaPoSmierci->LiczbaDzieci){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            if(isset($dane['WiekDzieci'])){
                $dane_sytuacja_po_smierci = array_merge($dane_sytuacja_po_smierci, array('WiekDzieci' => $dane['WiekDzieci']));
                if($dane['WiekDzieci'] != $SytuacjaPoSmierci->WiekDzieci){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    //$przeladujWidokZakladki = 1;
                }
            }
            $bazaDanych->aktualizujDane('umowaSytuacjaPoSmierci', $dane_sytuacja_po_smierci, $OswiadczenieUprawnionego->SytuacjaPoSmierciId);
        }

        if(isset($dane['PokrewienstwoZeZmarlym']) || isset($dane['PokrewienstwoInneZeZmarlym']) || isset($dane['WspolneGospodarstwo']) || isset($dane['TenSamAdres']) || isset($dane['InnyAdres']) || isset($dane['PomagalWObowiazkach']) || isset($dane['StosunkiZeZmarlym']) || isset($dane['BylNaUtrzymaniu']) || isset($dane['LozylNaUtrzymanie']) || isset($dane['WspolneKonto']) || isset($dane['PartycypowalKoszty']) || isset($dane['WspieralbyFinansowo'])){
            $StosunkiRodzinne = $bazaDanych->pobierzDane('*', 'umowaStosunkiRodzinne','Id = '.$OswiadczenieUprawnionego->StosunkiRodzinneId);
            $StosunkiRodzinne = $StosunkiRodzinne->fetch_object();
            $dane_stosunki_rodzinne = array();

            if(isset($dane['PokrewienstwoZeZmarlym'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('PokrewienstwoZeZmarlym' => $dane['PokrewienstwoZeZmarlym']));
                if($dane['PokrewienstwoZeZmarlym'] != $StosunkiRodzinne->PokrewienstwoZeZmarlym){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['PokrewienstwoInneZeZmarlym'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('PokrewienstwoInneZeZmarlym' => $dane['PokrewienstwoInneZeZmarlym']));
                if($dane['PokrewienstwoInneZeZmarlym'] != $StosunkiRodzinne->PokrewienstwoInneZeZmarlym){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['WspolneGospodarstwo'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('WspolneGospodarstwo' => $dane['WspolneGospodarstwo']));
                if($dane['WspolneGospodarstwo'] != $StosunkiRodzinne->WspolneGospodarstwo){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['TenSamAdres'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('TenSamAdres' => $dane['TenSamAdres']));
                if($dane['TenSamAdres'] != $StosunkiRodzinne->TenSamAdres){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['InnyAdres'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('InnyAdres' => $dane['InnyAdres']));
                if($dane['InnyAdres'] != $StosunkiRodzinne->InnyAdres){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['PomagalWObowiazkach'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('PomagalWObowiazkach' => $dane['PomagalWObowiazkach']));
                if($dane['PomagalWObowiazkach'] != $StosunkiRodzinne->PomagalWObowiazkach){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['StosunkiZeZmarlym'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('StosunkiZeZmarlym' => $dane['StosunkiZeZmarlym']));
                if($dane['StosunkiZeZmarlym'] != $StosunkiRodzinne->StosunkiZeZmarlym){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['BylNaUtrzymaniu'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('BylNaUtrzymaniu' => $dane['BylNaUtrzymaniu']));
                if($dane['BylNaUtrzymaniu'] != $StosunkiRodzinne->BylNaUtrzymaniu){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['LozylNaUtrzymanie'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('LozylNaUtrzymanie' => $dane['LozylNaUtrzymanie']));
                if($dane['LozylNaUtrzymanie'] != $StosunkiRodzinne->LozylNaUtrzymanie){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['WspolneKonto'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('WspolneKonto' => $dane['WspolneKonto']));
                if($dane['WspolneKonto'] != $StosunkiRodzinne->WspolneKonto){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['PartycypowalKoszty'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('PartycypowalKoszty' => $dane['PartycypowalKoszty']));
                if($dane['PartycypowalKoszty'] != $StosunkiRodzinne->PartycypowalKoszty){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['WspieralbyFinansowo'])){
                $dane_stosunki_rodzinne = array_merge($dane_stosunki_rodzinne, array('WspieralbyFinansowo' => $dane['WspieralbyFinansowo']));
                if($dane['WspieralbyFinansowo'] != $StosunkiRodzinne->WspieralbyFinansowo){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            $bazaDanych->aktualizujDane('umowaStosunkiRodzinne', $dane_stosunki_rodzinne, $OswiadczenieUprawnionego->StosunkiRodzinneId);
        }

        if(isset($dane['PogorszenieSytuacjiZyciowej']) || isset($dane['WystapienieKrzywdy']) || isset($dane['WiekZmWMomencieSmierci']) || isset($dane['WiekUprWMomencieSmierci'])){
            $dane_oswiadczenie_uprawnionego = array();

            if(isset($dane['PogorszenieSytuacjiZyciowej'])){
                $dane_oswiadczenie_uprawnionego = array_merge($dane_oswiadczenie_uprawnionego, array('PogorszenieSytuacjiZyciowej' => $dane['PogorszenieSytuacjiZyciowej']));
                if($dane['PogorszenieSytuacjiZyciowej'] != $OswiadczenieUprawnionego->PogorszenieSytuacjiZyciowej){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['WystapienieKrzywdy'])){
                $dane_oswiadczenie_uprawnionego = array_merge($dane_oswiadczenie_uprawnionego, array('WystapienieKrzywdy' => $dane['WystapienieKrzywdy']));
                if($dane['WystapienieKrzywdy'] != $OswiadczenieUprawnionego->WystapienieKrzywdy){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['WiekZmWMomencieSmierci'])){
                $dane_oswiadczenie_uprawnionego = array_merge($dane_oswiadczenie_uprawnionego, array('WiekZmWMomencieSmierci' => $dane['WiekZmWMomencieSmierci']));
                if($dane['WiekZmWMomencieSmierci'] != $OswiadczenieUprawnionego->WiekZmWMomencieSmierci){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['WiekUprWMomencieSmierci'])){
                $dane_oswiadczenie_uprawnionego = array_merge($dane_oswiadczenie_uprawnionego, array('WiekUprWMomencieSmierci' => $dane['WiekUprWMomencieSmierci']));
                if($dane['WiekUprWMomencieSmierci'] != $OswiadczenieUprawnionego->WiekUprWMomencieSmierci){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }

            $bazaDanych->aktualizujDane('umowaOswiadczenieUprawnionego', $dane_oswiadczenie_uprawnionego, $umowa_tmp->OswiadczenieUprawnionegoId);
        }


        if(isset($dane['ZmarlyWyksztalcenie']) || isset($dane['ZmarlyZawodWyuczony']) || isset($dane['ZmarlyZawodWykonywany']) || isset($dane['ZmarlyDodatkoweUprawnienia']) || isset($dane['ZmarlyZatrudnienie']) || isset($dane['ZmarlyZatrudnienieInne']) || isset($dane['ZmarlyZarobki'])){
            $DaneZmarlego = $bazaDanych->pobierzDane('*', 'umowaOsoba','Id = '.$umowa_tmp->OsobaPoszkodowanyId);
            $DaneZmarlego = $DaneZmarlego->fetch_object();
            $dane_zmarlego = array();

            if(isset($dane['ZmarlyWyksztalcenie'])){
                $dane_zmarlego = array_merge($dane_zmarlego, array('Wyksztalcenie' => $dane['ZmarlyWyksztalcenie']));
                if($dane['ZmarlyWyksztalcenie'] != $DaneZmarlego->Wyksztalcenie){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['ZmarlyZawodWyuczony'])){
                $dane_zmarlego = array_merge($dane_zmarlego, array('ZawodWyuczony' => $dane['ZmarlyZawodWyuczony']));
                if($dane['ZmarlyZawodWyuczony'] != $DaneZmarlego->ZawodWyuczony){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['ZmarlyZawodWykonywany'])){
                $dane_zmarlego = array_merge($dane_zmarlego, array('ZawodWykonywany' => $dane['ZmarlyZawodWykonywany']));
                if($dane['ZmarlyZawodWykonywany'] != $DaneZmarlego->ZawodWykonywany){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['ZmarlyDodatkoweUprawnienia'])){
                $dane_zmarlego = array_merge($dane_zmarlego, array('DodatkoweUprawnienia' => $dane['ZmarlyDodatkoweUprawnienia']));
                if($dane['ZmarlyDodatkoweUprawnienia'] != $DaneZmarlego->DodatkoweUprawnienia){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['ZmarlyZatrudnienie'])){
                $dane_zmarlego = array_merge($dane_zmarlego, array('Zatrudnienie' => $dane['ZmarlyZatrudnienie']));
                if($dane['ZmarlyZatrudnienie'] != $DaneZmarlego->Zatrudnienie){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['ZmarlyZatrudnienieInne'])){
                $dane_zmarlego = array_merge($dane_zmarlego, array('ZatrudnienieInne' => $dane['ZmarlyZatrudnienieInne']));
                if($dane['ZmarlyZatrudnienieInne'] != $DaneZmarlego->ZatrudnienieInne){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['ZmarlyZarobki'])){
                $dane_zmarlego = array_merge($dane_zmarlego, array('Zarobki' => $dane['ZmarlyZarobki']));
                if($dane['ZmarlyZarobki'] != $DaneZmarlego->Zarobki){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }

            $bazaDanych->aktualizujDane('umowaOsoba', $dane_zmarlego, $umowa_tmp->OsobaPoszkodowanyId);
        }


        if(isset($dane['UprawnionyWyksztalcenie']) || isset($dane['UprawnionyZawodWyuczony']) || isset($dane['UprawnionyZawodWykonywany']) || isset($dane['UprawnionyDodatkoweUprawnienia']) || isset($dane['UprawnionyZatrudnienie']) || isset($dane['UprawnionyZatrudnienieInne']) || isset($dane['UprawnionyZarobki'])){
            $DaneUprawnionego = $bazaDanych->pobierzDane('*', 'umowaOsoba','Id = '.$umowa_tmp->OsobaUprawnionyId);
            $DaneUprawnionego = $DaneUprawnionego->fetch_object();
            $dane_uprawnionego = array();

            if(isset($dane['ZmarlyWyksztalcenie'])){
                $dane_uprawnionego = array_merge($dane_uprawnionego, array('Wyksztalcenie' => $dane['UprawnionyWyksztalcenie']));
                if($dane['UprawnionyWyksztalcenie'] != $DaneUprawnionego->Wyksztalcenie){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['UprawnionyZawodWyuczony'])){
                $dane_uprawnionego = array_merge($dane_uprawnionego, array('ZawodWyuczony' => $dane['UprawnionyZawodWyuczony']));
                if($dane['UprawnionyZawodWyuczony'] != $DaneUprawnionego->ZawodWyuczony){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['UprawnionyZawodWykonywany'])){
                $dane_uprawnionego = array_merge($dane_uprawnionego, array('ZawodWykonywany' => $dane['UprawnionyZawodWykonywany']));
                if($dane['UprawnionyZawodWykonywany'] != $DaneUprawnionego->ZawodWykonywany){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['ZmarlyDodatkoweUprawnienia'])){
                $dane_uprawnionego = array_merge($dane_uprawnionego, array('DodatkoweUprawnienia' => $dane['UprawnionyDodatkoweUprawnienia']));
                if($dane['UprawnionyDodatkoweUprawnienia'] != $DaneUprawnionego->DodatkoweUprawnienia){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['UprawnionyZatrudnienie'])){
                $dane_uprawnionego = array_merge($dane_uprawnionego, array('Zatrudnienie' => $dane['UprawnionyZatrudnienie']));
                if($dane['UprawnionyZatrudnienie'] != $DaneUprawnionego->Zatrudnienie){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['UprawnionyZatrudnienieInne'])){
                $dane_uprawnionego = array_merge($dane_uprawnionego, array('ZatrudnienieInne' => $dane['UprawnionyZatrudnienieInne']));
                if($dane['UprawnionyZatrudnienieInne'] != $DaneUprawnionego->ZatrudnienieInne){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }
            if(isset($dane['UprawnionyZarobki'])){
                $dane_uprawnionego = array_merge($dane_uprawnionego, array('Zarobki' => $dane['UprawnionyZarobki']));
                if($dane['UprawnionyZarobki'] != $DaneUprawnionego->Zarobki){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OswiadczenieUprawnionego->SytuacjaMaterialna, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $OsobaDzialajacyId, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');
                }
            }

            $bazaDanych->aktualizujDane('umowaOsoba', $dane_uprawnionego, $umowa_tmp->OsobaUprawnionyId);
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_osobe':
        $element_id = explode('-',$element_id);

        $kontakt_id_tmp = $bazaDanych->wstawDane('umowaKontakt', array(
            'Mail' => $dane['Mail']
        ,'Telefon' => $dane['Telefon']
        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $kontakt_id_tmp, 'umowaKontakt_id', 'Dodanie kontaktu', '', $kontakt_id_tmp, 'umowaKontakt_historia_zmian');

        $adres_miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');
        if(is_null($adres_miasto_id_tmp)){
            $adres_miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array(
                'Wartosc' => $dane['Wartosc']
            ));
            $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $adres_miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

        }else{
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->fetch_object();
            $adres_miasto_id_tmp = $adres_miasto_id_tmp->Id;
        }

        $adres_id_tmp = $bazaDanych->wstawDane('umowaAdres',array(
            'Ulica' => $dane['Ulica']
        ,'NrDomu' => $dane['NrDomu']
        ,'NrMieszkania' => $dane['NrMieszkania']
        ,'KodPocztowy' => $dane['KodPocztowy']
        ,'MiastoId' => $adres_miasto_id_tmp

        ));
        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $adres_id_tmp, 'umowaAdres_id', 'Dodanie adresu', '', $adres_id_tmp, 'umowaAdres_historia_zmian');

        $osoba_id_tmp = $bazaDanych->wstawDane('umowaOsoba', array(
            'Imie' => $dane['Imie']
        ,'Nazwisko' => $dane['Nazwisko']
        ,'Pesel' => $dane['Pesel']
        ,'Wiek' => $dane['Wiek']
        ,'Dowod' => $dane['Dowod']
        ,'AdresId' => $adres_id_tmp
        ,'KontaktId' => $kontakt_id_tmp
        ,'PrzedstawicielId' => $_SESSION['uzytkownik_id']
        ,'OsobaTypId' => $dane['OsobaTypId']
        ));

        if ($droga == 'osobowa' && $strona == 'osobowe_zmarly') {

            //if ($dane['OsobaPoszkodowanyId'] != $element_id[1]) {


                $bazaDanych->aktualizujDane('umowaOsobowa', array('OsobaPoszkodowanyId' => $osoba_id_tmp), $element_id[2]);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa' . mb_ucfirst($droga) . '_id', 'Dodanie poszkodowanego/zmarłego', '', $osoba_id_tmp, 'umowa' . mb_ucfirst($droga) . '_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie poszkodowanego/zmarłego', '', $osoba_id_tmp, 'umowa_historia_zmian');

            /*}
            else {
                $bazaDanych->aktualizujDane('umowaOsobowa', array('OsobaPoszkodowanyId' => $element_id[1]), $element_id[2]);
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa' . mb_ucfirst($droga) . '_id', 'Dodanie poszkodowanego/zmarłego', '', $osoba_id_tmp, 'umowa' . mb_ucfirst($droga) . '_historia_zmian');
                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie poszkodowanego/zmarłego', '', $osoba_id_tmp, 'umowa_historia_zmian');

            }*/
            //$bazaDanych->aktualizujDane('umowaOsobowa', array('OsobaPoszkodowanyId' => $osoba_id_tmp), $element_id[2]);
        }

        if ($droga == 'osobowa' && $strona == '6') {

            //$bazaDanych->aktualizujDane('umowaListaSwiadkow', array('IdOsoby' => $osoba_id_tmp, 'IdUmowyOsobowej' => $element_id[2]), $element_id[2]);
            $adres_id_tmp = $bazaDanych->wstawDane('umowaListaSwiadkow',array(
                'IdOsoby' => $osoba_id_tmp
            ,'IdUmowyOsobowej' => $element_id[2]

            ));
        }

        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[2], 'umowa'.mb_ucfirst($droga).'_id', 'Dodanie dodatkowego klienta', '', $osoba_id_tmp, 'umowa'.mb_ucfirst($droga).'_historia_zmian');
        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Dodanie dodatkowego klienta', '', $osoba_id_tmp, 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_osobe':

        $element_id = explode('-',$element_id);
        $umowa_osobowa_id = $element_id[2];
        $umowa_osoba_id = $element_id[1];


        $umowa_osobowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa','Id = '.$umowa_osobowa_id);
        $umowa_osobowa_tmp = $umowa_osobowa_tmp->fetch_object();

        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$umowa_osobowa_tmp->OsobaPoszkodowanyId);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

        if(isset($dane['Mail']) || isset($dane['Telefon'])){
            $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt','id = '.$umowa_osoba_tmp->KontaktId);
            $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();
            $dane_kontakt = array();

            if(isset($dane['Mail'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Mail' => $dane['Mail']));
                if($dane['Mail'] != $umowa_osoba_kontakt_tmp->Mail){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Mail', $umowa_osoba_kontakt_tmp->Mail, $dane['Mail'], 'umowaOsoba_historia_zmian');

                }
            }
            if(isset($dane['Telefon'])){
                $dane_kontakt = array_merge($dane_kontakt, array('Telefon' => $dane['Telefon']));
                if($dane['Telefon'] != $umowa_osoba_kontakt_tmp->Telefon){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->KontaktId, 'umowaKontakt_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaKontakt_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Telefon', $umowa_osoba_kontakt_tmp->Telefon, $dane['Telefon'], 'umowaOsoba_historia_zmian');
                    $przeladujWidokZakladki = 1;
                }
            }

            $bazaDanych->aktualizujDane('umowaKontakt',$dane_kontakt,$umowa_osoba_tmp->KontaktId);
        }

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        $drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$umowa_osoba_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres',$dane_adres,$umowa_osoba_tmp->AdresId);
        }

        unset($dane['Mail']);
        unset($dane['Telefon']);
        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);

        /*$drukiaMain->porownajZmianyDoHistorii($bazaDanych, $umowa_osobowa_tmp->OsobaPoszkodowanyId, $dane, $tabela);
        $bazaDanych->aktualizujDane($tabela, $dane, $umowa_osobowa_tmp->OsobaPoszkodowanyId);*/


        if ($droga == 'osobowa' && $strona == 'osobowe_zmarly') {


                $drukiaMain->porownajZmianyDoHistorii($bazaDanych, $umowa_osobowa_tmp->OsobaPoszkodowanyId, $dane, $tabela);
                $bazaDanych->aktualizujDane($tabela, $dane, $umowa_osobowa_tmp->OsobaPoszkodowanyId);

                $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id, 'umowa_id', 'Edycja poszkodowanego/zmarłego', '', $element_id, 'umowa_historia_zmian');

        }

        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id, 'umowa_id', 'Edycja dodatkowy klient', '', $element_id, 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'przepisz_poszkodowanego':

        $element_id = explode('-',$element_id);
        $umowa_osobowa_id = $element_id[2];
        $umowa_osoba_id = $element_id[1];


        $umowa_osobowa_tmp = $bazaDanych->pobierzDane('*', 'umowaOsobowa','Id = '.$umowa_osobowa_id);
        $umowa_osobowa_tmp = $umowa_osobowa_tmp->fetch_object();

        //$umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','id = '.$umowa_osobowa_tmp->OsobaPoszkodowanyId);

        //if($umowa_osoba_tmp) {
        //    $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

            $bazaDanych->aktualizujDane('umowaOsobowa', array ('OsobaPoszkodowanyId' => $umowa_osoba_id), $umowa_osobowa_id);
        //}


        //$przeladujWidokZakladki = 1;
        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;


    case 'aktualizuj_swiadka':

        $element_id = explode('-',$element_id);
        $umowa_osobowa_id = $element_id[2];
        //$element_id = $element_id[1];

        //$swiadek_tmp = $bazaDanych->pobierzDane('*', 'umowaListaSwiadkow','IdUmowyOsobowej = '.$umowa_osobowa_id. ' AND IdOsoby = '.$dane['Id']);
        //$swiadek_tmp = $swiadek_tmp->fetch_object();

        $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba','Id = '.$dane['Id']);
        $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

        if(isset($dane['Ulica']) || isset($dane['NrDomu']) || isset($dane['NrMieszkania']) || isset($dane['KodPocztowy']) || isset($dane['Wartosc'])){
            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres','id = '.$umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();
            $dane_adres = array();

            if(isset($dane['Ulica'])){
                $dane_adres = array_merge($dane_adres, array('Ulica' => $dane['Ulica']));
                if($dane['Ulica'] != $umowa_osoba_adres_tmp->Ulica){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrDomu'])){
                $dane_adres = array_merge($dane_adres, array('NrDomu' => $dane['NrDomu']));
                if($dane['NrDomu'] != $umowa_osoba_adres_tmp->NrDomu){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['NrMieszkania'])){
                $dane_adres = array_merge($dane_adres, array('NrMieszkania' => $dane['NrMieszkania']));
                if($dane['NrMieszkania'] != $umowa_osoba_adres_tmp->NrMieszkania){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KodPocztowy'])){
                $dane_adres = array_merge($dane_adres, array('KodPocztowy' => $dane['KodPocztowy']));
                if($dane['KodPocztowy'] != $umowa_osoba_adres_tmp->KodPocztowy){
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['Wartosc'])){
                $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
                $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                if($dane['Wartosc'] != $umowa_osoba_adres_miasto_tmp->Wartosc){
                    $miasto_id_tmp = $bazaDanych->pobierzDane('Id','umowaAdresMiasto','Wartosc = "'.$dane['Wartosc'].'"');

                    if(is_null($miasto_id_tmp)){
                        $miasto_id_tmp = $bazaDanych->wstawDane('umowaAdresMiasto',array('Wartosc' => $dane['Wartosc']));
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $miasto_id_tmp, 'umowaAdresMiasto_id', 'Dodanie miasta', '', $miasto_id_tmp, 'umowaAdresMiasto_historia_zmian');

                    }else{
                        $miasto_id_tmp = $miasto_id_tmp->fetch_object();
                        $miasto_id_tmp = $miasto_id_tmp->Id;
                    }

                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja MiastoId', $umowa_osoba_adres_miasto_tmp->Id, $miasto_id_tmp, 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Miasto', $umowa_osoba_adres_miasto_tmp->Wartosc, $dane['Wartosc'], 'umowaOsoba_historia_zmian');

                }
                $bazaDanych->aktualizujDane('umowaAdres',array('MiastoId' => $miasto_id_tmp),$umowa_osoba_tmp->AdresId);
            }

            $bazaDanych->aktualizujDane('umowaAdres',$dane_adres,$umowa_osoba_tmp->AdresId);
        }

        unset($dane['Mail']);
        unset($dane['Telefon']);
        unset($dane['Ulica']);
        unset($dane['NrDomu']);
        unset($dane['NrMieszkania']);
        unset($dane['KodPocztowy']);
        unset($dane['Wartosc']);

        /*$drukiaMain->porownajZmianyDoHistorii($bazaDanych, $umowa_osobowa_tmp->OsobaPoszkodowanyId, $dane, $tabela);
        $bazaDanych->aktualizujDane($tabela, $dane, $umowa_osobowa_tmp->OsobaPoszkodowanyId);*/


            //$drukiaMain->porownajZmianyDoHistorii($bazaDanych, $umowa_osobowa_tmp->OsobaPoszkodowanyId, $dane, $tabela);

            $id = $dane['Id'];
            unset($dane['Id']);
            $bazaDanych->aktualizujDane($tabela, $dane, $id);

            //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id, 'umowa_id', 'Edycja poszkodowanego/zmarłego', '', $element_id, 'umowa_historia_zmian');



        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_id, 'umowa_id', 'Edycja dodatkowy klient', '', $element_id, 'umowa_historia_zmian');

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        $komunikat = $id;
        break;


    case 'dodaj_odpowiedz_do_ankiety':

        $element_id = explode('-',$element_id);

        $placowka_id_tmp = $bazaDanych->wstawDane('umowaAnkiety',array(
            'UmowaId' => $element_id[2]
        ,'PytanieId' => $dane['PytanieId']
        ,'Odpowiedz' => $dane['Odpowiedz']
        ));

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_odpowiedz_do_ankiety':

        $element_id = explode('-', $element_id);

        $odpowiedz_tmp = $bazaDanych->pobierzDane('*','umowaAnkiety','UmowaId='.$element_id[2].' AND PytanieId='.$dane['PytanieId']);

        if ($odpowiedz_tmp) {
            $odpowiedz_tmp = $odpowiedz_tmp->fetch_object();

                if (isset($dane['Odpowiedz'])) {
                        if ($dane['Odpowiedz'] != $odpowiedz_tmp->Odpowiedz) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                $bazaDanych->aktualizujDaneZWarunkiem('umowaAnkiety',
                    array (
                        'Odpowiedz' => $dane['Odpowiedz']
                    ), 'UmowaId='.$element_id[2].' AND PytanieId='.$dane['PytanieId']);
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_odpowiedz_22':

        $element_id = explode('-',$element_id);

        $inne_odszkodowania = $bazaDanych->wstawDane('umowaInneOdszkodowania',array(
            'KwotaZUS' => $dane['KwotaZUS']
        ,'KwotaGOPS' => $dane['KwotaGOPS']
        ,'KwotaZOC' => $dane['KwotaZOC']
        ,'InneSwiadczenia' => $dane['InneSwiadczenia']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa', array (
            'InneOdszkodowaniaId' => $inne_odszkodowania
        ), $element_id[2]);

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_odpowiedz_22':

        $element_id = explode('-', $element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $inne_odszkodowania = $bazaDanych->pobierzDane('*', 'umowaInneOdszkodowania', 'Id =' . $umowa_tmp->InneOdszkodowaniaId);

        if(isset($dane['KwotaZUS']) || isset($dane['KwotaGOPS']) || isset($dane['KwotaZOC']) || isset($dane['InneSwiadczenia'])){
            $inne_odszkodowania = $inne_odszkodowania->fetch_object();
            $dane_odszkodowania = array();

            if(isset($dane['KwotaZUS'])){
                $dane_odszkodowania = array_merge($dane_odszkodowania, array('KwotaZUS' => $dane['KwotaZUS']));
                if($dane['KwotaZUS'] != $inne_odszkodowania->KwotaZUS){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KwotaGOPS'])){
                $dane_odszkodowania = array_merge($dane_odszkodowania, array('KwotaGOPS' => $dane['KwotaGOPS']));
                if($dane['KwotaGOPS'] != $inne_odszkodowania->KwotaGOPS){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['KwotaZOC'])){
                $dane_odszkodowania = array_merge($dane_odszkodowania, array('KwotaZOC' => $dane['KwotaZOC']));
                if($dane['KwotaZOC'] != $inne_odszkodowania->KwotaZOC){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }

            if(isset($dane['InneSwiadczenia'])){
                $dane_odszkodowania = array_merge($dane_odszkodowania, array('InneSwiadczenia' => $dane['InneSwiadczenia']));
                if($dane['InneSwiadczenia'] != $inne_odszkodowania->InneSwiadczenia){
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }

            $bazaDanych->aktualizujDane('umowaInneOdszkodowania', $dane_odszkodowania, $umowa_tmp->InneOdszkodowaniaId);
        }

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'dodaj_wniosek_fundacji':

        $element_id = explode('-',$element_id);

        $dochody_id_tmp = $bazaDanych->wstawDane('umowaDochody',array(
            'Wynagrodzenie' => $dane['Wynagrodzenie']
        ,'Dzialalnosc' => $dane['Dzialalnosc']
        ,'Renta' => $dane['Renta']
        ,'Emerytura' => $dane['Emerytura']
        ,'Zasilek' => $dane['Zasilek']
        ,'Socjal' => $dane['Socjal']
        ,'Alimenty' => $dane['Alimenty']
        ,'SredniDochod' => $dane['SredniDochod']
        ));

        $nieruchomosci_id_tmp = $bazaDanych->wstawDane('umowaNieruchomosci',array(
            'Dom' => $dane['Dom']
        ,'PowierzchniaDomu' => $dane['PowierzchniaDomu']
        ,'WlascicielDomu' => $dane['WlascicielDomu']
        ,'Mieszkanie' => $dane['Mieszkanie']
        ,'PowierzchniaMieszkania' => $dane['PowierzchniaMieszkania']
        ,'WlascicielMieszkania' => $dane['WlascicielMieszkania']
        ,'DzialkaRolna' => $dane['DzialkaRolna']
        ,'PowierzchniaDzialkiRolnej' => $dane['PowierzchniaDzialkiRolnej']
        ,'WlascicielDzialkiRolnej' => $dane['WlascicielDzialkiRolnej']
        ,'DzialkaBudowlana' => $dane['DzialkaBudowlana']
        ,'PowierzchniaDzialkiBudowlanej' => $dane['PowierzchniaDzialkiBudowlanej']
        ,'WlascicielDzialkiBudowlanej' => $dane['WlascicielDzialkiBudowlanej']
        ));

        $wniosek_id_tmp = $bazaDanych->wstawDane('umowaWniosekVotum',array(
            'OpisPrzypadku' => $dane['OpisPrzypadku']
        ,'OsobyWGospodarstwie' => $dane['OsobyWGospodarstwie']
        ,'NieruchomosciId' => $nieruchomosci_id_tmp
        ,'Zasoby' => $dane['Zasoby']
        ,'DochodyId' => $dochody_id_tmp
        ,'Turnus' => $dane['Turnus']
        ,'MiejsceTurnusu' => $dane['MiejsceTurnusu']
        ,'Rehabilitacja' => $dane['Rehabilitacja']
        ,'Proteza' => $dane['Proteza']
        ,'Sprzet' => $dane['Sprzet']
        ,'Wozek' => $dane['Wozek']
        ,'PomocRodzinie' => $dane['PomocRodzinie']
        ,'InneDofinansowanie' => $dane['InneDofinansowanie']
        ,'InneOpis' => $dane['InneOpis']
        ,'UdostepnienieRachunku' => $dane['UdostepnienieRachunku']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa', array (
            'WniosekVotumId' => $wniosek_id_tmp
        ), $element_id[2]);

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

    case 'aktualizuj_wniosek_fundacji':

        $element_id = explode('-',$element_id);

        $umowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id='.$element_id[2]);
        $umowa_tmp = $umowa_tmp->fetch_object();

        $wniosek_votum = $bazaDanych->pobierzDane('*', 'umowaWniosekVotum', 'Id =' . $umowa_tmp->WniosekVotumId);

        if ($wniosek_votum) {
            $wniosek_votum = $wniosek_votum->fetch_object();
            $dochody = $bazaDanych->pobierzDane('*', 'umowaDochody', 'Id =' . $wniosek_votum->DochodyId);
            $nieruchomosci = $bazaDanych->pobierzDane('*', 'umowaNieruchomosci', 'Id =' . $wniosek_votum->NieruchomosciId);

            if (isset($dane['Wynagrodzenie']) || isset($dane['Dzialalnosc']) || isset($dane['Renta']) || isset($dane['Emerytura']) || isset($dane['Zasilek']) || isset($dane['Socjal']) || isset($dane['Alimenty']) || isset($dane['SredniDochod'])) {
                $dochody = $dochody->fetch_object();
                $dane_dochody = array();

                if (isset($dane['Wynagrodzenie'])) {
                    $dane_dochody = array_merge($dane_dochody, array('Wynagrodzenie' => $dane['Wynagrodzenie']));
                    if ($dane['Wynagrodzenie'] != $dochody->Wynagrodzenie) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }

                if (isset($dane['Dzialalnosc'])) {
                    $dane_dochody = array_merge($dane_dochody, array('Dzialalnosc' => $dane['Dzialalnosc']));
                    if ($dane['Dzialalnosc'] != $dochody->Dzialalnosc) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Renta'])) {
                    $dane_dochody = array_merge($dane_dochody, array('Renta' => $dane['Renta']));
                    if ($dane['Renta'] != $dochody->Renta) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Emerytura'])) {
                    $dane_dochody = array_merge($dane_dochody, array('Emerytura' => $dane['Emerytura']));
                    if ($dane['Emerytura'] != $dochody->Emerytura) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Zasilek'])) {
                    $dane_dochody = array_merge($dane_dochody, array('Zasilek' => $dane['Zasilek']));
                    if ($dane['Zasilek'] != $dochody->Zasilek) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Socjal'])) {
                    $dane_dochody = array_merge($dane_dochody, array('Socjal' => $dane['Socjal']));
                    if ($dane['Socjal'] != $dochody->Socjal) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Alimenty'])) {
                    $dane_dochody = array_merge($dane_dochody, array('Alimenty' => $dane['Alimenty']));
                    if ($dane['Alimenty'] != $dochody->Alimenty) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['SredniDochod'])) {
                    $dane_dochody = array_merge($dane_dochody, array('SredniDochod' => $dane['SredniDochod']));
                    if ($dane['SredniDochod'] != $dochody->SredniDochod) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                    }
                }
                $bazaDanych->aktualizujDane('umowaDochody', $dane_dochody, $wniosek_votum->DochodyId);
            }

            if (isset($dane['Dom']) || isset($dane['PowierzchniaDomu']) || isset($dane['WlascicielDomu']) || isset($dane['Mieszkanie']) || isset($dane['PowierzchniaMieszkania']) || isset($dane['WlascicielMieszkania']) || isset($dane['DzialkaRolna']) || isset($dane['PowierzchniaDzialkiRolnej']) || isset($dane['WlascicielDzialkiRolnej']) || isset($dane['DzialkaBudowlana']) || isset($dane['PowierzchniaDzialkiBudowlanej']) || isset($dane['WlascicielDzialkiBudowlanej'])) {
                $nieruchomosci = $nieruchomosci->fetch_object();
                $dane_nieruchomosci = array();

                if (isset($dane['Dom'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('Dom' => $dane['Dom']));
                    if ($dane['Dom'] != $dochody->Dom) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PowierzchniaDomu'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('PowierzchniaDomu' => $dane['PowierzchniaDomu']));
                    if ($dane['PowierzchniaDomu'] != $dochody->PowierzchniaDomu) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WlascicielDomu'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('WlascicielDomu' => $dane['WlascicielDomu']));
                    if ($dane['WlascicielDomu'] != $dochody->WlascicielDomu) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['Mieszkanie'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('Mieszkanie' => $dane['Mieszkanie']));
                    if ($dane['Mieszkanie'] != $dochody->Mieszkanie) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PowierzchniaMieszkania'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('PowierzchniaMieszkania' => $dane['PowierzchniaMieszkania']));
                    if ($dane['PowierzchniaMieszkania'] != $dochody->PowierzchniaMieszkania) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WlascicielMieszkania'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('WlascicielMieszkania' => $dane['WlascicielMieszkania']));
                    if ($dane['WlascicielMieszkania'] != $dochody->WlascicielMieszkania) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DzialkaRolna'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('DzialkaRolna' => $dane['DzialkaRolna']));
                    if ($dane['DzialkaRolna'] != $dochody->DzialkaRolna) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PowierzchniaDzialkiRolnej'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('PowierzchniaDzialkiRolnej' => $dane['PowierzchniaDzialkiRolnej']));
                    if ($dane['PowierzchniaDzialkiRolnej'] != $dochody->PowierzchniaDzialkiRolnej) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WlascicielDzialkiRolnej'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('WlascicielDzialkiRolnej' => $dane['WlascicielDzialkiRolnej']));
                    if ($dane['WlascicielDzialkiRolnej'] != $dochody->WlascicielDzialkiRolnej) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['DzialkaBudowlana'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('DzialkaBudowlana' => $dane['DzialkaBudowlana']));
                    if ($dane['DzialkaBudowlana'] != $dochody->DzialkaBudowlana) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['PowierzchniaDzialkiBudowlanej'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('PowierzchniaDzialkiBudowlanej' => $dane['PowierzchniaDzialkiBudowlanej']));
                    if ($dane['PowierzchniaDzialkiBudowlanej'] != $dochody->PowierzchniaDzialkiBudowlanej) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                    }
                }
                if (isset($dane['WlascicielDzialkiBudowlanej'])) {
                    $dane_nieruchomosci = array_merge($dane_nieruchomosci, array('WlascicielDzialkiBudowlanej' => $dane['WlascicielDzialkiBudowlanej']));
                    if ($dane['WlascicielDzialkiBudowlanej'] != $dochody->WlascicielDzialkiBudowlanej) {
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                        //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                    }
                }
                $bazaDanych->aktualizujDane('umowaNieruchomosci', $dane_nieruchomosci, $wniosek_votum->NieruchomosciId);
            }

            $dane_do_wniosku = array();

            if (isset($dane['OpisPrzypadku'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('OpisPrzypadku' => $dane['OpisPrzypadku']));
                if ($dane['OpisPrzypadku'] != $wniosek_votum->OpisPrzypadku) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['OsobyWGospodarstwie'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('OsobyWGospodarstwie' => $dane['OsobyWGospodarstwie']));
                if ($dane['OsobyWGospodarstwie'] != $wniosek_votum->OsobyWGospodarstwie) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['Zasoby'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('Zasoby' => $dane['Zasoby']));
                if ($dane['Zasoby'] != $wniosek_votum->Zasoby) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['Turnus'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('Turnus' => $dane['Turnus']));
                if ($dane['Turnus'] != $wniosek_votum->Turnus) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['MiejsceTurnusu'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('MiejsceTurnusu' => $dane['MiejsceTurnusu']));
                if ($dane['MiejsceTurnusu'] != $wniosek_votum->MiejsceTurnusu) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['Rehabilitacja'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('Rehabilitacja' => $dane['Rehabilitacja']));
                if ($dane['Rehabilitacja'] != $wniosek_votum->Rehabilitacja) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['Proteza'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('Proteza' => $dane['Proteza']));
                if ($dane['Proteza'] != $wniosek_votum->Proteza) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['Sprzet'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('Sprzet' => $dane['Sprzet']));
                if ($dane['Sprzet'] != $wniosek_votum->Sprzet) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['Wozek'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('Wozek' => $dane['Wozek']));
                if ($dane['Wozek'] != $wniosek_votum->Wozek) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['PomocRodzinie'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('PomocRodzinie' => $dane['PomocRodzinie']));
                if ($dane['PomocRodzinie'] != $wniosek_votum->PomocRodzinie) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrDomu', $umowa_osoba_adres_tmp->NrDomu, $dane['NrDomu'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['InneDofinansowanie'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('InneDofinansowanie' => $dane['InneDofinansowanie']));
                if ($dane['InneDofinansowanie'] != $wniosek_votum->InneDofinansowanie) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja NrMieszkania', $umowa_osoba_adres_tmp->NrMieszkania, $dane['NrMieszkania'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['InneOpis'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('InneOpis' => $dane['InneOpis']));
                if ($dane['InneOpis'] != $wniosek_votum->InneOpis) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja KodPocztowy', $umowa_osoba_adres_tmp->KodPocztowy, $dane['KodPocztowy'], 'umowaOsoba_historia_zmian');
                }
            }
            if (isset($dane['UdostepnienieRachunku'])) {
                $dane_do_wniosku = array_merge($dane_do_wniosku, array('UdostepnienieRachunku' => $dane['UdostepnienieRachunku']));
                if ($dane['UdostepnienieRachunku'] != $wniosek_votum->UdostepnienieRachunku) {
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $umowa_osoba_tmp->AdresId, 'umowaAdres_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaAdres_historia_zmian');
                    //$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'umowaOsoba_id', 'Edycja Ulica', $umowa_osoba_adres_tmp->Ulica, $dane['Ulica'], 'umowaOsoba_historia_zmian');
                }
            }
            $bazaDanych->aktualizujDane('umowaWniosekVotum', $dane_do_wniosku, $umowa_tmp->WniosekVotumId);

        }




/*        $dochody_id_tmp = $bazaDanych->wstawDane('umowaDochody',array(
            'Wynagrodzenie' => $dane['Wynagrodzenie']
        ,'Dzialalnosc' => $dane['Dzialalnosc']
        ,'Renta' => $dane['Renta']
        ,'Emerytura' => $dane['Emerytura']
        ,'Zasilek' => $dane['Zasilek']
        ,'Socjal' => $dane['Socjal']
        ,'Alimenty' => $dane['Alimenty']
        ,'SredniDochod' => $dane['SredniDochod']
        ));

        $nieruchomosci_id_tmp = $bazaDanych->wstawDane('umowaNieruchomosci',array(
            'Dom' => $dane['Dom']
        ,'PowierzchniaDomu' => $dane['PowierzchniaDomu']
        ,'WlascicielDomu' => $dane['WlascicielDomu']
        ,'Mieszkanie' => $dane['Mieszkanie']
        ,'PowierzchniaMieszkania' => $dane['PowierzchniaMieszkania']
        ,'WlascicielMieszkania' => $dane['WlascicielMieszkania']
        ,'DzialkaRolna' => $dane['DzialkaRolna']
        ,'PowierzchniaDzialkiRolnej' => $dane['PowierzchniaDzialkiRolnej']
        ,'WlascicielDzialkiRolnej' => $dane['WlascicielDzialkiRolnej']
        ,'DzialkaBudowlana' => $dane['DzialkaBudowlana']
        ,'PowierzchniaDzialkiBudowlanej' => $dane['PowierzchniaDzialkiBudowlanej']
        ,'WlascicielDzialkiBudowlanej' => $dane['WlascicielDzialkiBudowlanej']
        ));

        $wniosek_id_tmp = $bazaDanych->wstawDane('umowaWniosekVotum',array(
            'OpisPrzypadku' => $dane['OpisPrzypadku']
        ,'OsobyWGospodarstwie' => $dane['OsobyWGospodarstwie']
        ,'NieruchomosciId' => $nieruchomosci_id_tmp
        ,'Zasoby' => $dane['Zasoby']
        ,'DochodyId' => $dochody_id_tmp
        ,'Turnus' => $dane['Turnus']
        ,'MiejsceTurnusu' => $dane['MiejsceTurnusu']
        ,'Rehabilitacja' => $dane['Rehabilitacja']
        ,'Proteza' => $dane['Proteza']
        ,'Sprzet' => $dane['Sprzet']
        ,'Wozek' => $dane['Wozek']
        ,'PomocRodzinie' => $dane['PomocRodzinie']
        ,'InneDofinansowanie' => $dane['InneDofinansowanie']
        ,'InneOpis' => $dane['InneOpis']
        ,'UdostepnienieRachunku' => $dane['UdostepnienieRachunku']
        ));

        $bazaDanych->aktualizujDane('umowaOsobowa', array (
            'WniosekVotumId' => $wniosek_id_tmp
        ), $element_id[2]);*/

        $komunikat = 'Zmiany zostały zapisane!!!';
        $rodzajOut = 'sukces';
        break;

}

$dane = array(
    'rodzaj' => $rodzajOut
,'komunikat' => $komunikat
,'przeladujWidokZakladki' => $przeladujWidokZakladki
,'przeladujSzczegolyElementu' => $przeladujSzczegolyElementu
,'ukryjPopUp1' => $ukryjPopUp1
,'element_id' => $element_id_out
,'tabela' => $tabela

);


echo json_encode($dane);
return;