<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$forma_platnosci = htmlspecialchars($_POST['forma_platnosci']);
$id_odbiorcy = htmlspecialchars($_POST['id_odbiorcy']);
$imie = htmlspecialchars($_POST['imie']);
$nazwisko = htmlspecialchars($_POST['nazwisko']);
$ulica = htmlspecialchars($_POST['ulica']);
$nr_domu = htmlspecialchars($_POST['nr_domu']);
$nr_mieszkania = htmlspecialchars($_POST['nr_mieszkania']);
$kod_pocztowy = htmlspecialchars($_POST['kod_pocztowy']);
$miasto = htmlspecialchars($_POST['miasto']);
$rachunek = htmlspecialchars($_POST['rachunek']);

sprawa_aktualizuj_umowe_strona_14(
		$sprawa_id
		,$forma_platnosci
		,$id_odbiorcy
		,$imie
		,$nazwisko
		,$ulica
		,$nr_domu
		,$nr_mieszkania
		,$kod_pocztowy
		,$miasto
		,$rachunek		
);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '14');