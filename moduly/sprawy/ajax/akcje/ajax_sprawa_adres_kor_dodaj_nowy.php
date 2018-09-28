<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$klient_id = htmlspecialchars($_POST['klient_id']);
$zleceniodawca_ulica_kor = htmlspecialchars($_POST['zleceniodawca_ulica_kor']);
$zleceniodawca_nr_domu_kor = htmlspecialchars($_POST['zleceniodawca_nr_domu_kor']);
$zleceniodawca_nr_mieszkania_kor = htmlspecialchars($_POST['zleceniodawca_nr_mieszkania_kor']);
$zleceniodawca_kod_pocztowy_kor = htmlspecialchars($_POST['zleceniodawca_kod_pocztowy_kor']);
$zleceniodawca_miejscowosc_kor = htmlspecialchars($_POST['zleceniodawca_miejscowosc_kor']);

$adres_kor_id = sprawa_adres_kor_dodaj_nowy(
		$zleceniodawca_ulica_kor
		, $zleceniodawca_nr_domu_kor
		, $zleceniodawca_nr_mieszkania_kor
		, $zleceniodawca_kod_pocztowy_kor
		, $zleceniodawca_miejscowosc_kor
);

sprawa_kratka_zapisz_zmiane('sprawa_osoba', $klient_id, 'sprawa_adres_korespondencja_id', $adres_kor_id['adres_id']);

echo $adres_kor_id['adres_id'];
