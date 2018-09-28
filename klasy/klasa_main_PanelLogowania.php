<?php

class main_PanelLogowania extends main_PanelPrzedstawiciela {
    private $_uzytkownikLogin;
    private $_uzytkownikHaslo;
    private $_uzytkownikEmail;
    private $_uzytkownikBilet;
    private $_uzytkownikDane = null;
    private $_komunikatOut = ERROR_UNKNOWN;
    private $_trescOut = null;
    private $_rodzajOut = false;
    private $_blokada = false;
    private $_blokadaPrzpomnijHaslo = false;
    private $_blokadaZarejestruj = false;
    private $_blokadaData = null;
    private $_bd;

    function __construct($bazaDanych){
        $this->_bd = $bazaDanych;
    }

    private function ustawZmienneSesyjne(){
        session_start();
        $_SESSION ['zalogowany'] = true;
        $_SESSION['uzytkownik_login'] = $this->_uzytkownikDane->login;
        $_SESSION['uzytkownik_id'] = $this->_uzytkownikDane->id;
        $_SESSION['uzytkownik_imie'] = $this->_uzytkownikDane->imie;
        $_SESSION['uzytkownik_nazwisko'] = $this->_uzytkownikDane->nazwisko;
        $_SESSION['uzytkownik_avatar'] = $this->_uzytkownikDane->avatar_link;
        $uzytkownikGrupa_tmp = $this->_bd->pobierzDane('nazwa','uzytkownik_grupy','id = '.$this->_uzytkownikDane->uzytkownik_grupa_id);
        $uzytkownikGrupa_tmp = $uzytkownikGrupa_tmp->fetch_object();
        $_SESSION['uzytkownik_grupa'] = $uzytkownikGrupa_tmp->nazwa;
        $_SESSION['uzytkownik_grupa_id'] = $this->_uzytkownikDane->uzytkownik_grupa_id;
        $_SESSION['uzytkownik_email'] = $this->_uzytkownikDane->email;

        /*Aktualizacja danych na bazie*/
        $wartosci_tmp = array(
            'proby_logowania' => 0
            ,'ostatnia_aktywna_sesja' => session_id()
            ,'liczba_kontrolna' => 0
            ,'haslo_sms' => 0
        );

        $this->_bd->aktualizujDane('uzytkownik', $wartosci_tmp, $this->_uzytkownikDane->id);
        $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_SUCCESS_LOGIN, '', '', 'uzytkownik_historia_zmian');

