<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');


$id_sprawy = htmlspecialchars($_POST['id_sprawy']);
$id_przebieg_leczenia = htmlspecialchars($_POST['id_przebieg_leczenia']);
$id_usuniete = htmlspecialchars($_POST['id_usuniete']);

usun_placowka($id_usuniete);

