<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$sprawa_id = htmlspecialchars($_POST['sprawa_id']);
$czy_zlecono = htmlspecialchars($_POST['dochodzenie_roszczen_czy_zlecono']);
$komu_zlecono = htmlspecialchars($_POST['dochodzenie_roszczen_komu_zlecono']);
$kiedy_zlecono = htmlspecialchars($_POST['dochodzenie_roszczen_kiedy_zlecono']);
$czy_wypowiedziano = htmlspecialchars($_POST['dochodzenie_roszczen_czy_wypowiedziano']);
$kiedy_wypowiedziano = htmlspecialchars($_POST['dochodzenie_roszczen_kiedy_wypowiedziano']);
/* medyk 12-09-2016 */
$inf_sms = htmlspecialchars($_POST['dochodzenie_roszczen_inf_sms']);
$inf_email = htmlspecialchars($_POST['dochodzenie_roszczen_inf_email']);
$ile_kart = htmlspecialchars($_POST['dochodzenie_roszczen_ile_kart']);
//

$dochodzenie_roszczen = sprawa_aktualizuj_dochodzenie_roszczen(
			$sprawa_id
			,$czy_zlecono
			,$komu_zlecono
			,$kiedy_zlecono
			,$czy_wypowiedziano
			,$kiedy_wypowiedziano
            ,$ile_kart
		);
/* medyk 12-09-2016 */
$informacje_sms = sprawa_aktualizacja(
        'zgoda_na_inf_sms'
        ,$inf_sms
        ,$sprawa_id
    );

$informacje_email = sprawa_aktualizacja(
        'zgoda_na_inf_email'
        ,$inf_email
        ,$sprawa_id
    );
//
sprawa_aktualizuj_ostatnia_strone($sprawa_id, '9');

echo $dochodzenie_roszczen['dochodzenie_roszen_id'];