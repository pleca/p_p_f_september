<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class ZarzadzanieUzytkownikami extends AdministracjaMain {
    public function generujListeUzytkownikow($kgrupaId, $kgrupaNazwa, $kb, $kstatus, $ki, $kuzytkownik_grupy_id){
        $lista_uzytkownikow = $kb->pobierzDane('id, imie, nazwisko, login, avatar_link, data_dodania','uzytkownik','uzytkownik_grupa_id = '.$kgrupaId.' AND status = '.$kstatus.(($kuzytkownik_grupy_id === '1') ? '' : ' AND uzytkownik_grupa_id != 1' ));
        if(!is_null($lista_uzytkownikow)){
            echo '<div id="poj_panel_'.$ki.'" class="panel panel-default pojGrupaUzytkownikow margin_b_10">';
                echo '<div class="panel-heading cursor_p rozwinZwinPanel">'.mb_ucfirst($kgrupaNazwa).'</div>';
                echo '<div class="panel-body ukryj_widok ">';
                    echo '<table class="table table-striped tabela_lista_uzytkownikow">';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th class="col-md-1">ID</th>';
                                echo '<th class="col-md-3">Login</th>';
                                echo '<th class="col-md-3">Imie</th>';
                                echo '<th class="col-md-3">Nazwisko</th>';
                                echo '<th class="col-md-2">Data dodania</th>';
                                echo '<th class=""></th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                            while($poj_lista_uzytkownikow = $lista_uzytkownikow->fetch_object()){
                                $this->generujUzytkownikaLista($poj_lista_uzytkownikow->id, $poj_lista_uzytkownikow->imie,
                                    $poj_lista_uzytkownikow->nazwisko, $poj_lista_uzytkownikow->login, $poj_lista_uzytkownikow->avatar_link
                                    , $poj_lista_uzytkownikow->data_dodania);
                            }
                        echo '</tbody>';
                    echo '</table>';
                echo '</div>';
            echo '</div>';
        }
    }

    public function generujUzytkownikaLista($kid, $kimie, $knazwisko, $klogin, $kavatar, $kdata_dodania){
        echo '<tr>';
            echo '<td class="col-md-1 edytujUzytkownika cursor_p" data-element_id="'.$kid.'" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika">'.$kid.'</td>';
            echo '<td class="col-md-3 edytujUzytkownika cursor_p" data-element_id="'.$kid.'" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika"><span class="tabelka_avatar"><img src="/img/avatar/'.$kavatar.'"/></span>'.$klogin.'</td>';
            echo '<td class="col-md-3 edytujUzytkownika cursor_p" data-element_id="'.$kid.'" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika">'.$kimie.'</td>';
            echo '<td class="col-md-3 edytujUzytkownika cursor_p" data-element_id="'.$kid.'" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika">'.$knazwisko.'</td>';
            echo '<td class="col-md-2 edytujUzytkownika cursor_p" data-element_id="'.$kid.'" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika">'.$kdata_dodania.'</td>';
            echo '<td class="">';
                if(parent::sprawdzUprawnienie('administracja_edytuj_uzytkownika')) {
                    echo '<i class="fa fa-pencil edytujUzytkownika" data-element_id="' . $kid . '" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika" aria-hidden="true"></i>';
                }
                if(parent::sprawdzUprawnienie('administracja_uzytkownik_historia')) {
                    echo '<i class="fa fa-calendar historiaWyswietl" data-element_id="' . $kid . '" data-tabela="uzytkownik_historia_zmian" aria-hidden="true"></i>';
                }
            echo '</td>';
        echo '</tr>';
    }

    public function generujListeUprawnienUzytkownika($kbd, $kuzytkownikId){
        $rezultat = '';
        $uprawnienia_grupy = $kbd->pobierzDane('id, nazwa_grupy', 'uprawnienia_grupy', 'czy_usuniety = 0', 'nazwa_grupy ASC');

        while($poj_uprawnienia_grupy = $uprawnienia_grupy->fetch_object()){
            $lista_uprawnien_grupy = $kbd->pobierzDane('id, nazwa_uprawnienia', 'uprawnienia', 'id_grupy = '.$poj_uprawnienia_grupy->id.' AND czy_usuniety = 0', 'nr_kolejnosci ASC');
            $rezultat .= '<div class="panel panel-default uzytkownikGrupaUprawnien margin_b_10">';
            $uprawnione = 0;
            while($poj_lista_uprawnien_grupy = $lista_uprawnien_grupy->fetch_object()) {
                $przyznane = $kbd->pobierzDane('id_uzytkownika', 'uzytkownik_uprawnienie', 'id_uzytkownika = ' . $kuzytkownikId . ' AND id_uprawnienia = ' . $poj_lista_uprawnien_grupy->id);
                if (mysqli_num_rows($przyznane) != 0) {
                    $zaznaczone = true;
                    $uprawnione +=1;
                } else {
                    $zaznaczone = false;
                }
            }
                $rezultat .= '<div class="panel-heading cursor_p">'.$poj_uprawnienia_grupy->nazwa_grupy.'<span class="badge float_r">'.$uprawnione.' / '.mysqli_num_rows($lista_uprawnien_grupy).'</span></div>';
                $rezultat .= '<div class="panel-body ukryj_widok">';
                    //$rezultat .= '<button type="button" class="btn btn-success width_100 margin_b_10">Nadaj uprawnienia</button>';
                    $rezultat .= '<ul class="list-group">';
                    $lista_uprawnien_grupy = $kbd->pobierzDane('id, nazwa_uprawnienia', 'uprawnienia', 'id_grupy = '.$poj_uprawnienia_grupy->id.' AND czy_usuniety = 0', 'nr_kolejnosci ASC');
                        while($poj_lista_uprawnien_grupy = $lista_uprawnien_grupy->fetch_object()){
                            $przyznane = $kbd->pobierzDane('id_uzytkownika', 'uzytkownik_uprawnienie', 'id_uzytkownika = '.$kuzytkownikId.' AND id_uprawnienia = '.$poj_lista_uprawnien_grupy->id);
                            if(mysqli_num_rows($przyznane) != 0){
                                $zaznaczone = true;
                            }else{
                                $zaznaczone = false;
                            }
                            $rezultat .= '<li class="list-group-item">'.$poj_lista_uprawnien_grupy->nazwa_uprawnienia;
                                $rezultat .= '<i class="fa usunDodajUprawnienieUzytkownika float_r fa'.(($zaznaczone) ? '-check' : '' ).'-square-o '.(($zaznaczone) ? 'zaznaczone' : '' ).'" aria-hidden="true" data-element_id="'.$kuzytkownikId.'-'.$poj_lista_uprawnien_grupy->id.'"></i>';
                            $rezultat .= '</li>';
                        }
                    $rezultat .= '</ul>';
                $rezultat .= '</div>';
            $rezultat .= '</div>';
        }

        return $rezultat;
    }
}