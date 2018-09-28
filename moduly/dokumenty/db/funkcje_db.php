<?php
//Funkcje bazodanowe moduły dokumenty
if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
	die(); 
}

require_once($_SERVER ['DOCUMENT_ROOT'].'db/function_db.php');

function pobierz_liste_kategorii(){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL dokumenty_kategoria_pobierz_kategorie()' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function pobierz_liste_kategorii_na_podstawie_id($id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL dokumenty_kategoria_pobierz_kategorie_na_podstawie_id_strony('.$id_tmp.')' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function pobierz_liste_dokumentow_na_podstawie_id($id_tmp, $uzytkownik_id, $uzytkownik_grupa_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL dokumenty_pobierz_dokumenty_po_id_kategorii('.$id_tmp.', '.$uzytkownik_id.', '.$uzytkownik_grupa_id.' )' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function dokumenty_rodzaj_pobierz_strony($uzytkownik_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' CALL `dokumenty_rodzaj_pobierz_strony`("'.$uzytkownik_id_tmp.'","'.$uzytkownik_grupa_id_tmp.'") ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function dokumenty_rodzaj_pobierz_kategorie_po_strona_id($strona_id_tmp, $uzytkownik_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL `dokumenty_rodzaj_pobierz_kategorie_po_strona_id`("'.$strona_id_tmp.'","'.$uzytkownik_id_tmp.'","'.$uzytkownik_grupa_id_tmp.'")' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function dokumenty_strona_dodaj_nowy($dokumenty_strona_nr_kolejnosci_tmp, $dokumenty_strona_nazwa_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'CALL dokumenty_strona_dodaj_nowy("'.$dokumenty_strona_nr_kolejnosci_tmp.'","'.$dokumenty_strona_nazwa_tmp.'","'.$uzytkownik_id_tmp.'")' );

	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function dokumenty_kategoria_dodaj_brak_kategorii($dokument_strona_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `dokumenty_kategoria`(`nr_kolejnosci`, `nazwa`, `strona_id`) VALUES (999,"Inne",'.$dokument_strona_id_tmp.')' );

	mysqli_close ( $polaczenie );

}

function dokumenty_kategoria_dodaj_nowy($dokumenty_kategoria_nr_kolejnosci_tmp, $dokumenty_kategoria_nazwa_tmp, $dokumenty_strona_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL `dokumenty_kategoria_dodaj_nowy`("'.$dokumenty_kategoria_nr_kolejnosci_tmp.'","'.$dokumenty_kategoria_nazwa_tmp.'","'.$dokumenty_strona_id_tmp.'","'.$uzytkownik_id_tmp.'")' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_strona_edytuj($dokumenty_strona_nr_kolejnosci_tmp, $dokumenty_strona_nazwa_tmp, $dokumenty_strona_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'UPDATE `dokumenty_strona` SET `nr_kolejnosci`='.$dokumenty_strona_nr_kolejnosci_tmp.',`nazwa`="'.$dokumenty_strona_nazwa_tmp.'" WHERE `id` = '.$dokumenty_strona_id_tmp.' ' );

	mysqli_close ( $polaczenie );
}

function dokumenty_strona_usun($dokumenty_strona_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `dokumenty_strona` SET `czy_usuniety` = 1 WHERE `id` = '.$dokumenty_strona_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_kategoria_edytuj($dokumenty_kategoria_nr_kolejnosci_tmp, $dokumenty_kategoria_nazwa_tmp, $dokumenty_kategoria_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `dokumenty_kategoria` SET `nr_kolejnosci`='.$dokumenty_kategoria_nr_kolejnosci_tmp.',`nazwa`="'.$dokumenty_kategoria_nazwa_tmp.'" WHERE `id` = '.$dokumenty_kategoria_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_z_kategori_dodaj_nowy($dokumenty_z_kategori_nr_kolejnosci_tmp, $dokumenty_z_kategori_nazwa_tmp, $dokumenty_z_kategori_opis_tmp, $dokumenty_z_kategori_tworca_tmp, $dokumenty_kategoria_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL dokumenty_z_kategori_dodaj_nowy("'.$dokumenty_z_kategori_nr_kolejnosci_tmp.'","'.$dokumenty_z_kategori_nazwa_tmp.'","'.$dokumenty_z_kategori_opis_tmp.'","'.$dokumenty_z_kategori_tworca_tmp.'","'.$dokumenty_kategoria_id_tmp.'")' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function dokumenty_z_kategori_aktualizuj_info_plik($dokumenty_z_kategori_plik_tmp, $dokumenty_z_kategori_plik_typ_tmp, $dokumenty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `dokumenty` SET `nazwa_pliku` = "'.$dokumenty_z_kategori_plik_tmp.'", `typ_pliku` = "'.$dokumenty_z_kategori_plik_typ_tmp.'" WHERE `id` = '.$dokumenty_z_kategori_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_z_kategori_dodaj_uprawnienie_dla_uzytkownika($uzytkownik_id_tmp, $dokumenty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' INSERT INTO `dokumenty_uzytkownicy`(`uzytkownik_id`, `dokumenty_id`) VALUES ('.$uzytkownik_id_tmp.','.$dokumenty_z_kategori_id_tmp.') ' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_z_kategori_aktualizuj_info_plik_edytuj($dokumenty_z_kategori_plik_tmp, $dokumenty_z_kategori_plik_typ_tmp, $dokumenty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'UPDATE `dokumenty` SET `nazwa_pliku` = "'.$dokumenty_z_kategori_plik_tmp.'", `typ_pliku` = "'.$dokumenty_z_kategori_plik_typ_tmp.'", `liczba_pobran` = 0 WHERE `id` = '.$dokumenty_z_kategori_id_tmp.' ' );

	mysqli_close ( $polaczenie );
}

function dokumenty_z_kategori_pobierz_dane_po_id($dokumenty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `dokumenty` WHERE `id` = '.$dokumenty_z_kategori_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

function dokumenty_z_kategori_aktualizuj_liczba_pobran($dokumenty_z_kategori_id_tmp, $liczba_p_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'UPDATE `dokumenty` SET `liczba_pobran` = '.$liczba_p_tmp.' WHERE `id` = '.$dokumenty_z_kategori_id_tmp.' ' );

	mysqli_close ( $polaczenie );

}

function dokumenty_z_kategori_archiwum_aktualizuj_liczba_pobran($dokumenty_z_kategori_id_tmp, $liczba_p_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `dokumenty_archiwum` SET `liczba_pobran` = '.$liczba_p_tmp.' WHERE `id` = '.$dokumenty_z_kategori_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_z_kategori_edytuj_po_id($dokumenty_z_kategori_nr_kolejnosci, $dokumenty_z_kategori_nazwa, $dokumenty_z_kategori_opis, $dokumenty_z_kategori_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `dokumenty` SET `nr_kolejnosci`='.$dokumenty_z_kategori_nr_kolejnosci.',`nazwa_dokumentu`=\''.$dokumenty_z_kategori_nazwa.'\',`data_modyfikacji`=NOW(),`opis`=\''.$dokumenty_z_kategori_opis.'\' WHERE `id` = '.$dokumenty_z_kategori_id.' ' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_archiwum_dodaj_nowy($dokumenty_id_tmp, $dokument_nazwa_pliku_tmp, $dokument_typ_pliku_tmp, $tworca_id_tmp, $dokument_liczba_pobran_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `dokumenty_archiwum`(`dokumenty_id`, `nazwa_pliku`, `typ_pliku`, `tworca_id`, `data_archiwizacji`, `liczba_pobran`) VALUES ('.$dokumenty_id_tmp.',"'.$dokument_nazwa_pliku_tmp.'","'.$dokument_typ_pliku_tmp.'",'.$tworca_id_tmp.',NOW(),'.$dokument_liczba_pobran_tmp.')' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_z_kategori_archiwum_pobierz_dane_po_id($dokumenty_z_kategori_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `dokumenty_archiwum` WHERE `dokumenty_id` = '.$dokumenty_z_kategori_id.' ORDER BY `data_archiwizacji` DESC ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function uzytkownik_grupy_pobierz_wszystkie(){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `uzytkownik_grupy` WHERE `id` != 1 ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function dokumenty_grupy_pobierz_grupa_id($dokumenty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' SELECT `uzytkownik_grupa_id` FROM `dokumenty_grupy` WHERE `dokumenty_id` = '.$dokumenty_z_kategori_id_tmp.' ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function usun_dokumenty_grupy($dokumenty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'DELETE FROM `dokumenty_grupy` WHERE `uzytkownik_grupa_id` = '.$uzytkownik_grupa_id_tmp.' AND `dokumenty_id` = '.$dokumenty_id_tmp.' ' );

	mysqli_close ( $polaczenie );

}

function dodaj_dokumenty_grupy($dokumenty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `dokumenty_grupy`(`uzytkownik_grupa_id`, `dokumenty_id`) VALUES ('.$uzytkownik_grupa_id_tmp.','.$dokumenty_id_tmp.')' );

	mysqli_close ( $polaczenie );

}

function dokumenty_uzytkownicy_pobierz_wszystkie($dokumenty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' CALL `dokumenty_uzytkownicy_pobierz_wszystkie`("'.$dokumenty_z_kategori_id_tmp.'")  ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function dokumenty_uzytkownicy_usun($dokumenty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' DELETE FROM `dokumenty_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' AND `dokumenty_id` = '.$dokumenty_id_tmp.'  ' );
	
	mysqli_close ( $polaczenie );
}

function dokumenty_grupa_uzytkownicy_usun($dokumenty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' DELETE FROM `dokumenty_strona_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' AND `dokumenty_strona_id` = '.$dokumenty_id_tmp.'  ' );

	mysqli_close ( $polaczenie );
}

function dokumenty_kategoria_uzytkownicy_usun($dokumenty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' DELETE FROM `dokumenty_kategoria_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' AND `dokumenty_kategoria_id` = '.$dokumenty_id_tmp.'  ' );

	mysqli_close ( $polaczenie );
}

/*kamyk 2016-09-09*/
function uzytkownik_pobierz_liste_po_frupa_id($uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT `id`, `imie`, `nazwisko`, `login` FROM `uzytkownik` WHERE `uzytkownik_grupa_id` = '.$uzytkownik_grupa_id_tmp.' AND `uzytkownik_grupa_id` != 1 AND `status` = 1 ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function lista_wszystkich_uzytkownikow_szukaj($wartosc_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT `id`, CONCAT(`imie`," ",`nazwisko`) AS `nazwa`, `login` FROM `uzytkownik` WHERE `status` = 1 AND `uzytkownik_grupa_id` != 1 AND (CONCAT(`imie`," " ,`nazwisko`) LIKE "%'.$wartosc_tmp.'%" OR CONCAT(`nazwisko`," " ,`imie`) LIKE "%'.$wartosc_tmp.'%")  ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function lista_uzytkownikow_dla_grupy_dodaj_uprawnienie($dokumenty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `dokumenty_uzytkownicy`(`uzytkownik_id`, `dokumenty_id`) VALUES ('.$uzytkownik_id_tmp.','.$dokumenty_id_tmp.')' );
	
	mysqli_close ( $polaczenie );
}

function lista_uzytkownikow_dla_grupy_sprawdz_czy_istnieje($dokument_id, $uzytkownik_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `dokumenty_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id.' AND `dokumenty_id` = '.$dokument_id.' ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function dokumenty_grupa_kategoria_pobierz_dane($element_id, $tabelka){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `'.$tabelka.'` WHERE `id` = '.$element_id.' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc($wynik);
}

function dokumenty_grupa_kategoria_pobierz_grupy_po_id($element_id, $tabelka){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT `uzytkownik_grupa_id` FROM `'.$tabelka.'_grupy` WHERE `'.$tabelka.'_id` = '.$element_id.' ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function dokumenty_grupa_uzytkownicy_pobierz($element_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `dokumenty_grupa_uzytkownicy_pobierz`("'.$element_id.'") ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function dokumenty_kategoria_uzytkownicy_pobierz($element_id){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' CALL `dokumenty_kategoria_uzytkownicy_pobierz`("'.$element_id.'") ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function lista_uzytkownikow_dla_strona_grupa_sprawdz_czy_istnieje($dokument_id, $uzytkownik_id){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `dokumenty_strona_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id.' AND `dokumenty_strona_id` = '.$dokument_id.' ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie($dokumenty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `dokumenty_strona_uzytkownicy`(`uzytkownik_id`, `dokumenty_strona_id`) VALUES ('.$uzytkownik_id_tmp.','.$dokumenty_id_tmp.')' );

	mysqli_close ( $polaczenie );
}

function dokumenty_grupa_usun_dokumenty_grupy($dokumenty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'DELETE FROM `dokumenty_strona_grupy` WHERE `uzytkownik_grupa_id` = '.$uzytkownik_grupa_id_tmp.' AND `dokumenty_strona_id` = '.$dokumenty_id_tmp.' ' );

	mysqli_close ( $polaczenie );

}

function dokumenty_grupa_dodaj_dokumenty_grupy($dokumenty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `dokumenty_strona_grupy`(`uzytkownik_grupa_id`, `dokumenty_strona_id`) VALUES ('.$uzytkownik_grupa_id_tmp.','.$dokumenty_id_tmp.')' );

	mysqli_close ( $polaczenie );

}

function lista_uzytkownikow_dla_kategoria_grupa_sprawdz_czy_istnieje($dokument_id, $uzytkownik_id){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `dokumenty_kategoria_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id.' AND `dokumenty_kategoria_id` = '.$dokument_id.' ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie($dokumenty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `dokumenty_kategoria_uzytkownicy`(`uzytkownik_id`, `dokumenty_kategoria_id`) VALUES ('.$uzytkownik_id_tmp.','.$dokumenty_id_tmp.')' );

	mysqli_close ( $polaczenie );
}

function dokumenty_kategoria_usun_dokumenty_grupy($dokumenty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'DELETE FROM `dokumenty_kategoria_grupy` WHERE `uzytkownik_grupa_id` = '.$uzytkownik_grupa_id_tmp.' AND `dokumenty_kategoria_id` = '.$dokumenty_id_tmp.' ' );

	mysqli_close ( $polaczenie );

}

function dokumenty_kategoria_dodaj_dokumenty_grupy($dokumenty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `dokumenty_kategoria_grupy`(`uzytkownik_grupa_id`, `dokumenty_kategoria_id`) VALUES ('.$uzytkownik_grupa_id_tmp.','.$dokumenty_id_tmp.')' );

	mysqli_close ( $polaczenie );

}

/*kamyk 2016-08-30*/
function dokumenty_usun_dokument($dokument_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' UPDATE `dokumenty` SET `czy_usuniety`= 1 WHERE `id`= '.$dokument_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

/*kamyk 2016-08-30*/
function dokumenty_kategoria_usun($kategoria_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' UPDATE `dokumenty_kategoria` SET `czy_usuniety`= 1 WHERE `id`='.$kategoria_id_tmp.'; ' );
	
	mysqli_close ( $polaczenie );
}

























