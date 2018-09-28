<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$filmyMain = new FilmyMain($bazaDanych);

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '' ;
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '' ;
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
$dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;

$komunikat = EMPTY_ACTION;
$rodzajOut = ERROR;
$przeladujWidok = false;
$ukryjPopUp1 = false;
$ukryjPopUp2 = 0;
$przeladujPopUp = 0;
$przeladujPopUpZakladka = null;
$przeladujPopUp2 = 0;
$elementIdOut = null;

switch ($akcja) {
    case 'usun_przywroc_element':
        $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;

        if($reakcja === 'przywroc'){
            $czy_usuniety = 0;
        }else{
            $czy_usuniety = 1;
        }

        if($tabela === 'film_kategoria'){
            $filmyKategori = $bazaDanych->pobierzDane('id','film','czy_usuniety = 0 AND kategoria_id = '.$element_id);

            if(!is_null($filmyKategori)){
                $komunikat = 'Przenieś filmy do innej kategorii!!!';
                $rodzajOut = ERROR;
                break;
            }

            $filmyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'konkurs_id', 'Usunięcie kategorii', '', $element_id , 'film_kategoria_historia_zmian');
            $bazaDanych->aktualizujDane($tabela, array( 'czy_usuniety' => $czy_usuniety ), $element_id);

            $ukryjPopUp1 = true;
            $przeladujWidok = true;
        }

        if($tabela === 'film'){
            $film_kategoria_tmp = $bazaDanych->pobierzDane('kategoria_id','film','id = '.$element_id);
            $film_kategoria_tmp = $film_kategoria_tmp->fetch_object();

            $filmyMain->dodajWpisDoHistorii($bazaDanych, $film_kategoria_tmp->kategoria_id, 'film_kategoria_id', 'Usunięcie filmu', '', $film_kategoria_tmp->kategoria_id , 'film_kategoria_historia_zmian');
            $filmyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'film_id', 'Usunięcie filmu', '', $element_id , 'film_historia_zmian');

            $bazaDanych->aktualizujDane($tabela, array( 'czy_usuniety' => $czy_usuniety ), $element_id);

            $ukryjPopUp1 = true;
            $przeladujWidok = true;
        }

        if($tabela === 'podcasty'){
            $filmyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'podcasty_id', 'Usunięcie podcastu', '', $element_id , 'podcasty_historia_zmian');
            $bazaDanych->aktualizujDane($tabela, array( 'czy_usuniety' => $czy_usuniety ), $element_id);

            $ukryjPopUp1 = true;
            $przeladujWidok = true;
        }

        $komunikat = SAVE_CHANGES;
        $rodzajOut = SUCCESS;

        break;

    case 'usun_dodaj_tag':
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;

            if($reakcja === 'dodaj'){
                $nazwa = (isset($_POST['nazwa'])) ? htmlspecialchars($_POST['nazwa']) : '' ;

                $tag_tmp = $bazaDanych->pobierzDane('*','podcasty_tagi','nazwa = "'.$nazwa.'"');

                if(is_null($tag_tmp)){
                    $tag_id = $bazaDanych->wstawDane('podcasty_tagi',array(
                        'nazwa' => $nazwa
                        ,'liczba_wystapien' => 1
                    ));
                }else{
                    $tag_tmp = $tag_tmp->fetch_object();

                    $bazaDanych->aktualizujDane('podcasty_tagi',array(
                        'liczba_wystapien' => ($tag_tmp->liczba_wystapien + 1)
                    ), $tag_tmp->id);

                    $tag_id = $tag_tmp->id;
                }

                $bazaDanych->wstawDane('podcasty_id_podcasty_tagi_id',array(
                    'podcasty_id' => $element_id
                    ,'podcasty_tagi_id' => $tag_id
                ), false);

                $filmyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'podcasty_id', 'Dodanie tagu', '', $nazwa , 'podcasty_historia_zmian');
                $elementIdOut = $tag_id;
            }

            if($reakcja === 'usun'){
                $tag_id = (isset($_POST['tag_id'])) ? htmlspecialchars($_POST['tag_id']) : '' ;
                $bazaDanych->deleteDane('podcasty_id_podcasty_tagi_id','podcasty_id = '.$element_id.' AND podcasty_tagi_id = '.$tag_id);

                $tag_tmp = $bazaDanych->pobierzDane('*','podcasty_tagi','id = '.$tag_id);
                $tag_tmp = $tag_tmp->fetch_object();

                $liczbaWystapien = $tag_tmp->liczba_wystapien - 1;

                $bazaDanych->aktualizujDane('podcasty_tagi',array(
                    'liczba_wystapien' => ($liczbaWystapien < 0) ? 0 : $liczbaWystapien
                ), $tag_tmp->id);

                $filmyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'podcasty_id', 'Usunięcie tagu', $tag_tmp->nazwa, '' , 'podcasty_historia_zmian');
            }

            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_kategorie_filmu':
            $filmId_tmp = $bazaDanych->wstawDane($tabela,$dane);
            $filmyMain->dodajWpisDoHistorii($bazaDanych,$filmId_tmp,'film_kategoria_id','Dodanie kategori','Id:',$filmId_tmp,'film_kategoria_historia_zmian');

            $przeladujWidok = true;
            $ukryjPopUp1 = true;
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_film':
            $dane = array_merge($dane, array('uzytkownik_id' => $_SESSION['uzytkownik_id']));
            $film_id = $bazaDanych->wstawDane('film',$dane);

            $miniatura_tmp = $filmyMain->zapiszPlik('miniatura', $_FILES['miniatura']['name'], '/var/www/pliki/!filmy/'.$film_id);
            $film_tmp = $filmyMain->zapiszPlik('film', $_FILES['film']['name'], '/var/www/pliki/!filmy/'.$film_id);

            $bazaDanych->aktualizujDane('film',array(
                'miniatura' => $miniatura_tmp
                ,'r360' => $film_tmp
            ),$film_id);

            $filmyMain->dodajWpisDoHistorii($bazaDanych,$film_id,'film_id','Dodanie filmu','Id:',$film_id,'film_historia_zmian');
            $filmyMain->dodajWpisDoHistorii($bazaDanych,$dane['kategoria_id'],'film_kategoria_id','Dodanie filmu','Id:',$film_id,'film_kategoria_historia_zmian');

            $przeladujWidok = true;
            $ukryjPopUp1 = true;
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_podcast':
            $dane = array_merge($dane, array('uzytkownik_id' => $_SESSION['uzytkownik_id']));
            $dane = array_merge($dane, array('data_dodania' => 'NOW()'));
            $podcast_id = $bazaDanych->wstawDane('podcasty',$dane);

            $podcast_tmp = $filmyMain->zapiszPlik('podcast', $_FILES['podcast']['name'], '/var/www/pliki/!podcasty/'.$podcast_id);

            $bazaDanych->aktualizujDane('podcasty',array(
                'plik' => $podcast_tmp
            ),$podcast_id);

            $filmyMain->dodajWpisDoHistorii($bazaDanych,$podcast_id,'podcasty_id','Dodanie podcastu','Id:',$podcast_id,'podcasty_historia_zmian');

            $przeladujWidok = true;
            $ukryjPopUp1 = true;
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'zapisz_kategorie_filmu':
            $filmyMain->porownajZmianyDoHistorii($bazaDanych,$element_id,$dane,$tabela);

            $bazaDanych->aktualizujDane($tabela,$dane,$element_id);

            $przeladujWidok = true;
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'zapisz_zmiany_film':
            $film_na_bazie_tmp = $bazaDanych->pobierzDane('*','film','id = '.$element_id);
            $film_na_bazie_tmp = $film_na_bazie_tmp->fetch_object();

            if(isset($_FILES['miniatura'])){
                $miniatura_tmp = $filmyMain->zapiszPlik('miniatura', $_FILES['miniatura']['name'], '/var/www/pliki/!filmy/'.$element_id);
                $bazaDanych->aktualizujDane('film',array('miniatura' => $miniatura_tmp),$element_id);
                $filmyMain->dodajWpisDoHistorii($bazaDanych,$element_id,'film_id','Edycja miniatura',$film_na_bazie_tmp->miniatura,$miniatura_tmp,'film_historia_zmian');
            }

            if(isset($_FILES['film'])){
                $miniatura_tmp = $filmyMain->zapiszPlik('film', $_FILES['film']['name'], '/var/www/pliki/!filmy/'.$element_id);
                $bazaDanych->aktualizujDane('film',array('r360' => $miniatura_tmp),$element_id);
                $filmyMain->dodajWpisDoHistorii($bazaDanych,$element_id,'film_id','Edycja r360',$film_na_bazie_tmp->miniatura,$miniatura_tmp,'film_historia_zmian');
            }

            $filmyMain->porownajZmianyDoHistorii($bazaDanych,$element_id,$dane,$tabela);

            $bazaDanych->aktualizujDane('film',$dane,$element_id);
            $filmyMain->dodajWpisDoHistorii($bazaDanych,$film_na_bazie_tmp->kategoria_id,'film_kategoria_id','Edycja filmu',$film_na_bazie_tmp->tytul,'','film_kategoria_historia_zmian');

            $przeladujWidok = true;
            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'zapisz_zmiany_podcast':
            $podcast_na_bazie_tmp = $bazaDanych->pobierzDane('*','podcasty','id = '.$element_id);
            $podcast_na_bazie_tmp = $podcast_na_bazie_tmp->fetch_object();

            if(isset($_FILES['podcast'])){
                $podcast_tmp = $filmyMain->zapiszPlik('podcast', $_FILES['podcast']['name'], '/var/www/pliki/!podcasty/'.$element_id);
                $bazaDanych->aktualizujDane('podcast',array('plik' => $podcast_tmp),$element_id);
                $filmyMain->dodajWpisDoHistorii($bazaDanych,$element_id,'podcasty_id','Edycja plik',$podcast_na_bazie_tmp->plik,$podcast_tmp,'podcasty_historia_zmian');
            }

            $filmyMain->porownajZmianyDoHistorii($bazaDanych,$element_id,$dane,$tabela);

            $bazaDanych->aktualizujDane($tabela,$dane,$element_id);

            $przeladujWidok = true;
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
    ,'elementIdOut' => $elementIdOut

);

echo json_encode($arrayOut);
return;