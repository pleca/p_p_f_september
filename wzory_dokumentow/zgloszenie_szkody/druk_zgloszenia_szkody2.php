<?php
// session_start ();
?>

<link rel="stylesheet"
	href="<?php  echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/zgloszenie_szkody.css'; ?>"
	type="text/css" />

<?php

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'funkcje_glowne.php');

$id_sprawy = $_POST ['id_sprawy'];
$uzytkownik_id = $_POST ['uzytkownik_id'];

// (isset ( $_POST ['id_sprawy'] )) ? $id_sprawy = $_POST ['id_sprawy'] : $id_sprawy = $_GET ['id_sprawy'];
// (isset ( $_POST ['uzytkownik_id'] )) ? $uzytkownik_id = $_POST ['uzytkownik_id'] : $uzytkownik_id = $_GET ['uzytkownik_id'];
// (isset ( $_POST ['id_umowy'] )) ? $id_umowy = $_POST ['id_umowy'] : $id_umowy = $_GET ['id_umowy'];
// (isset ( $_POST ['potwierdzenie'] )) ? $potwierdzenie = $_POST ['potwierdzenie'] : $potwierdzenie = $_GET ['potwierdzenie'];

$id_sprawy = 0;
$uzytkownik_id = 0;
$potwierdzenie = 0;

$dane_uzytkownika = uzytkownik_pobierz_po_id ( $uzytkownik_id );

(isset ( $_POST ['uzytkownik_login'] )) ? $login = $_POST ['uzytkownik_login'] : $login = $dane_uzytkownika ['login'];

$numer_stopka = 'PG-2-1-F1/2015-04-01';

$sprawa = sprawa_pobierz_dane_sprawy ( $id_sprawy );
function sprawdz_date($pole) {
	if ($pole == '0000-00-00') {
		$pole = '';
	} else {
		$pole = $pole;
	}
	return $pole;
	;
}
function kratki($zmienna) {
	if ($zmienna == 1) {
		echo 'X';
	} else if ($zmienna = 0) {
		echo '';
	}
}

if ($sprawa ['sprawa_typ_szkody_id'] == '1') {
	$typ_szkody = 'obrażenia ciała';
} else if ($sprawa ['sprawa_typ_szkody_id'] == '2') {
	$typ_szkody = 'śmierć poszkodowanego';
} else if ($sprawa ['sprawa_typ_szkody_id'] == '3') {
	$typ_szkody = 'inny';
}

if ($sprawa ['sprawa_rodzaj_wypadku_id'] == '1') {
	$rodzaj_wypadku = 'komunikacyjny';
} else if ($sprawa ['sprawa_rodzaj_wypadku_id'] == '2') {
	$rodzaj_wypadku = 'w rolnictwie';
} else if ($sprawa ['sprawa_rodzaj_wypadku_id'] == '3') {
	$rodzaj_wypadku = 'inny';
}

$id_zleceniodawcy = sprawa_pobierz_id_z_tabeli_sprawa ( $id_sprawy, 'sprawa_klient_id' );
$id_poszkodowanego = sprawa_pobierz_id_z_tabeli_sprawa ( $id_sprawy, 'sprawa_poszkodowany_id' );
$id_uprawnionego = sprawa_pobierz_id_z_tabeli_sprawa ( $id_sprawy, 'sprawa_uprawniony_id' );
$id_uprawnionego_tel = sprawa_pobierz_id_z_tabeli_sprawa ( $id_sprawy, 'sprawa_uprawniony_do_inf_id' );
$id_zdarzenia = sprawa_pobierz_id_z_tabeli_sprawa ( $id_sprawy, 'sprawa_zdarzenie_id' );

$zleceniodawca = sprawa_pobierz_dane_osoby ( $id_zleceniodawcy );
$poszkodowany = sprawa_pobierz_dane_osoby ( $id_poszkodowanego );
$uprawniony = sprawa_pobierz_dane_osoby ( $id_uprawnionego );
$uprawniony_tel = sprawa_pobierz_dane_osoby ( $id_uprawnionego_tel );
$zdarzenie = sprawa_pobierz_dane_z_tabeli_zdarzenie ( $id_zdarzenia );

$adres_zleceniodawcy = sprawa_pobierz_adres ( $zleceniodawca ['sprawa_adres_zameldowania_id'] );
$kontakt_zleceniodawcy = sprawa_pobierz_kontakt ( $zleceniodawca ['sprawa_kontakt_id'] );

$adres_poszkodowany = sprawa_pobierz_adres ( $poszkodowany ['sprawa_adres_zameldowania_id'] );
$kontakt_poszkodowany = sprawa_pobierz_kontakt ( $poszkodowany ['sprawa_kontakt_id'] );

$adres_uprawniony = sprawa_pobierz_adres ( $uprawniony ['sprawa_adres_zameldowania_id'] );
$kontakt_uprawniony = sprawa_pobierz_kontakt ( $uprawniony ['sprawa_kontakt_id'] );

$adres_kor_zleceniodawcy = sprawa_pobierz_adres ( $zleceniodawca ['sprawa_adres_korespondencja_id'] );

$obrazenia_opis = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_obrazenia', $sprawa ['sprawa_obrazenia_id'] );

