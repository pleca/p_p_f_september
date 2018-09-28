<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$sprawa_sytuacja_majatkowa = htmlspecialchars($_POST['sprawa_sytuacja_majatkowa']);
$sprawa_motywacja = htmlspecialchars($_POST['sprawa_motywacja']);
//$sprawa_porady = htmlspecialchars($_POST['sprawa_porady']);
$sprawa_pozostawiona_rodzina = htmlspecialchars($_POST['sprawa_pozostawiona_rodzina']);
$sprawa_stan_psychiczny = htmlspecialchars($_POST['sprawa_stan_psychiczny']);
$sprawa_stan_zdrowia = htmlspecialchars($_POST['sprawa_stan_zdrowia']);
$liczba_dzieci = htmlspecialchars($_POST['liczba_dzieci']);
$wiek_dzieci = htmlspecialchars($_POST['wiek_dzieci']);
$id_porady = htmlspecialchars($_POST['id_porady']);
$czy_zostal_malzonek = htmlspecialchars ( $_POST ['malzonek'] );

$sprawa_porady_1 = htmlspecialchars($_POST['sprawa_porady_1']);
$sprawa_porady_2 = htmlspecialchars($_POST['sprawa_porady_2']);
$sprawa_porady_3 = htmlspecialchars($_POST['sprawa_porady_3']);
$sprawa_porady_4 = htmlspecialchars($_POST['sprawa_porady_4']);
$sprawa_porady_5 = htmlspecialchars($_POST['sprawa_porady_5']);
$sprawa_porady_6 = htmlspecialchars($_POST['sprawa_porady_6']);

$dodaj_porady = sprawa_dodaj_lub_aktualizuj_porady ( $id_porady, $sprawa_porady_1, $sprawa_porady_2, $sprawa_porady_3, $sprawa_porady_4, $sprawa_porady_5, $sprawa_porady_6 );
$dodaj_porady = mysqli_fetch_assoc ( $dodaj_porady );

sprawa_aktualizuj_strona_11_4(
		$sprawa_id
		,$sprawa_sytuacja_majatkowa
		,$sprawa_motywacja
		,$id_porady
		,$sprawa_pozostawiona_rodzina
		,$sprawa_stan_psychiczny
		,$sprawa_stan_zdrowia
		,$liczba_dzieci
		,$wiek_dzieci
        ,$czy_zostal_malzonek
);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '11');