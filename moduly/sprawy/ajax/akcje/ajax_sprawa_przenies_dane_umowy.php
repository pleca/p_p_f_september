<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$id_wzor = htmlspecialchars($_POST['id_wzor']);
$id_aktualna = htmlspecialchars($_POST['id_aktualna']);

$sprawa_dubluj = sprawa_dubluj_sprawe($id_wzor, $id_aktualna);

$dane = array(
		0 => $sprawa_dubluj['rodzaj']
		,1 => $sprawa_dubluj['komunikat']
			
);

echo json_encode($dane);