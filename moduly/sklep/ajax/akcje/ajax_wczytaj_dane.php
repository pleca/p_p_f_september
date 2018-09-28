<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$element_id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : '';
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '';

$tytul = '';
$tresc = '';
$miniatura = '';

$sklepMain = new SklepMain($bazaDanych);

switch ($akcja) {
    case 'wyswietl_dodaj_produkt':
        $listaKategorii_tmp = $bazaDanych->pobierzDane('id, nazwa', 'sklep_kategorie', 'czy_usuniety = 0');
        $listaKategorii_array = array();

        while($kategoria = $listaKategorii_tmp->fetch_object()){
            $listaKategorii_array[$kategoria->id] = $kategoria->nazwa;
        }

        $tytul = 'Dodaj produkt';
        $tresc = $sklepMain->wczytajWidok('/var/www/html/moduly/sklep/ajax/widoki/elementy/widok_dodaj_produkt.php',array(
            'tabela' => $tabela
            ,'listaKategorii' => $listaKategorii_array
        ));
    break;

    case 'wyswietl_edytuj_produkt':
        $tytul = 'Edycja produktu';
        $tresc = $sklepMain->wczytajWidok('/var/www/html/moduly/sklep/ajax/widoki/elementy/widok_edytuj_produkt.php',array(
            'tabela' => $tabela
        ));
        break;
}

$arrayOut = array(
    'tytul' => $tytul
    ,'tresc' => $tresc
    ,'miniatura' => $miniatura
);

echo json_encode($arrayOut);
return;