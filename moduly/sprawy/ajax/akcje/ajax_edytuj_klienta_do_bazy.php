<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$zleceniodawca_id = htmlspecialchars($_POST['zleceniodawca_id']);
$zleceniodawca_imie = htmlspecialchars($_POST['zleceniodawca_imie']);
$zleceniodawca_nazwisko = htmlspecialchars($_POST['zleceniodawca_nazwisko']);
$zleceniodawca_ulica = htmlspecialchars($_POST['zleceniodawca_ulica']);
$zleceniodawca_nr_domu = htmlspecialchars($_POST['zleceniodawca_nr_domu']);
$zleceniodawca_nr_mieszkania = htmlspecialchars($_POST['zleceniodawca_nr_mieszkania']);
$zleceniodawca_kod_pocztowy = htmlspecialchars($_POST['zleceniodawca_kod_pocztowy']);
$zleceniodawca_miejscowosc = htmlspecialchars($_POST['zleceniodawca_miejscowosc']);
$zleceniodawca_dokument = htmlspecialchars($_POST['zleceniodawca_dokument']);
$zleceniodawca_numer_dokumentu = htmlspecialchars($_POST['zleceniodawca_numer_dokumentu']);
$zleceniodawca_pesel = htmlspecialchars($_POST['zleceniodawca_pesel']);
$zleceniodawca_seria_i_numer_dowodu = strtoupper(htmlspecialchars($_POST['zleceniodawca_seria_i_numer_dowodu']));
$zleceniodawca_czy_obcokrajowiec = htmlspecialchars($_POST['zleceniodawca_czy_obcokrajowiec']);

$zleceniodawca_email = htmlspecialchars($_POST['zleceniodawca_email']);
$zleceniodawca_telefon = htmlspecialchars($_POST['zleceniodawca_telefon']);

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

sprawa_klient_zapisz_zmiany($zleceniodawca_id, $zleceniodawca_imie, $zleceniodawca_nazwisko, $zleceniodawca_ulica, $zleceniodawca_nr_domu,
		$zleceniodawca_nr_mieszkania, $zleceniodawca_kod_pocztowy, $zleceniodawca_miejscowosc, $zleceniodawca_dokument, 
		$zleceniodawca_numer_dokumentu, $zleceniodawca_pesel, $zleceniodawca_seria_i_numer_dowodu, $zleceniodawca_czy_obcokrajowiec,
		$zleceniodawca_email, $zleceniodawca_telefon);



