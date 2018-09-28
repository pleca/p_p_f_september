<?php
session_start();

if(!isset($_SESSION['zalogowany']) || !isset($_SESSION['uzytkownik_id'])
    || !isset($_SESSION['uzytkownik_imie']) || !isset($_SESSION['uzytkownik_nazwisko'])){

    $arrayOut = array(
        'wyloguj' => true
        ,'komunikat' => 'Nastapiło automatyczne wylogowanie.'
    );

    echo json_encode($arrayOut);
    return;
}

require_once($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

$sesjaNaBazie = $bazaDanych->pobierzDane('ostatnia_aktywna_sesja, sesja_przejmujacego','uzytkownik','id = '.$_SESSION['uzytkownik_id']);
$sesjaNaBazie = $sesjaNaBazie->fetch_object();



$aktualnaSesja = session_id();

$wyloguj = false;
$komunikat = null;

if(($sesjaNaBazie->ostatnia_aktywna_sesja !== $aktualnaSesja ) && ($sesjaNaBazie->sesja_przejmujacego !== $aktualnaSesja) ){
    $wyloguj = true;
    $komunikat = 'Nastapiło automatyczne wylogowanie.';
    if($sesjaNaBazie->ostatnia_aktywna_sesja !== $aktualnaSesja && $sesjaNaBazie->ostatnia_aktywna_sesja !== 0){
        $komunikat = 'Zalogowano na innym urządzeniu.';
    }
}


$arrayOut = array(
    'wyloguj' => $wyloguj
    ,'komunikat' => $komunikat
);

echo json_encode($arrayOut);
return;