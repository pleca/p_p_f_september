<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');


$sprawa_id = htmlspecialchars($_POST['id_sprawy']);
$pod_wplywem = htmlspecialchars($_POST['stan']);
$uzywki_id = htmlspecialchars($_POST['po_czym']);
$w_pojezdzie = htmlspecialchars($_POST['czy_w_pojezdzie']);
$rola = htmlspecialchars($_POST['kim_byl']);
$typ_pojazdu = htmlspecialchars($_POST['typ_pojazdu']);
$typ_pojazdu_inny = htmlspecialchars($_POST['inny_typ_pojazdu']);
$pozycja = htmlspecialchars($_POST['pozycja']);
$pozycja_inna = htmlspecialchars($_POST['inne_miejsce']);
$pasy = htmlspecialchars($_POST['pasy']);
$wspolwlasnosc = htmlspecialchars($_POST['wspolwlasciciel']);
$wiedza_o_stanie_kierowcy = htmlspecialchars($_POST['spozycie']);
$wiedza_o_upr_kierowcy = htmlspecialchars($_POST['prawko']);



sprawa_dodaj_lub_aktualizuj_strona_11_a_1(
		$sprawa_id
		,$pod_wplywem
		,$uzywki_id
		,$w_pojezdzie
		,$rola
		,$typ_pojazdu
        ,$typ_pojazdu_inny
		,''
		,$pozycja
		,$pozycja_inna
		,$pasy
        ,$wspolwlasnosc
		,$wiedza_o_stanie_kierowcy
		,$wiedza_o_upr_kierowcy
);



$stan_leczenia = htmlspecialchars($_POST['stan_leczenia']);
$lecz_data_zakonczenia = htmlspecialchars($_POST['lecz_data_zakonczenia']);
$lecz_data_planowany = htmlspecialchars($_POST['lecz_data_planowany']);
$od_kiedy_l4 = htmlspecialchars($_POST['od_kiedy_l4']);
$do_kiedy_l4 = htmlspecialchars($_POST['do_kiedy_l4']);

sprawa_dodaj_lub_aktualizuj_strona_11_a_2(
		$sprawa_id
		,$stan_leczenia
		,$lecz_data_zakonczenia
		,$lecz_data_planowany
		,$od_kiedy_l4
		,$do_kiedy_l4
);

$szpital = htmlspecialchars($_POST['szpital']);
$przychodnia = htmlspecialchars($_POST['przychodnia']);
$przychodnia_data = htmlspecialchars($_POST['przychodnia_data']);

$przebieg_leczenia = sprawa_dodaj_lub_aktualizuj_strona_11_a_3(
		$sprawa_id
		,$szpital
		,$przychodnia
		,$przychodnia_data
);

/*$miejsce_hospitalizacji = htmlspecialchars($_POST['miejsce_hospitalizacji']);
$hospitalizacja_data = htmlspecialchars($_POST['hospitalizacja_data']);

sprawa_dodaj_lub_aktualizuj_hospitalizacja(
        $id_hospitalizacji
        ,$przebieg_leczenia['sprawa_przebieg_leczenia_id']
		,$miejsce_hospitalizacji
		,$hospitalizacja_data
);

$miejsce_zabiegow = htmlspecialchars($_POST['miejsce_zabiegow']);
$zabiegi_data = htmlspecialchars($_POST['zabiegi_data']);

sprawa_dodaj_lub_aktualizuj_placowki(
        $id_placowki
        ,$przebieg_leczenia['sprawa_przebieg_leczenia_id']
		,$miejsce_zabiegow
		,$zabiegi_data
);*/
$id_leczenia = $przebieg_leczenia['sprawa_przebieg_leczenia_id'];

$dane = array(
		0 => $id_leczenia, 
        1 => $sprawa_id 
);

echo json_encode($dane);

sprawa_aktualizuj_ostatnia_strone($sprawa_id, '11');