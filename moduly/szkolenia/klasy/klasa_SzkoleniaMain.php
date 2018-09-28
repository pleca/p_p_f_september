<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');


class SzkoleniaMain extends main_PanelPrzedstawiciela {

	public function __construct(){
        //$this->pobierzListeUprawnien($_SESSION['uzytkownik_id'], $kbd);
	}
	
	public function __sleep(){
        return array();
    }
	
	public function __wakeup(){

	}
	
	public function __get($nazwa) {
		return $this->$nazwa;
	}
	
	public function __set($nazwa, $wartosc) {
		$this->$nazwa = $wartosc;
	}
	
	public function pobierzMiniature($kzakladka, $kid, $knazwa){
		//http://stackoverflow.com/questions/5630266/a-php-file-as-img-src
		
		$image = '/var/www/pliki/!szkolenia/'.$kzakladka.'/'.$kid.'/'.$knazwa;
		$imageData = base64_encode(file_get_contents($image));
		$src = 'data: '.mime_content_type($image).';base64,'.$imageData;
		return '<img class="miniaturaAktualnosc" src="' . $src . '">';
		
	}

    public function generujPlanSzkolenia($kid, $kdb, $kwidok_edycji = false, $zapisany = null){
        $rezultat = '';

        $materialy_nadrzedne = $kdb->pobierzDane('*', 'szkolenia_materialy', 'szkolenia_id = '.$kid.' AND material_nadrzedny = 0 AND czy_usuniety = 0', 'nr_kolejnosci ASC');

        if(is_null($materialy_nadrzedne)){
            if($kwidok_edycji){
                $rezultat .= '<table class="table table-striped margin_b_0">';
                    $rezultat .= '<thead>';
                        $rezultat .= '<tr>';
                            $rezultat .= '<th class="">Lp</th>';
                            $rezultat .= '<th class="col-md-4">Nazwa</th>';
                            $rezultat .= '<th class="col-md-4">Opis</th>';
                            $rezultat .= '<th class="col-md-2">Typ</th>';
                            $rezultat .= '<th class="col-md-2">';
                                if($this->sprawdzUprawnienie('szkolenia_materialy_dodaj')) {
                                    $rezultat .= '<i class="fa fa-plus-square float_r" aria-hidden="true" data-placement="left" data-html="true" title="Co chcesz dodać?" data-toggle="popover" data-content="<button data-szkolenia_id=\'' . $kid . '\' data-akcja=\'dodaj_material\' data-rodzaj=\'dodaj_nowy\' type=\'button\' class=\'btn btn-success margin_t_0 dodaj_element_szkolenia\'>Dodaj materiał</button><button data-akcja=\'dodaj_test\' data-rodzaj=\'dodaj_nowy\' type=\'button\' class=\'btn btn-danger dodaj_element_szkolenia margin_t_10\'>Dodaj test</button>"></i>';
                                }
                            $rezultat .= '</th>';
                        $rezultat .= '</tr>';
                    $rezultat .= '</thead>';
                    $rezultat .= '<tbody>';

                    $rezultat .= '</tbody>';
                $rezultat .= '</table>';
            }else{
                $rezultat = 'Brak dostepnych materiałów...';
            }

        }else{
            if($kwidok_edycji){
                $rezultat .= '<table class="table table-striped margin_b_0">';
                    $rezultat .= '<thead>';
                        $rezultat .= '<tr>';
                            $rezultat .= '<th class="">Lp</th>';
                            $rezultat .= '<th class="col-md-4">Nazwa</th>';
                            $rezultat .= '<th class="col-md-4">Opis</th>';
                            $rezultat .= '<th class="col-md-2">Typ</th>';
                            $rezultat .= '<th class="col-md-2">';
                                if($this->sprawdzUprawnienie('szkolenia_materialy_dodaj')) {
                                    $rezultat .= '<i class="fa fa-plus-square float_r" aria-hidden="true" data-placement="left" data-html="true" title="Co chcesz dodać?" data-toggle="popover" data-content="<button data-szkolenia_id=\'' . $kid . '\' data-akcja=\'dodaj_material\' data-rodzaj=\'dodaj_nowy\' type=\'button\' class=\'btn btn-success margin_t_0 dodaj_element_szkolenia\'>Dodaj materiał</button><button data-szkolenia_id=\'' . $kid . '\' data-akcja=\'dodaj_test\' data-rodzaj=\'dodaj_nowy\' type=\'button\' class=\'btn btn-danger dodaj_element_szkolenia margin_t_10\'>Dodaj test</button>"></i>';
                                }
                            $rezultat .= '</th>';
                        $rezultat .= '</tr>';
                    $rezultat .= '</thead>';
                    $rezultat .= '<tbody>';
                        $i = 1;
                        while($poj_materialy_nadrzedne = $materialy_nadrzedne->fetch_object()) {
                            $rezultat .= '<tr>';
                                $rezultat .= '<td class="">'.$i.'</td>';
                                $rezultat .= '<td class="col-md-4">'.$poj_materialy_nadrzedne->nazwa.'</td>';
                                $rezultat .= '<td class="col-md-4">'.$this->utnijSlowa($poj_materialy_nadrzedne->opis,10,' [...]').'</td>';
                                $poj_materialy_nadrzedne_typ = $kdb->pobierzDane('wartosc', 'szkolenia_slownik_materialy_rodzaj', 'id = '.$poj_materialy_nadrzedne->szkolenia_slownik_materialy_rodzaj_id);
                                $poj_materialy_nadrzedne_typ = $poj_materialy_nadrzedne_typ->fetch_object();
                                    $rezultat .= '<td class="col-md-2">'.$poj_materialy_nadrzedne_typ->wartosc.'</td>';
                                $rezultat .= '<td class="col-md-2">';
                                    if($this->sprawdzUprawnienie('szkolenia_materialy_usun')) {
                                        $rezultat .= '<i class="fa fa-trash float_r" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?"  data-content="<button data-element_id=\''.$poj_materialy_nadrzedne->id.'\' data-reakcja=\'usun\' data-tabela=\'szkolenia_materialy\' type=\'button\' class=\'btn btn-danger usunTak usunPrzywrocElement margin_r_10 \'>TAK</button>"></i>';
                                    }
                                    if($this->sprawdzUprawnienie('szkolenia_materialy_edytuj')) {
                                        $rezultat .= '<i class="fa fa-pencil margin_r_5 float_r edytuj_material" data-element_id="'.$poj_materialy_nadrzedne->id.'" data-tabela="szkolenia_materialy" data-akcja="edytuj_material" aria-hidden="true"></i>';
                                    }
                                     if($this->sprawdzUprawnienie('szkolenia_materialy_dodaj')) {
                                        $rezultat .= '<i class="fa fa-plus-square margin_r_5 float_r" aria-hidden="true" data-placement="left" data-html="true" title="Co chcesz dodać?" data-toggle="popover" data-content="<button data-material_id=\'' . $poj_materialy_nadrzedne->id . '\' data-szkolenia_id=\'' . $kid . '-' . $poj_materialy_nadrzedne->id . '\' data-akcja=\'dodaj_material\' data-rodzaj=\'dodaj_nowy\' type=\'button\' class=\'btn btn-success margin_t_0 dodaj_element_szkolenia\'>Dodaj materiał</button><button data-material_id=\'' . $poj_materialy_nadrzedne->id . '\' data-szkolenia_id=\'' . $kid . '-' . $poj_materialy_nadrzedne->id . '\' data-akcja=\'dodaj_test\' data-rodzaj=\'dodaj_nowy\' type=\'button\' class=\'btn btn-danger dodaj_element_szkolenia margin_t_10\'>Dodaj test</button>"></i>';
                                    }
                                $rezultat .= '</td>';
                            $rezultat .= '</tr>';
                            $materialy_poddrzedne = $kdb->pobierzDane('*', 'szkolenia_materialy', 'material_nadrzedny = '.$poj_materialy_nadrzedne->id.' AND czy_usuniety = 0', 'nr_kolejnosci ASC');
                            if(!is_null($materialy_poddrzedne)) {
                                while ($poj_materialy_poddrzedne = $materialy_poddrzedne->fetch_object()) {
                                    $rezultat .= '<tr>';
                                        $rezultat .= '<td class=""></td>';
                                        $rezultat .= '<td class="col-md-4">'.$poj_materialy_poddrzedne->nazwa.'</td>';
                                        $rezultat .= '<td class="col-md-4">'.$this->utnijSlowa($poj_materialy_poddrzedne->opis,10,' [...]').'</td>';
                                        $poj_materialy_poddrzedne_typ = $kdb->pobierzDane('wartosc', 'szkolenia_slownik_materialy_rodzaj', 'id = '.$poj_materialy_poddrzedne->szkolenia_slownik_materialy_rodzaj_id);
                                        $poj_materialy_poddrzedne_typ = $poj_materialy_poddrzedne_typ->fetch_object();
                                            $rezultat .= '<td class="col-md-2">'.$poj_materialy_poddrzedne_typ->wartosc.'</td>';
                                        $rezultat .= '<td class="col-md-2">';
                                            if($this->sprawdzUprawnienie('szkolenia_materialy_usun')) {
                                                $rezultat .= '<i class="fa fa-trash float_r " aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?"  data-content="<button data-element_id=\''.$poj_materialy_poddrzedne->id.'\' data-reakcja=\'usun\' data-tabela=\'szkolenia_materialy\'  type=\'button\' class=\'btn btn-danger usunPrzywrocElement margin_r_10 usunTak \'>TAK</button>"></i>';
                                            }
                                            if($this->sprawdzUprawnienie('szkolenia_materialy_edytuj')) {
                                                $rezultat .= '<i class="fa fa-pencil margin_r_5 float_r edytuj_material" data-element_id="'.$poj_materialy_poddrzedne->id.'" data-tabela="szkolenia_materialy" data-akcja="edytuj_material" aria-hidden="true"></i>';
                                            }
                                        $rezultat .= '</td>';
                                    $rezultat .= '</tr>';
                                }
                            }

                            /*TESTY*/

                            $testy_poddrzedne = $kdb->pobierzDane('*', 'szkolenia_testy', 'material_nadrzedny = '.$poj_materialy_nadrzedne->id.' AND czy_usuniety = 0', 'nr_kolejnosci ASC');
                            //echo 'test';
                            if(!is_null($testy_poddrzedne)) {
                                while ($poj_testy_poddrzedne = $testy_poddrzedne->fetch_object()) {
                                    $rezultat .= '<tr>';
                                        $rezultat .= '<td class=""></td>';
                                        $rezultat .= '<td class="col-md-4">'.$poj_testy_poddrzedne->nazwa.'</td>';
                                        $rezultat .= '<td class="col-md-4">'.$this->utnijSlowa($poj_testy_poddrzedne->opis,10,' [...]').'</td>';
                                        $poj_testy_poddrzedne_typ = $kdb->pobierzDane('wartosc', 'szkolenia_slownik_materialy_rodzaj', 'id = '.$poj_testy_poddrzedne->szkolenia_slownik_materialy_rodzaj_id);
                                        $poj_testy_poddrzedne_typ = $poj_testy_poddrzedne_typ->fetch_object();
                                            $rezultat .= '<td class="col-md-2">'.$poj_testy_poddrzedne_typ->wartosc.'</td>';
                                        $rezultat .= '<td class="col-md-2">';
                                            if($this->sprawdzUprawnienie('szkolenia_materialy_usun')) {
                                                $rezultat .= '<i class="fa fa-trash float_r " aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?"  data-content="<button data-element_id=\''.$poj_testy_poddrzedne->id.'\' data-reakcja=\'usun\' data-tabela=\'szkolenia_testy\'  type=\'button\' class=\'btn btn-danger usunPrzywrocElement margin_r_10 usunTak \'>TAK</button>"></i>';

                                            }
                                            if($this->sprawdzUprawnienie('szkolenia_materialy_edytuj')) {
                                                $rezultat .= '<i class="fa fa-pencil margin_r_5 float_r edytuj_test" data-element_id="'.$poj_testy_poddrzedne->id.'" data-tabela="szkolenia_testy" data-akcja="edytuj_test" aria-hidden="true"></i>';

                                            }
                                         $rezultat .= '</td>';
                                    $rezultat .= '</tr>';
                                }
                            }

                            /*----------------------------------------------------------------------------------------*/
                            $i++;

                        }

                        /*TESTY CALOSCIOWE*/
                            $testy_nadrzedne = $kdb->pobierzDane('*', 'szkolenia_testy', 'szkolenia_id = '.$kid.' AND material_nadrzedny = 0 AND czy_usuniety = 0', 'nr_kolejnosci ASC');

                            if(!is_null($testy_nadrzedne)) {
                                while ($poj_testy_nadrzedne = $testy_nadrzedne->fetch_object()) {
                                    $rezultat .= '<tr>';
                                    $rezultat .= '<td class="">' . $i . '</td>';
                                    $rezultat .= '<td class="col-md-4">' . $poj_testy_nadrzedne->nazwa . '</td>';
                                    $rezultat .= '<td class="col-md-4">' . $this->utnijSlowa($poj_testy_nadrzedne->opis,10,' [...]') . '</td>';
                                    $poj_testy_nadrzedne_typ = $kdb->pobierzDane('wartosc', 'szkolenia_slownik_materialy_rodzaj', 'id = ' . $poj_testy_nadrzedne->szkolenia_slownik_materialy_rodzaj_id);
                                    $poj_testy_nadrzedne_typ = $poj_testy_nadrzedne_typ->fetch_object();
                                    $rezultat .= '<td class="col-md-2">' . $poj_testy_nadrzedne_typ->wartosc . '</td>';
                                    $rezultat .= '<td class="col-md-2">';
                                        if($this->sprawdzUprawnienie('szkolenia_materialy_usun')) {
                                            $rezultat .= '<i class="fa fa-trash float_r" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?"  data-content="<button data-element_id=\''.$poj_testy_nadrzedne->id.'\' data-reakcja=\'usun\' data-tabela=\'szkolenia_testy\' type=\'button\' class=\'btn btn-danger usunTak usunPrzywrocElement margin_r_10 \'>TAK</button>"></i>';

                                        }
                                        if($this->sprawdzUprawnienie('szkolenia_materialy_edytuj')) {
                                            $rezultat .= '<i class="fa fa-pencil margin_r_5 float_r edytuj_test" data-element_id="'.$poj_testy_nadrzedne->id.'" data-tabela="szkolenia_testy" data-akcja="edytuj_test" aria-hidden="true"></i>';

                                        }

                                    $rezultat .= '</td>';
                                    $rezultat .= '</tr>';

                                    $i++;

                                }
                            }
                        /*----------------------------------------------------------------------------------------*/

                    $rezultat .= '</tbody>';
                $rezultat .= '</table>';

            }else if(!$kwidok_edycji && !is_null($zapisany)){
                $rezultat .= '<table class="table table-striped margin_b_0">';
                    $rezultat .= '<thead>';
                        $rezultat .= '<tr>';
                            $rezultat .= '<th class="">Lp</th>';
                            $rezultat .= '<th class="col-md-4">Nazwa</th>';
                            $rezultat .= '<th class="col-md-4">Opis</th>';
                            $rezultat .= '<th class="col-md-2">Typ</th>';
                            $rezultat .= '<th class="">Zal.</th>';
                            $rezultat .= '<th class="col-md-2">';
                            $rezultat .= '</th>';
                        $rezultat .= '</tr>';
                    $rezultat .= '</thead>';
                    $rezultat .= '<tbody>';
                    $i = 1;
                        while($poj_materialy_nadrzedne = $materialy_nadrzedne->fetch_object()) {
                            $rezultat .= '<tr>';
                                $rezultat .= '<td class="">'.$i.'</td>';
                                $rezultat .= '<td class="col-md-4">'.$poj_materialy_nadrzedne->nazwa.'</td>';
                                $rezultat .= '<td class="col-md-4">'.$this->utnijSlowa($poj_materialy_nadrzedne->opis,10,' [...]').'</td>';
                                $poj_materialy_nadrzedne_typ = $kdb->pobierzDane('wartosc', 'szkolenia_slownik_materialy_rodzaj', 'id = '.$poj_materialy_nadrzedne->szkolenia_slownik_materialy_rodzaj_id);
                                $poj_materialy_nadrzedne_typ = $poj_materialy_nadrzedne_typ->fetch_object();
                                    $rezultat .= '<td class="col-md-2">'.$poj_materialy_nadrzedne_typ->wartosc.'</td>';
                                $rezultat .= '<td class=""></td>';
                                $rezultat .= '<td class="col-md-2">';
                                    if($poj_materialy_nadrzedne->szkolenia_slownik_materialy_rodzaj_id == 2){
                                        $rezultat .= '<a href="https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkolenia/wyswietlDokument?zakladka=materialy&id='.$poj_materialy_nadrzedne->id.'&nazwa='.$poj_materialy_nadrzedne->plik.'" target="_blank"><i class="fa fa-eye float_r" aria-hidden="true"></i></a>';
                                    }else{
                                        $rezultat .= '<i data-element_id="'.$poj_materialy_nadrzedne->id.'" data-akcja="wyswietl_material" data-tabela="szkolenia_materialy" class="fa fa-eye float_r wyswietl_material" aria-hidden="true"></i>';
                                    }


                                $rezultat .= '</td>';
                            $rezultat .= '</tr>';
                            $materialy_poddrzedne = $kdb->pobierzDane('*', 'szkolenia_materialy', 'material_nadrzedny = '.$poj_materialy_nadrzedne->id);
                            if(!is_null($materialy_poddrzedne)) {
                                while ($poj_materialy_poddrzedne = $materialy_poddrzedne->fetch_object()) {
                                    $rezultat .= '<tr>';
                                        $rezultat .= '<td class=""></td>';
                                        $rezultat .= '<td class="col-md-4">'.$poj_materialy_poddrzedne->nazwa.'</td>';
                                        $rezultat .= '<td class="col-md-4">'.$this->utnijSlowa($poj_materialy_poddrzedne->opis,10,' [...]').'</td>';
                                        $poj_materialy_poddrzedne_typ = $kdb->pobierzDane('wartosc', 'szkolenia_slownik_materialy_rodzaj', 'id = '.$poj_materialy_poddrzedne->szkolenia_slownik_materialy_rodzaj_id);
                                        $poj_materialy_poddrzedne_typ = $poj_materialy_poddrzedne_typ->fetch_object();
                                            $rezultat .= '<td class="col-md-2">'.$poj_materialy_poddrzedne_typ->wartosc.'</td>';
                                        $rezultat .= '<td class=""></td>';
                                        $rezultat .= '<td class="col-md-2">';
                                            if($poj_materialy_poddrzedne->szkolenia_slownik_materialy_rodzaj_id == 2){
                                                $rezultat .= '<a href="https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkolenia/wyswietlDokument?zakladka=materialy&id='.$poj_materialy_poddrzedne->id.'&nazwa='.$poj_materialy_poddrzedne->plik.'" target="_blank"><i class="fa fa-eye float_r" aria-hidden="true"></i></a>';
                                            }else{
                                                $rezultat .= '<i data-element_id="'.$poj_materialy_poddrzedne->id.'" data-akcja="wyswietl_material" data-tabela="szkolenia_materialy" class="fa fa-eye float_r wyswietl_material" aria-hidden="true"></i>';
                                            }
                                        $rezultat .= '</td>';
                                    $rezultat .= '</tr>';
                                }
                            }

                            /*TESTY*/

                            $testy_poddrzedne = $kdb->pobierzDane('*', 'szkolenia_testy', 'material_nadrzedny = '.$poj_materialy_nadrzedne->id.' AND czy_usuniety = 0', 'nr_kolejnosci ASC');
                            //echo 'test';
                            if(!is_null($testy_poddrzedne)) {
                                while ($poj_testy_poddrzedne = $testy_poddrzedne->fetch_object()) {
                                    $rezultat .= '<tr>';
                                        $rezultat .= '<td class=""></td>';
                                        $rezultat .= '<td class="col-md-4">'.$poj_testy_poddrzedne->nazwa.'</td>';
                                        $rezultat .= '<td class="col-md-4">'.$this->utnijSlowa($poj_testy_poddrzedne->opis,10,' [...]').'</td>';
                                        $poj_testy_poddrzedne_typ = $kdb->pobierzDane('wartosc', 'szkolenia_slownik_materialy_rodzaj', 'id = '.$poj_testy_poddrzedne->szkolenia_slownik_materialy_rodzaj_id);
                                        $poj_testy_poddrzedne_typ = $poj_testy_poddrzedne_typ->fetch_object();
                                            $rezultat .= '<td class="col-md-2">'.$poj_testy_poddrzedne_typ->wartosc.'</td>';
                                        $rezultat .= '<td class=""></td>';
                                        $rezultat .= '<td class="col-md-2">';

                                            $rezultat .= '<i data-element_id="'.$poj_testy_poddrzedne->id.'" data-akcja="wyswietl_test" data-tabela="szkolenia_testy" class="fa fa-eye float_r wyswietl_test" aria-hidden="true"></i>';

                                        $rezultat .= '</td>';
                                    $rezultat .= '</tr>';
                                }
                            }

                            /*----------------------------------------------------------------------------------------*/

                            $i++;

                        }

                /*TESTY CALOSCIOWE*/
                $testy_nadrzedne = $kdb->pobierzDane('*', 'szkolenia_testy', 'szkolenia_id = '.$kid.' AND material_nadrzedny = 0 AND czy_usuniety = 0', 'nr_kolejnosci ASC');

                if(!is_null($testy_nadrzedne)) {
                    while ($poj_testy_nadrzedne = $testy_nadrzedne->fetch_object()) {
                        $rezultat .= '<tr>';
                        $rezultat .= '<td class="">' . $i . '</td>';
                        $rezultat .= '<td class="col-md-4">' . $poj_testy_nadrzedne->nazwa . '</td>';
                        $rezultat .= '<td class="col-md-4">' . $this->utnijSlowa($poj_testy_nadrzedne->opis,10,' [...]') . '</td>';
                        $poj_testy_nadrzedne_typ = $kdb->pobierzDane('wartosc', 'szkolenia_slownik_materialy_rodzaj', 'id = ' . $poj_testy_nadrzedne->szkolenia_slownik_materialy_rodzaj_id);
                        $poj_testy_nadrzedne_typ = $poj_testy_nadrzedne_typ->fetch_object();
                        $rezultat .= '<td class="col-md-2">' . $poj_testy_nadrzedne_typ->wartosc . '</td>';
                        $rezultat .= '<td class=""></td>';
                        $rezultat .= '<td class="col-md-2">';
                        $rezultat .= '<i data-element_id="' . $poj_testy_nadrzedne->id . '" data-akcja="wyswietl_test" data-tabela="szkolenia_testy" class="fa fa-eye float_r wyswietl_test" aria-hidden="true"></i>';
                        $rezultat .= '</td>';
                        $rezultat .= '</tr>';

                        $i++;

                    }
                }
                /*----------------------------------------------------------------------------------------*/

                    $rezultat .= '</tbody>';
                $rezultat .= '</table>';
            }else{
                while($poj_materialy_nadrzedne = $materialy_nadrzedne->fetch_object()){
                    $rezultat .= '<ul class="media-list">';
                        $rezultat .= '<li class="media">';
                            $rezultat .= '<div class="media-body">';
                                $rezultat .= '<b class="media-heading">'.$poj_materialy_nadrzedne->nazwa.'</b>';
                                $rezultat .= '<p>'.$poj_materialy_nadrzedne->opis.'</p>';

                                $materialy_poddrzedne = $kdb->pobierzDane('*', 'szkolenia_materialy', 'material_nadrzedny = '.$poj_materialy_nadrzedne->id);
                                if(!is_null($materialy_poddrzedne)){
                                    while($poj_materialy_poddrzedne = $materialy_poddrzedne->fetch_object()){
                                        $rezultat .= '<div class="media">';
                                            $rezultat .= '<div class="media-left"></div>';
                                            $rezultat .= '<div class="media-body">';
                                                $rezultat .= '<b class="media-heading">'.$poj_materialy_poddrzedne->nazwa.'</b>';
                                                $rezultat .= '<p>'.$poj_materialy_poddrzedne->opis.'</p>';
                                            $rezultat .= '</div>';
                                        $rezultat .= '</div>';
                                    }
                                }
                            $rezultat .= '</div>';
                        $rezultat .= '</li>';
                    $rezultat .= '</ul>';
                }
            }
        }

        return $rezultat;

    }

