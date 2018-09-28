<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$rekomendacja = htmlspecialchars($_POST['rekomendacja']);


sprawa_dodaj_lub_aktualizuj_rekomendacje($sprawa_id, $rekomendacja);