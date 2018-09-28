<?php

if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: https://'.$_SERVER ['HTTP_HOST'] );
	die();
}

session_start();

if(!isset($_SESSION['zalogowany']) || !isset($_SESSION['uzytkownik_id']) 
		|| !isset($_SESSION['uzytkownik_imie']) || !isset($_SESSION['uzytkownik_nazwisko'])){
	session_destroy();
    header ( 'Location: https://'.$_SERVER ['HTTP_HOST'] );
    die();
}

define('sciezka_dluga', $_SERVER ['DOCUMENT_ROOT']);
require_once(sciezka_dluga . '/funkcje_glowne.php');
require_once(sciezka_dluga . '/db/function_db.php');

$luzuwb = pobierz_liste_uprawnien_zalogowanego_uzytkownika($_SESSION['uzytkownik_id']);

$j=0;

$luzu = array();
while ($uprawnienie_l_b = mysqli_fetch_assoc ( $luzuwb )) {
	$luzu[$j] = $uprawnienie_l_b['id_uprawnienia'];
	$j++;
}

require_once(sciezka_dluga . '/konfiguracja/autoload.php');

$mainPanel->pobierzListeUprawnien($_SESSION['uzytkownik_id'], $bazaDanych);
