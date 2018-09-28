<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

    
    $roszczenia_od_ub = htmlspecialchars($_POST['roszczenia_od_ub']);
    $roszczenia_od_prac = htmlspecialchars($_POST['roszczenia_od_prac']);

    $id_sprawy = htmlspecialchars($_POST['id_sprawy']);
    $id_zdarzenia = htmlspecialchars($_POST['id_zdarzenia']);

    $aktualizuj_sprawe_roszczenia_ub = sprawa_aktualizacja ('roszczenia_od_ubezp_ufg', $roszczenia_od_ub, $id_sprawy); 
    $aktualizuj_sprawe_roszczenia_ub = mysqli_fetch_assoc ( $aktualizuj_sprawe_roszczenia_ub );
    
    $aktualizuj_sprawe_roszczenia_prac = sprawa_aktualizacja ('roszczenia_od_prac', $roszczenia_od_prac, $id_sprawy); 
    $aktualizuj_sprawe_roszczenia_prac = mysqli_fetch_assoc ( $aktualizuj_sprawe_roszczenia_prac );

    
    
    sprawa_aktualizuj_ostatnia_strone($id_sprawy, '6');
    
$dane = array(
		0 => $id_sprawy,
        1 => $id_zdarzenia
);

echo json_encode($dane);
