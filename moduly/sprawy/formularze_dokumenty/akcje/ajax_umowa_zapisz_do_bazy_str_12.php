<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');


    $id_sprawy = htmlspecialchars($_POST['id_sprawy']);
    $id_zdarzenia = htmlspecialchars($_POST['id_zdarzenia']);
    $id_uprawnionego = htmlspecialchars($_POST['id_uprawnionego']);
    $id_poszkodowanego = htmlspecialchars($_POST['id_poszkodowanego']);

    $tresc_oswiadczenia = htmlspecialchars($_POST['tresc_oswiadczenia']);
    $miejscowosc = htmlspecialchars($_POST['miejscowosc_generowania']);
    $data = htmlspecialchars($_POST['data']);
    $imie_nazwisko = htmlspecialchars($_POST['imie_nazwisko']);
    $adres = htmlspecialchars($_POST['adres']);

    /*PO CO TO DODAŁES??!!!!*/
/*    $uprawniony = sprawa_pobierz_dane_klienta_dla_uzytkownika($id_uprawnionego);
    $imie_nazwisko_uprawnionego = $uprawniony['imie'].' '.$uprawniony['nazwisko']; */

    $dodaj_oswiadczenie = sprawa_dodaj_oswiadczenie($tresc_oswiadczenia, $miejscowosc, $data, $imie_nazwisko, $adres); 
    $dodaj_oswiadczenie = mysqli_fetch_assoc ( $dodaj_oswiadczenie );
    $id_oswiadczenia = $dodaj_oswiadczenie['id'];
   
    $aktualizuj_sprawe_oswiadczenie = sprawa_aktualizacja ('sprawa_oswiadczenie_id', $id_oswiadczenia, $id_sprawy); 
    $aktualizuj_sprawe_oswiadczenie = mysqli_fetch_assoc ( $aktualizuj_sprawe_oswiadczenie );

    sprawa_aktualizuj_ostatnia_strone($id_sprawy, '12');
    
$dane = array(
        0 => $id_sprawy,
        1 => $id_zdarzenia,
		2 => $id_uprawnionego,
        3 => $id_poszkodowanego,
        4 => $tresc_oswiadczenia

);

echo json_encode($dane);