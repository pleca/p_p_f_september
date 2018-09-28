<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$kolumna_1 = 'sprawa_klient_id';
$kolumna_2 = 'sprawa_klient_2_id';
$uzytkownik = $_SESSION ['uzytkownik_id'];

$id_klienta_1 = htmlspecialchars ( $_POST ['id_klienta_1'] );
$czy_nowy_klient_1 = htmlspecialchars ( $_POST ['czy_nowy_klient_1'] );
$adres_do_korespondencji_1 = htmlspecialchars ( $_POST ['adres_do_korespondencji_1'] );
$czy_obcokrajowiec_1 = htmlspecialchars ( $_POST ['czy_obcokrajowiec_1'] );
$zleceniodawca_1_imie = htmlspecialchars ( $_POST ['zleceniodawca_1_imie'] );
$zleceniodawca_1_nazwisko = htmlspecialchars ( $_POST ['zleceniodawca_1_nazwisko'] );
$zleceniodawca_1_ulica = htmlspecialchars ( $_POST ['zleceniodawca_1_ulica'] );
$zleceniodawca_1_nr_domu = htmlspecialchars ( $_POST ['zleceniodawca_1_nr_domu'] );
$zleceniodawca_1_nr_mieszkania = htmlspecialchars ( $_POST ['zleceniodawca_1_nr_mieszkania'] );
$zleceniodawca_1_kod_pocztowy = htmlspecialchars ( $_POST ['zleceniodawca_1_kod_pocztowy'] );
$zleceniodawca_1_miejscowosc = htmlspecialchars ( $_POST ['zleceniodawca_1_miejscowosc'] );
$zleceniodawca_1_email = htmlspecialchars ( $_POST ['zleceniodawca_1_email'] );
$zleceniodawca_1_telefon = htmlspecialchars ( $_POST ['zleceniodawca_1_telefon'] );
$zleceniodawca_1_pesel = htmlspecialchars ( $_POST ['zleceniodawca_1_pesel'] );
$zleceniodawca_1_seria_i_numer_dowodu = htmlspecialchars ( $_POST ['zleceniodawca_1_seria_i_numer_dowodu'] );
$zleceniodawca_1_dokument = htmlspecialchars ( $_POST ['zleceniodawca_1_dokument'] );
$zleceniodawca_1_numer_dokumentu = htmlspecialchars ( $_POST ['zleceniodawca_1_numer_dokumentu'] );
$zleceniodawca_1_ulica_kor = htmlspecialchars ( $_POST ['zleceniodawca_1_ulica_kor'] );
$zleceniodawca_1_nr_domu_kor = htmlspecialchars ( $_POST ['zleceniodawca_1_nr_domu_kor'] );
$zleceniodawca_1_nr_mieszkania_kor = htmlspecialchars ( $_POST ['zleceniodawca_1_nr_mieszkania_kor'] );
$zleceniodawca_1_kod_pocztowy_kor = htmlspecialchars ( $_POST ['zleceniodawca_1_kod_pocztowy_kor'] );
$zleceniodawca_1_miejscowosc_kor = htmlspecialchars ( $_POST ['zleceniodawca_1_miejscowosc_kor'] );

if ($czy_nowy_klient_1 == '1') {

	$dodaj_adres = sprawa_dodaj_adres ( $zleceniodawca_1_ulica, $zleceniodawca_1_nr_domu, $zleceniodawca_1_nr_mieszkania, $zleceniodawca_1_kod_pocztowy, $zleceniodawca_1_miejscowosc );
	$dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
	
	if ($adres_do_korespondencji_1 == '1') {
		$adres_kor = $dodaj_adres ['adres_id'];
	} else {
		$dodaj_adres_kor = sprawa_dodaj_adres ( $zleceniodawca_1_ulica_kor, $zleceniodawca_1_nr_domu_kor, $zleceniodawca_1_nr_mieszkania_kor, $zleceniodawca_1_kod_pocztowy_kor, $zleceniodawca_1_miejscowosc_kor );
		$dodaj_adres_kor = mysqli_fetch_assoc ( $dodaj_adres_kor );
		$adres_kor = $dodaj_adres_kor ['adres_id'];
	}
	
	$dodaj_kontakt = sprawa_dodaj_kontakt ( $zleceniodawca_1_email, $zleceniodawca_1_telefon );
	$dodaj_kontakt = mysqli_fetch_assoc ( $dodaj_kontakt );
	
	$sprawa_typ_osoby = '1';
	
	$dodaj_osobe = sprawa_dodaj_osobe ( $zleceniodawca_1_imie, $zleceniodawca_1_nazwisko, $zleceniodawca_1_pesel, $zleceniodawca_1_seria_i_numer_dowodu, $dodaj_adres ['adres_id'], $adres_kor, $dodaj_kontakt ['kontakt_id'], $sprawa_typ_osoby, $czy_obcokrajowiec_1, $zleceniodawca_1_dokument, $zleceniodawca_1_numer_dokumentu, $uzytkownik );
	$dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
	
	$id_klienta_1 = $dodaj_osobe ['osoba_id'];
	
	$aktualizuj_klienta_sprawy = sprawa_aktualizacja ( $kolumna_1, $id_klienta_1, $id_sprawy );
	$aktualizuj_klienta_sprawy = mysqli_fetch_assoc ( $aktualizuj_klienta_sprawy );

} else if ($czy_nowy_klient_1 == '0') {

	$aktualizuj_klienta_sprawy = sprawa_aktualizacja ( $kolumna_1, $id_klienta_1, $id_sprawy );
	$aktualizuj_klienta_sprawy = mysqli_fetch_assoc ( $aktualizuj_klienta_sprawy );

}

