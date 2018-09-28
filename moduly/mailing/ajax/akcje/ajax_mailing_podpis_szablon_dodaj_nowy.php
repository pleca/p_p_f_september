<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_podpis_tresc = htmlspecialchars($_POST['mailing_podpis_tresc']);

mailing_podpis_szablon_dodaj_nowy($mailing_podpis_tresc);