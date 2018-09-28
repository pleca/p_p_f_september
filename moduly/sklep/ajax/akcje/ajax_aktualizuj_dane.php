<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$sklepMain = new SklepMain($bazaDanych);

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
$przeladujPopUpZakladka = false;
$przeladujPopUp2 = false;

switch ($akcja) {

    case 'dodaj_produkt':
        $produktKategoriaId = $dane['sklep_kategorie_id'];
        unset($dane['sklep_kategorie_id']);

        $produktId_tmp = $bazaDanych->wstawDane('sklep_produkty', $dane);

        $bazaDanych->wstawDane('sklep_produkty_id_sklep_kategorie_id', array(
            'sklep_produkty_id' => $produktId_tmp
            ,'sklep_kategorie_id' => $produktKategoriaId
        ), false);

        $miniaturaName_tmp = $sklepMain->zapiszPlik('miniatura', $_FILES['miniatura']['name'], '/var/www/pliki/!sklep/'.$produktId_tmp);

        $bazaDanych->aktualizujDane('sklep_produkty', array('zdjecie_glowne' => $miniaturaName_tmp), $produktId_tmp);

        $komunikat = SAVE_CHANGES;
        $rodzajOut = SUCCESS;
        $przeladujWidok = true;
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