<?php 

session_start();


require_once($_SERVER ['DOCUMENT_ROOT'].'db/function_db.php'); 

function umowa_pobierz_dane_po_id_dla_uzytkownika($id_zmienna_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'CALL umowa_pobierz_dane_po_id_dla_uzytkownika ('.$uzytkownik_id_tmp.', '.$id_zmienna_tmp.' )' );

	mysqli_close ( $polaczenie );

	return mysqli_fetch_assoc ( $wynik );
}

function oswiadczenie_pobierz_dane_po_id($id_zmienna_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'CALL oswiadczenie_pobierz_dane_po_id ('.$id_zmienna_tmp.' )' );

	mysqli_close ( $polaczenie );

	return mysqli_fetch_assoc ( $wynik );
}

function oswiadczenie_wyjazd_pobierz_dane_po_id($id_zmienna_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `oswiadczenie_wyjazd` WHERE oswiadczenie_dojazdy_id = '.$id_zmienna_tmp.' ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function oswiadczenie_dokument_pobierz_rodzaj_po_id_oswiadczenia($id_zmienna_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `oswiadczenie_dokument` WHERE oswiadczenie_dojazdy_id = '.$id_zmienna_tmp.' ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function zgloszenie_szkody_pobierz_dane_po_id_dla_uzytkownika($id_zmienna_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL zgloszenie_szkody_pobierz_dane_po_id_dla_uzytkownika ('.$id_zmienna_tmp.', '.$uzytkownik_id_tmp.' )' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

function zgloszenie_szkody_pobierz_dane_strony_po_id($id_strony,$numer_strony){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `zgloszenie_szkody_str_'.$numer_strony.'` WHERE `id` = '.$id_strony.' ' );

	mysqli_close ( $polaczenie );

	return mysqli_fetch_assoc ( $wynik );
}

function osoba_pobierz_imie_nazwisko_po_id($uzytkownik_id){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'SELECT imie, nazwisko FROM `osoba` WHERE `id` = '.$uzytkownik_id.' ' );

	mysqli_close ( $polaczenie );

	return mysqli_fetch_assoc ( $wynik );
}