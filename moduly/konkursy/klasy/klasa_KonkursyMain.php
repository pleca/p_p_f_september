<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class KonkursyMain extends main_PanelPrzedstawiciela {
    private $_bd;
    private $_uzytkownikId;
    private $_uzytkownikGrupaId;
    private $_konkursId;
    private $_listaKonkursow = array();
    private $_listaPrzyznanychKonkursow = array();
    private $_listaDokumentow = array();
    private $_listaPrzyznanychDokumentow = array();

    function __construct($bazaDanych){
        $this->_bd = $bazaDanych;
    }

    private function pobierzListeKonkursow(){
        if($this->_uzytkownikGrupaId === '1' || $this->sprawdzUprawnienie('konkurs_edytuj_swoje') || $this->sprawdzUprawnienie('konkurs_edytuj_wszystkie')){
            $listaKonkursow_tmp = $this->_bd->pobierzDane('id', 'konkurs','czy_usuniety = 0');
            if(!is_null($listaKonkursow_tmp)){
                while($poj_listaKonkursow_tmp = $listaKonkursow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychKonkursow, $poj_listaKonkursow_tmp->id);
                }
            }
        }else{
            $listaKonkursow_tmp = $this->_bd->pobierzDane('konkurs_id', 'konkurs_uzytkownik','uzytkownik_id = '.$this->_uzytkownikId);
            if(!is_null($listaKonkursow_tmp)){
                while($poj_listaKonkursow_tmp = $listaKonkursow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychKonkursow, $poj_listaKonkursow_tmp->konkurs_id);
                }
            }

            $listaKonkursow_tmp = $this->_bd->pobierzDane('konkurs_id', 'konkurs_grupy','uzytkownik_grupa_id = '.$this->_uzytkownikGrupaId);
            if(!is_null($listaKonkursow_tmp)){
                while($poj_listaKonkursow_tmp = $listaKonkursow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychKonkursow, $poj_listaKonkursow_tmp->konkurs_id);
                }
            }
            $listaKonkursow_tmp = $this->_bd->pobierzDane('id', 'konkurs','uzytkownik_id = '.$_SESSION['uzytkownik_id']);
            if(!is_null($listaKonkursow_tmp)){
                while($poj_listaKonkursow_tmp = $listaKonkursow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychKonkursow, $poj_listaKonkursow_tmp->id);
                }
            }
        }

        $this->_listaPrzyznanychKonkursow = array_unique($this->_listaPrzyznanychKonkursow);
        $listaWszystkichKonkursow_tmp = $this->_bd->pobierzDane('id', 'konkurs','czy_usuniety = 0', 'nr_kolejnosci ASC');
        if(!is_null($listaWszystkichKonkursow_tmp)){
            while($poj_lwk_tmp = $listaWszystkichKonkursow_tmp->fetch_object()){
                if(in_array($poj_lwk_tmp->id, $this->_listaPrzyznanychKonkursow)){
                    array_push($this->_listaKonkursow, $poj_lwk_tmp->id);
                }
            }
        }

    }

    private function pobierzListeDokumentow($koknoEdycji = false){
        if($koknoEdycji){
            $listaDokumentow_tmp = $this->_bd->pobierzDane('id', 'konkurs_dokumenty','czy_usuniety = 0 AND konkurs_id = '.$this->_konkursId);

            if(!is_null($listaDokumentow_tmp)){
                while($poj_listaDokumentow_tmp = $listaDokumentow_tmp->fetch_object()){
                    array_push($this->_listaDokumentow, $poj_listaDokumentow_tmp->id);
                }
            }
            return;
        }

        if($this->_uzytkownikGrupaId === '1' || $this->sprawdzUprawnienie('konkurs_edytuj_swoje')){
            $listaDokumentow_tmp = $this->_bd->pobierzDane('id', 'konkurs_dokumenty','czy_usuniety = 0');
            if(!is_null($listaDokumentow_tmp)){
                while($poj_listaDokumentow_tmp = $listaDokumentow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychDokumentow, $poj_listaDokumentow_tmp->id);
                }
            }
        }else{
            $listaDokumentow_tmp = $this->_bd->pobierzDane('konkurs_dokumenty_id', 'konkurs_dokumenty_id_uzytkownik_id','uzytkownik_id = '.$this->_uzytkownikId);
            if(!is_null($listaDokumentow_tmp)){
                while($poj_listaDokumentow_tmp = $listaDokumentow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychDokumentow, $poj_listaDokumentow_tmp->konkurs_dokumenty_id);
                }
            }

            $listaDokumentow_tmp = $this->_bd->pobierzDane('konkurs_dokumenty_id', 'konkurs_dokumenty_id_uzytkownik_grupy_id','uzytkownik_grupy_id = '.$this->_uzytkownikGrupaId);
            if(!is_null($listaDokumentow_tmp)){
                while($poj_listaDokumentow_tmp = $listaDokumentow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychDokumentow, $poj_listaDokumentow_tmp->konkurs_dokumenty_id);
                }
            }
        }

        $this->_listaPrzyznanychDokumentow = array_unique($this->_listaPrzyznanychDokumentow);
        $listaWszystkichDokumentow_tmp = $this->_bd->pobierzDane('id', 'konkurs_dokumenty','konkurs_id = '.$this->_konkursId.' AND czy_usuniety = 0', 'data_aktualizacji DESC');
        if(!is_null($listaWszystkichDokumentow_tmp)){
            while($poj_lwd_tmp = $listaWszystkichDokumentow_tmp->fetch_object()){
                if(in_array($poj_lwd_tmp->id, $this->_listaPrzyznanychDokumentow)){
                    array_push($this->_listaDokumentow, $poj_lwd_tmp->id);
                }
            }
        }

    }

    private function generujListeDokumentowWidok($koknoEdycji = false){

        $tresc = '';

        $tresc .= '<table class="table table-striped margin_b_0">';
            $tresc .='<thead>';
            $tresc .='<tr>';
            $tresc .= '<th class="">Id</th>';
            $tresc .= '<th class="col-md-2">Rodzaj</th>';
            $tresc .= '<th class="'.(($koknoEdycji) ? 'col-md-5' : 'col-md-3' ).'">Nazwa</th>';
            if(!$koknoEdycji){
                $tresc .= '<th class="col-md-4">opis</th>';
            }
            $tresc .= '<th class="col-md-3">Ostatnia aktualizacja</th>';
            $tresc .= '<th class="'.(($koknoEdycji) ? 'col-md-2' : '' ).'">';
                if($koknoEdycji){
                    $tresc .= '<i class="fa fa-plus-square float_r dodajDokument" aria-hidden="true"></i>';
                }
            $tresc .= '</th>';
            $tresc .='</tr>';
            $tresc .='</thead>';
            $tresc .='<tbody>';
            foreach($this->_listaDokumentow as $dokumentId){
                $dokument_tmp = $this->_bd->pobierzDane('*','konkurs_dokumenty','id = '.$dokumentId);
                $dokument_tmp = $dokument_tmp->fetch_object();
                $dokument_rodzaj_tmp = $this->_bd->pobierzDane('wartosc','konkurs_slownik_dokument_rodzaj','id = '.$dokument_tmp->konkurs_slownik_dokument_rodzaj_id);
                $dokument_rodzaj_tmp = $dokument_rodzaj_tmp->fetch_object();
                $tresc .='<tr>';
                    $tresc .= '<td class="">'.$dokument_tmp->id.'</td>';
                    $tresc .= '<td class="col-md-2">'.$dokument_rodzaj_tmp->wartosc.'</td>';
                    $tresc .= '<td class="'.(($koknoEdycji) ? 'col-md-5' : 'col-md-3' ).'">'.$dokument_tmp->nazwa.'</td>';
                    if(!$koknoEdycji){
                        $tresc .= '<th class="col-md-4">'.$dokument_tmp->opis.'</th>';
                    }
                    $tresc .= '<td class="col-md-3">'.$dokument_tmp->data_aktualizacji.'</td>';
                    $tresc .= '<td class="'.(($koknoEdycji) ? 'col-md-2' : '' ).'">';
                        if($koknoEdycji){
                            $tresc .= '<i class="fa fa-pencil margin_r_5 float_r edytujDokument" aria-hidden="true" data-element_id="'.$dokumentId.'"></i>';
                            $tresc .= '<i class="fa fa-trash margin_r_5 float_r" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$dokumentId.'\' data-reakcja=\'usun\' data-tabela=\'konkurs_dokumenty\' type=\'button\' class=\'btn btn-danger usunPrzywrocElement usunTak usunDokument\'>TAK</button>"></i>';

                        }else{
                            $nazwa_tmp = explode('.',$dokument_tmp->nazwa_pliku);
                            $blank = (end($nazwa_tmp) === 'pdf') ? 'target="_blank"' : '' ;
                            $tresc .= '<a href="https://' . $_SERVER ['HTTP_HOST'] . '/moduly/konkursy/wyswietlDokument?id='.$dokument_tmp->konkurs_id.'&nazwa='.$dokument_tmp->nazwa_pliku.'" '.$blank.'><i class="fa fa-'.(($dokument_tmp->pdf === '1') ? 'eye' : 'floppy-o' ).'" aria-hidden="true"></a></i>';
                        }
                    $tresc .= '</td>';

                $tresc .='</tr>';
            }
            $tresc .='</tbody>';
        $tresc .='</table>';

        return $tresc;
    }

    public function pobierzZdjecie($kid, $knazwa, $kklasa){
        //http://stackoverflow.com/questions/5630266/a-php-file-as-img-src

        $image = '/var/www/pliki/!konkursy/'.$kid.'/'.$knazwa;
        $imageData = base64_encode(file_get_contents($image));
        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
        return '<img class="'.$kklasa.'" src="' . $src . '">';

    }

    public function wygenerujMiniatureKonkursu($kkonkursId){
        $konkurs_tmp = $this->_bd->pobierzDane('*', 'konkurs', 'id = '.$kkonkursId.' AND czy_usuniety = 0');
        if(is_null($konkurs_tmp)){
            return;
        }
        $konkurs_tmp = $konkurs_tmp->fetch_object();
        echo '<div id="konkurs_'.$konkurs_tmp->id.'" class="cursor_pointer col-lg-4 col-md-6 col-sm-6 col-sx-12 konkurs" data-nr_kolejnosci="'.$konkurs_tmp->nr_kolejnosci.'" data-element_id="'.$konkurs_tmp->id.'">';
            echo '<div class="konkursOpcje position_absolute">';
                if($this->sprawdzUprawnienie('konkurs_edytuj_wszystkie')){
                    echo '<i class="fa fa-pencil edytujkonkurs" aria-hidden="true"></i>';
                }else{
                    if($this->sprawdzUprawnienie('konkurs_edytuj_swoje')){
                        if($konkurs_tmp->uzytkownik_id == $_SESSION['uzytkownik_id']){
                            echo '<i class="fa fa-pencil edytujkonkurs" aria-hidden="true"></i>';
                        }
                    }
                }
                if($this->sprawdzUprawnienie('konkurs_historia')){
                    echo '<i class="fa fa-calendar historiaWyswietl" data-element_id="'.$konkurs_tmp->id.'" data-tabela="konkurs_historia_zmian" aria-hidden="true"></i>';
                }

            echo '</div>';
            echo '<div class="panel panel-default wyswietlKonkurs" >';
                echo '<div class="panel-heading">'.$konkurs_tmp->tytul.'</div>';
                echo '<div class="panel-body">';
                    echo '<div class="miniaturaKonkurs">';
                        echo $this->pobierzZdjecie($kkonkursId, $konkurs_tmp->miniatura, '');
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }

    public function wygenerujListeKonkursow($kuzytkownikId, $kuzytkownikGrupaId){
        $this->_uzytkownikId = $kuzytkownikId;
        $this->_uzytkownikGrupaId = $kuzytkownikGrupaId;

        $this->pobierzListeKonkursow();

        return $this->_listaKonkursow;
    }

    public function pobierzDokumentyKonkursu($kuzytkownikId, $kuzytkownikGrupaId, $kkonkursId){
        $this->_uzytkownikId = $kuzytkownikId;
        $this->_uzytkownikGrupaId = $kuzytkownikGrupaId;
        $this->_konkursId = $kkonkursId;
        $this->pobierzListeDokumentow();

        return $this->_listaDokumentow;
    }

    public function generujListeDokumentow($kuzytkownikId, $kuzytkownikGrupaId, $kkonkursId, $koknoEdycji = false){
         $this->_uzytkownikId = $kuzytkownikId;
         $this->_uzytkownikGrupaId = $kuzytkownikGrupaId;
         $this->_konkursId = $kkonkursId;
         $this->pobierzListeDokumentow($koknoEdycji);

         return $this->generujListeDokumentowWidok($koknoEdycji);
    }

    public function generujRanking($kpoczatek, $kkoniec, $kgrupa, $kklasa){
        $rezultat = '';
        $rezultat .= '<div class="well well-sm">';
            $rezultat .= '<div class="">Ranking dla przedziału czasu</div>';
            $rezultat .= '<div class="form-group col-md-5 col-xs-6 margin_b_0 margin_t_10 padding_l_0 padding_r_0">';
                $rezultat .= '<p class="col-md-1 col-xs-4 padding_r_0 margin_t_5">Od:</p><div class="col-md-11 col-xs-8 padding_l_0"><input type="text" class="form-control datePicker prm wymagane dataPoczatek" data-kolumna="poczatek" data-wartosc_domyslna="'.$kpoczatek.'" value="'.$kpoczatek.'"></div>';
            $rezultat .= '</div>';
            $rezultat .= '<div class="form-group col-md-5 col-xs-6 margin_b_0 margin_t_10 padding_l_0 mpadding_r_0">';
               $rezultat .= '<p class="col-md-1 col-xs-4 padding_r_0 margin_t_5">Od:</p><div class="col-md-11 col-xs-8 padding_l_0"><input type="text" class="form-control datePicker prm wymagane dataKoniec" data-kolumna="koniec" data-wartosc_domyslna="'.$kkoniec.'" value="'.$kkoniec.'"></div>';
            $rezultat .= '</div>';
            $rezultat .= '<div class="form-group col-md-2 col-xs-12 margin_b_0 margin_t_10 padding_l_0 padding_r_0 wyswietlRankingPole">';
                $rezultat .= '<button type="button" class="btn btn-success width_100 wyswietlRanking" data-grupa="'.$kgrupa.'" data-klasa_rodzic="'.$kklasa.'">Wyświetl</button>';
            $rezultat .= '</div>';
            $rezultat .= '<div class="clear_b"></div>';
        $rezultat .= '</div>';
        $rezultat .= '<div class="panel panel-default">';
            $rezultat .= '<div class="panel-heading">'.$kpoczatek.' - '.$kkoniec.'</div>';
            $rezultat .= '<div class="panel-body scrollX rankingWynik">';

                $rezultat .= '<table class="table table-striped tabela_lista_rankingow_'.$kgrupa.'">';

                $polaczenieSql = $this->_bd->polaczeniePceSql();

                $rankingLista_tmp = $this->_bd->wywolajProcedureSql('php_rankingi_przedstawicieli', array(
                    'poczatek' => $kpoczatek
                    ,'koniec' => $kkoniec
                    ,'grupa' => $kgrupa
                ), $polaczenieSql);

                    $i=0;

                        while (($row = mssql_fetch_array($rankingLista_tmp, MSSQL_ASSOC))) {
                            if($i === 0){
                                $rezultat .= '<thead>';
                                        $rezultat .= '<tr>';
                                            foreach($row as $klucz => $wartosc){
                                                $rezultat .= '<th>'.$klucz.'</th>';
                                            }
                                        $rezultat .= '</tr>';
                                    $rezultat .= '</thead>';
                                $rezultat .= '<tbody>';
                            }
                                $rezultat .= '<tr>';
                                foreach($row as $klucz => $wartosc){
                                    $rezultat .= '<td>'.iconv("cp1250","UTF-8",$wartosc).'</td>';
                                }
                                $rezultat .= '</tr>';
                            $i++;
                        }

                        mssql_close($polaczenieSql);
                    $rezultat .= '</tbody>';
                $rezultat .= '</table>';

            $rezultat .= '</div>';
        $rezultat .= '</div>';
       return $rezultat;
    }

    public function generujListeDodatkowychGrafik($kkonkursId){
        $listaGrafik_tmp = $this->_bd->pobierzDane('*','konkurs_grafiki','konkurs_id = '.$kkonkursId.' AND czy_usuniety = 0');
        $tresc = '';

        $tresc .= '<table class="table table-striped margin_b_0">';
            $tresc .='<thead>';
                $tresc .='<tr>';
                    $tresc .= '<th class="">Id</th>';
                    $tresc .= '<th class="col-md-3">Miniatura</th>';
                    $tresc .= '<th class="col-md-5">Nazwa</th>';
                    $tresc .= '<th class="col-md-3">Ostatnia aktualizacja</th>';
                    $tresc .= '<th class="col-md-1"><i class="float_r fa fa-plus-square dodaj_dodatkowa_grafike" aria-hidden="true"></i></th>';
                $tresc .='</tr>';
            $tresc .='</thead>';
            $tresc .='<tbody>';
                if(!is_null($listaGrafik_tmp)) {
                    while ($poj_listaGrafik_tmp = $listaGrafik_tmp->fetch_object()) {
                        $tresc .= '<tr>';
                            $tresc .= '<td class="">' . $poj_listaGrafik_tmp->id . '</td>';
                            $tresc .= '<td class="col-md-3">' . $this->pobierzZdjecie($poj_listaGrafik_tmp->konkurs_id, $poj_listaGrafik_tmp->nazwa_pliku, 'width_100 height_auto') . '</td>';
                            $tresc .= '<td class="col-md-5">' . $poj_listaGrafik_tmp->nazwa . '</td>';
                            $tresc .= '<td class="col-md-3">' . $poj_listaGrafik_tmp->data_aktualizacji . '</td>';
                            $tresc .= '<td class="col-md-1">';
                                $tresc .= '<i class="fa fa-pencil margin_r_5 float_r edytujDodatkowaGrafike" aria-hidden="true" data-element_id="' . $poj_listaGrafik_tmp->id . '"></i>';
                                $tresc .= '<i class="fa fa-trash margin_r_5 float_r" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\'' . $poj_listaGrafik_tmp->id . '\' data-reakcja=\'usun\' data-tabela=\'konkurs_grafiki\' type=\'button\' class=\'btn btn-danger usunPrzywrocElement usunTak usunDodatkoweZdjecie\'>TAK</button>"></i>';
                            $tresc .= '</td>';
                        $tresc .= '</tr>';

                    }
                }
            $tresc .='</tbody>';
        $tresc .='</table>';
        return $tresc;

    }
}