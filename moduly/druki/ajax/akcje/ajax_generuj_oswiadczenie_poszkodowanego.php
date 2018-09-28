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


switch ($droga) {

    case 'rzeczowa':

        $umowaRzeczowa = $bazaDanych->pobierzDane('*', 'umowaRzeczowa', 'Id = '.$element_id[2]);
        $umowaRzeczowa = $umowaRzeczowa->fetch_object();


        $umowa_pojazd = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id = '.$umowaRzeczowa->PojazdId);
        if ($umowa_pojazd) {
        $umowa_pojazd = $umowa_pojazd->fetch_object();
        }
        $umowa_ubezpieczyciel = $bazaDanych->pobierzDane('*', 'umowaUbezpieczyciel', 'Id = ' . $umowaRzeczowa->UbezpieczycielId);
        if ($umowa_ubezpieczyciel) {
            $umowa_ubezpieczyciel = $umowa_ubezpieczyciel->fetch_object();
            $umowa_ubezpieczyciel_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_ubezpieczyciel->AdresId);
            $umowa_ubezpieczyciel_adres = $umowa_ubezpieczyciel_adres->fetch_object();
            $umowa_ubezpieczyciel_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_ubezpieczyciel_adres->MiastoId);
            $umowa_ubezpieczyciel_adres_miasto = $umowa_ubezpieczyciel_adres_miasto->fetch_object();
        }

        $wartosc_uproszczona_umowy = $bazaDanych->pobierzDane('*', 'umowaSlownikUmowaRzeczowaTyp', 'Id = ' . $umowaRzeczowa->UmowaRzeczowaTypId);
        $wartosc_uproszczona_umowy = $wartosc_uproszczona_umowy->fetch_object();

        $droga = $wartosc_uproszczona_umowy->WartoscUproszczona;


        $lista_wlascicieli = $bazaDanych->pobierzDane('OsobaId, UrzadSkarbowyId, WielkoscUdzialu', 'umowaRzeczowaOsoba', 'RzeczowaId = ' . $element_id[2] . ' AND NrOsoby = 1 AND OsobaTypId=1');

        if ($lista_wlascicieli) {
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

            $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy->AdresId);
            $adres_us_tmp = $adres_us_tmp->fetch_object();

            $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_tmp->MiastoId);
            $miasto_us_tmp = $miasto_us_tmp->fetch_object();
        }


        $zmienne_pdf['klient'] = array(
            'Imie' => $umowa_klient->Imie
        , 'Nazwisko' => $umowa_klient->Nazwisko
        , 'Nazwa' => $umowa_klient->Nazwa
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
        $zmienne_pdf['klient'] = json_encode($zmienne_pdf['klient']);

        $zmienne_pdf['umowa_dane'] = array(
            'Marka' => $umowa_pojazd->Marka
        , 'Model' => $umowa_pojazd->Model
        , 'NrRejestracyjny' => $umowa_pojazd->NrRejestracyjny
        , 'UmowaTypKlientaId' => $umowaRzeczowa->UmowaTypKlientaId
        , 'DataSzkody' => $umowaRzeczowa->DataSzkody
        , 'CzyNadalPosiadacz' => $umowaRzeczowa->CzyNadalPosiadacz
        , 'CzySprzedanoUszkodzony' => $umowaRzeczowa->CzySprzedanoUszkodzony
        , 'CzyMialUszkodzenia' => $umowaRzeczowa->CzyMialUszkodzenia
        , 'CzyNaprawianoWczesniej' => $umowaRzeczowa->CzyNaprawianoWczesniej
        , 'CzyUzytoOryginalneCzesci' => $umowaRzeczowa->CzyUzytoOryginalneCzesci
        , 'CzyNaprawionoPoWypadku' => $umowaRzeczowa->CzyNaprawionoPoWypadku
        , 'CzyOdszkodowaniePokrylo' => $umowaRzeczowa->CzyOdszkodowaniePokrylo
        , 'CzyStanPrzedWypadkiem' => $umowaRzeczowa->CzyStanPrzedWypadkiem
        );

        $zmienne_pdf['umowa_dane'] = json_encode($zmienne_pdf['umowa_dane']);

        break;

    case 'osobowa':

        $umowaOsobowa = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id = '.$element_id[2]);
        $umowaOsobowa = $umowaOsobowa->fetch_object();

        $OswiadczeniePoszkodowanego = $bazaDanych->pobierzDane('*', 'umowaOswiadczeniePoszkodowanego', 'Id = '.$umowaOsobowa->OswiadczeniePoszkodowanegoId);

        if($OswiadczeniePoszkodowanego) {
            $OswiadczeniePoszkodowanego = $OswiadczeniePoszkodowanego->fetch_object();

            $zmienne_pdf['oswiadczenie_poszkodowanego'] = array(
                'PodWplywem' => $OswiadczeniePoszkodowanego->PodWplywem
            , 'PodJakimWplywem' => $OswiadczeniePoszkodowanego->PodJakimWplywem
            , 'PieszyRowerzysta' => $OswiadczeniePoszkodowanego->PieszyRowerzysta
            , 'KierowcaPasazer' => $OswiadczeniePoszkodowanego->KierowcaPasazer
            , 'MiejsceGdzieSiedzial' => $OswiadczeniePoszkodowanego->MiejsceGdzieSiedzial
            , 'MiejsceGdzieSiedzialInne' => $OswiadczeniePoszkodowanego->MiejsceGdzieSiedzialInne
            , 'ZapietePasy' => $OswiadczeniePoszkodowanego->ZapietePasy
            , 'WlascicielWspolwlasciciel' => $OswiadczeniePoszkodowanego->WlascicielWspolwlasciciel
            , 'WiedzaCzyPodWplywem' => $OswiadczeniePoszkodowanego->WiedzaCzyPodWplywem
            , 'WiedzaOUprawnieniach' => $OswiadczeniePoszkodowanego->WiedzaOUprawnieniach
            , 'NastepstwaObrazen' => $OswiadczeniePoszkodowanego->NastepstwaObrazen
            );

            $zmienne_pdf['oswiadczenie_poszkodowanego'] = json_encode($zmienne_pdf['oswiadczenie_poszkodowanego']);
        }

        $klient_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','Id ='.$element_id[1]);

        if($klient_tmp) {
            $klient_tmp = $klient_tmp->fetch_object();

            $zmienne_pdf['poszkodowany'] = array(
                'Imie' => $klient_tmp->Imie
            , 'Nazwisko' => $klient_tmp->Nazwisko
            );

            $zmienne_pdf['poszkodowany'] = json_encode($zmienne_pdf['poszkodowany']);
        }

        $Zdarzenie = $bazaDanych->pobierzDane('*', 'umowaZdarzenie', 'Id = '.$umowaOsobowa->ZdarzenieId);

        if($Zdarzenie) {
            $Zdarzenie = $Zdarzenie->fetch_object();

            $zmienne_pdf['zdarzenie'] = array(
                'Miejscowosc' => $Zdarzenie->Miejscowosc
            , 'Data' => $Zdarzenie->Data
            , 'TypZdarzeniaId' => $umowaOsobowa->TypZdarzeniaId
            , 'RodzajSzkodyId' => $umowaOsobowa->RodzajSzkodyId
            );

            $zmienne_pdf['zdarzenie'] = json_encode($zmienne_pdf['zdarzenie']);

            $PojA = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id = '.$Zdarzenie->PojazdAId);

            if($PojA) {
                $PojA = $PojA->fetch_object();

                $zmienne_pdf['pojazd_a'] = array(
                    'Marka' => $PojA->Marka
                , 'Model' => $PojA->Model
                , 'NrRejestracyjny' => $PojA->NrRejestracyjny
                );
                $zmienne_pdf['pojazd_a'] = json_encode($zmienne_pdf['pojazd_a']);
            }

            $PojB = $bazaDanych->pobierzDane('*', 'umowaPojazd', 'Id = '.$Zdarzenie->PojazdBId);

            if($PojB) {
                $PojB = $PojB->fetch_object();

                $zmienne_pdf['pojazd_b'] = array(
                    'Marka' => $PojB->Marka
                , 'Model' => $PojB->Model
                , 'NrRejestracyjny' => $PojB->NrRejestracyjny
                );
                $zmienne_pdf['pojazd_b'] = json_encode($zmienne_pdf['pojazd_b']);
            }

        }

        $lista_szpitali = $bazaDanych->pobierzDane('*','umowaHospitalizacja','IdUmowyOsobowej = '.$element_id[2]);

        if($lista_szpitali != false){
            $liczba_szpitali = mysqli_num_rows($lista_szpitali);
            $zmienne_pdf['lista_szpitali'] = array();

            $i = 0;
            while($poj_lista_szpitali = $lista_szpitali->fetch_object()){

                $zmienne_pdf['lista_szpitali'][$i] = array(
                    'MiejsceHospitalizacji' => $poj_lista_szpitali->MiejsceHospitalizacji
                , 'DataOdKiedy' => $poj_lista_szpitali->DataOdKiedy
                , 'DataDoKiedy' => $poj_lista_szpitali->DataDoKiedy
                );

                $i++;
            }

            $zmienne_pdf['lista_szpitali'] = json_encode($zmienne_pdf['lista_szpitali']);

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
