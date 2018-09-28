<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class ZarzadzanieGrupami extends AdministracjaMain{
    public function generujListeGrup($kid, $knazwa, $bazaDanych, $czy_usuniety, $ki, $kczy_domyslna){
        $rezultat = '';

        $rezultat .= '<div id="poj_panel_'.$ki.'" class="panel panel-default pojGrupaUzytkownikow margin_b_10">';
            $rezultat .= '<div class="panel-heading cursor_p edytujUzytkownikGrupy" data-element_id="'.$kid.'" data-tabela="uzytkownik_grupy" data-akcja="edytuj_uzytkownik_grupy">';
            $rezultat .= mb_ucfirst($knazwa);

                 if($kczy_domyslna == 1){
                    $rezultat .= '<i class="float_l fa fa-check margin_r_10" aria-hidden="true"></i>';
                }
            $rezultat .=' </div>';
            $rezultat .= '<i class="fa float_r fa-calendar listaGrupUzytkownikaa historiaWyswietl" data-element_id="' . $kid . '" data-tabela="uzytkownik_grupy_historia_zmian" aria-hidden="true"></i>';

        $rezultat .= '</div>';

        return $rezultat;

    }

    public function generujListeUprawnienGrupy($kbd, $kuzytkownikId){
        $rezultat = '';
        $uprawnienia_grupy = $kbd->pobierzDane('id, nazwa_grupy', 'uprawnienia_grupy', 'czy_usuniety = 0', 'nazwa_grupy ASC');

        while($poj_uprawnienia_grupy = $uprawnienia_grupy->fetch_object()){
            $lista_uprawnien_grupy = $kbd->pobierzDane('id, nazwa_uprawnienia', 'uprawnienia', 'id_grupy = '.$poj_uprawnienia_grupy->id.' AND czy_usuniety = 0', 'nr_kolejnosci ASC');

            $rezultat .= '<div id="uzytkownikUprawnienia" class="panel panel-default uzytkownikGrupaUprawnien margin_b_10">';
            $rezultat .= '<div class="panel-heading cursor_p">'.$poj_uprawnienia_grupy->nazwa_grupy.'<span class="badge float_r">'.mysqli_num_rows($lista_uprawnien_grupy).'</span></div>';
            $rezultat .= '<div class="panel-body ukryj_widok">';
            $rezultat .= '<ul class="list-group">';
            while($poj_lista_uprawnien_grupy = $lista_uprawnien_grupy->fetch_object()){
                $przyznane = $kbd->pobierzDane('uprawnienia_id', 'uzytkownik_grupy_uprawnienie', 'uzytkownik_grupy_id = '.$kuzytkownikId.' AND uprawnienia_id = '.$poj_lista_uprawnien_grupy->id);
                if(mysqli_num_rows($przyznane) != 0){
                    $zaznaczone = true;
                }else{
                    $zaznaczone = false;
                }
                $rezultat .= '<li class="list-group-item">'.$poj_lista_uprawnien_grupy->nazwa_uprawnienia.'<i class="fa usunDodajUprawnienieGrupy float_r fa'.(($zaznaczone) ? '-check' : '' ).'-square-o '.(($zaznaczone) ? 'zaznaczone' : '' ).'" aria-hidden="true" data-element_id="'.$kuzytkownikId.'-'.$poj_lista_uprawnien_grupy->id.'"></i></li>';
            }
            $rezultat .= '</ul>';
            $rezultat .= '</div>';
            $rezultat .= '</div>';
        }

        return $rezultat;
    }
}