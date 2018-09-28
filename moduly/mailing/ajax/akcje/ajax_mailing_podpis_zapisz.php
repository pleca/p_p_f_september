<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_podpis_nazwa = $_POST['mailing_podpis_nazwa'];
$mailing_podpis_tresc = htmlspecialchars($_POST['mailing_podpis_tresc']);
$mailing_podpis_id = $_POST['mailing_podpis_id'];

mailing_podpis_zapisz($mailing_podpis_id, $mailing_podpis_nazwa, $mailing_podpis_tresc);