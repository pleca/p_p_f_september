<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$mainPanelPrzedstawiciela = new main_PanelPrzedstawiciela($bazaDanych);

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '' ;
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '' ;
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
$dane = (isset($_POST['dane'])) ? json_decode($_POST['dane'],true) : '' ;

$komunikat = EMPTY_ACTION;
$rodzajOut = ERROR;
$przeladujWidok = false;
$ukryjPopUp1 = false;
$ukryjPopUp2 = false;
$przeladujPopUp = false;
$przeladujPopUpZakladka = null;
$przeladujPopUp2 = false;

switch ($akcja) {
    case 'dodaj_usun_uprawnienie_grupy':
            $kolumna = (isset($_POST['kolumna'])) ? htmlspecialchars($_POST['kolumna']) : '' ;
            $grupa_id = (isset($_POST['grupa_id'])) ? htmlspecialchars($_POST['grupa_id']) : '' ;
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;

            if($reakcja === 'dodaj'){
                $bazaDanych->wstawDane($tabela,array(
                    $kolumna => $element_id
                    ,'uzytkownik_grupy_id' => $grupa_id
                ));
                $komunikat = 'Nadanie uprawnienia';
            }

            if($reakcja === 'usun'){
                $bazaDanych->deleteDane($tabela,$kolumna.' = '.$element_id.' AND uzytkownik_grupy_id = '.$grupa_id);
                $komunikat = 'Usunięcie uprawnienia';
            }

            $tabela_his = str_replace('_id','',$kolumna);

            $grupa_tmp = $bazaDanych->pobierzDane('nazwa','uzytkownik_grupy','id = '.$grupa_id);
            $grupa_tmp = $grupa_tmp->fetch_object();

            $mainPanelPrzedstawiciela->dodajWpisDoHistorii($bazaDanych,$element_id,$kolumna,$komunikat,'Grupa:',$grupa_tmp->nazwa,$tabela_his.'_historia_zmian');

            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'dodaj_usun_uprawnienie_uzytkownika':
            $kolumna = (isset($_POST['kolumna'])) ? htmlspecialchars($_POST['kolumna']) : '' ;
            $uzytkownik_id = (isset($_POST['uzytkownik_id'])) ? htmlspecialchars($_POST['uzytkownik_id']) : '' ;
            $reakcja = (isset($_POST['reakcja'])) ? htmlspecialchars($_POST['reakcja']) : '' ;

            $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko','uzytkownik','id = '.$uzytkownik_id);
            $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();

            if($reakcja === 'dodaj'){
                $komunikat = 'Nadanie uprawnienia';

                if($tabela === 'uzytkownik_uprawnienie'){
                    $bazaDanych->wstawDane($tabela,array(
                        $kolumna => $element_id
                        ,'id_uzytkownika' => $uzytkownik_id
                    ));
                    $mainPanelPrzedstawiciela->dodajWpisDoHistorii($bazaDanych,$uzytkownik_id,'uzytkownik_id',$komunikat,'',$element_id,'uzytkownik_historia_zmian');

                }else{
                    $bazaDanych->wstawDane($tabela,array(
                        $kolumna => $element_id
                        ,'uzytkownik_id' => $uzytkownik_id
                    ));
                    $tabela_his = str_replace('_id','',$kolumna);
                    $mainPanelPrzedstawiciela->dodajWpisDoHistorii($bazaDanych,$element_id,$kolumna,$komunikat,'Uzytkownik:',$uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko,$tabela_his.'_historia_zmian');
                }
            }

            if($reakcja === 'usun'){
                $komunikat = 'Usunięcie uprawnienia';

                if($tabela === 'uzytkownik_uprawnienie'){
                    $bazaDanych->deleteDane($tabela,$kolumna.' = '.$element_id.' AND id_uzytkownika = '.$uzytkownik_id);
                    $mainPanelPrzedstawiciela->dodajWpisDoHistorii($bazaDanych,$uzytkownik_id,'uzytkownik_id',$komunikat,$element_id,'','uzytkownik_historia_zmian');

                }else{
                    $bazaDanych->deleteDane($tabela,$kolumna.' = '.$element_id.' AND uzytkownik_id = '.$uzytkownik_id);
                    $tabela_his = str_replace('_id','',$kolumna);
                    $mainPanelPrzedstawiciela->dodajWpisDoHistorii($bazaDanych,$element_id,$kolumna,$komunikat,'Uzytkownik:',$uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko,$tabela_his.'_historia_zmian');
                }
            }

            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

    case 'nadaj_uprawnienia_dla_wszystkich_w_grupie':

            foreach($dane as $uzytkownik_id){
                $bazaDanych->wstawDane('uzytkownik_uprawnienie',array(
                    'id_uprawnienia' => $element_id
                    ,'id_uzytkownika' => $uzytkownik_id
                ));
                $mainPanelPrzedstawiciela->dodajWpisDoHistorii($bazaDanych,$uzytkownik_id,'uzytkownik_id','Nadanie uprawnienia','',$element_id,'uzytkownik_historia_zmian');
            }

            $komunikat = SAVE_CHANGES;
            $rodzajOut = SUCCESS;
        break;

}

$arrayOut = array(
    'rodzaj' => $rodzajOut
    ,'komunikat' => $komunikat
    ,'przeladujWidok' => $przeladujWidok
    ,'ukryjPopUp' => $ukryjPopUp1
    ,'ukryjPopUp2' => $ukryjPopUp2
    ,'przeladujPopUp' => $przeladujPopUp
    ,'przeladujPopUp2' => $przeladujPopUp2
    ,'przeladujPopUpZakladka' => $przeladujPopUpZakladka

);

echo json_encode($arrayOut);
return;