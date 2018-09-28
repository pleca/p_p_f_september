<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$nr_szkody = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_nr_szkody']);
$zgl_szkode_w_poj = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_zgl_szkode_w_poj']);
$data_zgl_w_poj = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_data_zgl_w_poj']);
$zgl_szkode_na_os = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_zgl_szkode_na_os']);
$data_zgl_na_os = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_data_zgl_na_os']);
$co_z_oc = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_co_z_oc']);
$kwota = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_kwota']);
$podstawa = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_podstawa']);
$data_decyzji = htmlspecialchars($_POST['odpowiedzialnosc_cywilna_data_decyzji']);

$odpowiedzialnosc_cywilna = sprawa_aktualizuj_odpowiedzialnosc_cywilna(
			$sprawa_id
			,$nr_szkody
			,$zgl_szkode_w_poj
			,$data_zgl_w_poj
			,$zgl_szkode_na_os
			,$data_zgl_na_os
			,$co_z_oc
			,$kwota
			,$podstawa
			,$data_decyzji
		);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '8');

echo $odpowiedzialnosc_cywilna['odpowiedzialnosc_cywilna_id'];