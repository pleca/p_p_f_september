<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$produkty_kategoria_nr_kolejnosci = $_POST['produkty_kategoria_nr_kolejnosci'];
$produkty_kategoria_nazwa = $_POST['produkty_kategoria_nazwa'];
$produkty_kategoria_id = $_POST['produkty_kategoria_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

produkty_kategoria_edytuj($produkty_kategoria_nr_kolejnosci, $produkty_kategoria_nazwa, $produkty_kategoria_id);