    public function pobierzListeUczestnikow($kszkolenie_id, $kdb, $kwidok_edycji = false){
        $rezultat = '';

        $lista_uczestnikow = $kdb->pobierzDane('uzytkownik_id', 'szkolenia_id_uzytkownik_id', 'szkolenia_id = '.$kszkolenie_id);


            if($kwidok_edycji){
                $rezultat .= '<table class="table tabela_szkolenia_lista_uczestnikow table-striped margin_b_0">';
                    $rezultat .= '<thead>';
                        $rezultat .= '<tr>';
                            $rezultat .= '<th class="col-md-1">ID</th>';
                            $rezultat .= '<th class="col-md-3">Numer</th>';
                            $rezultat .= '<th class="col-md-4">Imię</th>';
                            $rezultat .= '<th class="col-md-4">Nazwisko</th>';
                            $rezultat .= '<th class="">';
                                if($this->sprawdzUprawnienie('szkolenia_uczestnicy_dodaj')){
                                    $rezultat .= '<i class="fa fa-plus-square float_r DodajUczesnitkaOkno" data-tabela="szkolenia" data-akcja="wyswietl_dodaj_uczestnika" data-element_id="'.$kszkolenie_id.'" aria-hidden="true"></i>';
                                }
                            $rezultat .= '</th>';
                        $rezultat .= '</tr>';
                    $rezultat .= '</thead>';
                    $rezultat .= '<tbody>';
                        if(!is_null($lista_uczestnikow)) {
                            while ($poj_lista_uczestnikow = $lista_uczestnikow->fetch_object()) {
                                $uczestnik = $kdb->pobierzDane('login, imie, nazwisko', 'uzytkownik', 'id = ' . $poj_lista_uczestnikow->uzytkownik_id);
                                $uczestnik = $uczestnik->fetch_object();
                                $rezultat .= '<tr>';
                                    $rezultat .= '<td class="col-md-1">' . $poj_lista_uczestnikow->uzytkownik_id . '</td>';
                                    $rezultat .= '<td class="col-md-3">' . $uczestnik->login . '</td>';
                                    $rezultat .= '<td class="col-md-4">' . $uczestnik->imie . '</td>';
                                    $rezultat .= '<td class="col-md-4">' . $uczestnik->nazwisko . '</td>';
                                    $rezultat .= '<td class="">';
                                        if($this->sprawdzUprawnienie('szkolenia_uczestnicy_usun')){
                                            $rezultat .= '<i class="float_r fa fa-trash" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?"  data-content="<button data-akcja=\'usun_ze_szkolenia\' data-szkolenia_id=\'' . $kszkolenie_id . '\' data-uzytkownik_id=\'' . $poj_lista_uczestnikow->uzytkownik_id . '\' data-tabela=\'szkolenia_id_uzytkownik_id\' type=\'button\' class=\'btn btn-danger zapiszUsunDoSzkolenia usunTak margin_t_0\'>TAK</button>"></i>';
                                        }
                                    $rezultat .= '</td>';
                                $rezultat .= '</tr>';
                            }
                        }
                    $rezultat .= '</tbody>';
                $rezultat .= '</table>';


            }else{
                if(!is_null($lista_uczestnikow)) {
                    while ($poj_lista_uczestnikow = $lista_uczestnikow->fetch_object()) {
                        $uczestnik = $kdb->pobierzDane('imie, nazwisko', 'uzytkownik', 'id = ' . $poj_lista_uczestnikow->uzytkownik_id);
                        $uczestnik = $uczestnik->fetch_object();

                        $rezultat .= '<div class="szkoleniePojedynczyUczestnik col-md-4">' . $uczestnik->imie . ' ' . $uczestnik->nazwisko . '</div>';
                    }
                }else{
                    $rezultat .= 'Brak zapisanych uczestników...';
                }
            }


        return $rezultat;

    }

