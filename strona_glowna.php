<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');
    $bazaDanych = new main_BazaDanych();

    $mainPanel->wyswietlNaglowek(false, 'strona główna');

    $mainPanel->zaladujBiblioteki();


/*  foreach($_SESSION as $sesja=>$wartosc) {
    echo "<p>".$sesja." = ".$wartosc."</p>";
}*/

?>
<div class="col-md-6 strona_glowna margin_t_20">
    <div class="panel panel-default">
        <div class="panel-heading">WYBIERZ JEDEN Z ELEMENTÓW</div>
        <div class="panel-body">
            <?php
            //print_r($_COOKIE);
                $listaPrzyznanychModulow = $mainPanel->listaPrzyznanychModulow($_SESSION['uzytkownik_id'], $bazaDanych);
                $liczbaPrzyznanychModulow = count($listaPrzyznanychModulow);

                for($i = 0; $i < $liczbaPrzyznanychModulow; $i++){
                    if($listaPrzyznanychModulow[$i]['id'] == 12){
                        echo '<a class=" col-md-6 col-sm-6 col-xs-12" href="'.get_adres_strony().'moduly/'.$listaPrzyznanychModulow[$i]['nazwa_uproszczona'].'/" title="'.$listaPrzyznanychModulow[$i]['nazwa_grupy'].'">';
                        echo '<div class="element_do_wyboru element_do_wyboru_red col-md-12 col-sm-12 col-xs-12 zablokowane_pole_transparent">';
                        echo '<p class="margin_b_0">'.$listaPrzyznanychModulow[$i]['nazwa_grupy'].'</p>';
                        echo '</div><div class="clear_b"></div></a>';
                    }else if($listaPrzyznanychModulow[$i]['id'] == 18){
                        echo '<a class=" col-md-6 col-sm-6 col-xs-12" href="' . get_adres_strony() . 'moduly/' . $listaPrzyznanychModulow[$i]['nazwa_uproszczona'] . '/" title="' . $listaPrzyznanychModulow[$i]['nazwa_grupy'] . '">';
                        echo '<div class="element_do_wyboru element_do_wyboru_yellow col-md-12 col-sm-12 col-xs-12 zablokowane_pole_transparent">';
                        echo '<p class="margin_b_0">' . $listaPrzyznanychModulow[$i]['nazwa_grupy'] . '</p>';
                        echo '</div><div class="clear_b"></div></a>';
                    }else if($listaPrzyznanychModulow[$i]['id'] == 21){
                        echo '<a class=" col-md-6 col-sm-6 col-xs-12" href="' . get_adres_strony() . 'moduly/' . $listaPrzyznanychModulow[$i]['nazwa_uproszczona'] . '/" title="' . $listaPrzyznanychModulow[$i]['nazwa_grupy'] . '">';
                        echo '<div class="element_do_wyboru element_do_wyboru_purple col-md-12 col-sm-12 col-xs-12 zablokowane_pole_transparent">';
                        echo '<p class="margin_b_0">' . $listaPrzyznanychModulow[$i]['nazwa_grupy'] . '</p>';
                        echo '</div><div class="clear_b"></div></a>';
                    }else if($listaPrzyznanychModulow[$i]['id'] == 22){
                        echo '<a class=" col-md-6 col-sm-6 col-xs-12" href="' . get_adres_strony() . 'moduly/' . $listaPrzyznanychModulow[$i]['nazwa_uproszczona'] . '/" title="' . $listaPrzyznanychModulow[$i]['nazwa_grupy'] . '">';
                        echo '<div class="element_do_wyboru element_do_wyboru_blue col-md-12 col-sm-12 col-xs-12 zablokowane_pole_transparent">';
                        echo '<p class="margin_b_0">' . $listaPrzyznanychModulow[$i]['nazwa_grupy'] . '</p>';
                        echo '</div><div class="clear_b"></div></a>';
                    }else{
                        echo '<a class=" col-md-6 col-sm-6 col-xs-12" href="' . get_adres_strony() . 'moduly/' . $listaPrzyznanychModulow[$i]['nazwa_uproszczona'] . '/" title="' . $listaPrzyznanychModulow[$i]['nazwa_grupy'] . '">';
                        echo '<div class="element_do_wyboru col-md-12 col-sm-12 col-xs-12 zablokowane_pole_transparent">';
                        echo '<p class="margin_b_0">' . $listaPrzyznanychModulow[$i]['nazwa_grupy'] . '</p>';
                        echo '</div><div class="clear_b"></div></a>';
                    }
                }
            ?>
        </div>
    </div>
</div>
<div class="col-md-6 margin_t_20 powiadomieniaMobile">
    <div class="panel panel-default margin_b_0">
        <div class="panel-body">
            <input type="hidden" id="agentNumber" value="<?php echo $_SESSION['uzytkownik_login']; ?>">
            <div class="lastMessagesMain">
            </div>
        </div>
    </div>
    <div class="panel panel-default margin_b_0">
        <div class="panel-body">
            <?php
                $powiadomienie_systemowe_lista = $mainPanel->wygenerujListePowiadomien($_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id'], $bazaDanych);
                if (count($powiadomienie_systemowe_lista) !== 0) {
                    echo '<div class="col-md-12">';
                        foreach ( $powiadomienie_systemowe_lista as $wartosc ) {
                            $powiadomienie_tmp = $bazaDanych->pobierzDane('tresc','powiadomienia','powiadomienia_rodzaj_id = 2 AND id = '.$wartosc);
                            if(!is_null($powiadomienie_tmp)){
                                $powiadomienie_tmp = $powiadomienie_tmp->fetch_object();
                                echo '<div class="powiadomienie_systemowe_pojedyncze">';
                                    echo htmlspecialchars_decode ( $powiadomienie_tmp->tresc );
                                echo '</div>';
                            }
                        }
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</div>

<?php $mainPanel->wyswietlStopke(false); ?>

