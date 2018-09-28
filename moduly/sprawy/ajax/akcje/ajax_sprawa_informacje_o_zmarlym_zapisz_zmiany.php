<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$wiek_w_momencie_smierci = htmlspecialchars($_POST['wiek_w_momencie_smierci']);
$sprawa_wyksztalcenie = htmlspecialchars($_POST['sprawa_wyksztalcenie']);
$zawod_wyuczony = htmlspecialchars($_POST['zawod_wyuczony']);
$zawod_wykonywany = htmlspecialchars($_POST['zawod_wykonywany']);
$dodatkowe_kwalifikacje = htmlspecialchars($_POST['dodatkowe_kwalifikacje']);
$sprawa_zatrudnienie = htmlspecialchars($_POST['sprawa_zatrudnienie']);
$zatrudnienie_tekst = htmlspecialchars($_POST['zatrudnienie_tekst']);
$zarobki = htmlspecialchars($_POST['zarobki']);

sprawa_aktualizuj_strona_11_1(
		$sprawa_id
		,$wiek_w_momencie_smierci
		,$sprawa_wyksztalcenie
		,$zawod_wyuczony
		,$zawod_wykonywany
		,$dodatkowe_kwalifikacje
		,$sprawa_zatrudnienie
		,$zatrudnienie_tekst
		,$zarobki		
);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '11');
