<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$element_id = (isset($_POST['element_id'])) ? explode('-', $_POST['element_id']) : '';
$grupa_sms = (isset($_POST['sms_grupa'])) ? htmlspecialchars($_POST['sms_grupa']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$telefon = (isset($_POST['telefon'])) ? htmlspecialchars($_POST['telefon']) : '';
$wyslijSms = new DrukiMain();

$grupa_sms = $bazaDanych->pobierzDane('id','dane_systemowe_sms_grupy','nazwa_uproszczona = \''.$grupa_sms.'\'');
$grupa_sms = $grupa_sms->fetch_object();
$tresc = $bazaDanych->pobierzDane('sms_tresc, aktywny','dane_systemowe_sms','sms_grupa_id = \''.$grupa_sms->id.'\'');
$tresc = $tresc->fetch_object();

$UmowaUprawniony = $bazaDanych->pobierzDane('UmowaRodzajUprawnionegoId, OsobaUprawnionyId', 'umowa' . mb_ucfirst($droga), 'Id=' . $element_id[2]);
$UmowaUprawniony = $UmowaUprawniony->fetch_object();

if(($UmowaUprawniony->UmowaRodzajUprawnionegoId != 0)&&($UmowaUprawniony->UmowaRodzajUprawnionegoId != 4)){
    $umowa_osoba_uprawniona_tmp = $bazaDanych->pobierzDane('KontaktId','umowaOsoba','Id = '.$UmowaUprawniony->OsobaUprawnionyId);
    $umowa_osoba_uprawniona_tmp = $umowa_osoba_uprawniona_tmp->fetch_object();
    $telefon = $bazaDanych->pobierzDane('Telefon', 'umowaKontakt', 'Id = '.$umowa_osoba_uprawniona_tmp->KontaktId);
    $telefon = $telefon->fetch_object();
    $telefon = $telefon->Telefon;
}

$umowa_osoba_tmp = $bazaDanych->pobierzDane('Imie, Nazwisko, Pesel, KontaktId', 'umowaOsoba', 'Id = ' . $element_id[1]);

if ($umowa_osoba_tmp) {
    $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_array();
}

$wiadomosc = str_replace('*Imie/*',$umowa_osoba_tmp['Imie'],$tresc->sms_tresc);
$wiadomosc = str_replace('*Nazwisko/*',$umowa_osoba_tmp['Nazwisko'],$wiadomosc);

if(substr($umowa_osoba_tmp['Pesel'], 9,1)%2 == 0) {
    $wiadomosc = str_replace('*Plec/*', 'Pani', $wiadomosc);
}else{
    $wiadomosc = str_replace('*Plec/*','Pan',$wiadomosc);
}

if($tresc->aktywny == 1) {
    $rezultat = $wyslijSms->wyslijSMS($telefon, $wiadomosc);
};

$dane = array(
    'result' => 'ok'
);

echo 'ok';
return;