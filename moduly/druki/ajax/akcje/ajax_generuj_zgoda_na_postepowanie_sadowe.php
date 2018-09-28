<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
    setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

    $drukiaMain = new DrukiMain();

    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '' ;
    $nazwa_druku = (isset($_POST['nazwa_druku'])) ? htmlspecialchars($_POST['nazwa_druku']) : '' ;
    $rodzaj_druku = (isset($_POST['rodzaj_druku'])) ? htmlspecialchars($_POST['rodzaj_druku']) : '' ;

    $element_id = explode('-',$element_id);
    //$element_id[0] - umowa
    //$element_id[1] - glowny klient
    //$element_id[2] - umowa typ

    $komunikat = 'Brak akcji do wykonania!!!';
    $rodzajOut = 'blad';

    $zmienne_pdf = array();

    $umowa = $bazaDanych->pobierzDane('*','umowa','Id = '.$element_id[0]);
    $umowa = $umowa->fetch_object();

/*    $zmienne_pdf['umowa'] = array(
        'DataPouczenia' => $umowa->DataPouczenia
        ,'MiastoPouczenia' => $umowa->MiastoPouczenia
        ,'DataUmowy' => $umowa->DataUmowy
        ,'Miasto' => $umowa->Miasto
    );
    $zmienne_pdf['umowa'] = json_encode($zmienne_pdf['umowa']);*/

    switch ($droga) {

        case 'osobowa':

            $umowa_dane = $bazaDanych->pobierzDane('*','umowaOsobowa','Id = '.$element_id[2]);
            $umowa_dane = $umowa_dane->fetch_object();

            $umowa_klient = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$element_id[1]);

            if ($umowa_klient) {

                $umowa_klient = $umowa_klient->fetch_object();
                $umowa_klient_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_klient->AdresId);
                $umowa_klient_adres = $umowa_klient_adres->fetch_object();
                $umowa_klient_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_klient_adres->MiastoId);
                $umowa_klient_miasto = $umowa_klient_miasto->fetch_object();

                $zmienne_pdf['klient'] = array(
                    'Imie' => $umowa_klient->Imie
                ,'Nazwisko' => $umowa_klient->Nazwisko
                ,'Pesel' => $umowa_klient->Pesel
                ,'Dowod' => $umowa_klient->Dowod
                ,'Ulica' => $umowa_klient_adres->Ulica
                ,'NrDomu' => $umowa_klient_adres->NrDomu
                ,'NrMieszkania' => $umowa_klient_adres->NrMieszkania
                ,'KodPocztowy' => $umowa_klient_adres->KodPocztowy
                ,'Miasto' => $umowa_klient_miasto->Wartosc
                );
                $zmienne_pdf['klient'] = json_encode($zmienne_pdf['klient']);
            }

            $umowa_uprawniony = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowa_dane->OsobaUprawnionyId);

            if($umowa_uprawniony) {
                $umowa_uprawniony = $umowa_uprawniony->fetch_object();
                $umowa_uprawniony_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_uprawniony->AdresId);
                $umowa_uprawniony_adres = $umowa_uprawniony_adres->fetch_object();
                $umowa_uprawniony_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_uprawniony_adres->MiastoId);
                $umowa_uprawniony_miasto = $umowa_uprawniony_miasto->fetch_object();

                $zmienne_pdf['uprawniony'] = array(
                    'Imie' => $umowa_uprawniony->Imie
                , 'Nazwisko' => $umowa_uprawniony->Nazwisko
                , 'Pesel' => $umowa_uprawniony->Pesel
                , 'Dowod' => $umowa_uprawniony->Dowod
                , 'Ulica' => $umowa_uprawniony_adres->Ulica
                , 'NrDomu' => $umowa_uprawniony_adres->NrDomu
                , 'NrMieszkania' => $umowa_uprawniony_adres->NrMieszkania
                , 'KodPocztowy' => $umowa_uprawniony_adres->KodPocztowy
                , 'Miasto' => $umowa_uprawniony_miasto->Wartosc
                );
                $zmienne_pdf['uprawniony'] = json_encode($zmienne_pdf['uprawniony']);
            }

            $zdarzenie = $bazaDanych->pobierzDane('*','umowaZdarzenie','Id = '.$umowa_dane->ZdarzenieId);

            if($zdarzenie) {
                $zdarzenie = $zdarzenie->fetch_object();

                $postepowanie = $bazaDanych->pobierzDane('*', 'umowaZgodaNaPostepowanie', 'Id = ' . $umowa_dane->ZgodaNaPostepowanieId);
                if ($postepowanie) {
                    $postepowanie = $postepowanie->fetch_object();
                }

                $OdpowiedzialnoscCywilna = $bazaDanych->pobierzDane('*', 'umowaOdpowiedzialnoscCywilna', 'Id = ' . $umowa_dane->OdpowiedzialnoscCywilnaId);
                if ($OdpowiedzialnoscCywilna) {
                    $OdpowiedzialnoscCywilna = $OdpowiedzialnoscCywilna->fetch_object();
                }
            }


            $zmienne_pdf['pozostale_informacje'] = array(
                'UmowaRodzajUprawnionegoId' => $umowa_dane->UmowaRodzajUprawnionegoId
            , 'TypSzkodyId' => $umowa_dane->TypSzkodyId
            , 'Data' => $zdarzenie->Data
            , 'Zobowiazany' => $postepowanie->Zobowiazany
            , 'Sad' => $postepowanie->Sad
            , 'CzyToczonoPostepowanie' => $postepowanie->CzyToczonoPostepowanie
            , 'SygnaturaAkt' => $postepowanie->SygnaturaAkt
            , 'CzyZawartoUgode' => $postepowanie->CzyZawartoUgode
            );
            $zmienne_pdf['pozostale_informacje'] = json_encode($zmienne_pdf['pozostale_informacje']);




            $lista_swiadkow = $bazaDanych->pobierzDane('*','umowaListaSwiadkow','IdUmowyOsobowej = '.$element_id[2]);

            if($lista_swiadkow != false) {
                $liczba_swiadkow = mysqli_num_rows($lista_swiadkow);
                $zmienne_pdf['lista_swiadkow'] = array();

                $i = 0;
                while ($poj_lista_swiadkow = $lista_swiadkow->fetch_object()) {

                    $lista_osob = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$poj_lista_swiadkow->IdOsoby);
                    $lista_osob = $lista_osob->fetch_object();

                    $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $lista_osob->KontaktId);
                    $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();

                    $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $lista_osob->AdresId);
                    $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

                    $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_osoba_adres_tmp->MiastoId);
                    $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                    $zmienne_pdf['lista_swiadkow'][$i] = array(

                        'Imie' => $lista_osob->Imie
                        ,'Nazwisko' => $lista_osob->Nazwisko
                        ,'Ulica' => $umowa_osoba_adres_tmp->Ulica
                        ,'NrDomu' => $umowa_osoba_adres_tmp->NrDomu
                        ,'NrMieszkania' => $umowa_osoba_adres_tmp->NrMieszkania
                        ,'KodPocztowy' => $umowa_osoba_adres_tmp->KodPocztowy
                        ,'WartoscMiasto' => $umowa_osoba_adres_miasto_tmp->Wartosc

                    );

                    $i++;
                }

                $zmienne_pdf['lista_swiadkow'] = json_encode($zmienne_pdf['lista_swiadkow']);
            }

            break;

    }

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