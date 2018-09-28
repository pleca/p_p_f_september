<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '';

$zarzadzanieUzytkownikami = new ZarzadzanieUzytkownikami();
$zarzadzanieGrupami = new ZarzadzanieGrupami();
$bazaDanych = new main_BazaDanych();

$tytul = '';
$tresc = '';

switch ($akcja) {
    case 'historia_wyswietl':
            $id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : '';
            $tytul = 'Historia elementu';

            if($tabela == 'uzytkownik_historia_zmian'){
                $kolumna = 'uzytkownik_id';
            }

            if($tabela == 'powiadomienia_historia_zmian'){
                $kolumna = 'powiadomienia_id';
            }

            if($tabela == 'uzytkownik_grupy_historia_zmian'){
                $kolumna = 'uzytkownik_grupy_id';
            }



            $tresc = $zarzadzanieUzytkownikami->generujZakladkeHistoria($tabela, $kolumna, $bazaDanych, $id);
        break;

    case 'edytuj_uzytkownika':

            $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko, login, status, data_dodania, data_zmiana_hasla, ostatnia_aktywna_sesja, 
            data_linku_aktywacyjnego, proby_logowania, data_blokada_tymczasowa, tymczasowa_blokada, avatar_link, email, 
            haslo_sms, telefon_kom, uzytkownik_grupa_id, sesja_przejmujacego, liczba_kontrolna', 'uzytkownik', 'id = '.$element_id);

            $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();

            $tresc = $zarzadzanieUzytkownikami->wczytajWidok('/var/www/html/moduly/administracja_systemem/ajax/widoki/elementy/widok_edytuj_uzytkownika.php',array(
                'uzytkownikDane' => $uzytkownik_tmp
                ,'elementId' => $element_id
            ));



        break;

    case 'edytuj_powiadomienie':
            $powiadomienie_tmp = $bazaDanych->pobierzDane('*', 'powiadomienia', 'id = '.$element_id);
            $powiadomienie_tmp = $powiadomienie_tmp->fetch_object();

            $dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;
            $tresc = $zarzadzanieUzytkownikami->wczytajWidok('/var/www/html/moduly/administracja_systemem/ajax/widoki/elementy/widok_edytuj_powiadomienie.php',array(
                'powiadomienie_dane' => $powiadomienie_tmp
            ));

        break;

    case 'edytuj_uzytkownik_grupy':
            $uzytkownik_grupa_tmp = $bazaDanych->pobierzDane('id, nazwa, czy_domyslna, czy_usuniety', 'uzytkownik_grupy', 'id = '.$element_id);
            $uzytkownik_grupa_tmp = $uzytkownik_grupa_tmp->fetch_object();

            $tresc .= '<div class="uzytkownikGrupaSzczegoly">';
                $tresc .='<div class="well well-sm margin_b_10">';
                    $tresc .='<i class="fa '.(($uzytkownik_grupa_tmp->czy_usuniety == '0') ? 'fa-trash' : 'fa-undo' ).'  margin_r_10" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-tabela=\'uzytkownik_grupy\' data-reakcja=\''.(($uzytkownik_grupa_tmp->czy_usuniety == '0') ? 'usun' : 'przywroc' ).'\' data-element_id=\''.$element_id.'\' type=\'button\' class=\'btn btn-danger usunTak usunPrzywrocElement\'>TAK</button>"></i>';
                    $tresc .= $uzytkownik_grupa_tmp->nazwa;
                    $tresc .= '<i style="padding:4px;" class="float_r fa fa'.(($uzytkownik_grupa_tmp->czy_domyslna == 1) ? '-check' : '').'-square-o '.(($uzytkownik_grupa_tmp->czy_domyslna == 1) ? 'zaznaczone' : '').' powiadomienieAktywne attrValue update wymagane" aria-hidden="true" data-kolumna="czy_domyslna" data-wartosc_domyslna="'.$uzytkownik_grupa_tmp->czy_domyslna.'" value="'.$uzytkownik_grupa_tmp->czy_domyslna.'" ></i>';

                $tresc .='</div>';

                $tresc .= '<input class="update wymagane width_100" type="text" data-kolumna="nazwa" data-wartosc_domyslna="'.$uzytkownik_grupa_tmp->nazwa.'" value="'.$uzytkownik_grupa_tmp->nazwa.'" placeholder="Nazwa"/>';

                $tresc .= '<button type="button" data-akcja="aktualizuj_uzytkownik_grupy" data-element_id="'.$element_id.'" data-klasa_rodzic="uzytkownikGrupaSzczegoly" data-tabela="uzytkownik_grupy" class="margin_t_0 margin_b_10 btn btn-success zapiszZmianyAdministracja width_100">Zapisz zmiany</button>';

                $tresc .= '<div class="uprawnienia_col kolumna_1 grupyUzytkownika">' . $zarzadzanieGrupami->generujListeUprawnienGrupy($bazaDanych, $element_id) . '</div>';
                $tresc .= '<div class="uprawnienia_col kolumna_2 grupyUzytkownika"></div>';
                $tresc .= '<div class="clear_b"></div>';


            $tresc .= '</div>';
        break;

    case 'edytuj_uprawnienie_grupa':
            $tresc = $zarzadzanieUzytkownikami->wczytajWidok('/var/www/html/moduly/administracja_systemem/ajax/widoki/elementy/widok_edytuj_uprawnienie_grupa.php',array(
                'elementId' => $element_id
            ));
        break;

    case 'wyswietl_tabele_historia_rejestracji':
            $dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;
            $tresc = $zarzadzanieUzytkownikami->wczytajWidok('/var/www/html/moduly/administracja_systemem/ajax/widoki/elementy/widok_tabelka_historia_rejestracji.php',array(
                'listaParametrow' => $dane
            ));
        break;

    case 'wyswietl_tabele_lista_uzytkownikow_filtruj':
            $dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;
            $tresc = $zarzadzanieUzytkownikami->wczytajWidok('/var/www/html/moduly/administracja_systemem/ajax/widoki/elementy/widok_tabela_lista_uzytkownikow_filtruj.php',array(
                'listaParametrow' => $dane
            ));
        break;

    case 'wyswietl_tabele_historia_logowan_filtruj':
            $dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;
            $tresc = $zarzadzanieUzytkownikami->wczytajWidok('/var/www/html/moduly/administracja_systemem/ajax/widoki/elementy/widok_tabela_historia_logowan.php',array(
                'listaParametrow' => $dane
            ));
        break;

    case 'wyswietl_edytuj_uprawnienie_grupy':
            if(isset($_POST['id'])){
                $element_id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : '';
            }

            $uprawnienie_tmp = $bazaDanych->pobierzDane('*','uprawnienia','id = '.$element_id);
            $uprawnienie_tmp = $uprawnienie_tmp->fetch_object();

            $tytul = $uprawnienie_tmp->nazwa_uprawnienia;
            $tresc = $zarzadzanieUzytkownikami->wczytajWidok('/var/www/html/moduly/administracja_systemem/ajax/widoki/elementy/widok_edytuj_pojedyncze_uprawnienie.php',array(
                'uprawnienieDane' => $uprawnienie_tmp
            ));
        break;

    default:
        $tresc = 'Wystąpił błąd!!! Brak Akcji do wykonania!!!';

}

$dane = array(
            'tytul' => $tytul
            ,'tresc' => $tresc
            ,'miniatura' => ''
);

echo json_encode($dane);
return;