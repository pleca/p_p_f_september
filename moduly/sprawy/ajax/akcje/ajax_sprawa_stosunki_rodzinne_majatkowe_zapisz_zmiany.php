<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$sprawa_pokrewienstwo = htmlspecialchars($_POST['sprawa_pokrewienstwo']);
$pokrewienstwo_tekst = htmlspecialchars($_POST['pokrewienstwo_tekst']);
$sprawa_pomoc = htmlspecialchars($_POST['sprawa_pomoc']);
$sprawa_stosunki_uprawnionego = htmlspecialchars($_POST['sprawa_stosunki_uprawnionego']);
//$sprawa_utrzymanie = htmlspecialchars($_POST['sprawa_utrzymanie']);
//$sprawa_stosunki_mieszkaniowe = htmlspecialchars($_POST['sprawa_stosunki_mieszkaniowe']);

$sprawa_utrzymanie = htmlspecialchars($_POST['utrzymanie_id']);
$sprawa_stosunki_mieszkaniowe = htmlspecialchars($_POST['stosunki_mieszkaniowe_id']);


$sprawa_utrzymanie_1 = htmlspecialchars($_POST['sprawa_utrzymanie_1']);
$sprawa_utrzymanie_2 = htmlspecialchars($_POST['sprawa_utrzymanie_2']);
$sprawa_utrzymanie_3 = htmlspecialchars($_POST['sprawa_utrzymanie_3']);
$sprawa_utrzymanie_4 = htmlspecialchars($_POST['sprawa_utrzymanie_4']);
$sprawa_utrzymanie_5 = htmlspecialchars($_POST['sprawa_utrzymanie_5']);
 
$sprawa_stosunki_mieszkaniowe_1 = htmlspecialchars($_POST['sprawa_stosunki_mieszkaniowe_1']);
$sprawa_stosunki_mieszkaniowe_2 = htmlspecialchars($_POST['sprawa_stosunki_mieszkaniowe_2']);
$sprawa_stosunki_mieszkaniowe_3 = htmlspecialchars($_POST['sprawa_stosunki_mieszkaniowe_3']);



$dodaj_utrzymanie = sprawa_dodaj_lub_aktualizuj_utrzymanie ( $sprawa_utrzymanie, $sprawa_utrzymanie_1, $sprawa_utrzymanie_2, $sprawa_utrzymanie_3, $sprawa_utrzymanie_4, $sprawa_utrzymanie_5 );
$dodaj_utrzymanie = mysqli_fetch_assoc ( $dodaj_utrzymanie );

$dodaj_stosunki_mieszkaniowe = sprawa_dodaj_lub_aktualizuj_stosunki_mieszkaniowe ( $sprawa_stosunki_mieszkaniowe, $sprawa_stosunki_mieszkaniowe_1, $sprawa_stosunki_mieszkaniowe_2, $sprawa_stosunki_mieszkaniowe_2 );
$dodaj_stosunki_mieszkaniowe = mysqli_fetch_assoc ( $dodaj_stosunki_mieszkaniowe );

sprawa_aktualizuj_strona_11_3(
		$sprawa_id
		,$sprawa_pokrewienstwo
		,$pokrewienstwo_tekst
		,$sprawa_stosunki_mieszkaniowe
		,$sprawa_pomoc
		,$sprawa_stosunki_uprawnionego
		,$sprawa_utrzymanie	
);

echo $sprawa_utrzymanie;

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '11');