<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars ( $_POST ['id_sprawy'] );
$miejsce_zabiegu = htmlspecialchars ( $_POST ['miejsce_zabiegu'] );
$data_zabiegu = htmlspecialchars ( $_POST ['data_zabiegu'] );
$przebieg_leczenia = htmlspecialchars ( $_POST ['przebieg_leczenia_id'] );
$zabieg_id = htmlspecialchars ( $_POST ['id_zabiegu'] );

$placowki = sprawa_dodaj_lub_aktualizuj_placowki ( $zabieg_id, $przebieg_leczenia, $miejsce_zabiegu, $data_zabiegu );

sprawa_aktualizuj_ostatnia_strone ( $sprawa_id, '11' );

$dane = array (
		0 => $placowki ['id_placowki'] 
);

echo json_encode ( $dane );