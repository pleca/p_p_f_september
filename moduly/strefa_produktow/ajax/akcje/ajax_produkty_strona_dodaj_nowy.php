<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkty_strona_nr_kolejnosci = $_POST['produkty_strona_nr_kolejnosci'];
$produkty_strona_nazwa = $_POST['produkty_strona_nazwa'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

$produkt_strona_id = produkty_strona_dodaj_nowy($produkty_strona_nr_kolejnosci, $produkty_strona_nazwa, $_SESSION['uzytkownik_id']);

$produkt_strona_id = mysqli_fetch_assoc($produkt_strona_id);
produkty_kategoria_dodaj_brak_kategorii($produkt_strona_id['id']);

//echo $dokument_strona_id['id'];