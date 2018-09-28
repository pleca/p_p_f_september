<?php
#print_r($_FILES);

//$target_path = "/var/www/pliki/!moje_sprawy/";
//$target_path_temp = "/var/www/pliki/!moje_sprawy/temp/";

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
    session_start ();
    session_destroy ();
    header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
    die ();
}

session_start ();

//require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/moje_sprawy/db/funkcje_db.php');

$id_sprawy = htmlspecialchars($_POST['id_sprawy']);


if(!empty($_FILES['file']))
{

    if (! file_exists ( '/var/www/pliki/!moje_sprawy/' . $id_sprawy )) {
        mkdir ( '/var/www/pliki/!moje_sprawy/' . $id_sprawy, 0777 );
    }
/*    if (! file_exists ( '/var/www/pliki/!moje_sprawy/' . $id_sprawy . '/temp' )) {
        mkdir ( '/var/www/pliki/!moje_sprawy/' . $id_sprawy . '/temp', 0777 );
    }*/

    //$path_temp = "/var/www/pliki/!moje_sprawy/" . $id_sprawy . "temp/";
    $path_ok = "/var/www/pliki/!moje_sprawy/". $id_sprawy. "/";


    $count = 0;
    foreach ($_FILES['file']['name'] as $key => $name) {
        $count++;
    }

    //$path = $path_ok.basename($_FILES["file"]["name"]);

    foreach ($_FILES['file']['name'] as $key => $name) {


        $path = $path_ok.basename($_FILES["file"]["name"][$key]);

        if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $path)) {
            //$file [] = basename($_FILES["file"]["name"][$key]);
            //echo json_encode($file);
            echo $_FILES['file']['name'][$key] . " -> OK\n\r";
        } else {
            echo $_FILES['file']['name'][$key] . "-> Upload error\n\r";
        }

    }


    /*foreach ($_FILES['file']['name'] as $key => $name) {

        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            $file [] = basename($_FILES["file"]["name"]);

            echo json_encode($file);
        } else {
            echo 'BLAD';
        }

    }*/
}

/*
$del_array = array();

$count = 0;
foreach ($_FILES['file']['name'] as $key => $name) {
    $count++;
}

if ($count > 1) {

    $zipfilename = md5(uniqid());
    $zip = new ZipArchive();
    if ($zip->open($target_path . $zipfilename.'.zip', ZIPARCHIVE::CREATE) != TRUE) {
        echo "Błąd: Zip create error";
    }

    foreach ($_FILES['file']['name'] as $key => $name) {

        $ext = explode('.', basename($_FILES['file']['name'][$key]));
        $ext = $ext[1];
        $filename = md5(uniqid());
        $finalname = $target_path_temp . $filename . '.' . $ext;

        if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $finalname)) {
            echo $_FILES['file']['name'][$key] . " -> OK\n\r";
            $zip->addFile($finalname, $filename . '.' . $ext);
            array_push($del_array, $finalname);
        } else {
            echo $_FILES['file']['name'][$key] . "-> Upload error\n\r";
        }

    }

    $zip->close();

    $count = count($del_array);
    for ($i = 0; $i < $count; $i++) {
        unlink ($del_array[$i]);
    }


} else {

    $ext = explode('.', basename($_FILES['file']['name'][$key]));
    $ext = $ext[1];
    $filename = md5(uniqid());
    $finalname = $target_path . $filename . '.' . $ext;

    if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $finalname)) {
        echo $_FILES['file']['name'][$key] . " -> OK\n\r";
    } else {
        echo $_FILES['file']['name'][$key] . "-> Upload error\n\r";
    }

}*/


