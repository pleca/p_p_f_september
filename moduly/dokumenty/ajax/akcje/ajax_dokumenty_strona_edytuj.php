<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$dokumenty_strona_nr_kolejnosci = $_POST['dokumenty_strona_nr_kolejnosci'];
$dokumenty_strona_nazwa = $_POST['dokumenty_strona_nazwa'];
$dokumenty_strona_id = $_POST['dokumenty_strona_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

dokumenty_strona_edytuj($dokumenty_strona_nr_kolejnosci, $dokumenty_strona_nazwa, $dokumenty_strona_id);

