<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');
    $administracjaMain = new AdministracjaMain();
?>
<div class="well well-sm margin_b_10 histroiaLogowanFiltry">
    <div class="form-group col-md-2 padding_l_0 margin_b_10">
        <input type="text" class="form-control height_40 text-center prm wymagane liczbaTop histroiaLogowanFiltrujEnter" data-kolumna="top" placeholder="liczba wyników" value="100">
    </div>
    <div class="form-group col-md-3 padding_l_0 margin_b_10">
        <input type="text" class="form-control height_40 text-center prm datePicker histroiaLogowanFiltrujEnter" data-kolumna="data_zmiany" placeholder="Data logowania" value="">
    </div>
    <div class="form-group col-md-7 padding_l_0 margin_b_10 padding_r_0">
        <input type="text" class="form-control height_40 prm histroiaLogowanFiltrujEnter" data-kolumna="akcja" placeholder="Komunikat" value="">
    </div>
    <button type="button" class="btn btn-success width_100 height_40 histroiaLogowanFiltruj">Filtruj</button>
    <div class="clear_b"></div>
</div>
<div class="panel panel-default ">
    <div id="histroiaLogowanTabelaWynikow" class="panel-body histroiaLogowanTabelaWynikow ">
        <?php require_once 'elementy/widok_tabela_historia_logowan.php';?>
    </div>
</div>