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

    case 'osobowa':

        $klient = $element_id[1];

        $umowaOsobowa = $bazaDanych->pobierzDane('*', 'umowaOsobowa', 'Id = '.$element_id[2]);
        $umowaOsobowa = $umowaOsobowa->fetch_object();

        $poszkodowany_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','Id ='.$umowaOsobowa->OsobaPoszkodowanyId);
        if($poszkodowany_tmp) {
            $poszkodowany_tmp = $poszkodowany_tmp->fetch_object();
            $dane_poszkodowany = $poszkodowany_tmp->Imie.' '.$poszkodowany_tmp->Nazwisko;
            $wiek_poszkodowany = $poszkodowany_tmp->Wiek;
        }

        $oswiadczenie_uprawnionego_tmp = $bazaDanych->pobierzDane('*','umowaOswiadczenieUprawnionego','Id ='.$umowaOsobowa->OswiadczenieUprawnionegoId);
        if($oswiadczenie_uprawnionego_tmp) {
            $oswiadczenie_uprawnionego_tmp = $oswiadczenie_uprawnionego_tmp->fetch_object();
            $stopien_pokrewienstwa = $oswiadczenie_uprawnionego_tmp->StopienPokrewienstwa;
        }

        if(is_null($umowaOsobowa->OsobaUprawnionyId)) {
            $klient_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','Id ='.$klient);
            $klient_tmp = $klient_tmp->fetch_object();
            $dane_uprawniony = $klient_tmp->Imie.' '.$klient_tmp->Nazwisko;
            $wiek_uprawniony = $klient_tmp->Wiek;
        } else {
            $uprawniony_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','Id ='.$umowaOsobowa->OsobaUprawnionyId);
            if($uprawniony_tmp) {
                $uprawniony_tmp = $uprawniony_tmp->fetch_object();

                $dane_uprawniony = $uprawniony_tmp->Imie.' '.$uprawniony_tmp->Nazwisko;
                $wiek_uprawniony = $uprawniony_tmp->Wiek;
            }
        }


        $zmienne_pdf['pozostale_informacje'] = array(
            'poszkodowany' => $dane_poszkodowany
        , 'wiek_poszkodowany' => $wiek_poszkodowany
        , 'wiek_uprawniony' => $wiek_uprawniony
        , 'uprawniony' => $dane_uprawniony
        , 'stopien_pokrewienstwa' => $stopien_pokrewienstwa
        );

        $zmienne_pdf['pozostale_informacje'] = json_encode($zmienne_pdf['pozostale_informacje']);

        $lista_pytan = $bazaDanych->pobierzDane('*','umowaSlownikPytania','czy_usuniety = 0');

        if($lista_pytan != false){
            $liczba_pytan = mysqli_num_rows($lista_pytan);
            $zmienne_pdf['lista_pytan'] = array();

            $i = 0;
            while($poj_lista_pytan = $lista_pytan->fetch_object()){

                if($poj_lista_pytan->NumerPytania == 22) {

                    $inne_odszkodowania = $bazaDanych->pobierzDane('*', 'umowaInneOdszkodowania', 'Id =' . $umowaOsobowa->InneOdszkodowaniaId);

                    if ($inne_odszkodowania) {
                        $inne_odszkodowania = $inne_odszkodowania->fetch_object();
                        $KwotaZUS = $inne_odszkodowania->KwotaZUS;
                        $KwotaGOPS = $inne_odszkodowania->KwotaGOPS;
                        $KwotaZOC = $inne_odszkodowania->KwotaZOC;
                        $InneSwiadczenia = $inne_odszkodowania->InneSwiadczenia;
                    }
                    $Odpowiedz = '';
                    $Odpowiedz .= 'z ZUSu/KRUSu:  '.$KwotaZUS.'</br>';
                    $Odpowiedz .= 'z Miejskiego/Gminnego Ośrodka Pomocy Społecznej: '.$KwotaGOPS.'</br>';
                    $Odpowiedz .= 'od ubezpieczyciela OC sprawcy zdarzenia/bezpośrednio od sprawcy zdarzenia: '.$KwotaZOC.'</br>';
                    $Odpowiedz .= 'inne niż wymienione powyżej świadczenia. Prosimy podać źródło i wysokość świadczenia: '.$InneSwiadczenia.'</br>';


                } else {
                    $lista_odpowiedzi = $bazaDanych->pobierzDane('*', 'umowaAnkiety', 'UmowaId=' . $element_id[2] . ' AND PytanieId =' . $poj_lista_pytan->NumerPytania);

                    if ($lista_odpowiedzi) {
                        $lista_odpowiedzi = $lista_odpowiedzi->fetch_object();
                        $Odpowiedz = $lista_odpowiedzi->Odpowiedz;
                    } else {
                        $Odpowiedz = '';
                    }
                }


                $zmienne_pdf['lista_pytan'][$i] = array(
                    'NumerPytania' => $poj_lista_pytan->NumerPytania
                , 'Wartosc' => $poj_lista_pytan->Wartosc
                , 'Odpowiedz' => $Odpowiedz
                );

                $i++;
            }

            $zmienne_pdf['lista_pytan'] = json_encode($zmienne_pdf['lista_pytan']);

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
