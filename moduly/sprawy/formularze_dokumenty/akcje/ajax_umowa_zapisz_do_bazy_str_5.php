<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$data_wypadku = htmlspecialchars ( $_POST ['data_wypadku'] );
$godzina_wypadku = htmlspecialchars ( $_POST ['godzina_wypadku'] );
$miejsce_zdarzenia = htmlspecialchars ( $_POST ['miejsce_zdarzenia'] );

$czy_dwa_pojazdy = htmlspecialchars ( $_POST ['czy_dwa_pojazdy'] );
$czy_pieszy_rowerzysta = htmlspecialchars ( $_POST ['czy_pieszy_rowerzysta'] );
$szkoda_niekomunikacyjna = htmlspecialchars ( $_POST ['szkoda_niekomunikacyjna'] );

$pojazd_a_marka = htmlspecialchars ( $_POST ['pojazd_a_marka'] );
$pojazd_a_model = htmlspecialchars ( $_POST ['pojazd_a_model'] );
$pojazd_a_nr_rejestracyjny = htmlspecialchars ( $_POST ['pojazd_a_nr_rejestracyjny'] );
$pojazd_a_kraj_rejestracji = htmlspecialchars ( $_POST ['pojazd_a_kraj_rejestracji'] );
$pojazd_a_kierujacy_pojazdem = htmlspecialchars ( $_POST ['pojazd_a_kierujacy_pojazdem'] );
$pojazd_a_posiadacz_pojazdu = htmlspecialchars ( $_POST ['pojazd_a_posiadacz_pojazdu'] );
$pojazd_a_uoc_posiadacz_pojazdu = htmlspecialchars ( $_POST ['pojazd_a_uoc_posiadacz_pojazdu'] );
$pojazd_a_nr_polisy_oc = htmlspecialchars ( $_POST ['pojazd_a_nr_polisy_oc'] );

$pojazd_b_marka = htmlspecialchars ( $_POST ['pojazd_b_marka'] );
$pojazd_b_model = htmlspecialchars ( $_POST ['pojazd_b_model'] );
$pojazd_b_nr_rejestracyjny = htmlspecialchars ( $_POST ['pojazd_b_nr_rejestracyjny'] );
$pojazd_b_kraj_rejestracji = htmlspecialchars ( $_POST ['pojazd_b_kraj_rejestracji'] );
$pojazd_b_kierujacy_pojazdem = htmlspecialchars ( $_POST ['pojazd_b_kierujacy_pojazdem'] );
$pojazd_b_posiadacz_pojazdu = htmlspecialchars ( $_POST ['pojazd_b_posiadacz_pojazdu'] );
$pojazd_b_uoc_posiadacz_pojazdu = htmlspecialchars ( $_POST ['pojazd_b_uoc_posiadacz_pojazdu'] );
$pojazd_b_nr_polisy_oc = htmlspecialchars ( $_POST ['pojazd_b_nr_polisy_oc'] );

$inf_o_sprawcy = htmlspecialchars ( $_POST ['inf_o_sprawcy'] );
$opis_zdarzenia = htmlspecialchars ( $_POST ['opis_zdarzenia'] );
$opis_obrazen = htmlspecialchars ( $_POST ['opis_obrazen'] );

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );

$stos_poj_a = htmlspecialchars ( $_POST ['stos_poj_a'] );
$poj_a_inny_stosunek = htmlspecialchars ( $_POST ['poj_a_inny_stosunek'] );
$stos_poj_b = htmlspecialchars ( $_POST ['stos_poj_b'] );
$poj_b_inny_stosunek = htmlspecialchars ( $_POST ['poj_b_inny_stosunek'] );

$rodzaj_zdarzenia = htmlspecialchars ( $_POST ['rodzaj_zdarzenia'] );
/*
 * if ($czy_dwa_pojazdy == 0 & $czy_pieszy_rowerzysta == 0 & $szkoda_niekomunikacyjna == 0) {
 *
 * $dodaj_pojazd_a = 0;
 * $dodaj_pojazd_b = 0;
 *
 * $dodaj_zdarzenie = sprawa_dodaj_zdarzenie ( $data_wypadku, $godzina_wypadku, $miejsce_zdarzenia, $dodaj_pojazd_a, $dodaj_pojazd_b, NULL );
 * $dodaj_zdarzenie = mysqli_fetch_assoc ( $dodaj_zdarzenie );
 *
 * $dodaj_opis = sprawa_dodaj_opis ( $opis_zdarzenia );
 * $dodaj_opis = mysqli_fetch_assoc ( $dodaj_opis );
 *
 * $dodaj_obrazenia = sprawa_dodaj_opis_obrazen ( $opis_obrazen );
 * $dodaj_obrazenia = mysqli_fetch_assoc ( $dodaj_obrazenia );
 *
 * $aktualizuj_sprawe_zdarzenie = sprawa_aktualizacja ( 'sprawa_zdarzenie_id', $dodaj_zdarzenie ['id'], $id_sprawy );
 * $aktualizuj_sprawe_zdarzenie = mysqli_fetch_assoc ( $aktualizuj_sprawe_zdarzenie );
 *
 * $aktualizuj_sprawe_opis_obrazen = sprawa_aktualizacja ( 'sprawa_obrazenia_id', $dodaj_obrazenia ['id'], $id_sprawy );
 * $aktualizuj_sprawe_opis_obrazen = mysqli_fetch_assoc ( $aktualizuj_sprawe_opis_obrazen );
 *
 * $aktualizuj_sprawe_opis = sprawa_aktualizacja ( 'sprawa_opis_id', $dodaj_opis ['id'], $id_sprawy );
 * $aktualizuj_sprawe_opis = mysqli_fetch_assoc ( $aktualizuj_sprawe_opis );
 * $id_zdarzenia = $dodaj_zdarzenie ['id'];
 * }
 */




