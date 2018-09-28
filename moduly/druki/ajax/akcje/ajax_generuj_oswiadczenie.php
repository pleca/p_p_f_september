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

/*    if(!empty($umowa->JednostkaId)){
        $KodJednostki = $bazaDanych->pobierzDane('Wartosc','umowaSlownikKodJednostki','Id = '.$umowa->JednostkaId);
        $KodJednostki = $KodJednostki->fetch_object();
    }*/

    $zmienne_pdf['umowa'] = array(
        'IdentyfikatorPrzedstawiciela' => $IdentyfikatorPrzedstawiciela->login
        ,'KodJednostki' => $umowa->JednostkaNumer
        ,'KodKonsultanta' => ''
        ,'DataUmowy' => $umowa->DataUmowy
        ,'Miasto' => $umowa->Miasto
    );
    $zmienne_pdf['umowa'] = json_encode($zmienne_pdf['umowa']);


            $umowaRzeczowa = $bazaDanych->pobierzDane('*','umowaRzeczowa','Id = '.$element_id[2]);
            $umowaRzeczowa = $umowaRzeczowa->fetch_object();


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

                $wartosc_uproszczona_umowy = $bazaDanych->pobierzDane('*','umowaSlownikUmowaRzeczowaTyp','Id = '.$umowaRzeczowa->UmowaRzeczowaTypId);
                $wartosc_uproszczona_umowy = $wartosc_uproszczona_umowy->fetch_object();

                $droga = $wartosc_uproszczona_umowy->WartoscUproszczona;



                $lista_wlascicieli = $bazaDanych->pobierzDane('OsobaId, UrzadSkarbowyId, WielkoscUdzialu','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND NrOsoby = 1 AND OsobaTypId=1');

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
                }

                if ($urzad_skarbowy) {
                    $urzad_skarbowy = $urzad_skarbowy->fetch_object();

                    $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = '.$urzad_skarbowy->AdresId);
                    $adres_us_tmp = $adres_us_tmp->fetch_object();

                    $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = '.$adres_us_tmp->MiastoId);
                    $miasto_us_tmp = $miasto_us_tmp->fetch_object();
                }


                $zmienne_pdf['klient'] = array(
                    'Imie' => $umowa_klient->Imie
                ,'Nazwisko' => $umowa_klient->Nazwisko
                ,'Nazwa' => $umowa_klient->Nazwa
                ,'Nip' => $umowa_klient->Nip
                ,'Krs' => $umowa_klient->Krs
                ,'DataUrodzenia' => $umowa_klient->DataUrodzenia
                ,'Ulica' => $umowa_klient_adres->Ulica
                ,'NrDomu' => $umowa_klient_adres->NrDomu
                ,'NrMieszkania' => $umowa_klient_adres->NrMieszkania
                ,'KodPocztowy' => $umowa_klient_adres->KodPocztowy
                ,'Miasto' => $umowa_klient_adres_miasto->Wartosc
                ,'Pesel' => $umowa_klient->Pesel
                ,'Dowod' => $umowa_klient->Dowod
                ,'Mail' => $umowa_klient_kontakt->Mail
                ,'Telefon' => $umowa_klient_kontakt->Telefon


                ,'NazwaUS' => $urzad_skarbowy->Nazwa
                ,'UlicaUS' => $adres_us_tmp->Ulica
                ,'NrDomuUS' => $adres_us_tmp->NrDomu
                ,'NrMieszkaniaUS' => $adres_us_tmp->NrMieszkania
                ,'KodPocztowyUS' => $adres_us_tmp->KodPocztowy
                ,'MiastoUS' => $miasto_us_tmp->Wartosc
                ,'WielkoscUdzialu' => $lista_wlascicieli->WielkoscUdzialu

                );
                $zmienne_pdf['klient'] = json_encode($zmienne_pdf['klient']);

                $zmienne_pdf['umowa_dane'] = array(
                    'Marka' => $umowa_pojazd->Marka
                ,'Model' => $umowa_pojazd->Model
                ,'NrRejestracyjny' => $umowa_pojazd->NrRejestracyjny
                ,'DataSzkody' => $umowaRzeczowa->DataSzkody
                ,'UmowaTypKlientaId' => $umowaRzeczowa->UmowaTypKlientaId
                );

                $zmienne_pdf['umowa_dane'] = json_encode($zmienne_pdf['umowa_dane']);


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
