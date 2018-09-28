<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class FilmyMain extends main_PanelPrzedstawiciela {
    private $_uzytkownikId;
    private $_uzytkownikGrupaId;
    private $_kategoriaFilmuId;
    private $_listaFilmow = array();
    private $_listaPrzyznanychFilmow = array();
    private $_listaKategori = array();
    private $_listaPrzyznanychKategori = array();
    private $_listaPodcastow = array();
    private $_listaPrzyznanychPodcastow = array();
    private $_listaTagow = array();
    private $_listaDostepnychTagow = array();

    private $_bd;

    function __construct($bazaDanych){
        $this->_bd = $bazaDanych;
    }

    private function pobierzListeKategori(){
        if($this->_uzytkownikGrupaId === '1' || $this->sprawdzUprawnienie('filmy_edytuj_kategorie')){
            $listaKategori_tmp = $this->_bd->pobierzDane('id', 'film_kategoria','czy_usuniety = 0');
            if(!is_null($listaKategori_tmp)){
                while($poj_listaKategori_tmp = $listaKategori_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychKategori, $poj_listaKategori_tmp->id);
                }
            }
        }else{
            $listaKategori_tmp = $this->_bd->pobierzDane('film_kategoria_id', 'film_kategoria_id_uzytkownik_grupy_id','uzytkownik_grupy_id = '.$this->_uzytkownikGrupaId);
            if(!is_null($listaKategori_tmp)){
                while($poj_listaKategori_tmp = $listaKategori_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychKategori, $poj_listaKategori_tmp->film_kategoria_id);
                }
            }

            $listaKategori_tmp = $this->_bd->pobierzDane('film_kategoria_id', 'film_kategoria_id_uzytkownik_id','uzytkownik_id = '.$this->_uzytkownikId);
            if(!is_null($listaKategori_tmp)){
                while($poj_listaKategori_tmp = $listaKategori_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychKategori, $poj_listaKategori_tmp->film_kategoria_id);
                }
            }
        }

        $this->_listaPrzyznanychKategori = array_unique($this->_listaPrzyznanychKategori);
        $listaWszystkichKategori_tmp = $this->_bd->pobierzDane('id', 'film_kategoria','czy_usuniety = 0', 'nr_kolejnosci ASC');
        if(!is_null($listaWszystkichKategori_tmp)){
            while($poj_lwk_tmp = $listaWszystkichKategori_tmp->fetch_object()){
                if(in_array($poj_lwk_tmp->id, $this->_listaPrzyznanychKategori)){
                    array_push($this->_listaKategori, $poj_lwk_tmp->id);
                }
            }
        }
    }

    private function pobierzListeFilmow(){
        $this->_listaFilmow = array();
        $this->_listaPrzyznanychFilmow = array();

        if($this->_uzytkownikGrupaId === '1' || $this->sprawdzUprawnienie('film_edytuj_swoje') || $this->sprawdzUprawnienie('film_edytuj_wszystkie')){
            $listaFilmow_tmp = $this->_bd->pobierzDane('id', 'film','czy_usuniety = 0 AND kategoria_id = '.$this->_kategoriaFilmuId);
            if(!is_null($listaFilmow_tmp)){
                while($poj_listaFilmow_tmp = $listaFilmow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychFilmow, $poj_listaFilmow_tmp->id);
                }
            }
        }else{
            $listaFilmow_tmp = $this->_bd->pobierzDane('film_id', 'film_uzytkownik','uzytkownik_id = '.$this->_uzytkownikId);
            if(!is_null($listaFilmow_tmp)){
                while($poj_listaFilmow_tmp = $listaFilmow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychFilmow, $poj_listaFilmow_tmp->film_id);
                }
            }

            $listaFilmow_tmp = $this->_bd->pobierzDane('film_id', 'film_grupy','uzytkownik_grupy_id = '.$this->_uzytkownikGrupaId);
            if(!is_null($listaFilmow_tmp)){
                while($poj_listaFilmow_tmp = $listaFilmow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychFilmow, $poj_listaFilmow_tmp->film_id);
                }
            }
        }

        $this->_listaPrzyznanychFilmow = array_unique($this->_listaPrzyznanychFilmow);
        $listaWszystkichFilmow_tmp = $this->_bd->pobierzDane('id', 'film','czy_usuniety = 0 AND kategoria_id = '.$this->_kategoriaFilmuId, 'nr_kolejnosci ASC');
        if(!is_null($listaWszystkichFilmow_tmp)){
            while($poj_lwk_tmp = $listaWszystkichFilmow_tmp->fetch_object()){
                if(in_array($poj_lwk_tmp->id, $this->_listaPrzyznanychFilmow)){
                    array_push($this->_listaFilmow, $poj_lwk_tmp->id);
                }
            }
        }


    }

    private function pobierzListePodcastow(){
        if($this->_uzytkownikGrupaId === '1' || $this->sprawdzUprawnienie('podcasty_edytuj_wszystkie')){
            $listaPodcastow_tmp = $this->_bd->pobierzDane('id', 'podcasty','czy_usuniety = 0');
            if(!is_null($listaPodcastow_tmp)){
                while($poj_listaPodcastow_tmp = $listaPodcastow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychPodcastow, $poj_listaPodcastow_tmp->id);
                }
            }
        }else{
            $listaPodcastow_tmp = $this->_bd->pobierzDane('podcasty_id', 'podcasty_id_uzytkownik_grupy_id','uzytkownik_grupy_id = '.$this->_uzytkownikGrupaId);
            if(!is_null($listaPodcastow_tmp)){
                while($poj_listaPodcastow_tmp = $listaPodcastow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychPodcastow, $poj_listaPodcastow_tmp->podcasty_id);
                }
            }

            $listaPodcastow_tmp = $this->_bd->pobierzDane('podcasty_id', 'podcasty_id_uzytkownik_id','uzytkownik_id = '.$this->_uzytkownikId);
            if(!is_null($listaPodcastow_tmp)){
                while($poj_listaPodcastow_tmp = $listaPodcastow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychPodcastow, $poj_listaPodcastow_tmp->podcasty_id);
                }
            }
        }

        $this->_listaPrzyznanychPodcastow = array_unique($this->_listaPrzyznanychPodcastow);
        $listaWszystkichPodcastow_tmp = $this->_bd->pobierzDane('id', 'podcasty','czy_usuniety = 0');
        if(!is_null($listaWszystkichPodcastow_tmp)){
            while($poj_lwk_tmp = $listaWszystkichPodcastow_tmp->fetch_object()){
                if(in_array($poj_lwk_tmp->id, $this->_listaPrzyznanychPodcastow)){
                    array_push($this->_listaPodcastow, $poj_lwk_tmp->id);
                }
            }
        }
    }

    private function pobierzListeTagow($wszystkie, $podcastId){
        $this->_listaTagow = array();

        if($wszystkie){
            $tagi_tmp = $this->_bd->pobierzDane('id','podcasty_tagi','czy_usuniety = 0 AND liczba_wystapien != 0');
            if(!is_null($tagi_tmp)){
                while($poj_tagi_tmp = $tagi_tmp->fetch_object()){
                    array_push($this->_listaTagow,$poj_tagi_tmp->id);
                }
            }
        }else{
            $tagi_tmp = $this->_bd->pobierzDane('podcasty_tagi_id','podcasty_id_podcasty_tagi_id','podcasty_id = '.$podcastId);
            if(!is_null($tagi_tmp)){
                while($poj_tagi_tmp = $tagi_tmp->fetch_object()){
                    array_push($this->_listaTagow,$poj_tagi_tmp->podcasty_tagi_id);
                }
            }
        }
    }

    private function pobierzChmurkeTagow($podcastId, $tytul){
        return $this->wczytajWidok('/var/www/html/moduly/filmy/ajax/widoki/elementy/widok_chumrka_tagow.php', array(
            'listaTagow' => $this->_listaTagow
            ,'podcastId' => $podcastId
            ,'tytul' => $tytul
        ));
    }

    public function pobierzZdjecie($kid, $knazwa, $kklasa){
        //http://stackoverflow.com/questions/5630266/a-php-file-as-img-src

        $image = '/var/www/pliki/!filmy/'.$kid.'/'.$knazwa;
        $imageData = base64_encode(file_get_contents($image));
        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
        return '<img class="'.$kklasa.'" src="' . $src . '">';

    }

    public function wygenerujListeFilmow($uzytkownikId,$uzytkownikGrupaId, $kategoriaFilmuId){
        $this->_uzytkownikId = $uzytkownikId;
        $this->_uzytkownikGrupaId = $uzytkownikGrupaId;
        $this->_kategoriaFilmuId = $kategoriaFilmuId;

        $this->pobierzListeFilmow();

        return $this->_listaFilmow;
    }

    public function wygenerujListeKategori($uzytkownikId,$uzytkownikGrupaId){
        $this->_uzytkownikId = $uzytkownikId;
        $this->_uzytkownikGrupaId = $uzytkownikGrupaId;

        $this->pobierzListeKategori();

        return $this->_listaKategori;
    }

    public function wygenerujListePodcastow($uzytkownikId,$uzytkownikGrupaId){
        $this->_uzytkownikId = $uzytkownikId;
        $this->_uzytkownikGrupaId = $uzytkownikGrupaId;

        $this->pobierzListePodcastow();

        return $this->_listaPodcastow;
    }

    public function wygenerujChmurkeTagow($wszystkie = false, $podcastId = null, $tytul){
        $this->pobierzListeTagow($wszystkie, $podcastId);

        return $this->pobierzChmurkeTagow($podcastId, $tytul);

    }

    public function tabelkaWynikowPodcastow(){
        return $this->wczytajWidok('/var/www/html/moduly/filmy/ajax/widoki/elementy/widok_tabelka_wynikow_podcastow.php');
    }

}