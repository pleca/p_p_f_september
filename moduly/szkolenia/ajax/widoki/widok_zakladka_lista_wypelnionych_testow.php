<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
    $szkoleniaTesty = new SzkoleniaTesty();

    $listaTestyDoSprawdzenia = $bazaDanych->pobierzDane('*', 'szkolenia_testy_id_uzytkownik_id', 'sprawdzony = 0 AND zakonczony = 1');
    $listaTestySprawdzone = $bazaDanych->pobierzDane('*', 'szkolenia_testy_id_uzytkownik_id', 'sprawdzony = 1 AND zakonczony = 1');

    echo $szkoleniaTesty->GenerujListeTestow($listaTestyDoSprawdzenia,'Do sprawdzenia', $bazaDanych);
    echo $szkoleniaTesty->GenerujListeTestow($listaTestySprawdzone,'Sprawdzone', $bazaDanych);

