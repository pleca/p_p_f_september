<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_id = htmlspecialchars($_POST['mailing_id']);
$uzytkownik_id = $_SESSION['uzytkownik_id'];

mailing_schemat_usun($mailing_id, $uzytkownik_id);