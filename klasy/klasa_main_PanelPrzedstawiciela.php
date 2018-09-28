<?php


class main_PanelPrzedstawiciela{
    private $_bd;
    private $_uzytkownikId;
    private $_uzytkownikGrupaId;
    private $_listaPowiadomien = array();
    private $_listaPrzyznanychPowiadomien = array();

    private function pobierzListePowiadomien(){
        if($this->_uzytkownikGrupaId === '1' || $this->sprawdzUprawnienie('administracja_powiadomienia_edytuj') || $this->sprawdzUprawnienie('administracja_powiadomienia_edytuj_wszystkie')){
            $listaElementow_tmp = $this->_bd->pobierzDane('id', 'powiadomienia','czy_usuniety = 0');
            if(!is_null($listaElementow_tmp)){
                while($poj_listaElementow_tmp = $listaElementow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychPowiadomien, $poj_listaElementow_tmp->id);
                }
            }
        }else{
            $listaElementow_tmp = $this->_bd->pobierzDane('powiadomienia_id', 'powiadomienia_id_uzytkownik_id','uzytkownik_id = '.$this->_uzytkownikId);
            if(!is_null($listaElementow_tmp)){
                while($poj_listaElementow_tmp = $listaElementow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychPowiadomien, $poj_listaElementow_tmp->powiadomienia_id);
                }
            }

