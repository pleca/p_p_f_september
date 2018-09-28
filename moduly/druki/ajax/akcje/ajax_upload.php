<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

#print_r($_FILES);
$target_path = "/var/www/pliki/!druki_pliki/";
#$target_path_temp = "/var/www/pliki/!druki/temp/";

$del_array = array();
$umid = intval($_REQUEST["umid"]);
$umid1 = intval($_REQUEST["umid1"]);
$umid2 = intval($_REQUEST["umid2"]);
$response = $umid.'-'.$umid1.'-'.$umid2;
$slownik_id = intval($_REQUEST["slownik"]);

$count = 0;
foreach ($_FILES['file']['name'] as $key => $name) {
    $count++;
}

if ($count > 1) {

    foreach ($_FILES['file']['name'] as $key => $name) {

        $ext = explode('.', basename($_FILES['file']['name'][$key]));
        $ext = $ext[1];
        $filename = md5(uniqid());
        $finalname = $target_path_temp . $filename . '.' . $ext;

        if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $finalname)) {
            echo $response;
   #         $zip->addFile($finalname, $filename . '.' . $ext);
            array_push($del_array, $finalname);
            $new_umid = $bazaDanych->wstawDane('dokumenty_pliki', array(
              'slownik_id' => $slownik_id
            , 'nazwa_pliku' => $_FILES['file']['name'][$key]
            , 'nazwa_dokumentu' => $filename
            , 'typ_pliku' => $ext
            , 'tworca_id' => 0
            , 'data_utworzenia' => 'NOW()'
            , 'czy_delete' => 0
            , 'opis' => ''
            ));
            $new_link = $bazaDanych->wstawDane('dokumenty_pliki_umowa_link', array(
              'pliki_id' => $new_umid
            , 'umowa_id' => $umid
            ));
        } else {
            echo $_FILES['file']['name'][$key] . "-> Upload error\n\r";
        }

    }

} else {

    $ext = explode('.', basename($_FILES['file']['name'][$key]));
    $ext = $ext[1];
    $filename = md5(uniqid());
    $finalname = $target_path . $filename . '.' . $ext;

    if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $finalname)) {
        echo $response;
        $new_umid = $bazaDanych->wstawDane('dokumenty_pliki', array(
            'slownik_id' => $slownik_id
        , 'nazwa_pliku' => $_FILES['file']['name'][$key]
        , 'nazwa_dokumentu' => $filename
        , 'typ_pliku' => $ext
        , 'tworca_id' => 0
        , 'data_utworzenia' => 'NOW()'
        , 'czy_delete' => 0
        , 'opis' => ''
        ));
        $new_link = $bazaDanych->wstawDane('dokumenty_pliki_umowa_link', array(
            'pliki_id' => $new_umid
        , 'umowa_id' => $umid
        ));
    } else {
        echo $_FILES['file']['name'][$key] . "-> Upload error\n\r";
    }

}


?>