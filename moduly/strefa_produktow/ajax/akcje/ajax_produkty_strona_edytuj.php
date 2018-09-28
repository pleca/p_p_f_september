<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkty_strona_nr_kolejnosci = $_POST['produkty_strona_nr_kolejnosci'];
$produkty_strona_nazwa = $_POST['produkty_strona_nazwa'];
$produkty_strona_id = $_POST['produkty_strona_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

produkty_strona_edytuj($produkty_strona_nr_kolejnosci, $produkty_strona_nazwa, $produkty_strona_id);

