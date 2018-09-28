<?php
include 'PDFMerger.php';

//require_once($_SERVER ['DOCUMENT_ROOT'] . 'biblioteki/generator_pdf/vendor/autoload.php');

$pdf = new PDFMerger;

$pdf->addPDF('01.pdf', 'all')
	->addPDF('02.pdf', 'all')
	->merge('file', 'OK.pdf');
	
	//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.
