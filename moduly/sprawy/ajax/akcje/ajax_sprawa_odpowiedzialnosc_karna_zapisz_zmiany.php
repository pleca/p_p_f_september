<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$sygnatura_akt = htmlspecialchars($_POST['odpowiedzialnosc_karna_sygnatura_akt']);
$oswiadczenie = htmlspecialchars($_POST['odpowiedzialnosc_karna_oswiadczenie']);
$wezwano_policje = htmlspecialchars($_POST['odpowiedzialnosc_karna_wezwano_policje']);
$skad_policja = htmlspecialchars($_POST['odpowiedzialnosc_karna_skad_policja']);
$wszczeto_postepowanie = htmlspecialchars($_POST['odpowiedzialnosc_karna_wszczeto_postepowanie']);
$zarzut = htmlspecialchars($_POST['odpowiedzialnosc_karna_zarzut']);
$zarzut_z_art = htmlspecialchars($_POST['odpowiedzialnosc_karna_zarzut_z_art']);
$umorzono = htmlspecialchars($_POST['odpowiedzialnosc_karna_umorzono']);
$umorz_na_podst = htmlspecialchars($_POST['odpowiedzialnosc_karna_umorz_na_podst']);
$do_sadu = htmlspecialchars($_POST['odpowiedzialnosc_karna_do_sadu']);
$nazwa_sadu = htmlspecialchars($_POST['odpowiedzialnosc_karna_nazwa_sadu']);
$czy_wyrok = htmlspecialchars($_POST['odpowiedzialnosc_karna_czy_wyrok']);
$skazujacy = htmlspecialchars($_POST['odpowiedzialnosc_karna_skazujacy']);
$uniewinniajacy = htmlspecialchars($_POST['odpowiedzialnosc_karna_uniewinniajacy']);
$wyrok_z_art = htmlspecialchars($_POST['odpowiedzialnosc_karna_wyrok_z_art']);

$odpowiedzialnosc_karna = sprawa_aktualizuj_odpowiedzialnosc_karna(
		$sprawa_id
		,$sygnatura_akt
		,$oswiadczenie
		,$wezwano_policje
		,$skad_policja
		,$wszczeto_postepowanie
		,$zarzut
		,$zarzut_z_art
		,$umorzono
		,$umorz_na_podst
		,$do_sadu
		,$nazwa_sadu
		,$czy_wyrok
		,$skazujacy
		,$uniewinniajacy
		,$wyrok_z_art
);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '7');

echo $odpowiedzialnosc_karna['odpowiedzialnosc_karna_id'];