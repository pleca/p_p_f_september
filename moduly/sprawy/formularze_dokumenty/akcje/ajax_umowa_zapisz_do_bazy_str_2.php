<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$id_klienta = htmlspecialchars($_POST['id_klienta']);
$id_sprawy = htmlspecialchars($_POST['id_sprawy']);
$kolumna = 'sprawa_klient_id';

$uzytkownik = $_SESSION['uzytkownik_id'];
$czy_nowy_klient = htmlspecialchars($_POST['czy_nowy_klient']);
$czy_obcokrajowiec = htmlspecialchars($_POST['czy_obcokrajowiec']);
$adres_do_korespondencji = htmlspecialchars($_POST['adres_do_korespondencji']);
$zleceniodawca_imie = htmlspecialchars($_POST['zleceniodawca_imie']);
$zleceniodawca_nazwisko = htmlspecialchars($_POST['zleceniodawca_nazwisko']);
$zleceniodawca_ulica = htmlspecialchars($_POST['zleceniodawca_ulica']);
$zleceniodawca_nr_domu = htmlspecialchars($_POST['zleceniodawca_nr_domu']);
$zleceniodawca_nr_mieszkania = htmlspecialchars($_POST['zleceniodawca_nr_mieszkania']);
$zleceniodawca_kod_pocztowy = htmlspecialchars($_POST['zleceniodawca_kod_pocztowy']);
$zleceniodawca_miejscowosc = htmlspecialchars($_POST['zleceniodawca_miejscowosc']);
$zleceniodawca_email = htmlspecialchars($_POST['zleceniodawca_email']);
$zleceniodawca_telefon = htmlspecialchars($_POST['zleceniodawca_telefon']);
$zleceniodawca_pesel = htmlspecialchars($_POST['zleceniodawca_pesel']);
$zleceniodawca_seria_i_numer_dowodu = strtoupper(htmlspecialchars($_POST['zleceniodawca_seria_i_numer_dowodu']));
$zleceniodawca_dokument = htmlspecialchars($_POST['zleceniodawca_dokument']);
$zleceniodawca_numer_dokumentu = htmlspecialchars($_POST['zleceniodawca_numer_dokumentu']);
$zleceniodawca_ulica_kor = htmlspecialchars($_POST['zleceniodawca_ulica_kor']);
$zleceniodawca_nr_domu_kor = htmlspecialchars($_POST['zleceniodawca_nr_domu_kor']);
$zleceniodawca_nr_mieszkania_kor = htmlspecialchars($_POST['zleceniodawca_nr_mieszkania_kor']);
$zleceniodawca_kod_pocztowy_kor = htmlspecialchars($_POST['zleceniodawca_kod_pocztowy_kor']);
$zleceniodawca_miejscowosc_kor = htmlspecialchars($_POST['zleceniodawca_miejscowosc_kor']);

$zleceniodawca_ulica_kor_obecnego = htmlspecialchars($_POST['zleceniodawca_ulica_kor_obecnego']);
$zleceniodawca_nr_domu_kor_obecnego = htmlspecialchars($_POST['zleceniodawca_nr_domu_kor_obecnego']);
$zleceniodawca_nr_mieszkania_kor_obecnego = htmlspecialchars($_POST['zleceniodawca_nr_mieszkania_kor_obecnego']);
$zleceniodawca_kod_pocztowy_kor_obecnego = htmlspecialchars($_POST['zleceniodawca_kod_pocztowy_kor_obecnego']);
$zleceniodawca_miejscowosc_kor_obecnego = htmlspecialchars($_POST['zleceniodawca_miejscowosc_kor_obecnego']);
$czy_obecny_adres_przepisac = htmlspecialchars($_POST['czy_obecny_adres_przepisac']);

if (! empty ( $zleceniodawca_pesel )) {
    $rok = substr ( $zleceniodawca_pesel, 0, 2 );
    $miesiac = substr ( $zleceniodawca_pesel, 2, - 7 );
    $dzien = substr ( $zleceniodawca_pesel, 4, - 5 );

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

    $wiek_zleceniodawcy = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok * 12) + $miesiac)) / 12 );
}





if ($czy_nowy_klient==1) {
    
    $dodaj_adres = sprawa_dodaj_adres($zleceniodawca_ulica, $zleceniodawca_nr_domu, $zleceniodawca_nr_mieszkania, $zleceniodawca_kod_pocztowy, $zleceniodawca_miejscowosc);
    $dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
    
    if ($adres_do_korespondencji==1){
        $adres_kor = $dodaj_adres['adres_id'];
    } else {
        $dodaj_adres_kor = sprawa_dodaj_adres($zleceniodawca_ulica_kor, $zleceniodawca_nr_domu_kor, $zleceniodawca_nr_mieszkania_kor, $zleceniodawca_kod_pocztowy_kor, $zleceniodawca_miejscowosc_kor);
        $dodaj_adres_kor = mysqli_fetch_assoc ( $dodaj_adres_kor );
        $adres_kor = $dodaj_adres_kor['adres_id'];
    }
    
    $dodaj_kontakt = sprawa_dodaj_kontakt ($zleceniodawca_email, $zleceniodawca_telefon); 
    $dodaj_kontakt = mysqli_fetch_assoc ( $dodaj_kontakt );
    
    $sprawa_typ_osoby = 1;
    
    $dodaj_osobe = sprawa_dodaj_osobe ($zleceniodawca_imie, $zleceniodawca_nazwisko, $zleceniodawca_pesel, $zleceniodawca_seria_i_numer_dowodu, $dodaj_adres['adres_id'], $adres_kor, $dodaj_kontakt['kontakt_id'], $sprawa_typ_osoby, $czy_obcokrajowiec, $zleceniodawca_dokument, $zleceniodawca_numer_dokumentu, $uzytkownik, $wiek_zleceniodawcy);
    $dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
    
    $id_klienta = $dodaj_osobe['osoba_id'];
    
    $aktualizuj_klienta_sprawy = sprawa_aktualizacja ($kolumna, $id_klienta, $id_sprawy); 
    $aktualizuj_klienta_sprawy = mysqli_fetch_assoc ( $aktualizuj_klienta_sprawy );
    
    } else {

    if ($czy_obecny_adres_przepisac == 0) {
        $dodaj_adres_kor = sprawa_dodaj_adres($zleceniodawca_ulica_kor_obecnego, $zleceniodawca_nr_domu_kor_obecnego, $zleceniodawca_nr_mieszkania_kor_obecnego, $zleceniodawca_kod_pocztowy_kor_obecnego, $zleceniodawca_miejscowosc_kor_obecnego);
        $dodaj_adres_kor = mysqli_fetch_assoc ( $dodaj_adres_kor );
        $adres_kor = $dodaj_adres_kor['adres_id'];

        aktualizuj_pojedyncze_pole('sprawa_osoba', 'sprawa_adres_korespondencja_id', $adres_kor, $id_klienta);
    }

    $aktualizuj_klienta_sprawy = sprawa_aktualizacja ($kolumna, $id_klienta, $id_sprawy); 
    $aktualizuj_klienta_sprawy = mysqli_fetch_assoc ( $aktualizuj_klienta_sprawy );
    
    }
 
    sprawa_aktualizuj_ostatnia_strone($id_sprawy, '2');
    
$dane = array(
		0 => $id_sprawy,
        1 => $id_klienta
);

echo json_encode($dane);
