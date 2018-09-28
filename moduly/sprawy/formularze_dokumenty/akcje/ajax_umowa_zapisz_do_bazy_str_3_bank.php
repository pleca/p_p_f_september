<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$uzytkownik = $_SESSION ['uzytkownik_id'];

$nazwa_banku = htmlspecialchars ( $_POST ['nazwa_banku'] );
$numer_umowy = htmlspecialchars ( $_POST ['numer_umowy'] );

$dodaj_umowa_bankowa = sprawa_dodaj_lub_aktualizuj_umowa_bankowa_1 ( '0', $nazwa_banku, $numer_umowy, '', '', '', '', '', '', '', '', '', '', '', '', '' );
$dodaj_umowe_bankowa_id = $dodaj_umowa_bankowa ['id_umowy_bankowej'];

$aktualizuj_umowe_bankowa_sprawy = sprawa_aktualizacja ( 'sprawa_umowa_bankowa_id', $dodaj_umowe_bankowa_id, $id_sprawy );
$aktualizuj_umowe_bankowa_sprawy = mysqli_fetch_assoc ( $aktualizuj_umowe_bankowa_sprawy );

$dane = array (
		0 => $id_sprawy,
		1 => $dodaj_umowe_bankowa_id,
		2 => $nazwa_banku,
		3 => $numer_umowy 
);

echo json_encode ( $dane );
