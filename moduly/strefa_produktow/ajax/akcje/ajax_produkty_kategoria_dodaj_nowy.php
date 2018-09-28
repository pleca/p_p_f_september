<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkty_kategoria_nr_kolejnosci = $_POST['produkty_kategoria_nr_kolejnosci'];
$produkty_kategoria_nazwa = $_POST['produkty_kategoria_nazwa'];
$produkty_strona_id = $_POST['produkty_strona_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

produkty_kategoria_dodaj_nowy($produkty_kategoria_nr_kolejnosci, $produkty_kategoria_nazwa, $produkty_strona_id, $_SESSION['uzytkownik_id']);

