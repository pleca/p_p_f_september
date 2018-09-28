<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$klient_id = htmlspecialchars($_POST['$klient_id']);

$imie = htmlspecialchars($_POST['uprawniony_imie']);
$nazwisko = htmlspecialchars($_POST['uprawniony_nazwisko']);
$pesel = htmlspecialchars($_POST['uprawniony_pesel']);
$dowod = strtoupper(htmlspecialchars($_POST['uprawniony_dowod']));

$ulica = htmlspecialchars($_POST['uprawniony_ulica']);
$nr_domu = htmlspecialchars($_POST['uprawniony_nr_domu']);
$nr_mieszkania = htmlspecialchars($_POST['uprawniony_nr_mieszkania']);
$kod_pocztowy = htmlspecialchars($_POST['uprawniony_kod_pocztowy']);
$miasto = htmlspecialchars($_POST['uprawniony_miasto']);

$email = htmlspecialchars($_POST['uprawniony_email']);
$telefon = htmlspecialchars($_POST['uprawniony_telefon']);

$sprawa_typ_osoby_id = htmlspecialchars($_POST['typ_osoba']);

$czy_obcokrajowiec = htmlspecialchars($_POST['uprawniony_obcokrajowiec']);

$rodzaj_dokumentu = htmlspecialchars($_POST['uprawniony_rodzaj_dokumentu']);
$nr_dokumentu = htmlspecialchars($_POST['uprawniony_nr_dokumentu']);

$id_osoby_dodajacej = $_SESSION['uzytkownik_id'];

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '4');

$uprawniony = sprawa_aktualizuj_poszkodowanego_uprawnionego(
		$sprawa_id
		,$imie
		,$nazwisko
		,$pesel
		,$dowod
		,$ulica
		,$nr_domu
		,$nr_mieszkania
		,$kod_pocztowy
		,$miasto
		,$email
		,$telefon
		,$sprawa_typ_osoby_id
		,$czy_obcokrajowiec
		,$rodzaj_dokumentu
		,$nr_dokumentu
		,$id_osoby_dodajacej
);

//var_dump($uprawniony);
echo $uprawniony['id'];
