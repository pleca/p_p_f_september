<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_podpis_id = $_POST['mailing_podpis_id'];
$domyslny = $_POST['domyslny'];

$podpisy_do_aktualizacji = mailing_podpisy_pobierz_po_uzytkownik_id($_SESSION['uzytkownik_id']);

while ($pda = mysqli_fetch_assoc($podpisy_do_aktualizacji)) {
	mailing_podpis_ustaw_domyslny($pda['id'], $_SESSION['uzytkownik_id'], '0');
}

mailing_podpis_ustaw_domyslny($mailing_podpis_id, $_SESSION['uzytkownik_id'], $domyslny);