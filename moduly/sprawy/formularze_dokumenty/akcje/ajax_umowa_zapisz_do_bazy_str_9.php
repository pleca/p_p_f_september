<?php

require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

    $czy_zlecono = htmlspecialchars($_POST['czy_zlecono']);
    $komu_zlecono = htmlspecialchars($_POST['komu_zlecono']);
    $kiedy_zlecono = htmlspecialchars($_POST['kiedy_zlecono']);
    $czy_wypowiedziano = htmlspecialchars($_POST['czy_wypowiedziano']);
    $kiedy_wypowiedziano = htmlspecialchars($_POST['kiedy_wypowiedziano']);

    /* medyk 12-09-2016 */
    $inf_sms = htmlspecialchars($_POST['inf_sms']);
    $inf_email = htmlspecialchars($_POST['inf_email']);
    $ile_kart = htmlspecialchars($_POST['ile_kart']);
    //

    $id_sprawy = htmlspecialchars($_POST['id_sprawy']);
    $id_zdarzenia = htmlspecialchars($_POST['id_zdarzenia']);
    
    /* medyk 12-09-2016 */
    $informacje_sms = sprawa_aktualizacja(
            'zgoda_na_inf_sms'
            ,$inf_sms
            ,$id_sprawy
        );
    $aktualizuj_informacje_sms = mysqli_fetch_assoc ( $informacje_sms );

    $informacje_email = sprawa_aktualizacja(
            'zgoda_na_inf_email'
            ,$inf_email
            ,$id_sprawy
        );
    $aktualizuj_informacje_email = mysqli_fetch_assoc ( $informacje_email );
    //

    $uzupelnic_dochodzenie_roszczen = sprawa_dodaj_dochodzenie_roszczen($czy_zlecono, $komu_zlecono, $kiedy_zlecono, $czy_wypowiedziano, $kiedy_wypowiedziano, $ile_kart); 
    $uzupelnic_dochodzenie_roszczen = mysqli_fetch_assoc ( $uzupelnic_dochodzenie_roszczen );

    $id_dochodzenie_roszczen = $uzupelnic_dochodzenie_roszczen['id'];

    $aktualizuj_sprawe_roszczenia = sprawa_aktualizacja ('sprawa_dochodzenie_roszczen_id', $id_dochodzenie_roszczen, $id_sprawy); 
    $aktualizuj_sprawe_roszczenia = mysqli_fetch_assoc ( $aktualizuj_sprawe_roszczenia );
    
    sprawa_aktualizuj_ostatnia_strone($id_sprawy, '9');
    
$dane = array(
		0 => $id_sprawy,
        1 => $id_zdarzenia, 
);

echo json_encode($dane);
