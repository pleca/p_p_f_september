<?php

    $bazaDanych = new main_BazaDanych();
    $mainPanel = new main_PanelPrzedstawiciela($bazaDanych);

    $listaUzytkownikow = $widokDane['listaUzytkownikow'];
    $tabela = $widokDane['tabela'];
    $kolumna = $widokDane['kolumna'];
    $element_id = $widokDane['element_id'];
    $widok_edycja = $widokDane['widok_edycja'];
    $szczegoly_elementu = $widokDane['szczegoly_elementu'];
?>
<div class="panel panel-default margin_b_0">
    <div class="panel-heading">Lista użytkowników<i data-szczegoly_elementu="<?php echo $szczegoly_elementu; ?>" data-widok_edycja="<?php echo $widok_edycja; ?>" data-tabela="<?php echo $tabela; ?>" data-kolumna="<?php echo $kolumna; ?>" data-element_id="<?php echo $element_id; ?>" class="fa fa-plus-square float_r wyswietlDodajUprawnienieUzytkownik" aria-hidden="true"></i></div>
    <div class="panel-body">

        <table class="table table-striped tabela_lista_uzytkownikow_uprawnienia_ogolne">
            <thead>
            <tr>
                <th class="col-md-1">ID</th>
                <th class="col-md-3">login</th>
                <th class="col-md-3">Imie</th>
                <th class="col-md-4">Nazwisko</th>
                <th class=""></th>
            </tr>
            </thead>
            <tbody>
                <?php
                    if(!is_null($listaUzytkownikow)){
                        while($poj_listaUzytkownikow = $listaUzytkownikow->fetch_object()){
                            if(isset($poj_listaUzytkownikow->uzytkownik_id)){
                                $uzytkownikId = $poj_listaUzytkownikow->uzytkownik_id;
                                $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko, login','uzytkownik','id = '.$poj_listaUzytkownikow->uzytkownik_id);
                            }else{
                                $uzytkownikId = $poj_listaUzytkownikow->id_uzytkownika;
                                $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko, login','uzytkownik','id = '.$poj_listaUzytkownikow->id_uzytkownika);
                            }

                            if(!is_null($uzytkownik_tmp)){
                                $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();
                                echo '<tr>';
                                    echo '<td class="col-md-1">'.$uzytkownikId.'</td>';
                                    echo '<td class="col-md-3">'.$uzytkownik_tmp->login.'</td>';
                                    echo '<td class="col-md-3">'.$uzytkownik_tmp->imie.'</td>';
                                    echo '<td class="col-md-4">'.$uzytkownik_tmp->nazwisko.'</td>';
                                    echo '<td class="">';
                                        echo '<i class="fa fa-trash float_r" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button  data-tabela=\''.$tabela.'\' data-kolumna=\''.$kolumna.'\' data-uzytkownik_id=\''.$uzytkownikId.'\' data-element_id=\''.$element_id.'\' type=\'button\' class=\'btn btn-danger usunTak elementDodajUsunUprawnienieUzytkownika\'>TAK</button>"></i>';
                                    echo '</td>';
                                echo '</tr>';
                            }
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
