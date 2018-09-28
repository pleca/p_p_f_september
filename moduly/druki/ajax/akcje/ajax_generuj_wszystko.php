<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'biblioteki/PDFMerger/PDFMerger.php');

$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '' ;
$nazwa_druku = (isset($_POST['nazwa_druku'])) ? htmlspecialchars($_POST['nazwa_druku']) : '' ;

$element_id = explode('-',$element_id);

$komunikat = 'Brak akcji do wykonania!!!';
$rodzajOut = 'blad';

    if (! file_exists ( '/var/www/pliki/!druki/' . $element_id[0] )) {
        mkdir ( '/var/www/pliki/!druki/' . $element_id[0], 0777 );
    }

    $katalog = '/var/www/pliki/!druki/'.$element_id[0];
    $tablica_plikow = scandir($katalog);

    $skanowanie_katalogu = array_diff($tablica_plikow, array('..', '.'));

    $ile_plikow = (count($tablica_plikow));

    for ($i = 0; $i <= $ile_plikow; $i++) {
        if (!empty($skanowanie_katalogu[$i])) {
            $nowa_tablica[] = $skanowanie_katalogu[$i];
        }
    };

    $pdf = new PDFMerger;

    if($droga == 'osobowa') {

        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf', 'all');
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_zgloszenie.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_zgloszenie.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_oswiadczenie_poszkodowanego.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_oswiadczenie_poszkodowanego.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_ankieta.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_ankieta.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_votum.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_votum.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_kairp.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_kairp.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pouczenie.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pouczenie.pdf', 'all');
        }
        /*$pdf->addPDF($_SERVER ['DOCUMENT_ROOT'] . 'moduly/druki/!druki_pdf/instrukcja.pdf', 'all');
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_wniosek_do_fundacji_votum.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_wniosek_do_fundacji_votum.pdf', 'all');
        }*/
    } else if ($droga == 'bankowa') {
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf', 'all');
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_votum.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_votum.pdf', 'all');
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_votum.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_kairp.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_kairp.pdf', 'all');
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_kairp.pdf', 'all');
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_kairp.pdf', 'all');
        }
		if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pouczenie.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pouczenie.pdf', 'all');
        }
    } else if ($droga == 'rzeczowa') {
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf', 'all');
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_zalacznik.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_zalacznik.pdf', 'all');
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_zalacznik.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_powiadomienie_dluznika.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_powiadomienie_dluznika.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_do_przelewu_wierzytelnosci.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pelnomocnictwo_do_przelewu_wierzytelnosci.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_oswiadczenie.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_oswiadczenie.pdf', 'all');
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_oswiadczenie.pdf', 'all');
        }
        if (file_exists('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pouczenie.pdf')) {
            $pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_pouczenie.pdf', 'all');
        }
    }

    //$pdf->addPDF('/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_umowa.pdf', 'all');

    /*for ($i = 0; $i < count($nowa_tablica); $i++) {
        $pdf->addPDF('/var/www/pliki/!druki/'.$element_id[0].'/'.$nowa_tablica[$i], 'all');
    }*/

    $pdf->merge('file', '/var/www/pliki/!druki/' . $element_id[0] . '/' . $element_id[0] . '_wszystko.pdf');

return;