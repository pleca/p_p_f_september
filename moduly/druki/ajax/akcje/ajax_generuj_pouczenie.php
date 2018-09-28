<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$drukiaMain = new DrukiMain();

$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '' ;
$nazwa_druku = (isset($_POST['nazwa_druku'])) ? htmlspecialchars($_POST['nazwa_druku']) : '' ;

$element_id = explode('-',$element_id);
//$element_id[0] - umowa
//$element_id[1] - glowny klient
//$element_id[2] - umowa typ

$komunikat = 'Brak akcji do wykonania!!!';
$rodzajOut = 'blad';

$zmienne_pdf = array();

$umowa = $bazaDanych->pobierzDane('*','umowa','Id = '.$element_id[0]);
$umowa = $umowa->fetch_object();

$zmienne_pdf['umowa'] = array(
    'DataUmowy' => $umowa->DataUmowy
,'Miasto' => $umowa->Miasto
);
$zmienne_pdf['umowa'] = json_encode($zmienne_pdf['umowa']);


switch ($droga) {
    case 'bankowa':

        break;
    case 'rzeczowa':

        $umowaRzeczowa = $bazaDanych->pobierzDane('*','umowaRzeczowa','Id = '.$element_id[2]);
        $umowaRzeczowa = $umowaRzeczowa->fetch_object();


        $wartosc_uproszczona_umowy = $bazaDanych->pobierzDane('*','umowaSlownikUmowaRzeczowaTyp','Id = '.$umowaRzeczowa->UmowaRzeczowaTypId);
        $wartosc_uproszczona_umowy = $wartosc_uproszczona_umowy->fetch_object();

        $droga = $wartosc_uproszczona_umowy->WartoscUproszczona;

        break;

    case 'osobowa':

        $umowaOsobowa = $bazaDanych->pobierzDane('*','umowaOsobowa','Id = '.$element_id[2]);
        $umowaOsobowa = $umowaOsobowa->fetch_object();

        break;
}

$adres_http_umowy = 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/'.$droga.'/'.$nazwa_druku.'';

require_once($_SERVER ['DOCUMENT_ROOT'] . 'biblioteki/generator_pdf/vendor/autoload.php');
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
$pdf->addPage ( $adres_http_umowy );

if (! file_exists ( '/var/www/pliki/!druki/' . $element_id[0] )) {
    mkdir ( '/var/www/pliki/!druki/' . $element_id[0], 0777 );
}

//$nazwa_pliku = date('U').'_'.$nazwa_druku;
$nazwa_pliku = $element_id[0].'_'.$nazwa_druku;

if (! $pdf->saveAs ( '/var/www/pliki/!druki/' . $element_id[0] . '/'.$nazwa_pliku.'.pdf' )) {
    $komunikat = $pdf->getError();
}

$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Wygenerowanie '.$nazwa_druku, '', $nazwa_pliku, 'umowa_historia_zmian');


$komunikat = 'Wygenerowano poprawnie dokument!!!';
$rodzajOut = 'sukces';

$dane = array(
    'rodzaj' => $rodzajOut
,'komunikat' => $komunikat
,'element_id' => $element_id[0]
,'nazwa_pliku' => $nazwa_pliku

);

echo json_encode($dane);
return;