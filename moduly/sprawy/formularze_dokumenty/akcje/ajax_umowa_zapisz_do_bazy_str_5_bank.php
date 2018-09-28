<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$uzytkownik = $_SESSION ['uzytkownik_id'];

$id_umowy_bankowej = htmlspecialchars ( $_POST ['id_umowy_bankowej'] );

$zgloszono_zwrot = htmlspecialchars ( $_POST ['zgloszono_zwrot'] );
$niesplacone_raty = htmlspecialchars ( $_POST ['niesplacone_raty'] );
$oplata_ubezp_pom = htmlspecialchars ( $_POST ['oplata_ubezp_pom'] );
$pdata_oplata_ubezp_pom = htmlspecialchars ( $_POST ['data_oplata_ubezp_pom'] );
$oplata_wklad_wlasny = htmlspecialchars ( $_POST ['oplata_wklad_wlasny'] );
$data_oplata_wklad_wlasny = htmlspecialchars ( $_POST ['data_oplata_wklad_wlasny'] );

$dodaj_umowa_bankowa = sprawa_dodaj_lub_aktualizuj_umowa_bankowa_2 ( $id_umowy_bankowej, $zgloszono_zwrot, $niesplacone_raty, $oplata_ubezp_pom, $pdata_oplata_ubezp_pom, $oplata_wklad_wlasny, $data_oplata_wklad_wlasny );
$dodaj_umowe_bankowa_id = $dodaj_umowa_bankowa ['id_umowy_bankowej'];

$dane = array (
		0 => $id_sprawy,
		1 => $id_umowy_bankowej 
);

echo json_encode ( $dane );