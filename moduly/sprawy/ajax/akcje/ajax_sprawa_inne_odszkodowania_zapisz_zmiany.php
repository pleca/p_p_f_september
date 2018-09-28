<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars ( $_POST ['sprawa_id'] );
$zgloszono_nnw = htmlspecialchars ( $_POST ['inne_odszkodowania_zgloszono_nnw'] );
$komu_zgloszono = htmlspecialchars ( $_POST ['inne_odszkodowania_komu_zgloszono'] );
$jaki_wypadek = htmlspecialchars ( $_POST ['inne_odszkodowania_jaki_wypadek'] );
$gdzie_zgloszono = htmlspecialchars ( $_POST ['inne_odszkodowania_gdzie_zgloszono'] );
$inne_tekst = htmlspecialchars ( $_POST ['inne_odszkodowania_inne_tekst'] );
$zasilek_pogrzebowy = htmlspecialchars ( $_POST ['inne_odszkodowania_zasilek_pogrzebowy'] );
$oferta_finansowa = htmlspecialchars ( $_POST ['inne_odszkodowania_oferta_finansowa'] );
$gamma = htmlspecialchars ( $_POST ['inne_odszkodowania_gamma'] );
$dzialalnosc = htmlspecialchars ( $_POST ['inne_odszkodowania_dzialalnosc'] );
$pcrf = htmlspecialchars ( $_POST ['inne_odszkodowania_pcrf'] );
$fundacja = htmlspecialchars ( $_POST ['inne_odszkodowania_fundacja'] );

$uszczerbek_nnw = htmlspecialchars ( $_POST ['inne_odszkodowania_uszczerbek_nnw'] );
$procent_nnw = htmlspecialchars ( $_POST ['inne_odszkodowania_uszczerbek_procent_nnw'] );
$ubezp_procent_uszczerbku = htmlspecialchars ( $_POST ['inne_odszkodowania_ubezp_procent_uszczerbku'] );
$jednorazowe_odszkodowanie = htmlspecialchars ( $_POST ['inne_odszkodowania_jednorazowe_odszkodowanie'] );
$kwota_odszkodowania = htmlspecialchars ( $_POST ['inne_odszkodowania_kwota_odszkodowania'] );
$zwolnienie = htmlspecialchars ( $_POST ['inne_odszkodowania_zwolnienie'] );
$zwolnienie_od = htmlspecialchars ( $_POST ['inne_odszkodowania_zwolnienie_od'] );
$zwolnienie_do = htmlspecialchars ( $_POST ['inne_odszkodowania_zwolnienie_do'] );
$orzeczenie = htmlspecialchars ( $_POST ['inne_odszkodowania_orzeczenie'] );
$orzeczenie_id = htmlspecialchars ( $_POST ['inne_odszkodowania_orzeczenie_id'] );
$orzeczenie_do = htmlspecialchars ( $_POST ['inne_odszkodowania_orzeczenie_do'] );
$ubezpieczyciel_id = htmlspecialchars ( $_POST ['inne_odszkodowania_ubezpieczyciel_id'] );
$inne_nazwa = htmlspecialchars ( $_POST ['inne_odszkodowania_inne_nazwa'] );
$swiadczenie_id = htmlspecialchars ( $_POST ['inne_odszkodowania_swiadczenie_id'] );
$swiadczenie_inne_nazwa = htmlspecialchars ( $_POST ['inne_odszkodowania_swiadczenie_inne_nazwa'] );
$kwota_swiadczenia = htmlspecialchars ( $_POST ['inne_odszkodowania_kwota_swiadczenia'] );
$data_swiadczenia = htmlspecialchars ( $_POST ['inne_odszkodowania_data_swiadczenia'] );

$sprawa = sprawa_pobierz_dane_sprawy ( $sprawa_id );

$id_inne_odszkodowania = $sprawa ['sprawa_inne_odszkodowania_id'];

if ($id_inne_odszkodowania == NULL) {
	
	$inne_odszkodowania = sprawa_dodaj_lub_aktualizuj_inne_odszkodowania ( '0', $zgloszono_nnw, $komu_zgloszono, $jaki_wypadek, $ubezpieczenie, $inne_tekst, $zasilek_pogrzebowy, $oferta_finansowa, $gamma, $dzialalnosc, $pcrf, $fundacja, $uszczerbek_nnw, $procent_nnw, $ubezp_procent_uszczerbku, $jednorazowe_odszkodowanie, $kwota_odszkodowania, $zwolnienie, $zwolnienie_od, $zwolnienie_do, $orzeczenie, $orzeczenie_id, $orzeczenie_do, $ubezpieczyciel_id, $inne_nazwa, $swiadczenie_id, $swiadczenie_inne_nazwa, $kwota_swiadczenia, $data_swiadczenia );
	$id_inne_odszkodowania = $inne_odszkodowania ['id_inne_odszkodowania'];
	
	$aktualizuj_sprawe_odszkodowania = sprawa_aktualizacja ( 'sprawa_inne_odszkodowania_id', $id_inne_odszkodowania, $sprawa_id );
	$aktualizuj_sprawe_odszkodowania = mysqli_fetch_assoc ( $aktualizuj_sprawe_odszkodowania );
} else {
	$inne_odszkodowania = sprawa_dodaj_lub_aktualizuj_inne_odszkodowania ( $id_inne_odszkodowania, $zgloszono_nnw, $komu_zgloszono, $jaki_wypadek, $ubezpieczenie, $inne_tekst, $zasilek_pogrzebowy, $oferta_finansowa, $gamma, $dzialalnosc, $pcrf, $fundacja, $uszczerbek_nnw, $procent_nnw, $ubezp_procent_uszczerbku, $jednorazowe_odszkodowanie, $kwota_odszkodowania, $zwolnienie, $zwolnienie_od, $zwolnienie_do, $orzeczenie, $orzeczenie_id, $orzeczenie_do, $ubezpieczyciel_id, $inne_nazwa, $swiadczenie_id, $swiadczenie_inne_nazwa, $kwota_swiadczenia, $data_swiadczenia );
	$id_inne_odszkodowania = $inne_odszkodowania ['id_inne_odszkodowania'];
}

sprawa_aktualizuj_ostatnia_strone ( $sprawa_id, '10' );

echo $id_inne_odszkodowania;