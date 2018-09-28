<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');


$mailing_tresc = $_POST['mailing_tresc'];
//$mailing_tresc_bez_formatowania = $_POST['mailing_tresc'];
$mailing_obrazki = $_POST['mailing_obrazki'];
$mailing_zalaczniki = $_POST['mailing_zalaczniki'];

$temat_maila = $_POST['mailing_temat'];

$odbiorca = $_POST['mailing_odbiorca'];

$nazwa_nadawcy = '';

$nazwa_odbiorcy = $_POST['mailing_adresat_imie_nazwisko'];

$nadawca_email = $_POST['mailing_adresat_email'];

$priorytet = $_POST['priorytet'];

$licza_maili_jako_do_wiadomosci = $_POST['licza_maili_jako_do_wiadomosci'];
$mailing_odbiorcy_do_wiadomosci = $_POST['mailing_odbiorcy_do_wiadomosci'];

for($i=0;$i<count($mailing_obrazki);$i++){

    $mailing_nazwa = explode('/',$mailing_obrazki[$i]['src']);
    $mailing_nazwa = end($mailing_nazwa);
    $mailing_nazwa = explode('.',$mailing_nazwa);
    $mailing_nazwa = $mailing_nazwa[0];
    $mailing_tresc = str_replace('<img style="'.$mailing_obrazki[$i]['style'].'" src="'.$mailing_obrazki[$i]['src'].'" alt="" height="'.$mailing_obrazki[$i]['height'].'" width="'.$mailing_obrazki[$i]['width'].'">','<img src="cid:'.$mailing_nazwa.'" height="'.$mailing_obrazki[$i]['height'].'" width="'.$mailing_obrazki[$i]['width'].'" style="'.$mailing_obrazki[$i]['style'].'" />',$mailing_tresc);
    $mailing_tresc = str_replace('<img src="'.$mailing_obrazki[$i]['src'].'" alt="" height="'.$mailing_obrazki[$i]['height'].'" width="'.$mailing_obrazki[$i]['width'].'">','<img src="cid:'.$mailing_nazwa.'" height="'.$mailing_obrazki[$i]['height'].'" width="'.$mailing_obrazki[$i]['width'].'" style="" />',$mailing_tresc);
    $mailing_tresc = str_replace('<img style="" src="'.$mailing_obrazki[$i]['src'].'" alt="" width="'.$mailing_obrazki[$i]['width'].'" height="'.$mailing_obrazki[$i]['height'].'">','<img src="cid:'.$mailing_nazwa.'" height="'.$mailing_obrazki[$i]['height'].'" width="'.$mailing_obrazki[$i]['width'].'" style="" />',$mailing_tresc);
    $mailing_tresc = str_replace('<img src="'.$mailing_obrazki[$i]['src'].'" alt="" width="'.$mailing_obrazki[$i]['width'].'" height="'.$mailing_obrazki[$i]['height'].'">','<img src="cid:'.$mailing_nazwa.'" height="'.$mailing_obrazki[$i]['height'].'" width="'.$mailing_obrazki[$i]['width'].'" style="" />',$mailing_tresc);
    $mailing_tresc = str_replace('<img src="'.$mailing_obrazki[$i]['src'].'" alt="" style="" width="'.$mailing_obrazki[$i]['width'].'" height="'.$mailing_obrazki[$i]['height'].'">','<img src="cid:'.$mailing_nazwa.'" height="'.$mailing_obrazki[$i]['height'].'" width="'.$mailing_obrazki[$i]['width'].'" style="" />',$mailing_tresc);

}

//tymczasowa doczytanie klasy PHPMailer
require_once($_SERVER ['DOCUMENT_ROOT'].'/biblioteki/PHPMailer/class.phpmailer.php');

//sprawdzenie pol przed wysylka maila
if($odbiorca == ''){
    return false;

}

$czy_zawiera = strpos($temat_maila, "PODCAST");


