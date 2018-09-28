<?php
//Funkcje bazodanowe moduły produkty
if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
	die(); 
}

require_once($_SERVER ['DOCUMENT_ROOT'].'db/function_db.php');

function pobierz_liste_kategorii(){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL produkty_kategoria_pobierz_kategorie()' );
	
	mysqli_close ( $polaczenie );
	print_r($wynik);
	return $wynik;
}

function pobierz_liste_kategorii_na_podstawie_id($id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL produkty_kategoria_pobierz_kategorie_na_podstawie_id_strony('.$id_tmp.')' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function pobierz_liste_produktow_na_podstawie_id($id_tmp, $uzytkownik_id, $uzytkownik_grupa_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL produkty_pobierz_produkty_po_id_kategorii('.$id_tmp.', '.$uzytkownik_id.', '.$uzytkownik_grupa_id.' )' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function produkty_rodzaj_pobierz_strony($uzytkownik_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();
	$wynik = mysqli_query ( $polaczenie, ' CALL `produkty_rodzaj_pobierz_strony`("'.$uzytkownik_id_tmp.'","'.$uzytkownik_grupa_id_tmp.'") ' );
	mysqli_close ( $polaczenie );

	return $wynik;
}

function produkty_rodzaj_pobierz_kategorie_po_strona_id($strona_id_tmp, $uzytkownik_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL `produkty_rodzaj_pobierz_kategorie_po_strona_id`("'.$strona_id_tmp.'","'.$uzytkownik_id_tmp.'","'.$uzytkownik_grupa_id_tmp.'")' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function produkty_strona_dodaj_nowy($produkty_strona_nr_kolejnosci_tmp, $produkty_strona_nazwa_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'CALL produkty_strona_dodaj_nowy("'.$produkty_strona_nr_kolejnosci_tmp.'","'.$produkty_strona_nazwa_tmp.'","'.$uzytkownik_id_tmp.'")' );

	mysqli_close ( $polaczenie );
	return $wynik;
}

function produkty_kategoria_dodaj_brak_kategorii($produkty_strona_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `produkty_kategoria`(`nr_kolejnosci`, `nazwa`, `strona_id`) VALUES (999,"Inne",'.$produkty_strona_id_tmp.')' );

	mysqli_close ( $polaczenie );

}

function produkty_kategoria_dodaj_nowy($produkty_kategoria_nr_kolejnosci_tmp, $produkty_kategoria_nazwa_tmp, $produkty_strona_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL `produkty_kategoria_dodaj_nowy`("'.$produkty_kategoria_nr_kolejnosci_tmp.'","'.$produkty_kategoria_nazwa_tmp.'","'.$produkty_strona_id_tmp.'","'.$uzytkownik_id_tmp.'")' );
	var_dump($wynik);
	mysqli_close ( $polaczenie );
}

function produkty_strona_edytuj($produkty_strona_nr_kolejnosci_tmp, $produkty_strona_nazwa_tmp, $produkty_strona_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'UPDATE `produkty_strona` SET `nr_kolejnosci`='.$produkty_strona_nr_kolejnosci_tmp.',`nazwa`="'.$produkty_strona_nazwa_tmp.'" WHERE `id` = '.$produkty_strona_id_tmp.' ' );

	mysqli_close ( $polaczenie );
}

function produkty_strona_usun($produkty_strona_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `produkty_strona` SET `czy_usuniety` = 1 WHERE `id` = '.$produkty_strona_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function produkty_kategoria_edytuj($produkty_kategoria_nr_kolejnosci_tmp, $produkty_kategoria_nazwa_tmp, $produkty_kategoria_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `produkty_kategoria` SET `nr_kolejnosci`='.$produkty_kategoria_nr_kolejnosci_tmp.',`nazwa`="'.$produkty_kategoria_nazwa_tmp.'" WHERE `id` = '.$produkty_kategoria_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function produkty_z_kategori_dodaj_nowy($produkty_z_kategori_nr_kolejnosci_tmp, $produkty_z_kategori_nazwa_tmp, $produkty_z_kategori_opis_tmp, $produkty_z_kategori_tworca_tmp, $produkty_kategoria_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'CALL produkty_z_kategori_dodaj_nowy("'.$produkty_z_kategori_nr_kolejnosci_tmp.'","'.$produkty_z_kategori_nazwa_tmp.'","'.$produkty_z_kategori_opis_tmp.'","'.$produkty_z_kategori_tworca_tmp.'","'.$produkty_kategoria_id_tmp.'")' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function produkty_z_kategori_aktualizuj_info_plik($produkty_z_kategori_plik_tmp, $produkty_z_kategori_plik_typ_tmp, $produkty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `produkty` SET `nazwa_pliku` = "'.$produkty_z_kategori_plik_tmp.'", `typ_pliku` = "'.$produkty_z_kategori_plik_typ_tmp.'" WHERE `id` = '.$produkty_z_kategori_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function produkty_z_kategori_dodaj_uprawnienie_dla_uzytkownika($uzytkownik_id_tmp, $produkty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' INSERT INTO `produkty_uzytkownicy`(`uzytkownik_id`, `produkty_id`) VALUES ('.$uzytkownik_id_tmp.','.$produkty_z_kategori_id_tmp.') ' );
	
	mysqli_close ( $polaczenie );
}

function produkty_z_kategori_aktualizuj_info_plik_edytuj($produkty_z_kategori_plik_tmp, $produkty_z_kategori_plik_typ_tmp, $produkty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'UPDATE `produkty` SET `nazwa_pliku` = "'.$produkty_z_kategori_plik_tmp.'", `typ_pliku` = "'.$produkty_z_kategori_plik_typ_tmp.'", `liczba_pobran` = 0 WHERE `id` = '.$produkty_z_kategori_id_tmp.' ' );

	mysqli_close ( $polaczenie );
}

function produkty_z_kategori_pobierz_dane_po_id($produkty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `produkty` WHERE `id` = '.$produkty_z_kategori_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc ( $wynik );
}

function produkty_z_kategori_aktualizuj_liczba_pobran($produkty_z_kategori_id_tmp, $liczba_p_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'UPDATE `produkty` SET `liczba_pobran` = '.$liczba_p_tmp.' WHERE `id` = '.$produkty_z_kategori_id_tmp.' ' );

	mysqli_close ( $polaczenie );

}

