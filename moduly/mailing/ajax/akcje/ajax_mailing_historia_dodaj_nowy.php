<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

ini_set('memory_limit', '1024M');

$mailing_adresat_imie_nazwisko = htmlspecialchars($_POST['mailing_adresat_imie_nazwisko']);
$mailing_adresat_email = htmlspecialchars($_POST['mailing_adresat_email']);
$mailing_temat = htmlspecialchars($_POST['mailing_temat']);
$mailing_tresc = htmlspecialchars($_POST['mailing_tresc']);

$mailing_obrazki = $_POST['mailing_obrazki'];
$mailing_zalaczniki = $_POST['mailing_zalaczniki'];
$mailing_odbiorcy = $_POST['mailing_odbiorcy'];

$odbiorcy = array_values($mailing_odbiorcy);

$mailing_obrazki = array_values($mailing_obrazki);
$mailing_zalaczniki = array_values($mailing_zalaczniki);
$mailing_odbiorcy = array_values($mailing_odbiorcy);

//echo (json_encode($mailing_odbiorcy, JSON_UNESCAPED_UNICODE));

$mailing_id = mailing_historia_dodaj_nowy(
		$_SESSION['uzytkownik_id']
		,$mailing_adresat_imie_nazwisko
		,$mailing_adresat_email
		,$mailing_temat
		,$mailing_tresc
		,htmlspecialchars(json_encode($mailing_obrazki, JSON_UNESCAPED_UNICODE))
		,htmlspecialchars(json_encode($mailing_zalaczniki, JSON_UNESCAPED_UNICODE))
		,htmlspecialchars(json_encode($mailing_odbiorcy, JSON_UNESCAPED_UNICODE))
		);

$mailing_id = $mailing_id['id'];

if(!empty($mailing_zalaczniki)){
	$lokalizacja = "/var/www/pliki/!mailing/historia/$mailing_id";
	
	if(!file_exists($lokalizacja)){
		mkdir($lokalizacja, 0777);
	}
	
	if(count($mailing_zalaczniki) != 0){
		for($j=0;$j<count($mailing_zalaczniki);$j++){
			rename($_SERVER['DOCUMENT_ROOT'].'moduly/mailing/tmp/'.$mailing_zalaczniki[$j]['src'], $lokalizacja.'/'.$mailing_zalaczniki[$j]['src']);
		}
	}
}

if(!empty($mailing_odbiorcy)){
	$lokalizacja = "/var/www/pliki/!mailing/historia/$mailing_id";
	
	if(!file_exists($lokalizacja)){
		mkdir($lokalizacja, 0777);
	}
	
	
	$liczba_odbiorcoww = count($odbiorcy);
	
	
	touch($lokalizacja.'/log_'.$mailing_id.'.txt');
	chmod($lokalizacja.'/log_'.$mailing_id.'.txt',0777);
	
	$fp = fopen($lokalizacja.'/log_'.$mailing_id.'.txt', "w");
	
	for($i=0;$i<$liczba_odbiorcoww;$i++){
		$stara_tresc = fread($fp, filesize($lokalizacja.'/log_'.$mailing_id.'.txt'));
		$nowe_dane = $odbiorcy[$i]['email'].' - '.$odbiorcy[$i]['komunikat']."\r\n";
		
		$nowe_dane .= $stara_tresc;
		
		//$nowe_dane = count($odbiorcy);
		
		fputs($fp, $nowe_dane);
	}
	
	fclose($fp);
	
}

















