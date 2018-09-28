<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars ( $_POST ['sprawa_id'] );

$klient_poszkodowany = htmlspecialchars ( $_POST ['klient_poszkodowany'] );
$id_klienta = htmlspecialchars ( $_POST ['id_klienta'] );

$imie = htmlspecialchars ( $_POST ['poszkodowany_imie'] );
$nazwisko = htmlspecialchars ( $_POST ['poszkodowany_nazwisko'] );
$pesel = htmlspecialchars ( $_POST ['poszkodowany_pesel'] );
$dowod = strtoupper ( htmlspecialchars ( $_POST ['poszkodowany_dowod'] ) );

$ulica = htmlspecialchars ( $_POST ['poszkodowany_ulica'] );
$nr_domu = htmlspecialchars ( $_POST ['poszkodowany_nr_domu'] );
$nr_mieszkania = htmlspecialchars ( $_POST ['poszkodowany_nr_mieszkania'] );
$kod_pocztowy = htmlspecialchars ( $_POST ['poszkodowany_kod_pocztowy'] );
$miasto = htmlspecialchars ( $_POST ['poszkodowany_miasto'] );

$email = htmlspecialchars ( $_POST ['poszkodowany_email'] );
$telefon = htmlspecialchars ( $_POST ['poszkodowany_telefon'] );

$sprawa_typ_osoby_id = htmlspecialchars ( $_POST ['typ_osoba'] );

$czy_obcokrajowiec = htmlspecialchars ( $_POST ['poszkodowany_obcokrajowiec'] );

$typ_poszkodowanego = htmlspecialchars ( $_POST ['typ_poszkodowanego'] );

$rodzaj_dokumentu = htmlspecialchars ( $_POST ['poszkodowany_rodzaj_dokumentu'] );
$nr_dokumentu = htmlspecialchars ( $_POST ['poszkodowany_nr_dokumentu'] );

$id_osoby_dodajacej = $_SESSION ['uzytkownik_id'];

sprawa_aktualizuj_ostatnia_strone ( $sprawa_id, '3' );

if (!$klient_poszkodowany) {

	$poszkodowany = sprawa_aktualizuj_poszkodowanego_uprawnionego ( $sprawa_id, $imie, $nazwisko, $pesel, $dowod, $ulica, $nr_domu, $nr_mieszkania, $kod_pocztowy, $miasto, $email, $telefon, $sprawa_typ_osoby_id, $czy_obcokrajowiec, $rodzaj_dokumentu, $nr_dokumentu, $id_osoby_dodajacej );
	$poszkodowany_id = $poszkodowany ['id'];
	
	$aktualizuj_poszkodowanego_sprawy = sprawa_aktualizacja ( 'sprawa_poszkodowany_id', $poszkodowany_id, $id_sprawy );
	$aktualizuj_poszkodowanego_sprawy = mysqli_fetch_assoc ( $aktualizuj_poszkodowanego_sprawy );

} else {

	$aktualizuj_poszkodowanego_sprawy = sprawa_aktualizacja ( 'sprawa_poszkodowany_id', $id_klienta, $sprawa_id );
	$aktualizuj_poszkodowanego_sprawy = mysqli_fetch_assoc ( $aktualizuj_poszkodowanego_sprawy );
	$poszkodowany_id = $id_klienta;
}

$aktualizuj_typ_poszkodowanego = sprawa_aktualizacja ( 'sprawa_typ_poszkodowany_id', $typ_poszkodowanego, $sprawa_id );
$aktualizuj_typ_poszkodowanego = mysqli_fetch_assoc ( $aktualizuj_typ_poszkodowanego );

echo $poszkodowany_id;
