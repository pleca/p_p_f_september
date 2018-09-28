<?php

if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: https://'.$_SERVER ['HTTP_HOST'] );
	die();
}else{

	$dokument_id = $_GET['id_d'];
	$nazwa_pliku = $_GET['nazwa'];
	$liczba_p = $_GET['liczba_p'];
	$nazwa_pliku1 = explode('.', $nazwa_pliku);
	
	require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');
	
	$liczba_p = $liczba_p+1;
	
	if($_GET['arch'] == '1'){
		dokumenty_z_kategori_archiwum_aktualizuj_liczba_pobran($dokument_id, $liczba_p);
	}else{
		dokumenty_z_kategori_aktualizuj_liczba_pobran($dokument_id, $liczba_p);
	}
	
	
	header('Content-Description: attachment');
	header('Content-Type: application/octet-stream');
	header("Content-Disposition: inline; filename=dokument.$nazwa_pliku1[1]");
	readfile('/var/www/pliki/!dokumenty/'.$dokument_id.'/'.$nazwa_pliku);
	
}