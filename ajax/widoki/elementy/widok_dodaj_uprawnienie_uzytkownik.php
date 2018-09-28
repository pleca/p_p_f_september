<?php

$bazaDanych = new main_BazaDanych();
$mainPanel = new main_PanelPrzedstawiciela($bazaDanych);

$listaUzytkownikow = $widokDane['listaUzytkownikow'];
$tabela = $widokDane['tabela'];
$kolumna = $widokDane['kolumna'];
$element_id = $widokDane['element_id'];
$widok_edycja = $widokDane['widok_edycja'];
$szczegoly_elementu = $widokDane['szczegoly_elementu'];

if($tabela === 'uzytkownik_uprawnienie'){
    $listaUzytkownikowZDostepem = $bazaDanych->pobierzDane('id_uzytkownika',$tabela, $kolumna.' = '.$element_id);
}else{
    $listaUzytkownikowZDostepem = $bazaDanych->pobierzDane('uzytkownik_id',$tabela, $kolumna.' = '.$element_id);
}

if($_SESSION['uzytkownik_grupa_id'] === '1'){
    $listaGrup = $bazaDanych->pobierzDane('nazwa,id','uzytkownik_grupy','czy_usuniety = 0');
}else{
    $listaGrup = $bazaDanych->pobierzDane('nazwa,id','uzytkownik_grupy','czy_usuniety = 0 AND id != 1');
}


$listaUzytkownikowZDostepem_array = array();
if(!is_null($listaUzytkownikowZDostepem)){
    while($poj_listaUzytkownikowZDostepem = $listaUzytkownikowZDostepem->fetch_object()){
        if(isset($poj_listaUzytkownikowZDostepem->uzytkownik_id)){
            array_push($listaUzytkownikowZDostepem_array, $poj_listaUzytkownikowZDostepem->uzytkownik_id);
        }else{
            array_push($listaUzytkownikowZDostepem_array, $poj_listaUzytkownikowZDostepem->id_uzytkownika);
        }

    }
}

$nr_grupy = 0;

while($poj_listaGrup = $listaGrup->fetch_object()){
    $listaUzytkownikowGrupy = $bazaDanych->pobierzDane('id, imie, nazwisko, login','uzytkownik','status = 1 AND uzytkownik_grupa_id = '.$poj_listaGrup->id);
    if(!is_null($listaUzytkownikowGrupy)){
        echo '<div class="panel panel-default margin_b_10 panelGrupaUprawnienUzytkownik position_relative">';
            if($tabela === 'uzytkownik_uprawnienie'){
                echo '<i data-nazwa_grupy_lista="ldug_'.$nr_grupy.'" data-toggle="tooltip" data-placement="left" title="Nadaj dla wszystkich w grupie" class="fa fa-th-list nadajUprawnienieDlaWszystkichwGrupie position_absolute" aria-hidden="true"></i>';
            }
            echo '<div class="panel-heading cursor_p rozwinZwinPanelModal">'.$poj_listaGrup->nazwa.'</div>';
            echo '<div class="panel-body display_none listaUzytkownikowUprawnienia">';
                ?>
                    <table class="table table-striped tabela_lista_uzytkownikow_uprawnienia">
                        <thead>
                            <tr>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-3">login</th>
                                <th class="col-md-3">Imie</th>
                                <th class="col-md-4">Nazwisko</th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody class="ldug_<?php echo $nr_grupy; ?>">
                            <?php
                                while($poj_listaUzytkownikowGrupy = $listaUzytkownikowGrupy->fetch_object()){
                                    if(!in_array($poj_listaUzytkownikowGrupy->id, $listaUzytkownikowZDostepem_array)){
                                        echo '<tr class="ldgu_element" data-uzytkownik_id="'.$poj_listaUzytkownikowGrupy->id.'">';
                                            echo '<td class="col-md-1">'.$poj_listaUzytkownikowGrupy->id.'</td>';
                                            echo '<td class="col-md-3">'.$poj_listaUzytkownikowGrupy->login.'</td>';
                                            echo '<td class="col-md-3">'.$poj_listaUzytkownikowGrupy->imie.'</td>';
                                            echo '<td class="col-md-4">'.$poj_listaUzytkownikowGrupy->nazwisko.'</td>';
                                            echo '<td class="">';
                                                echo '<i class="fa fa-plus-square dodajTak elementDodajUsunUprawnienieUzytkownika" data-szczegoly_elementu="'.$szczegoly_elementu.'" data-widok_edycja="'.$widok_edycja.'" data-uzytkownik_id="'.$poj_listaUzytkownikowGrupy->id.'" data-element_id="'.$element_id.'" data-tabela="'.$tabela.'" data-kolumna="'.$kolumna.'" aria-hidden="true"></i>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                <?php
            echo '</div>';
        echo '</div>';
        $nr_grupy++;
    }
}

