<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');


    $id_sprawy = htmlspecialchars($_POST['id_sprawy']);
    $id_umowy = htmlspecialchars($_POST['id_umowy']);
    $id_uprawnionego = htmlspecialchars($_POST['id_uprawnionego']);
    $id_poszkodowanego = htmlspecialchars($_POST['id_poszkodowanego']);
    $id_klienta = htmlspecialchars($_POST['id_klienta']);

    $forma_platnosci = htmlspecialchars($_POST['forma_platnosci']);
    $odbiorca = htmlspecialchars($_POST['odbiorca']);
    $rachunek_bankowy = htmlspecialchars($_POST['rachunek_bankowy']);

    $imie_przelew = htmlspecialchars($_POST['imie_przelew']);
    $nazwisko_przelew = htmlspecialchars($_POST['nazwisko_przelew']);
    $ulica_przelew = htmlspecialchars($_POST['ulica_przelew']);
    $dom_przelew = htmlspecialchars($_POST['dom_przelew']);
    $mieszkanie_przelew = htmlspecialchars($_POST['mieszkanie_przelew']);
    $kod_przelew = htmlspecialchars($_POST['kod_przelew']);
    $miejscowosc_przelew = htmlspecialchars($_POST['miejscowosc_przelew']);

    $imie_przekaz = htmlspecialchars($_POST['imie_przekaz']);
    $nazwisko_przekaz = htmlspecialchars($_POST['nazwisko_przekaz']);
    $ulica_przekaz = htmlspecialchars($_POST['ulica_przekaz']);
    $dom_przekaz = htmlspecialchars($_POST['dom_przekaz']);
    $mieszkanie_przekaz = htmlspecialchars($_POST['mieszkanie_przekaz']);
    $kod_przekaz = htmlspecialchars($_POST['kod_przekaz']);
    $miejscowosc_przekaz = htmlspecialchars($_POST['miejscowosc_przekaz']);

if ($forma_platnosci == 'przelew') {
    
    if($odbiorca == '1') {
        $dodaj_rachunek = sprawa_dodaj_rachunek($id_klienta, $rachunek_bankowy);
        $dodaj_rachunek = mysqli_fetch_assoc ( $dodaj_rachunek );
        
        $osoba_do_wyplaty = $id_klienta;
        $platnosc = sprawa_platnosc_uposazony($id_umowy, $forma_platnosci, $osoba_do_wyplaty);
        
        $platnosc = mysqli_fetch_assoc ( $platnosc );
    } else {
        $dodaj_adres = sprawa_dodaj_adres($ulica_przelew, $dom_przelew, $mieszkanie_przelew, $kod_przelew, $miejscowosc_przelew);
        $dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
        
        $dodaj_osobe = sprawa_dodaj_osobe ($imie_przelew, $nazwisko_przelew, '', '', $dodaj_adres['adres_id'], $dodaj_adres['adres_id'], '', '', '', '', '', ''); 
        $dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
        
        $dodaj_rachunek = sprawa_dodaj_rachunek($dodaj_osobe['osoba_id'], $rachunek_bankowy);
        $dodaj_rachunek = mysqli_fetch_assoc ( $dodaj_rachunek );
        
        $platnosc = sprawa_platnosc_uposazony($id_umowy, $forma_platnosci, $dodaj_osobe['osoba_id']);
        $platnosc = mysqli_fetch_assoc ( $platnosc );
    }
    
} else if ($forma_platnosci == 'przekaz') {
    
    if($odbiorca == '1') {
  
        $osoba_do_wyplaty = $id_klienta;
        $platnosc = sprawa_platnosc_uposazony($id_umowy, $forma_platnosci, $osoba_do_wyplaty);
        $platnosc = mysqli_fetch_assoc ( $platnosc );
    } else {
        $dodaj_adres = sprawa_dodaj_adres($ulica_przekaz, $dom_przekaz, $mieszkanie_przekaz, $kod_przekaz, $miejscowosc_przekaz);
        $dodaj_adres = mysqli_fetch_assoc ( $dodaj_adres );
        
        $dodaj_osobe = sprawa_dodaj_osobe ($imie_przekaz, $nazwisko_przekaz, '', '', $dodaj_adres['adres_id'], $dodaj_adres['adres_id'], '', '', '', '', '', ''); 
        $dodaj_osobe = mysqli_fetch_assoc ( $dodaj_osobe );
        
        $platnosc = sprawa_platnosc_uposazony($id_umowy, $forma_platnosci, $dodaj_osobe['osoba_id']);
        $platnosc = mysqli_fetch_assoc ( $platnosc );
    }
    
}

sprawa_aktualizuj_ostatnia_strone($id_sprawy, '14');

$dane = array(
        0 => $id_sprawy,
        1 => $id_zdarzenia,
		2 => $id_uprawnionego,
        3 => $id_poszkodowanego,
        4 => $rachunek_bankowy

);

echo json_encode($dane);