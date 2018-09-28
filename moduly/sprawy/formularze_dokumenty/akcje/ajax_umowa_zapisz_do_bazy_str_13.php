<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');


    $id_sprawy = htmlspecialchars($_POST['id_sprawy']);
    $id_zdarzenia = htmlspecialchars($_POST['id_zdarzenia']);
    $id_uprawnionego = htmlspecialchars($_POST['id_uprawnionego']);
    $id_poszkodowanego = htmlspecialchars($_POST['id_poszkodowanego']);
    $id_klienta = htmlspecialchars($_POST['id_klienta']);
    $umowa = htmlspecialchars($_POST['umowa']);
    $prowizja = htmlspecialchars($_POST['prowizja']);

    $jaka_umowa = sprawa_dodaj_umowe($umowa, $prowizja);
    $umowa_id = $jaka_umowa['id'];

    $klient = sprawa_pobierz_dane_klienta_dla_uzytkownika($id_klienta);
   
    $aktualizuj_umowe_do_sprawy = sprawa_aktualizacja ('sprawa_umowa_id', $umowa_id, $id_sprawy); 
    $aktualizuj_umowe_do_sprawy = mysqli_fetch_assoc ( $aktualizuj_umowe_do_sprawy );

    sprawa_aktualizuj_ostatnia_strone($id_sprawy, '13');
    
$dane = array(
        0 => $id_sprawy,
        1 => $umowa_id,
		2 => $id_uprawnionego,
        3 => $id_poszkodowanego,
        4 => $klient['imie'],
        5 => $klient['nazwisko'],
        6 => $klient['ulica'],
        7 => $klient['nr_domu'],
        8 => $klient['nr_mieszkania'],
        9 => $klient['kod_pocztowy'],
        10 => $klient['miasto'],


);

echo json_encode($dane);