<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$file = '/var/www/pliki/!podcasty/'.$_GET['id'].'/'.$_GET['nazwa'];

if (file_exists($file)) {

    $bazaDancyh = new main_BazaDanych();
    $filmyMain = new FilmyMain($bazaDanych);

    $podcast_tmp = $bazaDanych->pobierzDane('liczba_pobran','podcasty','id = '.$_GET['id']);
    $podcast_tmp = $podcast_tmp->fetch_object();

    $filmyMain->dodajWpisDoHistorii($bazaDanych, $_GET['id'], 'podcasty_id', 'Pobranie', '', '' , 'podcasty_historia_zmian');
    $bazaDanych->aktualizujDane('podcasty',array(
        'liczba_pobran' => ($podcast_tmp->liczba_pobran + 1)
    ),$_GET['id']);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header("Cache-Control: must-revalidate");
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}

