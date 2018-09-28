<?php

    require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');
    $administracjaMain = new AdministracjaMain();

?>
    <div class="well well-sm margin_b_10 histroiaRejestracjiFiltry">
        <div class="form-group col-md-2 padding_l_0 margin_b_10">
            <input type="text" class="form-control height_40 text-center prm wymagane paginationScope poleLiczbowe histroiaRejestracjiFiltrujEnter" data-kolumna="paginationScope" placeholder="liczba wyników" value="100">
        </div>
        <div class="form-group col-md-5 padding_l_0 margin_b_10">
            <input type="text" class="form-control height_40 prm duzeMaleLiteryCyfry histroiaRejestracjiFiltrujEnter" data-kolumna="agentName" placeholder="Imię lub nazwisko" value="">
        </div>
        <div class="form-group col-md-5 padding_l_0 margin_b_10 padding_r_0">
            <input type="text" class="form-control height_40 prm duzeMaleLiteryCyfry histroiaRejestracjiFiltrujEnter" data-kolumna="agentNumber" placeholder="Numer agenta" value="">
        </div>
        <button type="button" class="btn btn-success width_100 height_40 histroiaRejestracjiFiltruj">Filtruj</button>
        <div class="clear_b"></div>
    </div>
<div class="panel panel-default ">
    <div id="historiaRejestracjiTabelaWynikow" class="panel-body historiaRejestracjiTabelaWynikow ">
        <?php require_once 'elementy/widok_tabelka_historia_rejestracji.php';?>
    </div>
</div>


