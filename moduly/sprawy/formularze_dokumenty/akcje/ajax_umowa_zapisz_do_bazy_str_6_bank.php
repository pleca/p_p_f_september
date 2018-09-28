<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$czy_zlecono = htmlspecialchars ( $_POST ['czy_zlecono'] );
$komu_zlecono = htmlspecialchars ( $_POST ['nazwa_pelnomocnika'] );
$kiedy_zlecono = htmlspecialchars ( $_POST ['data_zlecenia'] );
$czy_wypowiedziano = htmlspecialchars ( $_POST ['czy_wypowiedziano'] );
$kiedy_wypowiedziano = htmlspecialchars ( $_POST ['data_wypowiedzenia'] );

$inf_sms = htmlspecialchars ( $_POST ['sms'] );
$inf_email = htmlspecialchars ( $_POST ['email'] );

$id_sprawy = htmlspecialchars ( $_POST ['id_sprawy'] );
$uzytkownik = $_SESSION ['uzytkownik_id'];

$informacje_sms = sprawa_aktualizacja ( 'zgoda_na_inf_sms', $inf_sms, $id_sprawy );

$aktualizuj_informacje_sms = mysqli_fetch_assoc ( $informacje_sms );

$informacje_email = sprawa_aktualizacja ( 'zgoda_na_inf_email', $inf_email, $id_sprawy );

$aktualizuj_informacje_email = mysqli_fetch_assoc ( $informacje_email );

$uzupelnic_dochodzenie_roszczen = sprawa_dodaj_dochodzenie_roszczen ( $czy_zlecono, $komu_zlecono, $kiedy_zlecono, $czy_wypowiedziano, $kiedy_wypowiedziano, '' );
$uzupelnic_dochodzenie_roszczen = mysqli_fetch_assoc ( $uzupelnic_dochodzenie_roszczen );

$id_dochodzenie_roszczen = $uzupelnic_dochodzenie_roszczen ['id'];

$aktualizuj_sprawe_roszczenia = sprawa_aktualizacja ( 'sprawa_dochodzenie_roszczen_id', $id_dochodzenie_roszczen, $id_sprawy );
$aktualizuj_sprawe_roszczenia = mysqli_fetch_assoc ( $aktualizuj_sprawe_roszczenia );

$dane = array (
		0 => $id_sprawy 
);

echo json_encode ( $dane );
