<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

    $sygnatura_akt = htmlspecialchars($_POST['sygnatura_akt']);
    $oswiadczenie = htmlspecialchars($_POST['oswiadczenie']);
    $czy_wezwano_policje = htmlspecialchars($_POST['czy_wezwano_policje']);
    $czy_wszczeto_postepowanie = htmlspecialchars($_POST['czy_wszczeto_postepowanie']);
    $skad_policja = htmlspecialchars($_POST['skad_policja']);
    $czy_postawiono_zarzut = htmlspecialchars($_POST['czy_postawiono_zarzut']);
    $art_dla_sprawcy = htmlspecialchars($_POST['art_dla_sprawcy']);
    $czy_umorzono = htmlspecialchars($_POST['czy_umorzono']);
    $art_dla_umorzenia = htmlspecialchars($_POST['art_dla_umorzenia']);
    $czy_skierowano_do_sadu = htmlspecialchars($_POST['czy_skierowano_do_sadu']);
    $nazwa_sadu = htmlspecialchars($_POST['nazwa_sadu']);
    $czy_zapadl_wyrok = htmlspecialchars($_POST['czy_zapadl_wyrok']);
    $wyrok_skazujacy = htmlspecialchars($_POST['wyrok_skazujacy']);
    $wyrok_uniewinniajacy = htmlspecialchars($_POST['wyrok_uniewinniajacy']);
    $wyrok_z_art = htmlspecialchars($_POST['wyrok_z_art']);

    $id_sprawy = htmlspecialchars($_POST['id_sprawy']);
    $id_zdarzenia = htmlspecialchars($_POST['id_zdarzenia']);
    

    $uzupelnic_odpowiedzialnosc_karna = sprawa_dodaj_odpowiedzialnosc_karna($sygnatura_akt, $oswiadczenie, $czy_wezwano_policje, $skad_policja, $czy_wszczeto_postepowanie, $czy_postawiono_zarzut, $art_dla_sprawcy, $czy_umorzono, $art_dla_umorzenia, $czy_skierowano_do_sadu, $nazwa_sadu, $czy_zapadl_wyrok, $wyrok_skazujacy, $wyrok_uniewinniajacy, $wyrok_z_art); 
    $uzupelnic_odpowiedzialnosc_karna = mysqli_fetch_assoc ( $uzupelnic_odpowiedzialnosc_karna );

    $id_odpowiedzialnosc_karna = $uzupelnic_odpowiedzialnosc_karna['id'];

    $aktualizuj_sprawe_odp_karna = sprawa_aktualizacja ('odpowiedzialnosc_karna_id', $id_odpowiedzialnosc_karna, $id_sprawy); 
    $aktualizuj_sprawe_odp_karna = mysqli_fetch_assoc ( $aktualizuj_sprawe_odp_karna );
    
    sprawa_aktualizuj_ostatnia_strone($id_sprawy, '7');
    
$dane = array(
		0 => $id_sprawy,
        1 => $id_zdarzenia, 
);

echo json_encode($dane);
