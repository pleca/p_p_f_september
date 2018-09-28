<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$uzytkownik = $_SESSION ['uzytkownik_id'];
$id_klienta_1 = htmlspecialchars ( $_POST ['id_klienta_1'] );
$id_klienta_2 = htmlspecialchars ( $_POST ['id_klienta_2'] );

$forma_platnosci = htmlspecialchars ( $_POST ['forma_platnosci'] );
$odbiorca = htmlspecialchars ( $_POST ['odbiorca'] );
$rachunek_bankowy = htmlspecialchars ( $_POST ['rachunek_bankowy'] );

$imie_przelew = htmlspecialchars ( $_POST ['imie_przelew'] );
$nazwisko_przelew = htmlspecialchars ( $_POST ['nazwisko_przelew'] );
$ulica_przelew = htmlspecialchars ( $_POST ['ulica_przelew'] );
$dom_przelew = htmlspecialchars ( $_POST ['dom_przelew'] );
$mieszkanie_przelew = htmlspecialchars ( $_POST ['mieszkanie_przelew'] );
$kod_przelew = htmlspecialchars ( $_POST ['kod_przelew'] );
$miejscowosc_przelew = htmlspecialchars ( $_POST ['miejscowosc_przelew'] );

$imie_przekaz = htmlspecialchars ( $_POST ['imie_przekaz'] );
$nazwisko_przekaz = htmlspecialchars ( $_POST ['nazwisko_przekaz'] );
$ulica_przekaz = htmlspecialchars ( $_POST ['ulica_przekaz'] );
$dom_przekaz = htmlspecialchars ( $_POST ['dom_przekaz'] );
$mieszkanie_przekaz = htmlspecialchars ( $_POST ['mieszkanie_przekaz'] );
$kod_przekaz = htmlspecialchars ( $_POST ['kod_przekaz'] );
$miejscowosc_przekaz = htmlspecialchars ( $_POST ['miejscowosc_przekaz'] );

$umowa = 'Usługi bankowe';
$prowizja = htmlspecialchars ( $_POST ['prowizja'] );

$jaka_umowa = sprawa_dodaj_umowe ( $umowa, $prowizja );
$id_umowy = $jaka_umowa ['id'];

$aktualizuj_umowe_do_sprawy = sprawa_aktualizacja ( 'sprawa_umowa_id', $id_umowy, $id_sprawy );
$aktualizuj_umowe_do_sprawy = mysqli_fetch_assoc ( $aktualizuj_umowe_do_sprawy );

if ($forma_platnosci == 'przelew') {
	
	if ($odbiorca == '1') {
		$dodaj_rachunek = sprawa_dodaj_rachunek ( $id_klienta_1, $rachunek_bankowy );
		$dodaj_rachunek = mysqli_fetch_assoc ( $dodaj_rachunek );
		
		$osoba_do_wyplaty = $id_klienta_1;
		$platnosc = sprawa_platnosc_uposazony ( $id_umowy, $forma_platnosci, $osoba_do_wyplaty );
		
		$platnosc = mysqli_fetch_assoc ( $platnosc );
	} else {
		$dodaj_adres = sprawa_dodaj_adres ( $ulica_przelew, $dom_przelew, $mieszkanie_przelew, $kod_przelew, $miejscowosc_przelew );
		$dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
		
		$dodaj_osobe = sprawa_dodaj_osobe ( $imie_przelew, $nazwisko_przelew, '', '', $dodaj_adres ['adres_id'], $dodaj_adres ['adres_id'], '', '', '', '', '', $uzytkownik );
		$dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
		
		$dodaj_rachunek = sprawa_dodaj_rachunek ( $dodaj_osobe ['osoba_id'], $rachunek_bankowy );
		$dodaj_rachunek = mysqli_fetch_assoc ( $dodaj_rachunek );
		
		$platnosc = sprawa_platnosc_uposazony ( $id_umowy, $forma_platnosci, $dodaj_osobe ['osoba_id'] );
		$platnosc = mysqli_fetch_assoc ( $platnosc );
	}
} else if ($forma_platnosci == 'przekaz') {
	
	if ($odbiorca == '1') {
		
		$osoba_do_wyplaty = $id_klienta_1;
		$platnosc = sprawa_platnosc_uposazony ( $id_umowy, $forma_platnosci, $osoba_do_wyplaty );
		$platnosc = mysqli_fetch_assoc ( $platnosc );
	} else {
		$dodaj_adres = sprawa_dodaj_adres ( $ulica_przekaz, $dom_przekaz, $mieszkanie_przekaz, $kod_przekaz, $miejscowosc_przekaz );
		$dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
		
		$dodaj_osobe = sprawa_dodaj_osobe ( $imie_przekaz, $nazwisko_przekaz, '', '', $dodaj_adres ['adres_id'], $dodaj_adres ['adres_id'], '', '', '', '', '', $uzytkownik );
		$dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
		
		$platnosc = sprawa_platnosc_uposazony ( $id_umowy, $forma_platnosci, $dodaj_osobe ['osoba_id'] );
		$platnosc = mysqli_fetch_assoc ( $platnosc );
	}
}

// sprawa_aktualizuj_ostatnia_strone ( $id_sprawy, '7' );

$dane = array (
		0 => $id_sprawy,
		1 => $id_umowy 
);

echo json_encode ( $dane );