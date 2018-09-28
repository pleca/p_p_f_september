<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

$klient_id = htmlspecialchars ( $_POST ['klient_id'] );

if (empty ( $klient_id )) {
	$dane = array (
			0 => '0' 
	);
} else {
	require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');
	$klient_szczegoly = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $klient_id );
	
	if ($klient_szczegoly ['czy_obcokrajowiec'] == 0) {
		
		$urodziny = new DateTime ( implode ( '-', array (
				( int ) substr ( $klient_szczegoly ['pesel'], 0, 2 ) + 1800 + (((floor ( (( int ) $klient_szczegoly ['pesel'] {2}) / 2 ) + 1) % 5) * 100),
				substr ( $klient_szczegoly ['pesel'], 2, 2 ),
				substr ( $klient_szczegoly ['pesel'], 4, 2 ) 
		) ) );
		
		$rok_urodzenia = $urodziny->format ( 'Y' );
		$dzsiaj_rok = date ( 'Y' );
		$miesiac_urodzenia = $urodziny->format ( 'm' );
		$dzsiaj_miesiac = date ( 'm' );
		
		$wiek = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok_urodzenia * 12) + $miesiac_urodzenia)) / 12 );
	}
	
	$dane = array (
			0 => '1',
			1 => $klient_szczegoly ['id'],
			2 => $klient_szczegoly ['imie'],
			3 => $klient_szczegoly ['nazwisko'],
			4 => $klient_szczegoly ['pesel'],
			5 => $klient_szczegoly ['dowod'],
			6 => $klient_szczegoly ['ulica'],
			7 => $klient_szczegoly ['nr_domu'],
			8 => $klient_szczegoly ['nr_mieszkania'],
			9 => $klient_szczegoly ['miasto'],
			10 => $klient_szczegoly ['email'],
			11 => $klient_szczegoly ['telefon'],
			12 => $klient_szczegoly ['kod_pocztowy'],
			13 => $wiek,
			14 => $klient_szczegoly ['czy_obcokrajowiec'],
			15 => $klient_szczegoly ['rodzaj_dokumentu'],
			16 => $klient_szczegoly ['nr_dokumentu'] 
	);
}

echo json_encode ( $dane );