            $listaElementow_tmp = $this->_bd->pobierzDane('powiadomienia_id', 'powiadomienia_id_uzytkownik_grupy_id','uzytkownik_grupy_id = '.$this->_uzytkownikGrupaId);
            if(!is_null($listaElementow_tmp)){
                while($poj_listaElementow_tmp = $listaElementow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychPowiadomien, $poj_listaElementow_tmp->powiadomienia_id);
                }
            }
            $listaElementow_tmp = $this->_bd->pobierzDane('id', 'powiadomienia','uzytkownik_id = '.$_SESSION['uzytkownik_id']);
            if(!is_null($listaElementow_tmp)){
                while($poj_listaElementow_tmp = $listaElementow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychPowiadomien, $poj_listaElementow_tmp->id);
                }
            }
        }

        $this->_listaPrzyznanychPowiadomien = array_unique($this->_listaPrzyznanychPowiadomien);
        $listaWszystkichElementow_tmp = $this->_bd->pobierzDane('id', 'powiadomienia','czy_usuniety = 0 AND czy_aktywny = 1', 'kolejnosc ASC');
        if(!is_null($listaWszystkichElementow_tmp)){
            while($poj_lwk_tmp = $listaWszystkichElementow_tmp->fetch_object()){
                if(in_array($poj_lwk_tmp->id, $this->_listaPrzyznanychPowiadomien)){
                    array_push($this->_listaPowiadomien, $poj_lwk_tmp->id);
                }
            }
        }

    }

    public function wygenerujListePowiadomien($kuzytkownikId, $kuzytkownikGrupaId, $bazaDanych){
        $this->_bd = $bazaDanych;
        $this->_uzytkownikId = $kuzytkownikId;
        $this->_uzytkownikGrupaId = $kuzytkownikGrupaId;

        $this->pobierzListePowiadomien();

        return $this->_listaPowiadomien;
    }

    public function adresStrony(){
        return 'https://' . $_SERVER ['HTTP_HOST'] . '/';
    }
    public function pobierzListeUprawnien($kuzytkownik_id, $polaczenie_do_bazy){

        $_SESSION['_listaUprawnien'] = array();

        $listaUprawnien_tmp = $polaczenie_do_bazy->pobierzDane('id_uprawnienia', 'uzytkownik_uprawnienie', 'id_uzytkownika = '.$kuzytkownik_id);
        $i = 0;
        if(!is_null($listaUprawnien_tmp)){
            while($poj_listaUprawnien_tmp = $listaUprawnien_tmp->fetch_object()){
                $nazwa_uproszczona_tmp = $polaczenie_do_bazy->pobierzDane('nazwa_uproszczona', 'uprawnienia', 'id = '.$poj_listaUprawnien_tmp->id_uprawnienia);

                if(!is_null($nazwa_uproszczona_tmp)){
                    $nazwa_uproszczona_tmp = $nazwa_uproszczona_tmp->fetch_object();
                    if(!empty($nazwa_uproszczona_tmp->nazwa_uproszczona)){
                        $_SESSION['_listaUprawnien'][$i] = $nazwa_uproszczona_tmp->nazwa_uproszczona;
                        $i++;
                    }
                }
            }
        }
    }

    public function sprawdzUprawnienie($kuprawnienie_nazwa_uproszczona){
        $dostep = false;

        if(in_array($kuprawnienie_nazwa_uproszczona, $_SESSION['_listaUprawnien'])){
            $dostep = true;
        }

        return $dostep;
    }

    public function utnijSlowa($string,$words=20,$ellipsis=' ...') {

        $word_arr = explode(" ", $string);

        if (count($word_arr) > $words) {
            $words = implode(" ", array_slice($word_arr , 0, $words) ) . $ellipsis;
            return $words;
        }

        return $string;

    }

    public function usunTagiHTML($string){
        $stringNew = preg_replace('/<(|\/)(?!\?).*?(|\/)>/','',strip_tags(htmlspecialchars_decode($string)));
        return $stringNew;
    }

    public function generujZakladkeHistoria($historia_element, $kolumna, $db, $element_id){

        return $trescOut = $this->wczytajWidok('/home/user/public_html/umowy/ajax/widoki/elementy/widok_historia_elementu.php',array(
            'kolumna' => $kolumna
            ,'elementId' => $element_id
            ,'historiaElement' => $historia_element
        ));
    }

    public function porownajZmianyDoHistorii($kbd, $kelement_id, $kdane, $ktabela){
        if(strpos($ktabela, 'umowa') === false){
            $elementNaBazie = $kbd->pobierzDane('*', $ktabela, 'Id = '.$kelement_id);
        }else{
            $elementNaBazie = $kbd->pobierzDane('*', $ktabela, 'id = '.$kelement_id);
        }

        $elementNaBazie = $elementNaBazie->fetch_object();

        foreach($kdane as $klucz => $wartosc){
            $war_przed = htmlspecialchars_decode($elementNaBazie->$klucz);
            if(htmlspecialchars_decode($elementNaBazie->$klucz) == ''){
                $war_przed = 'null';
            }
            $war_po = htmlspecialchars_decode($wartosc);

            if($war_przed != $war_po){

                $this->dodajWpisDoHistorii($kbd, $kelement_id, $ktabela.'_id', 'Edycja '.$klucz, $war_przed, $war_po , $ktabela.'_historia_zmian');

                if($ktabela === 'umowaBankowa'){
                    $umowa_id_tmp = $kbd->pobierzDane('UmowaId', $ktabela,'Id = '.$kelement_id);
                    $umowa_id_tmp = $umowa_id_tmp->fetch_object();
                    $this->dodajWpisDoHistorii($kbd, $umowa_id_tmp->UmowaId, 'umowa_id', 'Edycja '.$klucz, $war_przed, $war_po , 'umowa_historia_zmian');
                }
            }

        }
    }

    public function dodajWpisDoHistorii($kdb, $id_ftmp, $dotyczy_id_ftmp, $akcja_ftmp, $wprz_ftmp, $wpo_ftmp , $tabela_ftmp){
        $historiaDane = array(
            $dotyczy_id_ftmp => $id_ftmp
        ,'data_zmiany' => 'NOW()'
        ,'akcja' => $akcja_ftmp
        ,'wartosc_przed' => $wprz_ftmp
        ,'wartosc_po' => $wpo_ftmp
        ,'adres_ip' => $_SERVER['REMOTE_ADDR']
        ,'zmiany_dokonal' => $_SESSION['uzytkownik_id']
        );

        $kdb->wstawDane($tabela_ftmp, $historiaDane);

    }

    public function wylosujLiczbyZakres($kzakres, $kile){
        $liczby = array();
        $zakres = $kzakres - 1;

        for ($i=0 ; $i<$kile ; ) {
            $liczby[$i] = rand(0,$zakres);
            for ($j=0 ; $j<$i ; ++$j){
                if ( $liczby[$j] == $liczby[$i] ) {
                    --$i;
                }
            }
            ++$i;
        }

        return $liczby;
    }

    public function zapiszPlik($kform_nazwa, $knazwa, $klokalizacja){

        if(!file_exists($klokalizacja)){
            mkdir($klokalizacja, 0777);
        }

        if(isset($_FILES[$kform_nazwa])){
            $knazwa = explode('.', $knazwa);
            $miniatura_nazwa = substr(md5(date('dmYHisu').rand().$_FILES [$kform_nazwa]['size'].$_FILES [$kform_nazwa]['name']), 0, 20).'.'.end($knazwa);
            move_uploaded_file ( $_FILES [$kform_nazwa]['tmp_name'], $klokalizacja.'/'.$miniatura_nazwa );
        }

        return $miniatura_nazwa;
    }

    public function wyslijWiadomoscEmail($ktemat, $ktresc, $kodbiorca, $knadawca_email, $knadawca_nazwa, $zalaczniki, $dodajLogo = false){

        $rezultat = 1;
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
        $mail->From = $knadawca_email;
        $mail->FromName = $knadawca_nazwa;
        $mail->AddAddress($kodbiorca);
        $mail->IsHTML(SMTP_HTML);
        $mail->Subject = $ktemat;
        $mail->Body = $ktresc;

        if(count($zalaczniki) != 0){
            for($j=0;$j<count($zalaczniki);$j++){
                $mail->AddAttachment($_SERVER ['DOCUMENT_ROOT'].'moduly/szkolenia/tmp/'.$zalaczniki[$j]);
            }
        }
        if($dodajLogo){
            $mail->AddEmbeddedImage($_SERVER ['DOCUMENT_ROOT'].'/img/logo.png', "mojelogo", 'logo.png');
        }



        if (!$mail->Send()) {
            $rezultat = 0;
            $komunikat = $mail->ErrorInfo;
        }

        return $dane = array(
            'rezultat' => $rezultat,
            'komunikat' => $komunikat

        );

    }

    public function zaladujBiblioteki($kzaladujJS = true, $panelLogowania = false){
        if($kzaladujJS){
            echo '<script class="skryptJs" type="text/javascript" src="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/bootstrap/js/bootstrap.js"></script>';
            echo '<script class="skryptJs" type="text/javascript" src="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/bootstrap/js/npm.js"></script>';
            echo '<script class="skryptJs" type="text/javascript" src="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/fullcalendar/moment.js"></script>';
            echo '<script class="skryptJs" type="text/javascript" src="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/datatables/dataTables.js"></script>';
            echo '<script class="skryptJs" type="text/javascript" src="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/datatables/dataTables.bootstrap.min.js"></script>';
            echo '<script class="skryptJs" type="text/javascript" src="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/fullcalendar/fullcalendar.js"></script>';
            echo '<script class="skryptJs" type="text/javascript" src="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/fullcalendar/locale/pl.js"></script>';
            echo '<script class="skryptJs" type="text/javascript" src="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/bootstrap/js/bootstrap-datetimepicer.js"></script>';
        }

        echo '<link rel="stylesheet" href="https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css" type="text/css" />';
        if(!$panelLogowania) {
            echo '<link rel="stylesheet" href="https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/fullcalendar/fullcalendar.css" type="text/css" />';
            echo '<link rel="stylesheet" href="https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/datatables/dataTables.bootstrap.css" type="text/css" />';
            echo '<link rel="stylesheet" href="https://'.$_SERVER ['HTTP_HOST'].'/biblioteki/bootstrap/css/bootstrap-datetimepicker.css" />';

        }
        echo '<link rel="stylesheet" href="https://' . $_SERVER ['HTTP_HOST'] . '/css/animate.css" type="text/css" />';
        echo '<link rel="stylesheet" href="https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/fontawsome/css/font-awesome.css" type="text/css" />';

    }

    public function listaPrzyznanychModulow($kuzytkownik_id, $kbd){
        $array = array();

        $listaModulow = $kbd->pobierzDane('*', 'uprawnienia_grupy', 'czy_usuniety = 0', 'nr_kolejnosci ASC');
        $i = 0;
        while($poj_listaModulow = $listaModulow->fetch_object()){
            $czyDostep = $kbd->pobierzDane('id_uprawnienia','uzytkownik_uprawnienie','id_uzytkownika = '.$kuzytkownik_id.' AND id_uprawnienia = '.$poj_listaModulow->uprawnienia_id);
            if(!empty($czyDostep)){

                $array[$i] = array(
                    'id' => $poj_listaModulow->id
                    ,'nazwa_grupy' => $poj_listaModulow->nazwa_grupy
                    ,'nazwa_krotka' => $poj_listaModulow->nazwa_krotka
                    ,'nazwa_uproszczona' => $poj_listaModulow->nazwa_uproszczona
                    ,'ikona' => $poj_listaModulow->ikona
                );

                    $i++;
            }
        }

        return $array;
    }

    public function wyswietlNaglowek($kpanel_logowania = false, $ktytul){
            echo '<div class="naglowekStronyTyl col-lg-12 col-md-12 col-sm-12 col-xs-12 margin_b_50"></div>';
            echo '<div class="naglowekStrony affix col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_t_10 padding_b_10 z_index_5">';
                echo ($kpanel_logowania) ? '' : '<div class="czasTrwaniaSesji  position_absolute" ><i class="fa fa-refresh odswierzSesje color_fff margin_r_5" aria-hidden="true"></i><span class="czasTrwaniaSesjiZegar color_fff" data-czas_sesji="20">20 min. do zakończenia sesji</span></div>';
                echo '<p class="text-uppercase margin_b_0 text-center color_fff tytulStrony">' . $ktytul . '</p>';
            echo '</div>';

            echo '<div class="col-md-12 naglowekLogo text-right margin_b_10 margin_t_10"><a href="https://' . $_SERVER ['HTTP_HOST'] . '/"><img src="https://' . $_SERVER ['HTTP_HOST'] . '/img/logo.png" /></a></div>';
            echo '<div class="clear_b"></div>';
    }

    public function wyswietlStopke($kpanel_logowania = false){
        echo '<div class="stopkaStronyTyl col-lg-12 col-md-12 col-sm-12 col-xs-12 margin_b_40"></div>';
        echo '<div class="stopkaStrony affix col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_t_10 padding_b_10 z_index_4 margin_t_20">';
            echo '<p class="text-uppercase margin_b_0 text-center color_fff">© Copyright 2017 VOTUM S.A.</p>';
            echo '<div class="wersja color_fff position_absolute">V '.VERSION_NUMBER.'</div>';
        echo '</div>';

        echo '<div id="popUp" class="modal fade bs-example-modal-lg " data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display:none;">';
            echo '<div class="modal-dialog animujModal1 modal-dialog1" role="document">';
                echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        echo '<h5 id="popUpTytul" class="modal-title" >Modal title</h5>';
                    echo '</div>';
                    echo '<div id="popUpImg"></div>';
                    echo '<div id="popUpTresc" class="modal-body"></div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        if($kpanel_logowania){
            return;
        }

        echo '<div id="popUp2" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display:none;">';
            echo '<div class="modal-dialog modal-dialog2 animuj" role="document">';
                echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    echo '<h5 id="popUpTytul2" class="modal-title" >Modal title</h5>';
                    echo '</div>';
                    echo '<div id="popUpImg2"></div>';
                    echo '<div id="popUpTresc2" class="modal-body"></div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div id="popUp3" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display:none;">';
            echo '<div class="modal-dialog modal-dialog3 animujModal3" role="document">';
                echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        echo '<h5 id="popUpTytul3" class="modal-title" >Modal title</h5>';
                    echo '</div>';
                    echo '<div id="popUpImg3"></div>';
                    echo '<div id="popUpTresc3" class="modal-body"></div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }

    public function wczytajZawartoscPliku($kurl, $kdane){
        $options = array('http' => array(
            'method'  => 'POST',
            'content' => http_build_query($kdane)
        ));

        $context  = stream_context_create($options);
        $result = file_get_contents($kurl, false, $context);

        return $result;
    }

    public function wczytajWidok($kurl, $widokDane = array()){
        ob_start();
            extract($widokDane);
            if (strpos($kurl, '/var/www/html/') !== false) {
                $kurl = str_replace("/var/www/html/","/home/user/public_html/umowy/",$kurl);
            }
            require $kurl;
            $result = ob_get_contents();
        ob_end_clean();

        return $result;

    }

    public function widocznoscGrupyUzytkownikow($listaGrupPrzyznanych, $tabela, $kolumna, $element_id){
        return $this->wczytajWidok('/home/user/public_html/umowy/ajax/widoki/elementy/widok_widocznosc_grupy.php',array(
            'listaGrupPrzyznanych' => $listaGrupPrzyznanych
            ,'tabela' => $tabela
            ,'kolumna' => $kolumna
            ,'element_id' => $element_id
        ));
    }

    public function widocznoscUzytkownikow($listaUzytkownikow, $tabela, $kolumna, $element_id, $widok_edycja, $szczegoly_elementu = false){
        return $this->wczytajWidok('/home/user/public_html/umowy/ajax/widoki/elementy/widok_widocznosc_uzytkownikow.php',array(
            'listaUzytkownikow' => $listaUzytkownikow
            ,'tabela' => $tabela
            ,'kolumna' => $kolumna
            ,'element_id' => $element_id
            ,'widok_edycja' => $widok_edycja
            ,'szczegoly_elementu' => $szczegoly_elementu
        ));
    }

    public function generujGUID(){
        if (function_exists('com_create_guid') === true){
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    protected function wyslijSMS($knumerTlefonu, $ktres){
        $guid = $this->generujGUID();

        $url = 'http://192.168.1.38:8888/RestWCFServiceLibrarySMS/SaveSmsFromJson';

        $data = array(
            'Prefix'      => 'Panel',
            'PhoneNumber'    => $knumerTlefonu,
            'SmsMessage'    => $ktres,
            'Guid'		=> $guid,
            'Language'	=> '7-bit',
            'ClientAddressIp'	=> $_SERVER['SERVER_ADDR'],
            'YesOrNo' => 'Yes'
            ,'EndpointSmsSenderSystem' => 1
            ,'OriginatorPhoneNumber' => 'VOTUM'

        );

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
            )
        );

        $context  = stream_context_create( $options );

        $result = file_get_contents( $url, false, $context );

        $result = json_decode($result, true);
        $result['guid'] = $guid;

        return $result;

    }

    public function pdf_merger(){
        require_once($_SERVER ['DOCUMENT_ROOT'].'biblioteki/PDFMerger/PDFMerger.php');

        $pdf = new PDFMerger;

        $pdf->addPDF('/var/www/pliki/!druki/102/1498659091_pouczenie.pdf', 'all')
            ->addPDF('/var/www/pliki/!druki/102/1498659091_pouczenie.pdf', 'all')
            ->merge('file', '/var/www/pliki/!druki/102/TEST_0.pdf');
    }

}