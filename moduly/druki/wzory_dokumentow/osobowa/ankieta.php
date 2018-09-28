<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$pozostale_informacje = json_decode($_POST['pozostale_informacje'], true);

$lista_pytan = json_decode($_POST['lista_pytan']);

$stopka = 'PG-2-23-/2017-10-01';
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

    <div class="pdf_strona"> 

        <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/></div>

            <p class="margin_b_0 font_w_700 font_size_20 text_a_center margin_t_80">ANKIETA INFORMACYJNA DOTYCZĄCA WIĘZI</p>
            <p class="margin_b_0 font_w_700 font_size_20 text_a_center margin_t_0">MIĘDZY OSOBĄ UPRAWNIONĄ A OSOBĄ ZMARŁĄ</p>


        <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0 margin_t_30">
            <p class="font_size_16 margin_t_15">Imię i nazwisko osoby zmarłej: <?php echo (!empty($pozostale_informacje['poszkodowany'])) ? $pozostale_informacje['poszkodowany'] : '__________________________________________' ; ?> wiek: <?php echo (!empty($pozostale_informacje['wiek_poszkodowany'])) ? $pozostale_informacje['wiek_poszkodowany'] : '______________________' ; ?></p>
            <p class="font_size_16 margin_t_15">Imię i nazwisko osoby Uprawnionej: <?php echo (!empty($pozostale_informacje['uprawniony'])) ? $pozostale_informacje['uprawniony'] : '__________________________________________'; ?> wiek: <?php echo (!empty($pozostale_informacje['wiek_uprawniony'])) ? $pozostale_informacje['wiek_uprawniony'] : '______________________' ; ?></p>
            <p class="font_size_16 margin_t_15">Stopień pokrewieństwa/powinowactwa łączący osobę uprawnioną z osobą zmarłą: <?php echo (!empty($pozostale_informacje['stopien_pokrewienstwa'])) ? $pozostale_informacje['stopien_pokrewienstwa'] : '_____________________'; ?></p>
        </div>

        <?php

            for($i=0;$i<8;$i++) {



                echo '<div class="col-md-12 padding_l_40 padding_r_40 margin_t_0 margin_b_0">';
                echo '<div class="form-group col-md-1 float_l margin_b_0 padding_t_10">';
                echo '<p class="font_size_26 margin_b_0"><span class="font_w_700 margin_b_0">';
                echo $lista_pytan[$i]->NumerPytania;
                echo '</span></p>';
                echo '</div>';
                echo '<div class="form-group col-md-11 padding_t_10 width_90_p margin_b_0">';
                echo $lista_pytan[$i]->Wartosc;
                echo '<div class="col-md-12 paddding_10 margin_b_0 margin_t_0 height_80 szary_box_ramka_czerw szary_box">';
                echo '<div class="pdf_kratka kratka_nowy medium_kratka">';
                echo $lista_pytan[$i]->Odpowiedz;
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
        }
        ?>

        <div class="clear_b"></div>
        <div class="stopka_pionowa"><?php echo $stopka; ?></div>
        <div class="stopka_pozioma_dol"><p class="text_a_center margin_b_0">1/3</p></div>
    </div>

<div class="pdf_strona">

    <?php

    for($i=8;$i<18;$i++) {

        echo '<div class="col-md-12 padding_l_40 padding_r_40 margin_t_0 margin_b_0">';
        echo '<div class="form-group col-md-1 float_l margin_b_0 padding_t_10">';
        echo '<p class="font_size_26 margin_b_0"><span class="font_w_700 margin_b_0">';
        echo $lista_pytan[$i]->NumerPytania;
        echo '</span></p>';
        echo '</div>';
        echo '<div class="form-group col-md-11 padding_t_10 width_90_p margin_b_0">';
        echo $lista_pytan[$i]->Wartosc;
        echo '<div class="col-md-12 paddding_10 margin_b_0 margin_t_0 height_80 szary_box_ramka_czerw szary_box">';
        echo '<div class="pdf_kratka kratka_nowy medium_kratka">';
        echo $lista_pytan[$i]->Odpowiedz;
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>

    <div class="stopka_pionowa"><?php echo $stopka; ?></div>
    <div class="stopka_pozioma_dol"><p class="text_a_center margin_b_0">2/3</p></div>

</div>

<div class="pdf_strona">

    <?php

    for($i=18;$i<24;$i++) {


        echo '<div class="col-md-12 padding_l_40 padding_r_40 margin_t_0 margin_b_0">';
        echo '<div class="form-group col-md-1 float_l margin_b_0 padding_t_10">';
        echo '<p class="font_size_26 margin_b_0"><span class="font_w_700 margin_b_0">';
        echo $lista_pytan[$i]->NumerPytania;
        echo '</span></p>';
        echo '</div>';
        echo '<div class="form-group col-md-11 padding_t_10 width_90_p margin_b_0">';
        echo $lista_pytan[$i]->Wartosc;

        if ($lista_pytan[$i]->NumerPytania == '22') {

            echo '<div class="col-md-12 paddding_10 margin_b_20 margin_t_20 height_100 szary_box_ramka_czerw szary_box">';
            echo '<div class="pdf_kratka kratka_nowy large_kratka">';
            //echo 'TEST';
            echo $lista_pytan[$i]->Odpowiedz;
            echo '</div>';
            echo '</div>';

        } else {
            echo '<div class="col-md-12 paddding_10 margin_b_0 margin_t_0 height_80 szary_box_ramka_czerw szary_box">';
            echo '<div class="pdf_kratka kratka_nowy medium_kratka">';
            echo $lista_pytan[$i]->Odpowiedz;
            echo '</div>';
            echo '</div>';
        }


        echo '</div>';
        echo '</div>';
    }
    ?>


    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_80">
        <div class="form-group col-md-4 margin_t_5 float_r">
            <div class="pdf_kreska"></div>
            <p class="text_a_center font_size_10">Podpis Klienta/W imieniu klienta</p>
        </div>
    </div>

    <div class="stopka_pionowa"><?php echo $stopka; ?></div>
    <div class="stopka_pozioma_dol"><p class="text_a_center margin_b_0">3/3</p></div>


</div>