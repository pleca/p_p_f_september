<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
    setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

    $drukiaMain = new DrukiMain();

    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '' ;
    $nazwa_druku = (isset($_POST['nazwa_druku'])) ? htmlspecialchars($_POST['nazwa_druku']) : '' ;

    $element_id = explode('-',$element_id);
    //$element_id[0] - umowa
    //$element_id[1] - glowny klient
    //$element_id[2] - umowa typ

    $komunikat = 'Brak akcji do wykonania!!!';
    $rodzajOut = 'blad';

    $zmienne_pdf = array();

    $umowa = $bazaDanych->pobierzDane('*','umowa','Id = '.$element_id[0]);
    $umowa = $umowa->fetch_object();

    $IdentyfikatorPrzedstawiciela = $bazaDanych->pobierzDane('login','uzytkownik','id = '.$umowa->PrzedstawicielId);
    $IdentyfikatorPrzedstawiciela = $IdentyfikatorPrzedstawiciela->fetch_object();

 /*   if(!empty($umowa->JednostkaId)){
        $KodJednostki = $bazaDanych->pobierzDane('Wartosc','umowaSlownikKodJednostki','Id = '.$umowa->JednostkaId);
        $KodJednostki = $KodJednostki->fetch_object();
    }*/


    $zmienne_pdf['umowa'] = array(
        'IdentyfikatorPrzedstawiciela' => $IdentyfikatorPrzedstawiciela->login
        ,'KodJednostki' => $umowa->JednostkaNumer
        ,'KodKonsultanta' => $umowa->KonsultantId
        ,'DataUmowy' => $umowa->DataUmowy
        ,'Miasto' => $umowa->Miasto
        ,'GrupaSprawId' => $umowa->GrupaSprawId
        ,'NrAnkiety' => $umowa->NrAnkiety
    );
    $zmienne_pdf['umowa'] = json_encode($zmienne_pdf['umowa']);

    $umowa_klient = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$element_id[1]);
    $umowa_klient = $umowa_klient->fetch_object();
    $umowa_klient_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_klient->AdresId);
    $umowa_klient_adres = $umowa_klient_adres->fetch_object();
    $umowa_klient_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_klient_adres->MiastoId);
    $umowa_klient_adres_miasto = $umowa_klient_adres_miasto->fetch_object();
    $umowa_klient_kontakt = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowa_klient->KontaktId);
    $umowa_klient_kontakt = $umowa_klient_kontakt->fetch_object();

    $zmienne_pdf['klient'] = array(
        'Imie' => $umowa_klient->Imie
        ,'Nazwisko' => $umowa_klient->Nazwisko
        ,'Ulica' => $umowa_klient_adres->Ulica
        ,'NrDomu' => $umowa_klient_adres->NrDomu
        ,'NrMieszkania' => $umowa_klient_adres->NrMieszkania
        ,'KodPocztowy' => $umowa_klient_adres->KodPocztowy
        ,'Miasto' => $umowa_klient_adres_miasto->Wartosc
        ,'Pesel' => $umowa_klient->Pesel
        ,'Dowod' => $umowa_klient->Dowod
        ,'Mail' => $umowa_klient_kontakt->Mail
        ,'Telefon' => $umowa_klient_kontakt->Telefon
    );
    $zmienne_pdf['klient'] = json_encode($zmienne_pdf['klient']);



    switch ($droga) {
        case 'ofe':

            $umowaOfe = $bazaDanych->pobierzDane('*','umowaOfe','Id = '.$element_id[2]);
            $umowaOfe = $umowaOfe->fetch_object();

            if($umowaOfe->UmowaDzialajacyWImieniuId != 4){
                $umowa_w_imieniu_opis = $bazaDanych->pobierzDane('Wartosc','umowaSlownikDzialajacWImieniu','Id = '.$umowaOfe->UmowaDzialajacyWImieniuId.' AND czy_usuniety = 0');
                $umowa_w_imieniu_opis = $umowa_w_imieniu_opis->fetch_object();
                $umowa_w_imieniu = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOfe->OsobaPoszkodowanyId);
                $umowa_w_imieniu = $umowa_w_imieniu->fetch_object();
                $umowa_w_imieniu_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_w_imieniu->AdresId);
                $umowa_w_imieniu_adres = $umowa_w_imieniu_adres->fetch_object();
                $umowa_w_imieniu_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_w_imieniu_adres->MiastoId);
                $umowa_w_imieniu_adres_miasto = $umowa_w_imieniu_adres_miasto->fetch_object();
                $umowa_w_imieniu_kontakt = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowa_w_imieniu->KontaktId);
                $umowa_w_imieniu_kontakt = $umowa_w_imieniu_kontakt->fetch_object();

                $zmienne_pdf['w_imieniu'] = array(
                    'Opis' => $umowaOfe->UmowaDzialajacyWImieniuId
                    ,'Imie' => $umowa_w_imieniu->Imie
                    ,'Nazwisko' => $umowa_w_imieniu->Nazwisko
                    ,'Pesel' => $umowa_w_imieniu->Pesel
                    ,'Dowod' => $umowa_w_imieniu->Dowod
                    ,'Mail' => $umowa_w_imieniu_kontakt->Mail
                    ,'Telefon' => $umowa_w_imieniu_kontakt->Telefon
                    ,'Ulica' => $umowa_w_imieniu_adres->Ulica
                    ,'NrDomu' => $umowa_w_imieniu_adres->NrDomu
                    ,'NrMieszkania' => $umowa_w_imieniu_adres->NrMieszkania
                    ,'KodPocztowy' => $umowa_w_imieniu_adres->KodPocztowy
                    ,'Miasto' => $umowa_w_imieniu_adres_miasto->Wartosc
                );
                $zmienne_pdf['w_imieniu'] = json_encode($zmienne_pdf['w_imieniu']);
            }
            if ($umowaOfe->OsobaZmarlyId != NULL) {

                $umowa_zmarly = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOfe->OsobaZmarlyId);
                $umowa_zmarly = $umowa_zmarly->fetch_object();

                $umowa_zmarly_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_zmarly->AdresId);
                $umowa_zmarly_adres = $umowa_zmarly_adres->fetch_object();
                $umowa_zmarly_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_zmarly_adres->MiastoId);
                $umowa_zmarly_miasto = $umowa_zmarly_miasto->fetch_object();
                $zm_rachunek_emerytalny = $bazaDanych->pobierzDane('*', 'umowaRachunekBankowy', "OsobaId=" . $umowaOfe->OsobaZmarlyId . " AND Typ=2");
                $zm_rachunek_emerytalny = $zm_rachunek_emerytalny->fetch_object();

                $zmienne_pdf['zmarly'] = array(
                    'Imie' => $umowa_zmarly->Imie
                , 'Nazwisko' => $umowa_zmarly->Nazwisko
                , 'Pesel' => $umowa_zmarly->Pesel
                , 'Nip' => $umowa_zmarly->Nip
                , 'Dowod' => $umowa_zmarly->Dowod
                , 'Ulica' => $umowa_zmarly_adres->Ulica
                , 'NrDomu' => $umowa_zmarly_adres->NrDomu
                , 'NrMieszkania' => $umowa_zmarly_adres->NrMieszkania
                , 'KodPocztowy' => $umowa_zmarly_adres->KodPocztowy
                , 'Wartosc' => $umowa_zmarly_miasto->Wartosc
                , 'Numer' => $zm_rachunek_emerytalny->Numer
                , 'Nazwa' => $zm_rachunek_emerytalny->Nazwa
                );
                $zmienne_pdf['zmarly'] = json_encode($zmienne_pdf['zmarly']);


                $zm_rachunek_bankowy = $bazaDanych->pobierzDane('*', 'umowaRachunekBankowy', "OsobaId=" . $umowaOfe->OsobaZmarlyId . " AND Typ=3");
                if ($zm_rachunek_bankowy) {
                    $zm_rachunek_bankowy = $zm_rachunek_bankowy->fetch_object();
                }
            }

            $zmienne_pdf['pozostale_informacje'] = array(
                'DataSmierci' => $umowaOfe->DataSmierci
            ,'Pokrewienstwo' => $umowaOfe->Pokrewienstwo
            ,'CzyPobieralEmeryture' => $umowaOfe->CzyPobieralEmeryture
            ,'DataPierwszejWyplaty' => $umowaOfe->DataPierwszejWyplaty
            ,'CzyZlozylWniosekOEmeryture' => $umowaOfe->CzyZlozylWniosekOEmeryture
            ,'CzyZmarlyWskazalOsoby' => $umowaOfe->CzyZmarlyWskazalOsoby
            ,'CzyBylPosiadaczemRachunkuBankowego' => $umowaOfe->CzyBylPosiadaczemRachunkuBankowego
            ,'CzyWydanoPostanowienie' => $umowaOfe->CzyWydanoPostanowienie
            ,'CzyZgloszonoRoszczenie' => $umowaOfe->CzyZgloszonoRoszczenie
            ,'CzyWyplaconoSrodki' => $umowaOfe->CzyWyplaconoSrodki
            ,'CzyZleconoPelnomocnikowi' => $umowaOfe->CzyZleconoPelnomocnikowi
            ,'CzyOdwolano' => $umowaOfe->CzyOdwolano
            ,'Nazwa' => $zm_rachunek_bankowy->Nazwa
            ,'Numer' => $zm_rachunek_bankowy->Numer
            ,'DataZgloszeniaRoszczenia' => $umowaOfe->DataZgloszeniaRoszczenia
            ,'KomuZlecono' => $umowaOfe->KomuZlecono
            ,'KiedyOdwolano' => $umowaOfe->KiedyOdwolano
            ,'InformacjeOdKlienta' => $umowaOfe->InformacjeOdKlienta
            ,'OswiadczenieODzialalnosci' => $umowaOfe->OswiadczenieODzialalnosci
            ,'ZgodaSms' => $umowaOfe->ZgodaSms
            ,'ZgodaNaInformacje' => $umowaOfe->ZgodaNaInformacje
            ,'ZgodaMail' => $umowaOfe->ZgodaMail
            ,'OfertaProtecta' => $umowaOfe->OfertaProtecta
            ,'OfertaFinansowa' => $umowaOfe->OfertaFinansowa
            );
            $zmienne_pdf['pozostale_informacje'] = json_encode($zmienne_pdf['pozostale_informacje']);


            //$zmienne_pdf['lista_dostepnej_dokumentacji'] = array();

            $lista_dokumentacji = $bazaDanych->pobierzDane('ZalacznikTypId','umowaZalacznikTypUmowaTyp','UmowaTypId = 2');

            if ($lista_dokumentacji) {
                $zmienne_pdf['lista_dostepnej_dokumentacji'] = array();
                while ($poj_lista_dokumentacji = $lista_dokumentacji->fetch_object()) {
                    $lista_dokumentacji_nazwa = $bazaDanych->pobierzDane('Id, Wartosc', 'umowaSlownikZalacznikTyp', 'Id = ' . $poj_lista_dokumentacji->ZalacznikTypId);
                    $lista_dokumentacji_nazwa = $lista_dokumentacji_nazwa->fetch_object();

                    $zmienne_pdf['lista_dostepnej_dokumentacji'][$poj_lista_dokumentacji->ZalacznikTypId] = $lista_dokumentacji_nazwa->Wartosc;

                }
                $zmienne_pdf['lista_dostepnej_dokumentacji'] = json_encode($zmienne_pdf['lista_dostepnej_dokumentacji']);


                //$zmienne_pdf['lista_pobranej_dokumentacji'] = '';
                //$zmienne_pdf['lista_zalacznikow'] = array();
                $lista_pobranej_dokumentacji = $bazaDanych->pobierzDane('ZalacznikTypId', 'umowaZalacznik', 'UmowaId = ' . $element_id[0] . ' AND czy_usuniety = 0');


                if ($lista_pobranej_dokumentacji) {
                    $zmienne_pdf['lista_pobranej_dokumentacji'] = '';
                    $zmienne_pdf['lista_zalacznikow'] = array();
                    while ($poj_lista_pobranej_dokumentacji = $lista_pobranej_dokumentacji->fetch_object()) {

                        $liczba_zalacznikow = mysqli_num_rows($bazaDanych->pobierzDane('*', 'umowaZalacznik', 'UmowaId = ' . $element_id[0] . ' AND czy_usuniety = 0 AND ZalacznikTypId = ' . $poj_lista_pobranej_dokumentacji->ZalacznikTypId));

                        $zmienne_pdf['lista_zalacznikow'][$poj_lista_pobranej_dokumentacji->ZalacznikTypId] = $liczba_zalacznikow;

                        $zmienne_pdf['lista_pobranej_dokumentacji'] .= $poj_lista_pobranej_dokumentacji->ZalacznikTypId . ',';
                    }
                    $zmienne_pdf['lista_zalacznikow'] = json_encode($zmienne_pdf['lista_zalacznikow']);
                }

            }

           //$zmienne_pdf['lista_uprawnionych'] = '';
            $lista_uprawnionych = $bazaDanych->pobierzDane('OsobaId','umowaOfeOsoba','OfeId = '.$element_id[2].' AND TypOsoby = 4');
            if(!is_null($lista_uprawnionych)){
                $zmienne_pdf['lista_uprawnionych'] = '';
                while($poj_lista_uprawnionych = $lista_uprawnionych->fetch_object()){
                    $uprawniony_nazwa = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id='.$poj_lista_uprawnionych->OsobaId);
                    $uprawniony_nazwa = $uprawniony_nazwa->fetch_object();
                    $zmienne_pdf['lista_uprawnionych'] .= $uprawniony_nazwa->Imie.' '.$uprawniony_nazwa->Nazwisko.', ';
                }
            }

            //$zmienne_pdf['lista_spadkobiercow'] = '';
            $lista_spadkobiercow = $bazaDanych->pobierzDane('OsobaId','umowaOfeOsoba','OfeId = '.$element_id[2].' AND TypOsoby = 5');
            if(!is_null($lista_spadkobiercow)){
                $zmienne_pdf['lista_spadkobiercow'] = '';
                while($poj_lista_spadkobiercow = $lista_spadkobiercow->fetch_object()){
                    $spadkobierca_nazwa = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id='.$poj_lista_spadkobiercow->OsobaId);
                    $spadkobierca_nazwa = $spadkobierca_nazwa->fetch_object();
                    $zmienne_pdf['lista_spadkobiercow'] .= $spadkobierca_nazwa->Imie.' '.$spadkobierca_nazwa->Nazwisko.', ';
                }
            }


         break;

        case 'osobowa':

            $umowaOsobowa = $bazaDanych->pobierzDane('*','umowaOsobowa','Id = '.$element_id[2]);
            $umowaOsobowa = $umowaOsobowa->fetch_object();

            $zmienne_pdf['umowa_dane'] = array(
                'RodzajSzkodyId' => $umowaOsobowa->RodzajSzkodyId
            , 'TypSzkodyId' => $umowaOsobowa->TypSzkodyId
            , 'TypZdarzeniaId' => $umowaOsobowa->TypZdarzeniaId
            , 'InnyRodzajSzkody' => $umowaOsobowa->InnyRodzajSzkody
            );
            $zmienne_pdf['umowa_dane'] = json_encode($zmienne_pdf['umowa_dane']);

            $umowaZdarzenie = $bazaDanych->pobierzDane('*','umowaZdarzenie','Id = '.$umowaOsobowa->ZdarzenieId);

            if($umowaZdarzenie) {
                $umowaZdarzenie = $umowaZdarzenie->fetch_object();


                $zmienne_pdf['zdarzenie'] = array(
                    'Data' => $umowaZdarzenie->Data
                , 'Godzina' => $umowaZdarzenie->Godzina
                , 'Miejscowosc' => $umowaZdarzenie->Miejscowosc
                , 'OpisZdarzenia' => $umowaZdarzenie->OpisZdarzenia
                , 'OpisObrazen' => $umowaZdarzenie->OpisObrazen
                );
                $zmienne_pdf['zdarzenie'] = json_encode($zmienne_pdf['zdarzenie']);

            }
            $umowaPoszkodowany = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOsobowa->OsobaPoszkodowanyId);

            if ($umowaPoszkodowany) {

                $umowaPoszkodowany = $umowaPoszkodowany->fetch_object();

                $umowaPoszkodowanyAdres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowaPoszkodowany->AdresId);
                $umowaPoszkodowanyAdres = $umowaPoszkodowanyAdres->fetch_object();
                $umowaPoszkodowanyAdresMiasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowaPoszkodowanyAdres->MiastoId);
                $umowaPoszkodowanyAdresMiasto = $umowaPoszkodowanyAdresMiasto->fetch_object();
                $umowaPoszkodowanyAdresKontakt = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowaPoszkodowany->KontaktId);
                $umowaPoszkodowanyAdresKontakt = $umowaPoszkodowanyAdresKontakt->fetch_object();

                $zmienne_pdf['poszkodowany'] = array(
                    'Imie' => $umowaPoszkodowany->Imie
                , 'Nazwisko' => $umowaPoszkodowany->Nazwisko
                , 'Pesel' => $umowaPoszkodowany->Pesel
                , 'Dowod' => $umowaPoszkodowany->Dowod
                , 'Ulica' => $umowaPoszkodowanyAdres->Ulica
                , 'NrDomu' => $umowaPoszkodowanyAdres->NrDomu
                , 'NrMieszkania' => $umowaPoszkodowanyAdres->NrMieszkania
                , 'KodPocztowy' => $umowaPoszkodowanyAdres->KodPocztowy
                , 'Miasto' => $umowaPoszkodowanyAdresMiasto->Wartosc
                , 'Telefon' => $umowaPoszkodowanyAdresKontakt->Telefon
                , 'Mail' => $umowaPoszkodowanyAdresKontakt->Mail
                , 'Wyksztalcenie' => $umowaPoszkodowany->Wyksztalcenie
                , 'ZawodWyuczony' => $umowaPoszkodowany->ZawodWyuczony
                , 'ZawodWykonywany' => $umowaPoszkodowany->ZawodWykonywany
                , 'DodatkoweUprawnienia' => $umowaPoszkodowany->DodatkoweUprawnienia
                , 'Zatrudnienie' => $umowaPoszkodowany->Zatrudnienie
                , 'ZatrudnienieInne' => $umowaPoszkodowany->ZatrudnienieInne
                , 'Zarobki' => $umowaPoszkodowany->Zarobki

                );
                $zmienne_pdf['poszkodowany'] = json_encode($zmienne_pdf['poszkodowany']);
            }

            $umowaUprawniony = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOsobowa->OsobaUprawnionyId);

            if ($umowaUprawniony) {

                $umowaUprawniony = $umowaUprawniony->fetch_object();

                $umowaUprawnionyAdres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowaUprawniony->AdresId);
                $umowaUprawnionyAdres = $umowaUprawnionyAdres->fetch_object();
                $umowaUprawnionyAdresMiasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowaUprawnionyAdres->MiastoId);
                $umowaUprawnionyAdresMiasto = $umowaUprawnionyAdresMiasto->fetch_object();
                $umowaUprawnionyAdresKontakt = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowaUprawniony->KontaktId);
                $umowaUprawnionyAdresKontakt = $umowaUprawnionyAdresKontakt->fetch_object();

                $zmienne_pdf['uprawniony'] = array(
                    'Imie' => $umowaUprawniony->Imie
                , 'Nazwisko' => $umowaUprawniony->Nazwisko
                , 'Pesel' => $umowaUprawniony->Pesel
                , 'Dowod' => $umowaUprawniony->Dowod
                , 'Ulica' => $umowaUprawnionyAdres->Ulica
                , 'NrDomu' => $umowaUprawnionyAdres->NrDomu
                , 'NrMieszkania' => $umowaUprawnionyAdres->NrMieszkania
                , 'KodPocztowy' => $umowaUprawnionyAdres->KodPocztowy
                , 'Miasto' => $umowaUprawnionyAdresMiasto->Wartosc
                , 'Telefon' => $umowaUprawnionyAdresKontakt->Telefon
                , 'Mail' => $umowaUprawnionyAdresKontakt->Mail
                , 'Wyksztalcenie' => $umowaUprawniony->Wyksztalcenie
                , 'ZawodWyuczony' => $umowaUprawniony->ZawodWyuczony
                , 'ZawodWykonywany' => $umowaUprawniony->ZawodWykonywany
                , 'DodatkoweUprawnienia' => $umowaUprawniony->DodatkoweUprawnienia
                , 'Zatrudnienie' => $umowaUprawniony->Zatrudnienie
                , 'ZatrudnienieInne' => $umowaUprawniony->ZatrudnienieInne
                , 'Zarobki' => $umowaUprawniony->Zarobki

                );
                $zmienne_pdf['uprawniony'] = json_encode($zmienne_pdf['uprawniony']);
            }

            $umowaUprawnionyDoInf = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOsobowa->OsobaUprawnionyDoInfId);

            if ($umowaUprawnionyDoInf) {

                $umowaUprawnionyDoInf = $umowaUprawnionyDoInf->fetch_object();

                $zmienne_pdf['uprawniony_do_inf'] = array(
                    'Imie' => $umowaUprawnionyDoInf->Imie
                , 'Nazwisko' => $umowaUprawnionyDoInf->Nazwisko
                , 'Pesel' => $umowaUprawnionyDoInf->Pesel
                , 'Id' => $umowaOsobowa->OsobaUprawnionyDoInfId
                );
                $zmienne_pdf['uprawniony_do_inf'] = json_encode($zmienne_pdf['uprawniony_do_inf']);
            }

            $umowaPojazdA = $bazaDanych->pobierzDane('*','umowaPojazd','Id = '.$umowaZdarzenie->PojazdAId);

            if ($umowaPojazdA) {
                $umowaPojazdA = $umowaPojazdA->fetch_object();
                $zmienne_pdf['PojazdA'] = array(
                    'Marka' => $umowaPojazdA->Marka
                , 'Model' => $umowaPojazdA->Model
                , 'Typ' => $umowaPojazdA->Typ
                , 'NrRejestracyjny' => $umowaPojazdA->NrRejestracyjny
                , 'KrajRejestracji' => $umowaPojazdA->KrajRejestracji
                , 'NumerPolisy' => $umowaPojazdA->NumerPolisy
                , 'KierujacyPojazdem' => $umowaPojazdA->KierujacyPojazdem
                , 'PosiadaczPojazdu' => $umowaPojazdA->PosiadaczPojazdu
                , 'Ubezpieczyciel' => $umowaPojazdA->Ubezpieczyciel
                , 'SprawcaPojazd' => $umowaPojazdA->SprawcaPojazd
                );
                $zmienne_pdf['PojazdA'] = json_encode($zmienne_pdf['PojazdA']);
            }

            $umowaPojazdB = $bazaDanych->pobierzDane('*','umowaPojazd','Id = '.$umowaZdarzenie->PojazdBId);

            if ($umowaPojazdB) {
                $umowaPojazdB = $umowaPojazdB->fetch_object();
                $zmienne_pdf['PojazdB'] = array(
                    'Marka' => $umowaPojazdB->Marka
                , 'Model' => $umowaPojazdB->Model
                , 'Typ' => $umowaPojazdB->Typ
                , 'NrRejestracyjny' => $umowaPojazdB->NrRejestracyjny
                , 'KrajRejestracji' => $umowaPojazdB->KrajRejestracji
                , 'NumerPolisy' => $umowaPojazdB->NumerPolisy
                , 'KierujacyPojazdem' => $umowaPojazdB->KierujacyPojazdem
                , 'PosiadaczPojazdu' => $umowaPojazdB->PosiadaczPojazdu
                , 'Ubezpieczyciel' => $umowaPojazdB->Ubezpieczyciel
                , 'SprawcaPojazd' => $umowaPojazdB->SprawcaPojazd
                );
                $zmienne_pdf['PojazdB'] = json_encode($zmienne_pdf['PojazdB']);
            }

            $umowaOdpowiedzialnoscKarna = $bazaDanych->pobierzDane('*','umowaOdpowiedzialnoscKarna','Id = '.$umowaOsobowa->OdpowiedzialnoscKarnaId);

            if ($umowaOdpowiedzialnoscKarna) {

                $umowaOdpowiedzialnoscKarna = $umowaOdpowiedzialnoscKarna->fetch_object();

                $zmienne_pdf['odpowiedzialnosc_karna'] = array(
                'WezwanoPolicje' => $umowaOdpowiedzialnoscKarna->WezwanoPolicje
                , 'MiejscowoscPolicji' => $umowaOdpowiedzialnoscKarna->MiejscowoscPolicji
                , 'WszczetoPostepowanie' => $umowaOdpowiedzialnoscKarna->WszczetoPostepowanie
                , 'RodzajZakonczenia' => $umowaOdpowiedzialnoscKarna->RodzajZakonczenia
                , 'Sad' => $umowaOdpowiedzialnoscKarna->Sad
                );
                $zmienne_pdf['odpowiedzialnosc_karna'] = json_encode($zmienne_pdf['odpowiedzialnosc_karna']);
            }

            $umowaOdpowiedzialnoscCywilna = $bazaDanych->pobierzDane('*','umowaOdpowiedzialnoscCywilna','Id = '.$umowaOsobowa->OdpowiedzialnoscCywilnaId);

            if ($umowaOdpowiedzialnoscCywilna) {

                $umowaOdpowiedzialnoscCywilna = $umowaOdpowiedzialnoscCywilna->fetch_object();

                $zmienne_pdf['odpowiedzialnosc_cywilna'] = array(
                'ZgloszonoPojazdZOc' => $umowaOdpowiedzialnoscCywilna->ZgloszonoPojazdZOc
                , 'ZgloszonoOsobeZOc' => $umowaOdpowiedzialnoscCywilna->ZgloszonoOsobeZOc
                , 'WyplaconoZOcSprawcy' => $umowaOdpowiedzialnoscCywilna->WyplaconoZOcSprawcy
                , 'KwotaOdszkodowania' => $umowaOdpowiedzialnoscCywilna->KwotaOdszkodowania
                , 'PodstawaPrawna' => $umowaOdpowiedzialnoscCywilna->PodstawaPrawna
                , 'DataWyroku' => $umowaOdpowiedzialnoscCywilna->DataWyroku
                );
                $zmienne_pdf['odpowiedzialnosc_cywilna'] = json_encode($zmienne_pdf['odpowiedzialnosc_cywilna']);
            }

            $umowaInneOdszkodowania = $bazaDanych->pobierzDane('*','umowaInneOdszkodowania','Id = '.$umowaOsobowa->InneOdszkodowaniaId);

            if ($umowaInneOdszkodowania) {

                $umowaInneOdszkodowania = $umowaInneOdszkodowania->fetch_object();

                $zmienne_pdf['inne_odszkodowania'] = array(
                    'ZgloszonoZNnw' => $umowaInneOdszkodowania->ZgloszonoZNnw
                , 'NazwaUbezpieczycielaNnw' => $umowaInneOdszkodowania->NazwaUbezpieczycielaNnw
                , 'OkreslonoUszczerbekNnw' => $umowaInneOdszkodowania->OkreslonoUszczerbekNnw
                , 'ProcentUszczerbkuNnw' => $umowaInneOdszkodowania->ProcentUszczerbkuNnw
                , 'JakiWypadek' => $umowaInneOdszkodowania->JakiWypadek
                , 'ZgloszonoSzkode' => $umowaInneOdszkodowania->ZgloszonoSzkode
                , 'GdzieZgloszono' => $umowaInneOdszkodowania->GdzieZgloszono
                , 'GdzieZgloszonoInne' => $umowaInneOdszkodowania->GdzieZgloszonoInne
                , 'ProcentUszczerbku' => $umowaInneOdszkodowania->ProcentUszczerbku
                , 'PrzyznanoOdszkodowanie' => $umowaInneOdszkodowania->PrzyznanoOdszkodowanie
                , 'WysokoscOdszkodowania' => $umowaInneOdszkodowania->WysokoscOdszkodowania
                , 'ZasilekPogrzebowy' => $umowaInneOdszkodowania->ZasilekPogrzebowy
                );
                $zmienne_pdf['inne_odszkodowania'] = json_encode($zmienne_pdf['inne_odszkodowania']);
            }

            $przebieg_leczenia = $bazaDanych->pobierzDane('*','umowaPrzebiegLeczenia','Id = '.$umowaOsobowa->PrzebiegLeczeniaId);

            if ($przebieg_leczenia) {

                $przebieg_leczenia = $przebieg_leczenia->fetch_object();

                $zmienne_pdf['przebieg_leczenia'] = array(
                    'Obrazenia' => $przebieg_leczenia->Obrazenia
                , 'PrzeprowadzonoZabiegi' => $przebieg_leczenia->PrzeprowadzonoZabiegi
                , 'MiejscePrzebywania' => $przebieg_leczenia->MiejscePrzebywania
                , 'InneMiejscePrzebywania' => $przebieg_leczenia->InneMiejscePrzebywania
                );
                $zmienne_pdf['przebieg_leczenia'] = json_encode($zmienne_pdf['przebieg_leczenia']);
            }

            $umowaOswiadczeniePoszkodowanego = $bazaDanych->pobierzDane('*','umowaOswiadczeniePoszkodowanego','Id = '.$umowaOsobowa->OswiadczeniePoszkodowanegoId);

            if ($umowaOswiadczeniePoszkodowanego) {
                $umowaOswiadczeniePoszkodowanego = $umowaOswiadczeniePoszkodowanego->fetch_object();

                $zmienne_pdf['oswiadczenie_poszkodowanego'] = array(
                    'PodWplywem' => $umowaOswiadczeniePoszkodowanego->PodWplywem
                , 'PodJakimWplywem' => $umowaOswiadczeniePoszkodowanego->PodJakimWplywem
                , 'TypPojazdu' => $umowaOswiadczeniePoszkodowanego->TypPojazdu
                , 'TypPojazduInny' => $umowaOswiadczeniePoszkodowanego->TypPojazduInny
                , 'KierowcaPasazer' => $umowaOswiadczeniePoszkodowanego->KierowcaPasazer
                , 'PieszyRowerzysta' => $umowaOswiadczeniePoszkodowanego->PieszyRowerzysta
                , 'MiejsceGdzieSiedzial' => $umowaOswiadczeniePoszkodowanego->MiejsceGdzieSiedzial
                , 'MiejsceGdzieSiedzialInne' => $umowaOswiadczeniePoszkodowanego->MiejsceGdzieSiedzialInne
                , 'ZapietePasy' => $umowaOswiadczeniePoszkodowanego->ZapietePasy
                , 'WlascicielWspolwlasciciel' => $umowaOswiadczeniePoszkodowanego->WlascicielWspolwlasciciel
                , 'WiedzaCzyPodWplywem' => $umowaOswiadczeniePoszkodowanego->WiedzaCzyPodWplywem
                , 'WiedzaOUprawnieniach' => $umowaOswiadczeniePoszkodowanego->WiedzaOUprawnieniach
                , 'NastepstwaObrazen' => $umowaOswiadczeniePoszkodowanego->NastepstwaObrazen
                , 'DataZakonczeniaLeczenia' => $umowaOswiadczeniePoszkodowanego->DataZakonczeniaLeczenia
                , 'PrzewidzianaDataZakonczenia' => $umowaOswiadczeniePoszkodowanego->PrzewidzianaDataZakonczenia
                , 'DataZwolnieniaOd' => $umowaOswiadczeniePoszkodowanego->DataZwolnieniaOd
                , 'DataZwolnieniaDo' => $umowaOswiadczeniePoszkodowanego->DataZwolnieniaDo
                , 'TerminZwolnienia' => $umowaOswiadczeniePoszkodowanego->TerminZwolnienia
                , 'PrzebiegLeczeniaId' => $umowaOswiadczeniePoszkodowanego->PrzebiegLeczeniaId
                );
                $zmienne_pdf['oswiadczenie_poszkodowanego'] = json_encode($zmienne_pdf['oswiadczenie_poszkodowanego']);


                $umowaPrzebiegLeczenia = $bazaDanych->pobierzDane('*','umowaPrzebiegLeczenia','Id = '.$umowaOswiadczeniePoszkodowanego->PrzebiegLeczeniaId);

                if ($umowaPrzebiegLeczenia) {

                    $umowaPrzebiegLeczenia = $umowaPrzebiegLeczenia->fetch_object();

                    $zmienne_pdf['przebieg_leczenia'] = array(
                        'WezwanoPogotowie' => $umowaPrzebiegLeczenia->WezwanoPogotowie
                    , 'PogotowieMiejscowosc' => $umowaPrzebiegLeczenia->PogotowieMiejscowosc
                    , 'PogotowieSzpital' => $umowaPrzebiegLeczenia->PogotowieSzpital
                    , 'ZglosilDoLekarza' => $umowaPrzebiegLeczenia->ZglosilDoLekarza
                    , 'DaneLekarza' => $umowaPrzebiegLeczenia->DaneLekarza
                    , 'DanePrzychodni' => $umowaPrzebiegLeczenia->DanePrzychodni
                    , 'Hospitalizacja' => $umowaPrzebiegLeczenia->Hospitalizacja
                    , 'Zabiegi' => $umowaPrzebiegLeczenia->Zabiegi
                    );
                    $zmienne_pdf['przebieg_leczenia'] = json_encode($zmienne_pdf['przebieg_leczenia']);
                }
            }

            /*$lista_szpitali = $bazaDanych->pobierzDane('*','umowaHospitalizacja','IdPrzebieguLeczenia = '.$umowaOswiadczeniePoszkodowanego->PrzebiegLeczeniaId);
            $liczba_szpitali = mysqli_num_rows($lista_szpitali);

            $zmienne_pdf['liczba_szpitali'] = $liczba_szpitali;

            for ($i=1; $i<=$liczba_szpitali; $i++) {

               if($lista_szpitali) {
                    $lista_szpitali = $bazaDanych->pobierzDane('*','umowaHospitalizacja','IdPrzebieguLeczenia = '.$umowaOswiadczeniePoszkodowanego->PrzebiegLeczeniaId);
                    $lista_szpitali = $lista_szpitali->fetch_object();

                    $zmienne_pdf['hospitalizacja_' . $i] = array(
                        'MiejsceHospitalizacji' => $lista_szpitali->MiejsceHospitalizacji
                    , 'DataOdKiedy' => $lista_szpitali->DataOdKiedy
                    , 'DataDoKiedy' => $lista_szpitali->DataDoKiedy
                    );

                } else {

                    $zmienne_pdf['hospitalizacja_' . $i] = array(
                        'MiejsceHospitalizacji' => ''
                    , 'DataOdKiedy' => ''
                    , 'DataDoKiedy' => ''
                    );
                }
                $zmienne_pdf['hospitalizacja_'.$i] = json_encode($zmienne_pdf['hospitalizacja_'.$i]);
            }

            $lista_placowek = $bazaDanych->pobierzDane('*','umowaPlacowki','IdPrzebieguLeczenia = '.$umowaOswiadczeniePoszkodowanego->PrzebiegLeczeniaId);
            $liczba_placowek = mysqli_num_rows($lista_placowek);

            $zmienne_pdf['liczba_placowek'] = $liczba_placowek;

            for ($i=1; $i<=$liczba_placowek; $i++) {

                if($lista_szpitali) {
                    $lista_placowek = $bazaDanych->pobierzDane('*','umowaPlacowki','IdPrzebieguLeczenia = '.$umowaOswiadczeniePoszkodowanego->PrzebiegLeczeniaId);
                    $lista_placowek = $lista_placowek->fetch_object();

                    $zmienne_pdf['placowki_' . $i] = array(
                        'NazwaPlacowki' => $lista_placowek->NazwaPlacowki
                    , 'DataZabiegu' => $lista_placowek->DataZabiegu
                    );

                } else {

                    $zmienne_pdf['placowki_' . $i] = array(
                        'NazwaPlacowki' => ''
                    , 'DataZabiegu' => ''
                    );
                }
                $zmienne_pdf['placowki_'.$i] = json_encode($zmienne_pdf['placowki_'.$i]);
            }*/

            $umowaDochodzenieRoszczen = $bazaDanych->pobierzDane('*','umowaDochodzenieRoszczen','Id = '.$umowaOsobowa->DochodzenieRoszczenId);

            if ($umowaDochodzenieRoszczen) {

                $umowaDochodzenieRoszczen = $umowaDochodzenieRoszczen->fetch_object();

                $zmienne_pdf['dochodzenie_roszczen'] = array(
                    'RoszczeniaOdUbezpieczyciela' => $umowaDochodzenieRoszczen->RoszczeniaOdUbezpieczyciela
                , 'RoszczeniaOdPracodawcy' => $umowaDochodzenieRoszczen->RoszczeniaOdPracodawcy
                , 'ZleconoRoszczenia' => $umowaDochodzenieRoszczen->ZleconoRoszczenia
                , 'NazwaPelnomocnika' => $umowaDochodzenieRoszczen->NazwaPelnomocnika
                , 'DataZawarciaUmowy' => $umowaDochodzenieRoszczen->DataZawarciaUmowy
                , 'WypowiedzenieUmowy' => $umowaDochodzenieRoszczen->WypowiedzenieUmowy
                , 'DataWypowiedzenia' => $umowaDochodzenieRoszczen->DataWypowiedzenia
                , 'PrzekazanoDokumentacje' => $umowaDochodzenieRoszczen->PrzekazanoDokumentacje
                , 'IloscKart' => $umowaDochodzenieRoszczen->IloscKart
                , 'IloscKartSlownie' => slownie(intval($umowaDochodzenieRoszczen->IloscKart))
                );
                $zmienne_pdf['dochodzenie_roszczen'] = json_encode($zmienne_pdf['dochodzenie_roszczen']);
            }

            $umowaOswiadczenieUprawnionego = $bazaDanych->pobierzDane('*','umowaOswiadczenieUprawnionego','Id = '.$umowaOsobowa->OswiadczenieUprawnionegoId);

            if ($umowaOswiadczenieUprawnionego) {
                $umowaOswiadczenieUprawnionego = $umowaOswiadczenieUprawnionego->fetch_object();

                $zmienne_pdf['oswiadczenie_uprawnionego'] = array(
                    'PogorszenieSytuacjiZyciowej' => $umowaOswiadczenieUprawnionego->PogorszenieSytuacjiZyciowej
                , 'WystapienieKrzywdy' => $umowaOswiadczenieUprawnionego->WystapienieKrzywdy
                , 'WiekZmWMomencieSmierci' => $umowaOswiadczenieUprawnionego->WiekZmWMomencieSmierci
                , 'WiekUprWMomencieSmierci' => $umowaOswiadczenieUprawnionego->WiekUprWMomencieSmierci
                );
                $zmienne_pdf['oswiadczenie_uprawnionego'] = json_encode($zmienne_pdf['oswiadczenie_uprawnionego']);
            }

            $umowaStosunkiRodzinne = $bazaDanych->pobierzDane('*','umowaStosunkiRodzinne','Id = '.$umowaOswiadczenieUprawnionego->StosunkiRodzinneId);

            if ($umowaStosunkiRodzinne) {
                $umowaStosunkiRodzinne = $umowaStosunkiRodzinne->fetch_object();

                $zmienne_pdf['stosunki_rodzinne'] = array(
                    'PokrewienstwoZeZmarlym' => $umowaStosunkiRodzinne->PokrewienstwoZeZmarlym
                , 'PokrewienstwoInneZeZmarlym' => $umowaStosunkiRodzinne->PokrewienstwoInneZeZmarlym
                , 'WspolneGospodarstwo' => $umowaStosunkiRodzinne->WspolneGospodarstwo
                , 'TenSamAdres' => $umowaStosunkiRodzinne->TenSamAdres
                , 'InnyAdres' => $umowaStosunkiRodzinne->InnyAdres
                , 'PomagalWObowiazkach' => $umowaStosunkiRodzinne->PomagalWObowiazkach
                , 'StosunkiZeZmarlym' => $umowaStosunkiRodzinne->StosunkiZeZmarlym
                , 'BylNaUtrzymaniu' => $umowaStosunkiRodzinne->BylNaUtrzymaniu
                , 'LozylNaUtrzymanie' => $umowaStosunkiRodzinne->LozylNaUtrzymanie
                , 'WspolneKonto' => $umowaStosunkiRodzinne->WspolneKonto
                , 'PartycypowalKoszty' => $umowaStosunkiRodzinne->PartycypowalKoszty
                , 'WspieralbyFinansowo' => $umowaStosunkiRodzinne->WspieralbyFinansowo
                );
                $zmienne_pdf['stosunki_rodzinne'] = json_encode($zmienne_pdf['stosunki_rodzinne']);
            }

            /*$umowaSytuacjaPoSmierci = $bazaDanych->pobierzDane('*','umowaSytuacjaPoSmierci','Id = '.$umowaOswiadczenieUprawnionego->SytuacjaPoSmierciId);

            if ($umowaSytuacjaPoSmierci) {
                $umowaSytuacjaPoSmierci = $umowaSytuacjaPoSmierci->fetch_object();

                $zmienne_pdf['sytuacja_po_smierci'] = array(
                    'SytuacjaMaterialna' => $umowaSytuacjaPoSmierci->SytuacjaMaterialna
                , 'MotywacjaUprawnionego' => $umowaSytuacjaPoSmierci->MotywacjaUprawnionego
                , 'WstrzasPsychiczny' => $umowaSytuacjaPoSmierci->WstrzasPsychiczny
                , 'KorzystalZeSrodkow' => $umowaSytuacjaPoSmierci->KorzystalZeSrodkow
                , 'StanUleglPogorszeniu' => $umowaSytuacjaPoSmierci->StanUleglPogorszeniu
                , 'KorzystalZPorad' => $umowaSytuacjaPoSmierci->KorzystalZPorad
                , 'Porady' => $umowaSytuacjaPoSmierci->Porady
                , 'Wdowa' => $umowaSytuacjaPoSmierci->Wdowa
                , 'Dzieci' => $umowaSytuacjaPoSmierci->Dzieci
                , 'LiczbaDzieci' => $umowaSytuacjaPoSmierci->LiczbaDzieci
                , 'WiekDzieci' => $umowaSytuacjaPoSmierci->WiekDzieci
                );
                $zmienne_pdf['sytuacja_po_smierci'] = json_encode($zmienne_pdf['sytuacja_po_smierci']);
            }

            $umowaOswiadczenie = $bazaDanych->pobierzDane('*','umowaOswiadczenie','Id = '.$umowaOsobowa->OswiadczenieId);

            if ($umowaOswiadczenie) {
                $umowaOswiadczenie = $umowaOswiadczenie->fetch_object();

                $osobaDoOSwiadczenia = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOswiadczenie->OsobaId);
                $osobaDoOSwiadczenia = $osobaDoOSwiadczenia->fetch_object();
                $osobaDoOSwiadczeniaAdres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$osobaDoOSwiadczenia->AdresId);
                $osobaDoOSwiadczeniaAdres = $osobaDoOSwiadczeniaAdres->fetch_object();
                $osobaDoOSwiadczeniaAdresMiasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$osobaDoOSwiadczeniaAdres->MiastoId);
                $osobaDoOSwiadczeniaAdresMiasto = $osobaDoOSwiadczeniaAdresMiasto->fetch_object();

                $zmienne_pdf['oswiadczenie'] = array(
                    'Miejscowosc' => $umowaOswiadczenie->Miejscowosc
                , 'Data' => $umowaOswiadczenie->Data
                , 'Tresc' => $umowaOswiadczenie->Tresc
                , 'Adres' => $osobaDoOSwiadczeniaAdres->Ulica.' '.$osobaDoOSwiadczeniaAdres->NrDomu.' '.$osobaDoOSwiadczeniaAdres->NrMieszkania.' '.$osobaDoOSwiadczeniaAdres->KodPocztowy.' '.$osobaDoOSwiadczeniaAdresMiasto->Wartosc
                , 'Osoba' => $osobaDoOSwiadczenia->Imie.' '.$osobaDoOSwiadczenia->Nazwisko
                );
                $zmienne_pdf['oswiadczenie'] = json_encode($zmienne_pdf['oswiadczenie']);
            }*/


            break;
    }

    $adres_http_umowy = 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/'.$droga.'/'.$nazwa_druku.'';

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
