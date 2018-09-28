<?php 
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$uzytkownik = $_SESSION['uzytkownik_id'];
$zleceniodawca_imie = htmlspecialchars($_POST['zleceniodawca_imie']);
$zleceniodawca_nazwisko = htmlspecialchars($_POST['zleceniodawca_nazwisko']);
$zleceniodawca_nr_domu = htmlspecialchars($_POST['zleceniodawca_nr_domu']);
$zleceniodawca_nr_mieszkania = htmlspecialchars($_POST['zleceniodawca_nr_mieszkania']);
$zleceniodawca_kod_pocztowy = htmlspecialchars($_POST['zleceniodawca_kod_pocztowy']);
$zleceniodawca_miejscowosc = htmlspecialchars($_POST['zleceniodawca_miejscowosc']);
$zleceniodawca_pesel = htmlspecialchars($_POST['zleceniodawca_pesel']);
$zleceniodawca_seria_i_numer_dowodu = strtoupper(htmlspecialchars($_POST['zleceniodawca_seria_i_numer_dowodu']));
$zleceniodawca_email = htmlspecialchars($_POST['zleceniodawca_email']);
$zleceniodawca_telefon = htmlspecialchars($_POST['zleceniodawca_telefon']);
$zleceniodawca_ulica = htmlspecialchars($_POST['zleceniodawca_ulica']);



if(empty($zleceniodawca_imie) OR empty($zleceniodawca_nazwisko) OR empty($zleceniodawca_nr_domu) 
		OR empty($zleceniodawca_nr_mieszkania) OR empty($zleceniodawca_kod_pocztowy) OR empty($zleceniodawca_miejscowosc) OR empty($zleceniodawca_email) OR
		empty($zleceniodawca_telefon) ){
	$dane = array(
			0 => '0'
	);
}else{
	
    $dodaj_adres = sprawa_dodaj_adres($zleceniodawca_ulica, $zleceniodawca_nr_domu, $zleceniodawca_nr_mieszkania, $zleceniodawca_kod_pocztowy, $zleceniodawca_miejscowosc);
    $dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
    
    $dodaj_kontakt = sprawa_dodaj_kontakt ($zleceniodawca_email, $zleceniodawca_telefon); 
    $dodaj_kontakt = mysqli_fetch_assoc ( $dodaj_kontakt );
    
    $sprawa_typ_osoby = 1;
    
    $dodaj_osobe = sprawa_dodaj_osobe ($zleceniodawca_imie, $zleceniodawca_nazwisko, $zleceniodawca_pesel, $zleceniodawca_seria_i_numer_dowodu, $dodaj_adres['adres_id'], $dodaj_adres['adres_id'], $dodaj_kontakt['kontakt_id'], $sprawa_typ_osoby, $czy_obcokrajowiec, $zleceniodawca_dokument, $zleceniodawca_numer_dokumentu, $uzytkownik); 
    $dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
	
	$dane = array(
			0 => '1'
	);
}

echo json_encode($dane);