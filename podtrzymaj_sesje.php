<?php
if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
	die();
}else{
	session_start(); header('Refresh: 0');
}

if(!isset($_SESSION['zalogowany']) || !isset($_SESSION['uzytkownik_id'])
		|| !isset($_SESSION['uzytkownik_imie']) || !isset($_SESSION['uzytkownik_nazwisko'])){
			session_destroy();
			die ( header ( 'refresh:0;url=https://'.$_SERVER['HTTP_HOST'] ) );
}