<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$bazaDanych = new main_BazaDanych();
$konkursyMain = new KonkursyMain($bazaDanych);

$elementId = $widokDane['elementId'];
$tabela = $widokDane['tabela'];
$listaUzytkownikowZDostepem = null;
$dokument = '';

$listaGrup = $bazaDanych->pobierzDane('nazwa,id','uzytkownik_grupy','czy_usuniety = 0 AND id != 1');

if($tabela === 'konkurs_uzytkownik'){
    $listaUzytkownikowZDostepem = $bazaDanych->pobierzDane('uzytkownik_id','konkurs_uzytkownik','konkurs_id = '.$elementId);
}

if($tabela === 'konkurs_dokumenty_id_uzytkownik_id'){
    $listaUzytkownikowZDostepem = $bazaDanych->pobierzDane('uzytkownik_id','konkurs_dokumenty_id_uzytkownik_id','konkurs_dokumenty_id = '.$elementId);
    $dokument = 'Dokument';
}

if($tabela === 'konkurs_grafiki_id_uzytkownik_id'){
    $listaUzytkownikowZDostepem = $bazaDanych->pobierzDane('uzytkownik_id','konkurs_grafiki_id_uzytkownik_id','konkurs_grafiki_id = '.$elementId);
    $dokument = 'Grafika';
}

$listaUzytkownikowZDostepem_array = array();
if(!is_null($listaUzytkownikowZDostepem)){
    while($poj_listaUzytkownikowZDostepem = $listaUzytkownikowZDostepem->fetch_object()){
        array_push($listaUzytkownikowZDostepem_array, $poj_listaUzytkownikowZDostepem->uzytkownik_id);
    }
}

while($poj_listaGrup = $listaGrup->fetch_object()){
    $listaUzytkownikowGrupy = $bazaDanych->pobierzDane('id, imie, nazwisko, login','uzytkownik','status = 1 AND uzytkownik_grupa_id = '.$poj_listaGrup->id);
    if(!is_null($listaUzytkownikowGrupy)){
        echo '<div class="panel panel-default margin_b_10 panelGrupaUprawnienUzytkownik">';
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
                        <tbody>
                            <?php
                                while($poj_listaUzytkownikowGrupy = $listaUzytkownikowGrupy->fetch_object()){
                                    if(!in_array($poj_listaUzytkownikowGrupy->id, $listaUzytkownikowZDostepem_array)){
                                        echo '<tr>';
                                            echo '<td class="col-md-1">'.$poj_listaUzytkownikowGrupy->id.'</td>';
                                            echo '<td class="col-md-3">'.$poj_listaUzytkownikowGrupy->login.'</td>';
                                            echo '<td class="col-md-3">'.$poj_listaUzytkownikowGrupy->imie.'</td>';
                                            echo '<td class="col-md-4">'.$poj_listaUzytkownikowGrupy->nazwisko.'</td>';
                                            echo '<td class="">';
                                                echo '<i class="fa fa-plus-square dodajUsunUprawnienie'.$dokument.'Uzytkownik dodajUprawnienieKonkurs'.$dokument.'" data-element_id="'.$poj_listaUzytkownikowGrupy->id.'" data-tabela="'.(($dokument === 'Dokument') ? 'konkurs_dokumenty_id_uzytkownik_id' : 'konkurs_uzytkownik' ).'"  data-reakcja="dodaj" aria-hidden="true"></i>';
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
    }
}

