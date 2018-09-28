<?php
if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
	die();
}
session_start();

$id_sprawy = htmlspecialchars($_POST['id_sprawy']);
$potwierdzenie = htmlspecialchars($_POST['potwierdzenie']); 

$zmienne_pdf['id_sprawy'] = $id_sprawy;
$zmienne_pdf['uzytkownik_id'] = $_SESSION['uzytkownik_id'];
$zmienne_pdf['uzytkownik_login'] = $_SESSION['uzytkownik_login'];
$zmienne_pdf['potwierdzenie'] = $potwierdzenie;

setlocale(LC_CTYPE, "pl_PL.UTF-8");

require $_SERVER ['DOCUMENT_ROOT']. 'biblioteki/generator_pdf/vendor/autoload.php';

use mikehaertl\wkhtmlto\Pdf;


$adres_http_umowy = 'https://'.$_SERVER ['HTTP_HOST'].'/wzory_dokumentow/zgloszenie_szkody/druk_zgloszenia_szkody';



$opcje = array(
		'encoding' => 'UTF-8',
		 'post' => $zmienne_pdf
);


$pdf = new Pdf(array(
		'commandOptions' => array(
				'enableXvfb' => true,
				'xvfbRunBinary' => 'exec xvfb-run',

		)
));


$pdf->setOptions($opcje);

$pdf->addPage($adres_http_umowy);

if(!file_exists('/var/www/pliki/!sprawy/'.$id_sprawy)){
	mkdir('/var/www/pliki/!sprawy/'.$id_sprawy, 0777);
}

if($potwierdzenie == '1'){
	$potwierdzenie_napis = 'potwierdzenie_';
}

if (!$pdf->saveAs('/var/www/pliki/!sprawy/'.$id_sprawy.'/'.$id_sprawy.'_'.$potwierdzenie_napis.'druk_zgloszenia_szkody.pdf')) {
	throw new Exception('Could not create PDF: '.$pdf->getError());
	
	$dane = array(
			0 => '0'
	);
	
	echo json_encode($dane);
	
	return false;
}

$dane = array(
		0 => '1'
);

echo json_encode($dane);

/*header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="umowa.pdf"');
readfile('/var/www/pliki/'.$dokument_id.'_umowa.pdf');*/

