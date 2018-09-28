<?php 
if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
	die();
}

setlocale(LC_CTYPE, "pl_PL.UTF-8");

require $_SERVER ['DOCUMENT_ROOT']. '/biblioteki/generator_pdf/vendor/autoload.php';

use mikehaertl\wkhtmlto\Pdf;

$opcje = array(
		'encoding' => 'UTF-8'
);


$pdf = new Pdf(array(
		'commandOptions' => array(
				'enableXvfb' => true,
				'xvfbRunBinary' => 'exec xvfb-run'

		)
));


$pdf->setOptions($opcje);

//$pdf->addPage('https://umowy.votum-sa.pl/wzory_dokumentow/umowa_optima/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_optima');

//$pdf->addPage('https://umowy.votum-sa.pl/wzory_dokumentow/umowa_optima/potwierdzenie_zamowienia_optima');

$pdf->addPage('https://umowy.votum-sa.pl/wzory_dokumentow/umowa_optima/oswiadczenie_o_dojazdach_do_placowek_medycznych');


if (!$pdf->send()) {
	throw new Exception('Could not create PDF: '.$pdf->getError());
}else{
	$pdf->send();
}