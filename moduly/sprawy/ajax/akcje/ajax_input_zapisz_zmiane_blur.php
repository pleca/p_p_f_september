<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$tabela = htmlspecialchars($_POST['tabela']);
$id = htmlspecialchars($_POST['id']);
$komorka = htmlspecialchars($_POST['komorka']);
$wartosc = htmlspecialchars($_POST['wartosc']);

echo $tabela.$id.$komorka.$wartosc;

sprawa_input_zapisz_zmiane($tabela, $id, $komorka, $wartosc);