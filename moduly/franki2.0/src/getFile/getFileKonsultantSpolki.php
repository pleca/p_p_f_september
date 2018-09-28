<?php

if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: https://'.$_SERVER ['HTTP_HOST'] );
	die();
}else{
	
	header('Content-Description: attachment');
	header('Content-Type: application/octet-stream');
	header("Content-Disposition: attachment; filename=konsultantSpolki.pdf");
	readfile('/var/www/html/moduly/franki2.0/src/getFile/konsultantSpolki.pdf');
	
}