<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');


class SzkoleniaLista extends SzkoleniaMain{

    public function generujListeSzkolen($kpoj_lista_typow_szkolen,$poj_lista_typow_szkolen_wartosc, $kbd, $krodzaj_szkolenia, $teren = false){
        $lista_szkolen = $kbd->pobierzDane('*', 'szkolenia', 'czy_usuniety = 0 AND (szkolenia_slownik_rodzaj_id = '.$krodzaj_szkolenia.(($teren) ? ' OR szkolenia_slownik_rodzaj_id = 3 ' : '').') AND szkolenia_slownik_status_id = '.$kpoj_lista_typow_szkolen);

        if(mysqli_num_rows($lista_szkolen) != 0){
            echo '<div class="panel panel-default margin_b_10">';
                echo '<div class="panel-heading">'.mb_ucfirst($poj_lista_typow_szkolen_wartosc).'</div>';
                echo '<div class="panel-body">';
                if(!is_null($lista_szkolen)){
                    $i = 0;
                    echo '<table class="table table-striped tabela_lista_szkolen">';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th class="">ID</th>';
                                echo '<th class="col-md-5">Nazwa</th>';
                                //echo '<th class="col-md-4">Krótki opis</th>';
                                echo '<th class="col-md-1">Rozpoczęcie</th>';
                                echo '<th class="col-md-1">Zakończenie</th>';
                                echo '<th class="col-md-3">Miejscowość</th>';
                                echo '<th class="col-md-2">Liczba miejsc</th>';
                                echo '<th class=""></th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($poj_lista_szkolen = $lista_szkolen->fetch_object()) {
                            $this->generujSzkolenieLista($poj_lista_szkolen->id, $poj_lista_szkolen->nazwa, $poj_lista_szkolen->opis, $poj_lista_szkolen->data_start, $poj_lista_szkolen->data_stop, $poj_lista_szkolen->szkolenia_slownik_status_id,  $kbd, $poj_lista_szkolen->liczba_miejsc, $poj_lista_szkolen->uzytkownik_id, $poj_lista_szkolen->miejscowosc);
                        }
                        echo '</tbody>';
                    echo '</table>';

                }else{
                    echo 'Brak szkoleń...';
                }
                echo '</div>';
            echo '</div>';
        }


    }

    public function generujSzkolenieLista($kid, $knazwa, $kopis, $kdata_start, $kdata_stop, $kszkolenia_slownik_status_id, $db, $kliczbamiejsc, $kuzytkownik_id, $miejscowosc){
        $zapisany = $db->pobierzDane('szkolenia_id', 'szkolenia_id_uzytkownik_id', 'uzytkownik_id = ' . $_SESSION['uzytkownik_id'] . ' AND szkolenia_id = ' . $kid);
        $liczba_zapisanych = $db->pobierzDane('uzytkownik_id', 'szkolenia_id_uzytkownik_id', 'szkolenia_id = '.$kid);

        echo '<tr class="'.((!is_null($zapisany)) ? 'zapisany' : '' ).'" data-akcja="wyswietl_szkolenie" data-tabela="szkolenia" data-element_id="'.$kid.'">';
            echo '<td class="wyswietl_szkolenie cursor_p">'.$kid.'</td>';
            echo '<td class="col-md-5 wyswietl_szkolenie cursor_p">'.$knazwa.'</td>';
            //echo '<td class="col-md-4 wyswietl_szkolenie cursor_p">'.parent::utnijSlowa(parent::usunTagiHTML($kopis), 20, ' [...]').'</td>';
            $data_start = explode(' ', $kdata_start);
                echo '<td class="col-md-1 wyswietl_szkolenie cursor_p">'.$data_start[0].'<br/>'.$data_start[1].'</td>';
            $data_stop = explode(' ', $kdata_stop);
                echo '<td class="col-md-1 wyswietl_szkolenie cursor_p">'.$data_stop[0].'<br/>'.$data_stop[1].'</td>';
                echo '<td class="col-md-2 wyswietl_szkolenie cursor_p">'.$miejscowosc.'</td>';
            //$szkolenia_slownik_wartosc = $db->pobierzDane('wartosc', 'szkolenia_slownik_status', 'czy_usuniety = 0 AND id = '.$kszkolenia_slownik_status_id);
            //$szkolenia_slownik_wartosc = $szkolenia_slownik_wartosc->fetch_object();
                echo '<td class="col-md-3 wyswietl_szkolenie cursor_p">'.(($kliczbamiejsc == 0) ? 'Brak ograniczeń' : ($kliczbamiejsc-mysqli_num_rows($liczba_zapisanych)).'/'.$kliczbamiejsc ).'</td>';
            echo '<td data-akcja="edytuj_szkolenie" class="">';
                if($this->sprawdzUprawnienie('szkolenia_edytuj') && !$this->sprawdzUprawnienie('szkolenia_edytuj_wszystkie')) {
                    if ($_SESSION['uzytkownik_id'] == $kuzytkownik_id) {
                        echo '<i class="float_l fa fa-pencil margin_r_5 edytuj_szkolenie" aria-hidden="true"></i>';
                    }
                }
                if($this->sprawdzUprawnienie('szkolenia_edytuj') && $this->sprawdzUprawnienie('szkolenia_edytuj_wszystkie')) {
                    echo '<i class="float_l fa fa-pencil margin_r_5 edytuj_szkolenie" aria-hidden="true"></i>';
                }
                if($this->sprawdzUprawnienie('szkolenia_historia')) {
                    echo '<i class="fa float_l fa-calendar historiaWyswietl" data-tabela="szkolenia_historia_zmian-szkolenia_id" data-element_id="' . $kid . '" aria-hidden="true"></i>';
                }
            echo '</td>';
        echo '</tr>';
	}



}