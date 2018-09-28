<?php
//Funkcje bazodanowe moduły MAILING
if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
	die();
}

require_once($_SERVER ['DOCUMENT_ROOT'].'db/function_db.php');

function mailing_podpisy_pobierz_po_uzytkownik_id($uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing_podpis_uzytkownik` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' ORDER BY `domyslny` DESC ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function mailing_podpis_zapisz($mailing_podpis_id_tmp, $mailing_podpis_nazwa_tmp, $mailing_podpis_tresc_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `mailing_podpis_uzytkownik` SET `podpis_html`="'.$mailing_podpis_tresc_tmp.'",`nazwa`="'.$mailing_podpis_nazwa_tmp.'" WHERE `id` = '.$mailing_podpis_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );

}

function mailing_podpis_domyslny_po_uzytkownik_id($uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing_podpis_uzytkownik` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' AND `domyslny`= 1 ' );
	
	mysqli_close ( $polaczenie );
	
	return  mysqli_fetch_assoc($wynik);
}

function mailing_podpis_pobierz_po_id($mailing_podpis_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing_podpis_uzytkownik` WHERE `id` = '.$mailing_podpis_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
	
	return  mysqli_fetch_assoc($wynik);
}

function mailing_podpis_dodaj_nowe($mailing_podpis_nazwa_tmp, $mailing_podpis_tresc_tmp, $uzytkownik_id_tmp, $domyslny_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `mailing_podpis_uzytkownik`(`uzytkownik_id`, `podpis_html`, `nazwa`, `domyslny`) VALUES ('.$uzytkownik_id_tmp.',"'.$mailing_podpis_tresc_tmp.'","'.$mailing_podpis_nazwa_tmp.'","'.$domyslny_tmp.'") ' );
	
	mysqli_close ( $polaczenie );
}

function mailing_podpis_usun($mailing_podpis_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'DELETE FROM `mailing_podpis_uzytkownik` WHERE `id` = '.$mailing_podpis_id_tmp.' AND `uzytkownik_id` = '.$uzytkownik_id_tmp.'  ' );
	
	mysqli_close ( $polaczenie );
}

function mailing_podpis_ustaw_domyslny($mailing_podpis_id_tmp, $uzytkownik_id_tmp, $domyslny_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `mailing_podpis_uzytkownik` SET `domyslny`='.$domyslny_tmp.' WHERE `id` = '.$mailing_podpis_id_tmp.' AND `uzytkownik_id` = '.$uzytkownik_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function mailing_podpis_szablon_dodaj_nowy($mailing_podpis_tresc_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `mailing_podpis_szablon`(`podpis_html`) VALUES ("'.$mailing_podpis_tresc_tmp.'") ' );
	
	mysqli_close ( $polaczenie );
}

function mailing_podpis_szablon_pobierz(){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing_podpis_szablon`  ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function mailing_podpis_szablon_zapisz_zmiany($mailing_podpis_szablon_id_tmp, $mailing_podpis_tresc_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `mailing_podpis_szablon` SET `podpis_html`="'.$mailing_podpis_tresc_tmp.'" WHERE `id` = '.$mailing_podpis_szablon_id_tmp.'  ' );
	
	mysqli_close ( $polaczenie );
}

function mailing_dodaj_nowy($mailing_temat_wiadomosci_tmp, $mailing_adresat_imie_nazwisko_tmp, $mailing_adresat_email_tmp, $mailing_tresc_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL `mailing_dodaj_nowy`("'.$mailing_temat_wiadomosci_tmp.'","'.$mailing_adresat_imie_nazwisko_tmp.'","'.$mailing_adresat_email_tmp.'","'.$mailing_tresc_tmp.'","'.$uzytkownik_id_tmp.'")' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc($wynik);
}

function mailing_lista_schematow($uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function mailing_pobierz_po_id($mailing_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' AND `id` = '.$mailing_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc($wynik);
}

function mailing_zapisz_zmiany($mailing_id_tmp, $mailing_temat_wiadomosci_tmp, $mailing_adresat_imie_nazwisko_tmp, $mailing_adresat_email_tmp, $mailing_tresc_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `mailing` SET `temat`="'.$mailing_temat_wiadomosci_tmp.'",`nadawca_imie_nazwisko`="'.$mailing_adresat_imie_nazwisko_tmp.'",`nadawca_email`="'.$mailing_adresat_email_tmp.'",`tresc`="'.$mailing_tresc_tmp.'" WHERE `id` = '.$mailing_id_tmp.' AND `uzytkownik_id` = '.$uzytkownik_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );

}

function mailing_historia_dodaj_nowy($uzytkownik_id_tmp, $mailing_adresat_imie_nazwisko_tmp, $mailing_adresat_email_tmp, $mailing_temat_tmp, $mailing_tresc_tmp, $mailing_obrazki_tmp, $mailing_zalaczniki_tmp, $mailing_odbiorcy_tmp	){
			$polaczenie = polacz_z_baza();
			
			$wynik = mysqli_query ( $polaczenie, 'CALL `mailing_historia_dodaj_nowy`("'.$uzytkownik_id_tmp.'","'.$mailing_adresat_imie_nazwisko_tmp.'","'.$mailing_adresat_email_tmp.'","'.$mailing_temat_tmp.'","'.$mailing_tresc_tmp.'","'.$mailing_obrazki_tmp.'","'.$mailing_zalaczniki_tmp.'","'.$mailing_odbiorcy_tmp.'") ' );
			
			mysqli_close ( $polaczenie );
			
			return mysqli_fetch_assoc($wynik);
}

function  mailing_lista_wyslanych($uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing_historia` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' ORDER BY `data_wyslania` DESC ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function mailing_lista_wszystkich_wyslanych(){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing_historia` ORDER BY `data_wyslania` DESC  ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function mailing_grupy_pobierz_wszystkie($uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL `mailing_grupy_pobierz_wszystkie`("'.$uzytkownik_id_tmp.'") ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}


/*kamyk 2016-09-09*/
function mailing_schemat_usun($mailing_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'DELETE FROM `mailing` WHERE `id` = '.$mailing_id_tmp.' AND `uzytkownik_id` = '.$uzytkownik_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

/*kamyk 2016-09-16*/
function mailing_pobierz_z_historii_po_id($mailing_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `mailing_historia` WHERE `id` = '.$mailing_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc($wynik);
}

function mailing_pobierz_liste_wszystkich_dyrektorow(){
	$polaczenie = polacz_z_baza_ms_sql();
	
	$procedura = mssql_init('php_lista_dyrektorow', $polaczenie);
	
	$wynik = mssql_execute($procedura);
	
	mssql_free_statement($procedura);
	
	return $wynik;
}

function mailing_pobierz_liste_maili_grupy($element_id_tmp){
	$polaczenie = polacz_z_baza_ms_sql();
	
	$procedura = mssql_init('php_grupy_mailowe_na_podstawie_id', $polaczenie);
	mssql_bind($procedura, '@prm_id', $element_id_tmp,  SQLVARCHAR);
	
	$wynik = mssql_execute($procedura);
	
	mssql_free_statement($procedura);
	
	return $wynik;
}

function mailing_pobierz_liste_maili_struktury($element_id_tmp){
	$polaczenie = polacz_z_baza_ms_sql();
	
	$procedura = mssql_init('php_pobranie_maili_struktury_na_podstawie_id_dyrektora', $polaczenie);
	mssql_bind($procedura, '@prm_id', $element_id_tmp,  SQLVARCHAR);
	
	$wynik = mssql_execute($procedura);
	
	mssql_free_statement($procedura);
	
	return $wynik;
}


