if ($rodzaj_zdarzenia == 1) {
	
	$dodaj_pojazd_a = sprawa_zdarzenie_dodaj_pojazd ( $pojazd_a_marka, $pojazd_a_model, $pojazd_a_nr_rejestracyjny, $pojazd_a_kraj_rejestracji, $pojazd_a_kierujacy_pojazdem, $pojazd_a_posiadacz_pojazdu, $pojazd_a_uoc_posiadacz_pojazdu, $pojazd_a_nr_polisy_oc );
	$dodaj_pojazd_a = mysqli_fetch_assoc ( $dodaj_pojazd_a );
	
	$dodaj_pojazd_b = sprawa_zdarzenie_dodaj_pojazd ( $pojazd_b_marka, $pojazd_b_model, $pojazd_b_nr_rejestracyjny, $pojazd_b_kraj_rejestracji, $pojazd_b_kierujacy_pojazdem, $pojazd_b_posiadacz_pojazdu, $pojazd_b_uoc_posiadacz_pojazdu, $pojazd_b_nr_polisy_oc );
	$dodaj_pojazd_b = mysqli_fetch_assoc ( $dodaj_pojazd_b );
	
	$dodaj_zdarzenie = sprawa_dodaj_zdarzenie ( $data_wypadku, $godzina_wypadku, $miejsce_zdarzenia, $dodaj_pojazd_a ['id'], $dodaj_pojazd_b ['id'], $rodzaj_zdarzenia );
	$dodaj_zdarzenie = mysqli_fetch_assoc ( $dodaj_zdarzenie );
	
	$dodaj_opis = sprawa_dodaj_opis ( $opis_zdarzenia );
	$dodaj_opis = mysqli_fetch_assoc ( $dodaj_opis );
	
	$dodaj_obrazenia = sprawa_dodaj_opis_obrazen ( $opis_obrazen );
	$dodaj_obrazenia = mysqli_fetch_assoc ( $dodaj_obrazenia );
	
	$aktualizuj_sprawe_zdarzenie = sprawa_aktualizacja ( 'sprawa_zdarzenie_id', $dodaj_zdarzenie ['id'], $id_sprawy );
	$aktualizuj_sprawe_zdarzenie = mysqli_fetch_assoc ( $aktualizuj_sprawe_zdarzenie );
	
	$aktualizuj_sprawe_opis_obrazen = sprawa_aktualizacja ( 'sprawa_obrazenia_id', $dodaj_obrazenia ['id'], $id_sprawy );
	$aktualizuj_sprawe_opis_obrazen = mysqli_fetch_assoc ( $aktualizuj_sprawe_opis_obrazen );
	
	$aktualizuj_sprawe_opis = sprawa_aktualizacja ( 'sprawa_opis_id', $dodaj_opis ['id'], $id_sprawy );
	$aktualizuj_sprawe_opis = mysqli_fetch_assoc ( $aktualizuj_sprawe_opis );
	$id_zdarzenia = $dodaj_zdarzenie ['id'];
}
if ($rodzaj_zdarzenia == 2) {
	
	$dodaj_pojazd_a = '0';
	
	$dodaj_pojazd_b = sprawa_zdarzenie_dodaj_pojazd ( $pojazd_b_marka, $pojazd_b_model, $pojazd_b_nr_rejestracyjny, $pojazd_b_kraj_rejestracji, $pojazd_b_kierujacy_pojazdem, $pojazd_b_posiadacz_pojazdu, $pojazd_b_uoc_posiadacz_pojazdu, $pojazd_b_nr_polisy_oc );
	$dodaj_pojazd_b = mysqli_fetch_assoc ( $dodaj_pojazd_b );
	
	$dodaj_zdarzenie = sprawa_dodaj_zdarzenie ( $data_wypadku, $godzina_wypadku, $miejsce_zdarzenia, $dodaj_pojazd_a, $dodaj_pojazd_b ['id'], $rodzaj_zdarzenia );
	$dodaj_zdarzenie = mysqli_fetch_assoc ( $dodaj_zdarzenie );
	
	$dodaj_opis = sprawa_dodaj_opis ( $opis_zdarzenia );
	$dodaj_opis = mysqli_fetch_assoc ( $dodaj_opis );
	
	$dodaj_obrazenia = sprawa_dodaj_opis_obrazen ( $opis_obrazen );
	$dodaj_obrazenia = mysqli_fetch_assoc ( $dodaj_obrazenia );
	
	$aktualizuj_sprawe_zdarzenie = sprawa_aktualizacja ( 'sprawa_zdarzenie_id', $dodaj_zdarzenie ['id'], $id_sprawy );
	$aktualizuj_sprawe_zdarzenie = mysqli_fetch_assoc ( $aktualizuj_sprawe_zdarzenie );
	
	$aktualizuj_sprawe_opis_obrazen = sprawa_aktualizacja ( 'sprawa_obrazenia_id', $dodaj_obrazenia ['id'], $id_sprawy );
	$aktualizuj_sprawe_opis_obrazen = mysqli_fetch_assoc ( $aktualizuj_sprawe_opis_obrazen );
	
	$aktualizuj_sprawe_opis = sprawa_aktualizacja ( 'sprawa_opis_id', $dodaj_opis ['id'], $id_sprawy );
	$aktualizuj_sprawe_opis = mysqli_fetch_assoc ( $aktualizuj_sprawe_opis );
	$id_zdarzenia = $dodaj_zdarzenie ['id'];
}
if ($rodzaj_zdarzenia == 3) {
	
	$dodaj_pojazd = '0';
	
	$dodaj_pojazd_a = sprawa_zdarzenie_dodaj_pojazd ( '', '', '', '', '', '', '', '' );
	$dodaj_pojazd_a = mysqli_fetch_assoc ( $dodaj_pojazd_a );
	
	$dodaj_pojazd_b = sprawa_zdarzenie_dodaj_pojazd ( '', '', '', '', '', '', '', '' );
	$dodaj_pojazd_b = mysqli_fetch_assoc ( $dodaj_pojazd_b );
	
	$dodaj_zdarzenie = sprawa_dodaj_zdarzenie ( $data_wypadku, $godzina_wypadku, $miejsce_zdarzenia, $dodaj_pojazd_a ['id'], $dodaj_pojazd_b ['id'], $rodzaj_zdarzenia );
	$dodaj_zdarzenie = mysqli_fetch_assoc ( $dodaj_zdarzenie );
	
	$dodaj_opis = sprawa_dodaj_opis ( $opis_zdarzenia );
	$dodaj_opis = mysqli_fetch_assoc ( $dodaj_opis );
	
	$dodaj_obrazenia = sprawa_dodaj_opis_obrazen ( $opis_obrazen );
	$dodaj_obrazenia = mysqli_fetch_assoc ( $dodaj_obrazenia );
	
	$aktualizuj_sprawe_zdarzenie = sprawa_aktualizacja ( 'sprawa_zdarzenie_id', $dodaj_zdarzenie ['id'], $id_sprawy );
	$aktualizuj_sprawe_zdarzenie = mysqli_fetch_assoc ( $aktualizuj_sprawe_zdarzenie );
	
	$aktualizuj_sprawe_opis_obrazen = sprawa_aktualizacja ( 'sprawa_obrazenia_id', $dodaj_obrazenia ['id'], $id_sprawy );
	$aktualizuj_sprawe_opis_obrazen = mysqli_fetch_assoc ( $aktualizuj_sprawe_opis_obrazen );
	
	$aktualizuj_sprawe_opis = sprawa_aktualizacja ( 'sprawa_opis_id', $dodaj_opis ['id'], $id_sprawy );
	$aktualizuj_sprawe_opis = mysqli_fetch_assoc ( $aktualizuj_sprawe_opis );
	$id_zdarzenia = $dodaj_zdarzenie ['id'];
}

$aktualizuj_zdarzenie_stosunek = aktualizuj_zdarzenie ( $id_zdarzenia, $stos_poj_a, $stos_poj_b, $poj_a_inny_stosunek, $poj_b_inny_stosunek );
$aktualizuj_zdarzenie_stosunek = mysqli_fetch_assoc ( $aktualizuj_zdarzenie_stosunek );

sprawa_aktualizuj_ostatnia_strone ( $id_sprawy, '5' );

$dane = array (
		0 => $id_sprawy,
		1 => $id_zdarzenia 
);

echo json_encode ( $dane );