        $this->_komunikatOut = SUCCESS_LOGIN;
        $this->_rodzajOut = true;

    }

    private function zakodujHaslo($uzytkownikHaslo){
        $passwordOpcje = [
            'cost' => PASSWORD_KOSZT,
            'salt' => PASSWORD_KLUCZ
        ];

        $this->_uzytkownikHaslo = password_hash ( $uzytkownikHaslo, PASSWORD_DEFAULT, $passwordOpcje );
    }

    private function wyslijLinkAktywacyjny(){

        $liczbaKontrolna_tmp = md5(uniqid().date ( 'Y' ).date ( 'm' ).date ( 'd' ).date ( 'His' ).uniqid()).md5(md5(uniqid().date ( 'Y' ).date ( 'm' ).date ( 'd' ).date ( 'His' ).uniqid()));
        $linkAktywacyjny_tmp = 'https://' . $_SERVER ['HTTP_HOST'] . '/ustaw_haslo?bilet='.$liczbaKontrolna_tmp.'&numer='.$this->_uzytkownikLogin.' ';

        $emailTresc_tmp = $this->wczytajZawartoscPliku('https://' . $_SERVER ['HTTP_HOST'] . '/ajax/widoki/widok_mail_link_aktywacyjny', array('linkAktywacyjny' => $linkAktywacyjny_tmp));

        $rezultat = $this->wyslijWiadomoscEmail(SUCCESS_PASSWORD_RESET_EMAIL_TOPIC, $emailTresc_tmp, $this->_uzytkownikEmail, EMAIL_SENDER, EMAIL_SENDER_NAME, true);
        if($rezultat['rezultat'] === 0){
            $this->_komunikatOut = $rezultat['komunikat'];
            return true;
        }

        $this->_bd->aktualizujDane('uzytkownik', array(
            'liczba_kontrolna' => $liczbaKontrolna_tmp
            ,'data_linku_aktywacyjnego' => 'NOW()'
        ), $this->_uzytkownikDane->id);

        $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_PASSWORD_RESET_SEND_EMAIL, '', '', 'uzytkownik_historia_zmian');

        return false;
    }

    private function wyslijHasloSMS($numerTelefonu){
        $hasloSMS = substr( uniqid(),7);
        $trescSms_tmp = str_replace('#tresc#',$hasloSMS,SUCCESS_PASSWORD_RESET_SMS_CONTENT);

        $rezultat = $this->wyslijSMS($numerTelefonu, $trescSms_tmp);

        /*if(empty($rezultat)){
            $this->_komunikatOut = ERROR_SMS_SEND;
            return true;
        }*/

        $this->_bd->wstawDane('sms_historia', array(
            'telefon' => $numerTelefonu
            ,'tresc' => $trescSms_tmp
            ,'guid' => $rezultat['guid']
            ,'odpowiedz' => $rezultat['resultType']
            ,'opis' => $rezultat['description']
            ,'numer_wyjatku' => $rezultat['idException']
            ,'data_dodania' => 'NOW()'
        ));

        $this->_bd->aktualizujDane('uzytkownik', array(
            'haslo_sms' => $hasloSMS
        ), $this->_uzytkownikDane->id);

        $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_PASSWORD_RESET_SEND_SMS, 'Wysłany na: ', $numerTelefonu, 'uzytkownik_historia_zmian');

        return false;
    }

    private function sprawdzRodzajUzytkownika(){
        $login_tmp = $this->_uzytkownikLogin[0].$this->_uzytkownikLogin[1];

        switch ($login_tmp){
            case 'A0' :
            case 'K0' :
                    $this->_uzytkownikLogin = strtoupper($this->_uzytkownikLogin);
                    return 'PCE';
                break;
            default :
                    $this->_uzytkownikLogin = strtolower($this->_uzytkownikLogin);
                    return 'PANEL';

        }
    }

    private function sprawdzHaslo(){
        if($this->_uzytkownikDane->haslo !== $this->_uzytkownikHaslo){
            if($this->_uzytkownikDane->proby_logowania === '3'){
                $this->_bd->aktualizujDane('uzytkownik', array(
                    'data_blokada_tymczasowa' => 'NOW()'
                    ,'tymczasowa_blokada' => 1
                ), $this->_uzytkownikDane->id);
                $this->_komunikatOut = ERROR_USER_BLOCK.' <b>30 min!!!</b>';
                $this->_blokadaData = date('Y-m-d H:i:s');
                $this->_blokada = true;
                $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_BLOCK, '', '', 'uzytkownik_historia_zmian');

                return true;
            }
            $this->_bd->aktualizujDane('uzytkownik', array(
                'proby_logowania' => ($this->_uzytkownikDane->proby_logowania+1)
            ), $this->_uzytkownikDane->id);

            $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_ERROR_LOGIN, 'Próba: '.($this->_uzytkownikDane->proby_logowania+1), '', 'uzytkownik_historia_zmian');

            $this->_komunikatOut = ERROR_USER_DIFRENT_PASS.' <b>Pozostała liczba logowań: '.(3-$this->_uzytkownikDane->proby_logowania).'</b>';
            return true;
        }
        return false;
    }

    private function sprawdzBlokadeUzytkownika(){
        if($this->_uzytkownikDane->tymczasowa_blokada === '1'){
            $dataTeraz_tmp = date('Y-m-d H:i:s');
            $roznicaDat_tmp = floor((strtotime( $dataTeraz_tmp ) - strtotime( $this->_uzytkownikDane->data_blokada_tymczasowa ))/60);
            $pozostalyCzas = 30 - $roznicaDat_tmp;

            if($pozostalyCzas > 1){
                $this->_komunikatOut = ERROR_USER_BLOCK.' <b>'.$pozostalyCzas.' min!!!</b>';
                $this->_blokadaData = $this->_uzytkownikDane->data_blokada_tymczasowa;
                $this->_blokada = true;
                return true;
            }else{
                $this->_bd->aktualizujDane('uzytkownik', array(
                    'proby_logowania' => 0
                    ,'tymczasowa_blokada' => 0
                ), $this->_uzytkownikDane->id);
                $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_UNBLOCK, '', '', 'uzytkownik_historia_zmian');

                return false;
            }
        }

        return false;

    }

    private function sprawdzDateLinkuAktywacyjnego(){
        $dataTeraz_tmp = date('Y-m-d H:i:s');
        $roznicaDat_tmp = floor((strtotime( $dataTeraz_tmp ) - strtotime( $this->_uzytkownikDane->data_linku_aktywacyjnego ))/60);
        $pozostalyCzas = 10 - $roznicaDat_tmp;

        if($pozostalyCzas > 1){
            $this->_komunikatOut = ERROR_USER_PASSWORD_RESET_TIME.' <b>'.$pozostalyCzas.' min!!!</b>';
            $this->_blokadaPrzpomnijHaslo = true;
            return true;
        }

        return false;
    }

    private function sprawdzWaznoscLinkuAktywacyjnego(){
        $dataLinkuAktywacyjnego_tmp = $this->_bd->pobierzDane('data_linku_aktywacyjnego, id', 'uzytkownik', 'login = "'.$this->_uzytkownikLogin.'" AND liczba_kontrolna = "'.$this->_uzytkownikBilet.'"');

        if(is_null($dataLinkuAktywacyjnego_tmp)){
            $this->_komunikatOut = ERROR_TICKET_NUMBER;
            return true;
        }

        $dataLinkuAktywacyjnego_tmp = $dataLinkuAktywacyjnego_tmp->fetch_object();

        $dataTeraz_tmp = date('Y-m-d H:i:s');
        $roznicaDat_tmp = floor((strtotime( $dataTeraz_tmp ) - strtotime( $dataLinkuAktywacyjnego_tmp->data_linku_aktywacyjnego ))/60);

        if($roznicaDat_tmp > 30){
            $this->_bd->aktualizujDane('uzytkownik', array(
                'liczba_kontrolna' => 0
                ,'haslo_sms' => 0
            ), $this->_uzytkownikDane->id);

            $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_PASSWORD_RESET_TICKET_TIMEOUT, '', '', 'uzytkownik_historia_zmian');

            $this->_komunikatOut = ERROR_TICET_TIMEOUT;
            return true;
        }

        return false;
    }

    private function sprawdzUzytkownikaPCE(){
        $polaczenieSql = $this->_bd->polaczeniePceSql();
        $uzytkownikStatus_tmp = $this->_bd->wywolajProcedureSql('php_agent_czy_aktywny', array(
            'numer_agenta_tmp' => $this->_uzytkownikLogin
        ), $polaczenieSql);

        $uzytkownikStatus_tmp = mssql_fetch_object($uzytkownikStatus_tmp);
        $uzytkownikDane_tmp = $this->_bd->pobierzDane('*', 'uzytkownik', 'login = "'.$this->_uzytkownikLogin.'"');

        if($uzytkownikDane_tmp){
            $this->_uzytkownikDane = $uzytkownikDane_tmp->fetch_object();
        }

        //var_dump($uzytkownikStatus_tmp);

        /*Czy aktywny po stronie PCE*/
        if($this->sprawdzCzyAktywnyPce($uzytkownikStatus_tmp)){
            return true;
        }
        /*Czy istnieje*/
        if(is_null($this->_uzytkownikDane)){
            $this->_komunikatOut = ERROR_USER_NOT_EXIST_REGISTER;
            return true;
        }
        /*Automatycznie aktywowanie po stronie Panelu*/
        if($this->_uzytkownikDane->status === '0'){
            $this->_bd->aktualizujDane('uzytkownik', array(
                'status' => 1
            ), $this->_uzytkownikDane->id);
            $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_ACTIVE, '', '', 'uzytkownik_historia_zmian');
        }
        /*Czy blokada*/
        if($this->sprawdzBlokadeUzytkownika()){
            return true;
        }

        return false;
    }

    private function sprawdzCzyAktywnyPce($uzytkownikStatus){
        if($uzytkownikStatus->status !== 1){
            if(!is_null($this->_uzytkownikDane)){
                if($this->_uzytkownikDane->status === '1'){
                    $this->_bd->aktualizujDane('uzytkownik', array(
                        'status' => 0
                    ), $this->_uzytkownikDane->id);
                    $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_DELETE, '', '', 'uzytkownik_historia_zmian');
                }else{
                    $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_DELETE_LOGIN, '', '', 'uzytkownik_historia_zmian');
                }
            }

            $this->_komunikatOut = ERROR_USER_DELETED;
            return true;
        }

        return false;
    }

    private function sprawdzUzytkownikaPanel(){
        $uzytkownikDane_tmp = $this->_bd->pobierzDane('*', 'uzytkownik', 'login = "'.$this->_uzytkownikLogin.'"');
        /*Czy istnieje*/
        if(!$uzytkownikDane_tmp){
            $this->_komunikatOut = ERROR_USER_NOT_EXIST;
            return true;
        }
        $this->_uzytkownikDane = $uzytkownikDane_tmp->fetch_object();
        /*Czy aktywny*/
        if($this->_uzytkownikDane->status === '0'){
            $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_DELETE_LOGIN, '', '', 'uzytkownik_historia_zmian');
            $this->_komunikatOut = ERROR_USER_DELETED;
            return true;
        }
        /*Czy blokada*/
        if($this->sprawdzBlokadeUzytkownika()){
            return true;
        }

        return false;
    }

    private function sprawdzZarejestrujOsobaFizyczna(){
        $polaczenieSql = $this->_bd->polaczeniePceSql();

        /*$uzytkownikDane_tmp = $this->_bd->wywolajProcedureSql('php_agent_dane', array(
            'numer_agenta_tmp' => $this->_uzytkownikDane->uzytkownikLogin
            ,'imie_tmp' => $this->_uzytkownikDane->uzytkownikImie
            ,'nazwisko_tmp' => $this->_uzytkownikDane->uzytkownikNazwisko
            ,'pesel_tmp' => $this->_uzytkownikDane->uzytkownikPesel
            ,'dowod_tmp' => strtoupper($this->_uzytkownikDane->uzytkownikNrDowodu)
            ,'email_tmp' => $this->_uzytkownikDane->uzytkownikEmail
        ), $polaczenieSql);*/

        $uzytkownikDane_tmp = $this->_bd->wywolajProcedureSql('php_agent_dane_v2', array(
            'numer_agenta_tmp' => $this->_uzytkownikDane->uzytkownikLogin
            ,'imie_tmp' => $this->_uzytkownikDane->uzytkownikImie
            ,'nazwisko_tmp' => $this->_uzytkownikDane->uzytkownikNazwisko
        ), $polaczenieSql);

        $this->zarejestrujUzytkownika($uzytkownikDane_tmp);
    }

    private function sprawdzZarejestrujDzialalnoscGospodarcza(){
        $polaczenieSql = $this->_bd->polaczeniePceSql();

        /*$uzytkownikDane_tmp = $this->_bd->wywolajProcedureSql('php_agent_firma_dane', array(
            'numer_agenta_tmp' => strtoupper($this->_uzytkownikDane->uzytkownikLogin)
            ,'imie_nazwisko_tmp' => $this->_uzytkownikDane->uzytkownikImie.' '.$this->_uzytkownikDane->uzytkownikNazwisko
            ,'nazwisko_imie_tmp' => $this->_uzytkownikDane->uzytkownikNazwisko.' '.$this->_uzytkownikDane->uzytkownikImie
            ,'nip_tmp' => $this->_uzytkownikDane->firmaNip
            ,'regon_tmp' => $this->_uzytkownikDane->firmaRegon
            ,'mail_tmp' => $this->_uzytkownikDane->uzytkownikEmail
        ), $polaczenieSql);*/

        $uzytkownikDane_tmp = $this->_bd->wywolajProcedureSql('php_agent_firma_dane_v2', array(
            'numer_agenta_tmp' => strtoupper($this->_uzytkownikDane->uzytkownikLogin)
            ,'imie_nazwisko_tmp' => $this->_uzytkownikDane->uzytkownikImie.' '.$this->_uzytkownikDane->uzytkownikNazwisko
            ,'nazwisko_imie_tmp' => $this->_uzytkownikDane->uzytkownikNazwisko.' '.$this->_uzytkownikDane->uzytkownikImie
        ), $polaczenieSql);

        $this->zarejestrujUzytkownika($uzytkownikDane_tmp);
    }

    private function zalogujUzytkownikaPCE(){
        /*Sprawdz użytkownika*/
        if($this->sprawdzUzytkownikaPCE()){
            return;
        }
        /*Sprawdz haslo*/
        if($this->sprawdzHaslo()){
            return;
        }
        /*Ustaw zmienne sesyjne*/
        $this->ustawZmienneSesyjne();
    }

    private function zalogujUzytkownikaPanel(){
        /*Sprawdz uzytkownika*/
        if($this->sprawdzUzytkownikaPanel()){
            return;
        }
        /*Sprawdz haslo*/
        if($this->sprawdzHaslo()){
            return;
        }
        /*Ustaw zmienne sesyjne*/
        $this->ustawZmienneSesyjne();

    }

    private function przypomnijHasloUzytkownikaPCE(){
        //Sprawdz uzytkownika
        if($this->sprawdzUzytkownikaPCE()){
            return;
        }

        $this->przypomnijHasloUzytkownika(true);
    }

    private function przypomnijHasloUzytkownikaPanel(){
        //Sprawdz uzytkownika
        if($this->sprawdzUzytkownikaPanel()){
            return;
        }

        $this->przypomnijHasloUzytkownika();
    }

    private function przypomnijHasloUzytkownika($kuPce = false){
        if($kuPce){
            $polaczenieSql = $this->_bd->polaczeniePceSql();
            $uzytkownikTelefon_tmp = $this->_bd->wywolajProcedureSql('php_agent_telefon_na_podstawie_maila', array(
                'agentNumber' => $this->_uzytkownikLogin
                ,'agentMail' => $this->_uzytkownikEmail
            ), $polaczenieSql);

            $uzytkownikTelefon_tmp = mssql_fetch_object($uzytkownikTelefon_tmp);

            if(empty($uzytkownikTelefon_tmp->Phone) || empty($uzytkownikTelefon_tmp->Email)){
                $this->_komunikatOut = ERROR_USER_REGISTRATION_EMAIL;
                return;
            }

            if($uzytkownikTelefon_tmp->Phone !== $this->_uzytkownikDane->telefon_kom){
                $this->_bd->aktualizujDane('uzytkownik',array(
                    'telefon_kom' => $uzytkownikTelefon_tmp->Phone
                ),$this->_uzytkownikDane->id);
                $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', 'Edycja telefon_kom z PCE', $this->_uzytkownikDane->telefon_kom, $uzytkownikTelefon_tmp->Phone, 'uzytkownik_historia_zmian');
                $this->_uzytkownikDane->telefon_kom = $uzytkownikTelefon_tmp->Phone;
            }

            if($uzytkownikTelefon_tmp->Email !== $this->_uzytkownikDane->email){
                $this->_bd->aktualizujDane('uzytkownik',array(
                    'email' => $uzytkownikTelefon_tmp->Email
                ),$this->_uzytkownikDane->id);
                $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', 'Edycja email z PCE', $this->_uzytkownikDane->email, $uzytkownikTelefon_tmp->Email, 'uzytkownik_historia_zmian');
                $this->_uzytkownikDane->email = $uzytkownikTelefon_tmp->Email;
            }
        }

        //Sprawdz email
        if($this->_uzytkownikEmail !== $this->_uzytkownikDane->email){
            $this->_komunikatOut = ERROR_USER_DIFRENT_EMAIL;
            return;
        }
        //Sprawdz daty linku aktywacyjnego
        if($this->sprawdzDateLinkuAktywacyjnego()){
            return;
        }
        //Wyslanie linku aktywacyjnego
        if($this->wyslijLinkAktywacyjny()){
            return;
        }
        //Wyslanie hasla SMS
        if($this->wyslijHasloSMS($this->_uzytkownikDane->telefon_kom)){
            return;
        }

        $this->_rodzajOut = true;
        $this->_komunikatOut = SUCCESS;
    }

    private function widokUstawHasloUzytkownika(){

        //Waznosc linku aktywacyjnego
        if($this->sprawdzWaznoscLinkuAktywacyjnego()){
           return;
        }

        $this->_trescOut = $this->wczytajZawartoscPliku('https://' . $_SERVER ['HTTP_HOST'] . '/ajax/widoki/widok_panel_ustaw_haslo', array(
            'uzytkownikLogin' => $this->_uzytkownikLogin
            ,'uzytkownikBilet' => $this->_uzytkownikBilet
        ));

        $this->_rodzajOut = true;
        $this->_komunikatOut = SUCCESS;

    }

    private function ustawHasloUzytkownika($uzytkownikHasloSms){

        $uzytkownikDane_tmp = $this->_bd->pobierzDane('id, haslo_sms','uzytkownik',
            'login = "'.$this->_uzytkownikLogin.'" AND liczba_kontrolna = "'.$this->_uzytkownikBilet.'"');

        if(is_null($uzytkownikDane_tmp)){
            $this->_komunikatOut = ERROR_TICKET_NUMBER;
            return;
        }

        $this->_uzytkownikDane = $uzytkownikDane_tmp->fetch_object();

        if($uzytkownikHasloSms !== $this->_uzytkownikDane->haslo_sms){
            $this->_komunikatOut = ERROR_PASSWORD_SMS;
            return;
        }

        $this->_bd->aktualizujDane('uzytkownik', array(
            'haslo' => $this->_uzytkownikHaslo
            ,'data_zmiana_hasla' => 'NOW()'
            ,'liczba_kontrolna' => 0
            ,'haslo_sms' => 0
        ), $this->_uzytkownikDane->id);

        $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_PASSWORD_CHANGE, '', '', 'uzytkownik_historia_zmian');

        $this->_rodzajOut = true;
        $this->_komunikatOut = SUCCESS_PASSWORD_SET;
    }

    private function zarejestrujUzytkownika($uzytkownikDane){
        $uzytkownikDane = mssql_fetch_object($uzytkownikDane);
        //Czy istnieje?
        if(!$uzytkownikDane){
            $this->_blokadaZarejestruj = true;
            $this->_komunikatOut = ERROR_USER_PCE_NOT_EXIST_REGISTER;
            return;
        }
        //Czy aktywny?
        if($uzytkownikDane->status !== 1){
            $this->_blokadaZarejestruj = true;
            $this->_komunikatOut = ERROR_USER_DELETED_REGISTER;
            return;
        }
        //Czy posiada numer telefonu?

        if(empty($uzytkownikDane->numer_telefonu)){
            $this->_blokadaZarejestruj = true;
            $this->_komunikatOut = ERROR_USER_EMPTY_MOBILE_PHONE;
            return;
        }
        //Czy posiada adres email?
        if(empty($uzytkownikDane->adres_email)){
            $this->_blokadaZarejestruj = true;
            $this->_komunikatOut = ERROR_USER_EMPTY_EMAIL_ADRESS;
            return;
        }

        $uzytkownikId_tmp = $this->_bd->wstawDane('uzytkownik', array(
            'imie' => $this->_uzytkownikDane->uzytkownikImie
            ,'nazwisko' => $this->_uzytkownikDane->uzytkownikNazwisko
            ,'login' => strtoupper($this->_uzytkownikDane->uzytkownikLogin)
            ,'status' => 1
            ,'data_dodania' => 'NOW()'
            ,'email' => $uzytkownikDane->adres_email
            ,'telefon_kom' => $uzytkownikDane->numer_telefonu
            ,'uzytkownik_grupa_id' => $uzytkownikDane->uzytkownik_grupa_id
        ));

        $this->_uzytkownikEmail = $uzytkownikDane->adres_email;
        $this->_uzytkownikLogin = strtoupper($this->_uzytkownikDane->uzytkownikLogin);
        $this->_uzytkownikDane = (object)array('id' => $uzytkownikId_tmp);

        $this->dodajWpisDoHistorii($this->_bd, $this->_uzytkownikDane->id, 'uzytkownik_id', USER_ADD, '', '', 'uzytkownik_historia_zmian');

        $this->wyslijLinkAktywacyjny();

        $this->wyslijHasloSMS($uzytkownikDane->numer_telefonu);

        $this->_rodzajOut = true;
        $this->_komunikatOut = SUCCESS;
    }

    //PUBLICZNE METODY

    public function zaloguj($uzytkownikLogin, $uzytkownikHaslo){
        $this->_uzytkownikLogin = $uzytkownikLogin;
        $this->zakodujHaslo($uzytkownikHaslo);

        $uzytkownikRodzaj_tmp = $this->sprawdzRodzajUzytkownika();

        switch($uzytkownikRodzaj_tmp){
            case 'PCE':
                    $this->zalogujUzytkownikaPCE();
                break;
            case 'PANEL':
                    $this->zalogujUzytkownikaPanel();
                break;
        }

        return array(
            'rodzaj' => $this->_rodzajOut
            ,'komunikat' => $this->_komunikatOut
            ,'blokada' => $this->_blokada
            ,'blokadaData' => $this->_blokadaData
        );
    }

    public function przypomnijHaslo($uzytkownikLogin, $uzytkownikEmail){
        $this->_uzytkownikLogin = $uzytkownikLogin;
        $this->_uzytkownikEmail = $uzytkownikEmail;

        $uzytkownikRodzaj_tmp = $this->sprawdzRodzajUzytkownika();

        switch($uzytkownikRodzaj_tmp){
            case 'PCE':
                    $this->przypomnijHasloUzytkownikaPCE();
                break;
            case 'PANEL':
                    $this->przypomnijHasloUzytkownikaPanel();
                break;
        }

        return array(
            'rodzaj' => $this->_rodzajOut
            ,'komunikat' => $this->_komunikatOut
            ,'blokada' => $this->_blokada
            ,'blokadaData' => $this->_blokadaData
            ,'blokadaPrzypomnijHaslo' => $this->_blokadaPrzpomnijHaslo
        );
    }

    public function zarejestruj($uzytkownikRodzaj, $dane){
        //czy istnieje
        $uzytkownik_tmp = $this->_bd->pobierzDane('id', 'uzytkownik', 'login = "'.$dane->uzytkownikLogin.'"');

        if(is_null($uzytkownik_tmp)){
            $dane->uzytkownikLogin = strtoupper($dane->uzytkownikLogin);
            //$dane->uzytkownikLogin = strtoupper($dane->uzytkownikLogin);

            $this->_uzytkownikDane = $dane;

            if($uzytkownikRodzaj === 'osoba_fizyczna'){
                $this->sprawdzZarejestrujOsobaFizyczna();
            }

            if($uzytkownikRodzaj === 'dzialalnosc_gospodarcza'){
                $this->sprawdzZarejestrujDzialalnoscGospodarcza();
            }
        }else{
            $this->_blokadaZarejestruj = true;
            $this->_komunikatOut = ERROR_USER_EXIST_REGISTER;
        }



        return array(
            'rodzaj' => $this->_rodzajOut
            ,'komunikat' => $this->_komunikatOut
            ,'blokadaZarejestruj' => $this->_blokadaZarejestruj
            ,'adresEmail' => $this->_uzytkownikEmail
        );
    }

    public function widokUstawHaslo($uzytkownikBilet, $uzytkownikLogin){
        $this->_uzytkownikLogin = $uzytkownikLogin;
        $this->_uzytkownikBilet = $uzytkownikBilet;

        $this->widokUstawHasloUzytkownika();

        return array(
            'rodzaj' => $this->_rodzajOut
            ,'komunikat' => $this->_komunikatOut
            ,'tresc' => $this->_trescOut
        );
    }

    public function ustawHaslo($uzytkownikLogin, $uzytkownikHaslo, $uzytkownikHasloSms, $uzytkownikBilet){
        $this->_uzytkownikLogin = $uzytkownikLogin;
        $this->zakodujHaslo($uzytkownikHaslo);
        $this->_uzytkownikBilet = $uzytkownikBilet;

        $this->sprawdzRodzajUzytkownika();
        $this->ustawHasloUzytkownika($uzytkownikHasloSms);

        return array(
            'rodzaj' => $this->_rodzajOut
            ,'komunikat' => $this->_komunikatOut
        );
    }

    public function porownajHasla($uzytkownikStareHaslo){
        $uzytkownik = $this->_bd->pobierzDane('haslo','uzytkownik','id = '.$_SESSION['uzytkownik_id']);
        $uzytkownik = $uzytkownik->fetch_object();
        $this->zakodujHaslo($uzytkownikStareHaslo);

        if($uzytkownik->haslo !== $this->_uzytkownikHaslo){
            return false;
        }

        return true;

    }

    public function zmienHaslo($uzytkownikHaslo, $uzytkownikId){
        $this->zakodujHaslo($uzytkownikHaslo);

        $this->_bd->aktualizujDane('uzytkownik', array( 'haslo' => $this->_uzytkownikHaslo), $uzytkownikId );

        return true;
    }

}