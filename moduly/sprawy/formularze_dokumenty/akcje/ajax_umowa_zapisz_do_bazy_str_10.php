<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$zgloszono_nnw = htmlspecialchars ( $_POST ['zgloszono_nnw'] );
$komu_zgloszono = htmlspecialchars ( $_POST ['komu_zgloszono'] );
$jaki_wypadek = htmlspecialchars ( $_POST ['jaki_wypadek'] );
$ubezpieczenie = htmlspecialchars ( $_POST ['ubezpieczenie'] );
$kto_inny = htmlspecialchars ( $_POST ['kto_inny'] );
$zasilek = htmlspecialchars ( $_POST ['zasilek'] );
$prod_finansowe = htmlspecialchars ( $_POST ['prod_finansowe'] );

/* medyk */

$uszczerbek_nnw = htmlspecialchars ( $_POST ['inne_odszkodowania_uszczerbek_nnw'] );
$procent_nnw = htmlspecialchars ( $_POST ['inne_odszkodowania_uszczerbek_procent_nnw'] );
$ubezp_procent_uszczerbku = htmlspecialchars ( $_POST ['inne_odszkodowania_ubezp_procent_uszczerbku'] );
$jednorazowe_odszkodowanie = htmlspecialchars ( $_POST ['inne_odszkodowania_jednorazowe_odszkodowanie'] );
$kwota_odszkodowania = htmlspecialchars ( $_POST ['inne_odszkodowania_kwota_odszkodowania'] );
$zwolnienie = htmlspecialchars ( $_POST ['inne_odszkodowania_zwolnienie'] );
$zwolnienie_od = htmlspecialchars ( $_POST ['inne_odszkodowania_zwolnienie_od'] );
$zwolnienie_do = htmlspecialchars ( $_POST ['inne_odszkodowania_zwolnienie_do'] );
$orzeczenie = htmlspecialchars ( $_POST ['inne_odszkodowania_orzeczenie'] );
$orzeczenie_id = htmlspecialchars ( $_POST ['inne_odszkodowania_orzeczenie_id'] );
$orzeczenie_do = htmlspecialchars ( $_POST ['inne_odszkodowania_orzeczenie_do'] );
$ubezpieczyciel_id = htmlspecialchars ( $_POST ['inne_odszkodowania_ubezpieczyciel_id'] );
$inne_nazwa = htmlspecialchars ( $_POST ['inne_odszkodowania_inne_nazwa'] );
$swiadczenie_id = htmlspecialchars ( $_POST ['inne_odszkodowania_swiadczenie_id'] );
$swiadczenie_inne_nazwa = htmlspecialchars ( $_POST ['inne_odszkodowania_swiadczenie_inne_nazwa'] );
$kwota_swiadczenia = htmlspecialchars ( $_POST ['inne_odszkodowania_kwota_swiadczenia'] );
$data_swiadczenia = htmlspecialchars ( $_POST ['inne_odszkodowania_data_swiadczenia'] );

$gamma = htmlspecialchars ( $_POST ['gamma'] );
$dzialalnosc = htmlspecialchars ( $_POST ['dzialalnosc'] );
$pcrf = htmlspecialchars ( $_POST ['pcrf'] );
$fundacja = htmlspecialchars ( $_POST ['fundacja'] );
/* */
$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$id_zdarzenia = htmlspecialchars ( $_POST ['id_zdarzenia'] );

$inne_odszkodowania = sprawa_dodaj_lub_aktualizuj_inne_odszkodowania ( '0', $zgloszono_nnw, $komu_zgloszono, $jaki_wypadek, $ubezpieczenie, $inne_tekst, $zasilek_pogrzebowy, $oferta_finansowa, $gamma, $dzialalnosc, $pcrf, $fundacja, $uszczerbek_nnw, $procent_nnw, $ubezp_procent_uszczerbku, $jednorazowe_odszkodowanie, $kwota_odszkodowania, $zwolnienie, $zwolnienie_od, $zwolnienie_do, $orzeczenie, $orzeczenie_id, $orzeczenie_do, $ubezpieczyciel_id, $inne_nazwa, $swiadczenie_id, $swiadczenie_inne_nazwa, $kwota_swiadczenia, $data_swiadczenia );
$id_inne_odszkodowania = $inne_odszkodowania ['id_inne_odszkodowania'];