if (! empty ( $zleceniodawca ['pesel'] )) {
	
	/*
	 * $urodziny = new DateTime ( implode ( '-', array (
	 * ( int ) substr ( $zleceniodawca ['pesel'], 0, 2 ) + 1800 + (((floor ( (( int ) $zleceniodawca ['pesel'] {2}) / 2 ) + 1) % 5) * 100),
	 * substr ( $zleceniodawca ['pesel'], 2, 2 ),
	 * substr ( $zleceniodawca ['pesel'], 4, 2 )
	 * ) ) );
	 *
	 * $rok_urodzenia = $urodziny->format ( 'Y' );
	 * $dzsiaj_rok = date ( 'Y' );
	 * $miesiac_urodzenia = $urodziny->format ( 'm' );
	 * $dzsiaj_miesiac = date ( 'm' );
	 *
	 * $wiek_zleceniodawcy = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok_urodzenia * 12) + $miesiac_urodzenia)) / 12 );
	 */
	
	$rok = substr ( $zleceniodawca ['pesel'], 0, 2 );
	$miesiac = substr ( $zleceniodawca ['pesel'], 2, - 7 );
	$dzien = substr ( $zleceniodawca ['pesel'], 4, - 5 );
	
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
$zleceniodawca_wiek = $wiek_zleceniodawcy;
$zleceniodawca_nazwisko = $zleceniodawca ['nazwisko'];
$zleceniodawca_imie = $zleceniodawca ['imie'];
$zleceniodawca_ulica = $adres_zleceniodawcy ['ulica'];
$zleceniodawca_dom = $adres_zleceniodawcy ['nr_domu'];
$zleceniodawca_mieszkanie = $adres_zleceniodawcy ['nr_mieszkania'];
$zleceniodawca_kod = $adres_zleceniodawcy ['kod_pocztowy'];
$zleceniodawca_miejscowosc = $adres_zleceniodawcy ['miasto'];

if ($adres_zleceniodawcy == $adres_kor_zleceniodawcy) {
	$zleceniodawca_kor_ulica = '';
	$zleceniodawca_kor_dom = '';
	$zleceniodawca_kor_mieszkanie = '';
	$zleceniodawca_kor_kod = '';
	$zleceniodawca_kor_miejscowosc = '';
} else {
	$zleceniodawca_kor_ulica = $adres_kor_zleceniodawcy ['ulica'];
	$zleceniodawca_kor_dom = $adres_kor_zleceniodawcy ['nr_domu'];
	$zleceniodawca_kor_mieszkanie = $adres_kor_zleceniodawcy ['nr_mieszkania'];
	$zleceniodawca_kor_kod = $adres_kor_zleceniodawcy ['kod_pocztowy'];
	$zleceniodawca_kor_miejscowosc = $adres_kor_zleceniodawcy ['miasto'];
}

$zleceniodawca_obcokrajowiec = $zleceniodawca ['czy_obcokrajowiec'];
$zleceniodawca_pesel = $zleceniodawca ['pesel'];
$zleceniodawca_dowod = $zleceniodawca ['dowod'];
$zleceniodawca_dokument = $zleceniodawca ['rodzaj_dokumentu'];
$zleceniodawca_nr_dokumentu = $zleceniodawca ['nr_dokumentu'];

if ($zleceniodawca_obcokrajowiec == 1) {
	$zleceniodawca_pesel_dokument = $zleceniodawca_dokument;
	$zleceniodawca_dowod_nr_dokumentu = $zleceniodawca_nr_dokumentu;
} else if ($zleceniodawca_obcokrajowiec == 0) {
	$zleceniodawca_pesel_dokument = $zleceniodawca_pesel;
	$zleceniodawca_dowod_nr_dokumentu = $zleceniodawca_dowod;
}

$zleceniodawca_telefon = $kontakt_zleceniodawcy ['telefon'];
$zleceniodawca_email = $kontakt_zleceniodawcy ['email'];

if (! empty ( $poszkodowany ['pesel'] )) {
	
	$rok = substr ( $poszkodowany ['pesel'], 0, 2 );
	$miesiac = substr ( $poszkodowany ['pesel'], 2, - 7 );
	$dzien = substr ( $poszkodowany ['pesel'], 4, - 5 );
	
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
	
	/*
	 * $urodziny = new DateTime ( implode ( '-', array (
	 * ( int ) substr ( $poszkodowany ['pesel'], 0, 2 ) + 1800 + (((floor ( (( int ) $poszkodowany ['pesel'] {2}) / 2 ) + 1) % 5) * 100),
	 * substr ( $poszkodowany ['pesel'], 2, 2 ),
	 * substr ( $poszkodowany ['pesel'], 4, 2 )
	 * ) ) );
	 *
	 * $rok_urodzenia = $urodziny->format ( 'Y' );
	 * $dzsiaj_rok = date ( 'Y' );
	 * $miesiac_urodzenia = $urodziny->format ( 'm' );
	 * $dzsiaj_miesiac = date ( 'm' );
	 *
	 * $wiek_poszkodowanego = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok_urodzenia * 12) + $miesiac_urodzenia)) / 12 );
	 */
}

$poszkodowany_wiek = $wiek_poszkodowanego;
$poszkodowany_nazwisko = $poszkodowany ['nazwisko'];
$poszkodowany_imie = $poszkodowany ['imie'];
$poszkodowany_ulica = $adres_poszkodowany ['ulica'];
$poszkodowany_dom = $adres_poszkodowany ['nr_domu'];
$poszkodowany_mieszkanie = $adres_poszkodowany ['nr_mieszkania'];
$poszkodowany_kod = $adres_poszkodowany ['kod_pocztowy'];
$poszkodowany_miejscowosc = $adres_poszkodowany ['miasto'];
$poszkodowany_telefon = $kontakt_poszkodowany ['telefon'];
$poszkodowany_email = $kontakt_poszkodowany ['email'];
$poszkodowany_obcokrajowiec = $poszkodowany ['czy_obcokrajowiec'];
$poszkodowany_pesel = $poszkodowany ['pesel'];
$poszkodowany_dowod = $poszkodowany ['dowod'];
$poszkodowany_dokument = $poszkodowany ['rodzaj_dokumentu'];
$poszkodowany_nr_dokumentu = $poszkodowany ['nr_dokumentu'];

if ($poszkodowany_obcokrajowiec == 1) {
	$poszkodowany_pesel_dokument = $poszkodowany_dokument;
	$poszkodowany_dowod_nr_dokumentu = $poszkodowany_nr_dokumentu;
} else if ($poszkodowany_obcokrajowiec == 0) {
	$poszkodowany_pesel_dokument = $poszkodowany_pesel;
	$poszkodowany_dowod_nr_dokumentu = $poszkodowany_dowod;
}

if ($sprawa ['sprawa_typ_poszkodowany_id'] == 1) {
	$poszkodowany_maloletni = 'X';
	$poszkodowany_ubezwlasnowolniony = '';
	$poszkodowany_malzonek = '';
	$poszkodowany_zmarly = '';
} else if ($sprawa ['sprawa_typ_poszkodowany_id'] == 2) {
	$poszkodowany_maloletni = '';
	$poszkodowany_ubezwlasnowolniony = 'X';
	$poszkodowany_malzonek = '';
	$poszkodowany_zmarly = '';
} else if ($sprawa ['sprawa_typ_poszkodowany_id'] == 3) {
	$poszkodowany_maloletni = '';
	$poszkodowany_ubezwlasnowolniony = '';
	$poszkodowany_malzonek = 'X';
	$poszkodowany_zmarly = '';
} else if ($sprawa ['sprawa_typ_poszkodowany_id'] == 4) {
	$poszkodowany_maloletni = '';
	$poszkodowany_ubezwlasnowolniony = '';
	$poszkodowany_malzonek = '';
	$poszkodowany_zmarly = 'X';
}

if ($id_zleceniodawcy == $id_uprawnionego) {
	
	$uprawniony_wiek = '';
	$uprawniony_nazwisko = '';
	$uprawniony_imie = '';
	$uprawniony_ulica = '';
	$uprawniony_dom = '';
	$uprawniony_mieszkanie = '';
	$uprawniony_kod = '';
	$uprawniony_miejscowosc = '';
	$uprawniony_pesel = '';
	$uprawniony_telefon = '';
	$uprawniony_email = '';
	$uprawniony_dowod = '';
} else {
	
	if (! empty ( $uprawniony ['pesel'] )) {
		
		/*
		 * $urodziny = new DateTime ( implode ( '-', array (
		 * ( int ) substr ( $uprawniony ['pesel'], 0, 2 ) + 1800 + (((floor ( (( int ) $uprawniony ['pesel'] {2}) / 2 ) + 1) % 5) * 100),
		 * substr ( $uprawniony ['pesel'], 2, 2 ),
		 * substr ( $uprawniony ['pesel'], 4, 2 )
		 * ) ) );
		 *
		 * $rok_urodzenia = $urodziny->format ( 'Y' );
		 * $dzsiaj_rok = date ( 'Y' );
		 * $miesiac_urodzenia = $urodziny->format ( 'm' );
		 * $dzsiaj_miesiac = date ( 'm' );
		 *
		 * $wiek_uprawnionego = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok_urodzenia * 12) + $miesiac_urodzenia)) / 12 );
		 */
		
		$rok = substr ( $uprawniony ['pesel'], 0, 2 );
		$miesiac = substr ( $uprawniony ['pesel'], 2, - 7 );
		$dzien = substr ( $uprawniony ['pesel'], 4, - 5 );
		
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
	
	$uprawniony_wiek = $uprawniony ['wiek'];
	$uprawniony_nazwisko = $uprawniony ['nazwisko'];
	$uprawniony_imie = $uprawniony ['imie'];
	$uprawniony_ulica = $adres_uprawniony ['ulica'];
	$uprawniony_dom = $adres_uprawniony ['nr_domu'];
	$uprawniony_mieszkanie = $adres_uprawniony ['nr_mieszkania'];
	$uprawniony_kod = $adres_uprawniony ['kod_pocztowy'];
	$uprawniony_miejscowosc = $adres_uprawniony ['miasto'];
	$uprawniony_telefon = $kontakt_uprawniony ['telefon'];
	$uprawniony_email = $kontakt_uprawniony ['email'];
	$uprawniony_obcokrajowiec = $uprawniony ['czy_obcokrajowiec'];
	$uprawniony_pesel = $uprawniony ['pesel'];
	$uprawniony_dowod = $uprawniony ['dowod'];
	$uprawniony_dokument = $uprawniony ['rodzaj_dokumentu'];
	$uprawniony_nr_dokumentu = $uprawniony ['nr_dokumentu'];
	
	if ($uprawniony_obcokrajowiec == 1) {
		$uprawniony_pesel_dokument = $uprawniony_dokument;
		$uprawniony_dowod_nr_dokumentu = $uprawniony_nr_dokumentu;
	} else if ($uprawniony_obcokrajowiec == 0) {
		$uprawniony_pesel_dokument = $uprawniony_pesel;
		$uprawniony_dowod_nr_dokumentu = $uprawniony_dowod;
	}
}

$uprawniony_tel_imie = $uprawniony_tel ['imie'];
$uprawniony_tel_nazwisko = $uprawniony_tel ['nazwisko'];
$uprawniony_tel_pesel = $uprawniony_tel ['pesel'];

$zdarzenie_data = $zdarzenie ['data'];
$zdarzenie_godzina = $zdarzenie ['godzina'];
$zdarzenie_miejsce = $zdarzenie ['miejsce'];

$id_pojazdu_a = $zdarzenie ['pojazd_a_id'];
$id_pojazdu_b = $zdarzenie ['pojazd_b_id'];

if ($id_pojazdu_a != NULL) {
	$pojazd_a = sprawa_pobierz_dane_pojazdu ( $id_pojazdu_a );
	$pojazd_a_marka = $pojazd_a ['marka'];
	$pojazd_a_typ = $pojazd_a ['typ_pojazdu'];
	$pojazd_a_rejestracja = $pojazd_a ['nr_rejestracyjny'];
	$pojazd_a_kraj = $pojazd_a ['kraj_rejestracji'];
	$pojazd_a_kierujacy = $pojazd_a ['kierujacy'];
	$pojazd_a_posaidacz = $pojazd_a ['posiadacz'];
	$pojazd_a_ubezpieczyciel = $pojazd_a ['ubezpieczyciel'];
	$pojazd_a_oc = $pojazd_a ['nr_oc'];
}

if ($id_pojazdu_b != NULL) {
	$pojazd_b = sprawa_pobierz_dane_pojazdu ( $id_pojazdu_b );
	$pojazd_b_marka = $pojazd_b ['marka'];
	$pojazd_b_typ = $pojazd_b ['typ_pojazdu'];
	$pojazd_b_rejestracja = $pojazd_b ['nr_rejestracyjny'];
	$pojazd_b_kraj = $pojazd_b ['kraj_rejestracji'];
	$pojazd_b_kierujacy = $pojazd_b ['kierujacy'];
	$pojazd_b_posaidacz = $pojazd_b ['posiadacz'];
	$pojazd_b_ubezpieczyciel = $pojazd_b ['ubezpieczyciel'];
	$pojazd_b_oc = $pojazd_b ['nr_oc'];
}

$id_opis_zdarzenia = $sprawa ['sprawa_opis_id'];
$opis_zdarzenia = sprawa_pobierz_opis_zdarzenia ( $id_opis_zdarzenia );
$opis_zdarzenia_tekst = $opis_zdarzenia ['wartosc'];

$id_odpowiedzialnosc_karna = $sprawa ['odpowiedzialnosc_karna_id'];
$odpowiedzialnosc_karna = sprawa_pobierz_odpowiedzialnosc_karna ( $id_odpowiedzialnosc_karna );

$id_odpowiedzialnosc_cywilna = $sprawa ['odpowiedzialnosc_cywilna_id'];
$odpowiedzialnosc_cywilna = sprawa_pobierz_odpowiedzialnosc_cywilna ( $id_odpowiedzialnosc_cywilna );

$id_inne_odszkodowania = $sprawa ['sprawa_inne_odszkodowania_id'];
$inne_odszkodowania = sprawa_pobierz_inne_odszkodowania ( $id_inne_odszkodowania );

$id_dochodzenie_roszczen = $sprawa ['sprawa_dochodzenie_roszczen_id'];
$dochodzenie_roszczen = sprawa_pobierz_dochodzenie_roszczen ( $id_dochodzenie_roszczen );

$id_stosunki_rodzinne = $sprawa ['sprawa_stosunki_rodzinne_id'];
$stosunki_rodzinne = sprawa_pobierz_stosunki_rodzinne ( $id_stosunki_rodzinne );

$id_sytuacja_rodziny = $sprawa ['sprawa_sytuacja_rodziny_id'];
$sytuacja_rodziny = sprawa_pobierz_sytuacja_rodziny ( $id_sytuacja_rodziny );

$id_utrzymanie = $stosunki_rodzinne ['sprawa_utrzymanie_id'];
$utrzymanie = sprawa_pobierz_utrzymanie ( $id_utrzymanie );

$id_porady = $sytuacja_rodziny ['sprawa_porady_id'];
$porady = sprawa_pobierz_porady ( $id_porady );

$id_zamieszkanie = $stosunki_rodzinne ['sprawa_stosunki_mieszkaniowe_id'];
$zamieszkanie = sprawa_pobierz_stosunki_mieszkaniowe ( $id_zamieszkanie );

$id_oswiadczenia = $sprawa ['sprawa_oswiadczenie_id'];
$oswiadczenie = sprawa_pobierz_oswiadczenie ( $id_oswiadczenia );

if ($potwierdzenie == '1') {
	$znak_wodny = '<div class="strona_znak_wodny">POTWIERDZENIE ZAMÓWIENIA</div>';
}

/* medyk 14-09-2016 */
$oswiadczenie_poszkodowanego = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_oswiadczenie_poszkodowanego', $sprawa ['sprawa_oswiadczenie_poszkodowanego_id'] );
$leczenie = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_leczenie', $sprawa ['sprawa_leczenie_id'] );
$przebieg_leczenia = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_przebieg_leczenia', $sprawa ['sprawa_przebieg_leczenia_id'] );

if ($sprawa ['sprawa_typ_szkody_id'] == '1') {
	
	$poczatek_zwolnienia = ($leczenie ['data_pocz_zw'] == '0000-00-00') ? '' : $leczenie ['data_pocz_zw'];
	$koniec_zwolnienia = ($leczenie ['data_kon_zw'] == '0000-00-00') ? 'do chwili obecnej.' : 'do dnia ' . $leczenie ['data_kon_zw'];
} else if ($sprawa ['sprawa_typ_szkody_id'] == '2') {
	
	$poczatek_zwolnienia = '__';
	$koniec_zwolnienia = 'do dnia __';
}
/* */
?>

<div class="strona strona_4">
	<?php echo $znak_wodny; ?>
    <div class="element">
		<div class="id_przedstawiciela margin_r_20 pogrubienie">
	
	<?php
	
	if (($login [0] . $login [1]) == 'K0' or ($login [0] . $login [1]) == 'k0') {
		echo 'A000000';
	} else {
		echo $login;
	}
	
	?>
	
	&nbsp;</div>
		<p>IDENTYFIKATOR PRZEDSTAWICIELA</p>
	</div>
	<div class="element">
		<div class="podpis_przedstawiciela margin_l_10"></div>
		<p class="margin_l_10">PODPIS PRZEDSTAWICIELA <?php echo $datajakas; echo $target; ?></p>
	</div>
	<div class="clear_b"></div>
	<div class="element">
    <?php
				$sprawa_kod_jednoski = sprawa_pobierz_warosc_z_tabeli_po_id ( 'kod_jednostki', 'sprawa_jednostki', $sprawa ['sprawa_jednostka_id'] );
				?>
	<div class="kod_jednostki margin_r_20 pogrubienie"><?php echo $sprawa_kod_jednoski['kod_jednostki']; ?>&nbsp;</div>
		<p>KOD JEDNOSTKI</p>
	</div>
	<div class="clear_b"></div>
	<div class="element">
		<div class="kod_konsultanta margin_r_20 pogrubienie">
	<?php
	if (($login [0] . $login [1]) == 'K0' or ($login [0] . $login [1]) == 'k0') {
		echo $login;
	}
	?>
	&nbsp;</div>
		<p>KOD KONSULTANTA</p>
	</div>
	<div class="clear_b"></div>
	<div class="element">
		<div class="nr_sprawy margin_r_20 pogrubienie">&nbsp;</div>
		<p>NUMER SPRAWY</p>
	</div>
	<div class="clear_b"></div>
	<div class="data_wplywu"></div>
	<div class="skany">
		<p>SKANY WYSŁANE NA: nowesprawy@votum-sa.pl</p>
	</div>
	<div class="logo_votum"></div>
	<div class="tytul_strony">
		<p>ZGŁOSZENIE SZKODY/ZAMÓWIENIE</p>
	</div>
	<div class="rodzaj_wypadku">
		<p>rodzaj wypadku: <?php echo $rodzaj_wypadku; ?></p>
	</div>
	<div class="nastepstwa_wypadku">
		<p>następstwa wypadku: <?php echo $typ_szkody; ?></p>
	</div>
	<div class="formularz">
		<div class="tytul_sekcji_formularza">
			<div class="pola_w_tytule">ZLECENIODAWCA <?php echo $test; ?></div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class="element">
				<p>IMIĘ</p>
				<div class="zleceniodawca_imie margin_r_20"><?php echo $zleceniodawca_imie; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NAZWISKO</p>
				<div class="zleceniodawca_nazwisko margin_r_20"><?php echo $zleceniodawca_nazwisko; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>WIEK</p>
				<div class="zleceniodawca_wiek"><?php echo $zleceniodawca_wiek; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<p>ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
			<div class="element">
				<p>ULICA</p>
				<div class="zleceniodawca_ulica margin_r_20"><?php echo $zleceniodawca_ulica; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR DOMU</p>
				<div class="zleceniodawca_nr_domu "><?php echo $zleceniodawca_dom; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR MIESZKANIA</p>
				<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $zleceniodawca_mieszkanie; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>KOD POCZTOWY</p>
				<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $zleceniodawca_kod; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="zleceniodawca_miejscowosc"><?php echo $zleceniodawca_miejscowosc; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<p>ADRES KORESPONDENCYJNY ZLECENIODAWCY (JEŚLI JEST INNY NIŻ
				ZAMELDOWANIA)</p>
			<div class="element">
				<p>ULICA</p>
				<div class="zleceniodawca_ulica margin_r_20"><?php echo $zleceniodawca_kor_ulica; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR DOMU</p>
				<div class="zleceniodawca_nr_domu "><?php echo $zleceniodawca_kor_dom; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR MIESZKANIA</p>
				<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $zleceniodawca_kor_mieszkanie; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>KOD POCZTOWY</p>
				<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $zleceniodawca_kor_kod; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="zleceniodawca_miejscowosc"><?php echo $zleceniodawca_kor_miejscowosc; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
            <?php echo ($zleceniodawca_obcokrajowiec) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $zleceniodawca_pesel_dokument; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NUMER TELEFONU</p>
				<div class="zleceniodawca_telefon margin_r_20"><?php echo $zleceniodawca_telefon; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>E-MAIL</p>
				<div class="zleceniodawca_email margin_r_20"><?php echo $zleceniodawca_email; ?>&nbsp;</div>
			</div>
			<div class="element">
			<?php echo ($zleceniodawca_obcokrajowiec) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo $zleceniodawca_dowod_nr_dokumentu; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
		</div>
		<div class="tytul_sekcji_formularza">
			<div class="pola_w_tytule">
				<div class="element">POSZKODOWANY (wypełnić jeśli inny niż
					Zleceniodawca)</div>
				<div class="element">
					<div class="kratka"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_maloletni; ?></div>
					małoletni
				</div>
				<div class="element">
					<div class="kratka"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_ubezwlasnowolniony; ?></div>
					ubezwłasnowolniony całkowicie
				</div>
				<div class="element">
					<div class="kratka"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_malzonek; ?></div>
					małżonek
				</div>
				<div class="element">
					<div class="kratka"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_zmarly; ?></div>
					zmarły
				</div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				<p>IMIĘ</p>
				<div class="zleceniodawca_imie margin_r_20"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_imie ; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NAZWISKO</p>
				<div class="zleceniodawca_nazwisko margin_r_20"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_nazwisko; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>WIEK</p>
				<div class="zleceniodawca_wiek"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_wiek; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
				<p>ULICA</p>
				<div class="zleceniodawca_ulica margin_r_20"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_ulica; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR DOMU</p>
				<div class="zleceniodawca_nr_domu "><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_dom; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR MIESZKANIA</p>
				<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_mieszkanie; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>KOD POCZTOWY</p>
				<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_kod; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="zleceniodawca_miejscowosc"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_miejscowosc; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
			<?php echo ($poszkodowany_obcokrajowiec) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="zleceniodawca_pesel margin_r_20">
                <?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_pesel_dokument; ?>
                &nbsp;</div>
			</div>
			<div class="element">
				<p>NUMER TELEFONU</p>
				<div class="zleceniodawca_telefon margin_r_20"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_telefon; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>E-MAIL</p>
				<div class="zleceniodawca_email margin_r_20"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_email; ?>&nbsp;</div>
			</div>
			<div class="element">
			<?php echo ($poszkodowany_obcokrajowiec) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo ($zleceniodawca['id'] == $poszkodowany['id']) ? ' ' : $poszkodowany_dowod_nr_dokumentu; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
		</div>
		<div class="tytul_sekcji_formularza">
			<div class="pola_w_tytule">
				<div class="element">UPRAWNIONY (wypełnić jeśli inny niż
					Zleceniodawca – najbliższy członek rodziny zmarłego)</div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				<p>IMIĘ</p>
				<div class="zleceniodawca_imie margin_r_20"><?php echo $uprawniony_imie; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NAZWISKO</p>
				<div class="zleceniodawca_nazwisko margin_r_20"><?php echo $uprawniony_nazwisko; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>WIEK</p>
				<div class="zleceniodawca_wiek"><?php echo $wiek_uprawnionego; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
				<p>ULICA</p>
				<div class="zleceniodawca_ulica margin_r_20"><?php echo $uprawniony_ulica; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR DOMU</p>
				<div class="zleceniodawca_nr_domu "><?php echo $uprawniony_dom; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NR MIESZKANIA</p>
				<div class="zleceniodawca_nr_mieszkania margin_r_20"><?php echo $uprawniony_mieszkanie; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>KOD POCZTOWY</p>
				<div class="zleceniodawca_kod_pocztowy margin_r_20"><?php echo $uprawniony_kod; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>MIEJSCOWOŚĆ</p>
				<div class="zleceniodawca_miejscowosc"><?php echo $uprawniony_miejscowosc; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="element">
			<?php echo ($uprawniony_obcokrajowiec) ? '<p>RODZAJ DOKUMENTU</p>' : '<p>PESEL</p>' ; ?>
			<div class="zleceniodawca_pesel margin_r_20"><?php echo $uprawniony_pesel_dokument; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NUMER TELEFONU</p>
				<div class="zleceniodawca_telefon margin_r_20"><?php echo $uprawniony_telefon; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>E-MAIL</p>
				<div class="zleceniodawca_email margin_r_20"><?php echo $uprawniony_email; ?>&nbsp;</div>
			</div>
			<div class="element">
			<?php echo ($uprawniony_obcokrajowiec) ? '<p>NUMER DOKUMENTU</p>' : '<p>SERIA I NUMER DOWODU</p>' ; ?>
			<div class="zleceniodawca_seria_i_numer_dowodu"><?php echo $uprawniony_dowod_nr_dokumentu; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
		</div>

		<div class="tytul_sekcji_formularza">
			<div class="pola_w_tytule">
				<div class="element">UPRAWNIONY DO UZYSKANIA INFORMACJI
					TELEFONICZNEJ</div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				<p>IMIĘ</p>
				<div class="zleceniodawca_imie margin_r_20"><?php echo $uprawniony_tel_imie; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>NAZWISKO</p>
				<div class="zleceniodawca_nazwisko margin_r_20"><?php echo $uprawniony_tel_nazwisko; ?>&nbsp;</div>
			</div>
			<div class="element">
				<p>PESEL</p>
				<div class="zleceniodawca_pesel"><?php echo $uprawniony_tel_pesel; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
		</div>


		<div class="tytul_sekcji_formularza">
			<div class="pola_w_tytule">
				<div class="element">
					Informacje o zdarzeniu z dnia <b><?php echo $zdarzenie_data; ?></b>
					godziny <b><?php echo $zdarzenie_godzina; ?></b>
				</div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class='tekst_lewe margin_l_20'>które miało miejsce w</div>
			<div class="element">
				<div class="miejsce_zdarzenia margin_l_20"><?php echo $zdarzenie_miejsce; ?>&nbsp;</div>
			</div>
			<div class="clear_b"></div>
			<div class="element margin_r_20 margin_l_20">
				<div class="element">
					<p class="font_s_16 margin_t_5">POJAZD A (w którym znajdował się
						poszkodowany)</p>
					<p class="margin_t_5">MARKA, TYP POJAZDU</p>
					<div class="pojazd_marka"><?php echo $pojazd_a_marka; ?>&nbsp;<?php echo $pojazd_a_typ; ?>&nbsp;</div>
					<p class="margin_t_5">NR REJESTRACYJNY</p>
					<div class="pojazd_marka"><?php echo $pojazd_a_rejestracja; ?>&nbsp;</div>
					<p class="margin_t_5">KRAJ REJESTRACJI (JEŚLI INNY NIŻ POLSKA)</p>
					<div class="pojazd_marka"><?php echo $pojazd_a_kraj; ?>&nbsp;</div>
					<p class="margin_t_5">KIERUJĄCY POJAZDEM</p>
					<div class="pojazd_marka"><?php echo $pojazd_a_kierujacy; ?>&nbsp;</div>
					<p class="margin_t_5">POSIADACZ POJAZDU</p>
					<div class="pojazd_marka"><?php echo $pojazd_a_posaidacz; ?>&nbsp;</div>
					<p class="margin_t_5">UBEZPIECZYCIEL OC POSIADACZA POJAZDU</p>
					<div class="pojazd_marka"><?php echo $pojazd_a_ubezpieczyciel; ?>&nbsp;</div>
					<p class="margin_t_5">NUMER POLISY OC</p>
					<div class="pojazd_marka"><?php echo $pojazd_a_oc; ?>&nbsp;</div>
				</div>

			</div>
			<div class="element margin_r_20 margin_l_20">
				<div class="element">
					<p class="font_s_16 margin_t_5">POJAZD B* lub PODMIOT
						ODPOWIEDZIALNY</p>
					<p class="margin_t_5">MARKA, TYP POJAZDU</p>
					<div class="pojazd_marka"><?php echo $pojazd_b_marka; ?>&nbsp;<?php echo $pojazd_b_typ; ?>&nbsp;</div>
					<p class="margin_t_5">NR REJESTRACYJNY</p>
					<div class="pojazd_marka"><?php echo $pojazd_b_rejestracja; ?>&nbsp;</div>
					<p class="margin_t_5">KRAJ REJESTRACJI (JEŚLI INNY NIŻ POLSKA)</p>
					<div class="pojazd_marka"><?php echo $pojazd_b_kraj; ?>&nbsp;</div>
					<p class="margin_t_5">KIERUJĄCY POJAZDEM</p>
					<div class="pojazd_marka"><?php echo $pojazd_b_kierujacy; ?>&nbsp;</div>
					<p class="margin_t_5">POSIADACZ POJAZDU</p>
					<div class="pojazd_marka"><?php echo $pojazd_b_posaidacz; ?>&nbsp;</div>
					<p class="margin_t_5">UBEZPIECZYCIEL OC POSIADACZA POJAZDU</p>
					<div class="pojazd_marka"><?php echo $pojazd_b_ubezpieczyciel; ?>&nbsp;</div>
					<p class="margin_t_5">NUMER POLISY OC</p>
					<div class="pojazd_marka"><?php echo $pojazd_b_oc; ?>&nbsp;</div>
				</div>
			</div>
			<div class="clear_b"></div>

		</div>
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo small_font">ZLECENIODAWCA</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">1/6</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<div class="strona strona_5">
<?php echo $znak_wodny; ?>
	<div class="formularz_szary">
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">REKOMENDACJA</div>
		</div>
		<div class="tresc_sekcji_fomularza height_60 justowanie">
		<?php echo $sprawa['rekomendacja']; ?>
		<div class="clear_b"></div>
		</div>
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">OPIS ZDARZENIA</div>
		</div>
		<div class="tresc_sekcji_fomularza height_250 justowanie">
		<?php echo $opis_zdarzenia_tekst; ?>
		<div class="clear_b"></div>
		</div>
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">OBRAŻENIA CIAŁA</div>
		</div>
		<div class="tresc_sekcji_fomularza height_250 justowanie">
        <?php echo $obrazenia_opis['wartosc']; ?>
		<div class="clear_b"></div>
		</div>
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">
				<div class="element">
        ODPOWIEDZIALNOŚC KARNA   sygn. akt  <?php echo $odpowiedzialnosc_karna['sygnatura_akt']; ?>  
        </div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['oswiadczenie']) ? 'X' : '' ; ?></div>
				sprawca napisał oświadczenie i
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['wezwano_policje']) ? 'X' : '' ; ?></div>
				wezwano policję /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['wezwano_policje']) ? '' : 'X' ; ?></div>
				nie wezwano policji
			</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['wezwano_policje']) ? 'X' : '' ; ?></div> na miejsce zdarzenia wezwano policję z <?php echo $odpowiedzialnosc_karna['skad_policja']; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['wszczeto_postepowanie']) ? 'X' : '' ; ?></div>
				wszczęto postępowanie w sprawie
			</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['zarzut']) ? 'X' : '' ; ?></div> postawiono sprawcy zarzut z art. <?php echo $odpowiedzialnosc_karna['zarzut_z_art']; ?> <?php echo $ok_psz_kk; ?><?php echo $ok_psz_kw; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['umorzono']) ? 'X' : '' ; ?></div> postępowanie karne umorzono na podstawie art. <?php echo $odpowiedzialnosc_karna['umorz_na_podst']; ?> <?php echo $ok_pku_kpk; ?><?php echo $ok_pku_kpw; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['do_sadu']) ? 'X' : '' ; ?></div> skierowano akt oskarżenia do sądu (pełna nazwa sądu) <?php echo $odpowiedzialnosc_karna['nazwa_sadu']; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['czy_wyrok']) ? 'X' : '' ; ?></div>
				zapadł wyrok
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['skazujacy']) ? 'X' : '' ; ?></div>
				skazujący /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_karna['uniewinniajacy']) ? 'X' : '' ; ?></div> uniewinniający o czyn z art. <?php echo $odpowiedzialnosc_karna['wyrok_z_art']; ?> <?php echo $ok_zw_kk; ?><?php echo $ok_zw_kw; ?></div>
			<div class="clear_b"></div>

		</div>


		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">
				<div class="element">
        ODPOWIEDZIALNOŚC CYWILNA   nr szkody  <?php echo $odpowiedzialnosc_cywilna['nr_szkody']; ?> 
        </div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_cywilna['zgl_szkode_w_poj']) ? 'X' : ''; ?></div> zgłoszono szkodę w pojeździe do ubezpieczyciela OC sprawcy, data zgłoszenia <?php echo sprawdz_date($odpowiedzialnosc_cywilna['data_zgl_w_poj']); ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (!($odpowiedzialnosc_cywilna['zgl_szkode_w_poj'])) ? 'X' : ''; ?></div>
				nie zgłoszono szkody w pojeździe do ubezpieczyciela OC sprawcy
			</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_cywilna['zgl_szkode_na_os']) ? 'X' : ''; ?></div> zgłoszono szkodę na osobie do ubezpieczyciela OC sprawcy, data zgłoszenia <?php echo sprawdz_date($odpowiedzialnosc_cywilna['data_zgl_na_os']); ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (!($odpowiedzialnosc_cywilna['zgl_szkode_na_os'])) ? 'X' : ''; ?></div>
				nie zgłoszono szkody na osobie do ubezpieczyciela OC sprawcy
			</div>
			<div class="clear_b"></div>

			<div class="element">Odszkodowanie z OC sprawcy:</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_cywilna['co_z_oc']=='1') ? 'X' : ''; ?></div>
				nie wypłacono /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_cywilna['co_z_oc']=='2') ? 'X' : ''; ?></div>
				wypłacono za szkodę w pojeździe
			</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_cywilna['co_z_oc']=='3') ? 'X' : ''; ?></div> wypłacono za szkodę osobową w kwocie <?php echo $odpowiedzialnosc_cywilna['kwota']; ?> zł</div>
			<div class="clear_b"></div>

			<div class="element">na podstawie:</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_cywilna['podstawa']=='1') ? 'X' : ''; ?></div>
				ugody /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_cywilna['podstawa']=='2') ? 'X' : ''; ?></div>
				wyroku /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($odpowiedzialnosc_cywilna['podstawa']=='3') ? 'X' : ''; ?></div> decyzji z dnia: <?php echo sprawdz_date($odpowiedzialnosc_cywilna['data_decyzji']); ?> </div>
			<div class="clear_b"></div>

		</div>
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">
				<div class="element">INNE ODSZKODOWANIA</div>
			</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				<div class="kratka"><?php echo ($inne_odszkodowania['zgloszono_nnw']) ? 'X' : ''; ?></div> zgłoszono szkodę do ubezpieczyciela NNW (nazwa ubezpieczyciela) <?php echo $inne_odszkodowania['komu_zgloszono']; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['uszczerbek_nnw']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : '';?></div> ubezpieczyciel NNW określił uszczerbek na zdrowiu na <?php echo (($inne_odszkodowania['uszczerbek_nnw']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['uszczerbek_nnw_procent'] : '__';  ?> %</div>
			<div class="clear_b"></div>

			<div class="element">Był to wypadek</div>
			<div class="element">
				<div class="kratka"><?php echo ($inne_odszkodowania['jaki_wypadek']=='1') ? 'X' : ''; ?></div>
				przy pracy /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($inne_odszkodowania['jaki_wypadek']=='2') ? 'X' : ''; ?></div>
				w drodze do lub z pracy
			</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['gdzie_zgloszono_id']=='1') OR ($inne_odszkodowania['gdzie_zgloszono_id']=='2') OR ($inne_odszkodowania['gdzie_zgloszono_id']=='3') ) ? 'X' : ''; ?></div>
				zgłoszono szkodę do
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($inne_odszkodowania['gdzie_zgloszono_id']=='1') ? 'X' : ''; ?></div>
				ZUS /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($inne_odszkodowania['gdzie_zgloszono_id']=='2') ? 'X' : ''; ?></div>
				KRUS /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($inne_odszkodowania['gdzie_zgloszono_id']=='3') ? 'X' : ''; ?></div> inne  <?php echo $inne_odszkodowania['inne_tekst']; ?>, który określił uszczerbek na zdrowiu na <?php echo (($inne_odszkodowania['uszczerbek_ubezp_procent'] != '0') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['uszczerbek_ubezp_procent'] : '__'; ?>%</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['jednorazowe_odszkodowanie']=='1')  AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : '__'; ?></div> przyznano jednorazowe odszkodowanie z tytułu wypadku przy pracy w wysokości <?php echo ($inne_odszkodowania['jednorazowe_odszkodowanie']=='1') ? $inne_odszkodowania['jednorazowe_odszkodowanie_kwota'] : ''; ?> zł</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($inne_odszkodowania['zasilek_pogrzebowy']=='1') ? 'X' : ''; ?></div>
				przyznano zasiłek pogrzebowy
			</div>
			<div class="clear_b"></div>

			<div class="element">W związku z wypadkiem stwierdzono niezdolność do
				pracy na podstawie:</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['zwolnienie']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> zwolnienia lekarskiego na okres od <?php echo (($inne_odszkodowania['zwolnienie']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['zwolnienie_od'] : '__'; ?> do <?php echo (($inne_odszkodowania['zwolnienie']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['zwolnienie_do'] : '__'; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['orzeczenie']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				orzeczenia o niezdolności do pracy:
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['orzeczenie_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				całkowitej /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['orzeczenie_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				częściowej /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['orzeczenie_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				trwałej /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['orzeczenie_id']=='4') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> okresowej do dnia <?php echo (($inne_odszkodowania['orzeczenie_id']=='4') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['orzeczenie_do'] : '__'; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['niezdolnosc_ubezpieczyciel_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				ZUS
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['niezdolnosc_ubezpieczyciel_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				KURS
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($inne_odszkodowania['niezdolnosc_ubezpieczyciel_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> inne <?php echo (($inne_odszkodowania['niezdolnosc_ubezpieczyciel_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['niezdolnosc_ubezpieczyciel_inne'] : ' '; ?> przyznał  <?php echo (($inne_odszkodowania['swiadczenie_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'rente' : ''; ?> <?php echo (($inne_odszkodowania['swiadczenie_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['swiadczenie_inne'] : ''; ?> w wysokości <?php echo (($inne_odszkodowania['kwota_swiadczenia']!='0') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['kwota_swiadczenia'] : '__'; ?> zł miesięcznie, na okres do <?php echo (($inne_odszkodowania['okres_swiadczenia']!='0000-00-00') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $inne_odszkodowania['okres_swiadczenia'] : '__'; ?></div>
			<div class="clear_b"></div>
		</div>


	</div>
	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_prawo small_font">ZLECENIODAWCA</div>
			<div class="clear_b"></div>
		</div>
	</div>
	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">2/6</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<!-- STRONA TRZECIA -->


<div class="strona strona_6">
<?php echo $znak_wodny; ?>
	<div class="formularz_szary margin_b_10">
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">PRZEBIEG LECZENIA (doznane urazy i
				odczuwane dolegliwości należy opisać w OŚWIADCZENIU)</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				<div class="kratka"><?php echo (($przebieg_leczenia['skad_pogotowie']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> na miejsce zdarzenia wezwano pogotowie z (miejscowość, szpital): <?php echo (($przebieg_leczenia['skad_pogotowie']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $przebieg_leczenia['skad_pogotowie'] : ''; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($przebieg_leczenia['przychodnia']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> poszkodowany sam zgłosił się do lekarza (dane lekarza, przychodni): <?php echo (($przebieg_leczenia['przychodnia']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $przebieg_leczenia['przychodnia'] : ''; ?> w dniu <?php echo (($przebieg_leczenia['przychodnia_data'] != '0000-00-00') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $przebieg_leczenia['przychodnia_data'] : ''; ?> </div>
			<div class="clear_b"></div>
            
            <?php $hospitalizacja = sprawa_pobierz_miejsce_hospitalizacji($sprawa['sprawa_przebieg_leczenia_id']); ?>
            
            <div class="element">
				<div class="kratka"><?php echo ((mysqli_num_rows($hospitalizacja) > 0) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				po wypadku poszkodowany był hospitalizowany w:
			</div>
			<div class="clear_b"></div>
            
            <?php
												
												while ( $hospitalizacja_dane = mysqli_fetch_assoc ( $hospitalizacja ) ) {
													$i += 1?>

													        
            
            <div class="element"><?php echo $i.'. '.$hospitalizacja_dane['nazwa'].''; ?> <?php echo ' '.$hospitalizacja_dane['data'].''; ?></div>
			<div class="clear_b"></div>
            
        
            <?php
												}
												?>
            <div class="clear_b"></div>

            <?php $zabiegi = sprawa_pobierz_placowki($sprawa['sprawa_przebieg_leczenia_id']); ?>
            
            <div class="element">
				<div class="kratka"><?php echo ((mysqli_num_rows($zabiegi) > 0) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				przeprowadzono zabiegi operacyjne
			</div>
			<div class="clear_b"></div>

			<div class="element">Adresy placówek medycznych, w których leczono
				poszkodowanego w związku z wypadkiem (wypełnić, jeśli nie ma ich w
				załączonej dokumentacji)</div>
			<div class="clear_b"></div>
             <?php
													
													while ( $zabiegi_dane = mysqli_fetch_assoc ( $zabiegi ) ) {
														$j += 1;
														?>

        <div class="element"><?php echo $j.'. '.$zabiegi_dane['nazwa'].''; ?> <?php echo ' '.$zabiegi_dane['data'].''; ?></div>
			<div class="clear_b"></div>
		<?php
													}
													?>
            
		<div class="clear_b"></div>

		</div>
		<div class="tytul_sekcji_formularza_szary ">
			<div class="pola_w_tytule">DOCHODZENIE ROSZCZEŃ</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				<div class="kratka"><?php echo (!($dochodzenie_roszczen['czy_zlecono'])) ? 'X' : ''; ?></div>
				nie zlecano wcześniej dochodzenia roszczeń żadnemu podmiotowi
			</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($dochodzenie_roszczen['czy_zlecono']) ? 'X' : ''; ?></div> sprawę zlecono wcześniej pełnomocnikowi (nazwa) <?php echo $dochodzenie_roszczen['komu_zlecono']; ?> z którym zawarto umowę dnia <?php echo sprawdz_date($dochodzenie_roszczen['kiedy_zlecono']); ?> </div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo ($dochodzenie_roszczen['czy_wypowiedziano']) ? 'X' : ''; ?></div> umowę z wyżej wymienionym wypowiedziano w dniu <?php echo sprawdz_date($dochodzenie_roszczen['kiedy_wypowiedziano']); ?> </div>
			<div class="clear_b"></div>

			<div class="element">Stosunek do kierującego pojazdem A</div>
			<div class="element">
				<div class="kratka"><?php echo ($zdarzenie['stosunek_poj_a']=='1') ? 'X' : ''; ?></div>
				obcy /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($zdarzenie['stosunek_poj_a']=='2') ? 'X' : ''; ?></div>
				rodzina /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($zdarzenie['stosunek_poj_a']=='3') ? 'X' : ''; ?></div> inny  <?php echo ' '.$zdarzenie['stosunek_poj_a_tekst']; ?></div>
			<div class="clear_b"></div>

			<div class="element">Stosunek do kierującego pojazdem B</div>
			<div class="element">
				<div class="kratka"><?php echo ($zdarzenie['stosunek_poj_b']=='1') ? 'X' : ''; ?></div>
				obcy /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($zdarzenie['stosunek_poj_b']=='2') ? 'X' : ''; ?></div>
				rodzina /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($zdarzenie['stosunek_poj_b']=='3') ? 'X' : ''; ?></div> inny <?php echo ' '.$zdarzenie['stosunek_poj_b_tekst']; ?></div>
			<div class="clear_b"></div>

			<div class="objasnienia">
				Oświadczam, że zostałem poinformowany o okolicznościach
				uzasadniających dochodzenie zwrotu wypłaconego odszkodowania od
				sprawcy wypadku przez ubezpieczyciela lub Ubezpieczeniowy Fundusz
				Gwarancyjny, określonych w ustawie z dnia 22 maja 2003 r. o
				ubezpieczeniach obowiązkowych, Ubezpieczeniowym Funduszu
				Gwarancyjnym i Polskim Biurze Ubezpieczycieli Komunikacyjnych (Dz.U.
				Nr 124, poz. 1152). </br> Zgodnie z art. 43. zakładowi ubezpieczeń
				przysługuje prawo dochodzenia od kierującego pojazdem mechanicznym
				zwrotu wypłaconego z tytułu ubezpieczenia OC posiadaczy pojazdów
				mechanicznych odszkodowania, jeżeli kierujący: 1) wyrządził szkodę
				umyślnie lub w stanie po użyciu alkoholu albo pod wpływem środków
				odurzających, substancji psychotropowych lub środków zastępczych w
				rozumieniu przepisów o przeciwdziałaniu narkomanii; 2) wszedł w
				posiadanie pojazdu wskutek popełnienia przestępstwa; 3) nie posiadał
				wymaganych uprawnień do kierowania pojazdem mechanicznym, z
				wyjątkiem przypadków, gdy chodziło o ratowanie życia ludzkiego lub
				mienia albo o pościg za osobą podjęty bezpośrednio po popełnieniu
				przez nią przestępstwa; 4) zbiegł z miejsca zdarzenia.</br> Zgodnie
				z art. 110 ust. 1 z chwilą wypłaty przez Fundusz odszkodowania,
				sprawca szkody i osoba, która nie dopełniła obowiązku zawarcia umowy
				ubezpieczonego, którego ruchem szkodę tę wyrządzono, nie był
				ubezpieczony obowiązkowym ubezpieczeniem OC posiadaczy pojazdów
				mechanicznych, lub rolnik, osoba pozostająca z nim we wspólnym
				gospodarstwie domowym lub osoba pracująca w jego gospodarstwie
				rolnym wyrządzili szkodę, a rolnik nie był ubezpieczony obowiązkowym
				ubezpieczeniem OC rolników.
			</div>
			</br>

			<div class="element">W przypadku możliwości żądania od sprawcy lub
				osoby, która nie dopełniła obowiązku zawarcia umowy ubezpieczenia
				obowiązkowego zwrotu wypłaconych odszkodowań przez ubezpieczyciela
				lub UFG:</div>
			<div class="element">
				<div class="kratka"><?php echo ($sprawa['roszczenia_od_ubezp_ufg']) ? 'X' : ''; ?></div>
				decyduję się na dochodzenie roszczeń od ubezpieczyciela lub UFG /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (!($sprawa['roszczenia_od_ubezp_ufg'])) ? 'X' : ''; ?></div>
				nie decyduję się na dochodzenie roszczeń
			</div>
			<div class="clear_b"></div>

			<div class="element margin_r_150">W przypadku dochodzenia roszczeń
				bezpośrednio od swojego pracodawcy:</div>
			<div class="element">
				<div class="kratka"><?php echo ($sprawa['roszczenia_od_prac']) ? 'X' : ''; ?></div>
				decyduję się na dochodzenie roszczeń /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (!($sprawa['roszczenia_od_prac'])) ? 'X' : ''; ?></div>
				nie decyduję się na dochodzenie roszczeń
			</div>
			<div class="clear_b"></div>

			<div class="element"> Przekazałem pełnomocnikowi Votum S.A. dokumentację składającą się z <?php echo ($dochodzenie_roszczen['ile_kart']) ? $dochodzenie_roszczen['ile_kart'] : ''; ?> słownie <?php echo ($dochodzenie_roszczen['ile_kart']) ? slownie($dochodzenie_roszczen['ile_kart']) : ''; ?> kart.</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($sprawa['zgoda_na_inf_sms']) OR ($sprawa['zgoda_na_inf_email'])) ? 'X' : ''; ?></div>
				Wyrażam zgodę /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (!($sprawa['zgoda_na_inf_sms']) AND !($sprawa['zgoda_na_inf_email'])) ? 'X' : ''; ?></div>
				Nie wyrażam zgody na otrzymywanie informacji związanych z
				wykonywaniem umowy poprzez
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($sprawa['zgoda_na_inf_sms']) ? 'X' : ''; ?></div>
				wiadomości tekstowe SMS /
			</div>
			<div class="element">
				<div class="kratka"><?php echo ($sprawa['zgoda_na_inf_email']) ? 'X' : ''; ?></div>
				wiadomości e-mail na numer/adres przeze mnie wskazany.
			</div>
			<div class="clear_b"></div>

		</div>
	</div>

	<div class="element">
		<div class="kratka margin_top_5"><?php echo (($inne_odszkodowania['pcrf']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
		<div class="oswiadczenie_o_danych">Jestem zainteresowana/y ofertą
			rehabilitacyjną i wyrażam zgodę na przekazywanie PCRF Votum S.A. Sp.
			k. w Krakowie moich danych osobowych lub danych osobowych
			małoletniego / ubezwłasnowolnionego / małżonka, którego reprezentuję,
			w tym informacji dotyczących stanu zdrowia, w celu opracowania i
			przedstawienia oferty.</div>
	</div>
	<div class="clear_b"></div>

	<div class="element">
		<div class="kratka margin_top_5"><?php echo (($inne_odszkodowania['fundacja']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
		<div class="oswiadczenie_o_danych">Jestem zainteresowana/y objęciem
			mnie pomocą przez Fundację VOTUM i wyrażam zgodę na przekazanie
			Fundacji VOTUM we Wrocławiu moich danych osobowych lub danych
			osobowych małoletniego / ubezwłasnowolnionego / małżonka, którego
			reprezentuję, w tym informacji dotyczących stanu zdrowia, w celu
			opracowania i przedstawienia możliwego zakresu pomocy.</div>
	</div>
	<div class="clear_b"></div>

	<div class="element">
		<div class="kratka margin_top_5"><?php echo (($inne_odszkodowania['gamma']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
		<div class="oswiadczenie_o_danych">Jestem zainteresowana/y ofertą
			usług medycznych i wyrażam zgodę na przekazywanie „Centrum Medycznemu
			Gamma” Sp. z o.o. w Warszawie moich danych osobowych lub danych
			osobowych małoletniego / ubezwłasnowolnionego / małżonka, którego
			reprezentuję, w tym informacji dotyczących stanu zdrowia, w celu
			opracowania i przedstawienia oferty.</div>
	</div>
	<div class="clear_b"></div>

	<div class="element">
		<div class="kratka margin_top_5"><?php echo (($inne_odszkodowania['dzialalnosc']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
		<div class="oswiadczenie_o_danych">Oświadczam, że prowadzę
			pozarolniczą działalność gospodarczą.</div>
	</div>
	<div class="clear_b"></div>

	<div class="element">
		<div class="kratka margin_top_5"><?php echo ($inne_odszkodowania['oferta_finansowa']) ? 'X' : ''; ?></div>
		<div class="oswiadczenie_o_danych">Jestem zainteresowana/y ofertą
			produktów finansowych i wyrażam zgodę na przekazywanie Protecta
			Finanse Sp. z o.o. we Włocławku moich danych osobowych w celach
			marketingowych, w szczególności w celu opracowania i przedstawienia
			oferty.</div>
	</div>
	<div class="clear_b"></div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS ZLECENIODAWCY</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="sekcja_tytul_lewa">
				<p>Oświadczenie</p>
			</div>
			Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy – VOTUM S.A.,
			oświadczam, iż podpisy Zleceniodawcy na wszystkich dokumentach, tj.
			na umowie, pełnomocnictwie oraz zgłoszeniu szkody, zostały złożone w
			mojej obecności własnoręcznie przez Zleceniodawcę.
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="podpis_przedstawiciela margin_r_20 pogrubienie">
	
	<?php echo $dane_uzytkownika['imie']. ' '.$dane_uzytkownika['nazwisko']; ?>
	
	&nbsp;</div>

	<div class="clear_b"></div>
	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">IMIĘ I NAZWISKO PRZEDSTAWICIELA</div>
			<div class="podpis_prawo small_font">CZYTELNY PODPIS PRZEDSTAWICIELA</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">3/6</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<!-- STRONA CZWARTA -->

<!-- medyk ========>>     -->

<div class="strona strona_7">
<?php echo $znak_wodny; ?>
	<div class="tytul_strony_pierwszej">OŚWIADCZENIE OSOBY POSZKODOWANEJ</div>
	<div class="formularz_szary">
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">OKOLICZNOŚCI ZDARZENIA</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				Ja niżej podpisany/-a <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? $poszkodowany_imie : '__________'; ?> <?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? $poszkodowany_nazwisko : '__________'; ?></b>
				świadomy/-a odpowiedzialności karnej za wprowadzanie w błąd
				ubezpieczyciela w celu osiągnięcia korzyści majątkowej, oświadczam,
				iż byłem/-am uczestnikiem wypadku komunikacyjnego, który miał
				miejsce w <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? $zdarzenie_miejsce : '__________'; ?></b>
				w dniu <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? $zdarzenie_data : '__________'; ?></b>
				około godziny <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? $zdarzenie_godzina : '__________'; ?></b>
			</div>
			<div class="clear_b"></div>

			<div class="element">W chwili zdarzenia</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['pod_wplywem']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				byłem/-am /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (!($oswiadczenie_poszkodowanego['pod_wplywem']) AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				nie byłem/-am pod wpływem:
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_uzywki_id'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				alkoholu
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_uzywki_id'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				narkotyków
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_uzywki_id'] == '3') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				innych środków odurzających.
			</div>
			<div class="clear_b"></div>

		</div>
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">WYPEŁNIĆ TYLKO JEŻELI POSZKODOWANY
				ZNAJDOWAŁ SIĘ POZA POJAZDEM</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">Byłem/-am</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['rola'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				pieszym/-ą /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['rola'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				rowerzystą/-ką i zostałem/-am potrącony/-a przez pojazd marki <b><?php echo (($oswiadczenie_poszkodowanego['w_pojezdzie'] == '0') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $pojazd_b_marka : '_____'; ?></b>
				o nr. rej. <b><?php echo (($oswiadczenie_poszkodowanego['w_pojezdzie'] == '0') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $pojazd_b_rejestracja : '_____'; ?></b>
			</div>
			<div class="clear_b"></div>

		</div>

		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">WYPEŁNIĆ TYLKO JEŚLI POSZKODOWANY
				ZNAJDOWAŁ SIĘ W POJEŹDZIE</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">Typ pojazdu:</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_typ_pojazdu_id'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				samochód /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_typ_pojazdu_id'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				komunikacja zbiorowa /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_typ_pojazdu_id'] == '3') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> inne  <?php echo $oswiadczenie_poszkodowanego['typ_pojazdu_inny']; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				W pojeździe marki <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? $pojazd_a_marka : '_____'; ?></b>
				o nr. rej. <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? $pojazd_a_rejestracja : '_____'; ?></b>
				byłem/-am
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				kierowcą /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] != '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				pasażerem, siedziałem/-am
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '3') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				obok kierowcy /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '4') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				z tyłu za kierowcą /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '5') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				z tyłu za przednim pasażerem /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '6') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				z tyłu pośrodku /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '7') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> inne <?php echo $oswiadczenie_poszkodowanego['pozycja_inna']; ?></div>
			<div class="clear_b"></div>

			<div class="element">W chwili zdarzenia</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['pasy'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				miałem/-am /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['pasy'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				nie miałem/-am zapięty pas bezpieczeństwa (założony kask).
			</div>
			<div class="clear_b"></div>

			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['wspolwlasnosc'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				Jestem /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['wspolwlasnosc'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				Nie jestem współposiadaczem wyżej wymienionego pojazdu.
			</div>
			<div class="clear_b"></div>

		</div>

		<div class="tytul_sekcji_formularza_szary dwa_wiersze">
			<div class="pola_w_tytule">WYPEŁNIĆ TYLKO JEŻELI KIERUJĄCY, Z KTÓRYM
				PODRÓŻOWAŁ POSZKODOWANY BYŁ POD WPŁYWEM ALKOHOLU LUB INNYCH ŚRODKÓW
				ODURZAJĄCYCH</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class="element">Wsiadając do pojazdu przed wypadkiem</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['wiedza_o_stanie_kierowcy'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				wiedziałem/-am /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['wiedza_o_stanie_kierowcy'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				nie wiedziałem/-am, że kierujący pojazdem przed zajęciem miejsca za
				kierownicą spożywał alkohol lub inne środki odurzające.
			</div>
			<div class="clear_b"></div>

		</div>

		<div class="tytul_sekcji_formularza_szary dwa_wiersze">
			<div class="pola_w_tytule">WYPEŁNIĆ TYLKO JEŻELI KIERUJĄCY, Z KTÓRYM
				PODRÓŻOWAŁ POSZKODOWANY NIE POSIADAŁ UPRAWNIEŃ DO KIEROWANIA
				POJAZDEM DANEJ KATEGORII</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class="element">Wsiadając do pojazdu przed wypadkiem</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['wiedza_o_upr_kierowcy'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				wiedziałem/-am /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($oswiadczenie_poszkodowanego['wiedza_o_upr_kierowcy'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				nie wiedziałem/-am, że kierujący pojazdem nie posiada uprawnień do
				kierowania danym pojazdem mechanicznym.
			</div>
			<div class="clear_b"></div>

		</div>

		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">LECZENIE</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class="element">Oświadczam, że leczenie następstw doznanych
				obrażeń</div>
			<div class="clear_b"></div>
			<div class="element">
				<div class="kratka"><?php echo (($leczenie['sprawa_stan_leczenia_id'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> zakończyło się z dniem <?php echo (($leczenie['sprawa_stan_leczenia_id'] == '1') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $leczenie['leczenie_koniec'] : ''; ?></div>
			<div class="clear_b"></div>
			<div class="element">
				<div class="kratka"><?php echo (($leczenie['sprawa_stan_leczenia_id'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div> jeszcze się nie zakończyło, a przewidywany przez lekarzy termin jego ukończenia to <?php echo (($leczenie['sprawa_stan_leczenia_id'] == '2') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? $leczenie['leczenie_plan_koniec'] : ''; ?></div>
			<div class="element">
				<div class="kratka"><?php echo (($leczenie['sprawa_stan_leczenia_id'] == '3') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				jeszcze się nie zakończyło, a przewidywany termin jego ukończenia
				nie jest mi znany
			</div>
			<div class="clear_b"></div>
			<div class="element">
				<div class="kratka"><?php echo (($leczenie['sprawa_stan_leczenia_id'] == '4') AND ($sprawa['sprawa_typ_szkody_id'] == '1')) ? 'X' : ''; ?></div>
				planowane są jeszcze zabiegi operacyjne
			</div>
			<div class="clear_b"></div>

			<div class="element float_l">Jednocześnie informuję, iż w związku z doznanymi obrażeniami przebywałem na zwolnieniu chorobowym w okresie od dnia <?php echo $poczatek_zwolnienia; ?> <?php echo $koniec_zwolnienia; ?> </div>
			<div class="clear_b"></div>

		</div>

	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS POSZKODOWANEGO LUB
				PRZEDSTAWICIELA USTAWOWEGO</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">4/6</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>
<!-- <=============  medyk -->
<!-- STRONA PIĄTA -->

<div class="strona strona_8">
<?php echo $znak_wodny; ?>
	<div class="tytul_strony_pierwszej">OŚWIADCZENIE OSOBY UPRAWNIONEJ</div>
	<div class="formularz_szary">
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				Ja niżej podpisany/-a <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $uprawniony['imie'] : '__________'; ?> <?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $uprawniony['nazwisko'] : '__________'; ?></b>
				świadomy/-a odpowiedzialności karnej za wprowadzanie w błąd
				ubezpieczyciela w celu osiągnięcia korzyści majątkowej, oświadczam,
				że <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $poszkodowany_imie : '__________'; ?> <?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $poszkodowany_nazwisko : '__________'; ?></b>
				który/-a poniósł/-a śmierć w wyniku zdarzenia z dnia <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $zdarzenie_data : '__________'; ?></b>
				r. był/-a członkiem mojej najbliższej rodziny w rozumieniu art. 446
				§ 3 i 4 k.c.
			</div>
			<div class="clear_b"></div>

			<div class="element">Oświadczenie jest składane w związku z
				zaistnieniem na skutek śmierci wyżej wymienionego/-ej:</div>
			<div class="element">
				<div class="kratka"><?php echo (($sprawa['pogorszenie_sytuacji']) AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				pogorszenia sytuacji życiowej w sferze materialnej,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sprawa['wystapienie_krzywdy']) AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				wystąpienia krzywdy w związku ze śmiercią członka najbliższej
				rodziny.
			</div>
			<div class="clear_b"></div>

		</div>
		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">INFORMACJE O ZMARŁYM/-EJ</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				Zmarły/-a w momencie śmierci miał/-a <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $poszkodowany['wiek'] : '__________'; ?></b>
				lat. Wykształcenie
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_wyksztalcenie_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				podstawowe /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_wyksztalcenie_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				zawodowe /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_wyksztalcenie_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				średnie /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_wyksztalcenie_id']=='4') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				wyższe.
			</div>
			<div class="clear_b"></div>

			<div class="element">
				Zawód wyuczony <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $poszkodowany['zawod_wyuczony'] : '__________'; ?></b>
				, zawód wykonywany <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $poszkodowany['zawod_wykonywany'] : '__________'; ?></b>
			</div>
			<div class="clear_b"></div>

			<div class="element">
				Dodatkowe kwalifikacje lub uprawnienia <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $poszkodowany['dodatkowe_kwalifikacje'] : '__________'; ?></b>
			</div>
			<div class="clear_b"></div>

			<div class="element">Zatrudnienie:</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_zatrudnienie_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				brak /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_zatrudnienie_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				umowa o pracę /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_zatrudnienie_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				umowa zlecenie /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_zatrudnienie_id']=='4') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				własna działalność gospodarcza /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_zatrudnienie_id']=='5') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				gospodarstwo rolne/
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_zatrudnienie_id']=='6') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				prace dorywcze /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($poszkodowany['sprawa_zatrudnienie_id']=='7') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div> inne <?php echo (($poszkodowany['sprawa_zatrudnienie_id']=='7') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ?$poszkodowany['zatrudnienie_tekst'] : ''; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				Przeciętne miesięczne zarobki zmarłego w okresie trzech miesięcy
				przed wypadkiem według mojej wiedzy wynosiły około <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $poszkodowany['zarobki'] : '__________'; ?></b>
				zł netto
			</div>
			<div class="clear_b"></div>

		</div>

		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">INFORMACJE O UPRAWNIONYM/EJ</div>
		</div>
		<div class="tresc_sekcji_fomularza">

			<div class="element">
				W momencie śmierci zmarłego/-ej miałem/am <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $uprawniony_wiek : '__________'; ?></b>.
				Wykształcenie
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_wyksztalcenie_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				podstawowe /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_wyksztalcenie_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				zawodowe /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_wyksztalcenie_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				średnie /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_wyksztalcenie_id']=='4') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				wyższe.
			</div>
			<div class="clear_b"></div>

			<div class="element">
				Zawód wyuczony <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $uprawniony['zawod_wyuczony'] : '__________'; ?></b>,
				zawód wykonywany <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $uprawniony['zawod_wykonywany'] : '__________'; ?></b>
			</div>
			<div class="clear_b"></div>

			<div class="element">Dodatkowe kwalifikacje lub uprawnienia <?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $uprawniony['dodatkowe_kwalifikacje'] : '__________'; ?></div>
			<div class="clear_b"></div>

			<div class="element">Zatrudnienie:</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_zatrudnienie_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				brak /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_zatrudnienie_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				umowa o pracę /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_zatrudnienie_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				umowa zlecenie /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_zatrudnienie_id']=='4') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				własna działalność gospodarcza /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_zatrudnienie_id']=='5') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				gospodarstwo rolne/
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_zatrudnienie_id']=='6') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				prace dorywcze /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($uprawniony['sprawa_zatrudnienie_id']=='7') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div> inne  <?php echo (($uprawniony['sprawa_zatrudnienie_id']=='7') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ?$uprawniony['zatrudnienie_tekst'] : ''; ?></div>
			<div class="clear_b"></div>

			<div class="element">
				Moje miesięczne zarobki w okresie ostatnich trzech miesięcy wynosiły
				średnio <b><?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $uprawniony['zarobki'] : '__________'; ?></b>
				zł netto
			</div>
			<div class="clear_b"></div>

		</div>

		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">STOSUNKI RODZINNE I MAJĄTKOWE</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class="element">Zmarły/-a był/-a dla mnie:</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				mężem
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				żoną
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				partnerem
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='4') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				partnerką
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='5') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				ojcem
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='6') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				matką
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='7') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				synem
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='8') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				córką
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='9') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				bratem
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='10') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				siostrą
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='11') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				wnukiem
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='12') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				wnuczką
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='13') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				dziadkiem
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='14') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				babcią
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pokrewienstwo_id']=='15') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div> inne <?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? $stosunki_rodzinne['pokrewienstwo_tekst'] : ''; ?></div>
			<div class="clear_b"></div>

			<div class="element">Zmarły/-a</div>
			<div class="element">
				<div class="kratka"><?php echo (($zamieszkanie['zmienna1']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				pozostawał/-a ze mną we wspólnym gospodarstwie domowym,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($zamieszkanie['zmienna2']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				był/-a zameldowany/-a ze mną pod jednym adresem,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($zamieszkanie['zmienna3']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				nie był/-a zameldowany/-a ze mną pod jednym adresem, ale faktycznie
				zamieszkiwaliśmy razem,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pomoc_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				pomagał w bieżących obowiązkach związanych z prowadzeniem
				gospodarstwa domowego,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_pomoc_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				nie pomagał w bieżących obowiązkach związanych z prowadzeniem
				gospodarstwa domowego.
			</div>
			<div class="clear_b"></div>

			<div class="element">Moje stosunki ze zmarłym/-ą określam jako</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_stosunki_uprawnionego_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				bardzo zażyłe /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_stosunki_uprawnionego_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				zażyłe /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_stosunki_uprawnionego_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				powierzchowne/
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($stosunki_rodzinne['sprawa_stosunki_uprawnionego_id']=='4') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				złe.
			</div>
			<div class="clear_b"></div>

			<div class="element">Zmarły/-a</div>
			<div class="element">
				<div class="kratka"><?php echo (($utrzymanie['zmienna1']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				był/-a na moim utrzymaniu,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($utrzymanie['zmienna2']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				łożył/-a na moje utrzymanie,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($utrzymanie['zmienna3']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				posiadał/-a ze mną wspólne konto,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($utrzymanie['zmienna4']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				partycypował/-a w kosztach utrzymania rodziny,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($utrzymanie['zmienna5']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				według mojej oceny w przyszłości wspierałby/-aby mnie finansowo w
				razie potrzeby.
			</div>
			<div class="clear_b"></div>

		</div>

		<div class="tytul_sekcji_formularza_szary">
			<div class="pola_w_tytule">SYTUACJA PO ŚMIERCI CZŁONKA NAJBLIŻSZEJ
				RODZINY</div>
		</div>
		<div class="tresc_sekcji_fomularza">
			<div class="element">Według mojej oceny moja sytuacja życiowa w
				sferze majątkowej po śmierci członka najbliższej rodziny</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_sytuacja_majatkowa_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				nie uległa zmianie /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_sytuacja_majatkowa_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				pogorszyła się nieznacznie /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_sytuacja_majatkowa_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				pogorszyła się znacznie.
			</div>
			<div class="clear_b"></div>

			<div class="element">Moja motywacja do poprawy własnej sytuacji
				materialnej</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_motywacja_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				nie uległa zmianie /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_motywacja_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				poprawiła się /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_motywacja_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				pogorszyła się.
			</div>
			<div class="clear_b"></div>

			<div class="element">Po śmierci członka najbliższej rodziny</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_stan_psychiczny_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				odczułem/-am /
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_stan_psychiczny_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				nie odczułem/-am znacznego wstrząsu psychicznego,
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_stan_zdrowia_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				korzystałem/-am ze środków farmakologicznych/ziołowych w związku ze
				złym stanem psychicznym/
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_stan_zdrowia_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				stan mojego zdrowia uległ pogorszeniu,
			</div>
			<div class="clear_b"></div>
			<div class="element">korzystałem/-am z porad/wsparcia:</div>
			<div class="element">
				<div class="kratka"><?php echo (($porady['zmienna1']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				psychiatry
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($porady['zmienna2']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				psychologa
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($porady['zmienna3']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				pedagoga szkolnego
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($porady['zmienna4']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				lekarza pierwszego kontaktu
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($porady['zmienna5']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				duchownego
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($porady['zmienna6']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				rodziny
			</div>

			<div class="clear_b"></div>

			<div class="element">Zmarły/-a pozostawił/-a po sobie</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_pozostawiona_rodzina_id']=='1') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				wdowca
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_pozostawiona_rodzina_id']=='2') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				wdowę
			</div>
			<div class="element">
				<div class="kratka"><?php echo (($sytuacja_rodziny['sprawa_pozostawiona_rodzina_id']=='3') AND ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'X' : ''; ?></div>
				dzieci, ile <b><?php echo (($sprawa['sprawa_typ_szkody_id'] == '2') AND ($sytuacja_rodziny['liczba_dzieci'] != '0') ) ? $sytuacja_rodziny['liczba_dzieci'] : ''; ?></b>&nbsp;
			</div>
			<div class="element">
				w wieku <b><?php echo (($sprawa['sprawa_typ_szkody_id'] == '2') AND ($sytuacja_rodziny['wiek_dzieci'] != '0')) ? $sytuacja_rodziny['wiek_dzieci'] : ''; ?></b>.
			</div>
			<div class="clear_b"></div>

		</div>

	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">MIEJSCOWOŚĆ I DATA</div>
			<div class="podpis_prawo small_font">PODPIS POSZKODOWANEGO LUB
				PRZEDSTAWICIELA USTAWOWEGO</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">5/6</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>

<!-- STRONA SZÓSTA -->

<?php

$oswiadczenie_adres = explode ( ',', $oswiadczenie ['adres'] );
$os_mieszkanie_numer = $oswiadczenie_adres [2];

$os_mijesce_i_data = $oswiadczenie ['miejscowosc'];

if ($oswiadczenie_adres [2] != '') {
	$os_mieszkanie_numer = '/ ' . $os_mieszkanie_numer;
}

if (is_null ( $oswiadczenie )) {
	$os_mijesce_i_data = '';
} else {
	if ($oswiadczenie ['data_oswiadczenia'] != '0000-00-00') {
		$os_mijesce_i_data = $os_mijesce_i_data . ', ' . $oswiadczenie ['data_oswiadczenia'];
	}
}

?>

<div class="strona strona_8">
<?php echo $znak_wodny; ?>
	<div class="tytul_strony_pierwszej">OŚWIADCZENIE</div>
	<div class="formularz_szary">
		<div class="tresc_sekcji_fomularza">

			<div class="sekcja">
				<div class="sekcja_tresc">

					<div class="podpis_lewo small_font">
						<p><?php echo $oswiadczenie['imie_nazwisko']; ?></p>
						IMIĘ I NAZWISKO
					</div>
					<div class="podpis_prawo small_font">
						<p><?php echo $os_mijesce_i_data; ?></p>
						MIEJSCOWOŚĆ I DATA
					</div>
					<div class="clear_b"></div>
					<div class="podpis_lewo small_font podpis_lewo_adres_oswiadczenie">
						<p><?php echo $oswiadczenie_adres[0].' '.$oswiadczenie_adres[1].' '.$os_mieszkanie_numer.'<br/>'.$oswiadczenie_adres[3].' '.$oswiadczenie_adres[4]; ?></p>
						ADRES
					</div>
					<div class="clear_b"></div>
				</div>
			</div>

			<div class="sekcja_tresc justowanie oswiadczenie">

                
            <?php echo $oswiadczenie['wartosc']; ?>                
            </div>
		</div>
	</div>

	<div class="sekcja_tresc">
		<div class="podpis_prawo small_font">PODPIS</div>
		<div class="clear_b"></div>
	</div>

	<div class="strona_stopka">
		<div class="strona_stopka_numer_strony">6/6</div>
		<div class="strona_stopka_napis"><?php echo $numer_stopka; ?></div>
	</div>
</div>