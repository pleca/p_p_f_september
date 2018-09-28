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

    $IdentyfikatorPrzedstawiciela = $bazaDanych->pobierzDane('login, imie, nazwisko','uzytkownik','id = '.$umowa->PrzedstawicielId);
    $IdentyfikatorPrzedstawiciela = $IdentyfikatorPrzedstawiciela->fetch_object();

/*    if(!empty($umowa->JednostkaId)){
        $KodJednostki = $bazaDanych->pobierzDane('Wartosc','umowaSlownikKodJednostki','Id = '.$umowa->JednostkaId);
        $KodJednostki = $KodJednostki->fetch_object();
    }*/

    $zmienne_pdf['umowa'] = array(
        'IdentyfikatorPrzedstawiciela' => $IdentyfikatorPrzedstawiciela->login
        ,'Imie' => $IdentyfikatorPrzedstawiciela->imie
        ,'Nazwisko' => $IdentyfikatorPrzedstawiciela->nazwisko
        ,'KodJednostki' => $umowa->JednostkaNumer
        ,'KonsultantId' => $umowa->KonsultantId
        ,'DataUmowy' => $umowa->DataUmowy
        ,'Miasto' => $umowa->Miasto
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
        ,'IdKlienta' => $umowa_klient->Id
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

        case 'osobowa':

            $umowaOsobowa = $bazaDanych->pobierzDane('*','umowaOsobowa','Id = '.$element_id[2]);
            $umowaOsobowa = $umowaOsobowa->fetch_object();

            $umowaWniosekDoFundacji = $bazaDanych->pobierzDane('*','umowaWniosekVotum','Id = '.$umowaOsobowa->WniosekVotumId);

            if($umowaWniosekDoFundacji) {
                $umowaWniosekDoFundacji = $umowaWniosekDoFundacji->fetch_object();

                $zmienne_pdf['wniosek_do_fundacji'] = array(
                    'OpisPrzypadku' => $umowaWniosekDoFundacji->OpisPrzypadku
                , 'OsobyWGospodarstwie' => $umowaWniosekDoFundacji->OsobyWGospodarstwie
                , 'Zasoby' => $umowaWniosekDoFundacji->Zasoby
                , 'Turnus' => $umowaWniosekDoFundacji->Turnus
                , 'MiejsceTurnusu' => $umowaWniosekDoFundacji->MiejsceTurnusu
                , 'Rehabilitacja' => $umowaWniosekDoFundacji->Rehabilitacja
                , 'Proteza' => $umowaWniosekDoFundacji->Proteza
                , 'Sprzet' => $umowaWniosekDoFundacji->Sprzet
                , 'Wozek' => $umowaWniosekDoFundacji->Wozek
                , 'PomocRodzinie' => $umowaWniosekDoFundacji->PomocRodzinie
                , 'InneDofinansowanie' => $umowaWniosekDoFundacji->InneDofinansowanie
                , 'InneOpis' => $umowaWniosekDoFundacji->InneOpis
                , 'UdostepnienieRachunku' => $umowaWniosekDoFundacji->UdostepnienieRachunku
                );
                $zmienne_pdf['wniosek_do_fundacji'] = json_encode($zmienne_pdf['wniosek_do_fundacji']);
            }


            $nieruchomosci = $bazaDanych->pobierzDane('*','umowaNieruchomosci','Id = '.$umowaWniosekDoFundacji->NieruchomosciId);

            if ($nieruchomosci) {
                $nieruchomosci = $nieruchomosci->fetch_object();

                $zmienne_pdf['nieruchomosci'] = array(
                    'Dom' => $nieruchomosci->Dom
                , 'PowierzchniaDomu' => $nieruchomosci->PowierzchniaDomu
                , 'WlascicielDomu' => $nieruchomosci->WlascicielDomu
                , 'Mieszkanie' => $nieruchomosci->Mieszkanie
                , 'PowierzchniaMieszkania' => $nieruchomosci->PowierzchniaMieszkania
                , 'WlascicielMieszkania' => $nieruchomosci->WlascicielMieszkania
                , 'DzialkaRolna' => $nieruchomosci->DzialkaRolna
                , 'PowierzchniaDzialkiRolnej' => $nieruchomosci->PowierzchniaDzialkiRolnej
                , 'WlascicielDzialkiRolnej' => $nieruchomosci->WlascicielDzialkiRolnej
                , 'DzialkaBudowlana' => $nieruchomosci->DzialkaBudowlana
                , 'PowierzchniaDzialkiBudowlanej' => $nieruchomosci->PowierzchniaDzialkiBudowlanej
                , 'WlascicielDzialkiBudowlanej' => $nieruchomosci->WlascicielDzialkiBudowlanej
                );
                $zmienne_pdf['nieruchomosci'] = json_encode($zmienne_pdf['nieruchomosci']);
            }

            $dochody_tmp = $bazaDanych->pobierzDane('*', 'umowaDochody', 'Id=' . $umowaWniosekDoFundacji->DochodyId);

            if ($dochody_tmp) {
                $dochody_tmp = $dochody_tmp->fetch_object();

                $zmienne_pdf['dochod'] = array(
                    'Wynagrodzenie' => $dochody_tmp->Wynagrodzenie
                , 'Dzialalnosc' => $dochody_tmp->Dzialalnosc
                , 'Renta' => $dochody_tmp->Renta
                , 'Emerytura' => $dochody_tmp->Emerytura
                , 'Zasilek' => $dochody_tmp->Zasilek
                , 'Socjal' => $dochody_tmp->Socjal
                , 'Alimenty' => $dochody_tmp->Alimenty
                , 'SredniDochod' => $dochody_tmp->SredniDochod
                );
                $zmienne_pdf['dochod'] = json_encode($zmienne_pdf['dochod']);
            }

            $umowa_poszkodowany = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOsobowa->OsobaPoszkodowanyId);

            if($umowa_poszkodowany) {
                $umowa_poszkodowany = $umowa_poszkodowany->fetch_object();
                $umowa_poszkodowany_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_poszkodowany->AdresId);
                $umowa_poszkodowany_adres = $umowa_poszkodowany_adres->fetch_object();
                $umowa_poszkodowany_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_poszkodowany_adres->MiastoId);
                $umowa_poszkodowany_adres_miasto = $umowa_poszkodowany_adres_miasto->fetch_object();
                $umowa_poszkodowany_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_poszkodowany->KontaktId);
                $umowa_poszkodowany_kontakt = $umowa_poszkodowany_kontakt->fetch_object();

                $zmienne_pdf['poszkodowany'] = array(
                    'Imie' => $umowa_poszkodowany->Imie
                , 'Nazwisko' => $umowa_poszkodowany->Nazwisko
                , 'Ulica' => $umowa_poszkodowany_adres->Ulica
                , 'NrDomu' => $umowa_poszkodowany_adres->NrDomu
                , 'NrMieszkania' => $umowa_poszkodowany_adres->NrMieszkania
                , 'KodPocztowy' => $umowa_poszkodowany_adres->KodPocztowy
                , 'Miasto' => $umowa_poszkodowany_adres_miasto->Wartosc
                , 'Pesel' => $umowa_poszkodowany->Pesel
                , 'Dowod' => $umowa_poszkodowany->Dowod
                , 'Mail' => $umowa_poszkodowany_kontakt->Mail
                , 'Telefon' => $umowa_poszkodowany_kontakt->Telefon
                );
                $zmienne_pdf['poszkodowany'] = json_encode($zmienne_pdf['poszkodowany']);
            }

            $dochody_tmp = $bazaDanych->pobierzDane('*', 'umowaDochody', 'Id=' . $umowaWniosekDoFundacji->DochodyId);

            if ($dochody_tmp) {
                $dochody_tmp = $dochody_tmp->fetch_object();

                $pokrewienstwo_tmp = $bazaDanych->pobierzDane('StopienPokrewienstwa', 'umowaOswiadczenieUprawnionego', 'Id=' . $umowaOsobowa->OswiadczenieUprawnionegoId);
                if ($pokrewienstwo_tmp) {
                    $pokrewienstwo_tmp = $pokrewienstwo_tmp->fetch_object();
                }

                $zmienne_pdf['pozostale_informacje'] = array(
                    'IdPoszkodowanego' => $umowaOsobowa->OsobaPoszkodowanyId
                , 'IdUprawnionego' => $umowaOsobowa->OsobaUprawnionyId
                , 'UmowaRodzajUprawnionegoId' => $umowaOsobowa->UmowaRodzajUprawnionegoId
                , 'StopienPokrewienstwa' => $pokrewienstwo_tmp->StopienPokrewienstwa
                );

                $zmienne_pdf['pozostale_informacje'] = json_encode($zmienne_pdf['pozostale_informacje']);
            }


            $umowa_uprawniony = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOsobowa->OsobaUprawnionyId);

            if($umowa_uprawniony) {
                $umowa_uprawniony = $umowa_uprawniony->fetch_object();
                $umowa_uprawniony_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_uprawniony->AdresId);
                $umowa_uprawniony_adres = $umowa_uprawniony_adres->fetch_object();
                $umowa_uprawniony_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_uprawniony_adres->MiastoId);
                $umowa_uprawniony_adres_miasto = $umowa_uprawniony_adres_miasto->fetch_object();
                $umowa_uprawniony_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_uprawniony->KontaktId);
                $umowa_uprawniony_kontakt = $umowa_uprawniony_kontakt->fetch_object();

                $zmienne_pdf['uprawniony'] = array(
                    'Imie' => $umowa_uprawniony->Imie
                , 'Nazwisko' => $umowa_uprawniony->Nazwisko
                , 'Ulica' => $umowa_uprawniony_adres->Ulica
                , 'NrDomu' => $umowa_uprawniony_adres->NrDomu
                , 'NrMieszkania' => $umowa_uprawniony_adres->NrMieszkania
                , 'KodPocztowy' => $umowa_uprawniony_adres->KodPocztowy
                , 'Miasto' => $umowa_uprawniony_adres_miasto->Wartosc
                , 'Pesel' => $umowa_uprawniony->Pesel
                , 'Dowod' => $umowa_uprawniony->Dowod
                , 'Mail' => $umowa_uprawniony_kontakt->Mail
                , 'Telefon' => $umowa_uprawniony_kontakt->Telefon
                );
                $zmienne_pdf['uprawniony'] = json_encode($zmienne_pdf['uprawniony']);
            }

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
