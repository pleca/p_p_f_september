<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

    $akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '' ;

    $tytul = '';
    $tresc = '';

switch ($akcja) {
    case 'dodaj_uzytkownika':
            $tytul = 'Dodaj użytkownika';

        $tresc .='<div class="uzytkownikOgolnePopUp">';
            $tresc .= '<input data-kolumna="login" class="float_l width_50 update wymagane" type="text" value="" placeholder="Login"/>';
                $tresc .= '<div class="dropdown width_50 float_r">';
                    $tresc .= '<button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
                        $tresc .= '<div data-kolumna="uzytkownik_grupa_id" data-wartosc_domyslna="" value="2" class="dpUstawOpcjeNazwa attrValue update wymagane float_l">Użytkownicy</div>';
                        $tresc .= '<span class="caret"></span>';
                    $tresc .= '</button>';
                    $tresc .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                        $uzytkownik_grupa = $bazaDanych->pobierzDane('nazwa, id', 'uzytkownik_grupy', 'czy_usuniety = 0');
                        while($poj_uzytkownik_grupa = $uzytkownik_grupa->fetch_object()){
                            $tresc .= '<li class="dpUstawOpcje" data-element_id="'.$poj_uzytkownik_grupa->id.'">'.mb_ucfirst($poj_uzytkownik_grupa->nazwa).'</li>';
                        }
                    $tresc .= '</ul>';
                $tresc .= '</div>';
                $tresc .= '<div class="clear_b"></div>';
                $tresc .= '<input data-kolumna="imie" placeholder="Imię" class="update wymagane float_l width_50" type="text" data-wartosc_domyslna="" value=""/>';
                $tresc .= '<input data-kolumna="nazwisko" placeholder="Nazwisko" class="update wymagane float_r width_50" type="text" data-wartosc_domyslna="" value=""/>';
                $tresc .= '<div class="clear_b"></div>';
                $tresc .= '<input data-kolumna="email" placeholder="Email" class="update wymagane float_l width_50" type="text" data-wartosc_domyslna="" value=""/>';
                $tresc .= '<input data-kolumna="telefon_kom" placeholder="Telefon kom" class="update wymagane float_r width_50" type="text" data-wartosc_domyslna="" value=""/>';
                $tresc .= '<div class="clear_b"></div>';
                $tresc .= '<input data-kolumna="haslo" placeholder="Hasło" class="uzytkownikHaslo update float_l width_50" type="password" data-wartosc_domyslna="" value=""/>';
                $tresc .= '<input placeholder="Powtórz hasło" class="uzytkownikHasloPowtorz float_r width_50" type="password" data-wartosc_domyslna="" value=""/>';
                $tresc .= '<div class="clear_b"></div>';
                $tresc .= '<button type="button" data-akcja="dodaj_uzytkownika" data-klasa_rodzic="uzytkownikOgolnePopUp" data-tabela="uzytkownik" class="btn btn-success zapiszZmianyAdministracja width_100">Zapisz zmiany</button>';
            $tresc .= '</div>';

        break;

    case 'dodaj_powiadomienie':
            $tytul = 'Nowe powiadomienie';

            $tresc .= '<div class="powiadomienieDaneNowe">';

                $tresc .= '<input class="update wymagane" type="text" data-kolumna="nazwa" data-wartosc_domyslna="" value="" placeholder="Nazwa"/>';

                $tresc .= '<div class="dropdown width_50 float_l">';
                    $tresc .= '<input class="update wymagane ilosc_wyswietlen" disabled type="text" data-kolumna="ilosc_wyswietlen" data-wartosc_domyslna="" value="0" placeholder="Ile wyswietleń"/>';
                $tresc .='</div>';
                $tresc .= '<div class="dropdown width_50 float_r">';
                    $tresc .= '<button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
                    $tresc .= '<div data-kolumna="powiadomienia_rodzaj_id" data-wartosc_domyslna="" value="2" class="dpUstawOpcjeNazwa attrValue update wymagane float_l">Systemowe</div>';
                    $tresc .= '<span class="caret"></span>';
                    $tresc .= '</button>';
                    $tresc .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                        $powiadomienie_rodzaj = $bazaDanych->pobierzDane('nazwa, id', 'powiadomienia_rodzaj', 'czy_usuniety = 0');
                        while($poj_powiadomienie_rodzaj = $powiadomienie_rodzaj->fetch_object()){
                            $tresc .= '<li class="dpUstawOpcje dpuoPowiadomienie" data-element_id="'.$poj_powiadomienie_rodzaj->id.'">'.mb_ucfirst($poj_powiadomienie_rodzaj->nazwa).'</li>';
                        }
                    $tresc .= '</ul>';
                $tresc .= '</div>';

                $tresc .= '<div class="clear_b"></div>';

                $tresc .= '<div class="poZalogowaniu" style="display:none;"><i class="fa fa-square-o margin_b_10 powiadomieniePoZalogowaniu attrValue update" aria-hidden="true" data-kolumna="po_zalogowaniu" data-wartosc_domyslna="" value="" ></i>  Wyświetl powiadomienie jednorazowo tylko po zalogowaniu</div>';

                $tresc .= '<textarea class="update editor prm wymagane " data-kolumna="tresc" name="editor" data-wartosc_domyslna="" placeholder="Wprowadź tekst...">' . htmlspecialchars_decode($powiadomienie_tmp->tresc) . '</textarea>';

                        $tresc .= '<button type="button" data-akcja="dodaj_powiadomienie" data-klasa_rodzic="powiadomienieDaneNowe" data-tabela="powiadomienia" class="margin_t_10 margin_b_0 btn btn-success zapiszZmianyAdministracja width_100">Zapisz zmiany</button>';

                    $tresc .= '</div>';
        break;

    case 'dodaj_grupe_uzytkownika':
            $tytul = 'Nowa grupa użytkownika';

            $tresc .= '<div class="uzytkownikGrupaSzczegolyDodajNowy">';
                $tresc .= '<input class="update wymagane width_100" type="text" data-kolumna="nazwa" data-wartosc_domyslna="" value="" placeholder="Nazwa"/>';
                $tresc .= '<button type="button" data-akcja="dodaj_uzytkownik_grupy" data-klasa_rodzic="uzytkownikGrupaSzczegolyDodajNowy" data-tabela="uzytkownik_grupy" class="margin_t_0 margin_b_10 btn btn-success zapiszZmianyAdministracja width_100">Zapisz zmiany</button>';
            $tresc .= '</div>';
        break;

    default:
        $tresc = 'Wystąpił błąd!!! Skontaktuj się z administratorem systemu!!!';

}

$dane = array(
            'tytul' => $tytul
            ,'tresc' => $tresc
            ,'miniatura' => ''
);

echo json_encode($dane);
return;