<?php

if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: https://'.$_SERVER ['HTTP_HOST'] );
	die();
}else{

	$produkt_id = $_GET['id_d'];
	$nazwa_pliku = $_GET['nazwa'];
	$liczba_p = $_GET['liczba_p'];
	$nazwa_pliku1 = explode('.', $nazwa_pliku);
	
	require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');
	
	$liczba_p = $liczba_p+1;
	
	if($_GET['arch'] == '1'){
		produkty_z_kategori_archiwum_aktualizuj_liczba_pobran($produkt_id, $liczba_p);
	}else{
		produkty_z_kategori_aktualizuj_liczba_pobran($produkt_id, $liczba_p);
	}
	
	
	header('Content-Description: attachment');
	header('Content-Type: application/octet-stream');
	header("Content-Disposition: inline; filename=produkt.$nazwa_pliku1[1]");
	readfile('/var/www/pliki/!strefa_plikow/'.$produkt_id.'/'.$nazwa_pliku);
	
}