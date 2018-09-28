<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$dokumenty_strona_nr_kolejnosci = $_POST['dokumenty_strona_nr_kolejnosci'];
$dokumenty_strona_nazwa = $_POST['dokumenty_strona_nazwa'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

$dokument_strona_id = dokumenty_strona_dodaj_nowy($dokumenty_strona_nr_kolejnosci, $dokumenty_strona_nazwa, $_SESSION['uzytkownik_id']);

$dokument_strona_id = mysqli_fetch_assoc($dokument_strona_id);

dokumenty_kategoria_dodaj_brak_kategorii($dokument_strona_id['id']);

//echo $dokument_strona_id['id'];