<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_podpis_id = $_POST['mailing_podpis_id'];

mailing_podpis_usun($mailing_podpis_id, $_SESSION['uzytkownik_id']);