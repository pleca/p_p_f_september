<?php

    require_once($_SERVER ['DOCUMENT_ROOT'].'/klasy/klasa_main_BazaDanych.php');

    $bazaDanych = new main_BazaDanych();

    $top = 100;

    if(isset($widokDane['listaParametrow'])){



        $historia_element = $widokDane['historiaElement'];
        $kolumna = $widokDane['kolumna'];
        $element_id = $widokDane['elementId'];

        $listaParametrow = $widokDane['listaParametrow'];

        foreach($listaParametrow as $klucz => $wartosc){
            if($wartosc === 'null'){
                unset($listaParametrow[$klucz]);
            }
        }

        $top = $listaParametrow['top'];
        unset($listaParametrow['top']);

        $lista_historia_zmian = $bazaDanych->pobierzDane('*',$historia_element,$kolumna.' = '.$element_id.' 
         
         '.((array_key_exists('data_zmiany',$listaParametrow)) ? ' AND data_zmiany LIKE "'.$listaParametrow['data_zmiany'].'%" ' : '' ).'
         '.((array_key_exists('akcja',$listaParametrow)) ? ' AND akcja LIKE "%'.$listaParametrow['akcja'].'%" ' : '' ).'
         '.((array_key_exists('wartosc_przed',$listaParametrow)) ? ' AND wartosc_przed LIKE "%'.$listaParametrow['wartosc_przed'].'%" ' : '' ).'
         '.((array_key_exists('wartosc_po',$listaParametrow)) ? ' AND wartosc_po LIKE "%'.$listaParametrow['wartosc_po'].'%" ' : '' ).'
         '.((array_key_exists('adres_ip',$listaParametrow)) ? ' AND adres_ip LIKE "%'.$listaParametrow['adres_ip'].'%" ' : '' ).'
         
         ORDER BY data_zmiany DESC LIMIT '.$top);

    }else{
        $lista_historia_zmian = $bazaDanych->pobierzDane('*',$historia_element,$kolumna.' = '.$element_id.' ORDER BY data_zmiany DESC LIMIT '.$top);
    }



?>

<table id="" class="tabela_historia table_data_table table table-striped table-hover">
    <thead>
    <tr>
        <th class="col-md-3">Data</th>
        <th class="col-md-2">Akcja</th>
        <th class="col-md-3">Przed</th>
        <th class="col-md-3">Po</th>
        <th class="ukryj">Adres IP</th>
        <th class="col-md-1">Edytował</th>
        <th class="ukryj"></th>
        </tr>
    </thead>
    <tbody>
    <?php
        if($lista_historia_zmian) {
            while ($poj_lista_historia_zmian = $lista_historia_zmian->fetch_object()) {
                $godzina = explode(' ', $poj_lista_historia_zmian->data_zmiany);
                $zmiany_dokonal_imie = '';
                $zmiany_dokonal_nazwisko = '';
                $zmiany_dokonal_id = '';

                $zmiany_dokonal = $bazaDanych->pobierzDane('imie, nazwisko', 'uzytkownik', 'id = ' . $poj_lista_historia_zmian->zmiany_dokonal);
                if (!is_null($zmiany_dokonal)) {
                    $zmiany_dokonal = $zmiany_dokonal->fetch_object();
                    $zmiany_dokonal_imie = $zmiany_dokonal->imie;
                    $zmiany_dokonal_nazwisko = $zmiany_dokonal->nazwisko;
                    $zmiany_dokonal_id = $poj_lista_historia_zmian->zmiany_dokonal;

                    $zmiany_dokonal_calos = $zmiany_dokonal_imie . ' ' . $zmiany_dokonal_nazwisko . '(' . $zmiany_dokonal_id . ')';
                } else {
                    if ($poj_lista_historia_zmian->zmiany_dokonal == 0) {
                        $zmiany_dokonal_calos = 'Cron';
                    }

                }
                ?>
                <tr data-toggle="tooltip" data-placement="top" title="Adres IP: <?php echo $poj_lista_historia_zmian->adres_ip; ?>">
                    <td class="col-md-3"><?php echo $godzina[0].' '.$godzina[1]; ?></td>
                    <td class="col-md-2"><?php echo $poj_lista_historia_zmian->akcja; ?></td>
                    <td class="col-md-3 poleTabelaTextarea">
                        <?php echo ((mb_strlen($poj_lista_historia_zmian->wartosc_przed) > 100) ? '<textarea>'.$poj_lista_historia_zmian->wartosc_przed.'</textarea>' : $poj_lista_historia_zmian->wartosc_przed ); ?>
                    </td>
                    <td class="col-md-3 poleTabelaTextarea">
                        <?php echo ((mb_strlen($poj_lista_historia_zmian->wartosc_po) > 100) ? '<textarea>'.$poj_lista_historia_zmian->wartosc_po.'</textarea>' : $poj_lista_historia_zmian->wartosc_po); ?>
                    </td>
                    <td class="ukryj"><?php echo $poj_lista_historia_zmian->adres_ip; ?></td>
                    <td class="col-md-1"><?php echo $zmiany_dokonal_calos; ?></td>
                    <td class="ukryj"></td>
                </tr>
            <?php }
        }
    ?>
    </tbody>
</table>
