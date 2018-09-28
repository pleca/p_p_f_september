<?php
// Funkcje bazodanowe moduły sprawy
/*
 * if(!isset($_SERVER['HTTP_REFERER'])){
 * session_start();
 * session_destroy();
 * header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
 * die();
 * }
 */
session_start ();

// session_start();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'db/function_db.php');
function pobierz_liste_klientow() {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL sprawa_pobierz_klientow_dla_uzytkownika(' . $_SESSION ['uzytkownik_id'] . ')' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function pobierz_liste_umow() {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL sprawa_pobierz_liste_umow_dla_uzytkownika(' . $_SESSION ['uzytkownik_id'] . ')' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_pobierz_klienta_po_id_dla_uzytkownika($id_zmienna_tmp, $uzytkownik_id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL `sprawa_pobierz_klienta_po_id_dla_uzytkownika`("' . $id_zmienna_tmp . '", "' . $uzytkownik_id_tmp . '" )' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_dane_klienta_dla_uzytkownika($klient_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL sprawa_pobierz_dane_klienta_dla_uzytkownika(' . $klient_id . ')' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function pobierz_umowe_po_id_dla_uzytkownika($id_zmienna_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL pobierz_umowe_po_id_dla_uzytkownika (' . $id_zmienna_tmp . ', ' . $_SESSION ['uzytkownik_id'] . ')' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_dodaj_sprawe($uzytkownik_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL sprawa_dodaj_sprawe (' . $uzytkownik_id . ')' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function uzupelnij_typ_rodzaj($typ_szkody, $rodzaj_wypadku, $id_sprawy) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE sprawa SET sprawa_typ_szkody_id=\'' . $typ_szkody . '\', sprawa_rodzaj_wypadku_id = \'' . $rodzaj_wypadku . '\'  WHERE id = \'' . $id_sprawy . '\' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function pobierz_max_id_poszkodowanego() {
	$polaczenie = polacz_z_baza ();
	$wynik = mysqli_query ( $polaczenie, 'SELECT MAX(id) AS id FROM osoba' );
	$row = mysqli_fetch_assoc ( $wynik );
	mysqli_close ( $polaczenie );
	
	return ($row ['id']);
}
function sprawa_aktualizacja($kolumna, $wartosc, $id_sprawy) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_aktualizacja ('" . $kolumna . "', '" . $wartosc . "', '" . $id_sprawy . "')" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_dodaj_poszkodowany_uprawniony($poszkodowany_imie, $poszkodowany_nazwisko, $poszkodowany_pesel, $poszkodowany_seria_i_numer_dowodu, $poszkodowany_ulica, $poszkodowany_nr_domu, $poszkodowany_nr_mieszkania, $poszkodowany_kod_pocztowy, $poszkodowany_miejscowosc, $poszkodowany_email, $poszkodowany_telefon, $typ_osoby, $narodowosc, $poszkodowany_dokument, $poszkodowany_numer_dokumentu, $id_osoby_dodajacej) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_poszkodowany_uprawniony ('" . $poszkodowany_imie . "', '" . $poszkodowany_nazwisko . "', '" . $poszkodowany_pesel . "', '" . $poszkodowany_seria_i_numer_dowodu . "', '" . $poszkodowany_ulica . "', '" . $poszkodowany_nr_domu . "', '" . $poszkodowany_nr_mieszkania . "', '" . $poszkodowany_kod_pocztowy . "', '" . $poszkodowany_miejscowosc . "', '" . $poszkodowany_email . "', '" . $poszkodowany_telefon . "', '" . $typ_osoby . "', '" . $narodowosc . "', '" . $poszkodowany_dokument . "', '" . $poszkodowany_numer_dokumentu . "', '" . $id_osoby_dodajacej . "')" );
	
	// $wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_poszkodowany_uprawniony ('marek', 'marek', '85220604696', 'ada745298', 'marek', '7', '2', '55-966', 'moja', 'wp@wp.pl', '857412639', '2', '1', 'paszport', 'sasasas', '103')" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_osobe($zleceniodawca_imie, $zleceniodawca_nazwisko, $zleceniodawca_pesel, $zleceniodawca_seria_i_numer_dowodu, $adres_zameldowania, $adres_korespondencji, $sprawa_kontakt, $sprawa_typ_osoby, $czy_obcokrajowiec, $zleceniodawca_dokument, $zleceniodawca_numer_dokumentu, $uzytkownik, $wiek) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_osobe ('" . $zleceniodawca_imie . "', '" . $zleceniodawca_nazwisko . "', '" . $zleceniodawca_pesel . "', '" . $zleceniodawca_seria_i_numer_dowodu . "', '" . $adres_zameldowania . "', '" . $adres_korespondencji . "', '" . $sprawa_kontakt . "', '" . $sprawa_typ_osoby . "', '" . $czy_obcokrajowiec . "', '" . $zleceniodawca_dokument . "', '" . $zleceniodawca_numer_dokumentu . "', '" . $uzytkownik . "', @zmienna, '" . $wiek . "')" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_adres($zleceniodawca_ulica, $zleceniodawca_nr_domu, $zleceniodawca_nr_mieszkania, $zleceniodawca_kod_pocztowy, $zleceniodawca_miejscowosc) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_adres ('" . $zleceniodawca_ulica . "','" . $zleceniodawca_nr_domu . "','" . $zleceniodawca_nr_mieszkania . "','" . $zleceniodawca_kod_pocztowy . "','" . $zleceniodawca_miejscowosc . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_kontakt($zleceniodawca_email, $zleceniodawca_telefon) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_kontakt ('" . $zleceniodawca_email . "', '" . $zleceniodawca_telefon . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_zdarzenie_dodaj_pojazd($pojazd_marka, $pojazd_model, $pojazd_nr_rejestracyjny, $pojazd_kraj_rejestracji, $pojazd_kierujacy_pojazdem, $pojazd_posiadacz_pojazdu, $pojazd_uoc_posiadacz_pojazdu, $pojazd_nr_polisy_oc) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_zdarzenie_dodaj_pojazd ('" . $pojazd_marka . "', '" . $pojazd_model . "','" . $pojazd_nr_rejestracyjny . "', '" . $pojazd_kraj_rejestracji . "', '" . $pojazd_kierujacy_pojazdem . "', '" . $pojazd_posiadacz_pojazdu . "', '" . $pojazd_uoc_posiadacz_pojazdu . "', '" . $pojazd_nr_polisy_oc . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_zdarzenie($data_wypadku, $godzina_wypadku, $miejsce_zdarzenia, $dodaj_pojazd_a, $dodaj_pojazd_b, $rodzaj_zdarzenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_zdarzenie ('" . $data_wypadku . "', '" . $godzina_wypadku . "','" . $miejsce_zdarzenia . "', '" . $dodaj_pojazd_a . "', '" . $dodaj_pojazd_b . "', '" . $rodzaj_zdarzenia . "')" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_opis($opis_zdarzenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_opis ('" . $opis_zdarzenia . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_opis_obrazen($opis_obrazen) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_opis_obrazen ('" . $opis_obrazen . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function aktualizuj_zdarzenie($id_zdarzenia, $stos_poj_a, $stos_poj_b, $poj_a_inny_stosunek, $poj_b_inny_stosunek) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "UPDATE sprawa_zdarzenie SET stosunek_poj_a = '" . $stos_poj_a . "', stosunek_poj_b = '" . $stos_poj_b . "', stosunek_poj_a_tekst = '" . $poj_a_inny_stosunek . "', stosunek_poj_b_tekst = '" . $poj_b_inny_stosunek . "' WHERE id = '" . $id_zdarzenia . "'" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function aktualizuj_rodzaj_zdarzenia($id_zdarzenia, $rodzaj_zdarzenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "UPDATE sprawa_zdarzenie SET rodzaj_zdarzenia = '" . $rodzaj_zdarzenia . "' WHERE id = '" . $id_zdarzenia . "'" );
	
	mysqli_close ( $polaczenie );
}
function aktualizuj_opis_obrazen($id_obrazen, $opis) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "UPDATE sprawa_obrazenia SET wartosc = '" . $opis . "' WHERE id = '" . $id_obrazen . "'" );
	
	mysqli_close ( $polaczenie );
}
function sprawa_dodaj_odpowiedzialnosc_karna($sygnatura_akt, $oswiadczenie, $czy_wezwano_policje, $skad_policja, $czy_wszczeto_postepowanie, $czy_postawiono_zarzut, $art_dla_sprawcy, $czy_umorzono, $art_dla_umorzenia, $czy_skierowano_do_sadu, $nazwa_sadu, $czy_zapadl_wyrok, $wyrok_skazujacy, $wyrok_uniewinniajacy, $wyrok_z_art) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_odpowiedzialnosc_karna ('" . $oswiadczenie . "', '" . $czy_wezwano_policje . "', '" . $skad_policja . "', '" . $czy_wszczeto_postepowanie . "', '" . $czy_postawiono_zarzut . "', '" . $art_dla_sprawcy . "', '" . $czy_umorzono . "', '" . $art_dla_umorzenia . "', '" . $czy_skierowano_do_sadu . "', '" . $nazwa_sadu . "', '" . $czy_zapadl_wyrok . "', '" . $wyrok_skazujacy . "', '" . $wyrok_uniewinniajacy . "', '" . $wyrok_z_art . "', @zmienna, '" . $sygnatura_akt . "')" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_odpowiedzialnosc_cywilna($oc_nr_szkody, $zgl_szkode_w_poj, $data_zgloszenia_w_poj, $zgl_szkode_na_os, $data_zgloszenia_na_os, $odszkodowanie, $wyplaconoa_kwota, $podstawa, $data_uwd) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_odpowiedzialnosc_cywilna ('" . $oc_nr_szkody . "', '" . $zgl_szkode_w_poj . "', '" . $data_zgloszenia_w_poj . "', '" . $zgl_szkode_na_os . "', '" . $data_zgloszenia_na_os . "', '" . $odszkodowanie . "', '" . $wyplaconoa_kwota . "', '" . $podstawa . "', '" . $data_uwd . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_dochodzenie_roszczen($czy_zlecono, $komu_zlecono, $kiedy_zlecono, $czy_wypowiedziano, $kiedy_wypowiedziano, $ile_kart) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_dochodzenie_roszczen ('" . $czy_zlecono . "', '" . $komu_zlecono . "', '" . $kiedy_zlecono . "', '" . $czy_wypowiedziano . "', '" . $kiedy_wypowiedziano . "', @zmienna, '" . $ile_kart . "')" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_inne_odszkodowania($zgloszono_nnw, $komu_zgloszono, $jaki_wypadek, $ubezpieczenie, $kto_inny, $zasilek, $prod_finansowe, $gamma, $dzialalnosc, $pcrf, $uszczerbek_nnw, $procent_nnw, $ubezp_procent_uszczerbku, $jednorazowe_odszkodowanie, $kwota_odszkodowania, $zwolnienie, $zwolnienie_od, $zwolnienie_do, $orzeczenie, $orzeczenie_id, $orzeczenie_do, $ubezpieczyciel_id, $inne_nazwa, $swiadczenie_id, $swiadczenie_inne_nazwa, $kwota_swiadczenia, $data_swiadczenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_inne_odszkodowania (
			'" . $zgloszono_nnw . "'
			, '" . $komu_zgloszono . "'
			, '" . $jaki_wypadek . "'
			, '" . $ubezpieczenie . "'
			, '" . $kto_inny . "'
			, '" . $zasilek . "'
			, '" . $prod_finansowe . "'
			, @zmienna
			, '" . $gamma . "'
			, '" . $dzialalnosc . "'
			, '" . $pcrf . "'
			, '" . $uszczerbek_nnw . "'
			, '" . $procent_nnw . "'
			, '" . $ubezp_procent_uszczerbku . "'
			, '" . $jednorazowe_odszkodowanie . "'
			, '" . $kwota_odszkodowania . "'
			, '" . $zwolnienie . "'
			, '" . $zwolnienie_od . "'
			, '" . $zwolnienie_do . "'
			, '" . $orzeczenie . "'
			, '" . $orzeczenie_id . "'
			, '" . $orzeczenie_do . "'
			, '" . $ubezpieczyciel_id . "'
			, '" . $inne_nazwa . "'
			, '" . $swiadczenie_id . "'
			, '" . $swiadczenie_inne_nazwa . "'
			, '" . $kwota_swiadczenia . "'
			, '" . $data_swiadczenia . "'
			)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_pobierz_id_z_tabeli_sprawa($id_sprawy, $nazwa_kolumny) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa` WHERE `id` = " . $id_sprawy . "" );
	$wynik = mysqli_fetch_assoc ( $wynik );
	$wynikowe_id = $wynik [$nazwa_kolumny];
	
	mysqli_close ( $polaczenie );
	
	return $wynikowe_id;
}
function sprawa_pobierz_date_zdarzenia($id_zdarzenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT `data` FROM `sprawa_zdarzenie` WHERE `id` = " . $id_zdarzenia . "" );
	$wynik = mysqli_fetch_assoc ( $wynik );
	$data = $wynik ['data'];
	
	mysqli_close ( $polaczenie );
	
	return $data;
}
function sprawa_pobierz_dane($id_zdarzenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT `data` FROM `sprawa_zdarzenie` WHERE `id` = " . $id_zdarzenia . "" );
	$wynik = mysqli_fetch_assoc ( $wynik );
	$data = $wynik ['data'];
	
	mysqli_close ( $polaczenie );
	
	return $data;
}
function sprawa_dodaj_stosunki_rodzinne($pokrewienstwo, $pokrewienstwo_tekst, $stosunki_mieszkaniowe, $pomoc, $stosunki_uprawnionego, $utrzymanie) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_stosunki_rodzinne ('" . $pokrewienstwo . "', '" . $pokrewienstwo_tekst . "', '" . $stosunki_mieszkaniowe . "', '" . $pomoc . "', '" . $stosunki_uprawnionego . "', '" . $utrzymanie . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_sytuacja_rodziny($sytuacja_majatkowa, $motywacja, $porady, $pozostawiona_rodzina, $stan_psychiczny, $stan_zdrowia, $liczba_dzieci, $wiek_dzieci, $czy_zostal_malzonek) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_sytuacja_rodziny ('" . $sytuacja_majatkowa . "', '" . $motywacja . "', '" . $porady . "', '" . $pozostawiona_rodzina . "', '" . $stan_psychiczny . "', '" . $stan_zdrowia . "', '" . $liczba_dzieci . "', '" . $wiek_dzieci . "', '" . $czy_zostal_malzonek . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_aktualizuj_osobe($id_osoby, $wyksztalcenie_id, $zatrudnienie_id, $zatrudnienie_tekst, $zawod_wyuczony, $zawod_wykonywany, $dodatkowe_kwalifikacje, $zarobki, $wiek) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_aktualizuj_osobe ('" . $id_osoby . "', '" . $wyksztalcenie_id . "', '" . $zatrudnienie_id . "', '" . $zatrudnienie_tekst . "', '" . $zawod_wyuczony . "', '" . $zawod_wykonywany . "', '" . $dodatkowe_kwalifikacje . "', '" . $zarobki . "', '" . $wiek . "')" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
/* kamyk 2016-08-19 */
function sprawa_dodaj_oswiadczenie($opis_tmp, $miejscowosc_tmp, $data_tmp, $imie_nazwisko_tmp, $adres_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_oswiadczenie ('" . $opis_tmp . "', '" . $miejscowosc_tmp . "', '" . $data_tmp . "', '" . $imie_nazwisko_tmp . "', '" . $adres_tmp . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_umowe($umowa, $prowizja) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "CALL sprawa_dodaj_umowe ('" . $umowa . "', '" . $prowizja . "', @zmienna)" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_dodaj_rachunek($id_uprawnionego, $rachunek_bankowy) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "UPDATE `sprawa_osoba` SET `nr_rachunku` = '" . $rachunek_bankowy . "' WHERE `id` = '" . $id_uprawnionego . "'" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_platnosc_uposazony($id_umowy, $forma_platnosci, $osoba_do_wyplaty) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "UPDATE sprawa_umowa SET forma_platnosci = '" . $forma_platnosci . "', osoba_do_wyplaty_id = '" . $osoba_do_wyplaty . "' WHERE `id` = " . $id_umowy . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_dane_osoby($zleceniodawca_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_osoba` WHERE `id` = " . $zleceniodawca_id . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_dane_umowy($umowa_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_umowa` WHERE `id` = " . $umowa_id . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_adres($adres_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_adres` WHERE `id` = " . $adres_id . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_kontakt($kontakt_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_kontakt` WHERE `id` = " . $kontakt_id . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_dane_sprawy($id_sprawy) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa` WHERE `id` = " . $id_sprawy . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_dane_z_tabeli_zdarzenie($id_zdarzenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_zdarzenie` WHERE `id` = " . $id_zdarzenia . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_dane_pojazdu($id_pojazdu) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_zdarzenie_pojazd` WHERE `id` = " . $id_pojazdu . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_opis_zdarzenia($id_opisu) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_opis` WHERE `id` = " . $id_opisu . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_odpowiedzialnosc_karna($id_odpowiedzialnosc_karna) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_odpowiedzialnosc_karna` WHERE `id` = " . $id_odpowiedzialnosc_karna . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_odpowiedzialnosc_cywilna($id_odpowiedzialnosc_cywilna) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_odpowiedzialnosc_cywilna` WHERE `id` = " . $id_odpowiedzialnosc_cywilna . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_inne_odszkodowania($id_inne_odszkodowania) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_inne_odszkodowania` WHERE `id` = " . $id_inne_odszkodowania . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_dochodzenie_roszczen($id_dochodzenie_roszczen) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_dochodzenie_roszczen` WHERE `id` = " . $id_dochodzenie_roszczen . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_stosunki_rodzinne($id_stosunki_rodzinne) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_stosunki_rodzinne` WHERE `id` = " . $id_stosunki_rodzinne . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_sytuacja_rodziny($id_sytuacja_rodziny) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_sytuacja_rodziny` WHERE `id` = " . $id_sytuacja_rodziny . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_oswiadczenie($id_oswiadczenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_oswiadczenie` WHERE `id` = " . $id_oswiadczenia . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

/* --------------------------------------------------------------------------------------------------------------- */
function sprawa_klient_zapisz_zmiany($zleceniodawca_id_tmp, $zleceniodawca_imie_tmp, $zleceniodawca_nazwisko_tmp, $zleceniodawca_ulica_tmp, $zleceniodawca_nr_domu_tmp, $zleceniodawca_nr_mieszkania_tmp, $zleceniodawca_kod_pocztowy_tmp, $zleceniodawca_miejscowosc_tmp, $zleceniodawca_dokument_tmp, $zleceniodawca_numer_dokumentu_tmp, $zleceniodawca_pesel_tmp, $zleceniodawca_seria_i_numer_dowodu_tmp, $zleceniodawca_czy_obcokrajowiec_tmp, $zleceniodawca_email_tmp, $zleceniodawca_telefon_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL `sprawa_klient_zapisz_zmiany`(
					"' . $zleceniodawca_id_tmp . '"
					, "' . $zleceniodawca_imie_tmp . '"
					, "' . $zleceniodawca_nazwisko_tmp . '"
					, "' . $zleceniodawca_ulica_tmp . '"
					, "' . $zleceniodawca_nr_domu_tmp . '"
					, "' . $zleceniodawca_nr_mieszkania_tmp . '"
					, "' . $zleceniodawca_kod_pocztowy_tmp . '"
					, "' . $zleceniodawca_miejscowosc_tmp . '"
					, "' . $zleceniodawca_dokument_tmp . '"
					, "' . $zleceniodawca_numer_dokumentu_tmp . '"
					, "' . $zleceniodawca_pesel_tmp . '"
					, "' . $zleceniodawca_seria_i_numer_dowodu_tmp . '"
					, "' . $zleceniodawca_czy_obcokrajowiec_tmp . '"
					, "' . $zleceniodawca_email_tmp . '"
					, "' . $zleceniodawca_telefon_tmp . '"
			)' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_pobierz_wszystkie_dane_po_id_sprawy($sprawa_id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa`  WHERE `id` = " . $sprawa_id_tmp . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_kratka_zapisz_zmiane($tabela_tmp, $id_tmp, $komorka_tmp, $wartosc_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `' . $tabela_tmp . '` SET `' . $komorka_tmp . '`=' . $wartosc_tmp . ' WHERE `id` = ' . $id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_adres_kor_dodaj_nowy($zleceniodawca_ulica_kor_tmp, $zleceniodawca_nr_domu_kor_tmp, $zleceniodawca_nr_mieszkania_kor_tmp, $zleceniodawca_kod_pocztowy_kor_tmp, $zleceniodawca_miejscowosc_kor_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL sprawa_dodaj_adres("' . $zleceniodawca_ulica_kor_tmp . '", "' . $zleceniodawca_nr_domu_kor_tmp . '", "' . $zleceniodawca_nr_mieszkania_kor_tmp . '", "' . $zleceniodawca_kod_pocztowy_kor_tmp . '", "' . $zleceniodawca_miejscowosc_kor_tmp . '", @id_tmp)' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_adres_kor_usun($sprawa_adres_korespondencja_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' DELETE FROM `sprawa_adres` WHERE `id` = ' . $sprawa_adres_korespondencja_id . ' ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_adres_kor_zapisz_zmiany($adres_kor_id_tmp, $zleceniodawca_ulica_kor_tmp, $zleceniodawca_nr_domu_kor_tmp, $zleceniodawca_nr_mieszkania_kor_tmp, $zleceniodawca_kod_pocztowy_kor_tmp, $zleceniodawca_miejscowosc_kor_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' UPDATE `sprawa_adres` SET `ulica`="' . $zleceniodawca_ulica_kor_tmp . '",`nr_domu`="' . $zleceniodawca_nr_domu_kor_tmp . '",`nr_mieszkania`="' . $zleceniodawca_nr_mieszkania_kor_tmp . '",`kod_pocztowy`="' . $zleceniodawca_kod_pocztowy_kor_tmp . '",`miasto`="' . $zleceniodawca_miejscowosc_kor_tmp . '" WHERE `id`=' . $adres_kor_id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_pobierz_dane_z_tabeli_po_id($nazwa_tabeli_tmp, $id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `' . $nazwa_tabeli_tmp . '` WHERE `id` = ' . $id_tmp . '' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_input_zapisz_zmiane($tabela_tmp, $id_tmp, $komorka_tmp, $wartosc_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `' . $tabela_tmp . '` SET `' . $komorka_tmp . '`="' . $wartosc_tmp . '" WHERE `id` = ' . $id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_aktualizuj_poszkodowanego_uprawnionego($sprawa_id_tmp, $imie_tmp, $nazwisko_tmp, $pesel_tmp, $dowod_tmp, $ulica_tmp, $nr_domu_tmp, $nr_mieszkania_tmp, $kod_pocztowy_tmp, $miasto_tmp, $email_tmp, $telefon_tmp, $sprawa_typ_osoby_id_tmp, $czy_obcokrajowiec_tmp, $rodzaj_dokumentu_tmp, $nr_dokumentu_tmp, $id_osoby_dodajacej_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_poszkodowanego_uprawnionego`(
				"' . $sprawa_id_tmp . '"
				,"' . $imie_tmp . '"
				,"' . $nazwisko_tmp . '"
				,"' . $pesel_tmp . '"
				,"' . $dowod_tmp . '"
				,"' . $ulica_tmp . '"
				,"' . $nr_domu_tmp . '"
				,"' . $nr_mieszkania_tmp . '"
				,"' . $kod_pocztowy_tmp . '"
				,"' . $miasto_tmp . '"
				,"' . $email_tmp . '"
				,"' . $telefon_tmp . '"
				,"' . $sprawa_typ_osoby_id_tmp . '"
				,"' . $czy_obcokrajowiec_tmp . '"
				,"' . $rodzaj_dokumentu_tmp . '"
				,"' . $nr_dokumentu_tmp . '"
				,"' . $id_osoby_dodajacej_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

/* KaMyK 2016-08-11 */
function sprawa_uprawniony_do_inf_dodaj_nowy($uprawniony_imie_tmp, $uprawniony_nazwisko_tmp, $uprawniony_pesel_tmp, $typ_osoba_tmp, $sprawa_id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_uprawniony_do_inf_dodaj_nowy`("' . $uprawniony_imie_tmp . '","' . $uprawniony_nazwisko_tmp . '","' . $uprawniony_pesel_tmp . '","' . $typ_osoba_tmp . '","' . $sprawa_id_tmp . '", "' . $_SESSION ['uzytkownik_id'] . '") ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_uprawniony_do_inf_zapisz_zmiany($uprawniony_do_inf_id_tmp, $uprawniony_imie_tmp, $uprawniony_nazwisko_tmp, $uprawniony_pesel_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `sprawa_osoba` SET `imie`="' . $uprawniony_imie_tmp . '",`nazwisko`="' . $uprawniony_nazwisko_tmp . '",`pesel`="' . $uprawniony_pesel_tmp . '" WHERE `id` = ' . $uprawniony_do_inf_id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
}

/* kamyk 2016-08-12 */
function sprawa_aktualizuj_zdarzenie($sprawa_id_tmp, $data_tmp, $godzina_tmp, $miejsce_tmp, $marka_a_tmp, $typ_pojazdu_a_tmp, $nr_rejestracyjny_a_tmp, $kraj_rejestracji_a_tmp, $kierujacy_a_tmp, $posiadacz_a_tmp, $ubezpieczyciel_a_tmp, $nr_oc_a_tmp, $marka_b_tmp, $typ_pojazdu_b_tmp, $nr_rejestracyjny_b_tmp, $kraj_rejestracji_b_tmp, $kierujacy_b_tmp, $posiadacz_b_tmp, $ubezpieczyciel_b_tmp, $nr_oc_b_tmp, $stosunek_poj_a_tmp, $stosunek_poj_a_tekst_tmp, $stosunek_poj_b_tmp, $stosunek_poj_b_tekst_tmp, $opis_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_zdarzenie`(
				"' . $sprawa_id_tmp . '"		
				,"' . $data_tmp . '"
				,"' . $godzina_tmp . '"
				,"' . $miejsce_tmp . '"	
				,"' . $marka_a_tmp . '"
				,"' . $typ_pojazdu_a_tmp . '"
				,"' . $nr_rejestracyjny_a_tmp . '"
				,"' . $kraj_rejestracji_a_tmp . '"
				,"' . $kierujacy_a_tmp . '"
				,"' . $posiadacz_a_tmp . '"
				,"' . $ubezpieczyciel_a_tmp . '"
				,"' . $nr_oc_a_tmp . '"		
				,"' . $marka_b_tmp . '"
				,"' . $typ_pojazdu_b_tmp . '"
				,"' . $nr_rejestracyjny_b_tmp . '"
				,"' . $kraj_rejestracji_b_tmp . '"
				,"' . $kierujacy_b_tmp . '"
				,"' . $posiadacz_b_tmp . '"
				,"' . $ubezpieczyciel_b_tmp . '"
				,"' . $nr_oc_b_tmp . '"		
				,"' . $stosunek_poj_a_tmp . '"
				,"' . $stosunek_poj_a_tekst_tmp . '"
				,"' . $stosunek_poj_b_tmp . '"
				,"' . $stosunek_poj_b_tekst_tmp . '"
				,"' . $opis_tmp . '"
					
			) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_aktualizuj_odpowiedzialnosc_karna($sprawa_id_tmp, $sygnatura_akt_tmp, $oswiadczenie_tmp, $wezwano_policje_tmp, $skad_policja_tmp, $wszczeto_postepowanie_tmp, $zarzut_tmp, $zarzut_z_art_tmp, $umorzono_tmp, $umorz_na_podst_tmp, $do_sadu_tmp, $nazwa_sadu_tmp, $czy_wyrok_tmp, $skazujacy_tmp, $uniewinniajacy_tmp, $wyrok_z_art_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_odpowiedzialnosc_karna`(
				"' . $sprawa_id_tmp . '"
				,"' . $sygnatura_akt_tmp . '"
				,"' . $oswiadczenie_tmp . '"
				,"' . $wezwano_policje_tmp . '"
				,"' . $skad_policja_tmp . '"
				,"' . $wszczeto_postepowanie_tmp . '"
				,"' . $zarzut_tmp . '"
				,"' . $zarzut_z_art_tmp . '"
				,"' . $umorzono_tmp . '"
				,"' . $umorz_na_podst_tmp . '"
				,"' . $do_sadu_tmp . '"
				,"' . $nazwa_sadu_tmp . '"
				,"' . $czy_wyrok_tmp . '"
				,"' . $skazujacy_tmp . '"
				,"' . $uniewinniajacy_tmp . '"
				,"' . $wyrok_z_art_tmp . '"
			
			) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

/* kamyk 2016-08-16 */
function sprawa_aktualizuj_odpowiedzialnosc_cywilna($sprawa_id_tmp, $nr_szkody_tmp, $zgl_szkode_w_poj_tmp, $data_zgl_w_poj_tmp, $zgl_szkode_na_os_tmp, $data_zgl_na_os_tmp, $co_z_oc_tmp, $kwota_tmp, $podstawa_tmp, $data_decyzji_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_odpowiedzialnosc_cywilna`(
				"' . $sprawa_id_tmp . '"
				,"' . $nr_szkody_tmp . '"
				,"' . $zgl_szkode_w_poj_tmp . '"
				,"' . $data_zgl_w_poj_tmp . '"
				,"' . $zgl_szkode_na_os_tmp . '"
				,"' . $data_zgl_na_os_tmp . '"
				,"' . $co_z_oc_tmp . '"
				,"' . $kwota_tmp . '"
				,"' . $podstawa_tmp . '"
				,"' . $data_decyzji_tmp . '"
	) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_aktualizuj_dochodzenie_roszczen($sprawa_id_tmp, $czy_zlecono_tmp, $komu_zlecono_tmp, $kiedy_zlecono_tmp, $czy_wypowiedziano_tmp, $kiedy_wypowiedziano_tmp, $ile_kart_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_dochodzenie_roszczen`(
				"' . $sprawa_id_tmp . '"
				,"' . $czy_zlecono_tmp . '"
				,"' . $komu_zlecono_tmp . '"
				,"' . $kiedy_zlecono_tmp . '"
				,"' . $czy_wypowiedziano_tmp . '"
				,"' . $kiedy_wypowiedziano_tmp . '"
				,"' . $ile_kart_tmp . '"
	) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_aktualizuj_inne_odszkodowania($sprawa_id_tmp, $zgloszono_nnw_tmp, $komu_zgloszono_tmp, $jaki_wypadek_tmp, $gdzie_zgloszono_tmp, $inne_tekst_tmp, $zasilek_pogrzebowy_tmp, $oferta_finansowa_tmp, $gamma_tmp, $dzialalnosc_tmp, $pcrf_tmp, $uszczerbek_nnw_tmp, $procent_nnw_tmp, $ubezp_procent_uszczerbku_tmp, $jednorazowe_odszkodowanie_tmp, $kwota_odszkodowania_tmp, $zwolnienie_tmp, $zwolnienie_od_tmp, $zwolnienie_do_tmp, $orzeczenie_tmp, $orzeczenie_id_tmp, $orzeczenie_do_tmp, $ubezpieczyciel_id_tmp, $inne_nazwa_tmp, $swiadczenie_id_tmp, $swiadczenie_inne_nazwa_tmp, $kwota_swiadczenia_tmp, $data_swiadczenia_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_inne_odszkodowania`(
				"' . $sprawa_id_tmp . '"
				,"' . $zgloszono_nnw_tmp . '"
				,"' . $komu_zgloszono_tmp . '"
				,"' . $jaki_wypadek_tmp . '"
				,"' . $gdzie_zgloszono_tmp . '"
				,"' . $inne_tekst_tmp . '"
				,"' . $zasilek_pogrzebowy_tmp . '"
				,"' . $oferta_finansowa_tmp . '"
				,"' . $gamma_tmp . '"
				,"' . $dzialalnosc_tmp . '"
                ,"' . $prcf_tmp . '"
			
				,"' . $uszczerbek_nnw_tmp . '"
				,"' . $procent_nnw_tmp . '"
				,"' . $ubezp_procent_uszczerbku_tmp . '"
				,"' . $jednorazowe_odszkodowanie_tmp . '"
				,"' . $kwota_odszkodowania_tmp . '"
				,"' . $zwolnienie_tmp . '"
				,"' . $zwolnienie_od_tmp . '"
				,"' . $zwolnienie_do_tmp . '"
				,"' . $orzeczenie_tmp . '"
				,"' . $orzeczenie_id_tmp . '"
                ,"' . $orzeczenie_do_tmp . '"
				,"' . $ubezpieczyciel_id_tmp . '"
				,"' . $inne_nazwa_tmp . '"
				,"' . $swiadczenie_id_tmp . '"
				,"' . $swiadczenie_inne_nazwa_tmp . '"
				,"' . $kwota_swiadczenia_tmp . '"
                ,"' . $data_swiadczenia_tmp . '"
	) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

/* kamyk 2016-08-17 */
function sprawa_dubluj_sprawe($id_wzor_tmp, $id_aktualna_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dubluj_sprawe`("' . $id_wzor_tmp . '","' . $id_aktualna_tmp . '") ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function pobierz_liste_klientow_ze_sprawami() {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL sprawa_pobierz_klientow_dla_uzytkownika_z_sprawami(' . $_SESSION ['uzytkownik_id'] . ')' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

/* kamyk 2016-08-19 */
function sprawa_aktualizuj_ostatnia_strone($id_sprawy_tmp, $nr_strony_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_ostatnia_strone`("' . $id_sprawy_tmp . '","' . $nr_strony_tmp . '") ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_pobierz_jednostki() {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_pobierz_jednostki`() ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawa_dodaj_lub_aktualizuj_rekomendacje($sprawa_id_tmp, $rekomendacja_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_rekomendacje`("' . $sprawa_id_tmp . '","' . $rekomendacja_tmp . '") ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_aktualizuj_strona_11_1($sprawa_id_tmp, $wiek_w_momencie_smierci_tmp, $sprawa_wyksztalcenie_tmp, $zawod_wyuczony_tmp, $zawod_wykonywany_tmp, $dodatkowe_kwalifikacje_tmp, $sprawa_zatrudnienie_tmp, $zatrudnienie_tekst_tmp, $zarobki_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_strona_11_1`(
				"' . $sprawa_id_tmp . '"
				,"' . $wiek_w_momencie_smierci_tmp . '"
				,"' . $sprawa_wyksztalcenie_tmp . '"
				,"' . $zawod_wyuczony_tmp . '"
				,"' . $zawod_wykonywany_tmp . '"
				,"' . $dodatkowe_kwalifikacje_tmp . '"
				,"' . $sprawa_zatrudnienie_tmp . '"
				,"' . $zatrudnienie_tekst_tmp . '"
				,"' . $zarobki_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_aktualizuj_strona_11_2($sprawa_id_tmp, $wiek_w_momencie_smierci_tmp, $sprawa_wyksztalcenie_tmp, $zawod_wyuczony_tmp, $zawod_wykonywany_tmp, $dodatkowe_kwalifikacje_tmp, $sprawa_zatrudnienie_tmp, $zatrudnienie_tekst_tmp, $zarobki_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_strona_11_2`(
				"' . $sprawa_id_tmp . '"
				,"' . $wiek_w_momencie_smierci_tmp . '"
				,"' . $sprawa_wyksztalcenie_tmp . '"
				,"' . $zawod_wyuczony_tmp . '"
				,"' . $zawod_wykonywany_tmp . '"
				,"' . $dodatkowe_kwalifikacje_tmp . '"
				,"' . $sprawa_zatrudnienie_tmp . '"
				,"' . $zatrudnienie_tekst_tmp . '"
				,"' . $zarobki_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_aktualizuj_strona_11_3($sprawa_id_tmp, $sprawa_pokrewienstwo_tmp, $pokrewienstwo_tekst_tmp, $sprawa_stosunki_mieszkaniowe_tmp, $sprawa_pomoc_tmp, $sprawa_stosunki_uprawnionego_tmp, $sprawa_utrzymanie_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_strona_11_3`(
				"' . $sprawa_id_tmp . '"
				,"' . $sprawa_pokrewienstwo_tmp . '"
				,"' . $pokrewienstwo_tekst_tmp . '"
				,"' . $sprawa_stosunki_mieszkaniowe_tmp . '"
				,"' . $sprawa_pomoc_tmp . '"
				,"' . $sprawa_stosunki_uprawnionego_tmp . '"
				,"' . $sprawa_utrzymanie_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}

/* kamyk 2016-08-22 */
function sprawa_aktualizuj_strona_11_4($sprawa_id_tmp, $sprawa_sytuacja_majatkowa_tmp, $sprawa_motywacja_tmp, $sprawa_porady_tmp, $sprawa_pozostawiona_rodzina_tmp, $sprawa_stan_psychiczny_tmp, $sprawa_stan_zdrowia_tmp, $liczba_dzieci_tmp, $wiek_dzieci_tmp, $czy_zostal_malzonek_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_strona_11_4`(
				"' . $sprawa_id_tmp . '"
				,"' . $sprawa_sytuacja_majatkowa_tmp . '"
				,"' . $sprawa_motywacja_tmp . '"
				,"' . $sprawa_porady_tmp . '"
				,"' . $sprawa_pozostawiona_rodzina_tmp . '"
				,"' . $sprawa_stan_psychiczny_tmp . '"
				,"' . $sprawa_stan_zdrowia_tmp . '"
				,"' . $liczba_dzieci_tmp . '"
				,"' . $wiek_dzieci_tmp . '"
				,"' . $czy_zostal_malzonek_tmp. '"
			) ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_aktualizuj_oswiadczenie($sprawa_id_tmp, $opis_tmp, $miejscowosc_tmp, $imie_nazwisko_tmp, $adres_tmp, $data_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_oswiadczenie`(
				"' . $sprawa_id_tmp . '"
				,"' . $opis_tmp . '"
				,"' . $miejscowosc_tmp . '"
				,"' . $imie_nazwisko_tmp . '"
				,"' . $adres_tmp . '"
				,"' . $data_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_aktualizuj_umowe_strona_13($sprawa_id_tmp, $nazwa_tmp, $prowizja_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_umowe_strona_13`(
				"' . $sprawa_id_tmp . '"
				,"' . $nazwa_tmp . '"
				,"' . $prowizja_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_pobierz_warosc_z_tabeli_po_id($kolumna_tmp, $tabela_tmp, $id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT `' . $kolumna_tmp . '` FROM `' . $tabela_tmp . '` WHERE `id` = ' . $id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_aktualizuj_umowe_strona_14($sprawa_id_tmp, $forma_platnosci_tmp, $id_odbiorcy_tmp, $imie_tmp, $nazwisko_tmp, $ulica_tmp, $nr_domu_tmp, $nr_mieszkania_tmp, $kod_pocztowy_tmp, $miasto_tmp, $rachunek_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_aktualizuj_umowe_strona_14`(
				"' . $sprawa_id_tmp . '"
				,"' . $forma_platnosci_tmp . '"
				,"' . $id_odbiorcy_tmp . '"
				,"' . $imie_tmp . '"
				,"' . $nazwisko_tmp . '"
				,"' . $ulica_tmp . '"
				,"' . $nr_domu_tmp . '"
				,"' . $nr_mieszkania_tmp . '"
				,"' . $kod_pocztowy_tmp . '"
				,"' . $miasto_tmp . '"
				,"' . $rachunek_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}

/* medyk 29-08-2016 */
function sprawa_dodaj_lub_aktualizuj_strona_11_a_1($sprawa_id_tmp, $pod_wplywem_tmp, $sprawa_uzywki_id_tmp, $w_pojezdzie_tmp, $rola_tmp, $sprawa_typ_pojazdu_id_tmp, $typ_pojazdu_inny_tmp, $kierowca_tmp, $sprawa_pozycja_id_tmp, $pozycja_inna_tmp, $pasy_tmp, $wspolwlasnosc_tmp, $wiedza_o_stanie_kierowcy_tmp, $wiedza_o_upr_kierowcy_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_strona_11_a_1`(
				"' . $sprawa_id_tmp . '"
				,"' . $pod_wplywem_tmp . '"
				,"' . $sprawa_uzywki_id_tmp . '"
				,"' . $w_pojezdzie_tmp . '"
				,"' . $rola_tmp . '"
				,"' . $sprawa_typ_pojazdu_id_tmp . '"
				,"' . $typ_pojazdu_inny_tmp . '"
				,"' . $kierowca_tmp . '"
				,"' . $sprawa_pozycja_id_tmp . '"
				,"' . $pozycja_inna_tmp . '"
				,"' . $pasy_tmp . '"
                ,"' . $wspolwlasnosc_tmp . '"
		        ,"' . $wiedza_o_stanie_kierowcy_tmp . '"
		        ,"' . $wiedza_o_upr_kierowcy_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_dodaj_lub_aktualizuj_strona_11_a_2($sprawa_id_tmp, $sprawa_stan_leczenia_id_tmp, $leczenie_koniec_tmp, $leczenie_plan_koniec_tmp, $data_pocz_zw_tmp, $data_kon_zw_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_strona_11_a_2`(
				"' . $sprawa_id_tmp . '"
				,"' . $sprawa_stan_leczenia_id_tmp . '"
				,"' . $leczenie_koniec_tmp . '"
				,"' . $leczenie_plan_koniec_tmp . '"
				,"' . $data_pocz_zw_tmp . '"
				,"' . $data_kon_zw_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_dodaj_lub_aktualizuj_strona_11_a_3($sprawa_id_tmp, $skad_pogotowie_tmp, $przychodnia_tmp, $przychodnia_data_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_strona_11_a_3`(
				"' . $sprawa_id_tmp . '"
				,"' . $skad_pogotowie_tmp . '"
				,"' . $przychodnia_tmp . '"
				,"' . $przychodnia_data_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_dodaj_lub_aktualizuj_hospitalizacja($id_tmp, $sprawa_przebieg_leczenia_id_tmp, $nazwa_tmp, $data_tmp, $data_do_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_hospitalizacja`(
                "' . $id_tmp . '"
				,"' . $sprawa_przebieg_leczenia_id_tmp . '"
				,"' . $nazwa_tmp . '"
				,"' . $data_tmp . '"
				,"' . $data_do_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_dodaj_lub_aktualizuj_placowki($id_tmp, $sprawa_przebieg_leczenia_id_tmp, $nazwa_tmp, $data_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_placowki`(
                "' . $id_tmp . '"
				,"' . $sprawa_przebieg_leczenia_id_tmp . '"
				,"' . $nazwa_tmp . '"
				,"' . $data_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
}
function sprawa_pobierz_miejsce_hospitalizacji($id_przebieg_leczenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_hospitalizacja` WHERE `sprawa_przebieg_leczenia_id` = " . $id_przebieg_leczenia . "" );
	
	mysqli_close ( $polaczenie );
	
	return ($wynik);
}
function sprawa_pobierz_placowki($id_przebieg_leczenia) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_placowki` WHERE `sprawa_przebieg_leczenia_id` = " . $id_przebieg_leczenia . "" );
	
	mysqli_close ( $polaczenie );
	
	return ($wynik);
}
function usun_hospitalizacja($id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "DELETE FROM `sprawa_hospitalizacja` WHERE id=" . $id );
	
	mysqli_close ( $polaczenie );
}
function usun_placowka($id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "DELETE FROM `sprawa_placowki` WHERE id=" . $id );
	
	mysqli_close ( $polaczenie );
}
function sprawa_dodaj_lub_aktualizuj_utrzymanie($id_tmp, $zmienna1_tmp, $zmienna2_tmp, $zmienna3_tmp, $zmienna4_tmp, $zmienna5_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_utrzymanie`(
                "' . $id_tmp . '"
				,"' . $zmienna1_tmp . '"
				,"' . $zmienna2_tmp . '"
				,"' . $zmienna3_tmp . '"
				,"' . $zmienna4_tmp . '"
				,"' . $zmienna5_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
	
	return ($wynik);
}
function sprawa_dodaj_lub_aktualizuj_stosunki_mieszkaniowe($id_tmp, $zmienna1_tmp, $zmienna2_tmp, $zmienna3_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_stosunki_mieszkaniowe`(
                "' . $id_tmp . '"
				,"' . $zmienna1_tmp . '"
				,"' . $zmienna2_tmp . '"
				,"' . $zmienna3_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
	
	return ($wynik);
}
function sprawa_dodaj_lub_aktualizuj_porady($id_tmp, $zmienna1_tmp, $zmienna2_tmp, $zmienna3_tmp, $zmienna4_tmp, $zmienna5_tmp, $zmienna6_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_porady`(
                "' . $id_tmp . '"
				,"' . $zmienna1_tmp . '"
				,"' . $zmienna2_tmp . '"
				,"' . $zmienna3_tmp . '"
				,"' . $zmienna4_tmp . '"
				,"' . $zmienna5_tmp . '"
				,"' . $zmienna6_tmp . '"
			) ' );
	
	mysqli_close ( $polaczenie );
	
	return ($wynik);
}
function uzytkownik_pobierz_po_id($id_uzytkownika_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `uzytkownik_pobierz_po_id`("' . $id_uzytkownika_tmp . '") ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function aktualizuj_osobe($id_sprawa_tmp, $wartosc_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "UPDATE sprawa_osoba SET typ_poszkodowanego = '" . $wartosc_tmp . "' WHERE id = '" . $id_sprawa_tmp . "'" );
	
	mysqli_close ( $polaczenie );
}
function sprawa_dodaj_lub_aktualizuj_inne_odszkodowania($id_tmp, $zgloszono_nnw_tmp, $komu_zgloszono_tmp, $jaki_wypadek_tmp, $gdzie_zgloszono_id_tmp, $inne_tekst_tmp, $zasilek_pogrzebowy_tmp, $oferta_finansowa_tmp, $gamma_tmp, $dzialalnosc_tmp, $pcrf_tmp, $fundacja_tmp, $uszczerbek_nnw_tmp, $uszczerbek_nnw_procent_tmp, $uszczerbek_ubezp_procent_tmp, $jednorazowe_odszkodowanie_tmp, $jednorazowe_odszkodowanie_kwota_tmp, $zwolnienie_tmp, $zwolnienie_od_tmp, $zwolnienie_do_tmp, $orzeczenie_tmp, $orzeczenie_id_tmp, $orzeczenie_do_tmp, $niezdolnosc_ubezpieczyciel_id_tmp, $niezdolnosc_ubezpieczyciel_inne_tmp, $swiadczenie_id_tmp, $swiadczenie_inne_tmp, $kwota_swiadczenia_tmp, $okres_swiadczenia_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_inne_odszkodowania`(		
				"' . $id_tmp . '"
				,"' . $zgloszono_nnw_tmp . '"
				,"' . $komu_zgloszono_tmp . '"
				,"' . $jaki_wypadek_tmp . '"
				,"' . $gdzie_zgloszono_id_tmp . '"
				,"' . $inne_tekst_tmp . '"
				,"' . $zasilek_pogrzebowy_tmp . '"
				,"' . $oferta_finansowa_tmp . '"
				,"' . $gamma_tmp . '"
				,"' . $dzialalnosc_tmp . '"
                ,"' . $pcrf_tmp . '"	
				,"' . $fundacja_tmp . '"
				,"' . $uszczerbek_nnw_tmp . '"
				,"' . $uszczerbek_nnw_procent_tmp . '"
				,"' . $uszczerbek_ubezp_procent_tmp . '"
				,"' . $jednorazowe_odszkodowanie_tmp . '"
				,"' . $jednorazowe_odszkodowanie_kwota_tmp . '"
				,"' . $zwolnienie_tmp . '"
				,"' . $zwolnienie_od_tmp . '"
				,"' . $zwolnienie_do_tmp . '"
				,"' . $orzeczenie_tmp . '"
				,"' . $orzeczenie_id_tmp . '"
                ,"' . $orzeczenie_do_tmp . '"
				,"' . $niezdolnosc_ubezpieczyciel_id_tmp . '"
				,"' . $niezdolnosc_ubezpieczyciel_inne_tmp . '"
				,"' . $swiadczenie_id_tmp . '"
				,"' . $swiadczenie_inne_tmp . '"
				,"' . $kwota_swiadczenia_tmp . '"
                ,"' . $okres_swiadczenia_tmp . '"
	) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_utrzymanie($utrzymanie_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_utrzymanie` WHERE `id` = " . $utrzymanie_id . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_porady($porady_id) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_porady` WHERE `id` = " . $porady_id . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pobierz_stosunki_mieszkaniowe($id_zamieszkanie) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_stosunki_mieszkaniowe` WHERE `id` = " . $id_zamieszkanie . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_dodaj_lub_aktualizuj_umowa_bankowa_1($id_tmp, $nazwa_banku_tmp, $numer_umowy_tmp, $umowa_tmp, $pelnomocnictwo_tmp, $dowod_klienta_tmp, $wniosek_tmp, $umowa_z_bankiem_tmp, $regulamin_tmp, $tabela_tmp, $harmonogram_tmp, $potwierdzenia_tmp, $decyzje_tmp, $ubezpieczenie_tmp, $dowod_wspolkredytobiorcy_tmp, $akt_malzenstwa_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_umowa_bankowa_1`(
				"' . $id_tmp . '"
				,"' . $nazwa_banku_tmp . '"
				,"' . $numer_umowy_tmp . '"
				,"' . $umowa_tmp . '"
				,"' . $pelnomocnictwo_tmp . '"
				,"' . $dowod_klienta_tmp . '"
				,"' . $wniosek_tmp . '"
				,"' . $umowa_z_bankiem_tmp . '"
				,"' . $regulamin_tmp . '"
				,"' . $tabela_tmp . '"
				,"' . $harmonogram_tmp . '"
                ,"' . $potwierdzenia_tmp . '"
				,"' . $decyzje_tmp . '"
				,"' . $ubezpieczenie_tmp . '"
				,"' . $dowod_wspolkredytobiorcy_tmp . '"
				,"' . $akt_malzenstwa_tmp . '"
	) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_dodaj_lub_aktualizuj_umowa_bankowa_2($id_tmp, $czy_zgloszono_roszczenia_tmp, $indeksacja_tmp, $ubezp_pomostowe_tmp, $data_ubezp_pomostowe_tmp, $ubezp_wkl_wlasnego_tmp, $data_ubezp_wkl_wlasnego_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `sprawa_dodaj_lub_aktualizuj_umowa_bankowa_2`(
				"' . $id_tmp . '"
				,"' . $czy_zgloszono_roszczenia_tmp . '"
				,"' . $indeksacja_tmp . '"
				,"' . $ubezp_pomostowe_tmp . '"
				,"' . $data_ubezp_pomostowe_tmp . '"
				,"' . $ubezp_wkl_wlasnego_tmp . '"
				,"' . $data_ubezp_wkl_wlasnego_tmp . '"
				
	) ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_pokaz_szczegoly_umowy_bankowej($id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, "SELECT * FROM `sprawa_umowa_bankowa` WHERE `id` = " . $id_tmp . "" );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function sprawa_aktualizuj_dane_wynagrodzenia_do_umowy_bankowej($id_umowy_tmp, $nazwa_tmp, $prowizja_tmp, $forma_platnosci, $osoba_do_wyplaty_id_tmp) {
    $polaczenie = polacz_z_baza ();

    $wynik = mysqli_query ( $polaczenie, ' UPDATE `sprawa_umowa` SET `nazwa`="' . $nazwa_tmp . '",`prowizja`="' . $prowizja_tmp . '", `forma_platnosci`="' . $forma_platnosci . '",`osoba_do_wyplaty_id`="' . $osoba_do_wyplaty_id_tmp . '" WHERE `id`=' . $id_umowy_tmp . ' ' );

    mysqli_close ( $polaczenie );
}
function aktualizuj_pojedyncze_pole($tabela, $kolumna, $wartosc, $id) {
    $polaczenie = polacz_z_baza ();

    $wynik = mysqli_query ( $polaczenie, 'UPDATE `'.$tabela.'` SET `'.$kolumna.'` = ' . $wartosc . ' WHERE `id` = ' . $id . ' ' );

    mysqli_close ( $polaczenie );
}