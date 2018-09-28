<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');
if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
	session_start ();
	session_destroy ();
	header ( 'Location: http://' . $_SERVER ['HTTP_HOST'] );
	die ();
}

$id_sprawy = $_GET ['id_sprawy'];
$umowa = $_GET ['umowa'];
$potwierdzenie = $_GET ['potwierdzenie'];
$pouczenie_o_odstapieniu_od_umowy = $_GET ['pouczenie_o_odstapieniu_od_umowy'];
$pelnomocnictwo_votum = $_GET ['pelnomocnictwo_votum'];
$pelnomocnictwo_bankowe_votum = $_GET ['pelnomocnictwo_bankowe_votum'];
$pelnomocnictwo_kairp = $_GET ['pelnomocnictwo_kairp'];

$id_miesiaca = $_GET ['id_miesiaca'];
$typ_prowizji = $_GET ['typ_prowizji'];
$uzytkownik = $_SESSION ['uzytkownik_id'];

$deklaracja_przedstawiciela = $_GET ['deklaracja_przedstawiciela'];

$drukuj_wszystko = $_GET ['drukuj_wszystko'];

if (isset ( $uzytkownik ) && isset ( $id_miesiaca ) && isset ( $typ_prowizji )) {
    header ( "Content-type: application/pdf" );
    header ( "Content-Disposition: inline; filename=$uzytkownik.'/'.$id_miesiaca.'_'.$typ_prowizji-prowizje.pdf" );
    readfile ( '/var/www/pliki/!prowizje/'.$uzytkownik.'/'.$id_miesiaca.'_'.$typ_prowizji.'_prowizje.pdf' );
    return false;
}


if (isset ( $id_sprawy ) && $deklaracja_przedstawiciela == '1') {
	header ( "Content-type: application/pdf" );
	header ( "Content-Disposition: inline; filename=$id_sprawy-deklaracja_przedstawiciela.pdf" );
	readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_deklaracja_przedstawiciela.pdf' );
	return false;
}

if (isset ( $id_sprawy ) && $drukuj_wszystko == '1') {
	header ( "Content-type: application/pdf" );
	header ( "Content-Disposition: inline; filename=$id_sprawy-drukuj_wszystko.pdf" );
	readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_drukuj_wszystko.pdf' );
	return false;
}

if (isset ( $id_sprawy ) && $pelnomocnictwo_votum == '1') {
	header ( "Content-type: application/pdf" );
	header ( "Content-Disposition: inline; filename=$id_sprawy-pelnomocnictwo_votum.pdf" );
	readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_pelnomocnictwo_votum.pdf' );
	return false;
}
if (isset ( $id_sprawy ) && $pelnomocnictwo_bankowe_votum == '1') {
    header ( "Content-type: application/pdf" );
    header ( "Content-Disposition: inline; filename=$id_sprawy-pelnomocnictwo_bankowe_votum.pdf" );
    readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_pelnomocnictwo_bankowe_votum.pdf' );
    return false;
}

if (isset ( $id_sprawy ) && $pelnomocnictwo_kairp == '1') {
	header ( "Content-type: application/pdf" );
	header ( "Content-Disposition: inline; filename=$id_sprawy-pelnomocnictwo_kairp.pdf" );
	readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_pelnomocnictwo_kairp.pdf' );
	return false;
}

if (isset ( $id_sprawy ) && $pouczenie_o_odstapieniu_od_umowy == '1') {
	header ( "Content-type: application/pdf" );
	header ( "Content-Disposition: inline; filename=$id_sprawy-pouczenie.pdf" );
	readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_pouczenie_o_prawie_odstapienia_od_umowy.pdf' );
	return false;
}

if (isset ( $id_sprawy ) && $umowa == '0') {
	header ( "Content-type: application/pdf" );
	header ( "Content-Disposition: inline; filename=druk_zgloszenia_szkody_$id_sprawy.pdf" );
	if ($potwierdzenie == '1') {
		readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_potwierdzenie_druk_zgloszenia_szkody.pdf' );
	} else {
		readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_druk_zgloszenia_szkody.pdf' );
	}
	
	return false;
}

if (isset ( $id_sprawy ) && $umowa == '1') {
	header ( "Content-type: application/pdf" );
	header ( "Content-Disposition: inline; filename=druk_umowy_$id_sprawy.pdf" );
	if ($potwierdzenie == '1') {
		readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_potwierdzenie_umowa.pdf' );
	} else {
		readfile ( '/var/www/pliki/!sprawy/' . $id_sprawy . '/' . $id_sprawy . '_umowa.pdf' );
	}
	return false;
}



