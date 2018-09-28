<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$element_id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : '';
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '';

$tytul = '';
$tresc = '';
$miniatura = '';

$konkursyMain = new KonkursyMain($bazaDanych);

switch ($akcja) {

    case 'historia_wyswietl':
            $id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : '';
            $tytul = 'Historia elementu';

            if($tabela == 'konkurs_dokumenty_historia_zmian'){
                $kolumna = 'konkurs_dokumenty_id';
            }

            if($tabela == 'konkurs_historia_zmian'){
                $kolumna = 'konkurs_id';
            }

            $tresc = $konkursyMain->generujZakladkeHistoria($tabela, $kolumna, $bazaDanych, $id);
        break;

    case 'wyswietl_konkurs':
            $konkurs_tmp = $bazaDanych->pobierzDane('*','konkurs','id = '.$element_id);
            $konkurs_tmp = $konkurs_tmp->fetch_object();

            $tytul = $konkurs_tmp->tytul;

            $tresc .= '<div class="konkursDane">';
                $tresc .= '<ul class="nav nav-tabs" role="tablist">';
                    $tresc .= '<li role="presentation" class="active"><a href="#ogolne" aria-controls="ogolne" role="tab" data-toggle="tab">Ogolne</a></li>';
                    $tresc .= '<li role="presentation"><a href="#dokumenty" aria-controls="dokumenty" role="tab" data-toggle="tab">Dokumenty</a></li>';
                $tresc .= '</ul>';
                $tresc .= '<div class="tab-content">';
                    $tresc .= '<div role="tabpanel" class="tab-pane active konkursZdjecie padding_10" id="ogolne">';
                        $tresc .= '<div class="konkursZdjecieGlowne">';
                            if(!empty($konkurs_tmp->zdjecie_duze)){
                                $grafikaGlowna = $konkurs_tmp->zdjecie_duze;
                            }else{
                                $grafikaGlowna = $konkurs_tmp->miniatura;
                            }
                            $dostepneGrafiki = $bazaDanych->pobierzDane('*', 'konkurs_grafiki', 'czy_usuniety = 0 AND konkurs_id = '.$element_id);
                            if(!is_null($dostepneGrafiki)){
                                $grafikaGrupy_tmp = $bazaDanych->pobierzDane('konkurs_grafiki_id','konkurs_grafiki_id_uzytkownik_grupy_id','uzytkownik_grupy_id = '.$_SESSION['uzytkownik_grupa_id']);
                                if($grafikaGrupy_tmp){
                                    $grafikaGrupy_tmp = $grafikaGrupy_tmp->fetch_object();
                                    $grafikaGrupy = $bazaDanych->pobierzDane('nazwa_pliku','konkurs_grafiki','id = '.$grafikaGrupy_tmp->konkurs_grafiki_id.' AND czy_usuniety = 0 AND konkurs_id = '.$element_id);
                                    if($grafikaGrupy){
                                        $grafikaGrupy = $grafikaGrupy->fetch_object();
                                        $grafikaGlowna = $grafikaGrupy->nazwa_pliku;
                                    }
                                }
                            }

                            $tresc .= $konkursyMain->pobierzZdjecie($element_id, $grafikaGlowna, '');
                        $tresc .= '</div>';
                        $tresc .= '<div class="dodatkoweGrafiki">';
                            if(!is_null($dostepneGrafiki)){
                                if($_SESSION['uzytkownik_grupa_id'] === '1' || $konkursyMain->sprawdzUprawnienie('konkurs_edytuj_swoje')){
                                    while($poj_dostepneGrafiki = $dostepneGrafiki->fetch_object()){
                                        $tresc .= '<div class="miniaturaDodatkowaGrafikaKonkurs">'.$konkursyMain->pobierzZdjecie($element_id, $poj_dostepneGrafiki->nazwa_pliku, 'PrzelaczMiniature cursor_p').'</div>';
                                    }
                                }else{
                                    $listaGrafikDoWczytania = array();
                                    if($_SESSION['uzytkownik_grupa_id'] === '5'){
                                        $grafikaId = $bazaDanych->pobierzDane('konkurs_grafiki_id','konkurs_grafiki_id_uzytkownik_grupy_id','uzytkownik_grupy_id = 5 || uzytkownik_grupy_id = 4 || uzytkownik_grupy_id = 3');
                                        if($grafikaId){
                                            while($poj_grafikaId = $grafikaId->fetch_object()){
                                                $grafikaNazwa_tmp = $bazaDanych->pobierzDane('nazwa_pliku','konkurs_grafiki','id = '.$poj_grafikaId->konkurs_grafiki_id.' AND czy_usuniety = 0 AND konkurs_id = '.$element_id);
                                                if($grafikaNazwa_tmp){
                                                    $grafikaNazwa_tmp = $grafikaNazwa_tmp->fetch_object();
                                                    array_push($listaGrafikDoWczytania,$grafikaNazwa_tmp->nazwa_pliku);
                                                }
                                            }

                                        }
                                    }
                                    if($_SESSION['uzytkownik_grupa_id'] === '4'){
                                        $grafikaId = $bazaDanych->pobierzDane('konkurs_grafiki_id','konkurs_grafiki_id_uzytkownik_grupy_id','uzytkownik_grupy_id = 4 || uzytkownik_grupy_id = 3');
                                        if($grafikaId){
                                            while($poj_grafikaId = $grafikaId->fetch_object()){
                                                $grafikaNazwa_tmp = $bazaDanych->pobierzDane('nazwa_pliku','konkurs_grafiki','id = '.$poj_grafikaId->konkurs_grafiki_id.' AND czy_usuniety = 0 AND konkurs_id = '.$element_id);
                                                if($grafikaNazwa_tmp){
                                                    $grafikaNazwa_tmp = $grafikaNazwa_tmp->fetch_object();
                                                    array_push($listaGrafikDoWczytania,$grafikaNazwa_tmp->nazwa_pliku);
                                                }
                                            }

                                        }
                                    }
                                    $liczbaGrafik = count($listaGrafikDoWczytania);
                                    if($liczbaGrafik > 1){
                                        for($i=0;$i<$liczbaGrafik;$i++){
                                            $tresc .= '<div class="miniaturaDodatkowaGrafikaKonkurs">'.$konkursyMain->pobierzZdjecie($element_id, $listaGrafikDoWczytania[$i], 'PrzelaczMiniature cursor_p').'</div>';
                                        }
                                    }

                                }
                            }
                            $tresc .= '<div class="clear_b"></div>';
                        $tresc .= '</div>';

                        if(!empty($konkurs_tmp->opis)){
                            $tresc .= '<div class="well well-sm margin_b_0 margin_t_10">'.$_SESSION['uzytkownik_grupa_id'].htmlspecialchars_decode($konkurs_tmp->opis).'</div>';
                        }
                    $tresc .= '</div>';
                    $tresc .= '<div role="tabpanel" class="tab-pane padding_10 scrollX" id="dokumenty">';

                        $tresc .= $konkursyMain->generujListeDokumentow($_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id'], $element_id);

                    $tresc .= '</div>';
                $tresc .= '</div>';
            $tresc .= '</div>';

        break;

    case 'wyswietl_dodaj_uprawnienie_uzytkownik':
            $tytul = 'Dodaj uprawnienie';
            $tresc = $konkursyMain->wczytajWidok('/var/www/html/moduly/konkursy/ajax/widoki/elementy/widok_dodaj_uprawnienie_uzytkownik.php',array(
                'elementId' => $element_id
                ,'tabela' => $tabela
            ));
        break;

    case 'wyswietl_ranking':
            $grupa = (isset($_POST['grupa'])) ? htmlspecialchars($_POST['grupa']) : '';
            $rodzic = (isset($_POST['rodzic'])) ? htmlspecialchars($_POST['rodzic']) : '';
            $dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;
            $tresc = $konkursyMain->generujRanking($dane['poczatek'], $dane['koniec'], $grupa, $rodzic);
        break;

    case 'wswietl_dodaj_grafike':
            $tytul = 'Nowa grafika';
            $tresc = $konkursyMain->wczytajWidok('/var/www/html/moduly/konkursy/ajax/widoki/elementy/widok_dodaj_grafike.php',array(
                'element_id' => $element_id
                ,'tabela' => $tabela
            ));
        break;

    case 'wswietl_edytuj_grafike':
            $grafika_tmp = $bazaDanych->pobierzDane('*','konkurs_grafiki','id = '.$element_id);
            $grafika_tmp = $grafika_tmp->fetch_object();

            $tytul = 'Edycja grafiki';
            $tresc = $konkursyMain->wczytajWidok('/var/www/html/moduly/konkursy/ajax/widoki/elementy/widok_edytuj_grafike.php',array(
                'grafika' => $grafika_tmp
            ));
        break;

    case 'edytuj_konkurs':
            $konkurs_tmp = $bazaDanych->pobierzDane('*','konkurs','id = '.$element_id);
            $konkurs_tmp = $konkurs_tmp->fetch_object();

            $tytul = '<div class="edytujKonkursNaglowek">';
                if($konkursyMain->sprawdzUprawnienie('konkurs_usun')){
                    $tytul .= '<i class="fa fa-trash margin_r_5" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$element_id.'\' data-reakcja=\'usun\' data-tabela=\'konkurs\' type=\'button\' class=\'btn btn-danger usunPrzywrocElement usunTak usunKonkurs\'>TAK</button>"></i>';
                }
            $tytul .= '<span>Edycja konkursu</span></div>';
            $tresc = $konkursyMain->wczytajWidok('/var/www/html/moduly/konkursy/ajax/widoki/elementy/widok_edytuj_konkurs.php',array(
                'konkurs' => $konkurs_tmp
            ));
        break;

    case 'edytuj_dokument':
            $dokument_tmp = $bazaDanych->pobierzDane('*','konkurs_dokumenty','id = '.$element_id);
            $dokument_tmp = $dokument_tmp->fetch_object();

            $tytul = 'Edytuj dokument';
            $tresc = $konkursyMain->wczytajWidok('/var/www/html/moduly/konkursy/ajax/widoki/elementy/widok_edytuj_dokument.php',array(
                'dokument' => $dokument_tmp
            ));

        break;

    case 'dodaj_dokument':
            $tytul = 'Nowy dokument';
            $tresc = $konkursyMain->wczytajWidok('/var/www/html/moduly/konkursy/ajax/widoki/elementy/widok_dodaj_dokument.php');
        break;

    case 'dodaj_konkurs':
            $tytul = 'Nowy konkurs';
            $tresc = $konkursyMain->wczytajWidok('/var/www/html/moduly/konkursy/ajax/widoki/elementy/widok_dodaj_konkurs.php');
        break;


}

$arrayOut = array(
    'tytul' => $tytul
    ,'tresc' => $tresc
    ,'miniatura' => $miniatura
);

echo json_encode($arrayOut);
return;