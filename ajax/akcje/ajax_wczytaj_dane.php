<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    session_start();
    session_destroy();
    header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
    die();
}

require_once($_SERVER ['DOCUMENT_ROOT'] . '/konfiguracja/autoload.php');

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$dane = (isset($_POST['dane'])) ? $_POST['dane'] : '';
$avatarKlasa = (isset($_POST['avatarKlasa'])) ? $_POST['avatarKlasa'] : '';

$rodzaj = false;
$tytul = null;
$tresc = null;
$blokada = false;
$blokadaPrzypomnijHaslo = false;
$blokadaZarejestruj = false;
$blokadaData = null;
$komunikat = EMPTY_ACTION;
$wyloguj = false;


if(!empty($dane)){
    $dane = json_decode($dane);
}else{
    if($akcja !== 'uzytkownik_zapisz_zmiany'){
        if($akcja !== 'wyswietl_tabele_historia_elementu'){
            $akcja = '';
            $tresc = EMPTY_FILE_DATA;
            $komunikat = EMPTY_FILE_DATA;
        }

    }

}

$bazaDanych = new main_BazaDanych();
$panelLogowania = new main_PanelLogowania($bazaDanych);

switch ($akcja) {
    case 'zaloguj_sie':
            $uzytkownikLogin = (isset($dane->uzytkownikLogin)) ? htmlspecialchars($dane->uzytkownikLogin) : '';
            $uzytkownikHaslo = (isset($dane->uzytkownikHaslo)) ? htmlspecialchars($dane->uzytkownikHaslo) : '';

            if(empty($uzytkownikLogin) || empty($uzytkownikHaslo)){
                $tresc = EMPTY_DATA;
                break;
            }

            $rezultat = $panelLogowania->zaloguj($uzytkownikLogin, $uzytkownikHaslo);

            if(!$rezultat['rodzaj'] && $rezultat['komunikat'] == 'Podane konto nie istnieje!!!'){
                $bazaDanych->wstawDane('uzytkownik_historia_zmian',array(
                    'uzytkownik_id' => 0
                    ,'data_zmiany' => 'NOW()'
                    ,'akcja' => $rezultat['komunikat']
                    ,'adres_ip' =>  $_SERVER['REMOTE_ADDR']
                    ,'wartosc_przed' => $uzytkownikLogin
                    ,'zmiany_dokonal' => 0
                ));
            }

            $rodzaj = $rezultat['rodzaj'];
            $komunikat = $rezultat['komunikat'];
            $blokada = $rezultat['blokada'];
            $blokadaData = $rezultat['blokadaData'];
        break;

    case 'przypomnij_haslo':
            $uzytkownikLogin = (isset($dane->uzytkownikLogin)) ? htmlspecialchars(strtoupper($dane->uzytkownikLogin)) : '';
            $uzytkownikEmail = (isset($dane->uzytkownikEmail)) ? htmlspecialchars($dane->uzytkownikEmail) : '';

            if(empty($uzytkownikLogin) || empty($uzytkownikEmail)){
                $tresc = EMPTY_DATA;
                break;
            }

            $rezultat = $panelLogowania->przypomnijHaslo($uzytkownikLogin, $uzytkownikEmail);

            $rodzaj = $rezultat['rodzaj'];
            $komunikat = $rezultat['komunikat'];
            $blokada = $rezultat['blokada'];
            $blokadaData = $rezultat['blokadaData'];
            $blokadaPrzypomnijHaslo = $rezultat['blokadaPrzypomnijHaslo'];

            if($rezultat['rodzaj']){
                $tytul = SUCCESS_PASSWORD_RESET;
                $tresc = $panelLogowania->wczytajZawartoscPliku('https://' . $_SERVER ['HTTP_HOST'] . '/ajax/widoki/widok_sukces_reset_hasla_rejestracja',array(
                    'adresEmail' => $uzytkownikEmail
                ));

            }
        break;

    case 'zarejestruj':
            $uzytkownikRodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';

            if(empty($dane) || empty($uzytkownikRodzaj)){
                $tresc = EMPTY_DATA;
                break;
            }

            $rezultat = $panelLogowania->zarejestruj($uzytkownikRodzaj, $dane);

            $rodzaj = $rezultat['rodzaj'];
            $komunikat = $rezultat['komunikat'];
            $blokadaZarejestruj = $rezultat['blokadaZarejestruj'];

            if($rezultat['rodzaj']){
                $tytul = SUCCESS_REGISTER;
                $tresc = $panelLogowania->wczytajZawartoscPliku('https://' . $_SERVER ['HTTP_HOST'] . '/ajax/widoki/widok_sukces_reset_hasla_rejestracja',array(
                    'adresEmail' => $rezultat['adresEmail']
                ));

            }
        break;

    case 'ustaw_haslo':
            $uzytkownikLogin = (isset($dane->uzytkownikLogin)) ? htmlspecialchars(strtoupper($dane->uzytkownikLogin)) : '';
            $uzytkownikHasloSms = (isset($dane->uzytkownikHasloSms)) ? htmlspecialchars($dane->uzytkownikHasloSms) : '';
            $uzytkownikHaslo = (isset($dane->uzytkownikHaslo)) ? htmlspecialchars($dane->uzytkownikHaslo) : '';
            $uzytkownikHasloPowtorz = (isset($dane->uzytkownikHasloPowtorz)) ? htmlspecialchars($dane->uzytkownikHasloPowtorz) : '';
            $uzytkownikBilet = (isset($dane->uzytkownikBilet)) ? htmlspecialchars($dane->uzytkownikBilet) : '';

            if(empty($uzytkownikLogin) || empty($uzytkownikHasloSms) || empty($uzytkownikHaslo) || empty($uzytkownikHasloPowtorz)){
                $tresc = EMPTY_DATA;
                break;
            }

            if(empty($uzytkownikBilet)){
                $rodzaj = false;
                $komunikat = ERROR_TICKET_NUMBER;
                break;
            }

            if($uzytkownikHaslo !== $uzytkownikHasloPowtorz){
                $rodzaj = false;
                $komunikat = ERROR_PASSWORD_DIFREND;
                break;
            }

            $rezultat = $panelLogowania->ustawHaslo($uzytkownikLogin, $uzytkownikHaslo, $uzytkownikHasloSms, $uzytkownikBilet);

            $rodzaj = $rezultat['rodzaj'];
            $komunikat = $rezultat['komunikat'];
        break;

    case 'uzytkownik_zapisz_zmiany':
            $rodzaj = false;
            $komunikat = NOT_SAVE_CHANGES;

            session_start();
            if(!empty($avatarKlasa)){
                $avatar_tmp = $bazaDanych->pobierzDane('avatar_link', 'uzytkownik', 'id = '.$_SESSION['uzytkownik_id']);
                $avatar_tmp = $avatar_tmp->fetch_object();

                if($avatarKlasa === 'domyslny'){
                    $bazaDanych->aktualizujDane('uzytkownik',array( 'avatar_link' => 'domyslny.png'),$_SESSION['uzytkownik_id']);
                    $panelLogowania->dodajWpisDoHistorii($bazaDanych, $_SESSION['uzytkownik_id'],'uzytkownik_id', 'Edycja avatar', $avatar_tmp->avatar_link, 'domyslny.png', 'uzytkownik_historia_zmian');
                    $_SESSION['uzytkownik_avatar'] = 'domyslny.png';
                }
                if($avatarKlasa === 'nowy'){

                    $plik_tmp = $_FILES ['plik']['tmp_name'];

                    $nazwa_pliku = date('dmy_Hms').$_SESSION['uzytkownik_id'].'_avatar.jpg';
                    $lokalizacja = '/var/www/html/img/avatar/'.$nazwa_pliku;

                    move_uploaded_file ( $plik_tmp, $lokalizacja );

                    $_SESSION['uzytkownik_avatar'] = $nazwa_pliku;

                    $bazaDanych->aktualizujDane('uzytkownik', array( 'avatar_link' => $nazwa_pliku ), $_SESSION['uzytkownik_id']);
                    $panelLogowania->dodajWpisDoHistorii($bazaDanych, $_SESSION['uzytkownik_id'],'uzytkownik_id', 'Edycja avatar', $avatar_tmp->avatar_link, $nazwa_pliku, 'uzytkownik_historia_zmian');

                }

                $rodzaj = true;
                $komunikat = SAVE_CHANGES;
            }

            $uzytkownikStareHaslo = (isset($_POST['uzytkownikStareHaslo'])) ? htmlspecialchars($_POST['uzytkownikStareHaslo']) : '';
            $uzytkownikHaslo = (isset($_POST['uzytkownikHaslo'])) ? htmlspecialchars($_POST['uzytkownikHaslo']) : '';
            $uzytkownikHasloPowtorz = (isset($_POST['uzytkownikHasloPowtorz'])) ? htmlspecialchars($_POST['uzytkownikHasloPowtorz']) : '';

            if(!empty($uzytkownikStareHaslo) && !empty($uzytkownikHaslo) && !empty($uzytkownikHasloPowtorz)){

                if($uzytkownikHaslo !== $uzytkownikHasloPowtorz){
                    $komunikat = DIFRENT_PASSWORD;
                    break;
                }

                $uzytkownik = $bazaDanych->pobierzDane('haslo','uzytkownik','id = '.$_SESSION['uzytkownik_id']);
                $uzytkownik = $uzytkownik->fetch_object();

                if(!$panelLogowania->porownajHasla($uzytkownikStareHaslo)){
                    $panelLogowania->dodajWpisDoHistorii($bazaDanych, $_SESSION['uzytkownik_id'],'uzytkownik_id', 'Edycja hasło', 'Niepoprawne stare hasło', '', 'uzytkownik_historia_zmian');
                    $komunikat = DIFRENT_OLD_PASSWORD;
                    break;
                }

                $uzytkownikHaslo = $panelLogowania->zmienHaslo($uzytkownikHaslo, $_SESSION['uzytkownik_id']);
                if($uzytkownikHaslo){

                    $panelLogowania->dodajWpisDoHistorii($bazaDanych, $_SESSION['uzytkownik_id'],'uzytkownik_id', 'Edycja hasło', '', '', 'uzytkownik_historia_zmian');

                    $wyloguj = true;
                    $rodzaj = true;
                    $komunikat = SAVE_CHANGES;
                }


            }

        break;

    case 'wyswietl_tabele_historia_elementu':
        $kolumna = (isset($_POST['kolumna'])) ? $_POST['kolumna'] : '';
        $element_id = (isset($_POST['element_id'])) ? $_POST['element_id'] : '';
        $historia_element = (isset($_POST['historia_element'])) ? $_POST['historia_element'] : '';
        $lista_parametrow = (isset($_POST['lista_parametrow'])) ? json_decode($_POST['lista_parametrow'],true) : '' ;

        $tresc = $panelLogowania->wczytajWidok('/var/www/html/ajax/widoki/elementy/widok_tabela_historia_elementu.php',array(
                'kolumna' => $kolumna
                ,'elementId' => $element_id
                ,'historiaElement' => $historia_element
                ,'listaParametrow' => $lista_parametrow
            ));

        $rodzaj = SUCCESS;
        $komunikat = '';

        break;
}

$arrayOut = array(
    'rodzaj' => $rodzaj
    ,'tytul' => $tytul
    ,'komunikat' => $komunikat
    ,'tresc' => $tresc
    ,'blokada' => $blokada
    ,'blokadaData' => $blokadaData
    ,'blokadaPrzypomnijHaslo' => $blokadaPrzypomnijHaslo
    ,'blokadaZarejestruj' => $blokadaZarejestruj
    ,'wyloguj' => $wyloguj
    ,'avatarNazwa' => $_SESSION['uzytkownik_avatar']
);

echo json_encode($arrayOut);
return;