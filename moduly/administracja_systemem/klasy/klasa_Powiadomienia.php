<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class Powiadomienia extends AdministracjaMain {
    public function generujListePowiadomien($kid, $knazwa, $kbd, $kczy_usuniety, $ki){
        $rezultat = '';
        $rezultat .= '<div id="poj_powiadomienie_'.$ki.'" class="panel panel-default margin_b_10">';
            $rezultat .= '<div class="panel-heading cursor_p rozwinZwinPanel">'.mb_ucfirst($knazwa).'</div>';
            $rezultat .= '<div class="panel-body ukryj_widok">';
                $rezultat .= '<table class="table table-striped tabela_lista_uzytkownikow">';
                    $rezultat .= '<thead>';
                        $rezultat .= '<tr>';
                            $rezultat .= '<th class="col-md-1">ID</th>';
                            $rezultat .= '<th class="col-md-6">Nazwa</th>';
                            $rezultat .= '<th class="col-md-4">Autor</th>';
                            $rezultat .= '<th class="col-md-1">Aktywne</th>';
                            $rezultat .= '<th class=""></th>';
                        $rezultat .= '</tr>';
                    $rezultat .= '</thead>';
                    $rezultat .= '<tbody>';
                        $lista_powiadomien = $kbd->pobierzDane('id, nazwa, uzytkownik_id, czy_aktywny', 'powiadomienia', 'powiadomienia_rodzaj_id = '.$kid.' AND czy_usuniety = '.$kczy_usuniety);
                        if(!is_null($lista_powiadomien)){
                            while($poj_lista_powiadomien = $lista_powiadomien->fetch_object()){
                                $edytuj = false;
                                if($this->sprawdzUprawnienie('administracja_powiadomienia_edytuj_wszystkie')){
                                    $edytuj = true;
                                }else{
                                    if($this->sprawdzUprawnienie('administracja_powiadomienia_edytuj')){
                                        if($poj_lista_powiadomien->uzytkownik_id == $_SESSION['uzytkownik_id']) {
                                            $edytuj = true;
                                        }
                                    }
                                }

                                $rezultat .= '<tr data-element_id="'.$poj_lista_powiadomien->id.'" data-tabela="powiadomienia" data-akcja="edytuj_powiadomienie" >';
                                    $rezultat .= '<td class="col-md-1 '.(($edytuj) ? 'edytujPowiadomienie' : '').' cursor_p">'.$poj_lista_powiadomien->id.'</td>';
                                    $rezultat .= '<td class="col-md-6 '.(($edytuj) ? 'edytujPowiadomienie' : '').' cursor_p">'.$poj_lista_powiadomien->nazwa.'</td>';
                                    $uzytkownik_tmp = $kbd->pobierzDane('imie, nazwisko', 'uzytkownik', 'id = '.$poj_lista_powiadomien->uzytkownik_id);
                                    $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();
                                    $rezultat .= '<td class="col-md-4 '.(($edytuj) ? 'edytujPowiadomienie' : '').' cursor_p">'.$uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko.'</td>';
                                    $rezultat .= '<td class="col-md-1 '.(($edytuj) ? 'edytujPowiadomienie' : '').' cursor_p">';
                                        $rezultat .= ($poj_lista_powiadomien->czy_aktywny == 1) ? '<i class="fa fa-check text_center" aria-hidden="true"></i>' : '' ;
                                    $rezultat .= '</td>';
                                    $rezultat .= '<td class="" data-element_id="'.$poj_lista_powiadomien->id.'" data-tabela="powiadomienia" data-akcja="edytuj_powiadomienie" >';

                                        if($edytuj){
                                            $rezultat .= '<i class="fa fa-pencil '.(($edytuj) ? 'edytujPowiadomienie' : '').' margin_r_5" aria-hidden="true"></i>';
                                        }
                                        if($this->sprawdzUprawnienie('administracja_powiadomenia_historia')) {
                                            $rezultat .= '<i class="fa fa-calendar historiaWyswietl" data-element_id="' . $poj_lista_powiadomien->id . '" data-tabela="powiadomienia_historia_zmian" aria-hidden="true"></i>';
                                        }
                                    $rezultat .= '</td>';
                                $rezultat .= '</tr>';
                            }
                        }

                    $rezultat .= '</tbody>';
                $rezultat .= '</table>';
            $rezultat .= '</div>';
        $rezultat .= '</div>';

        return $rezultat;
    }
}