// $uzupelnic_inne_odszkodowania = sprawa_dodaj_inne_odszkodowania ( $zgloszono_nnw, $komu_zgloszono, $jaki_wypadek, $ubezpieczenie, $kto_inny, $zasilek, $prod_finansowe, $gamma, $dzialalnosc, $pcrf, $uszczerbek_nnw, $procent_nnw, $ubezp_procent_uszczerbku, $jednorazowe_odszkodowanie, $kwota_odszkodowania, $zwolnienie, $zwolnienie_od, $zwolnienie_do, $orzeczenie, $orzeczenie_id, $orzeczenie_do, $ubezpieczyciel_id, $inne_nazwa, $swiadczenie_id, $swiadczenie_inne_nazwa, $kwota_swiadczenia, $data_swiadczenia );
// $uzupelnic_inne_odszkodowania = mysqli_fetch_assoc ( $uzupelnic_inne_odszkodowania );
// $id_inne_odszkodowania = $uzupelnic_inne_odszkodowania ['id'];

$aktualizuj_sprawe_odszkodowania = sprawa_aktualizacja ( 'sprawa_inne_odszkodowania_id', $id_inne_odszkodowania, $id_sprawy );
$aktualizuj_sprawe_odszkodowania = mysqli_fetch_assoc ( $aktualizuj_sprawe_odszkodowania );

$id_klienta = sprawa_pobierz_id_z_tabeli_sprawa ( $id_sprawy, 'sprawa_klient_id' );
$id_poszkodowanego = sprawa_pobierz_id_z_tabeli_sprawa ( $id_sprawy, 'sprawa_poszkodowany_id' );
$id_uprawnionego = sprawa_pobierz_id_z_tabeli_sprawa ( $id_sprawy, 'sprawa_uprawniony_id' );
$data = sprawa_pobierz_date_zdarzenia ( $id_zdarzenia );

$uprawniony = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $id_uprawnionego );
$imie_nazwisko_uprawnionego = $uprawniony ['imie'] . ' ' . $uprawniony ['nazwisko'];
$pesel_uprawnionego = $uprawniony ['pesel'];
$uprawniony_id = $uprawniony ['id'];

$poszkodowany = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $id_poszkodowanego );
$imie_nazwisko_poszkodowanego = $poszkodowany ['imie'] . ' ' . $poszkodowany ['nazwisko'];
$poszkodowany_id = $poszkodowany ['id'];

if (! empty ( $pesel_uprawnionego )) {
	$urodziny = new DateTime ( implode ( '-', array (
			( int ) substr ( $pesel_uprawnionego, 0, 2 ) + 1800 + (((floor ( (( int ) $pesel_uprawnionego {2}) / 2 ) + 1) % 5) * 100),
			substr ( $pesel_uprawnionego, 2, 2 ),
			substr ( $pesel_uprawnionego, 4, 2 ) 
	) ) );
	
	$rok_urodzenia = $urodziny->format ( 'Y' );
	$dzsiaj_rok = date ( 'Y' );
	$miesiac_urodzenia = $urodziny->format ( 'm' );
	$dzsiaj_miesiac = date ( 'm' );
	
	$wiek = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok_urodzenia * 12) + $miesiac_urodzenia)) / 12 );
}

sprawa_aktualizuj_ostatnia_strone ( $id_sprawy, '10' );

$dane = array (
		0 => $id_sprawy,
		1 => $id_zdarzenia,
		2 => $imie_nazwisko_uprawnionego,
		3 => $imie_nazwisko_poszkodowanego,
		4 => $wiek,
		5 => $data,
		6 => $uprawniony_id,
		7 => $poszkodowany_id,
		8 => $id_inne_odszkodowania 
);

echo json_encode ( $dane );