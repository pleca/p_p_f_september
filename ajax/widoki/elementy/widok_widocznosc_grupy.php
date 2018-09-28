<?php
    session_start();

    $bazaDanych = new main_BazaDanych();
    $mainPanel = new main_PanelPrzedstawiciela($bazaDanych);

    $listaGrupPrzyznanych = $widokDane['listaGrupPrzyznanych'];
    $tabela = $widokDane['tabela'];
    $kolumna = $widokDane['kolumna'];
    $element_id = $widokDane['element_id'];

?>
<div class="panel panel-default margin_b_10 ">
    <div class="panel-heading">Grupy użytkowników</div>
    <div class="panel-body padding_b_0 padding_r_0">
        <?php
        if($_SESSION['uzytkownik_grupa_id'] === '1'){
            $listaGrupUzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik_grupy','czy_usuniety = 0');
        }else{
            $listaGrupUzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik_grupy','czy_usuniety = 0 AND id != 1');
        }

        $listaGrupPrzyznanych_array = array();

        if(!is_null($listaGrupPrzyznanych)){
            while($poj_listaGrupPrzyznanych = $listaGrupPrzyznanych->fetch_object()){
                array_push($listaGrupPrzyznanych_array, $poj_listaGrupPrzyznanych->uzytkownik_grupy_id);
            }
        }

        while($poj_listaGrupUzytkownikow = $listaGrupUzytkownikow->fetch_object()){
            echo '<div class=" col-md-3 col-xs-6 padding_l_0">';
            echo '<div class="well well-sm margin_b_15">'.$poj_listaGrupUzytkownikow->nazwa.'<i class="fa fa-'.((in_array($poj_listaGrupUzytkownikow->id,$listaGrupPrzyznanych_array)) ? 'check-' : '' ).'square-o float_r elementDodajUsunUprawnienieGrupy" data-tabela="'.$tabela.'" data-kolumna="'.$kolumna.'" data-grupa_id="'.$poj_listaGrupUzytkownikow->id.'" data-element_id="'.$element_id.'" aria-hidden="true"></i></div>';
            echo '</div>';
        }
        ?>
    </div>
</div>