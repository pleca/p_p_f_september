<?php

    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

    $szkoleniaMain = new SzkoleniaMain();

    $akcja = htmlspecialchars($_POST['akcja']);
    $tabela = htmlspecialchars($_POST['tabela']);
    $szkolenia_id = htmlspecialchars($_POST['szkolenia_id']);
    $uzytkownik_id = htmlspecialchars($_POST['uzytkownik_id']);
    $element_id = htmlspecialchars($_POST['element_id']);

    $wynikOut = 0;
    $komunikat = 'Brak akcji do wykonania!!!';
    $rodzajOut = 'blad';
    $ukryjPopUp = 0;
    $ukryjPopUp1 = 0;
    $przeladujWidok = 0;
    $przeladujPopUp = 0;
    $przeladujPopUpAktywnaZakladka = '';
    $i=0;

    switch ($akcja) {
        case 'zapisz_do_szkolenia':
                $wartosci = array(
                    'szkolenia_id' => $szkolenia_id
                    ,'uzytkownik_id' => $_SESSION['uzytkownik_id']
                );

            $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $szkolenia_id, 'szkolenia_id', 'Zapisany', '', '' , 'szkolenia_historia_zmian');

            $bazaDanych->wstawDane($tabela, $wartosci);

            $wynikOut = 1;
                $komunikat = 'Zostałeś zapisany na szkolenie!!!';
                $rodzajOut = 'sukces';

            break;

        case 'zapisz_do_szkolenia_administracyjnie':
                $wartosci = array(
                    'szkolenia_id' => $szkolenia_id
                    ,'uzytkownik_id' => $uzytkownik_id
                );

                $uzytkownik_zapisany = $bazaDanych->pobierzDane('imie, nazwisko', 'uzytkownik', 'id = '.$uzytkownik_id);
                $uzytkownik_zapisany = $uzytkownik_zapisany->fetch_object();
                $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $szkolenia_id, 'szkolenia_id', 'Zapisany ADM.', $uzytkownik_zapisany->imie.' '.$uzytkownik_zapisany->nazwisko, '' , 'szkolenia_historia_zmian');

                $bazaDanych->wstawDane($tabela, $wartosci);

                $wynikOut = 1;
                $komunikat = 'Uczestnik został dopisany do szkolenia!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;
                $przeladujPopUp = 1;
                $przeladujPopUpAktywnaZakladka = 'oeszUczestnicy';
                $element_id = $szkolenia_id;

            break;

        case 'usun_ze_szkolenia':
            $uzytkownikNaBazie = $bazaDanych->pobierzDane('imie, nazwisko', 'uzytkownik', 'id = '.$uzytkownik_id);
            $uzytkownikNaBazie = $uzytkownikNaBazie->fetch_object();

            $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $szkolenia_id, 'szkolenia_id', 'Wypisany ADM.', $uzytkownikNaBazie->imie.' '.$uzytkownikNaBazie->nazwisko, '' , 'szkolenia_historia_zmian');

            $bazaDanych->deleteDane($tabela, 'szkolenia_id = '.$szkolenia_id.' AND uzytkownik_id = '.$uzytkownik_id);

                $wynikOut = 1;
                $komunikat = 'Usunięto użytkownika ze szkolenia!!!';
                $rodzajOut = 'sukces';

            break;

        case 'usun_przywroc_element':
                $reakcja = htmlspecialchars($_POST['reakcja']);
                $element_id = htmlspecialchars($_POST['element_id']);

                if($reakcja == 'usun'){
                    $bazaDanych->usunDane($tabela, $element_id);
                    $komunikat = 'Usunięto element!!!';
                }else{
                    $bazaDanych->przywrocDane($tabela, $element_id);
                    $komunikat = 'Przywrócono element!!!';
                }

                $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $element_id, $tabela.'_id', 'Element - '.$reakcja, '', '' , $tabela.'_historia_zmian');

                $wynikOut = 1;
                $rodzajOut = 'sukces';
                $ukryjPopUp = 1;
                $przeladujWidok = 1;

                if($tabela == 'szkolenia_materialy'){
                    $ukryjPopUp = 0;
                    $przeladujWidok = 0;
                }

            break;

        case 'aktualizuj_aktualnosc':
                $dane = json_decode($_POST['dane'],true);
                $element_id = htmlspecialchars($_POST['element_id']);

                if($dane['miniatura'] != 'null' && isset($dane['miniatura'])){
                    $miniaturaPoZapisaniu = $szkoleniaMain->zapiszPlik('miniatura', $dane['miniatura'], "/var/www/pliki/!szkolenia/aktualnosci/$element_id");
                    $dane['miniatura'] = $miniaturaPoZapisaniu;
                }

                $szkoleniaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

                $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;

            break;

        case 'dodaj_aktualnosc':
            $dane = json_decode($_POST['dane'],true);
            $dane = array_merge($dane, array( 'uzytkownik_id' => $_SESSION['uzytkownik_id']));
            $dane = array_merge($dane, array( 'aktualnosci_slownik_status_id' => '2'));

            $aktualnosc_id = $bazaDanych->wstawDane($tabela, $dane);

            if($dane['miniatura'] != 'null' && isset($dane['miniatura'])){
                $miniaturaPoZapisaniu = $szkoleniaMain->zapiszPlik('miniatura', $dane['miniatura'], "/var/www/pliki/!szkolenia/aktualnosci/$aktualnosc_id");
                $bazaDanych->aktualizujDane($tabela, array('miniatura' => $miniaturaPoZapisaniu), $aktualnosc_id);
            }

            $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $aktualnosc_id, 'szkolenia_aktualnosci_id', 'Dodanie aktualności', '', $aktualnosc_id , 'szkolenia_aktualnosci_historia_zmian');

            $wynikOut = 1;
            $komunikat = 'Zmiany zostały zapisane!!!';
            $rodzajOut = 'sukces';
            $przeladujWidok = 1;
            $ukryjPopUp = 1;

            break;

        case 'aktualizuj_szkolenie':
                $dane = json_decode($_POST['dane'],true);
                $element_id = htmlspecialchars($_POST['element_id']);

                $szkoleniaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

                $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;

            break;

        case 'dodaj_material':
                $dane = json_decode($_POST['dane'],true);
                $dane = array_merge($dane, array( 'uzytkownik_id' => $_SESSION['uzytkownik_id']));

                if($dane['plik'] != 'null' && isset($dane['plik'])){
                    $typ_plik = explode('.',$dane['plik']);
                    if(end($typ_plik) == 'pdf' || end($typ_plik) == 'PDF'){
                        $dane = array_merge($dane, array( 'szkolenia_slownik_materialy_rodzaj_id' => 2));
                    }
                }

                $material_id = $bazaDanych->wstawDane($tabela, $dane);

                if($dane['plik'] != 'null' && isset($dane['plik'])){
                    $miniaturaPoZapisaniu = $szkoleniaMain->zapiszPlik('plik', $dane['plik'], "/var/www/pliki/!szkolenia/materialy/$material_id");
                    $bazaDanych->aktualizujDane($tabela, array('plik' => $miniaturaPoZapisaniu), $material_id);
                }

                $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $material_id, 'szkolenia_materialy_id', 'Dodanie materiału', '', $material_id , 'szkolenia_materialy_historia_zmian');

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 0;
                $ukryjPopUp = 1;
                $przeladujPopUp = 1;
                $przeladujPopUpAktywnaZakladka = 'oeszMaterialy';

            break;

        case 'aktualizuj_material':
                $dane = json_decode($_POST['dane'],true);
                $element_id = htmlspecialchars($_POST['element_id']);

                if($dane['plik'] != 'null' && isset($dane['plik'])){
                    $typ_plik = explode('.',$dane['plik']);
                    if(end($typ_plik) == 'pdf' || end($typ_plik) == 'PDF'){
                        $dane = array_merge($dane, array( 'szkolenia_slownik_materialy_rodzaj_id' => 2));
                    }
                }

                if($dane['plik'] != 'null' && isset($dane['plik'])){
                    $miniaturaPoZapisaniu = $szkoleniaMain->zapiszPlik('plik', $dane['plik'], "/var/www/pliki/!szkolenia/materialy/$element_id");
                    $dane['plik'] = $miniaturaPoZapisaniu;
                }

                $szkoleniaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

                $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 0;
                $ukryjPopUp = 1;
                $przeladujPopUp = 1;
                $przeladujPopUpAktywnaZakladka = 'oeszMaterialy';

                $element_id_tmp = $bazaDanych->pobierzDane('szkolenia_id', 'szkolenia_materialy', 'id = '.$element_id);
                $element_id_tmp = $element_id_tmp->fetch_object();
                $element_id = $element_id_tmp->szkolenia_id;

            break;

        case 'dodaj_szkolenie':
                $dane = json_decode($_POST['dane'],true);
                $dane = array_merge($dane, array( 'uzytkownik_id' => $_SESSION['uzytkownik_id']));

                $szkolenia_id = $bazaDanych->wstawDane($tabela, $dane);

                $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $szkolenia_id, 'szkolenia_id', 'Dodanie szkolenia', '', $szkolenia_id , 'szkolenia_historia_zmian');

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 1;
                $ukryjPopUp1 = 1;

            break;

        case 'dodaj_test':
                $dane = json_decode($_POST['dane'],true);
                $dane = array_merge($dane, array( 'uzytkownik_id' => $_SESSION['uzytkownik_id']));

                $test_id = $bazaDanych->wstawDane($tabela, $dane);

                $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $test_id, 'szkolenia_testy_id', 'Dodanie testu', '', $test_id , 'szkolenia_testy_historia_zmian');

                $wynikOut = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidok = 0;
                $ukryjPopUp = 1;
                $przeladujPopUp = 1;
                $przeladujPopUpAktywnaZakladka = 'oeszMaterialy';


            break;

        case 'aktualizuj_test':
            $dane = json_decode($_POST['dane'],true);
            $element_id = htmlspecialchars($_POST['element_id']);

            $szkoleniaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

            $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

            $element_id_tmp = $bazaDanych->pobierzDane('szkolenia_id', 'szkolenia_testy', 'id = '.$element_id);
            $element_id_tmp = $element_id_tmp->fetch_object();
            $element_id = $element_id_tmp->szkolenia_id;

            $wynikOut = 1;
            $komunikat = 'Zmiany zostały zapisane!!!';
            $rodzajOut = 'sukces';
            $przeladujWidok = 0;
            $przeladujPopUp = 1;
            $przeladujPopUpAktywnaZakladka = 'oeszMaterialy';

            break;
    }



    $dane = array(
            0 => $wynikOut
            ,'rodzaj' => $rodzajOut
            ,'komunikat' => $komunikat
            ,'ukryjPopUp' => $ukryjPopUp
            ,'ukryjPopUp1' => $ukryjPopUp1
            ,'przeladujWidok' => $przeladujWidok
            ,'przeladujPopUp' => $przeladujPopUp
            ,'przeladujPopUpElementId' => $element_id
            ,'przeladujPopUpAktywnaZakladka' => $przeladujPopUpAktywnaZakladka
    );

    echo json_encode($dane);
    return;