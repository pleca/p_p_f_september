<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$id_umowy = htmlspecialchars ( $_POST ['id_umowy'] );
$uzytkownik = $_SESSION ['uzytkownik_id'];
$id_klienta_1 = htmlspecialchars ( $_POST ['id_klienta_1'] );

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

$umowa = 'Usługi bankowe';
$prowizja = htmlspecialchars ( $_POST ['prowizja'] );

if ($odbiorca == '1') {
	$aktualizuj_dane = sprawa_aktualizuj_dane_wynagrodzenia_do_umowy_bankowej ( $id_umowy, $umowa, $prowizja, $forma_platnosci, $id_klienta_1 );
	
	$dodaj_rachunek = sprawa_dodaj_rachunek ( $id_klienta_1, $rachunek_bankowy );
	$dodaj_rachunek = mysqli_fetch_assoc ( $dodaj_rachunek );
} else {
	
	$dodaj_adres = sprawa_dodaj_adres ( $ulica_przelew, $dom_przelew, $mieszkanie_przelew, $kod_przelew, $miejscowosc_przelew );
	$dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
	
	$dodaj_osobe = sprawa_dodaj_osobe ( $imie_przelew, $nazwisko_przelew, '', '', $dodaj_adres ['adres_id'], $dodaj_adres ['adres_id'], '', '', '', '', '', $uzytkownik );
	$dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
	
	$dodaj_rachunek = sprawa_dodaj_rachunek ( $dodaj_osobe ['osoba_id'], $rachunek_bankowy );
	$dodaj_rachunek = mysqli_fetch_assoc ( $dodaj_rachunek );
	
	$aktualizuj_dane = sprawa_aktualizuj_dane_wynagrodzenia_do_umowy_bankowej ( $id_umowy, $umowa, $prowizja, $forma_platnosci, $dodaj_osobe ['osoba_id'] );
}

echo json_encode ( $dane );