function produkty_z_kategori_archiwum_aktualizuj_liczba_pobran($produkty_z_kategori_id_tmp, $liczba_p_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `produkty_archiwum` SET `liczba_pobran` = '.$liczba_p_tmp.' WHERE `id` = '.$produkty_z_kategori_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

function produkty_z_kategori_edytuj_po_id($produkty_z_kategori_nr_kolejnosci, $produkty_z_kategori_nazwa, $produkty_z_kategori_opis, $produkty_z_kategori_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'UPDATE `produkty` SET `nr_kolejnosci`='.$produkty_z_kategori_nr_kolejnosci.',`nazwa_produktu`=\''.$produkty_z_kategori_nazwa.'\',`data_modyfikacji`=NOW(),`opis`=\''.$produkty_z_kategori_opis.'\' WHERE `id` = '.$produkty_z_kategori_id.' ' );
	
	mysqli_close ( $polaczenie );
}

function produkty_archiwum_dodaj_nowy($produkty_id_tmp, $produkt_nazwa_pliku_tmp, $produkt_typ_pliku_tmp, $tworca_id_tmp, $produkt_liczba_pobran_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `produkty_archiwum`(`produkty_id`, `nazwa_pliku`, `typ_pliku`, `tworca_id`, `data_archiwizacji`, `liczba_pobran`) VALUES ('.$produkty_id_tmp.',"'.$produkt_nazwa_pliku_tmp.'","'.$produkt_typ_pliku_tmp.'",'.$tworca_id_tmp.',NOW(),'.$produkt_liczba_pobran_tmp.')' );
	
	mysqli_close ( $polaczenie );
}

function produkty_z_kategori_archiwum_pobierz_dane_po_id($produkty_z_kategori_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'SELECT * FROM `produkty_archiwum` WHERE `produkty_id` = '.$produkty_z_kategori_id.' ORDER BY `data_archiwizacji` DESC ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function uzytkownik_grupy_pobierz_wszystkie(){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `uzytkownik_grupy` WHERE `id` != 1 ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function produkty_grupy_pobierz_grupa_id($produkty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' SELECT `uzytkownik_grupa_id` FROM `produkty_grupy` WHERE `produkty_id` = '.$produkty_z_kategori_id_tmp.' ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function usun_produkty_grupy($produkty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'DELETE FROM `produkty_grupy` WHERE `uzytkownik_grupa_id` = '.$uzytkownik_grupa_id_tmp.' AND `produkty_id` = '.$produkty_id_tmp.' ' );

	mysqli_close ( $polaczenie );

}

function dodaj_produkty_grupy($produkty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `produkty_grupy`(`uzytkownik_grupa_id`, `produkty_id`) VALUES ('.$uzytkownik_grupa_id_tmp.','.$produkty_id_tmp.')' );

	mysqli_close ( $polaczenie );

}

function produkty_uzytkownicy_pobierz_wszystkie($produkty_z_kategori_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' CALL `produkty_uzytkownicy_pobierz_wszystkie`("'.$produkty_z_kategori_id_tmp.'")  ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function produkty_uzytkownicy_usun($produkty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' DELETE FROM `produkty_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' AND `produkty_id` = '.$produkty_id_tmp.'  ' );
	
	mysqli_close ( $polaczenie );
}

function produkty_grupa_uzytkownicy_usun($produkty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' DELETE FROM `produkty_strona_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' AND `produkty_strona_id` = '.$produkty_id_tmp.'  ' );

	mysqli_close ( $polaczenie );
}

