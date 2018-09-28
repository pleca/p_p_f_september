<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

    $drukiaMain = new DrukiMain();

    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '' ;
    $nazwa_druku = (isset($_POST['nazwa_druku'])) ? htmlspecialchars($_POST['nazwa_druku']) : '' ;
    $nazwa_pliku = (isset($_POST['nazwa_pliku'])) ? htmlspecialchars($_POST['nazwa_pliku']) : '' ;

//    $grupa_sms = (isset($_POST['sms_grupa'])) ? htmlspecialchars($_POST['sms_grupa']) : '';
//    $telefon = (isset($_POST['telefon'])) ? htmlspecialchars($_POST['telefon']) : '';
//
//    $wyslijSms = new DrukiMain();
//    $grupa_sms_id = $bazaDanych->pobierzDane('id','dane_systemowe_sms_grupy','nazwa_uproszczona = \''.$grupa_sms.'\'');
//    $tresc = $bazaDanych->pobierzDane('sms_tresc','dane_systemowe_sms','sms_grupa_id = 1');
//    $rezultat = $this->wyslijSMS($telefon, $tresc);

    $element_id = explode('-',$element_id);
    //$element_id[0] - umowa
    //$element_id[1] - glowny klient
    //$element_id[2] - umowa typ

    $listaZalacznikow = $bazaDanych->pobierzDane('ZalacznikPlikNazwa','umowaZalacznik','UmowaId = '.$element_id[0]);

    $listaZalacznikow_array = array();

    if(!is_null($listaZalacznikow)){
        while($plik = $listaZalacznikow->fetch_object()){
            array_push($listaZalacznikow_array,$plik->ZalacznikPlikNazwa);
        }
    }



$rezultat = true;
$komunikat = 'Wiadomość została wysłana!!!';

require_once($_SERVER ['DOCUMENT_ROOT'] . '/biblioteki/PHPMailer/class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = SMTP_HOST;
$mail->SMTPAuth = SMTP_AUTH;
$mail->Username = SMTP_USER;
$mail->Password = SMTP_PASSWORD;
$mail->SMTPSecure = SMTP_SECURE;
$mail->Port = SMTP_PORT;
$mail->CharSet = SMTP_CHARSET;
$mail->From = 'automat@votum-sa.pl';
$mail->FromName = 'Panel przedstawiciela';
$mail->AddAddress('panel-druki@votum-sa.pl');
$mail->IsHTML(SMTP_HTML);
$mail->Subject = '[PANEL PRZEDSTAWICIELA - DRUKI] KOPIA UMOWY';
$mail->Body = $drukiaMain->wczytajWidok('/var/www/html/moduly/druki/ajax/widoki/elementy/wyslij_kopie_do_centrali_email.php',array(
    'agentDane' => $bazaDanych->pobierzDane('login, imie, nazwisko, email, telefon_kom', 'uzytkownik', 'id = '.$_SESSION['uzytkownik_id'])
    ,'klientDane' => $bazaDanych->pobierzDane('imie, nazwisko', 'umowaOsoba', 'id = '.$element_id[1])
    ,'umowaDroga' => $droga
));;

$mail->AddStringAttachment(file_get_contents('/var/www/pliki/!druki/'.$element_id[0].'/'.$nazwa_pliku.'.pdf'),$nazwa_pliku.'.pdf', $encoding = 'base64', $type = 'application/pdf');

foreach($listaZalacznikow_array as $plik){
    $nazwa_tmp = explode('.',$_GET['nazwa']);

    if(end($nazwa_tmp) != 'pdf'){
        $type1 = 'image/jpeg';
    }else{
        $type1 = 'application/pdf';
    }

    $mail->AddStringAttachment(file_get_contents('/var/www/pliki/!druki/'.$element_id[0].'/'.$plik),$plik, $encoding = 'base64', $type = $type1);
}

if (!$mail->Send()) {
    $rezultat = false;
    $komunikat = $mail->ErrorInfo;
}

$dane = array(
    'rezultat' => $rezultat,
    'komunikat' => $komunikat
);

echo json_encode($dane);
return;
