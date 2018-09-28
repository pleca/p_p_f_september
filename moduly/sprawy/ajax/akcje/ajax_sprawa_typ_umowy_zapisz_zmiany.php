<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$nazwa = htmlspecialchars($_POST['nazwa']);
$prowizja = htmlspecialchars($_POST['prowizja']);

sprawa_aktualizuj_umowe_strona_13(
		$sprawa_id
		,$nazwa
		,$prowizja
);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '13');