<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

    $oc_nr_szkody = htmlspecialchars($_POST['oc_nr_szkody']);
    $zgl_szkode_w_poj = htmlspecialchars($_POST['zgl_szkode_w_poj']);
    $data_zgloszenia_w_poj = htmlspecialchars($_POST['data_zgloszenia_w_poj']);
    $zgl_szkode_na_os = htmlspecialchars($_POST['zgl_szkode_na_os']);
    $data_zgloszenia_na_os = htmlspecialchars($_POST['data_zgloszenia_na_os']);
    $odszkodowanie = htmlspecialchars($_POST['odszkodowanie']);
    $wyplaconoa_kwota = htmlspecialchars($_POST['wyplaconoa_kwota']);
    $podstawa = htmlspecialchars($_POST['podstawa']);
    $data_uwd = htmlspecialchars($_POST['data_uwd']);
   
    $id_sprawy = htmlspecialchars($_POST['id_sprawy']);
    $id_zdarzenia = htmlspecialchars($_POST['id_zdarzenia']);
    

    $uzupelnic_odpowiedzialnosc_cywilna = sprawa_dodaj_odpowiedzialnosc_cywilna($oc_nr_szkody, $zgl_szkode_w_poj, $data_zgloszenia_w_poj, $zgl_szkode_na_os, $data_zgloszenia_na_os, $odszkodowanie, $wyplaconoa_kwota, $podstawa, $data_uwd); 
    $uzupelnic_odpowiedzialnosc_cywilna = mysqli_fetch_assoc ( $uzupelnic_odpowiedzialnosc_cywilna );

    $id_odpowiedzialnosc_cywilna = $uzupelnic_odpowiedzialnosc_cywilna['id'];

    $aktualizuj_sprawe_odp_cywilna = sprawa_aktualizacja ('odpowiedzialnosc_cywilna_id', $id_odpowiedzialnosc_cywilna, $id_sprawy); 
    $aktualizuj_sprawe_odp_cywilna = mysqli_fetch_assoc ( $aktualizuj_sprawe_odp_cywilna );
    
    sprawa_aktualizuj_ostatnia_strone($id_sprawy, '8');
    
$dane = array(
		0 => $id_sprawy,
        1 => $id_zdarzenia, 
);

echo json_encode($dane);
