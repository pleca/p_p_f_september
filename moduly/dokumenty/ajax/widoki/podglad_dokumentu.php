<?php

if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: https://'.$_SERVER ['HTTP_HOST'] );
	die();
}else{

	$file = '/var/www/pliki/!dokumenty/'.$_GET['id_d'].'/'.$_GET['nazwa'];
	
	header("Content-type: application/pdf");
	ob_clean();
	readfile($file);

	
}