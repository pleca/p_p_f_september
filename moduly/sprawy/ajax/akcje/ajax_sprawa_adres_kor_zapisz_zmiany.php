<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$adres_kor_id = htmlspecialchars($_POST['adres_kor_id']);
$zleceniodawca_ulica_kor = htmlspecialchars($_POST['zleceniodawca_ulica_kor']);
$zleceniodawca_nr_domu_kor = htmlspecialchars($_POST['zleceniodawca_nr_domu_kor']);
$zleceniodawca_nr_mieszkania_kor = htmlspecialchars($_POST['zleceniodawca_nr_mieszkania_kor']);
$zleceniodawca_kod_pocztowy_kor = htmlspecialchars($_POST['zleceniodawca_kod_pocztowy_kor']);
$zleceniodawca_miejscowosc_kor = htmlspecialchars($_POST['zleceniodawca_miejscowosc_kor']);

sprawa_adres_kor_zapisz_zmiany(
		$adres_kor_id
		,$zleceniodawca_ulica_kor
		,$zleceniodawca_nr_domu_kor
		,$zleceniodawca_nr_mieszkania_kor
		,$zleceniodawca_kod_pocztowy_kor
		,$zleceniodawca_miejscowosc_kor
		);

echo $adres_kor_id;