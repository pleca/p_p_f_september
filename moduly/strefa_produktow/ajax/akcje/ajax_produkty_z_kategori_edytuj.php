<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkty_z_kategori_nr_kolejnosci = $_POST['produkty_z_kategori_nr_kolejnosci'];
$produkty_z_kategori_nazwa = $_POST['produkty_z_kategori_nazwa'];
$produkty_z_kategori_opis = $_POST['produkty_z_kategori_opis'];
$produkty_z_kategori_id_id = $_POST['produkty_z_kategori_id_id'];
$liczba_rand = $_POST['liczba_rand'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

$produkty_z_kategori_id = produkty_z_kategori_edytuj_po_id($produkty_z_kategori_nr_kolejnosci
															,$produkty_z_kategori_nazwa
															,$produkty_z_kategori_opis
															,$produkty_z_kategori_id_id
															);



$lokalizacja = "/var/www/pliki/!strefa_plikow/$produkty_z_kategori_id_id";

if(!file_exists($lokalizacja)){
	mkdir($lokalizacja, 0777);
}


if(isset($_FILES ['produkty_z_kategori_plik'])){
	
	$stary_produkt = produkty_z_kategori_pobierz_dane_po_id($produkty_z_kategori_id_id);

    produkty_archiwum_dodaj_nowy($produkty_z_kategori_id_id, $stary_produkt['nazwa_pliku'], $stary_produkt['typ_pliku'], $_SESSION['uzytkownik_id'], $stary_produkt['liczba_pobran']);
	
	$produkty_z_kategori_plik_nazwa = $_FILES ['produkty_z_kategori_plik']['name'];
	$produkty_z_kategori_plik_nazwa = explode(".", $produkty_z_kategori_plik_nazwa);
	$produkty_z_kategori_plik_nazwa = end($produkty_z_kategori_plik_nazwa);
	
	$produkty_z_kategori_plik = md5(date('dmYHisu').$liczba_rand.$_FILES ['produkty_z_kategori_plik']['size'].$_FILES ['produkty_z_kategori_plik']['name']).'.'.$produkty_z_kategori_plik_nazwa;
	move_uploaded_file ( $_FILES ['produkty_z_kategori_plik']['tmp_name'], $lokalizacja.'/'.$produkty_z_kategori_plik );

    produkty_z_kategori_aktualizuj_info_plik_edytuj($produkty_z_kategori_plik, $_FILES ['produkty_z_kategori_plik']['type'], $produkty_z_kategori_id_id);
	
}

//echo $lokalizacja;
