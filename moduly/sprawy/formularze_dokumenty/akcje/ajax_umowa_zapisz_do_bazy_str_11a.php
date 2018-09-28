<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$id_zdarzenia = htmlspecialchars ( $_POST ['id_zdarzenia'] );
$id_uprawnionego = htmlspecialchars ( $_POST ['id_uprawnionego'] );
$id_poszkodowanego = htmlspecialchars ( $_POST ['id_poszkodowanego'] );

$sytuacja_mat = htmlspecialchars ( $_POST ['sytuacja_mat'] );
$krzywda = htmlspecialchars ( $_POST ['krzywda'] );
$wiek_zmarlego = htmlspecialchars ( $_POST ['wiek_zmarlego'] );
$wyk_zmarlego = htmlspecialchars ( $_POST ['wyk_zmarlego'] );
$zaw_zm_wyuczony = htmlspecialchars ( $_POST ['zaw_zm_wyuczony'] );
$zaw_zm_wykonywany = htmlspecialchars ( $_POST ['zaw_zm_wykonywany'] );
$zaw_zm_dodatkowe = htmlspecialchars ( $_POST ['zaw_zm_dodatkowe'] );
$zatrudnienie_zm_inne_rodzaj = htmlspecialchars ( $_POST ['zatrudnienie_zm_inne_rodzaj'] );
$zatrudnienie_zmar = htmlspecialchars ( $_POST ['zatrudnienie_zmar'] );
$wynagrodzenie_zm = htmlspecialchars ( $_POST ['wynagrodzenie_zm'] );

$wiek_uprawnionego = htmlspecialchars ( $_POST ['wiek_uprawnionego'] );
$wyk_uprawnionego = htmlspecialchars ( $_POST ['wyk_uprawnionego'] );
$zaw_up_wyuczony = htmlspecialchars ( $_POST ['zaw_up_wyuczony'] );
$zaw_up_wykonywany = htmlspecialchars ( $_POST ['zaw_up_wykonywany'] );
$zaw_up_dodatkowe = htmlspecialchars ( $_POST ['zaw_up_dodatkowe'] );
$zatrudnienie_up_inne_rodzaj = htmlspecialchars ( $_POST ['zatrudnienie_up_inne_rodzaj'] );
$zatrudnienie_upr = htmlspecialchars ( $_POST ['zatrudnienie_upr'] );
$wynagrodzenie_up = htmlspecialchars ( $_POST ['wynagrodzenie_up'] );

$pokrewienstwo = htmlspecialchars ( $_POST ['relacje'] );
$pokrewienstwo_tekst = htmlspecialchars ( $_POST ['inne_pokrewienstwo_tekst'] );
$stosunki_mieszkaniowe = htmlspecialchars ( $_POST ['zameldowanie'] );
$pomoc = htmlspecialchars ( $_POST ['czy_pomagal'] );
$stosunki_uprawnionego = htmlspecialchars ( $_POST ['stosunki_ze_zmarlym'] );
$utrzymanie = htmlspecialchars ( $_POST ['zmarly_utrzymanie'] );
$sytuacja_majatkowa = htmlspecialchars ( $_POST ['sytuacja_materialna'] );
$motywacja = htmlspecialchars ( $_POST ['motywacja'] );

$stan_psychiczny = htmlspecialchars ( $_POST ['odczucia'] );
$stan_zdrowia = htmlspecialchars ( $_POST ['$stan_zdrowia'] );

$porady = htmlspecialchars ( $_POST ['wsparcie'] );
$pozostawiona_rodzina = htmlspecialchars ( $_POST ['pozostawil'] );
$liczba_dzieci = htmlspecialchars ( $_POST ['liczba_dzieci'] );
$wiek_dzieci = htmlspecialchars ( $_POST ['wiek_dzieci'] );
$czy_zostal_malzonek = htmlspecialchars ( $_POST ['malzonek'] );

$moje_utrzymanie = htmlspecialchars ( $_POST ['moje_utrzymanie'] );
$lozyl_na_utrzymanie = htmlspecialchars ( $_POST ['lozyl_na_utrzymanie'] );
$wspolne_konto = htmlspecialchars ( $_POST ['wspolne_konto'] );
$partycypowal_koszty = htmlspecialchars ( $_POST ['partycypowal_koszty'] );
$wspieral_finansowo = htmlspecialchars ( $_POST ['wspieral_finansowo'] );

$wspolne_gospodarstwo_dom = htmlspecialchars ( $_POST ['wspolne_gospodarstwo_dom'] );
$taki_sam_adres_zam = htmlspecialchars ( $_POST ['taki_sam_adres_zam'] );
$inny_adres_zam = htmlspecialchars ( $_POST ['inny_adres_zam'] );

$wsp_psychiatry = htmlspecialchars ( $_POST ['wsp_psychiatry'] );
$wsp_psychologa = htmlspecialchars ( $_POST ['wsp_psychologa'] );
$wsp_pedagoga = htmlspecialchars ( $_POST ['wsp_pedagoga'] );
$wsp_lekarza = htmlspecialchars ( $_POST ['wsp_lekarza'] );
$wsp_duchownego = htmlspecialchars ( $_POST ['wsp_duchownego'] );
$wsp_rodziny = htmlspecialchars ( $_POST ['wsp_rodziny'] );

