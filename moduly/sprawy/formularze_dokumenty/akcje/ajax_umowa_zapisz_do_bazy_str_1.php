<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$typ_szkody = htmlspecialchars($_POST['typ_szkody']);
$rodzaj_wypadku = htmlspecialchars($_POST['rodzaj_wypadku']);
$inny_wypadek = htmlspecialchars($_POST['inny_wypadek']);
$inny_rodzaj_wypadku = htmlspecialchars($_POST['inny_rodzaj_wypadku']);
$uzytkownik = $_SESSION['uzytkownik_id'];

$dodaj_sprawe = sprawa_dodaj_sprawe($uzytkownik); 
$dodaj_sprawe = mysqli_fetch_assoc ( $dodaj_sprawe );

$id_sprawy = $dodaj_sprawe['sprawa_id'];
$dodaj_typ_rodzaj = uzupelnij_typ_rodzaj($typ_szkody, $rodzaj_wypadku, $id_sprawy);
$dodaj_typ_rodzaj = mysqli_fetch_assoc ( $dodaj_typ_rodzaj );


$aktualizuj_sprawe_podrodzaj_id = sprawa_aktualizacja ('sprawa_podrodzaj_wypadku_id', $inny_wypadek, $id_sprawy); 
$aktualizuj_sprawe_podrodzaj_id = mysqli_fetch_assoc ( $aktualizuj_sprawe_podrodzaj_id );

$aktualizuj_sprawe_podrodzaj = sprawa_aktualizacja ('sprawa_podrodzaj_wypadku_tekst', $inny_rodzaj_wypadku, $id_sprawy); 
$aktualizuj_sprawe_podrodzaj = mysqli_fetch_assoc ( $aktualizuj_sprawe_podrodzaj );


$dane = array(
		0 => $id_sprawy,
        1 => $inny_rodzaj_wypadku
);

 
echo json_encode($dane);