$id_klienta_2 = htmlspecialchars ( $_POST ['id_klienta_2'] );
$czy_nowy_klient_2 = htmlspecialchars ( $_POST ['czy_nowy_klient_2'] );
$adres_do_korespondencji_2 = htmlspecialchars ( $_POST ['adres_do_korespondencji_2'] );
$czy_obcokrajowiec_2 = htmlspecialchars ( $_POST ['czy_obcokrajowiec_2'] );
$zleceniodawca_2_imie = htmlspecialchars ( $_POST ['zleceniodawca_2_imie'] );
$zleceniodawca_2_nazwisko = htmlspecialchars ( $_POST ['zleceniodawca_2_nazwisko'] );
$zleceniodawca_2_ulica = htmlspecialchars ( $_POST ['zleceniodawca_2_ulica'] );
$zleceniodawca_2_nr_domu = htmlspecialchars ( $_POST ['zleceniodawca_2_nr_domu'] );
$zleceniodawca_2_nr_mieszkania = htmlspecialchars ( $_POST ['zleceniodawca_2_nr_mieszkania'] );
$zleceniodawca_2_kod_pocztowy = htmlspecialchars ( $_POST ['zleceniodawca_2_kod_pocztowy'] );
$zleceniodawca_2_miejscowosc = htmlspecialchars ( $_POST ['zleceniodawca_2_miejscowosc'] );
$zleceniodawca_2_email = htmlspecialchars ( $_POST ['zleceniodawca_2_email'] );
$zleceniodawca_2_telefon = htmlspecialchars ( $_POST ['zleceniodawca_2_telefon'] );
$zleceniodawca_2_pesel = htmlspecialchars ( $_POST ['zleceniodawca_2_pesel'] );
$zleceniodawca_2_seria_i_numer_dowodu = htmlspecialchars ( $_POST ['zleceniodawca_2_seria_i_numer_dowodu'] );
$zleceniodawca_2_dokument = htmlspecialchars ( $_POST ['zleceniodawca_2_dokument'] );
$zleceniodawca_2_numer_dokumentu = htmlspecialchars ( $_POST ['zleceniodawca_2_numer_dokumentu'] );
$zleceniodawca_2_ulica_kor = htmlspecialchars ( $_POST ['zleceniodawca_2_ulica_kor'] );
$zleceniodawca_2_nr_domu_kor = htmlspecialchars ( $_POST ['zleceniodawca_2_nr_domu_kor'] );
$zleceniodawca_2_nr_mieszkania_kor = htmlspecialchars ( $_POST ['zleceniodawca_2_nr_mieszkania_kor'] );
$zleceniodawca_2_kod_pocztowy_kor = htmlspecialchars ( $_POST ['zleceniodawca_2_kod_pocztowy_kor'] );
$zleceniodawca_2_miejscowosc_kor = htmlspecialchars ( $_POST ['zleceniodawca_2_miejscowosc_kor'] );

if ($czy_nowy_klient_2 == '1') {
	$dodaj_adres = sprawa_dodaj_adres ( $zleceniodawca_2_ulica, $zleceniodawca_2_nr_domu, $zleceniodawca_2_nr_mieszkania, $zleceniodawca_2_kod_pocztowy, $zleceniodawca_2_miejscowosc );
	$dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
	
	if ($adres_do_korespondencji_2 == '1') {
		$adres_kor = $dodaj_adres ['adres_id'];
	} else {
		$dodaj_adres_kor = sprawa_dodaj_adres ( $zleceniodawca_2_ulica_kor, $zleceniodawca_2_nr_domu_kor, $zleceniodawca_2_nr_mieszkania_kor, $zleceniodawca_2_kod_pocztowy_kor, $zleceniodawca_2_miejscowosc_kor );
		$dodaj_adres_kor = mysqli_fetch_assoc ( $dodaj_adres_kor );
		$adres_kor = $dodaj_adres_kor ['adres_id'];
	}
	
	$dodaj_kontakt = sprawa_dodaj_kontakt ( $zleceniodawca_2_email, $zleceniodawca_2_telefon );
	$dodaj_kontakt = mysqli_fetch_assoc ( $dodaj_kontakt );
	
	$sprawa_typ_osoby = '1';
	
	$dodaj_osobe = sprawa_dodaj_osobe ( $zleceniodawca_2_imie, $zleceniodawca_2_nazwisko, $zleceniodawca_2_pesel, $zleceniodawca_2_seria_i_numer_dowodu, $dodaj_adres ['adres_id'], $adres_kor, $dodaj_kontakt ['kontakt_id'], $sprawa_typ_osoby, $czy_obcokrajowiec_2, $zleceniodawca_2_dokument, $zleceniodawca_2_numer_dokumentu, $uzytkownik );
	$dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
	
	$id_klienta_2 = $dodaj_osobe ['osoba_id'];
	
	$aktualizuj_klienta_sprawy = sprawa_aktualizacja ( $kolumna_2, $id_klienta_2, $id_sprawy );
	$aktualizuj_klienta_sprawy = mysqli_fetch_assoc ( $aktualizuj_klienta_sprawy );
} else if ($czy_nowy_klient_1 == '0') {
	$aktualizuj_klienta_sprawy = sprawa_aktualizacja ( $kolumna_2, $id_klienta_2, $id_sprawy );
	$aktualizuj_klienta_sprawy = mysqli_fetch_assoc ( $aktualizuj_klienta_sprawy );
}

$dane = array (
		0 => $id_sprawy,
		1 => $id_klienta_1,
		2 => $id_klienta_2,
        3 => $czy_nowy_klient_1
);

echo json_encode ( $dane );
