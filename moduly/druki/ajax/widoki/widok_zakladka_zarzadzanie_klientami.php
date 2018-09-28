<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$zarzadzanieKlientami = new ZarzadzanieKlientami();

$lista_moich_klientow = $bazaDanych->pobierzDane('Id, Imie, Nazwisko, Pesel, KontaktId','umowaOsoba','OsobaTypId = 1 AND PrzedstawicielId = '.$_SESSION['uzytkownik_id']);
$zarzadzanieKlientami->generujListeKlientow($lista_moich_klientow, $bazaDanych, 'Lista Klientów');

if($zarzadzanieKlientami->sprawdzUprawnienie('druki_lista_wszystkich_klientow')){
    $lista_wszystkich_klientow = $bazaDanych->pobierzDane('Id, Imie, Nazwisko, Pesel, KontaktId','umowaOsoba','OsobaTypId = 1 AND PrzedstawicielId != '.$_SESSION['uzytkownik_id']);
    $zarzadzanieKlientami->generujListeKlientow($lista_wszystkich_klientow, $bazaDanych, 'Lista Wszystkich klientów');
}
