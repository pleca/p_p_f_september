<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$klient_id = htmlspecialchars($_POST['klient_id']);
$sprawa_adres_korespondencja_id = htmlspecialchars($_POST['sprawa_adres_korespondencja_id']);
$sprawa_adres_zameldowania_id = htmlspecialchars($_POST['sprawa_adres_zameldowania_id']);

sprawa_adres_kor_usun($sprawa_adres_korespondencja_id);

sprawa_kratka_zapisz_zmiane('sprawa_osoba', $klient_id, 'sprawa_adres_korespondencja_id', $sprawa_adres_zameldowania_id);