if ($czy_zawiera === false) {
    $mailing_tresc = str_replace('<br></font>', '&nbsp;</font>', $mailing_tresc);

    $mailing_tresc = str_replace('<table>', '<p><table>', $mailing_tresc);
    $mailing_tresc = str_replace('</table>', '</table></p>', $mailing_tresc);

    $mailing_tresc = str_replace('<div class="podpis_w_tresci">', '', $mailing_tresc);
    $mailing_tresc = str_replace('<div class="podpis_w_tresci_end"></div></div>', '', $mailing_tresc);

    $mailing_tresc = str_replace('<blockquote><p>', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
    $mailing_tresc = str_replace('<blockquote><p align="left">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
    $mailing_tresc = str_replace('<blockquote><p align="right">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
    $mailing_tresc = str_replace('<blockquote><p align="justify">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
    $mailing_tresc = str_replace('</blockquote></p>', '</blockquote></span></td></tr>', $mailing_tresc);

    $mailing_tresc = str_replace('<div', '<p style="margin: 0px 0px 0px 0px; font-family: Calibri; " ', $mailing_tresc);
    $mailing_tresc = str_replace('</div>', '</p>', $mailing_tresc);
    $mailing_tresc = str_replace('<br>', '<br></br>', $mailing_tresc);
    $mailing_tresc = str_replace('<p><br></br></p>', '<p>&nbsp;</p>', $mailing_tresc);
    $mailing_tresc = str_replace('<br></br></', '</', $mailing_tresc);
    $mailing_tresc = str_replace('<br></br></p>', '</p>', $mailing_tresc);
    $mailing_tresc = str_replace('<br></br>', '<p>&nbsp;</p>', $mailing_tresc);

    $mailing_tresc = str_replace('<p', '<p style="margin: 0px 0px 0px 0px; font-family: Calibri; " ', $mailing_tresc);
    $mailing_tresc = str_replace('<p', '<tr style="min-height:10px;"><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><div', $mailing_tresc);
    $mailing_tresc = str_replace('</p>', '</div></td></tr>', $mailing_tresc);

    $mailing_tresc = str_replace('<ul', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><ul style="margin: 0px  0px  16px  30px; padding-left:30px"', $mailing_tresc);
    $mailing_tresc = str_replace('</ul>', '</ul></td></tr>', $mailing_tresc);
    $mailing_tresc = str_replace('<br/><ul', '<ul', $mailing_tresc);


    $mailing_tresc = str_replace('<ol', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><ol style="margin: 0px  0px  16px  30px; padding-left:30px"', $mailing_tresc);
    $mailing_tresc = str_replace('</ol>', '</ol></td></tr>', $mailing_tresc);
    $mailing_tresc = str_replace('<br/><ol', '<ol', $mailing_tresc);


    $mailing_tresc = str_replace('style="margin:0cm;margin-bottom:.0001pt"', '', $mailing_tresc);

    $mailing_tresc = str_replace('align="justify"', 'style="text-align:justify;" align="justify"', $mailing_tresc);
    $mailing_tresc = str_replace('align="center"', 'style="text-align:center;" align="center"', $mailing_tresc);
    $mailing_tresc = str_replace('align="left"', 'style="text-align:left;" align="left"', $mailing_tresc);
    $mailing_tresc = str_replace('align="right"', 'style="text-align:right;" align="right"', $mailing_tresc);

    $naglowek = '<table width="793px" cellpadding="10" style=" font-family: Calibri; width:793px; " ><tbody border="0"  valign="midle" width="793px">';

    $stopka = '</tbody></table>';
}



$mailing_tresc = $naglowek.$mailing_tresc.$stopka;

//$mailing_tresc_bez_formatowania = $naglowek.$mailing_tresc_bez_formatowania.$stopka;


//$mailing_tresc = str_replace('Calibri', 'Carlito" ', $mailing_tresc);

$tresc_maila = $mailing_tresc;
//$tresc_maila = $mailing_tresc_bez_formatowania;

//wysylanie maila
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = MAILING_SMTP_HOST;
//$mail->SMTPDebug  = 2;
//$mail->SMTPAuth = SMTP_AUTH;
//$mail->Username = SMTP_USER;
//$mail->Password = SMTP_PASSWORD;
//$mail->SMTPSecure = SMTP_SECURE;
$mail->Port = MAILING_SMTP_PORT;
$mail->CharSet = SMTP_CHARSET;
$mail->IsHTML(SMTP_HTML);
$mail->From = $nadawca_email;
$mail->FromName = $nazwa_odbiorcy;

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->AddAddress ($odbiorca);
//$mail->AddAddress ($nadawca_email);

if(count($mailing_zalaczniki) != 0){
    for($j=0;$j<count($mailing_zalaczniki);$j++){
        $mail->AddAttachment($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/tmp/'.$mailing_zalaczniki[$j]['src']);
    }
}



$mail->IsHTML(true);
$mail->Subject = $temat_maila;

$mail->Body    = $tresc_maila;

for($i=0;$i<count($mailing_obrazki);$i++){

    $mailing_nazwa = explode('/',$mailing_obrazki[$i]['src']);
    $mailing_nazwa = end($mailing_nazwa);
    $mailing_nazwa = explode('.',$mailing_nazwa);
    $mailing_nazwa = $mailing_nazwa[0];

    $mail->AddEmbeddedImage($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/tmp/'.$mailing_nazwa.'.jpg', $mailing_nazwa, $mailing_nazwa.'.jpg');
}

$mail->Priority = $priorytet;

if($licza_maili_jako_do_wiadomosci != 0){
    for($j=0;$j<$licza_maili_jako_do_wiadomosci;$j++){
        $mail->AddCC($mailing_odbiorcy_do_wiadomosci[$j]['email']);

    }
}


if(!$mail->Send())
{
    //echo "Nie udało się wysłać maila. <p>";
    //echo "Błąd: " . $mail->ErrorInfo;
    $dane = array(
        0 => '0',
        1 => $_POST['numer_index'],
        2 => $mail->ErrorInfo
    );
    echo json_encode($dane);
    return;

}



$dane = array(
    0 => '1',
    1 => $_POST['numer_index'],
    2 => count($mailing_zalaczniki)
);

echo json_encode($dane);

