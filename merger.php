<?php

require_once ('funkcje_glowne.php');

$pdf = new PDFMerger;

$pdf->addPDF('/var/www/pliki/!druki/102/1498659091_pouczenie.pdf', 'all')
    ->addPDF('/var/www/pliki/!druki/102/1498659091_pouczenie.pdf', 'all')
    ->merge('file', '/var/www/pliki/!druki/102/TEST20.pdf');