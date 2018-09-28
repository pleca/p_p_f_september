<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_podpis_nazwa = $_POST['mailing_podpis_nazwa'];
$mailing_podpis_tresc = htmlspecialchars($_POST['mailing_podpis_tresc']);
$domyslny = $_POST['domyslny'];

mailing_podpis_dodaj_nowe($mailing_podpis_nazwa, $mailing_podpis_tresc, $_SESSION['uzytkownik_id'], $domyslny);