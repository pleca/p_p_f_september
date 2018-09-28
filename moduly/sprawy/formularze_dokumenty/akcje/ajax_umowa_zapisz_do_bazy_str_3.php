<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$id_klienta = htmlspecialchars ( $_POST ['id_klienta'] );
$klient_poszkodowany = htmlspecialchars ( $_POST ['klient_poszkodowany'] );

$poszkodowany_imie = htmlspecialchars ( $_POST ['poszkodowany_imie'] );
$poszkodowany_nazwisko = htmlspecialchars ( $_POST ['poszkodowany_nazwisko'] );
$poszkodowany_ulica = htmlspecialchars ( $_POST ['poszkodowany_ulica'] );
$poszkodowany_nr_domu = htmlspecialchars ( $_POST ['poszkodowany_nr_domu'] );
$poszkodowany_nr_mieszkania = htmlspecialchars ( $_POST ['poszkodowany_nr_mieszkania'] );
$poszkodowany_kod_pocztowy = htmlspecialchars ( $_POST ['poszkodowany_kod_pocztowy'] );
$poszkodowany_miejscowosc = htmlspecialchars ( $_POST ['poszkodowany_miejscowosc'] );
$poszkodowany_email = htmlspecialchars ( $_POST ['poszkodowany_email'] );
$poszkodowany_tel = htmlspecialchars ( $_POST ['poszkodowany_tel'] );
$czy_obcokrajowiec = htmlspecialchars ( $_POST ['czy_obcokrajowiec'] );
$poszkodowany_pesel = htmlspecialchars ( $_POST ['poszkodowany_pesel'] );
$poszkodowany_seria_i_numer_dowodu = strtoupper ( htmlspecialchars ( $_POST ['poszkodowany_seria_i_numer_dowodu'] ) );
$poszkodowany_dokument = htmlspecialchars ( $_POST ['poszkodowany_dokument'] );
$poszkodowany_numer_dokumentu = htmlspecialchars ( $_POST ['poszkodowany_numer_dokumentu'] );
$typ_osoby = '2';
$id_osoby_dodajacej = $_SESSION ['uzytkownik_id'];

if (! empty ( $poszkodowany_pesel )) {
    $rok = substr ( $poszkodowany_pesel, 0, 2 );
    $miesiac = substr ( $poszkodowany_pesel, 2, - 7 );
    $dzien = substr ( $poszkodowany_pesel, 4, - 5 );

    if ($miesiac < 13) {
        $miesiac = $miesiac;
        $rok = '19' . $rok;
    } else if ($miesiac > 12) {
        $miesiac = $miesiac - 20;
        $rok = '20' . $rok;
    }
    $dzsiaj_rok = date ( 'Y' );
    $dzsiaj_miesiac = date ( 'm' );
    $data_urodzenia = $dzien . '-' . $miesiac . '-' . $rok;

    $wiek_poszkodowanego = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok * 12) + $miesiac)) / 12 );
}

$dane_sprawy = sprawa_pobierz_dane_sprawy ( $id_sprawy );
$typ_szkody = $dane_sprawy ['sprawa_typ_szkody_id'];

if ($typ_szkody == '1') {
	$typ_poszkodowanego = htmlspecialchars ( $_POST ['typ_poszkodowanego'] );
} else
	$typ_poszkodowanego = '4';

if (! ($klient_poszkodowany)) {
	
	$dodaj_adres = sprawa_dodaj_adres ( $poszkodowany_ulica, $poszkodowany_nr_domu, $poszkodowany_nr_mieszkania, $poszkodowany_kod_pocztowy, $poszkodowany_miejscowosc );
	$dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
	
	$adres_kor = $dodaj_adres ['adres_id'];
	
	$dodaj_kontakt = sprawa_dodaj_kontakt ( $poszkodowany_email, $poszkodowany_tel );
	$dodaj_kontakt = mysqli_fetch_assoc ( $dodaj_kontakt );
	
	$dodaj_osobe = sprawa_dodaj_osobe ( $poszkodowany_imie, $poszkodowany_nazwisko, $poszkodowany_pesel, $poszkodowany_seria_i_numer_dowodu, $dodaj_adres ['adres_id'], $adres_kor, $dodaj_kontakt ['kontakt_id'], $typ_osoby, $czy_obcokrajowiec, $poszkodowany_dokument, $poszkodowany_numer_dokumentu, $id_osoby_dodajacej, $wiek_poszkodowanego );
	$dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
	
	$poszkodowany_id = $dodaj_osobe ['osoba_id'];
	
	$aktualizuj_poszkodowanego_sprawy = sprawa_aktualizacja ( 'sprawa_poszkodowany_id', $dodaj_osobe ['osoba_id'], $id_sprawy );
	$aktualizuj_poszkodowanego_sprawy = mysqli_fetch_assoc ( $aktualizuj_poszkodowanego_sprawy );
	
	// $aktualizuj_typ_poszkodowanego_sprawy = sprawa_aktualizacja ('sprawa_typ_poszkodowany_id', $typ_poszkodowanego, $id_sprawy);
	// $aktualizuj_typ_poszkodowanego_sprawy = mysqli_fetch_assoc ( $aktualizuj_typ_poszkodowanego_sprawy );
} else {
	$aktualizuj_poszkodowanego_sprawy = sprawa_aktualizacja ( 'sprawa_poszkodowany_id', $id_klienta, $id_sprawy );
	$aktualizuj_poszkodowanego_sprawy = mysqli_fetch_assoc ( $aktualizuj_poszkodowanego_sprawy );
}

$aktualizuj_typ_poszkodowanego = sprawa_aktualizacja ( 'sprawa_typ_poszkodowany_id', $typ_poszkodowanego, $id_sprawy );
$aktualizuj_typ_poszkodowanego = mysqli_fetch_assoc ( $aktualizuj_typ_poszkodowanego );

sprawa_aktualizuj_ostatnia_strone ( $id_sprawy, '3' );

$dane = array (
		0 => $id_sprawy,
		1 => $id_klienta,
		2 => $poszkodowany_id 
);

echo json_encode ( $dane );
