<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$mailing_podpis_id = $_POST['mailing_podpis_id'];

$podpis = mailing_podpis_pobierz_po_id($mailing_podpis_id);

echo htmlspecialchars_decode ($podpis['podpis_html']);

