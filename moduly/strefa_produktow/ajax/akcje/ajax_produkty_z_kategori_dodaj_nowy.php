<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkty_z_kategori_nr_kolejnosci = $_POST['produkty_z_kategori_nr_kolejnosci'];
$produkty_z_kategori_nazwa = $_POST['produkty_z_kategori_nazwa'];
$produkty_z_kategori_opis = $_POST['produkty_z_kategori_opis'];
$produkty_kategoria_id = $_POST['produkty_kategoria_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

$produkty_z_kategori_id = produkty_z_kategori_dodaj_nowy($produkty_z_kategori_nr_kolejnosci
															,$produkty_z_kategori_nazwa
															,$produkty_z_kategori_opis
															,$_SESSION['uzytkownik_id']
															,$produkty_kategoria_id
															);
$produkty_z_kategori_id = mysqli_fetch_assoc($produkty_z_kategori_id);
$produkty_z_kategori_id = $produkty_z_kategori_id['id'];


$lokalizacja = "/var/www/pliki/!strefa_plikow/$produkty_z_kategori_id";

if(!file_exists($lokalizacja)){
	mkdir($lokalizacja, 0777);
}
$produkty_z_kategori_plik_nazwa = $_FILES ['produkty_z_kategori_plik']['name'];
$produkty_z_kategori_plik_nazwa = explode(".", $produkty_z_kategori_plik_nazwa);
$produkty_z_kategori_plik_nazwa = end($produkty_z_kategori_plik_nazwa);

$produkty_z_kategori_plik = md5(date('dmYHisu').$liczba_rand.$_FILES ['produkty_z_kategori_plik']['size'].$_FILES ['produkty_z_kategori_plik']['name']).'.'.$produkty_z_kategori_plik_nazwa;
move_uploaded_file ( $_FILES ['produkty_z_kategori_plik']['tmp_name'], $lokalizacja.'/'.$produkty_z_kategori_plik );

produkty_z_kategori_aktualizuj_info_plik($produkty_z_kategori_plik, $_FILES ['produkty_z_kategori_plik']['type'], $produkty_z_kategori_id);

produkty_z_kategori_dodaj_uprawnienie_dla_uzytkownika($_SESSION['uzytkownik_id'], $produkty_z_kategori_id);