    public function generujListeKonczacychSzkolen($kdb){
        $rezultat = '';

        $lista = $kdb->pobierzDane('*', 'szkolenia', 'szkolenia_slownik_status_id = 1 AND szkolenia_slownik_rodzaj_id = 1 AND data_stop between NOW() AND date_add(NOW(),interval 7 DAY)');

        if(!is_null($lista)){
            $rezultat .= '<ul class="listaKonczacychSieSzkolen list-group margin_b_0">';
                $liczba_dostepnych_miejsc = 1;
                while($poj_lista = $lista->fetch_object()){
                    if($poj_lista->liczba_miejsc != 0){
                        $liczba_zapisanych = $kdb->pobierzDane('uzytkownik_id', 'szkolenia_id_uzytkownik_id', 'szkolenia_id = '.$poj_lista->id);
                        $liczba_dostepnych_miejsc = ($poj_lista->liczba_miejsc)-mysqli_num_rows($liczba_zapisanych);
                    }
                    if($liczba_dostepnych_miejsc != 0){
                        $rezultat .= '<li class="list-group-item  " data-akcja="wyswietl_szkolenie" data-tabela="szkolenia" data-element_id="'.$poj_lista->id.'">';
                            $rezultat .= '<div class="wyswietl_szkolenie cursor_p">';
                                $rezultat .= $this->utnijSlowa($poj_lista->nazwa, (($poj_lista->liczba_miejsc == 0) ? 5 : 6 ), ' [...]');
                                $rezultat .= '<span class="badge float_r">'.(($poj_lista->liczba_miejsc == 0) ? 'Brak ograniczeń' : $liczba_dostepnych_miejsc.'/'.$poj_lista->liczba_miejsc ).'</span>';
                                $rezultat .= '<div class="clear_b"></div>';
                            $rezultat .= '</div>';
                        $rezultat .= '</li>';
                    }
                }
            $rezultat .= '</ul>';
        }else{
            $rezultat .= 'Brak danych...';
        }

        return $rezultat;
    }

}

