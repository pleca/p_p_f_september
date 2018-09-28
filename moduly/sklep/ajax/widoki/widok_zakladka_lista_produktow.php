<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
    $sklepMain = new SklepMain($bazaDanych);

    if($sklepMain->sprawdzUprawnienie('sklep_dodaj_produkt')) {
        echo '<div class="col-md-12 dodajProduktNowy margin_b_10 padding_0"><div class="panel panel-default "><div class="panel_naglowek"><i class="float_r fa fa-plus dodaj_produkt" aria-hidden="true"></i><div class="clear_b"></div></div></div></div>';
        echo '<div class="clear_b"></div>';
    }

    $listaKategorii = $sklepMain->pobierzListeWszystkichProduktow();
    $listaKategorii_array = array();

    if(!is_null($listaKategorii)){
        while($kategoria = $listaKategorii->fetch_object()){
            $listaKategorii_array[$kategoria->id] = array(
                'nazwa' => $kategoria->nazwa
                ,'nazwa_uproszczona' => $kategoria->nazwa_uproszczona
            );
        }
    }


?>

<div class="sklepListaKategorii">
    <ul class="nav nav-tabs float_l" role="tablist">
            <?php
                $i = 0;
                foreach($listaKategorii_array as $id => $dane){
                    $listaProduktowKategorii = $sklepMain->pobierzListeProduktowKategorii($id);

                    if(!is_null($listaProduktowKategorii)){
                        ?>
                            <li role="presentation" data-klasa="<?php echo $dane['nazwa_uproszczona']; ?>" class="width_100 <?php echo ($i === 0) ? 'active ' : '' ; echo $dane['nazwa_uproszczona'];?>"><a class="width_100" href="#<?php echo $dane['nazwa_uproszczona']; ?>" aria-controls="<?php echo $dane['nazwa_uproszczona']; ?>" role="tab" data-toggle="tab"><?php echo $dane['nazwa']; ?></a></li>
                        <?php
                        $i++;
                    }
                }
            ?>
    </ul>
    <div class="tab-content float_l padding_b_5 padding_t_5 padding_l_5 padding_r_5">
        <?php
            $i = 0;
            foreach($listaKategorii_array as $id => $dane){
                $listaProduktowKategorii = $sklepMain->pobierzListeProduktowKategorii($id);

                if(!is_null($listaProduktowKategorii)){
                    ?>
                        <div role="tabpanel" class="tab-pane <?php echo ($i === 0) ? 'active ' : '' ; echo $dane['nazwa_uproszczona']; ?>" id="<?php echo $dane['nazwa_uproszczona']; ?>">
                            <?php
                                while ($produktId = $listaProduktowKategorii->fetch_object()){
                                    $produkt_tmp = $bazaDanych->pobierzDane('*','sklep_produkty','id = '.$produktId->sklep_produkty_id);
                                    $produkt_tmp = $produkt_tmp->fetch_object();
                                    echo $sklepMain->generujMiniatureProduktu($produkt_tmp);
                                }
                            ?>
                        </div>
                    <?php
                    $i++;
                }
            }
        ?>
        <div class="clear_b"></div>
    </div>
    <div class="clear_b"></div>
</div>



