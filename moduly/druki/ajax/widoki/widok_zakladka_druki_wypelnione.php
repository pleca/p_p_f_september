<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$drukiWypelnione = new DrukiWypelnione();

$lista_moich_drukow = $bazaDanych->pobierzDane('Id, UmowaTypId, DataUtworzenia','umowa','PrzedstawicielId = '.$_SESSION['uzytkownik_id']);
$drukiWypelnione->generujListeDrukow($lista_moich_drukow, $bazaDanych, 'Lista Druków');

if($drukiWypelnione->sprawdzUprawnienie('druki_lista_wszystkich_drukow')) {
    $lista_wszystkich_drukow = $bazaDanych->pobierzDane('Id, UmowaTypId, DataUtworzenia', 'umowa', 'czy_usuniety = 0 AND PrzedstawicielId != '.$_SESSION['uzytkownik_id']);
    $drukiWypelnione->generujListeDrukow($lista_wszystkich_drukow, $bazaDanych, 'Lista wszystkich druków');
}