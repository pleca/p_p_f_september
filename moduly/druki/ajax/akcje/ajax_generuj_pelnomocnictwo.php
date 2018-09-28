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

    $dataUmowy = explode('-', $umowa->DataUmowy);
    $data_umowy = $dataUmowy[2].'-'.$dataUmowy[1].'-'.$dataUmowy[0];

    $zmienne_pdf['umowa'] = array(
            'DataUmowy' => $data_umowy
        ,'Miasto' => $umowa->Miasto
    );
    $zmienne_pdf['umowa'] = json_encode($zmienne_pdf['umowa']);

    switch ($droga) {
        case 'bankowa':
                $umowa_dane = $bazaDanych->pobierzDane('NrKredytu, Zobowiazany, DataKredytu, UdzielajacyKredytu, RodzajKredytuId','umowaBankowa','Id = '.$element_id[2]);
                $umowa_dane = $umowa_dane->fetch_object();

                $rodzaj_kredytu_nazwa = $bazaDanych->pobierzDane('Id, Wartosc','umowaSlownikRodzajKredytu','Id = '.$umowa_dane->RodzajKredytuId);

                if($rodzaj_kredytu_nazwa) {
                    $rodzaj_kredytu_nazwa = $rodzaj_kredytu_nazwa->fetch_object();

                    $rodzaj_kredytu = $rodzaj_kredytu_nazwa->Wartosc;
                }

                $dataKredytu = explode('-', $umowa_dane->DataKredytu);
                $data_kredytu = $dataKredytu[2].'-'.$dataKredytu[1].'-'.$dataKredytu[0];

                $zmienne_pdf['umowa_dane'] = array(
                    'NrKredytu' => $umowa_dane->NrKredytu
                    ,'Zobowiazany' => $umowa_dane->Zobowiazany
                    ,'DataKredytu' =>$data_kredytu
                    ,'UdzielajacyKredytu' => $umowa_dane->UdzielajacyKredytu
                    ,'RodzajKredytu' => $rodzaj_kredytu
                );

                $zmienne_pdf['umowa_dane'] = json_encode($zmienne_pdf['umowa_dane']);

                $lista_klientow = $bazaDanych->pobierzDane('OsobaId','umowaBankowaOsoba','BankowaId = '.$element_id[2]);
            break;

        case 'ofe':
            $umowaOfe = $bazaDanych->pobierzDane('*','umowaOfe','Id = '.$element_id[2]);
            $umowaOfe = $umowaOfe->fetch_object();

            if ($umowaOfe->UmowaDzialajacyWImieniuId != 4) {

                $umowa_w_imieniu_opis = $bazaDanych->pobierzDane('Id', 'umowaSlownikDzialajacWImieniu', 'Id = ' . $umowaOfe->UmowaDzialajacyWImieniuId . ' AND czy_usuniety = 0');
                $umowa_w_imieniu_opis = $umowa_w_imieniu_opis->fetch_object();
                $umowa_w_imieniu = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $umowaOfe->OsobaDzialajacyId);
                $umowa_w_imieniu = $umowa_w_imieniu->fetch_object();
                $umowa_w_imieniu_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_w_imieniu->AdresId);
                $umowa_w_imieniu_adres = $umowa_w_imieniu_adres->fetch_object();
                $umowa_w_imieniu_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_w_imieniu_adres->MiastoId);
                $umowa_w_imieniu_miasto = $umowa_w_imieniu_miasto->fetch_object();


                $zmienne_pdf['w_imieniu'] = array(
                    'Opis' => $umowaOfe->UmowaDzialajacyWImieniuId
                , 'Imie' => $umowa_w_imieniu->Imie
                , 'Nazwisko' => $umowa_w_imieniu->Nazwisko
                , 'Pesel' => $umowa_w_imieniu->Pesel
                , 'Dowod' => $umowa_w_imieniu->Dowod
                , 'Ulica' => $umowa_w_imieniu_adres->Ulica
                , 'NrDomu' => $umowa_w_imieniu_adres->NrDomu
                , 'NrMieszkania' => $umowa_w_imieniu_adres->NrMieszkania
                , 'KodPocztowy' => $umowa_w_imieniu_adres->KodPocztowy
                , 'Miasto' => $umowa_w_imieniu_miasto->Wartosc
                );

                $zmienne_pdf['w_imieniu'] = json_encode($zmienne_pdf['w_imieniu']);

            }

                $umowa_klient = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$element_id[1]);
                $umowa_klient = $umowa_klient->fetch_object();
                $umowa_klient_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_klient->AdresId);
                $umowa_klient_adres = $umowa_klient_adres->fetch_object();
                $umowa_klient_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_klient_adres->MiastoId);
                $umowa_klient_miasto = $umowa_klient_miasto->fetch_object();

                $zmienne_pdf['klient'] = array(
                    'Imie' => $umowa_klient->Imie
                ,'Nazwisko' => $umowa_klient->Nazwisko
                ,'Ulica' => $umowa_klient_adres->Ulica
                ,'NrDomu' => $umowa_klient_adres->NrDomu
                ,'NrMieszkania' => $umowa_klient_adres->NrMieszkania
                ,'KodPocztowy' => $umowa_klient_adres->KodPocztowy
                ,'Miasto' => $umowa_klient_miasto->Wartosc
                );

                $zmienne_pdf['klient'] = json_encode($zmienne_pdf['klient']);

            break;

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
            }

            $dataZdarzenia = explode('-', $zdarzenie->Data);
            $data_zdarzenia = $dataZdarzenia[2].'-'.$dataZdarzenia[1].'-'.$dataZdarzenia[0];

            $zmienne_pdf['pozostale_informacje'] = array(
                'UmowaRodzajUprawnionegoId' => $umowa_dane->UmowaRodzajUprawnionegoId
            , 'Data' => $data_zdarzenia
            );
            $zmienne_pdf['pozostale_informacje'] = json_encode($zmienne_pdf['pozostale_informacje']);

            break;

    }

    if($lista_klientow != false){
        $liczba_dodatkowych_klientow = mysqli_num_rows($lista_klientow);
        $zmienne_pdf['lista_klientow'] = array();

        $i = 0;
        while($poj_lista_klientow = $lista_klientow->fetch_object()){
            $umowa_dod_klient = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$poj_lista_klientow->OsobaId);
            $umowa_dod_klient = $umowa_dod_klient->fetch_object();
            $umowa_dod_klient_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_dod_klient->AdresId);
            $umowa_dod_klient_adres = $umowa_dod_klient_adres->fetch_object();
            $umowa_dod_klient_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_dod_klient_adres->MiastoId);
            $umowa_dod_klient_adres_miasto = $umowa_dod_klient_adres_miasto->fetch_object();
            $umowa_dod_klient_kontakt = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowa_dod_klient->KontaktId);
            $umowa_dod_klient_kontakt = $umowa_dod_klient_kontakt->fetch_object();

            $zmienne_pdf['lista_klientow'][$i] = array(
                'Imie' => $umowa_dod_klient->Imie
                ,'Nazwisko' => $umowa_dod_klient->Nazwisko
                ,'Ulica' => $umowa_dod_klient_adres->Ulica
                ,'NrDomu' => $umowa_dod_klient_adres->NrDomu
                ,'NrMieszkania' => $umowa_dod_klient_adres->NrMieszkania
                ,'KodPocztowy' => $umowa_dod_klient_adres->KodPocztowy
                ,'Miasto' => $umowa_dod_klient_adres_miasto->Wartosc
                ,'Pesel' => $umowa_dod_klient->Pesel
                ,'Dowod' => $umowa_dod_klient->Dowod
                ,'Mail' => $umowa_dod_klient_kontakt->Mail
                ,'Telefon' => $umowa_dod_klient_kontakt->Telefon
            );
            $i++;
        }

        $zmienne_pdf['lista_klientow'] = json_encode($zmienne_pdf['lista_klientow']);

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