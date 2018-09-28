<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$uprawniony_imie = htmlspecialchars ( $_POST ['uprawniony_imie'] );
$uprawniony_nazwisko = htmlspecialchars ( $_POST ['uprawniony_nazwisko'] );
$uprawniony_ulica = htmlspecialchars ( $_POST ['uprawniony_ulica'] );
$uprawniony_nr_domu = htmlspecialchars ( $_POST ['uprawniony_nr_domu'] );
$uprawniony_nr_mieszkania = htmlspecialchars ( $_POST ['uprawniony_nr_mieszkania'] );
$uprawniony_kod_pocztowy = htmlspecialchars ( $_POST ['uprawniony_kod_pocztowy'] );
$uprawniony_miejscowosc = htmlspecialchars ( $_POST ['uprawniony_miejscowosc'] );
$uprawniony_pesel = htmlspecialchars ( $_POST ['uprawniony_pesel'] );
$uprawniony_seria_i_numer_dowodu = strtoupper ( htmlspecialchars ( $_POST ['uprawniony_seria_i_numer_dowodu'] ) );
$uprawniony_email = htmlspecialchars ( $_POST ['uprawniony_email'] );
$uprawniony_telefon = htmlspecialchars ( $_POST ['uprawniony_telefon'] );
$uprawniony_informacje_imie = htmlspecialchars ( $_POST ['uprawniony_informacje_imie'] );
$uprawniony_informacje_nazwisko = htmlspecialchars ( $_POST ['uprawniony_informacje_nazwisko'] );
$uprawniony_informacje_pesel = htmlspecialchars ( $_POST ['uprawniony_informacje_pesel'] );
$uprawniony_dokument = htmlspecialchars ( $_POST ['uprawniony_dokument'] );
$uprawniony_numer_dokumentu = htmlspecialchars ( $_POST ['uprawniony_numer_dokumentu'] );
$inny_uprawniony = htmlspecialchars ( $_POST ['inny_uprawniony'] );
$uprawniony_do_inf = htmlspecialchars ( $_POST ['uprawniony_do_inf'] );
$id_osoby_dodajacej = $_SESSION ['uzytkownik_id'];
$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$id_klienta = htmlspecialchars ( $_POST ['id_klienta'] );
$czy_obcokrajowiec = htmlspecialchars ( $_POST ['czy_obcokrajowiec'] );

if (! empty ( $uprawniony_pesel )) {
    $rok = substr ( $uprawniony_pesel, 0, 2 );
    $miesiac = substr ( $uprawniony_pesel, 2, - 7 );
    $dzien = substr ( $uprawniony_pesel, 4, - 5 );

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

    $wiek_uprawnionego = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok * 12) + $miesiac)) / 12 );
}

if ($inny_uprawniony == 1) {
	
	$typ_osoby = '3';
	
	$dodaj_adres = sprawa_dodaj_adres ( $uprawniony_ulica, $uprawniony_nr_domu, $uprawniony_nr_mieszkania, $uprawniony_kod_pocztowy, $uprawniony_miejscowosc );
	$dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
	
	$dodaj_kontakt = sprawa_dodaj_kontakt ( $uprawniony_email, $uprawniony_telefon );
	$dodaj_kontakt = mysqli_fetch_assoc ( $dodaj_kontakt );
	
	$dodaj_osobe = sprawa_dodaj_osobe ( $uprawniony_imie, $uprawniony_nazwisko, $uprawniony_pesel, $uprawniony_seria_i_numer_dowodu, $dodaj_adres ['adres_id'], $dodaj_adres ['adres_id'], $dodaj_kontakt ['kontakt_id'], $typ_osoby, $czy_obcokrajowiec, $uprawniony_dokument, $uprawniony_numer_dokumentu, $id_osoby_dodajacej, $wiek_uprawnionego );
	$dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
	
	$aktualizuj_uprawnionego_sprawy = sprawa_aktualizacja ( 'sprawa_uprawniony_id', $dodaj_osobe ['osoba_id'], $id_sprawy );
	$aktualizuj_uprawnionego_sprawy = mysqli_fetch_assoc ( $aktualizuj_uprawnionego_sprawy );
	
	$uprawniony_id = $dodaj_osobe ['osoba_id'];
}  /* KAMYK - MEDYK - z jakiej racji wrzuciłeś domyslnie uprawnionego jako klienta?! */
else if ($inny_uprawniony == 0) {
	
	$aktualizuj_uprawnionego_sprawy = sprawa_aktualizacja ( 'sprawa_uprawniony_id', $id_klienta, $id_sprawy );
	$aktualizuj_uprawnionego_sprawy = mysqli_fetch_assoc ( $aktualizuj_uprawnionego_sprawy );
	
	$uprawniony_id = $id_klienta;
}
/* */
if ($uprawniony_do_inf == 1) {
	
	$typ_osoby = '4';
	
	$dodaj_osobe = sprawa_dodaj_osobe ( $uprawniony_informacje_imie, $uprawniony_informacje_nazwisko, $uprawniony_informacje_pesel, '', '', '', '', $typ_osoby, '', '', '', $id_osoby_dodajacej );
	$dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
	
	$aktualizuj_uprawnionego_do_inf_sprawy = sprawa_aktualizacja ( 'sprawa_uprawniony_do_inf_id', $dodaj_osobe ['osoba_id'], $id_sprawy );
	$aktualizuj_uprawnionego_do_inf_sprawy = mysqli_fetch_assoc ( $aktualizuj_uprawnionego_do_inf_sprawy );
}

sprawa_aktualizuj_ostatnia_strone ( $id_sprawy, '4' );

$dane = array (
		0 => $id_sprawy,
		1 => $uprawniony_id 
);

echo json_encode ( $dane );
