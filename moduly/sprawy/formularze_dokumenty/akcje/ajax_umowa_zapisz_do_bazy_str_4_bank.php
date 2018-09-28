<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$uzytkownik = $_SESSION ['uzytkownik_id'];

$id_umowy_bankowej = htmlspecialchars ( $_POST ['id_umowy_bankowej'] );

$umowa = htmlspecialchars ( $_POST ['umowa'] );
$nazwa_banku = htmlspecialchars ( $_POST ['nazwa_banku'] );
$numer_umowy = htmlspecialchars ( $_POST ['numer_umowy'] );
$pelnomocnictwo = htmlspecialchars ( $_POST ['pelnomocnictwo'] );
$umowa_z_bankiem = htmlspecialchars ( $_POST ['umowa_z_bankiem'] );
$dowod = htmlspecialchars ( $_POST ['dowod'] );
$wniosek = htmlspecialchars ( $_POST ['umowa_z_bankiem'] );
$regulamin = htmlspecialchars ( $_POST ['regulamin'] );
$tabela = htmlspecialchars ( $_POST ['tabela'] );
$harmonogram = htmlspecialchars ( $_POST ['harmonogram'] );
$potwierdzenie = htmlspecialchars ( $_POST ['potwierdzenie'] );
$decyzja = htmlspecialchars ( $_POST ['decyzja'] );
$oplaty = htmlspecialchars ( $_POST ['oplaty'] );
$dowod_wspolkredytobiorcy = htmlspecialchars ( $_POST ['dowod_wspolkredytobiorcy'] );
$akt_malzenstwa = htmlspecialchars ( $_POST ['akt_malzenstwa'] );

$dodaj_umowa_bankowa = sprawa_dodaj_lub_aktualizuj_umowa_bankowa_1 ( $id_umowy_bankowej, $nazwa_banku, $numer_umowy, $umowa, $pelnomocnictwo, $dowod, $wniosek, $umowa_z_bankiem, $regulamin, $tabela, $harmonogram, $potwierdzenie, $decyzja, $oplaty, $dowod_wspolkredytobiorcy, $akt_malzenstwa );
$dodaj_umowe_bankowa_id = $dodaj_umowa_bankowa ['id_umowy_bankowej'];

$dane = array (
		0 => $id_sprawy,
		1 => $id_umowy_bankowej 
);

echo json_encode ( $dane );