<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

    $administracjaMain = new AdministracjaMain();

    $akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '' ;
    $tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '' ;
    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
    $dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;

    $komunikat = 'Brak akcji do wykonania!!!';
    $rodzajOut = 'blad';
    $przeladujWidokZakladki = 0;
    $przeladujSzczegolyElementu = 0;
    $ukryjPopUp1 = 0;

    switch ($akcja) {
        case 'usun_przywroc_element':
                $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;

                if($reakcja === 'przywroc'){
                    $status_tmp = 1;
                    $czy_usuniety = 0;
                }else{
                    $status_tmp = 0;
                    $czy_usuniety = 1;
                }

                if($tabela == 'uzytkownik'){
                    $administracjaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, array( 'status' => $status_tmp ), $tabela);
                    $bazaDanych->aktualizujDane($tabela, array( 'status' => $status_tmp ), $element_id);
                }

                if($tabela == 'powiadomienia'){
                    $administracjaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, array( 'czy_usuniety' => $czy_usuniety ), $tabela);
                    $bazaDanych->aktualizujDane($tabela, array(
                        'czy_usuniety' => $czy_usuniety
                        ,'czy_aktywny' => 0
                    ), $element_id);
                }

                if($tabela == 'uzytkownik_grupy'){
                    $administracjaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, array( 'czy_usuniety' => $czy_usuniety ), $tabela);
                    $bazaDanych->aktualizujDane($tabela, array( 'czy_usuniety' => $czy_usuniety ), $element_id);
                }


                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujSzczegolyElementu = 1;
                $przeladujWidokZakladki = 1;

            break;

        case 'usun_dodaj_uprawnienie_uzytkownika':
                $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
                $element_id = explode('-', $element_id);
                $uzytkownik_id = $element_id[0];
                $uprawnienie_id = $element_id[1];

                if($reakcja == 'usun'){
                    $bazaDanych->deleteDane('uzytkownik_uprawnienie', 'id_uzytkownika = '.$uzytkownik_id.' AND id_uprawnienia = '.$uprawnienie_id);
                    $administracjaMain->dodajWpisDoHistorii($bazaDanych, $uzytkownik_id,'uzytkownik_id', 'Usuniecie uprawnienia', $uprawnienie_id, '', 'uzytkownik_historia_zmian');

                }else{
                    $bazaDanych->wstawDane('uzytkownik_uprawnienie', array( 'id_uzytkownika' => $uzytkownik_id, 'id_uprawnienia' => $uprawnienie_id ));
                    $administracjaMain->dodajWpisDoHistorii($bazaDanych, $uzytkownik_id,'uzytkownik_id', 'Nadanie uprawnienia', '', $uprawnienie_id, 'uzytkownik_historia_zmian');

                }

                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';

            break;

        case 'wlacz_wylacz_sms':
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
            $element_id = explode('-', $element_id);
           // $grupa_id = $element_id[];
            $sms_id = $element_id[0];



            if($reakcja == 'wlacz'){
                $dane = array(
                    'aktywny' => '1'
                );
                $bazaDanych->aktualizujDane('dane_systemowe_sms', $dane, $sms_id);
                //$administracjaMain->dodajWpisDoHistorii($bazaDanych, $uzytkownik_id,'uzytkownik_id', 'Usuniecie uprawnienia', $uprawnienie_id, '', 'uzytkownik_historia_zmian');

            }else{
                $dane = array(
                    'aktywny' => '0'
                );
                $bazaDanych->aktualizujDane('dane_systemowe_sms', $dane, $sms_id);
                //$administracjaMain->dodajWpisDoHistorii($bazaDanych, $uzytkownik_id,'uzytkownik_id', 'Nadanie uprawnienia', '', $uprawnienie_id, 'uzytkownik_historia_zmian');

            }

            $komunikat = 'Zmiany zostały zapisane!!!';
            $rodzajOut = 'sukces';

            break;

        case 'update_sms':
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
            $tresc = $_POST['tresc'];
            $element_id = explode('-', $element_id);
            // $grupa_id = $element_id[];
            $sms_id = $element_id[0];

            if($reakcja == 'sms_update') {
                $dane = array(
                    'sms_tresc' => $tresc
                );
                $bazaDanych->aktualizujDane('dane_systemowe_sms', $dane, $sms_id);
                //$administracjaMain->dodajWpisDoHistorii($bazaDanych, $uzytkownik_id,'uzytkownik_id', 'Usuniecie uprawnienia', $uprawnienie_id, '', 'uzytkownik_historia_zmian');
            }

            $komunikat = 'Zmiany zostały zapisane!!!';
            $rodzajOut = 'sukces';

            break;

        case 'usun_dodaj_uprawnienie_grupy':
                $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;
                $element_id = explode('-', $element_id);
                $grupa_id = $element_id[0];
                $uprawnienie_id = $element_id[1];

                if($reakcja == 'usun'){
                    $bazaDanych->deleteDane('uzytkownik_grupy_uprawnienie', 'uzytkownik_grupy_id = '.$grupa_id.' AND uprawnienia_id = '.$uprawnienie_id);
                    $administracjaMain->dodajWpisDoHistorii($bazaDanych, $grupa_id,'uzytkownik_grupy_id', 'Usuniecie uprawnienia', 'up. id '.$uprawnienie_id, '', 'uzytkownik_grupy_historia_zmian');

                }else{
                    $bazaDanych->wstawDane('uzytkownik_grupy_uprawnienie', array( 'uzytkownik_grupy_id' => $grupa_id, 'uprawnienia_id' => $uprawnienie_id ));
                    $administracjaMain->dodajWpisDoHistorii($bazaDanych, $grupa_id,'uzytkownik_grupy_id', 'Dodanie uprawnienia', '', 'up. id '.$uprawnienie_id, 'uzytkownik_grupy_historia_zmian');

                }

                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';

            break;

        case 'aktualizuj_uzytkownika':
                if(array_key_exists('haslo',$dane)){
                    $options = [
                        'cost' => 11,
                        'salt' => '>om5R#Y;Xga>P(5\u/E!h;wF'
                    ];

                    $haslo_hash = password_hash ( $dane['haslo'], PASSWORD_DEFAULT, $options );
                    $bazaDanych->aktualizujDane($tabela, array( 'haslo' => $haslo_hash ), $element_id);
                    $administracjaMain->dodajWpisDoHistorii($bazaDanych, $element_id,'uzytkownik_id', 'Edycja hasło', '', '', 'uzytkownik_historia_zmian');

                    unset($dane['haslo']);

                    $ostatnia_aktywna_sesja = $bazaDanych->pobierzDane('ostatnia_aktywna_sesja', 'uzytkownik', 'id = '.$element_id);
                    $ostatnia_aktywna_sesja = $ostatnia_aktywna_sesja->fetch_object();

                    if($ostatnia_aktywna_sesja->ostatnia_aktywna_sesja != 0){
                        $bazaDanych->aktualizujDane($tabela, array( 'ostatnia_aktywna_sesja' => '0' ), $element_id);
                        $administracjaMain->dodajWpisDoHistorii($bazaDanych, $element_id,'uzytkownik_id', 'Wylogowanie ADM.', '', '', 'uzytkownik_historia_zmian');

                    }
                }

                $administracjaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

                $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

                if(array_key_exists('uzytkownik_grupa_id',$dane)){
                    $bazaDanych->deleteDane('uzytkownik_uprawnienie','id_uzytkownika = '.$element_id);
                    $lista_uprawnien_grupy = $bazaDanych->pobierzDane('uprawnienia_id','uzytkownik_grupy_uprawnienie','uzytkownik_grupy_id = '.$dane['uzytkownik_grupa_id']);
                    if(!is_null($lista_uprawnien_grupy)){
                        while($poj_lista_uprawnien_grupy = $lista_uprawnien_grupy->fetch_object()){
                            $bazaDanych->wstawDane('uzytkownik_uprawnienie',array(
                                'id_uzytkownika' => $element_id
                                ,'id_uprawnienia' => $poj_lista_uprawnien_grupy->uprawnienia_id
                            ));
                        }
                        $administracjaMain->dodajWpisDoHistorii($bazaDanych, $element_id,'uzytkownik_id', 'Aktualizacja uprawnien z grupy', '', '', 'uzytkownik_historia_zmian');

                    }
                }

                if(array_key_exists('imie',$dane) || array_key_exists('nazwisko',$dane) || array_key_exists('uzytkownik_grupa_id',$dane)){
                    $przeladujWidokZakladki = 1;
                }

                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujSzczegolyElementu = 1;
            break;

        case 'aktualizuj_powiadomienie':
                //if(array_key_exists('czy_aktywny', $dane) && $dane['czy_aktywny'] == '1'){
                    $dane = array_merge($dane, array( 'cookie_id' => md5(date('y-m-d H:i:s').rand())));
                //}

                if(array_key_exists('czy_aktywny', $dane) && $dane['czy_aktywny'] == 1){
                    $powiadomienie_tmp = $bazaDanych->pobierzDane('id','powiadomienia','powiadomienia_rodzaj_id = 1 AND czy_aktywny = 1');
                    if(!is_null($powiadomienie_tmp)){
                        $powiadomienie_tmp = $powiadomienie_tmp->fetch_object();
                        $bazaDanych->aktualizujDane($tabela, array(
                            'czy_aktywny' => 0
                        ), $powiadomienie_tmp->id);
                        $administracjaMain->dodajWpisDoHistorii($bazaDanych, $powiadomienie_tmp->id,'powiadomienia_id', 'Edycja aut. czy_aktywny', '1', '0', 'powiadomienia_historia_zmian');
                    }
                }

                $administracjaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

                $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

                if(array_key_exists('nazwa',$dane) || array_key_exists('powiadomienia_rodzaj_id', $dane) || array_key_exists('czy_aktywny', $dane)){
                    $przeladujWidokZakladki = 1;
                }

                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujSzczegolyElementu = 1;
            break;

        case 'aktualizuj_uzytkownik_grupy':
                if(array_key_exists('czy_domyslna', $dane)){
                    $domyslna = $bazaDanych->pobierzDane('id','uzytkownik_grupy','czy_domyslna = 1');
                    $domyslna = $domyslna->fetch_object();

                    $administracjaMain->porownajZmianyDoHistorii($bazaDanych, $domyslna->id, array('czy_domyslna' => '0'), $tabela);
                    $bazaDanych->aktualizujDane($tabela, array('czy_domyslna' => '0'), $domyslna->id);

                }

                $administracjaMain->porownajZmianyDoHistorii($bazaDanych, $element_id, $dane, $tabela);

                $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

                if(array_key_exists('nazwa',$dane) || array_key_exists('czy_domyslna', $dane)){
                    $przeladujWidokZakladki = 1;
                }

                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujSzczegolyElementu = 1;
            break;

        case 'dodaj_uzytkownika':
                $options = [
                    'cost' => 11,
                    'salt' => '>om5R#Y;Xga>P(5\u/E!h;wF'
                ];

                $haslo_hash = password_hash ( $dane['haslo'], PASSWORD_DEFAULT, $options );
                $dane['haslo'] = $haslo_hash;

                $dane = array_merge($dane, array( 'data_dodania' => 'NOW()'));
                $dane = array_merge($dane, array( 'status' => '1'));

                $uzytkownik_id_tmp = $bazaDanych->wstawDane($tabela, $dane);

                $administracjaMain->dodajWpisDoHistorii($bazaDanych, $uzytkownik_id_tmp,'uzytkownik_id', 'Dodanie użytkownika', '', '', 'uzytkownik_historia_zmian');

                $przeladujWidokZakladki = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $ukryjPopUp1 = 1;

            break;

        case 'dodaj_powiadomienie':
                $dane = array_merge($dane, array( 'cookie_id' => md5(date('y-m-d H:i:s').rand())));
                $dane = array_merge($dane, array( 'uzytkownik_id' => $_SESSION['uzytkownik_id']));

                $powiadomienie_id_tmp = $bazaDanych->wstawDane($tabela, $dane);

                $administracjaMain->dodajWpisDoHistorii($bazaDanych, $powiadomienie_id_tmp,'powiadomienia_id', 'Dodanie powiadomienia', '', '', 'powiadomienia_historia_zmian');

                $przeladujWidokZakladki = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $ukryjPopUp1 = 1;

            break;

        case 'dodaj_uzytkownik_grupy':
                $uzytkownik_grupy_id_tmp = $bazaDanych->wstawDane($tabela, $dane);

                $administracjaMain->dodajWpisDoHistorii($bazaDanych, $uzytkownik_grupy_id_tmp,'uzytkownik_grupy_id', 'Dodanie Grupy', '', '', 'uzytkownik_grupy_historia_zmian');

                $przeladujWidokZakladki = 1;
                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $ukryjPopUp1 = 1;
            break;

        case 'uzytkownik_usun_avatar':
                $avatar_tmp = $bazaDanych->pobierzDane('avatar_link', 'uzytkownik', 'id = '.$element_id);
                $avatar_tmp = $avatar_tmp->fetch_object();

                $komunikat = 'Zmiany zostały anulowane!!!';

                if($avatar_tmp->avatar_link != 'domyslny.png'){
                    $bazaDanych->aktualizujDane($tabela, array( 'avatar_link' => 'domyslny.png' ), $element_id);
                    $administracjaMain->dodajWpisDoHistorii($bazaDanych, $element_id,'uzytkownik_id', 'Edycja avatar', $avatar_tmp->avatar_link, 'domyslny.png', 'uzytkownik_historia_zmian');

                    $_SESSION['uzytkownik_avatar'] = 'domyslny.png';

                    $komunikat = 'Zmiany zostały zapisane!!!';
                    $rodzajOut = 'sukces';
                    $przeladujWidokZakladki = 1;
                }

            break;

        case 'uzytkownik_dodaj_avatar':
                $avatar_tmp = $bazaDanych->pobierzDane('avatar_link', 'uzytkownik', 'id = '.$element_id);
                $avatar_tmp = $avatar_tmp->fetch_object();

                //unlink('/var/www/html/img/avatar/'.$avatar_tmp->avatar_link);

                $plik_tmp = $_FILES ['plik']['tmp_name'];

                $nazwa_pliku = date('dmy_Hms').$_SESSION['uzytkownik_id'].'_avatar.jpg';
                $lokalizacja = '/var/www/html/img/avatar/'.$nazwa_pliku;

                move_uploaded_file ( $plik_tmp, $lokalizacja );

                $_SESSION['uzytkownik_avatar'] = $nazwa_pliku;

                $bazaDanych->aktualizujDane($tabela, array( 'avatar_link' => $nazwa_pliku ), $element_id);
                $administracjaMain->dodajWpisDoHistorii($bazaDanych, $element_id,'uzytkownik_id', 'Edycja avatar', $avatar_tmp->avatar_link, $nazwa_pliku, 'uzytkownik_historia_zmian');

                $komunikat = 'Zmiany zostały zapisane!!!';
                $rodzajOut = 'sukces';
                $przeladujWidokZakladki = 1;
                $przeladujSzczegolyElementu = 1;

            break;

        case 'uzytkownik_wymus_wylogowanie':
                $bazaDanych->aktualizujDane($tabela, array( 'ostatnia_aktywna_sesja' => '0' ), $element_id);
                $administracjaMain->dodajWpisDoHistorii($bazaDanych, $element_id,'uzytkownik_id', 'Wymuszenie wylogowania', '', '', 'uzytkownik_historia_zmian');

                $komunikat = 'Użytkownik został wylogowany!!!';
                $rodzajOut = 'sukces';

            break;

        case 'uzytkownik_przejmij_konto':
                $przejety_uzytkownik = $bazaDanych->pobierzDane('login, id, imie, nazwisko, avatar_link, email, uzytkownik_grupa_id','uzytkownik','id = '.$element_id);
                $przejety_uzytkownik = $przejety_uzytkownik->fetch_object();

                $bazaDanych->aktualizujDane('uzytkownik',array('sesja_przejmujacego' => session_id()),$element_id);
                $administracjaMain->dodajWpisDoHistorii($bazaDanych, $element_id,'uzytkownik_id', 'Przejecie sesji', '', '', 'uzytkownik_historia_zmian');

                $_SESSION ['zalogowany'] = true;
                $_SESSION['uzytkownik_login'] = $przejety_uzytkownik->login;
                $_SESSION['uzytkownik_id'] = $przejety_uzytkownik->id;
                $_SESSION['uzytkownik_imie'] = $przejety_uzytkownik->imie;
                $_SESSION['uzytkownik_nazwisko'] = $przejety_uzytkownik->nazwisko;
                $_SESSION['uzytkownik_avatar'] = $przejety_uzytkownik->avatar_link;
                $_SESSION['uzytkownik_email'] = $przejety_uzytkownik->email;

                $przejety_uzytkownik_grupa = $bazaDanych->pobierzDane('nazwa','uzytkownik_grupy','id = '.$przejety_uzytkownik->uzytkownik_grupa_id);
                $przejety_uzytkownik_grupa = $przejety_uzytkownik_grupa->fetch_object();
                $_SESSION['uzytkownik_grupa'] = $przejety_uzytkownik_grupa->nazwa;
                $_SESSION['uzytkownik_grupa_id'] = $przejety_uzytkownik->uzytkownik_grupa_id;

                $komunikat = 'Przejmowanie sesji użytkownika!!!';
                $rodzajOut = 'sukces';

            break;

        case 'uprawnienia_zapisz_zmiany':{
            $bazaDanych->aktualizujDane($tabela, $dane, $element_id);

            $komunikat = 'Zmiany zostały zapisane!!!';
            $rodzajOut = 'sukces';
            $przeladujSzczegolyElementu = 1;
            $przeladujWidokZakladki = 1;
        }

    }

    $dane = array(
                'rodzaj' => $rodzajOut
                ,'komunikat' => $komunikat
                ,'przeladujWidokZakladki' => $przeladujWidokZakladki
                ,'przeladujSzczegolyElementu' => $przeladujSzczegolyElementu
                ,'ukryjPopUp1' => $ukryjPopUp1

    );

    echo json_encode($dane);
    return;