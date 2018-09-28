<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'wzory_dokumentow/db/funkcje_db.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$uzytkownik_id = htmlspecialchars ( $_POST ['uzytkownik_id'] );
$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$id_umowy = htmlspecialchars ( $_POST ['id_umowy'] );

$umowa = sprawa_pobierz_dane_umowy ( $id_umowy );
$umowa = $umowa ['nazwa'];

$sprawa = sprawa_pobierz_dane_sprawy ( $id_sprawy );

if ($umowa == 'maxima') {
	$adres_http_umowy_1a = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_maxima/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_maxima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
	$adres_http_umowy_1b = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_maxima/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_maxima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
	$adres_http_umowy_1c = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_maxima/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_maxima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=1&zestaw=0' );
} else if ($umowa == 'optima') {
	
	$adres_http_umowy_1a = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_optima/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_optima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
	$adres_http_umowy_1b = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_optima/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_optima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
	$adres_http_umowy_1c = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_optima/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_optima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=1&zestaw=0' );
} else if ($umowa == 'promedica') {
	
	$adres_http_umowy_1a = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_promedica/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_promedica?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
	$adres_http_umowy_1b = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_promedica/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_promedica?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
	$adres_http_umowy_1c = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_promedica/umowa_o_dochodzenie_roszczen_z_obsluga_procesowa_promedica?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=1&zestaw=0' );
} else if ($umowa == 'Usługi bankowe') {

    $adres_http_umowy_1a = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_z_bankiem/umowa_o_dochodzenie_roszczen_z_umow_bankowych?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
    $adres_http_umowy_1b = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_z_bankiem/umowa_o_dochodzenie_roszczen_z_umow_bankowych?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
    $adres_http_umowy_1c = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_z_bankiem/umowa_o_dochodzenie_roszczen_z_umow_bankowych?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=1&zestaw=0' );

} else if ($umowa == 'prima') {

    $adres_http_umowy_1a = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_prima/umowa_prima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
    $adres_http_umowy_1b = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_prima/umowa_prima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=0' );
    $adres_http_umowy_1c = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_prima/umowa_prima?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=1&zestaw=0' );
}

$adres_http_umowy_2 = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/zgloszenie_szkody/druk_zgloszenia_szkody?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=0&zestaw=1' );
$adres_http_umowy_2a = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/zgloszenie_szkody/druk_zgloszenia_szkody?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy . '&potwierdzenie=1&zestaw=1' );
;
$adres_http_umowy_3 = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/deklaracje/deklaracja_przedstawiciela?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy );
$adres_http_umowy_4 = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/pelnomocnictwa/pelnomocnictwo_kairp?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy );
$adres_http_umowy_5 = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/pelnomocnictwa/pelnomocnictwo_votum?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy );
$adres_http_umowy_6 = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/pouczenia/pouczenie_o_prawie_do_odstapienia_od_umowy?id_sprawy=' . $id_sprawy . '&uzytkownik_id=' . $uzytkownik_id . '&id_umowy=' . $id_umowy );
$adres_http_umowy_7 = file_get_contents ( 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/umowa_z_bankiem/pelnomocnictwo_bankowe?id_sprawy=' . $id_sprawy );

if ($sprawa ['sprawa_typ_szkody_id'] != 3) {
	$pliki = array (
			$adres_http_umowy_1a,
			$adres_http_umowy_1b,
			$adres_http_umowy_1c,
			$adres_http_umowy_2,
			$adres_http_umowy_2a,
			$adres_http_umowy_3,
			$adres_http_umowy_4,
			$adres_http_umowy_5,
			$adres_http_umowy_6 
	);
}
if ($sprawa ['sprawa_typ_szkody_id'] == 3) {
	$pliki = array (
			$adres_http_umowy_1a,
			$adres_http_umowy_1b,
			$adres_http_umowy_1c,
        	$adres_http_umowy_7,
			$adres_http_umowy_3,
			$adres_http_umowy_6 
	);
}

echo join ( " ", $pliki );

?>
