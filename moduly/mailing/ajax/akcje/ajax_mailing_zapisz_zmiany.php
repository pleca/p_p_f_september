<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_id = htmlspecialchars($_POST['mailing_id']);
$mailing_temat_wiadomosci = htmlspecialchars($_POST['mailing_temat_wiadomosci']);
$mailing_adresat_imie_nazwisko = htmlspecialchars($_POST['mailing_adresat_imie_nazwisko']);
$mailing_adresat_email = htmlspecialchars($_POST['mailing_adresat_email']);
$mailing_tresc = htmlspecialchars($_POST['mailing_tresc']);

mailing_zapisz_zmiany($mailing_id, $mailing_temat_wiadomosci, $mailing_adresat_imie_nazwisko, $mailing_adresat_email, $mailing_tresc, $_SESSION['uzytkownik_id']);