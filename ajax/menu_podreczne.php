<?php

    require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
    $mainPanel = new main_PanelPrzedstawiciela();

?>

<div id="menu_podreczne_tresc">
	<div class="menu_podreczne_tresc">
		<div class="mpt_przydatne_ikony">
			<a href="<?php echo get_adres_strony(); ?>"><span class="strona_glowna_ikona mpt_ikona"></span></a>
            <span class=" mpt_ikona mpt_wstecz"></span>
            <span class=" mpt_ikona mpt_do_przodu"></span>
            <span class="mpt_ikona mpt_odswiez"></span>
		</div>
		<div id="uzytkownik_id" data-uzytkownik_id="<?php echo $_SESSION['uzytkownik_id']; ?>" class="uzytkownik_informacje">
			<div class="uzytkownik_avatar">
                <img class="wyswietlPanelUzytkownika" src="<?php echo adres_strony().'img/avatar/'.$_SESSION['uzytkownik_avatar']; ?>" />
			</div>
			<p class="zablokowane_pole_transparent margin_b_0">Witaj</p>
			<p class="zablokowane_pole_transparent"><?php echo $_SESSION['uzytkownik_imie'].' '.$_SESSION['uzytkownik_nazwisko']; ?></p>
			<div class="ustawienia_uzytkownika">
                <img class="wyswietlPanelUzytkownika" src="<?php echo adres_strony().'img/ustawienia.png'; ?>" />
			</div>
		</div>

		<div class="mpte_kreska"></div>

        <?php
            $listaPrzyznanychModulow = $mainPanel->listaPrzyznanychModulow($_SESSION['uzytkownik_id'], $bazaDanych);
            $liczbaPrzyznanychModulow = count($listaPrzyznanychModulow);

            for($i = 0; $i < $liczbaPrzyznanychModulow; $i++){
                echo '<a href="'.get_adres_strony().'moduly/'.$listaPrzyznanychModulow[$i]['nazwa_uproszczona'].'/">';
                    echo '<div class="menu_podreczne_tresc_element mpte_sprawy">';
				        echo '<span class="fa '.$listaPrzyznanychModulow[$i]['ikona'].' mpte_ikona"></span><span class="mpte_napis">'.$listaPrzyznanychModulow[$i]['nazwa_krotka'].'</span>';
			       echo '</div>';
                echo '</a>';
            }

        ?>

		<div class="mpte_kreska"></div>
		<div class="menu_podreczne_tresc_element mpte_wyloguj">
			<span class="wyloguj mpte_ikona"></span> <span class="mpte_napis">WYLOGUJ</span>
		</div>





	</div>
</div>
