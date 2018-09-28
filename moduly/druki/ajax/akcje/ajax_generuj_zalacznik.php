<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
    setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

    $drukiaMain = new DrukiMain();

    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '' ;
    $nazwa_druku = (isset($_POST['nazwa_druku'])) ? htmlspecialchars($_POST['nazwa_druku']) : '' ;
    $rodzaj_druku = (isset($_POST['rodzaj_druku'])) ? htmlspecialchars($_POST['rodzaj_druku']) : '' ;

    $element_id = explode('-',$element_id);


    $komunikat = 'Brak akcji do wykonania!!!';
    $rodzajOut = 'blad';

    $zmienne_pdf = array();

    $umowa = $bazaDanych->pobierzDane('*','umowa','Id = '.$element_id[0]);
    $umowa = $umowa->fetch_object();

    $IdentyfikatorPrzedstawiciela = $bazaDanych->pobierzDane('login, imie, nazwisko','uzytkownik','id = '.$umowa->PrzedstawicielId);
    $IdentyfikatorPrzedstawiciela = $IdentyfikatorPrzedstawiciela->fetch_object();

/*    if(!empty($umowa->JednostkaId)){
        $KodJednostki = $bazaDanych->pobierzDane('Wartosc','umowaSlownikKodJednostki','Id = '.$umowa->JednostkaId);
        $KodJednostki = $KodJednostki->fetch_object();
    }*/

    $zmienne_pdf['umowa'] = array(
        'IdentyfikatorPrzedstawiciela' => $IdentyfikatorPrzedstawiciela->login
        ,'ImiePrzedstawiciela' => $IdentyfikatorPrzedstawiciela->imie
        ,'NazwiskoPrzedstawiciela' => $IdentyfikatorPrzedstawiciela->nazwisko
        ,'KodJednostki' => $umowa->JednostkaNumer
        ,'KonsultantId' => $umowa->KonsultantId
        ,'DataPouczenia' => $umowa->DataPouczenia
        ,'MiastoPouczenia' => $umowa->MiastoPouczenia
        ,'DataUmowy' => $umowa->DataUmowy
        ,'Miasto' => $umowa->Miasto
    );
    $zmienne_pdf['umowa'] = json_encode($zmienne_pdf['umowa']);

    /*----------------------------*/


            $umowaRzeczowa = $bazaDanych->pobierzDane('*','umowaRzeczowa','Id = '.$element_id[2]);
            $umowaRzeczowa = $umowaRzeczowa->fetch_object();

            unset($zmienne_pdf['klient']);

            $wartosc_uproszczona_umowy = $bazaDanych->pobierzDane('*','umowaSlownikUmowaRzeczowaTyp','Id = '.$umowaRzeczowa->UmowaRzeczowaTypId);
            $wartosc_uproszczona_umowy = $wartosc_uproszczona_umowy->fetch_object();

            $droga = $wartosc_uproszczona_umowy->WartoscUproszczona;

            $umowa_pojazd = $bazaDanych->pobierzDane('*','umowaPojazd','Id = '.$umowaRzeczowa->PojazdId);
            if ($umowa_pojazd){
                $umowa_pojazd = $umowa_pojazd->fetch_object();
            }
            $umowa_ubezpieczyciel = $bazaDanych->pobierzDane('*','umowaUbezpieczyciel','Id = '.$umowaRzeczowa->UbezpieczycielId);
            if ($umowa_ubezpieczyciel){
                $umowa_ubezpieczyciel = $umowa_ubezpieczyciel->fetch_object();
                $umowa_ubezpieczyciel_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_ubezpieczyciel->AdresId);
                $umowa_ubezpieczyciel_adres = $umowa_ubezpieczyciel_adres->fetch_object();
                $umowa_ubezpieczyciel_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_ubezpieczyciel_adres->MiastoId);
                $umowa_ubezpieczyciel_adres_miasto = $umowa_ubezpieczyciel_adres_miasto->fetch_object();
            }

            $lista_wlascicieli = $bazaDanych->pobierzDane('OsobaId','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND OsobaTypId=1');
            $liczba_wlascicieli = mysqli_num_rows($lista_wlascicieli);

            $zmienne_pdf['liczba_wlascicieli'] = $liczba_wlascicieli;

            for ($i=1; $i<=$liczba_wlascicieli; $i++) {

                $lista_wlascicieli = $bazaDanych->pobierzDane('OsobaId, UrzadSkarbowyId, WielkoscUdzialu','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND NrOsoby = '.$i.' AND OsobaTypId=1');

                if($lista_wlascicieli) {
                    $lista_wlascicieli = $lista_wlascicieli->fetch_object();
                    $umowa_klient = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $lista_wlascicieli->OsobaId);
                    $umowa_klient = $umowa_klient->fetch_object();
                    $umowa_klient_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_klient->AdresId);
                    $umowa_klient_adres = $umowa_klient_adres->fetch_object();
                    $umowa_klient_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_klient_adres->MiastoId);
                    $umowa_klient_adres_miasto = $umowa_klient_adres_miasto->fetch_object();
                    $umowa_klient_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_klient->KontaktId);
                    $umowa_klient_kontakt = $umowa_klient_kontakt->fetch_object();

                    $urzad_skarbowy = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $lista_wlascicieli->UrzadSkarbowyId);


                    if ($urzad_skarbowy) {
                        $urzad_skarbowy = $urzad_skarbowy->fetch_object();

                        $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy->AdresId);
                        $adres_us_tmp = $adres_us_tmp->fetch_object();

                        $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_tmp->MiastoId);
                        $miasto_us_tmp = $miasto_us_tmp->fetch_object();
                    }

                    $zmienne_pdf['klient_' . $i] = array(
                        'Imie' => $umowa_klient->Imie
                    , 'Nazwisko' => $umowa_klient->Nazwisko
                    , 'Nazwa' => $umowa_klient->Nazwa
                    , 'Id' => $umowa_klient->Id
                    , 'Nip' => $umowa_klient->Nip
                    , 'Krs' => $umowa_klient->Krs
                    , 'DataUrodzenia' => $umowa_klient->DataUrodzenia
                    , 'Ulica' => $umowa_klient_adres->Ulica
                    , 'NrDomu' => $umowa_klient_adres->NrDomu
                    , 'NrMieszkania' => $umowa_klient_adres->NrMieszkania
                    , 'KodPocztowy' => $umowa_klient_adres->KodPocztowy
                    , 'Miasto' => $umowa_klient_adres_miasto->Wartosc
                    , 'Pesel' => $umowa_klient->Pesel
                    , 'Dowod' => $umowa_klient->Dowod
                    , 'Mail' => $umowa_klient_kontakt->Mail
                    , 'Telefon' => $umowa_klient_kontakt->Telefon
                    , 'NazwaUS' => $urzad_skarbowy->Nazwa
                    , 'UlicaUS' => $adres_us_tmp->Ulica
                    , 'NrDomuUS' => $adres_us_tmp->NrDomu
                    , 'NrMieszkaniaUS' => $adres_us_tmp->NrMieszkania
                    , 'KodPocztowyUS' => $adres_us_tmp->KodPocztowy
                    , 'MiastoUS' => $miasto_us_tmp->Wartosc
                    , 'WielkoscUdzialu' => $lista_wlascicieli->WielkoscUdzialu
                    );
                } else {
                    $zmienne_pdf['klient_' . $i] = array(
                        'Imie' => ''
                    , 'Nazwisko' => ''
                    , 'Nazwa' => ''
                    , 'Id' => ''
                    , 'Nip' => ''
                    , 'Krs' => ''
                    , 'DataUrodzenia' => ''
                    , 'Ulica' => ''
                    , 'NrDomu' => ''
                    , 'NrMieszkania' => ''
                    , 'KodPocztowy' => ''
                    , 'Miasto' => ''
                    , 'Pesel' => ''
                    , 'Dowod' => ''
                    , 'Mail' => ''
                    , 'Telefon' => ''
                    , 'NazwaUS' => ''
                    , 'UlicaUS' => ''
                    , 'NrDomuUS' => ''
                    , 'NrMieszkaniaUS' => ''
                    , 'KodPocztowyUS' => ''
                    , 'MiastoUS' => ''
                    , 'WielkoscUdzialu' => ''
                    );
                }
                $zmienne_pdf['klient_'.$i] = json_encode($zmienne_pdf['klient_'.$i]);
            }


            for ($i=1; $i<=$liczba_wlascicieli; $i++) {

                $lista_pelnomocnikow = $bazaDanych->pobierzDane('OsobaId, UrzadSkarbowyId, WielkoscUdzialu','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND NrOsoby = '.$i.' AND OsobaTypId=5');

                if($lista_pelnomocnikow) {
                    $lista_pelnomocnikow = $lista_pelnomocnikow->fetch_object();
                    $umowa_pelnomocnik = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $lista_pelnomocnikow->OsobaId);
                    $umowa_pelnomocnik = $umowa_pelnomocnik->fetch_object();
                    $umowa_pelnomocnik_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_pelnomocnik->AdresId);
                    $umowa_pelnomocnik_adres = $umowa_pelnomocnik_adres->fetch_object();
                    $umowa_pelnomocnik_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_pelnomocnik_adres->MiastoId);
                    $umowa_pelnomocnik_adres_miasto = $umowa_pelnomocnik_adres_miasto->fetch_object();
                    $umowa_pelnomocnik_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_pelnomocnik->KontaktId);
                    $umowa_pelnomocnik_kontakt = $umowa_pelnomocnik_kontakt->fetch_object();

                    $urzad_skarbowy = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $lista_pelnomocnikow->UrzadSkarbowyId);


                    if ($urzad_skarbowy) {
                        $urzad_skarbowy = $urzad_skarbowy->fetch_object();

                        $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy->AdresId);
                        $adres_us_tmp = $adres_us_tmp->fetch_object();

                        $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_tmp->MiastoId);
                        $miasto_us_tmp = $miasto_us_tmp->fetch_object();
                    }

                    $zmienne_pdf['pelnomocnik_' . $i] = array(
                        'Imie' => $umowa_pelnomocnik->Imie
                    , 'Nazwisko' => $umowa_pelnomocnik->Nazwisko
                    , 'Nazwa' => $umowa_pelnomocnik->Nazwa
                    , 'Id' => $umowa_pelnomocnik->Id
                    , 'Nip' => $umowa_pelnomocnik->Nip
                    , 'Krs' => $umowa_pelnomocnik->Krs
                    , 'DataUrodzenia' => $umowa_pelnomocnik->DataUrodzenia
                    , 'Ulica' => $umowa_pelnomocnik_adres->Ulica
                    , 'NrDomu' => $umowa_pelnomocnik_adres->NrDomu
                    , 'NrMieszkania' => $umowa_pelnomocnik_adres->NrMieszkania
                    , 'KodPocztowy' => $umowa_pelnomocnik_adres->KodPocztowy
                    , 'Miasto' => $umowa_pelnomocnik_adres_miasto->Wartosc
                    , 'Pesel' => $umowa_pelnomocnik->Pesel
                    , 'Dowod' => $umowa_pelnomocnik->Dowod
                    , 'Mail' => $umowa_pelnomocnik_kontakt->Mail
                    , 'Telefon' => $umowa_pelnomocnik_kontakt->Telefon
                    , 'NazwaUS' => $urzad_skarbowy->Nazwa
                    , 'UlicaUS' => $adres_us_tmp->Ulica
                    , 'NrDomuUS' => $adres_us_tmp->NrDomu
                    , 'NrMieszkaniaUS' => $adres_us_tmp->NrMieszkania
                    , 'KodPocztowyUS' => $adres_us_tmp->KodPocztowy
                    , 'MiastoUS' => $miasto_us_tmp->Wartosc
                    , 'WielkoscUdzialu' => $lista_pelnomocnikow->WielkoscUdzialu
                    );
                } else {
                    $zmienne_pdf['pelnomocnik_' . $i] = array(
                        'Imie' => ''
                    , 'Nazwisko' => ''
                    , 'Nazwa' => ''
                    , 'Id' => ''
                    , 'Nip' => ''
                    , 'Krs' => ''
                    , 'DataUrodzenia' => ''
                    , 'Ulica' => ''
                    , 'NrDomu' => ''
                    , 'NrMieszkania' => ''
                    , 'KodPocztowy' => ''
                    , 'Miasto' => ''
                    , 'Pesel' => ''
                    , 'Dowod' => ''
                    , 'Mail' => ''
                    , 'Telefon' => ''
                    , 'NazwaUS' => ''
                    , 'UlicaUS' => ''
                    , 'NrDomuUS' => ''
                    , 'NrMieszkaniaUS' => ''
                    , 'KodPocztowyUS' => ''
                    , 'MiastoUS' => ''
                    , 'WielkoscUdzialu' => ''
                    );
                }

                $zmienne_pdf['pelnomocnik_'.$i] = json_encode($zmienne_pdf['pelnomocnik_'.$i]);
            }

            for ($i=1; $i<=$liczba_wlascicieli; $i++) {

                $lista_reprezentantow = $bazaDanych->pobierzDane('OsobaId, UrzadSkarbowyId, WielkoscUdzialu','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND NrOsoby = '.$i.' AND OsobaTypId=6');

                if($lista_reprezentantow) {
                    $lista_reprezentantow = $lista_reprezentantow->fetch_object();
                    $umowa_reprezentant = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $lista_reprezentantow->OsobaId);
                    $umowa_reprezentant = $umowa_reprezentant->fetch_object();
                    $umowa_reprezentant_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_reprezentant->AdresId);
                    $umowa_reprezentant_adres = $umowa_reprezentant_adres->fetch_object();
                    $umowa_reprezentant_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_reprezentant_adres->MiastoId);
                    $umowa_reprezentant_adres_miasto = $umowa_reprezentant_adres_miasto->fetch_object();
                    $umowa_reprezentant_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_reprezentant->KontaktId);
                    $umowa_reprezentant_kontakt = $umowa_reprezentant_kontakt->fetch_object();

                    $urzad_skarbowy = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $lista_reprezentantow->UrzadSkarbowyId);


                    if ($urzad_skarbowy) {
                        $urzad_skarbowy = $urzad_skarbowy->fetch_object();

                        $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy->AdresId);
                        $adres_us_tmp = $adres_us_tmp->fetch_object();

                        $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_tmp->MiastoId);
                        $miasto_us_tmp = $miasto_us_tmp->fetch_object();
                    }

                    $zmienne_pdf['reprezentant_' . $i] = array(
                        'Imie' => $umowa_reprezentant->Imie
                    , 'Nazwisko' => $umowa_reprezentant->Nazwisko
                    , 'Nazwa' => $umowa_reprezentant->Nazwa
                    , 'Id' => $umowa_reprezentant->Id
                    , 'Nip' => $umowa_reprezentant->Nip
                    , 'Krs' => $umowa_reprezentant->Krs
                    , 'DataUrodzenia' => $umowa_reprezentant->DataUrodzenia
                    , 'Ulica' => $umowa_reprezentant_adres->Ulica
                    , 'NrDomu' => $umowa_reprezentant_adres->NrDomu
                    , 'NrMieszkania' => $umowa_reprezentant_adres->NrMieszkania
                    , 'KodPocztowy' => $umowa_reprezentant_adres->KodPocztowy
                    , 'Miasto' => $umowa_reprezentant_adres_miasto->Wartosc
                    , 'Pesel' => $umowa_reprezentant->Pesel
                    , 'Dowod' => $umowa_reprezentant->Dowod
                    , 'Mail' => $umowa_reprezentant_kontakt->Mail
                    , 'Telefon' => $umowa_reprezentant_kontakt->Telefon
                    , 'NazwaUS' => $urzad_skarbowy->Nazwa
                    , 'UlicaUS' => $adres_us_tmp->Ulica
                    , 'NrDomuUS' => $adres_us_tmp->NrDomu
                    , 'NrMieszkaniaUS' => $adres_us_tmp->NrMieszkania
                    , 'KodPocztowyUS' => $adres_us_tmp->KodPocztowy
                    , 'MiastoUS' => $miasto_us_tmp->Wartosc
                    , 'WielkoscUdzialu' => $lista_reprezentant->WielkoscUdzialu
                    );
                } else {
                    $zmienne_pdf['reprezentant_' . $i] = array(
                        'Imie' => ''
                    , 'Nazwisko' => ''
                    , 'Nazwa' => ''
                    , 'Id' => ''
                    , 'Nip' => ''
                    , 'Krs' => ''
                    , 'DataUrodzenia' => ''
                    , 'Ulica' => ''
                    , 'NrDomu' => ''
                    , 'NrMieszkania' => ''
                    , 'KodPocztowy' => ''
                    , 'Miasto' => ''
                    , 'Pesel' => ''
                    , 'Dowod' => ''
                    , 'Mail' => ''
                    , 'Telefon' => ''
                    , 'NazwaUS' => ''
                    , 'UlicaUS' => ''
                    , 'NrDomuUS' => ''
                    , 'NrMieszkaniaUS' => ''
                    , 'KodPocztowyUS' => ''
                    , 'MiastoUS' => ''
                    , 'WielkoscUdzialu' => ''
                    );
                }

                $zmienne_pdf['reprezentant_'.$i] = json_encode($zmienne_pdf['reprezentant_'.$i]);
            }

            if ($umowaRzeczowa->UmowaTypKlientaId == 3) {
                $zaliczka_na_podatek = round($umowaRzeczowa->KwotaOdkupienia * 0.0);
                $do_zaplaty = $umowaRzeczowa->KwotaOdkupienia - $zaliczka_na_podatek;
            } else {
                $zaliczka_na_podatek = round($umowaRzeczowa->KwotaOdkupienia * 0.18);
                $do_zaplaty = $umowaRzeczowa->KwotaOdkupienia - $zaliczka_na_podatek;
            }


            $zmienne_pdf['umowa_dane'] = array(
                'Marka' => $umowa_pojazd->Marka
            ,'Model' => $umowa_pojazd->Model
            ,'NrRejestracyjny' => $umowa_pojazd->NrRejestracyjny
            ,'UmowaTypKlientaId' => $umowaRzeczowa->UmowaTypKlientaId
            ,'UbezpieczycielNazwa' => $umowa_ubezpieczyciel->Nazwa
            ,'UbezpieczycielUlica' => $umowa_ubezpieczyciel_adres->Ulica
            ,'UbezpieczycielNrDomu' => $umowa_ubezpieczyciel_adres->NrDomu
            ,'UbezpieczycielNrMieszkania' => $umowa_ubezpieczyciel_adres->NrMieszkania
            ,'UbezpieczycielKodPocztowy' => $umowa_ubezpieczyciel_adres->KodPocztowy
            ,'UbezpieczycielMiasto' => $umowa_ubezpieczyciel_adres_miasto->Wartosc
            ,'DataSzkody' => $umowaRzeczowa->DataSzkody
            ,'NumerAkt' => $umowaRzeczowa->NumerAkt
            ,'NazwaUbezpieczyciela' => $umowaRzeczowa->NazwaUbezpieczyciela
            ,'DataUmowyPrzelewu' => $umowaRzeczowa->DataUmowyPrzelewu
            ,'NumerSprawy' => $umowaRzeczowa->NumerSprawy
            ,'OtrzymanaKwotaWierzytelności' => $umowaRzeczowa->OtrzymanaKwotaWierzytelności
            ,'OtrzymanaKwotaWierzytelnościSlownie' => slownie(intval($umowaRzeczowa->OtrzymanaKwotaWierzytelności))
            ,'UzyskanoOdszkodowanie' => $umowaRzeczowa->UzyskanoOdszkodowanie
            ,'UzyskanoOdszkodowanieSlownie' => slownie(intval($umowaRzeczowa->UzyskanoOdszkodowanie))
            ,'KwotaOdszkodowania' => $umowaRzeczowa->KwotaOdszkodowania
            ,'KwotaOdkupienia' => $umowaRzeczowa->KwotaOdkupienia
            ,'KwotaOdkupieniaSlownie' => slownie(intval($umowaRzeczowa->KwotaOdkupienia))
            ,'OgraniczenieWierzytelnosci' => $umowaRzeczowa->OgraniczenieWierzytelnosci
            ,'ZaliczkaNaPodatek' => $zaliczka_na_podatek
            ,'KwotaDoZaplaty' => $do_zaplaty
            ,'ZaliczkaNaPodatekSlownie' => slownie(intval($zaliczka_na_podatek))
            ,'KwotaDoZaplatySlownie' => slownie(intval($do_zaplaty))
            ,'WysokoscHonorarium' => $umowaRzeczowa->WysokoscHonorarium
            ,'WysokoscHonorariumSlownie' => slownie(intval($umowaRzeczowa->WysokoscHonorarium))
            );

            $zmienne_pdf['umowa_dane'] = json_encode($zmienne_pdf['umowa_dane']);

