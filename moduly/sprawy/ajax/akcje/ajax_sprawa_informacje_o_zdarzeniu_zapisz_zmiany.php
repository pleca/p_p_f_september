<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars ( $_POST ['sprawa_id'] );

$data = htmlspecialchars ( $_POST ['zdarzenie_data'] );
$godzina = htmlspecialchars ( $_POST ['zdarzenie_godzina'] );
$miejsce = htmlspecialchars ( $_POST ['zdarzenie_miejsce'] );

$marka_a = htmlspecialchars ( $_POST ['zdarzenie_marka_a'] );
$typ_pojazdu_a = htmlspecialchars ( $_POST ['zdarzenie_typ_pojazdu_a'] );
$nr_rejestracyjny_a = htmlspecialchars ( $_POST ['zdarzenie_nr_rejestracyjny_a'] );
$kraj_rejestracji_a = htmlspecialchars ( $_POST ['zdarzenie_kraj_rejestracji_a'] );
$kierujacy_a = htmlspecialchars ( $_POST ['zdarzenie_kierujacy_a'] );
$posiadacz_a = htmlspecialchars ( $_POST ['zdarzenie_posiadacz_a'] );
$ubezpieczyciel_a = htmlspecialchars ( $_POST ['zdarzenie_ubezpieczyciel_a'] );
$nr_oc_a = htmlspecialchars ( $_POST ['zdarzenie_nr_oc_a'] );

$marka_b = htmlspecialchars ( $_POST ['zdarzenie_marka_b'] );
$typ_pojazdu_b = htmlspecialchars ( $_POST ['zdarzenie_typ_pojazdu_b'] );
$nr_rejestracyjny_b = htmlspecialchars ( $_POST ['zdarzenie_nr_rejestracyjny_b'] );
$kraj_rejestracji_b = htmlspecialchars ( $_POST ['zdarzenie_kraj_rejestracji_b'] );
$kierujacy_b = htmlspecialchars ( $_POST ['zdarzenie_kierujacy_b'] );
$posiadacz_b = htmlspecialchars ( $_POST ['zdarzenie_posiadacz_b'] );
$ubezpieczyciel_b = htmlspecialchars ( $_POST ['zdarzenie_ubezpieczyciel_b'] );
$nr_oc_b = htmlspecialchars ( $_POST ['zdarzenie_nr_oc_b'] );

$stosunek_poj_a = htmlspecialchars ( $_POST ['zdarzenie_stosunek_poj_a'] );
$stosunek_poj_a_tekst = htmlspecialchars ( $_POST ['zdarzenie_stosunek_poj_a_tekst'] );
$stosunek_poj_b = htmlspecialchars ( $_POST ['zdarzenie_stosunek_poj_b'] );
$stosunek_poj_b_tekst = htmlspecialchars ( $_POST ['zdarzenie_stosunek_poj_b_tekst'] );

$opis = htmlspecialchars ( $_POST ['zdarzenie_opis'] );
$obrazenia = htmlspecialchars ( $_POST ['obrazenia_opis'] );
$rodzaj_zdarzenia = htmlspecialchars ( $_POST ['rodzaj_zdarzenia'] );

$zdarzenie_id = sprawa_aktualizuj_zdarzenie ( $sprawa_id, $data, $godzina, $miejsce, $marka_a, $typ_pojazdu_a, $nr_rejestracyjny_a, $kraj_rejestracji_a, $kierujacy_a, $posiadacz_a, $ubezpieczyciel_a, $nr_oc_a, $marka_b, $typ_pojazdu_b, $nr_rejestracyjny_b, $kraj_rejestracji_b, $kierujacy_b, $posiadacz_b, $ubezpieczyciel_b, $nr_oc_b, $stosunek_poj_a, $stosunek_poj_a_tekst, $stosunek_poj_b, $stosunek_poj_b_tekst, $opis );

$id_zdarzenia = $zdarzenie_id ['zdarzenie_id'];
aktualizuj_rodzaj_zdarzenia ( $id_zdarzenia, $rodzaj_zdarzenia );

$sprawa = sprawa_pobierz_wszystkie_dane_po_id_sprawy ( $sprawa_id );

if (is_null ( $sprawa ['sprawa_obrazenia_id'] )) {
	$dodaj_obrazenia = sprawa_dodaj_opis_obrazen ( $obrazenia );
	$dodaj_obrazenia = mysqli_fetch_assoc ( $dodaj_obrazenia );
	sprawa_aktualizacja ( 'sprawa_obrazenia_id', $dodaj_obrazenia ['id'], $sprawa_id );
} else {
	aktualizuj_opis_obrazen ( $sprawa ['sprawa_obrazenia_id'], $obrazenia );
}

sprawa_aktualizuj_ostatnia_strone ( $sprawa_id, '5' );

// echo $stosunek_poj_b_tekst;

echo $id_zdarzenia;
//echo $dodaj_obrazenia ['id'];

//echo var_dump($zdarzenie_id);