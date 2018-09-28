<?php
if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
	session_start ();
	session_destroy ();
	header ( 'Location: http://' . $_SERVER ['HTTP_HOST'] );
	die ();
}
session_start ();

$uzytkownik_id = htmlspecialchars ( $_POST ['uzytkownik_id'] );
$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$id_umowy = htmlspecialchars ( $_POST ['id_umowy'] );

$zmienne_pdf ['uzytkownik_id'] = $uzytkownik_id;
$zmienne_pdf ['id_sprawy'] = $id_sprawy;
$zmienne_pdf ['id_umowy'] = $id_umowy;
$zmienne_pdf ['potwierdzenie'] = '1';

setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

require $_SERVER ['DOCUMENT_ROOT'] . 'biblioteki/generator_pdf/vendor/autoload.php';
require $_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php';

use mikehaertl\wkhtmlto\Pdf;

$opcje = array (
		'encoding' => 'UTF-8',
		'post' => $zmienne_pdf 
);

$pdf = new Pdf ( array (
		'commandOptions' => array (
				'enableXvfb' => true,
				'xvfbRunBinary' => 'exec xvfb-run' 
		) 
) );

$pdf->setOptions ( $opcje );

$umowa = sprawa_pobierz_dane_umowy ( $id_umowy );
$umowa = $umowa ['nazwa'];
/*
 * if ($umowa == 'maxima') {
 * $adres_http_umowy_1 = 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/pakiet_maxima';
 * } else if ($umowa == 'optima') {
 * $adres_http_umowy_1 = 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/pakiet_optima';
 * } else if ($umowa == 'promedica') {
 * $adres_http_umowy_1 = 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/pakiet_promedica';
 * }
 */
$zestaw = 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/pliki_do_wydruku';

$pdf->addPage ( $zestaw );

if (! file_exists ( '/var/www/pliki/!sprawy/' . $id_sprawy )) {
	mkdir ( '/var/www/pliki/!sprawy/' . $id_sprawy, 0777 );
}

if (! $pdf->saveAs ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_drukuj_wszystko.pdf' )) {
	throw new Exception ( 'Could not create PDF: ' . $pdf->getError () );
	
	$dane = array (
			0 => '0' 
	);
	
	echo json_encode ( $dane );
	
	return false;
}

$dane = array (
		0 => '1' 
);

echo json_encode ( $dane );

/*header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="umowa.pdf"');
readfile('/var/www/pliki/'.$dokument_id.'_umowa.pdf');*/

