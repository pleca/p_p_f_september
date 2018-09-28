<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');


$element_id = htmlspecialchars($_POST ['element_id']);
$rodzaj = htmlspecialchars($_POST ['rodzaj']);

$lista_elementow = '';

if($rodzaj == 'grupa'){
	$lista_elementow = mailing_pobierz_liste_maili_grupy($element_id);
}

if($rodzaj == 'struktura'){
	$lista_elementow = mailing_pobierz_liste_maili_struktury($element_id);
}

while ($lem = mssql_fetch_assoc($lista_elementow)) {
	$element = explode('@',$lem['agent_mail']);
	
	if($element[1] == 'votum-sa.pl'){
		echo '<div class="mailing_odbiorca_email" data-adresat_email="'.$lem['agent_mail'].'"><p class="mail_napis">'.$lem['agent_mail'].'</p><span class="usun_mail"><span>x</span></span><div class="clear_b"></div></div>';
		
	}
	
}