$wynagrodzenie_numer = '';
$wynagrodzenie_odbiorca_id = $umowaRzeczowa->OdbiorcaId;
if(!empty($umowaRzeczowa->SposobPlatnosciId)){
    if($umowaRzeczowa->SposobPlatnosciId == 2){
        $wynagrodzenie_tmp = $bazaDanych->pobierzDane('*','umowaRachunekBankowy','Id = '.$umowaRzeczowa->RachunekBankowyId);

        if ($wynagrodzenie_tmp) {
            $wynagrodzenie_tmp = $wynagrodzenie_tmp->fetch_object();

            $wynagrodzenie_numer = $wynagrodzenie_tmp->Numer;
            $wynagrodzenie_odbiorca_id = $wynagrodzenie_tmp->OsobaId;
        }

    }

    if(!empty($wynagrodzenie_odbiorca_id)){
        $wynagrodzenie_odbiorca = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$wynagrodzenie_odbiorca_id);
        $wynagrodzenie_odbiorca = $wynagrodzenie_odbiorca->fetch_object();
        $wynagrodzenie_odbiorca_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$wynagrodzenie_odbiorca->AdresId);
        $wynagrodzenie_odbiorca_adres = $wynagrodzenie_odbiorca_adres->fetch_object();
        $wynagrodzenie_odbiorca_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$wynagrodzenie_odbiorca_adres->MiastoId);
        $wynagrodzenie_odbiorca_adres_miasto = $wynagrodzenie_odbiorca_adres_miasto->fetch_object();

        $zmienne_pdf['wynagrodzenie'] = array(
            'SposobPlatnosciId' => $umowaRzeczowa->SposobPlatnosciId
        ,'WynagdorzenieNumer' => $wynagrodzenie_numer
        ,'WynagdorzenieImie' => $wynagrodzenie_odbiorca->Imie
        ,'WynagdorzenieNazwisko' => $wynagrodzenie_odbiorca->Nazwisko
        ,'WynagdorzenieUlica' => $wynagrodzenie_odbiorca_adres->Ulica
        ,'WynagdorzenieNrDomu' => $wynagrodzenie_odbiorca_adres->NrDomu
        ,'WynagdorzenieNrMieszkania' => $wynagrodzenie_odbiorca_adres->NrMieszkania
        ,'WynagdorzenieKodPocztowy' => $wynagrodzenie_odbiorca_adres->KodPocztowy
        ,'WynagdorzenieMiasto' => $wynagrodzenie_odbiorca_adres_miasto->Wartosc
        );
        $zmienne_pdf['wynagrodzenie'] = json_encode($zmienne_pdf['wynagrodzenie']);

        //var_dump($zmienne_pdf['wynagrodzenie']);
    }

}

            /*----------------------------*/

    if(!empty($rodzaj_druku)){
        $nazwa_druku = $nazwa_druku.'_'.$rodzaj_druku;
    }

    $adres_http_umowy = 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/'.$droga.'/'.$nazwa_druku;

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'biblioteki/generator_pdf/vendor/autoload.php');
    use mikehaertl\wkhtmlto\Pdf;

    $opcje = array (
        'encoding' => 'UTF-8',
        'post' => $zmienne_pdf
    );
    $pdf = new Pdf ( array (
        'commandOptions' => array (
            'enableXvfb' => true,
            'xvfbRunBinary' => 'exec xvfb-run'
        )
    ) );

    $pdf->setOptions ( $opcje );
    $pdf->addPage ( $adres_http_umowy );

    if (! file_exists ( '/var/www/pliki/!druki/' . $element_id[0] )) {
        mkdir ( '/var/www/pliki/!druki/' . $element_id[0], 0777 );
    }

//$nazwa_pliku = date('U').'_'.$nazwa_druku;
$nazwa_pliku = $element_id[0].'_'.$nazwa_druku;

    if (! $pdf->saveAs ( '/var/www/pliki/!druki/' . $element_id[0] . '/'.$nazwa_pliku.'.pdf' )) {
        $komunikat = $pdf->getError();
    }

    $drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Wygenerowanie '.$nazwa_druku, '', $nazwa_pliku, 'umowa_historia_zmian');


    $komunikat = 'Wygenerowano poprawnie dokument!!!';
    $rodzajOut = 'sukces';

    $dane = array(
        'rodzaj' => $rodzajOut
        ,'komunikat' => $komunikat
        ,'element_id' => $element_id[0]
        ,'nazwa_pliku' => $nazwa_pliku

    );

    echo json_encode($dane);
    return;