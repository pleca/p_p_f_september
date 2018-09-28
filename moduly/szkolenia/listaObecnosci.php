<?php


    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

    setlocale(LC_CTYPE, "pl_PL.UTF-8");

    require_once( $_SERVER ['DOCUMENT_ROOT']. 'biblioteki/generator_pdf/vendor/autoload.php');

    $szkolenie_id = htmlspecialchars($_GET['id']);



    $head = '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
    $head .= '<link rel="stylesheet" href="https://' . $_SERVER ['HTTP_HOST'] . '/moduly/szkolenia/css/szkolenia.css" type="text/css" />';
    $head .= '<link rel="stylesheet" href="https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css" type="text/css" />';

    $szkolenie = $bazaDanych->pobierzDane('*', 'szkolenia', 'id = '.$szkolenie_id);
    $szkolenie = $szkolenie->fetch_object();

    $lista_uczestnikow = $bazaDanych->pobierzDane('uzytkownik_id', 'szkolenia_id_uzytkownik_id', 'szkolenia_id = '.$szkolenie_id);

    $ile_na_stronie = 30;
    $ile_stron = ceil(mysqli_num_rows($lista_uczestnikow) / $ile_na_stronie);



    $i = 1;
    $tresc = '';

    for($st=0;$st<($ile_stron); $st++){
        $tresc .= '<div class="stronaPdf strona_'.($st+1).'">';

            $tresc .= '<div class="lo_nazwa_szkolenia">'.$szkolenie->nazwa.' <span class="">'.$szkolenie->data_start.' - '.$szkolenie->data_stop.'</span></div>';
            // $tresc .= '<div class="lo_opis_szkolenia">'.htmlspecialchars_decode($szkolenie->opis).'</div>';

            $tresc .= '<div class="lista_obecnosci_naglowek lo_elementy">';
                $tresc .= '<div class="lon_element" style="width:5%">Lp</div>';
                $tresc .= '<div class="lon_element" style="width:17%">Login</div>';
                $tresc .= '<div class="lon_element" style="width:25%">Imie</div>';
                $tresc .= '<div class="lon_element" style="width:28%">Nazwisko</div>';
                $tresc .= '<div class="lon_element" style="width:25%">Podpis</div>';
                $tresc .= '<div class="clear_b"></div>';
            $tresc .= '</div>';

            $lista_ucz = $bazaDanych->pobierzDane('uzytkownik_id', 'szkolenia_id_uzytkownik_id', 'szkolenia_id = '.$szkolenie_id.' LIMIT '.$ile_na_stronie.' OFFSET '.($st * $ile_na_stronie));
            if(!is_null($lista_ucz)){

                while($poj_lista_uczestnikow = $lista_ucz->fetch_object()){
                    $uczestnik = $bazaDanych->pobierzDane('login,imie,nazwisko', 'uzytkownik', 'id = '.$poj_lista_uczestnikow->uzytkownik_id);
                    $uczestnik = $uczestnik->fetch_object();
                    $tresc .= '<div class="lo_elementy">';
                        $tresc .= '<div class="lon_element" style="width:5%">'.$i.'</div>';
                        $tresc .= '<div class="lon_element" style="width:17%">'.$uczestnik->login.'</div>';
                        $tresc .= '<div class="lon_element" style="width:25%">'.$uczestnik->imie.'</div>';
                        $tresc .= '<div class="lon_element" style="width:28%">'.$uczestnik->nazwisko.'</div>';
                        $tresc .= '<div class="lon_element" style="width:25%">&nbsp;</div>';
                        $tresc .= '<div class="clear_b"></div>';
                    $tresc .= '</div>';
                    $i++;
                }
            }

        $tresc .= '</div>';
        $tresc .= '<div class="lo_stopka_szkolenia"><span class="">str - '.($st+1).'/'.$ile_stron.'</span><div class="clear_b"></div></div>';


    }

    use mikehaertl\wkhtmlto\Pdf;

    $opcje = array(
        'encoding' => 'UTF-8'
    );

    $pdf = new Pdf(array(
        'commandOptions' => array(
            'enableXvfb' => true
            ,'xvfbRunBinary' => 'exec xvfb-run'

        )
    ));

    $pdf->setOptions($opcje);

    $pdf->addPage('<html xmlns="https://www.w3c.org/1999/xhtml" xml:lang="pl" lang="pl"><head>'.$head.'</head><body class="listaObecnosciPdf">'.$tresc.'</body></html>');

    $pdf->send();




