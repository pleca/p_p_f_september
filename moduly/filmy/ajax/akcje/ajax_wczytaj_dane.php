<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$element_id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : '';
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '';

$tytul = '';
$tresc = '';
$miniatura = '';

$filmyMain = new FilmyMain($bazaDanych);

switch ($akcja) {
    case 'historia_wyswietl':
            $id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : '';
            $tytul = 'Historia elementu';

            if($tabela == 'film_historia_zmian'){
                $kolumna = 'film_id';
            }

            if($tabela == 'film_kategoria_historia_zmian'){
                $kolumna = 'film_kategoria_id';
            }

            if($tabela == 'podcasty_historia_zmian'){
                $kolumna = 'podcasty_id';
            }

            $tresc = $filmyMain->generujZakladkeHistoria($tabela, $kolumna, $bazaDanych, $id);
        break;

    case 'wyswietl_dodaj_kategorie_filmu':
            $tytul = 'Nowa Kategoria';
            $tresc = $filmyMain->wczytajWidok('/var/www/html/moduly/filmy/ajax/widoki/elementy/widok_dodaj_kategorie.php');
        break;

    case 'wyswietl_dodaj_film':
            $tytul = 'Nowy film';
            $listaKategori = array();
            $listaKategori_tmp = $bazaDanych->pobierzDane('id, wartosc','film_kategoria','czy_usuniety = 0','nr_kolejnosci ASC');

            while($poj_listaKategori_tmp = $listaKategori_tmp->fetch_object()){
                array_push($listaKategori,array(
                    'id' => $poj_listaKategori_tmp->id
                    ,'wartosc' => $poj_listaKategori_tmp->wartosc
                ));
            }

            $tresc = $filmyMain->wczytajWidok('/var/www/html/moduly/filmy/ajax/widoki/elementy/widok_dodaj_film.php',array(
               'listaKategori' => $listaKategori
            ));
        break;

    case 'wyswietl_dodaj_podcast':
        $tytul = 'Nowy podcast';
        $tresc = $filmyMain->wczytajWidok('/var/www/html/moduly/filmy/ajax/widoki/elementy/widok_dodaj_podcast.php');

        break;

    case 'wyswietl_edytuj_kategorie_filmu':
            $kategoria_tmp = $bazaDanych->pobierzDane('*',$tabela,'id = '.$element_id);
            $kategoria_tmp = $kategoria_tmp->fetch_object();

            $tytul = '<i class="fa fa-trash margin_r_5" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$element_id.'\' data-reakcja=\'usun\' data-tabela=\'film_kategoria\' type=\'button\' class=\'btn btn-danger usunPrzywrocElement usunTak usun_kategorieFilmu\'>TAK</button>"></i>Edycja kategorii';

            $tresc = $filmyMain->wczytajWidok('/var/www/html/moduly/filmy/ajax/widoki/elementy/widok_edytuj_kategorie.php',array(
                'kategoriaDane' => $kategoria_tmp
            ));
        break;

    case 'wyswietl_edytuj_film':
            $film_tmp = $bazaDanych->pobierzDane('*','film','id = '.$element_id);
            $film_tmp = $film_tmp->fetch_object();
            $listaKategori = array();
            $listaKategori_tmp = $bazaDanych->pobierzDane('id, wartosc','film_kategoria','czy_usuniety = 0','nr_kolejnosci ASC');

            while($poj_listaKategori_tmp = $listaKategori_tmp->fetch_object()){
                array_push($listaKategori,array(
                    'id' => $poj_listaKategori_tmp->id
                ,'wartosc' => $poj_listaKategori_tmp->wartosc
                ));
            }

            $tytul = '<i class="fa fa-trash margin_r_5" aria-hidden="true" data-placement="right" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$element_id.'\' data-reakcja=\'usun\' data-tabela=\'film\' type=\'button\' class=\'btn btn-danger usunPrzywrocElement usunTak usun_Film width_120px\'>TAK</button>"></i>Edycja filmu';

            $tresc = $filmyMain->wczytajWidok('/var/www/html/moduly/filmy/ajax/widoki/elementy/widok_edytuj_film.php',array(
                'filmDane' => $film_tmp
                ,'listaKategori' => $listaKategori
            ));
        break;

    case 'wyswietl_edytuj_podcast':
            $podcast_tmp = $bazaDanych->pobierzDane('*','podcasty','id = '.$element_id);
            $podcast_tmp = $podcast_tmp->fetch_object();

            $tytul = '<i class="fa fa-trash margin_r_5" aria-hidden="true" data-placement="right" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$element_id.'\' data-reakcja=\'usun\' data-tabela=\'podcasty\' type=\'button\' class=\'btn btn-danger usunPrzywrocElement usunTak usun_podcast width_120px\'>TAK</button>"></i>Edytuj podcast';
            $tresc = $filmyMain->wczytajWidok('/var/www/html/moduly/filmy/ajax/widoki/elementy/widok_edytuj_podcast.php',array(
                'podcastDane' => $podcast_tmp
            ));

        break;

    case 'wyswietl_podcast':
            $podcast_tmp = $bazaDanych->pobierzDane('*',$tabela,'id = '.$element_id);
            $podcast_tmp = $podcast_tmp->fetch_object();

            $filmyMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'podcasty_id', 'Odtworzenie', '', '' , 'podcasty_historia_zmian');
            $bazaDanych->aktualizujDane('podcasty',array(
                'liczba_odtworzen' => ($podcast_tmp->liczba_odtworzen + 1)
            ),$element_id);

            $tytul = $podcast_tmp->tytul.' - '.$podcast_tmp->data_dodania;

            $tresc .= '<div class="well well-sm margin_t_10 margin_b_0">';
                $tresc .= $podcast_tmp->opis;
            $tresc .= '</div>';
        break;
}

$arrayOut = array(
    'tytul' => $tytul
    ,'tresc' => $tresc
    ,'miniatura' => $miniatura
);

echo json_encode($arrayOut);
return;