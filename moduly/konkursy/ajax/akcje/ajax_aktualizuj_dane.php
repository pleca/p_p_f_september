<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$konkursyMain = new KonkursyMain($bazaDanych);

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '' ;
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '' ;
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
$dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;

$komunikat = EMPTY_ACTION;
$rodzajOut = ERROR;
$przeladujWidok = 0;
$ukryjPopUp1 = 0;
$ukryjPopUp2 = 0;
$przeladujPopUp = 0;
$przeladujPopUpZakladka = null;
$przeladujPopUp2 = 0;

switch ($akcja) {

    case 'usun_przywroc_element':
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;

            if($reakcja === 'przywroc'){
                $czy_usuniety = 0;
            }else{
                $czy_usuniety = 1;
            }

            if($tabela === 'konkurs_dokumenty'){
                $konkursId = $bazaDanych->pobierzDane('konkurs_id','konkurs_dokumenty','id = '.$element_id);
                $konkursId = $konkursId->fetch_object();
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $konkursId->konkurs_id, 'konkurs_id', DOCUMENT_DELETE, 'Dokument id:', $element_id , 'konkurs_historia_zmian');
                $bazaDanych->aktualizujDane($tabela, array( 'czy_usuniety' => $czy_usuniety ), $element_id);
            }

            if($tabela === 'konkurs'){
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', CONTEST_DELETE, 'Konkurs id:', $element_id , 'konkurs_historia_zmian');
                $bazaDanych->aktualizujDane($tabela, array( 'czy_usuniety' => $czy_usuniety ), $element_id);
                $przeladujWidok = 1;
                $ukryjPopUp1 = 1;
            }

            if($tabela === 'konkurs_grafiki'){
                $grafika_tmp = $bazaDanych->pobierzDane('*','konkurs_grafiki','id = '.$element_id);
                $grafika_tmp = $grafika_tmp->fetch_object();

                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $grafika_tmp->konkurs_id, 'konkurs_id', CONTEST_PICTURE_DELETE, 'Grafika id:', $element_id , 'konkurs_historia_zmian');
                $bazaDanych->aktualizujDane($tabela, array( 'czy_usuniety' => $czy_usuniety ), $element_id);
                $bazaDanych->deleteDane('konkurs_grafiki_id_uzytkownik_grupy_id','konkurs_grafiki_id = '.$element_id);
            }

            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;

        break;

    case 'zapisz_nowy_dokument':

            $dane = array_merge(array('data_aktualizacji' => 'NOW()'),$dane);
            $dane = array_merge(array('konkurs_id' => $element_id),$dane);

            $dokumentId_tmp = $bazaDanych->wstawDane('konkurs_dokumenty',$dane);
            $dokumentNazwa_tmp = $konkursyMain->zapiszPlik('plik',$_FILES['plik']['name'],'/var/www/pliki/!konkursy/'.$element_id);

            $pdf_tmp = explode('.',$dokumentNazwa_tmp);
            if(end($pdf_tmp) === 'pdf'){
                $pdf_tmp = 1;
            }else{
                $pdf_tmp = 0;
            }

            $bazaDanych->aktualizujDane('konkurs_dokumenty',array(
                'nazwa_pliku' => $dokumentNazwa_tmp
                ,'pdf' => $pdf_tmp
            ),$dokumentId_tmp);

            $konkursyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', DOCUMENT_ADD, '', $dokumentNazwa_tmp , 'konkurs_historia_zmian');

            $ukryjPopUp2 = 1;
            $przeladujPopUp = 1;
            $przeladujPopUpZakladka = 'konkursDokumenty';
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'zapisz_zmiany_konkurs':
            $konurs_tmp = $bazaDanych->pobierzDane('*','konkurs','id = '.$element_id);
            $konurs_tmp = $konurs_tmp->fetch_object();

            $konkursyMain->porownajZmianyDoHistorii($bazaDanych,$element_id,$dane,'konkurs');
            $bazaDanych->aktualizujDane('konkurs', $dane, $element_id);

            if(array_key_exists('tytul',$dane) || array_key_exists('nr_kolejnosci',$dane)){
                if($konurs_tmp->tytul !== $dane['tytul']){
                    $przeladujWidok = 1;
                }
                if($konurs_tmp->nr_kolejnosci !== $dane['nr_kolejnosci']){
                    $przeladujWidok = 1;
                }

            }


            if(!is_null($_FILES['miniatura'])){
                $dokumentNazwa_tmp = $konkursyMain->zapiszPlik('miniatura',$_FILES['miniatura']['name'],'/var/www/pliki/!konkursy/'.$element_id);
                $dane = array(
                    'miniatura' => $dokumentNazwa_tmp
                );
                $konkursyMain->porownajZmianyDoHistorii($bazaDanych,$element_id,$dane,'konkurs');
                $bazaDanych->aktualizujDane('konkurs', $dane, $element_id);
                $przeladujWidok = 1;
            }

            if(!is_null($_FILES['pelneZdjecie'])){
                $dokumentNazwa_tmp = $konkursyMain->zapiszPlik('pelneZdjecie',$_FILES['pelneZdjecie']['name'],'/var/www/pliki/!konkursy/'.$element_id);
                $dane = array(
                    'zdjecie_duze' => $dokumentNazwa_tmp
                );
                $konkursyMain->porownajZmianyDoHistorii($bazaDanych,$element_id,$dane,'konkurs');
                $bazaDanych->aktualizujDane('konkurs', $dane, $element_id);
            }

            if(!empty($_POST['usunPelneZdjecie']) && $_POST['usunPelneZdjecie']){

                $bazaDanych->aktualizujDane('konkurs', array('zdjecie_duze' => 'null'), $element_id);
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', 'Edycja zdjecie_duze', $konurs_tmp->zdjecie_duze, '' , 'konkurs_historia_zmian');

            }

            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'zapisz_zmiany_dokument':
            $dane = array_merge(array('data_aktualizacji' => 'NOW()'),$dane);

            $konkursId_tmp = $bazaDanych->pobierzDane('*', 'konkurs_dokumenty', 'id = '.$element_id);
            $konkursId_tmp = $konkursId_tmp->fetch_object();

            if(isset($_FILES['plik'])){
                $dane = array_merge(array('data_aktualizacji' => 'NOW()'),$dane);
                $dokumentNazwa_tmp = $konkursyMain->zapiszPlik('plik',$_FILES['plik']['name'],'/var/www/pliki/!konkursy/'.$konkursId_tmp->konkurs_id);
                $pdf_tmp = explode('.',$dokumentNazwa_tmp);

                if(end($pdf_tmp) === 'pdf'){
                    $pdf_tmp = 1;
                }else{
                    $pdf_tmp = 0;
                }

                $bazaDanych->aktualizujDane('konkurs_dokumenty',array(
                    'nazwa_pliku' => $dokumentNazwa_tmp
                    ,'pdf' => $pdf_tmp
                ),$element_id);

                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $konkursId_tmp->konkurs_id, 'konkurs_id', DOCUMENT_EDIT_FILE, $konkursId_tmp->nazwa_pliku, $dokumentNazwa_tmp , 'konkurs_historia_zmian');

            }

            if(array_key_exists('nazwa',$dane)){
                if($konkursId_tmp->nazwa != $dane['nazwa']){
                    $konkursyMain->dodajWpisDoHistorii($bazaDanych, $konkursId_tmp->konkurs_id, 'konkurs_id', 'Edycja nazwa', $konkursId_tmp->nazwa , $dane['nazwa'], 'konkurs_historia_zmian');
                }
            }

            if(array_key_exists('opis',$dane)){
                if($konkursId_tmp->opis != $dane['opis']){
                    $konkursyMain->dodajWpisDoHistorii($bazaDanych, $konkursId_tmp->konkurs_id, 'konkurs_id', 'Edycja opis', $konkursId_tmp->opis , $dane['opis'], 'konkurs_historia_zmian');
                }
            }

            if(array_key_exists('konkurs_slownik_dokument_rodzaj_id',$dane)){
                if($konkursId_tmp->konkurs_slownik_dokument_rodzaj_id != $dane['konkurs_slownik_dokument_rodzaj_id']){
                    $konkursyMain->dodajWpisDoHistorii($bazaDanych, $konkursId_tmp->konkurs_id, 'konkurs_id', 'Edycja konkurs_slownik_dokument_rodzaj_id',  $konkursId_tmp->konkurs_slownik_dokument_rodzaj_id ,$dane['konkurs_slownik_dokument_rodzaj_id'], 'konkurs_historia_zmian');
                }
            }

            $bazaDanych->aktualizujDane('konkurs_dokumenty', $dane, $element_id);

            $przeladujPopUp2 = 1;
            $przeladujPopUp = 1;
            $przeladujPopUpZakladka = 'konkursDokumenty';
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;

        break;

    case 'zapisz_zmiany_dodatkowa_grafike':
            $grafika_tmp = $bazaDanych->pobierzDane('*','konkurs_grafiki','id = '.$element_id);
            $grafika_tmp = $grafika_tmp->fetch_object();

            $dane = array();

            $nazwa = (isset($_POST['nazwa'])) ? htmlspecialchars($_POST['nazwa']) : '' ;
            if(isset($_FILES['dodatkowaGrafika'])){
                $dokumentNazwa_tmp = $konkursyMain->zapiszPlik('dodatkowaGrafika',$_FILES['dodatkowaGrafika']['name'],'/var/www/pliki/!konkursy/'.$grafika_tmp->konkurs_id);
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $grafika_tmp->konkurs_id, 'konkurs_id', 'Edycja nazwa_pliku', $grafika_tmp->nazwa_pliku, $dokumentNazwa_tmp , 'konkurs_historia_zmian');
                $dane = array_merge($dane, array('nazwa_pliku' => $dokumentNazwa_tmp));
            }

            if(!empty($nazwa)){
                if($grafika_tmp->nazwa !== $nazwa){
                    $konkursyMain->dodajWpisDoHistorii($bazaDanych, $grafika_tmp->konkurs_id, 'konkurs_id', 'Edycja nazwa', $grafika_tmp->nazwa, $nazwa , 'konkurs_historia_zmian');
                    $dane = array_merge($dane, array('nazwa' => $nazwa));
                }

            }

            $dane = array_merge($dane, array('data_aktualizacji' => 'NOW()'));
            $bazaDanych->aktualizujDane('konkurs_grafiki',$dane,$element_id);

            $grafika_tmp = $bazaDanych->pobierzDane('*','konkurs_grafiki','id = '.$element_id);
            $grafika_tmp = $grafika_tmp->fetch_object();
            $przeladujPopUp = $konkursyMain->wczytajWidok('/var/www/html/moduly/konkursy/ajax/widoki/elementy/widok_edytuj_grafike.php',array(
                'grafika' => $grafika_tmp
            ));

            $przeladujPopUpZakladka = $konkursyMain->generujListeDodatkowychGrafik($grafika_tmp->konkurs_id);
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_usun_uprawnienie_grupy':
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
            $uzytkownik_grupa_id = (isset($_POST['uzytkownik_grupa_id'])) ? htmlspecialchars($_POST['uzytkownik_grupa_id']) : '' ;

            $uzytkownikGrupa_tmp = $bazaDanych->pobierzDane('nazwa','uzytkownik_grupy','id = '.$uzytkownik_grupa_id);
            $uzytkownikGrupa_tmp = $uzytkownikGrupa_tmp->fetch_object();

            if($reakcja === 'usun'){
                $bazaDanych->deleteDane('konkurs_grupy','uzytkownik_grupa_id = '.$uzytkownik_grupa_id.' AND konkurs_id = '.$element_id);
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', CONTEST_PERMISSION_DELETE, 'Grupa:', $uzytkownikGrupa_tmp->nazwa , 'konkurs_historia_zmian');
            }else{
                $bazaDanych->wstawDane('konkurs_grupy',array(
                    'uzytkownik_grupa_id' =>$uzytkownik_grupa_id
                    ,'konkurs_id' => $element_id
                ), false);
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', CONTEST_PERMISSION_ADD, 'Grupa:', $uzytkownikGrupa_tmp->nazwa , 'konkurs_historia_zmian');

            }


            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_usun_uprawnienie_dokument_grupy':
        $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
        $uzytkownik_grupa_id = (isset($_POST['uzytkownik_grupa_id'])) ? htmlspecialchars($_POST['uzytkownik_grupa_id']) : '' ;

        $uzytkownikGrupa_tmp = $bazaDanych->pobierzDane('nazwa','uzytkownik_grupy','id = '.$uzytkownik_grupa_id);
        $uzytkownikGrupa_tmp = $uzytkownikGrupa_tmp->fetch_object();

        $dokument_tmp = $bazaDanych->pobierzDane('nazwa, konkurs_id','konkurs_dokumenty','id = '.$element_id);
        $dokument_tmp = $dokument_tmp->fetch_object();

        if($reakcja === 'usun'){
            $bazaDanych->deleteDane('konkurs_dokumenty_id_uzytkownik_grupy_id','uzytkownik_grupy_id = '.$uzytkownik_grupa_id.' AND konkurs_dokumenty_id = '.$element_id);
            $konkursyMain->dodajWpisDoHistorii($bazaDanych, $dokument_tmp->konkurs_id, 'konkurs_id', CONTEST_DOCUMENT_PERMISSION_DELETE, 'Grupa: '.$uzytkownikGrupa_tmp->nazwa, 'Nazwa: '.$dokument_tmp->nazwa , 'konkurs_historia_zmian');
        }else{
            $bazaDanych->wstawDane('konkurs_dokumenty_id_uzytkownik_grupy_id',array(
                'uzytkownik_grupy_id' =>$uzytkownik_grupa_id
                ,'konkurs_dokumenty_id' => $element_id
            ), false);
            $konkursyMain->dodajWpisDoHistorii($bazaDanych, $dokument_tmp->konkurs_id, 'konkurs_id', CONTEST_DOCUMENT_PERMISSION_ADD, 'Grupa: '.$uzytkownikGrupa_tmp->nazwa, 'Nazwa: '.$dokument_tmp->nazwa , 'konkurs_historia_zmian');

        }


        $komunikat = SAVE_CHANGES;
        $rodzajOut = SUCCESS;
        break;

    case 'dodaj_usun_uprawnienie_grafika_grupy':
        $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
        $uzytkownik_grupa_id = (isset($_POST['uzytkownik_grupa_id'])) ? htmlspecialchars($_POST['uzytkownik_grupa_id']) : '' ;

        $uzytkownikGrupa_tmp = $bazaDanych->pobierzDane('nazwa','uzytkownik_grupy','id = '.$uzytkownik_grupa_id);
        $uzytkownikGrupa_tmp = $uzytkownikGrupa_tmp->fetch_object();

        $grafika_tmp = $bazaDanych->pobierzDane('nazwa, konkurs_id','konkurs_grafiki','id = '.$element_id);
        $grafika_tmp = $grafika_tmp->fetch_object();

        if($reakcja === 'usun'){
            $bazaDanych->deleteDane('konkurs_grafiki_id_uzytkownik_grupy_id','uzytkownik_grupy_id = '.$uzytkownik_grupa_id.' AND konkurs_grafiki_id = '.$element_id);
            $konkursyMain->dodajWpisDoHistorii($bazaDanych, $grafika_tmp->konkurs_id, 'konkurs_id', CONTEST_PICTURE_PERMISSION_DELETE, 'Grupa: '.$uzytkownikGrupa_tmp->nazwa, 'Nazwa: '.$grafika_tmp->nazwa , 'konkurs_historia_zmian');
        }else{
            $bazaDanych->wstawDane('konkurs_grafiki_id_uzytkownik_grupy_id',array(
                'uzytkownik_grupy_id' =>$uzytkownik_grupa_id
                ,'konkurs_grafiki_id' => $element_id
            ), false);
            $konkursyMain->dodajWpisDoHistorii($bazaDanych, $grafika_tmp->konkurs_id, 'konkurs_id', CONTEST_PICTURE_PERMISSION_ADD, 'Grupa: '.$uzytkownikGrupa_tmp->nazwa, 'Nazwa: '.$grafika_tmp->nazwa , 'konkurs_historia_zmian');

        }


        $komunikat = SAVE_CHANGES;
        $rodzajOut = SUCCESS;
        break;

    case 'dodaj_usun_uprawnienie_uzytkownika' :
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
            $uzytkownik_id = (isset($_POST['uzytkownik_id'])) ? htmlspecialchars($_POST['uzytkownik_id']) : '' ;

            $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko','uzytkownik','id = '.$uzytkownik_id);
            $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();

            if($reakcja === 'usun'){
                $bazaDanych->deleteDane('konkurs_uzytkownik','uzytkownik_id = '.$uzytkownik_id.' AND konkurs_id = '.$element_id);
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', CONTEST_PERMISSION_DELETE, 'Użytkownik:', $uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko , 'konkurs_historia_zmian');
            }else{
                $bazaDanych->wstawDane('konkurs_uzytkownik',array(
                    'uzytkownik_id' =>$uzytkownik_id
                    ,'konkurs_id' => $element_id
                ), false);
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', CONTEST_PERMISSION_ADD, 'Użytkownik:', $uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko , 'konkurs_historia_zmian');

                $przeladujPopUp = 1;
                $przeladujPopUpZakladka = 'konkursWidocznosc';
            }

            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_usun_uprawnienie_dokument_uzytkownika':
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
            $uzytkownik_id = (isset($_POST['uzytkownik_id'])) ? htmlspecialchars($_POST['uzytkownik_id']) : '' ;

            $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko','uzytkownik','id = '.$uzytkownik_id);
            $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();

            $dokument_tmp = $bazaDanych->pobierzDane('nazwa, konkurs_id','konkurs_dokumenty','id = '.$element_id);
            $dokument_tmp = $dokument_tmp->fetch_object();

            if($reakcja === 'usun'){
                $bazaDanych->deleteDane('konkurs_dokumenty_id_uzytkownik_id','uzytkownik_id = '.$uzytkownik_id.' AND konkurs_dokumenty_id = '.$element_id);
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $dokument_tmp->konkurs_id, 'konkurs_id', CONTEST_DOCUMENT_PERMISSION_DELETE, 'Użytkownik: '.$uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko, 'Nazwa: '.$dokument_tmp->nazwa  , 'konkurs_historia_zmian');
            }else{
                $bazaDanych->wstawDane('konkurs_dokumenty_id_uzytkownik_id',array(
                    'uzytkownik_id' =>$uzytkownik_id
                ,'konkurs_dokumenty_id' => $element_id
                ), false);
                $konkursyMain->dodajWpisDoHistorii($bazaDanych, $dokument_tmp->konkurs_id, 'konkurs_id', CONTEST_DOCUMENT_PERMISSION_ADD, 'Użytkownik: '.$uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko, 'Nazwa: '.$dokument_tmp->nazwa , 'konkurs_historia_zmian');

                $przeladujPopUp = 1;
                $przeladujPopUpZakladka = 'konkursDokumentWidocznosc';
            }

            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_konkurs':
            $dane = array_merge($dane, array(
                'uzytkownik_id' => $_SESSION['uzytkownik_id']
            ));

            $konkursId = $bazaDanych->wstawDane('konkurs', $dane);
            $konkursyMain->dodajWpisDoHistorii($bazaDanych, $konkursId, 'konkurs_id', CONTEST_ADD, '', $dokumentNazwa_tmp , 'konkurs_historia_zmian');

            if(isset($_FILES['miniatura'])){
                $dokumentNazwa_tmp = $konkursyMain->zapiszPlik('miniatura',$_FILES['miniatura']['name'],'/var/www/pliki/!konkursy/'.$konkursId);
                $dane = array(
                    'miniatura' => $dokumentNazwa_tmp
                );
                $bazaDanych->aktualizujDane('konkurs', $dane, $konkursId);
            }

            if(isset($_FILES['pelneZdjecie'])){
                $dokumentNazwa_tmp = $konkursyMain->zapiszPlik('pelneZdjecie',$_FILES['pelneZdjecie']['name'],'/var/www/pliki/!konkursy/'.$konkursId);
                $dane = array(
                    'zdjecie_duze' => $dokumentNazwa_tmp
                );
                $bazaDanych->aktualizujDane('konkurs', $dane, $konkursId);
            }

            $przeladujWidok = 1;
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_dodatkowa_grafike':
            $nazwa = (isset($_POST['nazwa'])) ? htmlspecialchars($_POST['nazwa']) : '' ;
            $dokumentNazwa_tmp = $konkursyMain->zapiszPlik('dodatkowaGrafika',$_FILES['dodatkowaGrafika']['name'],'/var/www/pliki/!konkursy/'.$element_id);

            $konkursGrafikaId_tmp = $bazaDanych->wstawDane('konkurs_grafiki',array(
                'konkurs_id' => $element_id
                ,'nazwa_pliku' => $dokumentNazwa_tmp
                ,'data_aktualizacji' => 'NOW()'
                ,'nazwa' => $nazwa
            ));

            $konkursyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', CONTEST_PICTURE_ADD, '', $dokumentNazwa_tmp , 'konkurs_historia_zmian');

            $ukryjPopUp2 = 1;
            $przeladujPopUpZakladka = $konkursyMain->generujListeDodatkowychGrafik($element_id);
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;
}

$arrayOut = array(
    'rodzaj' => $rodzajOut
    ,'komunikat' => $komunikat
    ,'przeladujWidok' => $przeladujWidok
    ,'ukryjPopUp' => $ukryjPopUp1
    ,'ukryjPopUp2' => $ukryjPopUp2
    ,'przeladujPopUp' => $przeladujPopUp
    ,'przeladujPopUp2' => $przeladujPopUp2
    ,'przeladujPopUpZakladka' => $przeladujPopUpZakladka

);

echo json_encode($arrayOut);
return;