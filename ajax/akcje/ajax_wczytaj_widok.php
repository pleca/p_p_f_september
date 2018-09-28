<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';

$tytul = null;
$tresc = null;

$panelPrzedstawiciela = new main_PanelPrzedstawiciela();

switch ($akcja) {
    case 'wyswietl_panel_uzytkownika':
            $tytul = 'Panel użytkownika';
            $uzytkownikDane = $bazaDanych->pobierzDane('id, imie, nazwisko, email, avatar_link, telefon_kom','uzytkownik','id = '.$_SESSION['uzytkownik_id']);
            $tresc = $panelPrzedstawiciela->wczytajWidok('/var/www/html/ajax/widoki/elementy/widok_panel_uzytkownika.php',array(
                'uzytkownikDane' => $uzytkownikDane->fetch_object()
            ));
        break;

    case 'wyswietl_lisznik_okno_60_sekund':
            $tresc = $panelPrzedstawiciela->wczytajZawartoscPliku('https://' . $_SERVER ['HTTP_HOST'] . '/ajax/widoki/widok_licznik_sesji_60_sekund');
            $tytul = 'UWAGA!!!';
        break;

    case 'wyswietl_dodaj_usun_uprawnienie_uzytkownika':
            $tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '';
            $kolumna = (isset($_POST['kolumna'])) ? htmlspecialchars($_POST['kolumna']) : '';
            $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
            $widok_edycja= (isset($_POST['widok_edycja'])) ? htmlspecialchars($_POST['widok_edycja']) : '';
            $szczegoly_elementu= (isset($_POST['szczegoly_elementu'])) ? htmlspecialchars($_POST['szczegoly_elementu']) : '';

            $tresc = $panelPrzedstawiciela->wczytajWidok('/var/www/html/ajax/widoki/elementy/widok_dodaj_uprawnienie_uzytkownik.php',array(
                'tabela' => $tabela
                ,'kolumna' => $kolumna
                ,'element_id' => $element_id
                ,'widok_edycja' =>$widok_edycja
                ,'szczegoly_elementu' => $szczegoly_elementu
            ));
            $tytul = 'Dodaj uprawnienie';
        break;
}

$arrayOut = array(
    'tytul' => $tytul
    ,'tresc' => $tresc
);

echo json_encode($arrayOut);
return;