function produkty_kategoria_uzytkownicy_usun($produkty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' DELETE FROM `produkty_kategoria_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id_tmp.' AND `produkty_kategoria_id` = '.$produkty_id_tmp.'  ' );

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

function lista_uzytkownikow_dla_grupy_dodaj_uprawnienie($produkty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `produkty_uzytkownicy`(`uzytkownik_id`, `produkty_id`) VALUES ('.$uzytkownik_id_tmp.','.$produkty_id_tmp.')' );
	
	mysqli_close ( $polaczenie );
}

function lista_uzytkownikow_dla_grupy_sprawdz_czy_istnieje($produkt_id, $uzytkownik_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `produkty_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id.' AND `produkty_id` = '.$produkt_id.' ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function produkty_grupa_kategoria_pobierz_dane($element_id, $tabelka){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `'.$tabelka.'` WHERE `id` = '.$element_id.' ' );
	
	mysqli_close ( $polaczenie );
	
	return mysqli_fetch_assoc($wynik);
}

function produkty_grupa_kategoria_pobierz_grupy_po_id($element_id, $tabelka){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' SELECT `uzytkownik_grupa_id` FROM `'.$tabelka.'_grupy` WHERE `'.$tabelka.'_id` = '.$element_id.' ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function produkty_grupa_uzytkownicy_pobierz($element_id){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' CALL `produkty_grupa_uzytkownicy_pobierz`("'.$element_id.'") ' );
	
	mysqli_close ( $polaczenie );
	
	return $wynik;
}

function produkty_kategoria_uzytkownicy_pobierz($element_id){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' CALL `produkty_kategoria_uzytkownicy_pobierz`("'.$element_id.'") ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function lista_uzytkownikow_dla_strona_grupa_sprawdz_czy_istnieje($produkt_id, $uzytkownik_id){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `produkty_strona_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id.' AND `produkty_strona_id` = '.$produkt_id.' ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie($produkty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `produkty_strona_uzytkownicy`(`uzytkownik_id`, `produkty_strona_id`) VALUES ('.$uzytkownik_id_tmp.','.$produkty_id_tmp.')' );

	mysqli_close ( $polaczenie );
}

function produkty_grupa_usun_produkty_grupy($produkty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'DELETE FROM `produkty_strona_grupy` WHERE `uzytkownik_grupa_id` = '.$uzytkownik_grupa_id_tmp.' AND `produkty_strona_id` = '.$produkty_id_tmp.' ' );

	mysqli_close ( $polaczenie );

}

function produkty_grupa_dodaj_produkty_grupy($produkty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `produkty_strona_grupy`(`uzytkownik_grupa_id`, `produkty_strona_id`) VALUES ('.$uzytkownik_grupa_id_tmp.','.$produkty_id_tmp.')' );

	mysqli_close ( $polaczenie );
}

function lista_uzytkownikow_dla_kategoria_grupa_sprawdz_czy_istnieje($produkt_id, $uzytkownik_id){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, ' SELECT * FROM `produkty_kategoria_uzytkownicy` WHERE `uzytkownik_id` = '.$uzytkownik_id.' AND `produkty_kategoria_id` = '.$produkt_id.' ' );

	mysqli_close ( $polaczenie );

	return $wynik;
}

function lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie($produkty_id_tmp, $uzytkownik_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `produkty_kategoria_uzytkownicy`(`uzytkownik_id`, `produkty_kategoria_id`) VALUES ('.$uzytkownik_id_tmp.','.$produkty_id_tmp.')' );

	mysqli_close ( $polaczenie );
}

function produkty_kategoria_usun_produkty_grupy($produkty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'DELETE FROM `produkty_kategoria_grupy` WHERE `uzytkownik_grupa_id` = '.$uzytkownik_grupa_id_tmp.' AND `produkty_kategoria_id` = '.$produkty_id_tmp.' ' );

	mysqli_close ( $polaczenie );

}

function produkty_kategoria_dodaj_produkty_grupy($produkty_id_tmp, $uzytkownik_grupa_id_tmp){
	$polaczenie = polacz_z_baza();

	$wynik = mysqli_query ( $polaczenie, 'INSERT INTO `produkty_kategoria_grupy`(`uzytkownik_grupa_id`, `produkty_kategoria_id`) VALUES ('.$uzytkownik_grupa_id_tmp.','.$produkty_id_tmp.')' );

	mysqli_close ( $polaczenie );

}

/*kamyk 2016-08-30*/
function produkty_usun_produkt($produkt_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' UPDATE `produkty` SET `czy_usuniety`= 1 WHERE `id`= '.$produkt_id_tmp.' ' );
	
	mysqli_close ( $polaczenie );
}

/*kamyk 2016-08-30*/
function produkty_kategoria_usun($kategoria_id_tmp){
	$polaczenie = polacz_z_baza();
	
	$wynik = mysqli_query ( $polaczenie, ' UPDATE `produkty_kategoria` SET `czy_usuniety`= 1 WHERE `id`='.$kategoria_id_tmp.'; ' );
	
	mysqli_close ( $polaczenie );
}

























