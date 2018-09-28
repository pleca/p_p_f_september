<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars ( $_POST ['id_sprawy'] );
$miejsce_hospitalizacji = htmlspecialchars ( $_POST ['miejsce_hospitalizacji'] );
$data_hospitalizacji = htmlspecialchars ( $_POST ['data_hospitalizacji'] );
$data_hospitalizacji_do = htmlspecialchars ( $_POST ['data_hospitalizacji_do'] );
$przebieg_leczenia = htmlspecialchars ( $_POST ['przebieg_leczenia_id'] );
$hospitalizacja_id = htmlspecialchars ( $_POST ['id_hospitalizacji'] );

$hospitalizacja = sprawa_dodaj_lub_aktualizuj_hospitalizacja ( $hospitalizacja_id, $przebieg_leczenia, $miejsce_hospitalizacji, $data_hospitalizacji, $data_hospitalizacji_do);

sprawa_aktualizuj_ostatnia_strone ( $sprawa_id, '11' );

$dane = array (
		0 => $hospitalizacja ['id_hospitalizacji'] 
);

// echo $hospitalizacja ['id_hospitalizacji'];
echo json_encode ( $dane );