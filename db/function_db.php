<?php
// Glowne funkcje bazodanowe
require_once('/home/user/public_html/umowy/konfiguracja/konfiguracja_BazaDanych.php');

function polacz_z_baza() {
    $adres = MYSQL_HOST;
    $uzytkownik = MYSQL_USER;
    $haslo = MYSQL_PASSWORD;

    $baza = MYSQL_DB_NAME;
	
	$polaczenie = mysqli_connect ( $adres, $uzytkownik, $haslo, $baza );
	
	if (! $polaczenie) {
		return die ( 'Błąd połączenia (' . mysqli_connect_errno () . ') ' . mysqli_connect_error () );
	} else {
		mysqli_query ( $polaczenie, "SET CHARACTER SET 'utf8'" );
		return $polaczenie;
	}
}
function polacz_z_baza_ms_sql() {
    $server = PCE_HOST;
    $username = PCE_USER;
    $password = PCE_PASSWORD;
    $database = PCE_DB_NAME;
	
	$connection = mssql_connect ( $server, $username, $password );
	
	if ($connection == FALSE) {
		die ( "Couldn't connect" );
	}
	
	if (! mssql_select_db ( $database, $connection )) {
		die ( 'Failed to select DB' );
	}
	
	return $connection;
}
function polacz_z_baza_pyton_na_ms_sql() {
    $server = PCE_HOST;
    $username = PCE_USER;
    $password = PCE_PASSWORD;
    $database = PCE_DB_NAME;
	
	$connection = mssql_connect ( $server, $username, $password );
	
	if ($connection == FALSE) {
		die ( "Couldn't connect" );
	}
	
	if (! mssql_select_db ( $database, $connection )) {
		die ( 'Failed to select DB' );
	}
	
	return $connection;
}
function polacz_z_baza_anakonda_na_ms_sql() {
    $server = ANAKONDA_HOST;
    $username = ANAKONDA_USER;
    $password = ANAKONDA_PASSWORD;
    $database = ANAKONDA_DB_NAME;
	
	$connection = mssql_connect ( $server, $username, $password );
	
	if ($connection == FALSE) {
		die ( "Couldn't connect" );
	}
	
	if (! mssql_select_db ( $database, $connection )) {
		die ( 'Failed to select DB' );
	}
	
	return $connection;
}

function sprawdz_date_linku_aktywacyjnego($login_tmp, $liczba_kontrolna_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT data_linku_aktywacyjnego FROM uzytkownik WHERE login = \'' . $login_tmp . '\' AND liczba_kontrolna = \'' . $liczba_kontrolna_tmp . '\'  ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

function przejecie_konta($sesja, $przejete_konto_id)
{
	$polaczenie = polacz_z_baza ();
	$sesja = htmlspecialchars ($sesja);
	$przejete_konto_id = htmlspecialchars ($przejete_konto_id);
	$wynik = mysqli_query ( $polaczenie, 'UPDATE uzytkownik SET sesja_przejmujacego = "'.$sesja.'" WHERE id = ' . $przejete_konto_id);
	mysqli_close ( $polaczenie );
}


function sprawdz_ostatnia_aktywna_sesja($id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT ostatnia_aktywna_sesja, sesja_przejmujacego FROM uzytkownik WHERE id = ' . $id_tmp . ' AND status = 1  ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function pobierz_liste_uprawnien_uzytkownika($uzytkownik_id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT id_uprawnienia FROM uzytkownik_uprawnienie WHERE id_uzytkownika = ' . $uzytkownik_id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function pobierz_liste_uprawnien_zalogowanego_uzytkownika($uzytkownik_id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT id_uprawnienia FROM uzytkownik_uprawnienie WHERE id_uzytkownika = ' . $uzytkownik_id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawdz_date_wyslania_linku_aktywacyjnego($uzytkownik_numer_agenta_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT `data_linku_aktywacyjnego` FROM `uzytkownik` WHERE `login` = "' . $uzytkownik_numer_agenta_tmp . '" ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}
function zarejestruj_sie_sprawdz_czy_istnieje($uzytkownik_numer_agenta_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT `id` FROM `uzytkownik` WHERE `login` = "' . $uzytkownik_numer_agenta_tmp . '" ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

/*
function powiadomienie_pobierz_systemowe() {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM powiadomienia WHERE powiadomienia_rodzaj_id = 2 AND czy_aktywny = 1 ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}*/

/* kamyk 2016-09-02 */
function pobierz_dane_z_tabeli($nazwa_tabeli_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `' . $nazwa_tabeli_tmp . '` ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

/* kamyk 2016-09-02 */
function pobierz_jeden_wiersz_z_tabeli($nazwa_tabeli_tmp, $id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `' . $nazwa_tabeli_tmp . '` WHERE `id` = ' . $id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

/* kamyk 2016-09-08 */
function pobierz_dane_z_tabeli_dla_id($nazwa_tabeli_tmp, $id_tmp) {
	$polaczenie = polacz_z_baza ();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `' . $nazwa_tabeli_tmp . '` WHERE `id` = ' . $id_tmp . ' ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}
function sprawdz_uprawnienie ($id_uzytkownika_tmp, $id_uprawnienia_tmp) {
    $polaczenie = polacz_z_baza ();

    $wynik = mysqli_query ( $polaczenie, ' SELECT 1 FROM `uzytkownik_uprawnienie` WHERE `id_uzytkownika` = "' . $id_uzytkownika_tmp . '"  AND `id_uprawnienia` = "' . $id_uprawnienia_tmp . '"' );

    mysqli_close ( $polaczenie );

    return mysqli_fetch_assoc ( $wynik );
}