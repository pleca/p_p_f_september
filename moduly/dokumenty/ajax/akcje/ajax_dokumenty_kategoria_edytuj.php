<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$dokumenty_kategoria_nr_kolejnosci = $_POST['dokumenty_kategoria_nr_kolejnosci'];
$dokumenty_kategoria_nazwa = $_POST['dokumenty_kategoria_nazwa'];
$dokumenty_kategoria_id = $_POST['dokumenty_kategoria_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

dokumenty_kategoria_edytuj($dokumenty_kategoria_nr_kolejnosci, $dokumenty_kategoria_nazwa, $dokumenty_kategoria_id);