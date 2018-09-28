<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$kategoria_id = $_POST['kategoria_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');

produkty_kategoria_usun($kategoria_id);