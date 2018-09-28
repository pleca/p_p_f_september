<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class SklepMain extends main_PanelPrzedstawiciela{
    private $_bd;

    private function pobierzZdjecie($kid, $knazwa, $kklasa){
        //http://stackoverflow.com/questions/5630266/a-php-file-as-img-src

        $image = '/var/www/pliki/!sklep/'.$kid.'/'.$knazwa;
        $imageData = base64_encode(file_get_contents($image));
        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
        return '<img class="'.$kklasa.'" src="' . $src . '">';

    }

    function __construct($bazaDanych){
        $this->_bd = $bazaDanych;
    }

    public function generujMiniatureProduktu($produkt){
        return $this->wczytajWidok('/var/www/html/moduly/sklep/ajax/widoki/elementy/widok_miniatura_produktu.php',array(
            'produkt' => $produkt
            ,'produktLogo' => $this->pobierzZdjecie($produkt->id, $produkt->zdjecie_glowne, 'width_100 height_auto')
        ));
    }

    public function pobierzListeWszystkichProduktow(){
        return $this->_bd->pobierzDane('*', 'sklep_kategorie', 'czy_usuniety = 0');
    }

    public function pobierzListeProduktowKategorii($kategoriaId){
        return $this->_bd->pobierzDane('sklep_produkty_id', 'sklep_produkty_id_sklep_kategorie_id', 'sklep_kategorie_id = '.$kategoriaId);
    }

}