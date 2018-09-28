<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$opis = htmlspecialchars($_POST['opis']);
$miejscowosc = htmlspecialchars($_POST['miejscowosc']);
$imie_nazwisko = htmlspecialchars($_POST['imie_nazwisko']);
$adres = htmlspecialchars($_POST['adres']);
$data = htmlspecialchars($_POST['data']);

sprawa_aktualizuj_oswiadczenie(
		$sprawa_id
		,$opis
		,$miejscowosc
		,$imie_nazwisko
		,$adres
		,$data		
);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '12');