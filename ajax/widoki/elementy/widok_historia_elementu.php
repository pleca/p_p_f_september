<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
    $bazaDanych = new main_BazaDanych();

    $historia_element = $widokDane['historiaElement'];
    $kolumna = $widokDane['kolumna'];
    $element_id = $widokDane['elementId'];

?>
<div class="well well-sm historiaElementuFiltry margin_b_10">
    <div class="form-group col-md-3 padding_l_0 margin_b_10">
        <input class="form-control height_40 text-center prm wymagane liczbaWynikow histroiaElementuFiltrujEnter poleLiczbowe" data-kolumna="top" placeholder="liczba wyników" value="100" type="text">
    </div>
    <div class="form-group col-md-9 padding_l_0 margin_b_10 padding_r_0">
        <input class="form-control height_40 prm histroiaElementuFiltrujEnter duzeMaleLiteryCyfry" data-kolumna="akcja" placeholder="Akcja" value="" type="text">
    </div>
    <div class="form-group col-md-4 padding_l_0 margin_b_10">
        <input class="form-control height_40 prm histroiaElementuFiltrujEnter duzeMaleLiteryCyfry" data-kolumna="wartosc_przed" placeholder="Wartość przed" value="" type="text">
    </div>
    <div class="form-group col-md-4 padding_l_0 margin_b_10">
        <input class="form-control height_40 prm histroiaElementuFiltrujEnter duzeMaleLiteryCyfry" data-kolumna="wartosc_po" placeholder="Wartość po" value="" type="text">
    </div>
    <div class="form-group col-md-2 padding_l_0 margin_b_10">
        <input class="form-control height_40 prm histroiaElementuFiltrujEnter duzeMaleLiteryCyfry" data-kolumna="adres_id" placeholder="Adres IP" value="" type="text">
    </div>
    <div class="form-group col-md-2 padding_l_0 margin_b_10 padding_r_0">
        <input class="form-control height_40  text-center prm datePicker histroiaElementuFiltrujEnter" data-kolumna="data_zmiany" placeholder="Data zmiany" value="" type="text">
    </div>
    <div class="clear_b"></div>
    <button type="button" data-historia_element="<?php echo $historia_element; ?>" data-kolumna="<?php echo $kolumna; ?>" data-element_id="<?php echo $element_id; ?>" class="btn btn-success width_100 height_40 histroiaElementuFiltruj">Filtruj</button>
</div>
<div class="panel panel-default margin_b_0">
    <div id="historiaElementuTabelaWynikow" class="panel-body historiaElementuTabelaWynikow" >
        <?php require_once 'widok_tabela_historia_elementu.php';?>
    </div>
</div>