$dodaj_utrzymanie = sprawa_dodaj_lub_aktualizuj_utrzymanie ( '', $moje_utrzymanie, $lozyl_na_utrzymanie, $wspolne_konto, $partycypowal_koszty, $wspieral_finansowo );
$dodaj_utrzymanie = mysqli_fetch_assoc ( $dodaj_utrzymanie );
$utrzymanie_id = $dodaj_utrzymanie ['id_utrzymania'];

$dodaj_stosunki_mieszkaniowe = sprawa_dodaj_lub_aktualizuj_stosunki_mieszkaniowe ( '', $wspolne_gospodarstwo_dom, $taki_sam_adres_zam, $inny_adres_zam );
$dodaj_stosunki_mieszkaniowe = mysqli_fetch_assoc ( $dodaj_stosunki_mieszkaniowe );
$stosunki_mieszkaniowe_id = $dodaj_stosunki_mieszkaniowe ['id_stos_miesz'];

$dodaj_porady = sprawa_dodaj_lub_aktualizuj_porady ( '', $wsp_psychiatry, $wsp_psychologa, $wsp_pedagoga, $wsp_lekarza, $wsp_duchownego, $wsp_rodziny );
$dodaj_porady = mysqli_fetch_assoc ( $dodaj_porady );
$porady_id = $dodaj_porady ['id_porady'];

$aktualizacja_uprawnionego = sprawa_aktualizuj_osobe ( $id_uprawnionego, $wyk_uprawnionego, $zatrudnienie_upr, $zatrudnienie_up_inne_rodzaj, $zaw_up_wyuczony, $zaw_up_wykonywany, $zaw_up_dodatkowe, $wynagrodzenie_up, $wiek_uprawnionego );
$aktualizacja_uprawnionego = mysqli_fetch_assoc ( $aktualizacja_uprawnionego );

$aktualizacja_poszkodowanego = sprawa_aktualizuj_osobe ( $id_poszkodowanego, $wyk_zmarlego, $zatrudnienie_zmar, $zatrudnienie_zm_inne_rodzaj, $zaw_zm_wyuczony, $zaw_zm_wykonywany, $zaw_zm_dodatkowe, $wynagrodzenie_zm, $wiek_zmarlego );
$aktualizacja_poszkodowanego = mysqli_fetch_assoc ( $aktualizacja_poszkodowanego );

$stosunki_rodzinne = sprawa_dodaj_stosunki_rodzinne ( $pokrewienstwo, $pokrewienstwo_tekst, $stosunki_mieszkaniowe_id, $pomoc, $stosunki_uprawnionego, $utrzymanie_id );
$stosunki_rodzinne = mysqli_fetch_assoc ( $stosunki_rodzinne );
$stosunki_rodzinne_id = $stosunki_rodzinne ['id'];

$sytuacja_rodziny = sprawa_dodaj_sytuacja_rodziny ( $sytuacja_majatkowa, $motywacja, $porady_id, $pozostawiona_rodzina, $stan_psychiczny, $stan_zdrowia, $liczba_dzieci, $wiek_dzieci, $czy_zostal_malzonek );
$sytuacja_rodziny = mysqli_fetch_assoc ( $sytuacja_rodziny );
$sytuacja_rodziny_id = $sytuacja_rodziny ['id'];

$aktualizuj_sprawe_stosunki_rodzinne = sprawa_aktualizacja ( 'sprawa_stosunki_rodzinne_id', $stosunki_rodzinne_id, $id_sprawy );
$aktualizuj_sprawe_stosunki_rodzinne = mysqli_fetch_assoc ( $aktualizuj_sprawe_stosunki_rodzinne );

$aktualizuj_sprawe_sytuacja_rodziny = sprawa_aktualizacja ( 'sprawa_sytuacja_rodziny_id', $sytuacja_rodziny_id, $id_sprawy );
$aktualizuj_sprawe_sytuacja_rodziny = mysqli_fetch_assoc ( $aktualizuj_sprawe_sytuacja_rodziny );

$aktualizuj_pogorszenie_sytuacji = sprawa_aktualizacja ( 'pogorszenie_sytuacji', $sytuacja_mat, $id_sprawy );
$aktualizuj_pogorszenie_sytuacji = mysqli_fetch_assoc ( $aktualizuj_pogorszenie_sytuacji );

$aktualizuj_wystapienie_krzywdy = sprawa_aktualizacja ( 'wystapienie_krzywdy', $krzywda, $id_sprawy );
$aktualizuj_wystapienie_krzywdy = mysqli_fetch_assoc ( $aktualizuj_wystapienie_krzywdy );

sprawa_aktualizuj_ostatnia_strone ( $id_sprawy, '11' );

$dane = array (
		0 => $id_sprawy,
		1 => $id_zdarzenia,
		2 => $id_uprawnionego,
		3 => $id_poszkodowanego,
        4 => $czy_zostal_malzonek
);

echo json_encode ( $dane );