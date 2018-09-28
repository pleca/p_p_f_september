<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$dokumenty_z_kategori_nr_kolejnosci = $_POST['dokumenty_z_kategori_nr_kolejnosci'];
$dokumenty_z_kategori_nazwa = $_POST['dokumenty_z_kategori_nazwa'];
$dokumenty_z_kategori_opis = $_POST['dokumenty_z_kategori_opis'];
$dokumenty_kategoria_id = $_POST['dokumenty_kategoria_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

$dokumenty_z_kategori_id = dokumenty_z_kategori_dodaj_nowy($dokumenty_z_kategori_nr_kolejnosci
															,$dokumenty_z_kategori_nazwa
															,$dokumenty_z_kategori_opis
															,$_SESSION['uzytkownik_id']
															,$dokumenty_kategoria_id
															);
$dokumenty_z_kategori_id = mysqli_fetch_assoc($dokumenty_z_kategori_id);
$dokumenty_z_kategori_id = $dokumenty_z_kategori_id['id'];


$lokalizacja = "/var/www/pliki/!dokumenty/$dokumenty_z_kategori_id";

if(!file_exists($lokalizacja)){
	mkdir($lokalizacja, 0777);
}
$dokumenty_z_kategori_plik_nazwa = $_FILES ['dokumenty_z_kategori_plik']['name'];
$dokumenty_z_kategori_plik_nazwa = explode(".", $dokumenty_z_kategori_plik_nazwa);
$dokumenty_z_kategori_plik_nazwa = end($dokumenty_z_kategori_plik_nazwa);

$dokumenty_z_kategori_plik = md5(date('dmYHisu').$liczba_rand.$_FILES ['dokumenty_z_kategori_plik']['size'].$_FILES ['dokumenty_z_kategori_plik']['name']).'.'.$dokumenty_z_kategori_plik_nazwa;
move_uploaded_file ( $_FILES ['dokumenty_z_kategori_plik']['tmp_name'], $lokalizacja.'/'.$dokumenty_z_kategori_plik );

dokumenty_z_kategori_aktualizuj_info_plik($dokumenty_z_kategori_plik, $_FILES ['dokumenty_z_kategori_plik']['type'], $dokumenty_z_kategori_id);

dokumenty_z_kategori_dodaj_uprawnienie_dla_uzytkownika($_SESSION['uzytkownik_id'], $dokumenty_z_kategori_id);