<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

    $szkoleniaTesty = new SzkoleniaTesty();

    $akcja = htmlspecialchars($_POST['akcja']);
    $tabela = htmlspecialchars($_POST['tabela']);
    $element_id = htmlspecialchars($_POST['element_id']);
    $dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;

    $wynikOut = 0;
    $komunikat = 'Brak akcji do wykonania!!!';
    $rodzajOut = 'blad';
    $przeladujWidok = 0;
    $tresc = '';
    $wyslanyMail = 0;
    $wyslanyMailKomunikat = '';
    $wynikTestu = 0;

    switch ($akcja) {
        case 'dodaj_pytanie':
                $dane = array_merge($dane, array( 'uzytkownik_id' => $_SESSION['uzytkownik_id']));
                $dane = array_merge($dane, array( 'szkolenia_testy_id' => $element_id));

                $pytanie_id = $bazaDanych->wstawDane($tabela, $dane);

                $szkoleniaTesty->dodajWpisDoHistorii($bazaDanych, $pytanie_id, 'szkolenia_testy_pytania_id', 'Dodanie pytania', '', $pytanie_id , 'szkolenia_testy_pytania_historia_zmian');

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;

            break;

        case 'aktualizuj_pytanie':
                $szkoleniaTesty->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

                $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

                $element_id_tmp = $bazaDanych->pobierzDane('szkolenia_testy_id', 'szkolenia_testy_pytania', 'id = '.$element_id);
                $element_id_tmp = $element_id_tmp->fetch_object();
                $element_id = $element_id_tmp->szkolenia_testy_id;

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;

            break;

        case 'dodaj_odpowiedz':
                $dane = array_merge($dane, array( 'uzytkownik_id' => $_SESSION['uzytkownik_id']));

                $odpowiedz_id = $bazaDanych->wstawDane($tabela, $dane);

                $szkoleniaTesty->dodajWpisDoHistorii($bazaDanych, $odpowiedz_id, 'szkolenia_testy_pytania_odpowiedzi_id', 'Dodanie odpowiedzi', '', $odpowiedz_id , 'szkolenia_testy_pytania_odpowiedzi_historia_zmian');

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;

            break;

        case 'aktualizuj_odpowiedz':
                $szkoleniaTesty->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

                $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 0;

            break;

        case 'rozwiazuj_test' :
                $liczbaProb = $bazaDanych->pobierzDane('id', 'szkolenia_testy_id_uzytkownik_id', 'szkolenia_testy_id = '.$element_id.' AND uzytkownik_id = '.$_SESSION['uzytkownik_id']);
                if(is_null($liczbaProb)){
                    $liczbaProb = 1;
                }else{
                    $liczbaProb = mysqli_num_rows($liczbaProb)+1;
                }

                $dane = array(
                    'szkolenia_testy_id' => $element_id
                    ,'uzytkownik_id' => $_SESSION['uzytkownik_id']
                    ,'proba_nr' => $liczbaProb
                    ,'start' => 'NOW()'
                );

                $szkoleniaTestyProbaId = $bazaDanych->wstawDane($tabela, $dane);
                $szkoleniaTesty->dodajWpisDoHistorii($bazaDanych, $element_id, 'szkolenia_testy_id', 'Rozpoczęcie testu', date('H:i:s'), $_SESSION['uzytkownik_imie'].' '.$_SESSION['uzytkownik_nazwisko'] , 'szkolenia_testy_historia_zmian');

                $element = $bazaDanych->pobierzDane('*', 'szkolenia_testy', 'id = '.$element_id);
                $element = $element->fetch_object();

                $szkoleniaTesty->generujTestDoRozwiazania($element, $szkoleniaTestyProbaId, $bazaDanych);

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;

            break;

        case 'aktualizuj_odpowiedz_uzytkownika' :


            $element_id_tmp = explode('-',$element_id);
            $probaId = $element_id_tmp[0];
            $pytanieId = $element_id_tmp[1];

            $element_id_tmp = $bazaDanych->pobierzDane('id', 'szkolenia_testy_wygenerowane_pytania',
                'uzytkownik_id = '.$_SESSION['uzytkownik_id']
                .' AND szkolenia_testy_id_uzytkownik_id = '.$probaId
                .' AND szkolenia_testy_pytania_id = '.$pytanieId
                .' AND czy_usuniety = 0'
            );

            $element_id_tmp = $element_id_tmp->fetch_object();
            $szWygenerowaneId = $element_id_tmp->id;

            $liczbaPunktowPytanie = $bazaDanych->pobierzDane('liczba_pkt, szkolenia_slownik_testy_pytania_rodzaj_id', 'szkolenia_testy_pytania', 'id = '.$pytanieId.' AND czy_usuniety = 0');
            $liczbaPunktowPytanie = $liczbaPunktowPytanie->fetch_object();

            $liczbaUzyskanychPunktow = 0;

            $ptanie_rodzaj = $bazaDanych->pobierzDane('szkolenia_slownik_testy_pytania_rodzaj_id','szkolenia_testy_pytania','id = '.$pytanieId);
            $ptanie_rodzaj = $ptanie_rodzaj->fetch_object();

            if($liczbaPunktowPytanie->szkolenia_slownik_testy_pytania_rodzaj_id != 2){
                $bazaDanych->aktualizujDane($tabela, array( 'sprawdzone' => '1'), $szWygenerowaneId);
                $liczbaPoprawnychOdpowiedzi = $bazaDanych->pobierzDane('id', 'szkolenia_testy_pytania_odpowiedzi', 'szkolenia_testy_pytania_id = '.$pytanieId.' AND poprawna = 1 AND czy_usuniety = 0');

                $ilePoprawnych = mysqli_num_rows($liczbaPoprawnychOdpowiedzi);
                if($ptanie_rodzaj->szkolenia_slownik_testy_pytania_rodzaj_id == '3'){
                    $ileZaznaczonych = explode(',',$dane['szkolenia_testy_pytania_odpowiedzi_id']);
                }

                if(!is_null($liczbaPoprawnychOdpowiedzi)){
                    $liczbaPuktowZaPoprawnaOdpowiedz = ($liczbaPunktowPytanie->liczba_pkt)/mysqli_num_rows($liczbaPoprawnychOdpowiedzi);

                    while($poj_liczbaPoprawnychOdpowiedzi = $liczbaPoprawnychOdpowiedzi->fetch_object()){
                        if($ptanie_rodzaj->szkolenia_slownik_testy_pytania_rodzaj_id == '3'){
                            if(strpos($dane['szkolenia_testy_pytania_odpowiedzi_id'], $poj_liczbaPoprawnychOdpowiedzi->id) !== false){
                                $liczbaUzyskanychPunktow += $liczbaPuktowZaPoprawnaOdpowiedz;
                            }
                        }else{
                            if($poj_liczbaPoprawnychOdpowiedzi->id == $dane['szkolenia_testy_pytania_odpowiedzi_id']){
                                $liczbaUzyskanychPunktow = $liczbaPuktowZaPoprawnaOdpowiedz;
                            }
                        }

                    }

                    if($ilePoprawnych > 1){
                        if(count($ileZaznaczonych) > $ilePoprawnych){
                            $doOdjecia = count($ileZaznaczonych) - $ilePoprawnych;
                            $liczbaUzyskanychPunktow = $liczbaUzyskanychPunktow - ($liczbaPuktowZaPoprawnaOdpowiedz * $doOdjecia);
                        }
                    }

                }

            }

            if($liczbaUzyskanychPunktow < 0){
                $liczbaUzyskanychPunktow = 0;
            }

            $dane = array_merge($dane, array( 'uzyskane_punkty' => $liczbaUzyskanychPunktow));

            $bazaDanych->aktualizujDane($tabela, $dane, $szWygenerowaneId);

            $wynikOut = 1;
            $komunikat = 'Odpowedź została zapisana!!!';
            $rodzajOut = 'sukces';
            $przeladujWidok = 0;

            break;

        case 'aktualizuj_wynik_testu':
                $probaId = $element_id;

                $lista_zamknietych_pytan = $bazaDanych->pobierzDane('szkolenia_testy_pytania_id, id','szkolenia_testy_wygenerowane_pytania','szkolenia_testy_id_uzytkownik_id = '.$probaId);
                while($poj_lista_zamknietych_pytan = $lista_zamknietych_pytan->fetch_object()){
                    $pytanie_tmp = $bazaDanych->pobierzDane('szkolenia_slownik_testy_pytania_rodzaj_id', 'szkolenia_testy_pytania', 'id = '.$poj_lista_zamknietych_pytan->szkolenia_testy_pytania_id);
                    $pytanie_tmp = $pytanie_tmp->fetch_object();
                    if($pytanie_tmp->szkolenia_slownik_testy_pytania_rodzaj_id != '2'){
                        $bazaDanych->aktualizujDane('szkolenia_testy_wygenerowane_pytania',array('sprawdzone' => '1'),$poj_lista_zamknietych_pytan->id);
                    }
                }


                $wynik = $szkoleniaTesty->aktualizujWynikTestu($probaId, $bazaDanych);

                $wartosci = array(
                        'uzyskany_wynik' => $wynik['procent_uzyskanych_punktow']
                        ,'zakonczony' => 1
                        ,'zaliczony' => $wynik['zaliczony']
                );

                $bazaDanych->aktualizujDane('szkolenia_testy_id_uzytkownik_id', $wartosci, $probaId);

                $element_id_tmp = $bazaDanych->pobierzDane('szkolenia_testy_id', 'szkolenia_testy_id_uzytkownik_id', 'id = '.$probaId);
                $element_id_tmp = $element_id_tmp->fetch_object();
                $element_id = $element_id_tmp->szkolenia_testy_id;

                $wyslanyMail = $wynik['wyslanaWiadomosc'];
                $wyslanyMailKomunikat = $wynik['wyslanaWiadomoscKomunikat'];

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 0;

            break;

        case 'ocen_odpowiedz_uzytkownika':
                $element_id_tmp = explode('-',$element_id);
                $probaId = $element_id_tmp[0];
                $pytanieId = $element_id_tmp[1];

                $element_id_tmp = $bazaDanych->pobierzDane('id', 'szkolenia_testy_wygenerowane_pytania',
                    'szkolenia_testy_id_uzytkownik_id = '.$probaId
                    .' AND szkolenia_testy_pytania_id = '.$pytanieId
                    .' AND czy_usuniety = 0'
                );

                $element_id_tmp = $element_id_tmp->fetch_object();
                $szWygenerowaneId = $element_id_tmp->id;

                $liczba_punktow = htmlspecialchars($_POST['liczba_punktow']);
                $bazaDanych->aktualizujDane($tabela, array( 'uzyskane_punkty' => $liczba_punktow, 'sprawdzone' => '1'), $szWygenerowaneId);

                $liczbaPytanDoSprawdzenia = $bazaDanych->pobierzDane('id', 'szkolenia_testy_wygenerowane_pytania',
                    'szkolenia_testy_id_uzytkownik_id = '.$probaId
                    .' AND czy_usuniety = 0'
                    .' AND sprawdzone = 0'
                );

                if(is_null($liczbaPytanDoSprawdzenia)){
                    $wynik = $szkoleniaTesty->aktualizujWynikTestu($probaId, $bazaDanych, null);

                    $wartosci = array(
                        'uzyskany_wynik' => $wynik['procent_uzyskanych_punktow']
                        ,'zaliczony' => $wynik['zaliczony']
                        ,'sprawdzony' => '1'
                    );

                    $bazaDanych->aktualizujDane('szkolenia_testy_id_uzytkownik_id', $wartosci, $probaId);

                    $wyslanyMail = $wynik['wyslanaWiadomosc'];
                    $wyslanyMailKomunikat = $wynik['wyslanaWiadomoscKomunikat'];
                }

                $wynikOut = 1;
                $komunikat = 'Ocena została zapisana!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;
            break;

        case 'lista_konczacych_sie_szkolen':
                $tresc = $szkoleniaTesty->generujListeKonczacychSzkolen($bazaDanych);
            break;

    }

    $dane = array(
                0 => $wynikOut
                ,'rodzaj' => $rodzajOut
                ,'komunikat' => $komunikat
                ,'element_id' => $element_id
                ,'przeladujWidok' => $przeladujWidok
                ,'tresc' => $tresc
                ,'wyslanyMail' => $wyslanyMail
                ,'wyslanyMailKomunikat' => $wyslanyMailKomunikat
                ,'wynikTestu' => $wynik['procent_uzyskanych_punktow']
    );

    echo json_encode($dane);
    return;