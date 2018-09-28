<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$dokumenty_z_kategori_nr_kolejnosci = $_POST['dokumenty_z_kategori_nr_kolejnosci'];
$dokumenty_z_kategori_nazwa = $_POST['dokumenty_z_kategori_nazwa'];
$dokumenty_z_kategori_opis = $_POST['dokumenty_z_kategori_opis'];
$dokumenty_z_kategori_id_id = $_POST['dokumenty_z_kategori_id_id'];
$liczba_rand = $_POST['liczba_rand'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

$dokumenty_z_kategori_id = dokumenty_z_kategori_edytuj_po_id($dokumenty_z_kategori_nr_kolejnosci
															,$dokumenty_z_kategori_nazwa
															,$dokumenty_z_kategori_opis
															,$dokumenty_z_kategori_id_id
															);



$lokalizacja = "/var/www/pliki/!dokumenty/$dokumenty_z_kategori_id_id";

if(!file_exists($lokalizacja)){
	mkdir($lokalizacja, 0777);
}


if(isset($_FILES ['dokumenty_z_kategori_plik'])){
	
	$stary_dokument = dokumenty_z_kategori_pobierz_dane_po_id($dokumenty_z_kategori_id_id);
	
	dokumenty_archiwum_dodaj_nowy($dokumenty_z_kategori_id_id, $stary_dokument['nazwa_pliku'], $stary_dokument['typ_pliku'], $_SESSION['uzytkownik_id'], $stary_dokument['liczba_pobran']);
	
	$dokumenty_z_kategori_plik_nazwa = $_FILES ['dokumenty_z_kategori_plik']['name'];
	$dokumenty_z_kategori_plik_nazwa = explode(".", $dokumenty_z_kategori_plik_nazwa);
	$dokumenty_z_kategori_plik_nazwa = end($dokumenty_z_kategori_plik_nazwa);
	
	$dokumenty_z_kategori_plik = md5(date('dmYHisu').$liczba_rand.$_FILES ['dokumenty_z_kategori_plik']['size'].$_FILES ['dokumenty_z_kategori_plik']['name']).'.'.$dokumenty_z_kategori_plik_nazwa;
	move_uploaded_file ( $_FILES ['dokumenty_z_kategori_plik']['tmp_name'], $lokalizacja.'/'.$dokumenty_z_kategori_plik );
	
	dokumenty_z_kategori_aktualizuj_info_plik_edytuj($dokumenty_z_kategori_plik, $_FILES ['dokumenty_z_kategori_plik']['type'], $dokumenty_z_kategori_id_id);
	
}

//echo $lokalizacja;
