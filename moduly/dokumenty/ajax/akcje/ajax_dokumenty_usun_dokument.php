<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$dokument_id = $_POST['dokument_id'];

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

dokumenty_usun_dokument($dokument_id);